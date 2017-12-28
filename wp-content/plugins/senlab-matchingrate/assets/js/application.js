(function($) {
  $(document).ready(function(){

  	/*Change Talent Post's status to Publish*/
  	$(".sen-btn-role-change").click(function(e){
  		e.preventDefault();
  		console.log('start');
      var postid = $(this).data('postid');
 		$.ajax({
 			url:ajaxObject.ajaxurl,
 			type: 'post',
 			data: {
 				action: 'senlab_matching_role_change',
 				nonce: ajaxObject.nonce,
        id: postid,
 			},
 			success:function(output){
        console.log('success');
        window.location.href = "../s-home/";
 				
 			},
 			error: function(){
 				console.log('fail');
 			}

 		})
  	});

    /*Click Wish button*/
    $(document).on('favorites-updated-single', function(event, favorites, post_id, site_id, status){
      var modal = $('#sen-alert-wish');

      if(status == 'active'){
        $.ajax({
          url:ajaxObject.ajaxurl,
          type: 'post',
          data: {
          action: 'senlab_show_wish_update_modal',
          nonce: ajaxObject.nonce,
          id: post_id,
        },
        success:function(html){
          modal.html(html);
          modal.addClass("sen-alert-wish-show");
        },
        error: function(){
          console.log('senlab_show_wish_update_modal: fail');
        }
        })

        setTimeout(function(){
          $('#sen-alert-wish').removeClass("sen-alert-wish-show");
        },3000);
      }

    });
  	


  });

})(jQuery);
