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
  	
  	


  });

})(jQuery);
