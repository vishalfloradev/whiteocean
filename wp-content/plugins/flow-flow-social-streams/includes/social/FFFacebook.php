<?php namespace flow\social;
use flow\cache\LAFacebookCacheManager;
use flow\db\FFDB;
use flow\db\LADBManager;

if ( !defined( 'WPINC' ) ) die;
if ( !defined('FF_FACEBOOK_RATE_LIMIT') ) define('FF_FACEBOOK_RATE_LIMIT', 200);
/**
 * Flow-Flow.
 *
 * @package   FlowFlow
 * @author    Looks Awesome <email@looks-awesome.com>

 * @link      http://looks-awesome.com
 * @copyright 2014-2016 Looks Awesome
 */
class FFFacebook extends FFHttpRequestFeed{
    const API_VERSION = 'v3.3';

    /** @var  string | bool */
    private $accessToken;
    /** @var bool */

    private $hideStatus = true;
    private $image;
    private $media;
    private $images;

    private $hasHitLimit = false;
    private $creationTime;
    private $request_count = 0;
    private $global_request_count;
    private $global_request_array;

    private $new_post_ids;

    public function __construct() {
        parent::__construct( 'facebook' );
    }

    protected function deferredInit($options, $feed) {
        $this->images = array();
        if (isset($feed->{'timeline-type'})) {
            $timeline = $feed->{'timeline-type'} == 'user_timeline' ? 'page_timeline' : $feed->{'timeline-type'};
            $locale = defined('FF_LOCALE') ? 'locale=' . FF_LOCALE : 'locale=en_US';
            $api = FFFacebook::API_VERSION;
            switch ($timeline) {
                case 'page_timeline':
                    $page_id = (string)$feed->content;

                    $request = $this->getFeedData("https://graph.facebook.com/{$api}/me/accounts?access_token={$this->accessToken}");
                    $json = json_decode($request['response']);
                    if($json->data) {
                        foreach ( $json->data as $item ) {
                            if ($page_id == $item->id) {
                                $this->accessToken = $item->access_token;
                                $page_id = 'me';
                                break;
                            }
                        }
                    }


                    $fields    = 'fields=';
                    $fields    = $fields . 'likes.summary(true),comments.summary(true),shares,permalink_url,';
                    $fields    = $fields . 'id,created_time,from,message,picture,full_picture,attachments,status_type,story';
                    $this->url = "https://graph.facebook.com/{$api}/{$page_id}/posts?{$fields}&limit={$this->getCount()}&{$locale}";
                    $this->hideStatus = false;
                    break;
                case 'album':
                    $fields    = 'fields=';
                    $fields    = $fields . 'likes.summary(true),comments.summary(true),';
                    $fields    = $fields . 'id,created_time,from,link,name,picture,source,images';
                    $albumId = (string)$feed->content;
                    $this->url = "https://graph.facebook.com/{$api}/{$albumId}/photos?{$fields}&limit={$this->getCount()}&{$locale}";
                    break;
            }
        }
    }

    protected function beforeProcess() {
        /** @var LAFacebookCacheManager $facebookCache */
        $facebookCache = $this->context['facebook_cache'];
        /** @var LADBManager $db */
        $db = $this->context['db_manager'];

        $this->accessToken = $facebookCache->getAccessToken();
        if ($this->accessToken === false){
            $this->errors[] = $facebookCache->getError();
            return false;
        }

        if (FFDB::beginTransaction()){
            $limit = $db->getOption('fb_limit_counter', true, true);
            if ($limit === false){
                @$db->setOption('fb_limit_counter', array(), true, false);
                $limit = $db->getOption('fb_limit_counter', true, true);
            }

            if (!is_array($limit)){
                $this->errors[] = array( 'type' => 'facebook', 'message' => 'Can`t save `fb_limit_counter` option to mysql db.' );
                FFDB::rollback();
                return false;
            }

            $this->creationTime = time();
            $this->global_request_count = 0;
            $limitTime = $this->creationTime - 3600;
            $result = array();
            foreach ( $limit as $time => $count ) {
                if ($time > $limitTime) {
                    $result[$time] = $count;
                    $this->global_request_count += (int)$count;
                }
            }
            $this->global_request_array = $result;

            if ($this->global_request_count + 4 > FF_FACEBOOK_RATE_LIMIT) {
                $this->errors[] = array( 'type' => 'facebook', 'message' => 'Your site has hit the Facebook API rate limit. <a href="http://docs.social-streams.com/article/133-facebook-app-request-limit-reached" target="_blank">Troubleshooting</a>.' );
                FFDB::rollback();
                return false;
            }
        }
        else {
            $this->errors[] = array( 'type' => 'facebook', 'message' => 'Can`t get mysql transaction.' );
            FFDB::rollback();
            return false;
        }
        return true;
    }

