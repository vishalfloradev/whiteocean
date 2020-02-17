<?php namespace flow;

use la\core\LAActivatorBase;
use flow\db\FFDBMigrationManager;
use flow\db\FFDBManager;
use flow\cache\FFFacebookCacheAdapter;
use flow\db\FFDB;

class FlowFlowActivator extends LAActivatorBase{
    public function __construct($file){
        parent::__construct($file);

        add_action( 'admin_footer', array( $this, 'add_deactivation_feedback_dialog_box' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'add_deactivation_scripts' ) );
    }
	/**
	 * Use this method fpr old php version
	 * @deprecated
	 */
	public function initWPWidget(){
		register_widget(new FlowFlowWPWidget($this->context));
	}
	
	/**
	 * Use this method fpr old php version
	 * @deprecated
	 */
	public function initVCIntegration(){
		$db = $this->context['db_manager'];
		
		//Important!
		//It will be execute before migrations!
		//Need to check exist tables and fields!
		$streams = array();
		if (FFDB::existTable($db->streams_table_name)) $streams = FFDB::streams($db->streams_table_name);
		
		$stream_options = array();
		if(sizeof($streams)){
			foreach($streams as $id => $stream){
				$stream_options['Stream #' . $id . ( $stream['name'] ? ' - ' . $stream['name'] : '')] = $id;
			}
		}
		vc_map( array(
				"name" => __("Social Stream"),
				'admin_enqueue_css' => array($this->context['plugin_url'] . $this->context['slug'] . '/css/admin-icon.css'),
				'front_enqueue_css' => array($this->context['plugin_url'] . $this->context['slug'] . '/css/admin-icon.css'),
				'icon' => 'streams-icon',
				"description" => __("Flow-Flow plugin social stream"),
				"base" => "ff",
				"category" => __('Social'),
				"weight" => 0,
				"params" => array(
						array(
								'type' => 'dropdown',
								'class' => '',
								'admin_label' => true,
								"holder" => "div",
								"class" => "",
								"heading" => __("Choose stream to place on page:" ),
								"description" => "Please create and edit stream on plugin's page.",
								"param_name" => "id",
								"value" => $stream_options,
								"std" => '--'
						)
				)
		));
	}
	
	protected function checkPlugin(){
		$mm = new FFDBMigrationManager($this->context);
		$mm->migrate();
		unset($mm);
	}
	
	protected function initContext($file){
		/** @var wpdb $wpdb */
		$wpdb = $GLOBALS['wpdb'];
		
		$context = array(
				'root'              => plugin_dir_path($file),
				'slug'              => 'flow-flow',
				'slug_down'         => 'flow_flow',
				'plugin_url'        => plugin_dir_url(dirname($file).'/'),
				'plugin_dir_name'   => basename(dirname($file)),
				'admin_url'         => admin_url('admin-ajax.php'),
				'table_name_prefix' => $wpdb->base_prefix . 'ff_',
				'version' 			=> '3.1.45',
				'faq_url' 			=> 'https://docs.social-streams.com/',
				'sub_url' 			=> 'https://buy.paddle.com/product/577487',
				'demo_pro' 			=> 'https://social-streams.com/flow/demo/classic-social-media-wall/',
				'boost_landing' 	=> 'https://social-streams.com/potential-features-poll/',
				'demo' 			    => 'https://social-streams.com/',
				'author_site' 		=> 'https://looks-awesome.com/',
                'deactivate_url' 	=> 'https://social-streams.com/services/rest/flow-flow/deactivate.php'
		);
		
		$adapter = new FFFacebookCacheAdapter();
		$context['facebook_cache'] = $adapter;
		$context['db_manager'] = new FFDBManager($context);
		$adapter->setContext($context);
		return $context;
	}
	
	protected function checkEnvironment(){

		if ( version_compare(PHP_VERSION, '5.6.20') == -1 ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			wp_die( '<b>Flow-Flow Social Stream</b> plugin requires PHP version 5.6.20 or higher. Please update your PHP version or ask hosting support to do this for you, you are using old and unsecure one' );
		}
		
		if ( !function_exists('curl_version') ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			wp_die( '<b>Flow-Flow Social Stream</b> plugin requires curl extension for php. Please install/enable this extension or ask your hosting to help you with this. <a href="https://www.php.net/manual/en/curl.setup.php">Installation guide</a>' );
		}
		
		if ( !function_exists('mysqli_connect') ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			wp_die( '<b>Flow-Flow Social Stream</b> plugin requires mysqli extension for MySQL. Please install/enable this extension on your server or ask your hosting to help you with this. <a href="http://php.net/manual/en/mysqli.installation.php">Installation guide</a>' );
		}
	}
	
