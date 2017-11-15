<?php
/*
	Plugin Name: Animated Infinite Scroll - WordPress Plugin
	Description: Animate your WordPress content on page scroll. Make your WordPress theme animataed. CSS3 transition available. Lots of Animation style available. Unlimited jQuery selector.
	Plugin URI: http://www.sbthemes.com/plugins/scroll-animation-wordpress-plugin/
	Version: 1.1
	Author: SB Themes
	Author URI: http://codecanyon.net/user/sbthemes/portfolio?ref=sbthemes
*/

function sbis_init() {
	ob_start();
}
add_action('init', 'sbis_init');
require_once('admin/sb-admin-panel.php');
class SB_Infinite_Scroll {
	
	public $plugin_version 	= '1.0';
	public $db_version 		= '1.0';
	public $plugin_name 	= 'Animated Infinite Scroll';
	public $menu_text 		= 'Animated Infinite Scroll';
	public $plugin_slug 	= 'sb-infinite-scroll';
	public $setting_table 	= 'sb_infinite_scroll';

	public $plugin_dir_url;
	public $plugin_dir_path;

	public $sb_admin;
	public $animation_styles;
	
	//Initialize plugin
	function __construct() {
		
		$this->plugin_dir_url 	= plugin_dir_url(__FILE__);
		$this->plugin_dir_path 	= plugin_dir_path(__FILE__);
		
		$this->sb_admin   = new SB_Infinite_Scroll_Admin($this);
		
		add_filter('plugin_action_links', array($this, 'sb_plugin_action_links'), 10, 2);		//Add settings link in plugins page
		register_activation_hook(__FILE__, array($this, 'sb_active_plugin'));					//Plugin Activation Hook
		add_action('wp_enqueue_scripts', array($this, 'sb_enqueue_scripts'));					//Including Required Scripts for Frontend
		add_action('wp_footer', array($this, 'print_script_in_footer'));										//Add script in footer
	}
	
	//Plugin Activation Hook
	function sb_active_plugin() {
		global $wpdb;
		
		$table = $wpdb->prefix . 'sb_infinite_scroll';
	
		$charset_collate = '';
		if ( ! empty( $wpdb->charset ) ) {
			$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS $table (
		  `id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `status` int(2) DEFAULT NULL,
		  `title` varchar(1000) DEFAULT NULL,
		  `pagination_type` varchar(30) DEFAULT NULL,
		  `content_selector` varchar(1000) DEFAULT NULL,
		  `navigation_selector` varchar(1000) DEFAULT NULL,
		  `next_selector` varchar(1000) DEFAULT NULL,
		  `body_class` varchar(1000) DEFAULT NULL,
		  `item_selector` varchar(1000) DEFAULT NULL,
		  `buffer_pixels` int(10) DEFAULT NULL,
		  `scrolltop` int(2) DEFAULT NULL,
		  `scrollto` varchar(1000) DEFAULT NULL,
		  `loading_message` varchar(1000) DEFAULT NULL,
		  `finished_message` varchar(1000) DEFAULT NULL,
		  `loading_wrapper_class` varchar(1000) DEFAULT NULL,
		  `loading_image` varchar(1000) DEFAULT NULL,
		  `load_more_button_text` varchar(1000) DEFAULT NULL,
		  `load_more_button_class` varchar(1000) DEFAULT NULL,
		  `animation` varchar(50) DEFAULT NULL,
		  `onstart` longtext,
		  `onfinish` longtext,
		  `miscellaneous` longtext,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM  $charset_collate;";
		
		//Adding table to database
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
		
		//Adding DB Version to database
		update_option('sbis_db_version', $this->db_version);
		
	}
	
	//Add settings link in plugins page
	function sb_plugin_action_links($links, $file) {
		if ($file == plugin_basename( __FILE__ )) {
			$sbsa_links = '<a href="'.get_admin_url().'options-general.php?page='.$this->plugin_slug.'">'.__('Settings').'</a>';
			// Make the 'Settings' link appear first
			array_unshift( $links, $sbsa_links );
		}
		return $links;
	}
	
	//Including Required Scripts on Frontend
	function sb_enqueue_scripts() {
		wp_enqueue_style('sb-style', $this->plugin_dir_url.'assets/css/sbsa.css', array(), $this->plugin_version);
		wp_enqueue_style('sb-animate-style', $this->plugin_dir_url.'assets/css/animate.css', array(), $this->plugin_version);
		wp_enqueue_script('jquery');
		
	}
	
	//Get Animation Style Array
	function get_animation_style() {
		require_once $this->plugin_dir_path.'/includes/sb-animation-styles.php';
		return $this->animation_styles;
	}
	
	//Print script in footer
	function print_script_in_footer() {
		require_once $this->plugin_dir_path.'/includes/sbis.js.php';
	}
	
}
$sb_infinite_scroll = new SB_Infinite_Scroll();


