<?php
	$settings = $this->sb_admin->get_infinite_scroll_settings();
?>
<script type="text/javascript">
	;(function($) {
		var w = $(window);
		var is;
		is = {
			init: function() {
				
				<?php
					if($settings) {
						foreach($settings as $setting) {
							if($setting->status != 1)
								continue;
							if($setting->pagination_type == 'ajax_pagination') { ?>
								$('body<?php echo $setting->body_class; ?>').on('click', '<?php echo $setting->navigation_selector.' a'; ?>', function(e) {
									e.preventDefault();
									var href = $.trim($(this).attr('href'));
									if(href != '') {
										if(!is.msieversion()) {
											history.pushState(null, null, href);
										}
										<?php echo stripslashes($setting->onstart).';'; ?>
										<?php if(trim($setting->loading_image) != '') { ?>
										$('<?php echo 'body'.$setting->body_class.' '.$setting->navigation_selector; ?>').before('<div id="sb-infinite-scroll-loader-<?php echo $setting->id; ?>" class="sb-infinite-scroll-loader <?php echo $setting->loading_wrapper_class; ?> "><img src="<?php echo $setting->loading_image; ?>" alt=" " /><span><?php echo $setting->loading_message; ?></span></div>');
										<?php } ?>
										$.get(href, function(response) {
											if(!is.msieversion()) {
												document.title = $(response).filter('title').html();
											}
											<?php
												$content_selectors = $setting->content_selector.','.$setting->navigation_selector;
												$content_selectors = explode(',', $content_selectors);
												foreach($content_selectors as $content_selector) {
													if(trim($content_selector) == '')
														continue;
													?>
													var html = $(response).find('<?php echo $content_selector; ?>').html();
													$('<?php echo $content_selector; ?>').html(html);
													<?php
												} ?>
												$('.sb-infinite-scroll-loader').remove(); <?php
												echo stripslashes($setting->onfinish).';';
												if($setting->scrolltop == 1) { ?>
													var scrollto = 0;
													<?php if(trim($setting->scrollto) != '') { ?>
														if($('<?php echo $setting->scrollto; ?>').length) {
															var scrollto = $('<?php echo $setting->scrollto; ?>').offset().top;
														}
													<?php } ?>
													$('html, body').animate({ scrollTop: scrollto }, 500);
												<?php }
											?>
											$('<?php echo 'body'.$setting->body_class.' '.$setting->item_selector; ?>').addClass('animated <?php echo $setting->animation; ?>').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
												$(this).removeClass('animated <?php echo $setting->animation; ?>');
											});
										});
									}
								});
								<?php 
							}
							
							if($setting->pagination_type == 'load_more_button' || $setting->pagination_type == 'infinite_scroll') { ?>
								$(document).ready(function() {
									if($('<?php echo 'body'.$setting->body_class.' '.$setting->navigation_selector; ?>').length) {
										$('<?php echo 'body'.$setting->body_class.' '.$setting->navigation_selector; ?>').before('<div id="sb-infinite-scroll-load-more-<?php echo $setting->id; ?>" class="sb-infinite-scroll-load-more <?php echo $setting->load_more_button_class; ?> "><a sb-processing="0"><?php echo $setting->load_more_button_text; ?></a><br class="sb-clear" /></div>');
										<?php if($setting->pagination_type == 'infinite_scroll') { ?>
										$('#sb-infinite-scroll-load-more-<?php echo $setting->id; ?>').addClass('sb-hide');
										<?php } ?>
									}
									$('<?php echo 'body'.$setting->body_class.' '.$setting->navigation_selector; ?>').addClass('sb-hide');
									$('<?php echo 'body'.$setting->body_class.' '.$setting->item_selector; ?>').addClass('sb-added');
								});
								$('body<?php echo $setting->body_class; ?>').on('click', '#sb-infinite-scroll-load-more-<?php echo $setting->id.' a'; ?>', function(e) {
									e.preventDefault();
									if($('<?php echo 'body'.$setting->body_class.' '.$setting->next_selector; ?>').length) {
										$('#sb-infinite-scroll-load-more-<?php echo $setting->id.' a'; ?>').attr('sb-processing', 1);
										var href = $('<?php echo 'body'.$setting->body_class.' '.$setting->next_selector; ?>').attr('href');
										<?php echo stripslashes($setting->onstart).';'; ?>
										<?php if(trim($setting->loading_image) != '') { ?>
											$('#sb-infinite-scroll-load-more-<?php echo $setting->id; ?>').hide();
											$('<?php echo 'body'.$setting->body_class.' '.$setting->navigation_selector; ?>').before('<div id="sb-infinite-scroll-loader-<?php echo $setting->id; ?>" class="sb-infinite-scroll-loader <?php echo $setting->loading_wrapper_class; ?> "><img src="<?php echo $setting->loading_image; ?>" alt=" " /><span><?php echo $setting->loading_message; ?></span></div>');
										<?php } ?>
										$.get(href, function(response) {
											$('<?php echo 'body'.$setting->body_class.' '.$setting->navigation_selector; ?>').html($(response).find('<?php echo $setting->navigation_selector; ?>').html());
											
											$(response).find('<?php echo $setting->content_selector.' '.$setting->item_selector; ?>').each(function() {
												$('<?php echo 'body'.$setting->body_class.' '.$setting->content_selector.' '.$setting->item_selector; ?>:last').after($(this));
											});
											
											$('#sb-infinite-scroll-loader-<?php echo $setting->id; ?>').remove();
											$('#sb-infinite-scroll-load-more-<?php echo $setting->id; ?>').show();
											$('#sb-infinite-scroll-load-more-<?php echo $setting->id.' a'; ?>').attr('sb-processing', 0);
											<?php echo stripslashes($setting->onfinish).';'; ?>
											$('<?php echo 'body'.$setting->body_class.' '.$setting->item_selector; ?>').not('.sb-added').addClass('animated <?php echo $setting->animation; ?>').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
												$(this).removeClass('animated <?php echo $setting->animation; ?>').addClass('sb-added');
											});
										});
									} else {
										$('#sb-infinite-scroll-load-more-<?php echo $setting->id; ?>').addClass('finished').removeClass('sb-hide');
										$('#sb-infinite-scroll-load-more-<?php echo $setting->id.' a'; ?>').show().html('<?php echo $setting->finished_message; ?>').css('cursor', 'default');
									}
								});
								<?php 
							}
							if($setting->pagination_type == 'infinite_scroll') { ?>
							
								var buffer_pixels_<?php echo $setting->id; ?> = Math.abs(<?php echo $setting->buffer_pixels; ?>);
								w.scroll(function () {
									if($('<?php echo 'body'.$setting->body_class.' '.$setting->content_selector; ?>').length) {
										var a = $('<?php echo 'body'.$setting->body_class.' '.$setting->content_selector; ?>').offset().top + $('<?php echo 'body'.$setting->body_class.' '.$setting->content_selector; ?>').outerHeight();
										var b = a - w.scrollTop();
										if ((b - buffer_pixels_<?php echo $setting->id; ?>) < w.height()) {
											if($('#sb-infinite-scroll-load-more-<?php echo $setting->id.' a'; ?>').attr('sb-processing') == 0) {
												$('#sb-infinite-scroll-load-more-<?php echo $setting->id; ?> a').trigger('click');
											}
										}
									}
								});
							
							<?php }
							
							
						}
					}
				?>
				
			},
			msieversion: function() {
				var ua = window.navigator.userAgent;
				var msie = ua.indexOf("MSIE ");
	
				if (msie > 0)      // If Internet Explorer, return version number
					return parseInt(ua.substring(msie + 5, ua.indexOf(".", msie)));

				return false;
			}
		};
		is.init();
		
	})(jQuery);
	
</script>