	protected function singleSiteActivate() {
		$this->checkPlugin();
	}
	
	protected function singleSiteDeactivate() {
		wp_clear_scheduled_hook( 'flow_flow_load_cache' );
		wp_clear_scheduled_hook( 'flow_flow_load_cache_4disabled' );
	}
	
	protected function beforePluginLoad() {
		parent::beforePluginLoad();
		
		if (!defined('FF_AJAX_URL')) {
			$admin = function_exists('current_user_can') && current_user_can('manage_options');
			if (!$admin && defined('FF_ALTERNATE_GET_DATA') && FF_ALTERNATE_GET_DATA){
				$this->setContextValue('ajax_url', plugins_url( 'ff.php', __FILE__ ));
			}
			else {
				$this->setContextValue('ajax_url', admin_url('admin-ajax.php'));
			}
		}  else {
            $this->setContextValue('ajax_url', FF_AJAX_URL);
        }

    }
	
	protected function registrationCronActions() {
		$this->addCronInterval('minute', array('interval' => MINUTE_IN_SECONDS, 'display' => 'Every Minute'));
		$this->addCronInterval('six_hours', array('interval' => MINUTE_IN_SECONDS * 60 * 6, 'display' => 'Six hours'));
		add_filter('cron_schedules', array($this, 'getCronIntervals'));
		
		$time = time();
		$ff = FlowFlow::get_instance($this->context);
		
		add_action( 'flow_flow_load_cache', array($ff, 'refreshCache') );
		if ( false == wp_next_scheduled('flow_flow_load_cache') ) {
			wp_schedule_event( $time, 'minute', 'flow_flow_load_cache' );
		}
		
		add_action( 'flow_flow_load_cache_4disabled', array($ff, 'refreshCache4Disabled') );
		if ( false == wp_next_scheduled('flow_flow_load_cache_4disabled') ) {
			wp_schedule_event( $time, 'six_hours', 'flow_flow_load_cache_4disabled' );
		}
	}
	
	protected function registrationAjaxActions() {
		/** @var FFDBManager $dbm */
		$dbm = $this->context['db_manager'];
		$slug_down = $this->context['slug_down'];
		$ff = FlowFlow::get_instance($this->context);
		
		add_action('wp_ajax_fetch_posts', array( $ff, 'processAjaxRequest'));
		add_action('wp_ajax_nopriv_fetch_posts', array( $ff, 'processAjaxRequest'));
		add_action('wp_ajax_' . $slug_down . '_moderation_apply_action', array( $ff, 'moderation_apply'));
		add_action('wp_ajax_load_cache', array( $ff, 'processAjaxRequestBackground'));
		add_action('wp_ajax_nopriv_load_cache', array( $ff, 'processAjaxRequestBackground'));
		
		add_action('wp_ajax_' . $slug_down . '_social_auth',			array( $dbm, 'social_auth' ));
		add_action('wp_ajax_' . $slug_down . '_save_sources_settings',	array( $dbm, 'save_sources_settings' ));
		add_action('wp_ajax_' . $slug_down . '_get_stream_settings',	array( $dbm, 'get_stream_settings' ));
		add_action('wp_ajax_' . $slug_down . '_ff_save_settings',		array( $dbm, 'ff_save_settings_fn' ));
		add_action('wp_ajax_' . $slug_down . '_save_stream_settings',	array( $dbm, 'save_stream_settings' ));
		add_action('wp_ajax_' . $slug_down . '_create_stream',			array( $dbm, 'create_stream' ));
		add_action('wp_ajax_' . $slug_down . '_clone_stream',			array( $dbm, 'clone_stream' ));
		add_action('wp_ajax_' . $slug_down . '_delete_stream',			array( $dbm, 'delete_stream' ));
		
		if (!FF_USE_WP_CRON){
			add_action('wp_ajax_' . $slug_down . '_refresh_cache', array($ff, 'refreshCache'));
			add_action('wp_ajax_nopriv_' . $slug_down . '_refresh_cache', array($ff, 'refreshCache'));
		}

        add_action('wp_ajax_' . $slug_down . '_deactivate', array( $this, 'processDeactivateRequest'));
        add_action('wp_ajax_' . $slug_down . '_deactivate_ticket', array( $this, 'processDeactivateTicketRequest'));
	}
	
	protected function renderAdminSide() {
		new FlowFlowAdmin($this->context);
	}
	
