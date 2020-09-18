<?php 

if (! defined ( 'WPINC' ))
	die ();


define ( 'HFOLLOW_SPA_VERSION', '1.0' );
define ( 'HFOLLOW_SPA_PLUGIN_ROOT', dirname ( __FILE__ ) . '/' );
define ( 'HFOLLOW_SPA_PLUGIN_URL', plugins_url () . '/' . basename ( dirname ( __FILE__ ) ) );
define ( 'HFOLLOW_SPA_PLUGIN_BASE_NAME', plugin_basename ( __FILE__ ) );
define ( 'HFOLLOW_SPA_TEXT_DOMAIN', 'hfspa');
define ( 'HFOLLOW_SPA_TRACKER_TABLE', 'hellofollowers_spa');
define ( 'HFOLLOW_SPA_DBVERSION', '0.2');

include_once (HFOLLOW_SPA_PLUGIN_ROOT . 'lib/hf-helpers.php');
include_once (HFOLLOW_SPA_PLUGIN_ROOT . 'lib/hf-database.php');
include_once (HFOLLOW_SPA_PLUGIN_ROOT . 'lib/hf-followers-bridge.php');

class HFProfileAnalytics {
	private static $instance = null;
	public static function get_instance() {
	
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
	
		return self::$instance;
	
	} // end get_instance;
	
	
	function __construct() {
	
		if (is_admin()) {
			add_action ( 'admin_menu', 	array ($this, 'register_menu' ), 99 );
			add_action ( 'admin_enqueue_scripts', array ($this, 'register_admin_assets' ), 99 );
		}
	}
	
	public function register_menu() {
	
		$hellofollowers_access = "edit_pages";
		add_submenu_page( 'hellofollowers', esc_html__('Profile Analytics', 'hellofollowers'), ''.esc_html__('Profile Analytics', 'hellofollowers').'', $hellofollowers_access, 'hellofollowers_spa', array ($this, 'hellofollowers_spa_settings_redirect' ));
	}
	
	
	public function register_admin_assets($hook) {
		global $essb_admin_options;
	
		$requested = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";
		if ($requested == "hellofollowers_spa") {
			wp_register_style ( 'hfspa', HFOLLOW_PLUGIN_URL . '/lib/profile-analytics/assets/css/hfspa.css', array (), HFOLLOW_VERSION );
			wp_enqueue_style ( 'hfspa' );

			wp_register_style ( 'hfspa-morris', HFOLLOW_PLUGIN_URL . '/lib/profile-analytics/assets/css/morris.css', array (), HFOLLOW_VERSION );
			wp_enqueue_style ( 'hfspa-morris' );
				
			
			wp_enqueue_script ( 'hfspa-datepicker-moment', HFOLLOW_PLUGIN_URL . '/lib/profile-analytics/assets/js/moment.js', array ('jquery' ), HFOLLOW_VERSION, true );
			wp_enqueue_script ( 'hfspa-datepicker', HFOLLOW_PLUGIN_URL . '/lib/profile-analytics/assets/js/pikaday.js', array ('jquery' ), HFOLLOW_VERSION, true );
			wp_register_style ( 'hfspa-datepicker', HFOLLOW_PLUGIN_URL . '/lib/profile-analytics/assets/css/pikaday.css', array (), HFOLLOW_VERSION );
			wp_enqueue_style ( 'hfspa-datepicker' );				
			
			wp_register_style ( 'hfspa-datatable', HFOLLOW_PLUGIN_URL . '/lib/profile-analytics/assets/css/datatable/jquery.dataTables.css', array (), HFOLLOW_VERSION );
			wp_enqueue_style ( 'hfspa-datatable' );
			wp_enqueue_script ( 'hfspa-datatable', HFOLLOW_PLUGIN_URL . '/lib/profile-analytics/assets/css/datatable/jquery.dataTables.js', array ('jquery' ), HFOLLOW_VERSION, true );

			wp_enqueue_script ( 'hfspa-morris', HFOLLOW_PLUGIN_URL . '/lib/profile-analytics/assets/js/morris.js', array ('jquery' ), HFOLLOW_VERSION, true );
			wp_enqueue_script ( 'hfspa-raphael', HFOLLOW_PLUGIN_URL . '/lib/profile-analytics/assets/js/raphael-min.js', array ('jquery' ), HFOLLOW_VERSION, true );
		}
	}
	
	public function hellofollowers_spa_settings_redirect() {
		include_once (HFOLLOW_SPA_PLUGIN_ROOT . 'lib/view/hf-view-home.php');
	}
	
	public static function install() {
		global $wpdb;
	
		$sql = "";
	
		$table_name = $wpdb->prefix . HFOLLOW_SPA_TRACKER_TABLE;
	
		$sql .= "CREATE TABLE $table_name (
		hfspa_id mediumint(11) NOT NULL AUTO_INCREMENT,
		hfspa_date date NOT NULL,
		hfspa_network varchar(40) NOT NULL,
		hfspa_profile varchar(250) NOT NULL,
		hfspa_value varchar(50)  NOT NULL,
		hfspa_lastupdate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		UNIQUE KEY hfspa_id (hfspa_id)
		); ";
	
		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta ( $sql );
	}
	
	public static function activate () {
		HFProfileAnalytics::install();
		
		if (class_exists('HFFollowersCounterBridge')) {
			HFFollowersCounterBridge::log_profile_values_on_install();
		}
	}
}

global $hellofollowers_spa;
function HFOLLOW_SPA() {
	global $hellofollowers_spa;
	$hellofollowers_spa = HFProfileAnalytics::get_instance();
	
	if ( get_site_option( 'hellofollowers_spa' ) != HFOLLOW_SPA_DBVERSION ) {
		add_option('hellofollowers_spa', HFOLLOW_SPA_DBVERSION);
		HFProfileAnalytics::activate();
	}
}
HFOLLOW_SPA();

?>