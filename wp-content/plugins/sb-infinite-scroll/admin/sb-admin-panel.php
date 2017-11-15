<?php
/*
 * Plugin Admin Class : SB_Infinite_Scroll_Admin
 */

class SB_Infinite_Scroll_Admin {
	
	function __construct($parent) {
		$this->parent = $parent;
		add_action('admin_menu', array($this, 'sb_add_menu_page'));												//Add settings Page
		add_action('admin_enqueue_scripts', array($this, 'sb_admin_enqueue_scripts'));							//Including Required Scripts for Backend
		add_action('wp_ajax_save_infinite_scroll_settings', array($this, 'save_infinite_scroll_settings'));		//Fire ajax for add/update settings
		add_action('wp_ajax_remove_infinite_scroll_setting', array($this, 'remove_infinite_scroll_setting'));	//Fire ajax for remov settings
		add_action('wp_ajax_json_import_export_settings', array($this, 'json_import_export_settings'));			//Import Export Settings Form
		add_action('wp_ajax_json_import_settings', array($this, 'json_import_settings'));						//Import Settings
		add_action('wp_ajax_csv_import_export_settings', array($this, 'csv_import_export_settings'));			//Import Export Settings Form
		add_action('wp_ajax_csv_import_settings', array($this, 'csv_import_settings'));							//Import Settings
	}
	
	//Including Required Scripts for Backend
	function sb_admin_enqueue_scripts($hook) {
		//Prevent adding scripts if page is not plugin settings page
		$add_scripts_pages = array('settings_page_'.$this->parent->plugin_slug);
		if( !in_array($hook ,$add_scripts_pages) ) {
			return;
		}
		wp_enqueue_style('sb-admin-style', $this->parent->plugin_dir_url.'assets/css/sb-admin.css', array(), $this->parent->plugin_version);
		wp_enqueue_style('wp-jquery-ui-dialog');
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-dialog');
		wp_enqueue_media();
		wp_enqueue_script('jquery-form');
		wp_enqueue_script('sb-admin', $this->parent->plugin_dir_url.'assets/js/sb-admin.js', array(), $this->parent->plugin_version, true);
		wp_localize_script('sb-admin', 'SB', array('AJAX' => admin_url('admin-ajax.php')));
	}
	
	//Add settings Page
	function sb_add_menu_page() {
		add_submenu_page('options-general.php', $this->parent->menu_text, $this->parent->menu_text, 'manage_options', $this->parent->plugin_slug, array($this, 'sb_admin_settings_page'));
	}
	
	//Including Admin Settings Page File
	function sb_admin_settings_page() {
		require $this->parent->plugin_dir_path.'/admin/sb-admin-panel-form.php';
	}
	
	//Including Single Setting Box File
	function sb_admin_setting_box($id) {
		require $this->parent->plugin_dir_path.'/admin/sb-admin-panel-setting-box.php';
	}
	
	//Including Single Setting Box File
	function save_infinite_scroll_settings() {
		global $wpdb;
		$return = array();
		extract($_POST);
		
		$table = $wpdb->prefix.$this->parent->setting_table;
		$settings['title'] = sanitize_text_field($settings['title']);
		if(!isset($settings['status']))
			$settings['status'] = 0;
		if(!isset($settings['scrolltop']))
			$settings['scrolltop'] = 0;
		
		if($setting_id == 0) {
			$wpdb->insert($table, $settings);
			$return['id'] = $wpdb->insert_id;
		} else {
			$wpdb->update($table, $settings, array('id' => $setting_id));
			$return['id'] = $setting_id;
		}
		$return['after_save'] = $after_save;
		
		echo json_encode($return);
		die;
	}
	
	//Get All Settings
	function get_infinite_scroll_settings($type = 'OBJECT') {
		global $wpdb;
		$table = $wpdb->prefix.$this->parent->setting_table;
		return $wpdb->get_results("select * from ".$table." where 1", $type);
	}
	
	//Get Settings by id
	function get_infinite_scroll_setting($id) {
		global $wpdb;
		$table = $wpdb->prefix.$this->parent->setting_table;
		if($id != 0) {
			$setting = $wpdb->get_row($wpdb->prepare("select * from ".$table." where 1 and id = %d", $id), 'ARRAY_A');
			if(trim($setting['title']) != '')
				$setting['label'] = $setting['title'];
			else
				$setting['label'] = 'No Title';
		}
			
		if($id == 0 || !$setting) {
			$setting = array(
				'id'						=>	0,
				'status'					=>	1,
				'title'						=>	'',
				'label'						=>	'Add New',
				'pagination_type'			=>	'infinite_scroll',
				'content_selector'			=>	'',
				'navigation_selector'		=>	'',
				'next_selector'				=>	'',
				'body_class'				=>	'',
				'item_selector'				=>	'',
				'buffer_pixels'				=>	50,
				'scrolltop'					=>	0,
				'scrollto'					=>	'html,body',
				'loading_message'			=>	'Loading...',
				'finished_message'			=>	'No more posts available...',
				'loading_wrapper_class'		=>	'',
				'loading_image'				=>	$this->parent->plugin_dir_url.'assets/img/ajax-loader.gif',
				'load_more_button_text'		=>	'Load More',
				'load_more_button_class'	=>	'',
				'animation'					=>	'fadeIn',
				'onstart'					=>	'',
				'onfinish'					=>	''
			);
		}
		return $setting;
	}
	
