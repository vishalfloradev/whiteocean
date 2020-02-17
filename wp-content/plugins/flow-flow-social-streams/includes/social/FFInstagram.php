<?php namespace flow\social;
use InstagramAPI\Endpoints;
use InstagramAPI\Exception\InstagramNotFoundException;
use InstagramAPI\Instagram;
use InstagramAPI\Model\Media;
use flow\settings\FFSettingsUtils;
use Unirest\Request;

if ( ! defined( 'WPINC' ) ) die;

/**
 * Flow-Flow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>

 * @link      http://looks-awesome.com
 * @copyright 2014-2016 Looks Awesome
 */
class FFInstagram extends FFBaseFeed {
    private $url;
	private $size = 0;
	private $comments = null;
	private $userMeta = null;
	private $pagination = true;
	private $alternative = false;
	private $timeline;
	private $accounts = [];
	private $api = null;
	private $username = null;
	private $password = null;

	public function __construct() {
		parent::__construct( 'instagram' );
	}

	public function init( $context, $options, $feed ) {
		parent::init( $context, $options, $feed );
		require_once $context['root'] . 'libs/InstagramAPI.php';
		require_once $context['root'] . 'libs/Unirest.php';
		require_once $context['root'] . 'libs/phpFastCache.php';

		Request::verifyPeer(false);
		Request::verifyHost(false);
		Request::curlOpt( CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
		Request::curlOpt( CURLOPT_FOLLOWLOCATION, true);
		$original = $options->original();
		$this->username = $original['instagram_login'];
		$this->password = $original['instagram_pass'];
	}

	/**
	 * @return Instagram
	 * @throws \InstagramAPI\Exception\InstagramAuthException
	 * @throws \InstagramAPI\Exception\InstagramException
	 * @throws \phpFastCache\Exceptions\phpFastCacheDriverCheckException
	 */
	public function getApi(){
		if ($this->api == null){
			if (!empty($this->username) && !empty($this->password)){
				// $session_folder = '/tmp/sessions';
                // WordPress version
                $session_folder = $_SERVER['TMP'];
				$this->api = Instagram::withCredentials($this->username, $this->password, $session_folder);
				$this->api->login();
			}
			else {
				$this->api = new Instagram();
			}
		}
		return $this->api;
	}

	public function deferredInit($options, $feed) {
		$original = $options->original();
		$accessToken = $original['instagram_access_token'];
		$this->url = "https://api.instagram.com/v1/users/self/media/recent/?access_token={$accessToken}&count={$this->getCount()}";
		if (isset($feed->{'timeline-type'})) {
			$this->timeline = $feed->{'timeline-type'};
			switch ($this->timeline) {
				case 'user_timeline':
//					$content = FFSettingsUtils::preparePrefixContent($feed->content, '@');
                    $content = $feed->content;
					//$userId = $this->getUserId($content, $accessToken);
					//$this->userMeta = $this->getUserMeta($userId, $accessToken);
					//$this->url = "https://api.instagram.com/v1/users/self/media/recent/?access_token={$accessToken}&count={$this->getCount()}";
					if (empty($content)){
						$this->url = "https://api.instagram.com/v1/users/self/media/recent/?access_token={$accessToken}&count={$this->getCount()}";
					}
					else {
						$this->url = $content;
						$this->alternative = true;
					}
					break;
				case 'tag':
//					$tag = FFSettingsUtils::preparePrefixContent($feed->content, '#');
//					$tag = urlencode($feed->content);
					$tag = $feed->content;
					$this->url = $tag;//"https://api.instagram.com/v1/tags/{$tag}/media/recent?access_token={$accessToken}&count={$this->getCount()}";
					$this->alternative = true;
					break;
				case 'location':
//					$locationID = $feed->content;
//					$this->url = "https://api.instagram.com/v1/locations/{$locationID}/media/recent?access_token={$accessToken}&count={$this->getCount()}";
					$this->alternative = true;
					break;
				case 'coordinates':
					$coordinates = explode(',', $feed->content);
					$lat = trim($coordinates[0]);
					$lng = trim($coordinates[1]);
					$this->url = "https://api.instagram.com/v1/media/search?lat={$lat}&lng={$lng}&access_token={$accessToken}&count={$this->getCount()}";
					break;
			}
		}
	}

	public function onePagePosts() {
		$result = array();
		if ($this->alternative){
			$instagram = $this->getApi();
			$medias = [];
			$forced_loading_of_post = false;
			switch ($this->timeline){
				case 'user_timeline':
					$account = $this->getAccount($this->url);
					$this->userMeta = $this->fillUser($this->url);
					$account_id = $account->getId();
					$medias = $instagram->getMediasByUserId($account_id, $this->getCount());
					break;
				case 'tag':
					$medias = $instagram->getMediasByTag($this->url, $this->getCount());
					$forced_loading_of_post = true;
					break;
				case 'location':
					$locationID = $this->feed->content;
					$medias = $instagram->getMediasByLocationId($locationID, $this->getCount());
			}

			foreach ( $medias as $media ) {
				$post      = $instagram->getMediaByUrl( $media->getLink() );
				$post      = $this->altParsePost( $post );
				if(!empty($this->userMeta)){
					$post->userMeta = $this->userMeta;
				}
				if ($this->isSuitablePost($post)) $result[$post->id] = $post;
			}
			$this->pagination = false;
		}
		else {
			$data = $this->getFeedData($this->url);
			if (sizeof($data['errors']) > 0){
				$this->errors[] = array(
					'type'    => $this->getType(),
					'message' => is_object($data['errors']) ? 'Error getting data from instagram server' : $this->filterErrorMessage($data['errors']),
					'url' => $this->url
				);
				error_log(print_r($data['errors'], true));
				throw new \Exception();
			}
			if (isset($data['response']) && is_string($data['response'])){
				$response = $data['response'];
				//fix malformed
				//http://stackoverflow.com/questions/19981442/decoding-instagram-reply-php
				//In case of a problem, comment out this line
				$response = html_entity_decode($response);
				$page = json_decode($response);
				if (isset($page->pagination) && isset($page->pagination->next_url))
					$this->url = $page->pagination->next_url;
				else
					$this->pagination = false;
				foreach ($page->data as $item) {
					$post = $this->parsePost($item);

					if(!empty($this->userMeta)){
						$post->userMeta = $this->userMeta;
					}

					if ($this->isSuitablePost($post)) $result[$post->id] = $post;
				}
			} else {
				$this->errors[] = array(
					'type'    => 'instagram',
					'message' => 'FFInstagram has returned the empty data.',
					'url' => $this->url
				);
			}
		}
		return $result;
	}

	private function parsePost($post) {
		$tc = new \stdClass();
		$tc->feed_id = $this->id();
		$tc->smart_order = 0;
		$tc->id = (string)$post->id;
		$tc->header = '';
		$tc->type = $this->getType();
		$tc->nickname = (string)$post->user->username;
		if (!isset($post->user->full_name)) $post->user = $this->fillUser($post->user->username);
		$tc->screenname = FFFeedUtils::removeEmoji((string)$post->user->full_name);
		if (function_exists('mb_convert_encoding')){
			$tc->screenname = mb_convert_encoding($tc->screenname, 'HTML-ENTITIES', 'UTF-8');
		}
		else if (function_exists('iconv')){
			$tc->screenname = iconv('UTF-8', 'HTML-ENTITIES', $tc->screenname);
		}
		$tc->userpic = (string)$post->user->profile_picture;
		$tc->system_timestamp = $post->created_time;
		$tc->img = $this->createImage($post->images->low_resolution->url,
				$post->images->low_resolution->width, $post->images->low_resolution->height);
		$tc->text = isset($post->caption->text) ? $this->getCaption($post->caption->text) : '';
		$tc->userlink = 'http://instagram.com/' . $tc->nickname;
		$tc->permalink = (string)$post->link;
		$tc->location = $post->location;
        $tc->additional = array('likes' => (string)$post->likes->count, 'comments' => (string)$post->comments->count);
		
		$tc->carousel= array();
		if (isset($post->type) && $post->type == 'carousel' && isset($post->carousel_media)){
			$tc->carousel = $this->getCarousel($post);
			$tc->media = sizeof($tc->carousel) > 0 ? $tc->carousel[0] : $tc->img;
		}
		else {
			$tc->media = $this->getMediaContent($post);
		}
		return $tc;
	}

	/**
	 * @param Media $post
	 * @param bool $forced_loading_of_post
	 *
	 * @return \stdClass
	 */
	private function altParsePost($post, $forced_loading_of_post = false) {

//		if ($forced_loading_of_post || Media::TYPE_IMAGE != $post->getType()) {
//			$instagram = new Instagram();
//
//			try{
//				$post      = $instagram->getMediaById( $post->getId() );
//				$account = $post->getOwner();
//			}catch(\Exception $e){
//				error_log($e->getMessage());
//				error_log($e->getTraceAsString());
//			}
//		}
//		else {
//			$account = $this->getAccountById($post->getOwnerId());
//		}
		$account = $this->getAccount($post->getOwner()->getUsername());

		$tc = new \stdClass();
		$tc->feed_id = $this->id();
		$tc->smart_order = 0;
		$tc->id = $post->getId();
		$tc->type = $this->getType();
		$tc->header = '';
		$tc->nickname = $account->getUsername();
		$tc->screenname = FFFeedUtils::removeEmoji($account->getFullName());
		$tc->userpic = $account->getProfilePicUrlHd();
		$tc->system_timestamp = $post->getCreatedTime();
		$tc->carousel = [];

		$min_thumbnail = 1000;
		$max_thumbnail = 0;
		foreach ( $post->getThumbnailResources() as $width => $thumbnail ) {
			if ($min_thumbnail > $width && $width >= 200) $min_thumbnail = $width;
			if ($max_thumbnail < $width && $width <= 1000) $max_thumbnail = $width;
		}
		$min_thumbnail = $post->getThumbnailResources()[$min_thumbnail];
		$max_thumbnail = $post->getThumbnailResources()[$max_thumbnail];

		$tc->img = $this->createImage($min_thumbnail->url, $min_thumbnail->width, $min_thumbnail->height);

		if (Media::TYPE_VIDEO == $post->getType()){
			$tc->media = $this->createMedia($post->getVideoStandardResolutionUrl(), $max_thumbnail->width, $max_thumbnail->height, 'video/mp4', true);
		}
		else if (Media::TYPE_SIDECAR == $post->getType() && !empty($post->getSidecarMedias())){
			foreach ($post->getSidecarMedias()  as $item ) {
				$width = max(array_keys($item->getThumbnailResources()));
				$max_thumbnail = $item->getThumbnailResources()[$width];
				$tc->carousel[] = $this->createMedia($max_thumbnail->url, $max_thumbnail->width, $max_thumbnail->height, Media::TYPE_IMAGE == $item->getType() ? Media::TYPE_IMAGE : 'video/mp4', true);
			}
			$tc->media = $tc->carousel[0];
		}
		else if (Media::TYPE_CAROUSEL == $post->getType() && !empty($post->getCarouselMedia())){
			foreach ($post->getCarouselMedia()  as $item ) {
				$width = max(array_keys($item->getThumbnailResources()));
				$max_thumbnail = $item->getThumbnailResources()[$width];
				$tc->carousel[] = $this->createMedia($max_thumbnail->url, $max_thumbnail->width, $max_thumbnail->height, Media::TYPE_IMAGE == $item->getType() ? Media::TYPE_IMAGE : 'video/mp4', true);
			}
			$tc->media = $tc->carousel[0];
		}
		else {
			$tc->media = $this->createMedia($max_thumbnail->url, $max_thumbnail->width, $max_thumbnail->height, Media::TYPE_IMAGE, true);
		}
		$tc->text = $this->getCaption($post->getCaption());
		$tc->userlink = 'http://instagram.com/' . $tc->nickname;
		$tc->permalink = $post->getLink();
		if (!empty($post->getLocation())) $tc->location = (object)$post->getLocation();
		$tc->additional = array('likes' => (string)$post->getLikesCount(), 'comments' => (string)$post->getCommentsCount());

		return $tc;
	}

	private function getCarousel($post){
		$carousel = array();
		foreach ($post->carousel_media as $item){
			$carousel[] = $this->getMediaContent($item);
		}
		return $carousel;
	}
	
	private function getMediaContent($item){
		if (isset($item->type) && $item->type == 'video' && isset($item->videos)){
			return array('type' => 'video/mp4', 'url' => $item->videos->standard_resolution->url,
				'width' => 600,
				'height' => FFFeedUtils::getScaleHeight(600, $item->videos->standard_resolution->width, $item->videos->standard_resolution->height));
		} else {
			return $this->createMedia($item->images->standard_resolution->url,
				$item->images->standard_resolution->width, $item->images->standard_resolution->height);
		}
	}

	private function getCaption($text){
		$text = FFFeedUtils::removeEmoji( (string) $text );
		return $this->hashtagLinks($text);
	}

	protected function nextPage( $result ) {
		if ($this->pagination){
			$size = sizeof($result);
			if ($size == $this->size) {
				return false;
			}
			else {
				$this->size = $size;
				return $this->getCount() > $size;
			}
		}
		return false;
	}

	private function hashtagLinks($text) {
		$result = preg_replace('~(\#)([^\s!,. /()"\'?]+)~', '<a href="https://www.instagram.com/explore/tags/$2">#$2</a>', $text);
		return $result;
	}

	private function fillUser($username){
		$account = $this->getAccount($username);
		$result = new \stdClass();
		$result->username = $account->getUsername();
		$result->full_name = $account->getFullName();
		$result->id = $account->getId();
		$result->bio = $account->getBiography();
		$result->website = $account->getExternalUrl();
		$result->counts = new \stdClass();
		$result->counts->media = $account->getMediaCount();
		$result->counts->follows = $account->getFollowsCount();
		$result->counts->followed_by = $account->getFollowedByCount();
		$result->profile_picture = $account->getProfilePicUrlHd();
		return $result;
	}

	/**
	 * @param string $username
	 *
	 * @return \InstagramAPI\Model\Account
	 */
	private function getAccount($username){
		if (!array_key_exists($username, $this->accounts)){
			$this->accounts[$username] = $this->getApi()->getAccount($username);
		}
		return $this->accounts[$username];
	}
}