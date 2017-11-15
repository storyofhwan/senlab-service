<?php
/*
 * Plugin Admin Settings Panel
 */
	global $wpdb;	
	?>
    <div class="wrap" id="sbis-wrapper">
        <h2 class="title">
        	<img class="title-icon" src="<?php echo $this->parent->plugin_dir_url; ?>assets/img/logo-icon.jpg" alt="SB Themes" /> <?php echo $this->parent->plugin_name; ?>
            <a id="json-import-export-link" class="alignright button-primary sb-btn">JSON: Import / Export</a>
            <a id="csv-import-export-link" class="alignright button-primary sb-btn">CSV: Import / Export</a>
        </h2>
        <div class="clear"></div><br />
        <div class="sb-message">
        	Data Saved...
        </div>
        
        <div id="dashboard-widgets-wrap">
        	<div id="dashboard-widgets" class="metabox-holder">
            
            
            	<div class="meta-box-sortables important-notes">
                    <div class="postbox closed">
                        <div class="sb-button-group">
                        </div>
                        <div title="Click to toggle" class="handlediv"><br></div>
                        <h3 class="hndle"><span>Important Notes</span></h3>
                        <div class="inside">
                            <div class="main">
                            	<ul>
                                	<li>Don't use invalid jQuery selector. This may cause of jQuery conflict for whole page and all jQuery related functions will be stopped.</li>
                                    <li>jQuery selector settings should be unique across all settings. To make settings unique, use <strong>Unique Body Class</strong> field. Insert unique body class selector in <strong>Unique Body Class</strong> field to make all selector unique.</li>
                                    <li>Use callback function to add extra function before or after pagination action. See <strong>Advanced Options</strong> for this.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            
            
                <?php $this->sb_admin_setting_box(0); ?>
                <?php
					$settings = $this->get_infinite_scroll_settings();
					if($settings) {
						foreach($settings as $setting) {
							$this->sb_admin_setting_box($setting->id);
						}
					}
				?>
            </div>
            <div class="meta-box-sortables" style="text-align:center;">
                <a class="button-primary sb-btn add-new-btn" onclick="admin.add_new_setting();">Add New</a>
            </div>
        </div>
        <div id="import-export-json"></div>
        <div id="import-export-csv"></div>
	</div>