    protected function afterProcess( $result ) {
        /** @var LADBManager $db */
        $db = $this->context['db_manager'];

        if ($this->request_count > 0) {
            $this->global_request_array[$this->creationTime] = $this->request_count;
        }
        $db->setOption('fb_limit_counter', $this->global_request_array, true, false);
        FFDB::commit();
        return parent::afterProcess( $result );
    }

    protected function getUrl() {
        return $this->getUrlWithToken($this->url);
    }

    protected function items( $request ) {
        $pxml = json_decode($request);
        if (isset($pxml->data)) {
            /** @var LADBManager $db */
            $db = $this->context['db_manager'];
            $ids = $db->getIdPosts($this->id());
            $new_ids = array();
            foreach ( $pxml->data as $item ) {
                $new_ids[] = $this->getId($item);
            }
            $this->new_post_ids = array();
            $diff = array_diff($new_ids, $ids);
            foreach ( $diff as $id ) {
                $this->new_post_ids[$id] = 1;
            }

            return $pxml->data;
        }
        return array();
    }

    protected function isSuitableOriginalPost( $post ) {
        if (!isset($post->created_time)) return false;

        if (isset($post->status_type) && $post->status_type == 'mobile_status_update' && empty($post->message)) return false;

        if ($this->hasHitLimit) return false;
        if ($this->global_request_count + $this->request_count + 3 > FF_FACEBOOK_RATE_LIMIT) {
            $this->errors[] = array( 'type' => 'facebook', 'message' => 'Your site has hit the Facebook API rate limit. <a href="http://docs.social-streams.com/article/133-facebook-app-request-limit-reached" target="_blank">Troubleshooting</a>.' );
            $this->hasHitLimit = true;
            return false;
        }

        return true;
    }

    protected function isNewPost( $post ) {
        return array_key_exists($this->getId($post), $this->new_post_ids);
    }

    protected function prepare( $item ) {
        $this->image = null;
        $this->media = null;
        return parent::prepare( $item );
    }

    protected function getHeader($item) {
        if (!isset($item->type) || (isset($item->status_type) && $item->status_type == 'added_photos')){
            return '';
        }
        if (isset($item->name)){
            return $item->name;
        }
        return '';
    }

    protected function showImage($item){

        if (isset($item->images)){
            $this->image = $this->createImage($item->images[0]->source, $item->images[0]->width, $item->images[0]->height);
            return true;
        }

        if (isset($item->attachments) && isset($item->attachments->data) && sizeof($item->attachments->data) > 0){
            $subattachments = $this->getSubattachments($item);
            if (sizeof($subattachments) > 0){
                $image = $subattachments[0];
                $this->image = $this->createImage($image->src, $image->width, $image->height);
                return true;
            }
        }

        return false;
    }

    protected function getImage( $item ) {
        return $this->image;
    }

    protected function getMedia( $item ) {
        return $this->media;
    }

    protected function getScreenName($item){
        return $item->from->name;
    }

    //TODO going to use a message_tags attribute
    protected function getContent($item){
        if (!isset($item->type) && isset($item->name)) return (string)$item->name;
        if (isset($item->message)) return self::wrapHashTags(FFFeedUtils::wrapLinks($item->message), $item->id);
        if (isset($item->story)) return (string)$item->story;
        return '';
    }

    protected function getProfileImage( $item ) {
        $url = "https://graph.facebook.com/" . FFFacebook::API_VERSION . "/{$item->from->id}/picture?width=80&height=80";
        if (!array_key_exists($url, $this->images)){
            $this->images[$url] = $this->getLocation($url);
        }
        return $this->images[$url];
    }

    protected function getId( $item ) {
        return $item->id;
    }

    protected function getSystemDate( $item ) {
        return strtotime($item->created_time);
    }

    protected function getUserlink( $item ) {
        return 'https://www.facebook.com/'.$item->from->id;
    }

