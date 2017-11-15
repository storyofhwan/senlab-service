<?php $setting = $this->get_infinite_scroll_setting($id); ?>
<div class="meta-box-sortables <?php if($id == 0) { echo 'sample-data'; } ?>">
    <form class="infinite_scroll_setting_form" method="post" action="<?php echo admin_url('admin-ajax.php'); ?>">
        <div class="postbox <?php if($id != 0) { echo 'closed'; } ?>">
            <div class="sb-button-group">
                <a class="edit">Edit</a>
                <a class="delete" data-msg="You are about to permanently delete the selected settings. Are you really want to delete?">Delete</a>
            </div>
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span><?php echo $setting['label']; ?></span></h3>
            <div class="inside">
                <div class="main">
                    <div class="form-column">
                        <div class="form-row">
                            <label>Status</label>
                            <div class="field-wrapper">
                                <input <?php checked($this->sb_display_field($setting['status']), 1); ?> name="settings[status]" type="checkbox" value="1" /> Enable / Disable
                                <p class="description">Uncheck this box to disabled pagination</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Title</label>
                            <div class="field-wrapper">
                                <input name="settings[title]" class="settings-title" type="text" value="<?php echo $this->sb_display_field($setting['title']); ?>" />
                                <p class="description">Title for this setting box</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Pagination Type</label>
                            <div class="field-wrapper">
                                <select name="settings[pagination_type]">
                                    <?php
                                        $pagination_types = $this->get_pagination_type();
                                        if(isset($pagination_types)) {
                                            foreach($pagination_types as $pagination_type_key => $pagination_type) {
                                                echo '<option '.selected($setting['pagination_type'], $pagination_type_key).' value="'.$pagination_type_key.'">'.$pagination_type.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <p class="description">Select type of pagination</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Content Selector</label>
                            <div class="field-wrapper">
                                <input name="settings[content_selector]" type="text" value="<?php echo $this->sb_display_field($setting['content_selector']); ?>" />
                                <p class="description">Div containing your posts</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Navigation Selector</label>
                            <div class="field-wrapper">
                                <input name="settings[navigation_selector]" type="text" value="<?php echo $this->sb_display_field($setting['navigation_selector']); ?>" />
                                <p class="description">Div containing your posts navigation (pagination)</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Next Selector</label>
                            <div class="field-wrapper">
                                <input name="settings[next_selector]" type="text" value="<?php echo $this->sb_display_field($setting['next_selector']); ?>" />
                                <p class="description">Link to next page of content (Next page link selector)</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Unique Body Class</label>
                            <div class="field-wrapper">
                                <input name="settings[body_class]" type="text" value="<?php echo $this->sb_display_field($setting['body_class']); ?>" />
                                <p class="description">(Optional) Unique body class to make this setting unique</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Item Selector</label>
                            <div class="field-wrapper">
                                <input name="settings[item_selector]" type="text" value="<?php echo $this->sb_display_field($setting['item_selector']); ?>" />
                                <p class="description">Div containing an individual post</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Buffer Pixels</label>
                            <div class="field-wrapper">
                                <input name="settings[buffer_pixels]" type="number" value="<?php echo $this->sb_display_field($setting['buffer_pixels']); ?>" /> Pixels
                                <p class="description">Increase this number if you want infinite scroll to fire quicker</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-column">
                    	<div class="form-row">
                            <label>Scroll Top</label>
                            <div class="field-wrapper">
                                <input <?php checked($this->sb_display_field($setting['scrolltop']), 1); ?> name="settings[scrolltop]" type="checkbox" value="1" /> Yes / No
                                <p class="description">Check to scroll top after data loading (only for: Ajax Pagination)</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Scroll To</label>
                            <div class="field-wrapper">
                                <input name="settings[scrollto]" type="text" value="<?php echo $this->sb_display_field($setting['scrollto']); ?>" />
                                <p class="description">Scroll top destination. Only works if scroll top is enable</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Loading Message</label>
                            <div class="field-wrapper">
                                <input name="settings[loading_message]" type="text" value="<?php echo $this->sb_display_field($setting['loading_message']); ?>" />
                                <p class="description">Text to display when posts are retrieving</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Loading Wrapper Class</label>
                            <div class="field-wrapper">
                                <input name="settings[loading_wrapper_class]" type="text" value="<?php echo $this->sb_display_field($setting['loading_wrapper_class']); ?>" />
                                <p class="description">Add custom class to customize loading message style</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Finished Message</label>
                            <div class="field-wrapper">
                                <input name="settings[finished_message]" type="text" value="<?php echo $this->sb_display_field($setting['finished_message']); ?>" />
                                <p class="description">Text to display when no additional posts are available</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Loading Image</label>
                            <div class="field-wrapper">
                                <input name="settings[loading_image]" class="loading_image" type="text" value="<?php echo $this->sb_display_field($setting['loading_image']); ?>" /><input type="button" class="button upload_image" value="Upload" />
                                <img width="32" height="32" class="loading_image_preview alignright" src="<?php echo $this->sb_display_field($setting['loading_image']); ?>" alt=" " />
                                <span class="alignright">&nbsp; &nbsp;</span>
                                <p class="description">Loader image to display when posts are retrieving</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Load More Button Text</label>
                            <div class="field-wrapper">
                                <input name="settings[load_more_button_text]" type="text" value="<?php echo $this->sb_display_field($setting['load_more_button_text']); ?>" />
                                <p class="description">Add Load More Button Text (Default: Load More)</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Load More Button Class</label>
                            <div class="field-wrapper">
                                <input name="settings[load_more_button_class]" type="text" value="<?php echo $this->sb_display_field($setting['load_more_button_class']); ?>" />
                                <p class="description">Add custom class to customize button style (Use space for multiple)</p>
                            </div>
                        </div>
                        <div class="form-row">
                            <label>Animation</label>
                            <div class="field-wrapper">
                                <select name="settings[animation]">
                                    <option <?php selected($setting['animation'], 'none'); ?> value="none">None</option>
                                    <?php
                                        $animations = $this->parent->get_animation_style();
                                        if(isset($animations)) {
                                            foreach($animations as $animation_key => $animation) {
                                                echo '<optgroup label="'.$animation_key.'">';
                                                foreach($animation as $anim_key => $anim)
                                                echo '<option '.selected($setting['animation'], $anim_key).' value="'.$anim_key.'">'.$anim.'</option>';
                                                echo '</optgroup>';
                                            }
                                        }
                                    ?>
                                </select>
                                <p class="description">Animation style after loading post</p>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <p><a class="advanced-options-link" onclick="jQuery(this).closest('p').next().slideToggle();"><strong>Advanced Options (jQuery Callbacks) &raquo;</strong></a></p>
                    <div class="advanced-options">
                        <div class="form-column">
                            <div class="form-row">
                                <label>On Pagination Start</label>
                                <div class="clear"></div>
                                <div class="field-wrapper">
                                    <textarea name="settings[onstart]"><?php echo $this->sb_display_field($setting['onstart']); ?></textarea>
                                    <p class="description">Executes on pagination start. (Use Javasctipt/jQuery code to trigger custom event)</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-column">
                            <div class="form-row">
                                <label>On Pagination End</label>
                                <div class="clear"></div>
                                <div class="field-wrapper">
                                    <textarea name="settings[onfinish]"><?php echo $this->sb_display_field($setting['onfinish']); ?></textarea>
                                    <p class="description">Executes immediately after pagination completed. (Use Javasctipt/jQuery code to trigger custom event)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form-row">
                        <div class="field-wrapper">
                            <input type="hidden" name="action" value="save_infinite_scroll_settings" />
                            <input type="hidden" name="setting_id" value="<?php echo $this->sb_display_field($setting['id']); ?>" />
                            <input type="hidden" name="after_save" class="after_save" value="0" />
                            <input type="submit" value="Save" onclick="jQuery(this).closest('.field-wrapper').children('.after_save').val('0');" class="button-primary btn-save-settings sb-btn alignleft" /><span class="alignleft">&nbsp;</span>
                            <input type="submit" value="Save & Close" onclick="jQuery(this).closest('.field-wrapper').children('.after_save').val('1');" class="button-primary btn-save-settings sb-btn alignleft" />
                            <img class="ajax-loader" src="<?php echo $this->parent->plugin_dir_url; ?>assets/img/ajax-loader.gif" alt="Saving..." />
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </form>
</div>