(function($) {
  $(document).ready(function(){

  	/*Want 생성*/
  	$(".sen-want").click(function(e){
  		e.preventDefault();
  		if($(this).data('status')==1){
  			var modal= $('#wantModal');
  			var name = $(this).data('name');
  			var student = $(this).data('student');
  			modal.find('#student-name').text(name);

  			modal.find('#_post_meta_student_0').val(student);
  			
  			modal.modal('show');
  		}
  		else{
  			$('#wantExplainModal').modal('show');
  		}
  	});

  	/*Want 승인/거절 */
  	$(".sen-request-submit-real").hide();
  	$(".sen-want-request").click(function(e){
  		e.preventDefault();
  		console.log('wantRequestModal');

  		var modal= $('#wantRequestModal');
  		var id = $(this).data('id');		//want포스트 id
  		var name = $(this).data('name');	//기업 이름
  		var description = $(this).data('description');

  		modal.find('#company-name').text(name);
  		modal.find('#want-description').text(description);
  		modal.find('#_post_ID_0').val(id);

  		modal.modal('show');
  	});

  	$("#sen-want-approve").click(function(e){
  		var modal = $('#wantRequestModal');

  		modal.find('#_post_meta_status_0').val('승인');

  		var submit = $(this).parents('#wantRequestModal').find('.sen-request-submit-real').find('#submit_0');
  		submit.trigger("click");
  	});

  	$("#sen-want-reject").click(function(e){
  		var modal = $('#wantRequestModal');

  		modal.find('#_post_meta_status_0').val('거절');

  		var submit = $(this).parents('#wantRequestModal').find('.sen-request-submit-real').find('#submit_0');
  		submit.trigger("click");
  	});

  	


  });

})(jQuery);
