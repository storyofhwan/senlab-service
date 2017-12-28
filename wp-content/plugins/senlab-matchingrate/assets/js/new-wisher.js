(function($) {
  $(document).ready(function(){
    $.ajax({
      url: ajaxObject.ajaxurl,
      type: 'post',
      data:{
        action: 'senlab_new_wisher',
        nonce: ajaxObject.nonce,
        user_id: ajaxObject.user_id
      },
      success:function(new_wisher){
        if(new_wisher == 'true') $('#sen-alert-new-wisher').removeClass('d-none');
        console.log(new_wisher);
      },
      error:function(){

      }
    })

  });

})(jQuery);