	protected function renderPublicSide() {
		$ff = FlowFlow::get_instance($this->context);
		add_action('init',					array($ff, 'register_shortcodes'));
		add_action('init',					array($ff, 'load_plugin_textdomain'));
		add_action('wp_enqueue_scripts',	array($ff, 'enqueue_scripts'));
		add_action('wpmu_new_blog',			array($ff, 'activate_new_site'));
	}

	protected function afterPluginLoad() {
		add_action( 'widgets_init', array($this, 'initWPWidget'));
		add_action( 'vc_before_init', array($this, 'initVCIntegration'));
	}

    public function add_deactivation_feedback_dialog_box() {

        $screen = get_current_screen();

        if ( ! in_array( $screen->id, array( 'plugins.php' ) ) )
        {
			return;
        }

        $deactivate_reasons = array(
            1 => array(
                'id'    => 'plugin_is_hard_to_use_technical_problems',
                'text'  => __( 'Technical problems / hard to use', $this->context['slug'] ),
            ),
            2 => array(
                'id'    => 'free_version_limited',
                'text'  => __( 'Free version is limited', $this->context['slug'] ),
            ),
            3 => array(
                'id'    => 'premium_expensive',
                'text'  => __( 'Premium is expensive', $this->context['slug'] ),
            ),
            4 => array(
                'id'    => 'upgrading_to_paid_version',
                'text'  => __( 'Upgrading to paid version', $this->context['slug'] ),
            ),
            5 => array(
                'id'    => 'temporary_deactivation',
                'text'  => __( 'Not what I need', $this->context['slug'] ),
            ),
        );
        ?>
        <?php
        $deactivate_url =
            add_query_arg(
                array(
                    'action' => 'deactivate',
                    'plugin' => plugin_basename( $this->context['slug'] ) . '-social-streams' . '/flow-flow.php',
                    '_wpnonce' => wp_create_nonce( 'deactivate-plugin_' . plugin_basename( $this->context['slug'] ) . '-social-streams' .  '/flow-flow.php' )
                ),
                admin_url( 'plugins.php' )
            );
        require ( 'display_deactivation_popup.php' );
    }
    public function add_deactivation_scripts()
    {

        $screen = get_current_screen();

        if ( ! in_array( $screen->id, array( 'plugins.php' ) ) )
        {
            return;
        }

        wp_enqueue_style( 'ff-deactivate-popup', $this->context['plugin_url'] . $this->context['slug'] . '-social-streams/css/deactivate_popup.css', array(), $this->context['version'] );
        wp_enqueue_script( 'ff-deactivate-popup', $this->context['plugin_url'] . $this->context['slug'] . '-social-streams/js/deactivate_popup.js', array(), $this->context['version']);
        $admin_data = wp_get_current_user();
        wp_localize_script(  'ff-deactivate-popup', 'FF_Deactivate' , array(
            "prefix" => 'foo',
            "deactivate_class" => '_deactivate_link',
            "email" => $admin_data->data->user_email,
            "plugin" => $this->context['slug'],
            "slug_down" => $this->context['slug_down'],
            "parent_plugin" => 'flow-flow',
            "premium_url" => 'https://goo.gl/eLAjuZ',
            "plugin_url" => $this->context['plugin_url'],
            "version" => $this->context['version'],
            "admin_email" => get_option('admin_email'),
            "admin_url" => $this->context['admin_url']
        ));
    }

    public function processDeactivateRequest()
    {
        $url = $this->context['deactivate_url'];
        $data = array(
            'method' => 'POST',
            'timeout' => 45,
            'redirection' => 5,
            'body' => filter_var( trim( $_POST ), FILTER_SANITIZE_STRING )
        );
        $response = wp_remote_post($url, $data);
        if ( is_wp_error( $response ) ) {
            $error_message = $response->get_error_message();
            echo esc_html( "Something went wrong: $error_message" );
        } else {
            echo esc_html( $response['body'] );
        }
    }
    public function processDeactivateTicketRequest()
    {
		$to = 'support.43493.3a9e04eb9f5d9232@helpscout.net';
		$email = sanitize_email( $_POST['email'] );
		$subject = 'Flow-Flow Lite Issue';
		$message = sanitize_text_field( $_POST['message'] );
		$version = sanitize_text_field( $_POST['version'] );
		$content = "Plugin version: $version\r\n$message";
		$headers = array();
		$headers[] = 'From: ' . $email . ' <' . str_replace(array("\r", "\n", "\n", "\t", ",", ";"), '', $email. ">\r\n");
		$headers[] = 'Content-type: text/html';
		$headers[] = 'Reply-To: ' . $email;
		$response = wp_mail( $to, $subject, $content, $headers );

		if ( !$response ) {
			echo "Something went wrong";
		} else {
			echo esc_html( $response );
		}
    }
}