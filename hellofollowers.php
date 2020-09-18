<?php

/**
 * Plugin Name: Hello Followers - Social Counter Plugin for WordPress
 * Description: Hello Followers is social counter plugin for WordPress that allows you easy to add links to your social profiles with displaying number of followers using more that 16 templates and different layouts
 * Plugin URI: https://codecanyon.net/item/hello-followers-social-counter-plugin-for-wordpress/15801729?ref=appscreo
 * Version: 2.5
 * Author: CreoApps
 * Author URI: http://codecanyon.net/user/appscreo/portfolio?ref=appscreo
 */


if (! defined ( 'WPINC' ))
	die ();

define ( 'HFOLLOW_VERSION', '2.5' );
define ( 'HFOLLOW_PLUGIN_ROOT', dirname ( __FILE__ ) . '/' );
define ( 'HFOLLOW_PLUGIN_URL', plugins_url () . '/' . basename ( dirname ( __FILE__ ) ) );
define ( 'HFOLLOW_PLUGIN_BASE_NAME', plugin_basename ( __FILE__ ) );
define ( 'HFOLLOW_OPTIONS_NAME', 'hello-followers');

class HelloFollowers {
	
	private $factory = array();
	
	private static $_instance;
	
	private $settings;
	
	public function __construct() {
		add_action( 'init', array( &$this, 'on_init' ), 9);
		add_action( 'plugins_loaded', array( &$this, 'on_plugins_loaded' ), 9);		

	}
	
	/**
	 * Get static instance of class
	 *
	 * @return HelloFollowers
	 */
	public static function getInstance() {
		if ( ! ( self::$_instance instanceof self ) ) {
			self::$_instance = new self();
		}
	
		return self::$_instance;
	}
	
	/**
	 * Cloning disabled
	 */
	public function __clone() {
	}
	
	/**
	 * Serialization disabled
	 */
	public function __sleep() {
	}
	
	/**
	 * De-serialization disabled
	 */
	public function __wakeup() {
	}	

	/**
	 * on_init
	 * 
	 * Execute main plugin component on init
	 */
	public function on_init() {
		
		$this->factory_activate('hf', 'HFSocialFollowersCounter');
		
		if (is_admin()) {
			$this->as_admin();
		}
	}
	
	public function on_plugins_loaded() {
		include_once HFOLLOW_PLUGIN_ROOT.'lib/hf-core-includes.php';
		include_once (HFOLLOW_PLUGIN_ROOT . 'lib/profile-analytics/hf-profile-analytics.php');
		load_plugin_textdomain( 'hellofollowers', false, HFOLLOW_PLUGIN_ROOT . 'locate' );
		$this->load_settings();
	}
	
	public function followers() {
		if (!isset($this->factory['hf'])) {
			$this->factory['hf'] = new HFSocialFollowersCounter;
		}
		
		return $this->factory['hf'];
	}
	
	/**
	 * as_admin
	 * 
	 * Execute admin part of code (settings and plugin setup)
	 */
	private function as_admin() {
		include_once (HFOLLOW_PLUGIN_ROOT . 'lib/admin/hf-admin-includes.php');
		
		// Activate main plugin instance
		$this->factory_activate('hfadmin', 'HelloFollowersAdmin');
		
		
	}
	
	private function factory_activate($component, $class_name) {
		if (!isset($this->factory[$component])) {
			$this->factory[$component] = new $class_name;
		}		
	}
	
	private function load_settings() {
		$this->settings = get_option(HFOLLOW_OPTIONS_NAME);
				
		if (!$this->settings) {
			$this->settings = array();
			
			$default_options = HFSocialFollowersCounterHelper::options_structure();
			$default_options = HFSocialFollowersCounterHelper::create_default_options_from_structure($default_options);
			
			$this->settings = $default_options;
			update_option(HFOLLOW_OPTIONS_NAME, $default_options);
		}
	}
	
	public function options_value($param, $default = '') {
		if (strpos($param, 'hellofollowers_') !== true) {
			$param = 'hellofollowers_'.$param;
		}
		
		return isset ( $this->settings [$param] ) ? $this->settings [$param]  : $default;
	}
	
	public function options_bool_value($param) {
		if (strpos($param, 'hellofollowers_') !== true) {
			$param = 'hellofollowers_'.$param;
		}
		
		$value = isset ( $this->settings [$param] ) ? $this->settings [$param]  : 'false';
	
		if ($value == "true") {
			return true;
		}
		else {
			return false;
		}
	}
	
	public function options() {
		if (isset($this->settings)) {
			return $this->settings;
		}
		else {
			return array();
		}
	}
}

global $hellofollowers_manager;
if (!$hellofollowers_manager) {
	$hellofollowers_manager = HelloFollowers::getInstance();
}
