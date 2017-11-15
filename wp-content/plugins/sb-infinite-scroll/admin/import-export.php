<?php
	if($_POST['action'] == 'json_import_export_settings') {
		$settings = $this->get_infinite_scroll_settings('ARRAY_A');
		$import_data = array();
		$json_file = $this->parent->plugin_dir_path.'export.json';
		$fp = fopen($json_file, 'w');
		
		if($settings) {
			foreach($settings as $setting) {
				unset($setting['id']);
				array_push($import_data, $setting);
			}
		}
		fwrite($fp, json_encode($import_data));
		fclose($fp);
		?>
		<div id="import-box">
			<a target="_blank" class="button-primary sb-btn" href="<?php echo $this->parent->plugin_dir_url.'export.json?'.time(); ?>">Click here to export settings in JSON Format</a>
			<div class="clear"></div>
			<br>
			<hr>
			<form id="frm-json-import-settings" method="post" action="">
				<p><strong>Note:</strong> Import settings will not affect your current settings. It will add all settings as new.</p>
				<p>Paste JSON string to import settings</p>
				<textarea name="json_string" placeholder="Paste JSON string here"></textarea>
				<input type="hidden" name="action" value="json_import_settings">
				<input type="submit" value="Import Settings" class="button-primary sb-btn import-is-setting alignleft">
				<img class="ajax-loader" src="<?php echo $this->parent->plugin_dir_url; ?>assets/img/ajax-loader.gif" alt="Importing..." />
			</form>
		</div><?php
	} else if ($_POST['action'] == 'csv_import_export_settings') {
		$settings = $this->get_infinite_scroll_settings('ARRAY_A');
		$import_data = array();
		$json_file = $this->parent->plugin_dir_path.'export.csv';
		$fp = fopen($json_file, 'w');
		
		fputcsv($fp, array('Status', 'Title', 'Pagination Type', 'Content Selector', 'Navigation Selector', 'Next Selector', 'Unique Body Class', 'Item Selector', 'Buffer Pixels', 'Scroll Top', 'Scroll To', 'Loading Message', 'Finished Message', 'Loading Wrapper Class', 'Loading Image', 'Load More Button Text', 'Load More Button Class', 'Animation'));
		if($settings) {
			foreach($settings as $setting) {
				unset($setting['id']);
				unset($setting['onstart']);
				unset($setting['onfinish']);
				fputcsv($fp, $setting);
			}
		}
		fclose($fp);
		?>
		<div id="import-box">
			<a target="_blank" class="button-primary sb-btn" href="<?php echo $this->parent->plugin_dir_url.'export.csv?'.time(); ?>">Click here to export settings in CSV Format</a>
			<div class="clear"></div>
			<br>
			<hr>
			<form id="frm-csv-import-settings" method="post" action="" enctype="multipart/form-data">
				<p><strong>Note:</strong> Import settings will not affect your current settings. It will add all settings as new.</p>
                <p><strong>Advanced Settings (On Pagination Start and On Pagination End)</strong> will not be exported with csv format. You can use JSON Import / Export for these fields.</p>
                <p><strong>First row in CSV file will be ignored.</strong></p>
                <p>Select csv file to import settings.</p>
				<input type="file" name="csv_import" />
				<input type="hidden" name="action" value="csv_import_settings">
				<input style="margin-top:10px;" type="submit" value="Import Settings" class="button-primary sb-btn import-is-setting alignleft">
				<img class="ajax-loader" src="<?php echo $this->parent->plugin_dir_url; ?>assets/img/ajax-loader.gif" alt="Importing..." />
			</form>
		</div><?php
	}
    
    
    
    
    
    
    
    
    
    
    
    
    
    