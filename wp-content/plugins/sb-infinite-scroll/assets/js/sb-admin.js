// JavaScript Document
var admin;
;(function($){
	var w = $(window);
	admin = {
		init: function() {
			admin.accordion_init();
			admin.delete_setting_init();
			admin.set_row_title_init();
			admin.infinite_scroll_setting_form();
			admin.sb_media_uploader_init();
			admin.json_import_export_popup();
			admin.json_import_settings();
			admin.csv_import_export_popup();
			admin.csv_import_settings();
		},
		accordion_init: function() {
			$('body').on('click', '.handlediv, .hndle span, .sb-button-group a.edit', function() {
				admin.accordion($(this));
			});
		},
		accordion: function($this) {
			$this.closest('.postbox').children('.inside').slideToggle('fast', function(){
				$this.closest('.postbox').toggleClass('closed');
			});
		},
		delete_setting_init: function($msg) {
			$('body').on('click', '.sb-button-group a.delete', function() {
				if(admin.sbconfirm($(this).attr('data-msg'))) {
					admin.delete_setting($(this));
				}
				return false;
			});
		},
		sbconfirm: function($msg) {
			if(confirm($msg)) {
				return true;
			}
			return false;
		},
		add_new_setting: function() {
			var html = '<div class="meta-box-sortables add-slide-down">'+$('.meta-box-sortables.sample-data').html()+'</div>';
			$('#dashboard-widgets').append(html);
			$('.add-slide-down').hide().slideDown('fast', function() {
				$(this).removeClass('add-slide-down');
			});
		},
		delete_setting: function($this) {
			var id = $this.closest('form').find('input[name=setting_id]').val();
			var url = $this.closest('form').attr('action');
			admin.sb_growl('Deleting....');
			if(id != 0) {
				$.ajax({
					type 	 :	'POST',
					url	 	 : 	url,
					data 	 : 	{id: id, action: 'remove_infinite_scroll_setting'},
					success	 :	function(response) {
						admin.remove_setting_box_after_delete_setting($this);
					}
				});
			} else {
				admin.remove_setting_box_after_delete_setting($this);
			}
		},
		remove_setting_box_after_delete_setting: function($this) {
			admin.sb_growl('Settings Deleted.');
			admin.sb_growl_close(1000);
			$this.closest('.meta-box-sortables').slideUp('fast', function() {
				$(this).remove();
			});
		},
		set_row_title_init: function() {
			$('body').on('keyup blur', '.settings-title', function() {
				admin.set_row_title($(this));
			});
		},
		set_row_title: function($this) {
			var title = $.trim($this.val());
			if(title == '')
				title = 'No Title';
			$this.closest('.postbox').children('.hndle').children('span').text(title);
		},
		infinite_scroll_setting_form: function() {
			$('body').on('submit', 'form.infinite_scroll_setting_form', function(e) {
				var error = 0;
				var focusfield = '';
				var title 				= $(this).find("input[name='settings[title]']");
				var content_selector 	= $(this).find("input[name='settings[content_selector]']");
				var navigation_selector = $(this).find("input[name='settings[navigation_selector]']");
				var next_selector		= $(this).find("input[name='settings[next_selector]']");
				var item_selector		= $(this).find("input[name='settings[item_selector]']");
				
				$('.field-wrapper .error').removeClass('error');
				
				if($.trim(title.val()) == '') {
					title.addClass('error');
					error = 1;
					if(focusfield == '')
						focusfield = title;
				}
				
				if($.trim(content_selector.val()) == '') {
					content_selector.addClass('error');
					error = 1;
					if(focusfield == '')
						focusfield = content_selector;
				}
				
				if($.trim(navigation_selector.val()) == '') {
					navigation_selector.addClass('error');
					error = 1;
					if(focusfield == '')
						focusfield = navigation_selector;
				}
				
				if($.trim(next_selector.val()) == '') {
					next_selector.addClass('error');
					error = 1;
					if(focusfield == '')
						focusfield = next_selector;
				}
				
				if($.trim(item_selector.val()) == '') {
					item_selector.addClass('error');
					error = 1;
					if(focusfield == '')
						focusfield = item_selector;
				}
				
				if(error == 1) {
					admin.sb_growl('Please fill all required fields.');
					admin.sb_growl_close(1000);
					focusfield.focus();
					return false;
				}
				admin.setting_form_ajax($(this), e);
			});
		},
		setting_form_ajax: function($this, e) {
			e.preventDefault();
			var data = $this.serialize();
			var url = $this.attr('action');
			admin.sb_growl('Saving...');
			$('.btn-save-settings').attr('disabled', true);
			$this.find('.ajax-loader').show();
			$.ajax({
				type 	 :	'POST',
				url	 	 : 	url,
				data 	 : 	data,
				dataType :	'json',
				success	 :	function(response) {
					$('.btn-save-settings').attr('disabled', false);
					$this.find('.ajax-loader').hide();
					$this.find('input[name=setting_id]').val(response.id);
					admin.sb_growl('Settings Saved.');
					admin.sb_growl_close(1000);
					if(response.after_save == 1) {
						$this.find('.handlediv').trigger('click');
					}
				}
			});
		},
		sb_growl: function($msg) {
			$('.sb-message').fadeIn('fast');
			$('.sb-message').html($msg);
		},
		sb_growl_close: function(time) {
			setTimeout(function() {
				$('.sb-message').fadeOut('fast', function() {
					$('.sb-message').removeClass('fail');
				});
			}, time);
		},
		sb_media_uploader_init: function() {
			var custom_uploader;
			$('body').on('blur', '.loading_image', function() {
				var src = $(this).val();
				$(this).next().next().attr('src', src);
			});
			$('body').on('click', '.upload_image', function() {
				$this = $(this);
				if (custom_uploader) {
					custom_uploader.open();
					return;
				}
				
				custom_uploader = wp.media.frames.file_frame = wp.media({
					title: 'Choose Image',
					button: {
						text: 'Choose Image'
					},
					multiple: false
				});
				
				custom_uploader.on('select', function() {
					attachment = custom_uploader.state().get('selection').first().toJSON();
					$this.prev().val(attachment.url);
					$this.next('img.loading_image_preview').attr('src', attachment.url);
				});
				
				custom_uploader.open();
			});

		},
		json_import_settings: function() {
			$('body').on('submit', '#frm-json-import-settings', function(e) {
				e.preventDefault();
				$this = $(this);
				$this.find('.ajax-loader').show();
				$('.import-is-setting').attr('disabled', true);
				admin.sb_growl('Importing...');
				var data = $this.serialize();
				$.ajax({
					type 	 :	'POST',
					url	 	 : 	SB.AJAX,
					data 	 : 	data,
					success	 :	function(response) {
						$('.import-is-setting').attr('disabled', false);
						$this.find('.ajax-loader').hide();
						admin.sb_growl(response);
						if(response == 'Invalid JSON format.')
							$('.sb-message').addClass('fail');
						admin.sb_growl_close(3000);
						$this[0].reset();
					}
				});
			});
		},
		json_import_export_popup: function() {
			var $popup = $("#import-export-json");
			$popup.dialog({                   
				dialogClass   	:	'wp-dialog',
				modal         	: 	true,
				title			:	'JSON: Import / Export Settings',
				width			:	400,
				height			:	450,
				draggable     	: 	false,
				resizable     	: 	false,
				autoOpen      	: 	false,
				closeOnEscape 	: 	false,
				open			: 	function() {
					$('.ui-dialog-buttonpane').find('button:contains("Select")').addClass('button-primary');
					$('.ui-dialog-titlebar-close').replaceWith('<button class="ui-button ui-widget ui-dialog-titlebar-close" onclick="jQuery(\'#import-export-json\').html(\'\').addClass(\'popup-ajax-loader\'); location.reload();"></button>');
				},
				close			:	function() {
					location.reload();
				},
				buttons       	:	{
					"Close": function() { $popup.html('').addClass('popup-ajax-loader'); location.reload(); }
				}
			});
			
			$('body').on('click','#json-import-export-link',function(event) {
				event.preventDefault();
				$popup.addClass('popup-ajax-loader');
				$popup.html('');
				$popup.dialog('open');
				$.ajax({
					type 	 :	'POST',
					url	 	 : 	SB.AJAX,
					data 	 : 	{action: 'json_import_export_settings'},
					success	 :	function(response) {
						$popup.html(response);
						$popup.removeClass('popup-ajax-loader');
					}
				});
			});
		},
		csv_import_settings: function() {
			$('body').on('submit', '#frm-csv-import-settings', function(e) {
				e.preventDefault();
				$this = $(this);
				$this.find('.ajax-loader').show();
				$('.import-is-setting').attr('disabled', true);
				admin.sb_growl('Importing...');
				$(this).ajaxSubmit({
					type 	 :	'POST',
					url	 	 : 	SB.AJAX,
					success	 :	function(response) {
						$('.import-is-setting').attr('disabled', false);
						$this.find('.ajax-loader').hide();
						admin.sb_growl(response);
						admin.sb_growl_close(3000);
						$this[0].reset();
					}
				});
			});
		},
		csv_import_export_popup: function() {
			var $popup = $("#import-export-csv");
			$popup.dialog({                   
				dialogClass   	:	'wp-dialog',
				modal         	: 	true,
				title			:	'CSV: Import / Export Settings',
				width			:	400,
				height			:	500,
				draggable     	: 	false,
				resizable     	: 	false,
				autoOpen      	: 	false,
				closeOnEscape 	: 	false,
				open			: 	function() {
					$('.ui-dialog-buttonpane').find('button:contains("Select")').addClass('button-primary');
					$('.ui-dialog-titlebar-close').replaceWith('<button class="ui-button ui-widget ui-dialog-titlebar-close" onclick="jQuery(\'#import-export-csv\').html(\'\').addClass(\'popup-ajax-loader\'); location.reload();"></button>');
				},
				close			:	function() {
					location.reload();
				},
				buttons       	:	{
					"Close": function() { $popup.html('').addClass('popup-ajax-loader'); location.reload(); }
				}
			});
			
			$('body').on('click','#csv-import-export-link',function(event) {
				event.preventDefault();
				$popup.addClass('popup-ajax-loader');
				$popup.html('');
				$popup.dialog('open');
				$.ajax({
					type 	 :	'POST',
					url	 	 : 	SB.AJAX,
					data 	 : 	{action: 'csv_import_export_settings'},
					success	 :	function(response) {
						$popup.html(response);
						$popup.removeClass('popup-ajax-loader');
					}
				});
			});
		}
	}
	admin.init();
})(jQuery);