	//Delete single settings by id
	function remove_infinite_scroll_setting() {
		global $wpdb;
		$id = $_POST['id'];
		$table = $wpdb->prefix.$this->parent->setting_table;
		$wpdb->delete($table, array('id' => $id), array('%d'));
		echo 1;
		die;
	}
	
	//Get Pagination Type
	function get_pagination_type() {
		return array(
			'infinite_scroll'		=>		'Infinite Scroll',
			'load_more_button'		=>		'Load More Button',
			'ajax_pagination'		=>		'Ajax Pagination'
		);
	}
	
	//Escape DB fields when display
	function sb_display_field($string) {
		return htmlspecialchars(stripslashes($string));
	}
	
	//JSON Import Export Settings
	function json_import_export_settings() {
		require $this->parent->plugin_dir_path.'/admin/import-export.php';
		die;
	}
		
	function json_import_settings() {
		global $wpdb;
		$table = $wpdb->prefix.$this->parent->setting_table;
		$error = 0;
		$json_string = $_POST['json_string'];;
		$settings = json_decode(stripslashes($json_string));
		if(is_array($settings)) {
			if(count($settings) > 0) {
				foreach($settings as $setting) {
					$insert = $wpdb->insert($table, (array)$setting);
					if(!$insert) {
						$error = 1;
					}
				}
			}
		} else {
			echo 'Invalid JSON format.';
			die;
		}
		if($error == 1)
			echo 'Some of records were not inserted. May be something is wrong with format.';
		else
			echo 'Settings Imported.';
		die;
	}
	
	//CSV Import Export Settings
	function csv_import_export_settings() {
		require $this->parent->plugin_dir_path.'/admin/import-export.php';
		die;
	}
	
	function csv_import_settings() {
		global $wpdb;
		$table = $wpdb->prefix.$this->parent->setting_table;
		$error = 0;
		if(isset($_FILES['csv_import'])) {
			$file = $_FILES['csv_import'];
			$ext = pathinfo($_FILES['csv_import']['name'], PATHINFO_EXTENSION);
			$settings = array();
			if($ext == 'csv') {
				$fp = fopen($file['tmp_name'], 'r');
				while(!feof($fp)) {
					array_push($settings, fgetcsv($fp));
				}
				if(count($settings) > 0) {
					$counter = 0;
					foreach($settings as $setting) {
						$counter++;
						if($counter != 1) {
							if(trim($setting[1]) != '') {
								$import = array(
									'status'					=>	$setting[0],
									'title'						=>	$setting[1],
									'pagination_type'			=>	$setting[2],
									'content_selector'			=>	$setting[3],
									'navigation_selector'		=>	$setting[4],
									'next_selector'				=>	$setting[5],
									'body_class'				=>	$setting[6],
									'item_selector'				=>	$setting[7],
									'buffer_pixels'				=>	$setting[8],
									'scrolltop'					=>	$setting[9],
									'scrollto'					=>	$setting[10],
									'loading_message'			=>	$setting[11],
									'finished_message'			=>	$setting[12],
									'loading_wrapper_class'		=>	$setting[13],
									'loading_image'				=>	$setting[14],
									'load_more_button_text'		=>	$setting[15],
									'load_more_button_class'	=>	$setting[16],
									'animation'					=>	$setting[17]
								);
								$insert = $wpdb->insert($table, (array)$import);
							}
						}
					}
				}
				
				$settings = array();
				if(is_array($settings)) {
					if(count($settings) > 0) {
						foreach($settings as $setting) {
							$insert = $wpdb->insert($table, (array)$setting);
							if(!$insert) {
								$error = 1;
							}
						}
					}
				} else {
					echo 'Invalid JSON format.';
					die;
				}
				if($error == 1)
					echo 'Some of records were not inserted. May be something is wrong with format.';
				else
					echo 'Settings Imported.';
			} else {
				echo 'Invalid file format. Only .csv extension allowed';
			}
		} else {
			echo 'Please select .csv file to import settings.';
		}
		die;
	}
}