    protected function getPermalink( $item ) {
        if (isset($item->link)){
            return $item->link;
        }
        $parts = explode('_', $item->id);
        return 'https://www.facebook.com/'.$parts[0].'/posts/'.$parts[1];
    }

    protected function getAdditionalInfo( $item ) {
        $additional = parent::getAdditionalInfo( $item );
        $additional['likes']      = (string)@$item->likes->summary->total_count;
        $additional['comments']   = (string)@$item->comments->summary->total_count;
        $additional['shares']     = isset($item->shares) ? (string)@$item->shares->count : '0';
        return $additional;
    }

    protected function customize( $post, $item ) {
        if (isset($item->attachments->data[0]->media_type) && $item->attachments->data[0]->media_type == 'link' && isset($item->attachments->data[0]->unshimmed_url) && strlen($item->attachments->data[0]->unshimmed_url) < 300){
            $post->source = $item->attachments->data[0]->unshimmed_url;
        }
        return parent::customize( $post, $item );
    }

    /**
     * @param string $text
     * @param string $id
     *
     * @return mixed
     */
    private function wrapHashTags($text, $id){
        //return preg_replace('/#([\\d\\w]+)/', '<a href="https://www.facebook.com/hashtag/$1?source=feed_text&story_id='.$id.'">$0</a>', $text);//old
        return preg_replace("/#([A-Za-z0-9ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöùúûüýÿ\/\.]*)/u", "<a href=\"https://www.facebook.com/hashtag/$1?source=feed_text&story_id='.$id.'\">#$1</a>", $text);
    }

    private function getLocation($url, $with_token = true) {
        if (defined('FF_DONT_USE_GET_HEADERS') && FF_DONT_USE_GET_HEADERS){
            $location = @$this->getCurlLocation($this->getUrlWithToken( $url ));
            if (!empty($location) && $location != 0) {
                return $location;
            }
        }
        else {
            $headers = $this->getHeadersSafe($with_token ? $this->getUrlWithToken( $url ) : $url , 1);
            if (isset($headers["Location"])) {
                return $headers["Location"];
            } else {
                $location = @$this->getCurlLocation($with_token ? $this->getUrlWithToken( $url ) : $url);
                if (!empty($location) && $location != 0) {
                    return $location;
                }
            }
        }

        $location = str_replace('/v2.3/', '/', $url);
        $location = str_replace('/v2.4/', '/', $location);
        $location = str_replace('/v2.5/', '/', $location);
        $location = str_replace('/v2.6/', '/', $location);
        $location = str_replace('/v2.7/', '/', $location);
        $location = str_replace('/v2.8/', '/', $location);
        $location = str_replace('/v2.9/', '/', $location);
        return $location;
    }

    private function getCurlLocation($url) {
        $curl = curl_init();
        curl_setopt_array( $curl, array(
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36',
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL => $url ) );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT_MS, 5000);
        curl_setopt( $curl, CURLOPT_TIMEOUT, 60);
        $headers = explode( "\n", curl_exec( $curl ) );
        curl_close( $curl );

        $location = '';
        foreach ( $headers as $header ) {
            if (strpos($header, "ocation:")) {
                $location = substr($header, 10);
                break;
            }
        }
        return $location;
    }

    private function getHeadersSafe($url, $format){
        if ( ini_get( 'allow_url_fopen' ) ) {
            return get_headers( $url, $format );
        } else {
            $ch = curl_init( $url );
            curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_HEADER, true );
            curl_setopt( $ch, CURLOPT_NOBODY, true );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT_MS, 5000);
            curl_setopt( $ch, CURLOPT_TIMEOUT, 60);
            $content = curl_exec( $ch );
            curl_close( $ch );
            return array($content);
        }
    }

    private function getUrlWithToken($url){
        $this->request_count++;
        $token = $this->accessToken;
        return $url . "&access_token={$token}";
    }

    private function getSubattachments($item){
        $attachments = array();
        if (isset($item->attachments) && isset($item->attachments->data) && sizeof($item->attachments->data) > 0){
            $data = $item->attachments->data[0];
            if (isset($data->media->image)){
                $attachments[] = $data->media->image;
            }
            if (isset($data->subattachments) && isset($data->subattachments->data)){
                foreach ($data->subattachments->data as $el){
                    $attachments[] = $el->media->image;
                }
            }
        }
        return $attachments;
    }
}