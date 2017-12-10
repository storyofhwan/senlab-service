(function($) {
  $(document).ready(function(){

    /*Child Post의 등록/수정/삭제 */

    //modal안의 submit버튼 숨기기
    var submits = $(".sen-edit-submit-real");
    submits.each(function(e){
      $(this).hide();
    });

    $(".sen-edit-submit").click(function(e){
      e.preventDefault();
      console.log('success');
      var submit = $(this).parents('.modal-content').find('.sen-edit-submit-real').find('#submit_0');
      console.log(submit);
      submit.trigger("click");
    });

  	//Child post 정보 수정
  	$(".sen-edit-child-post-btn").click(function(e){
  		e.preventDefault();

  		var post_behave = $(this).data("behaving");
  		var post_id = $(this).data("postid");
  		var post_info = $(this).data("info");

  		console.log(post_info);
 		$.ajax({
 			url:ajaxObject.ajaxurl,
 			type: 'post',
 			data: {
 				action: 'senlab_cv_edit_child_post',
 				nonce: ajaxObject.nonce,
 				behave: post_behave,
 				id: post_id,
 				post_type: post_info
 			},
 			success:function(output){
 				var data = $.parseJSON(output);
 				var form;
 				var modal;
 				if(post_behave == 'edit'){
 					switch(post_info){
            case 'recruiting':
            modal = $("#cRecruitingEditModal"); form = $("#senlab_cv_career_recruiting_edit");
            form.children('#_post_ID_0').attr('value',post_id);
            form.find('#_post_post_title_0').attr('value',data.title);
            form.find('#_post_meta_recruiting_type_0').attr('value',data.recruiting_type);

            var count = 0;
            var new_form = form.find('#_post_meta_major_0').parent('.piklist-field-addmore-wrapper').clone(true);
            data.major.forEach(function(value,key,array1){
              var major_id = "_post_meta_major_"+count.toString();
              var major_selector = '#_post_meta_major_'+count.toString();
              if(count !=0){
                new_form.find('#_post_meta_major_0').attr('id',major_selector).attr('value',value);
                form.find('#_post_meta_major_0').parents('.piklist-theme-field').append(new_form);
              }
              else form.find(major_selector).attr('value',value);
              count=count+1;
              console.log(count);
            });

            form.find('#_post_meta_location_0').attr('value',data.location);
            form.find('#_post_meta_period_period_start_date_0').attr('value',data.period.period_start_date);
            form.find('#_post_meta_period_period_end_date_0').attr('value',data.period.period_end_date);
            form.find('#_post_meta_salary_salary_min_0').attr('value',data.salary.salary_min);
            form.find('#_post_meta_salary_salary_max_0').attr('value',data.salary.salary_max);
            form.find('#_post_meta_description_0').attr('value',data.description);
            break;



 						case 'exp_work':
            modal = $("#workEditModal"); form = $("#senlab_cv_talent_work_edit");
            form.children('#_post_ID_0').attr('value',post_id);
            form.find('#_post_post_title_0').attr('value',data.title);
            form.find('#_post_meta_company_0').attr('value',data.company);
            form.find('#_post_meta_location_0').attr('value',data.location);
            form.find('#_post_meta_period_period_start_year_0').val(data.period.period_start_year).change();
            form.find('#_post_meta_period_period_end_year_0').val(data.period.period_end_year).change();
            form.find('#_post_meta_period_period_start_month_0').val(data.period.period_start_month).change();
            form.find('#_post_meta_period_period_end_month_0').val(data.period.period_end_month).change();
            form.find('#_post_meta_description_0').attr('value',data.description);
            break;

 						default: break;
 					}

 					modal.find('.btn.sen-delete').data('postid',post_id);
 					modal.find('.btn.sen-delete').data('info',post_info);
 					console.log('sen-delete: '+post_id);
 					
 					modal.modal('show');
 				}

 				else if(post_behave == 'delete'){
 					console.log("post_info: "+post_info);
 					console.log("output: "+output);
 					$('#deleteModal').modal('hide');
 					location.reload();
 				}
 				
 			},
 			error: function(){
 				console.log('fail');
 			}

 		})
  	});
  	
    //Child post 삭제
  	$(".btn.sen-delete").click(function(e){
  		e.preventDefault();
  		var post_id = $(this).data('postid');
  		var post_info = $(this).data('info');
  		console.log(post_id);
  		$(this).parents('.modal').modal('hide');
  		$('#deleteModal').find('.sen-edit-child-post-btn').data('postid',post_id);
  		$('#deleteModal').find('.sen-edit-child-post-btn').data('info',post_info);
  		console.log($('#deleteModal').find('.sen-edit-child-post-btn').data('info'));
  		console.log($('#deleteModal').find('.sen-edit-child-post-btn').data('postid'));
  		$('#deleteModal').modal('show');

  	});


    /*희망 채용 유형 등록/삭제 */

    $('#wishRecruitingTypeModal').on('show.bs.modal', function (e) {
      var button = $(e.relatedTarget) // Button that triggered the modal
      var recruiting_type = button.data('recruiting-type')
      var action = button.data('action')

      var switch_name ="";
      var switch_content="";
      switch(recruiting_type){
        case 'rec_normal': switch_name = '일반 채용'; switch_content = '공개 채용과 수시 채용'; break;
        case 'rec_army' : switch_content = switch_name = '전문연구요원'; break;
        case 'rec_scholar' : switch_content = switch_name = '산학장학생'; break;
      }

      var modal = $(this);
      if(action=='add'){
        modal.find('.modal-title').html("<span class='text-primary h5'>"+switch_name+"</span> 스위치 켜기");
        modal.find('.modal-body').html("<span class='text-primary'>"+switch_name+"</span>"+" 스위치를 켜면 "+switch_content+"정보를 등록한 기업에게 면접 요청을 받을 수 있습니다. 요청 온 면접을 승인하신다면 실제로 기업과 면접을 진행 해야하며 입사도 가능합니다. <span class='text-danger h6'>지금 당장, 혹은 가까운 시간 안에 취업 계획이 있는 분만 스위치를 켜주세요!</span>");
        modal.find('.sen-edit-wish-recruiting').text('스위치 켜기');
      }
      else if(action=='delete'){
        modal.find('.modal-title').html("<span class='text-primary h5'>"+switch_name+"</span> 스위치 끄기");
        modal.find('.modal-body').html("<span class='text-primary'>"+switch_name+"</span>"+" 스위치를 끄면 <span class='text-danger h6'>더 이상 "+switch_content+" 정보를 등록한 기업에게 면접 요청을 받을 수 없습니다.</span> 다른 스위치가 켜져있다면 면접 기능은 계속 사용가능합니다. 만약 모든 스위치가 꺼져 있다면 면접 기능은 사용하실 수 없지만 다른 매칭 기능은 계속 이용 가능합니다!");
        modal.find('.sen-edit-wish-recruiting').text('스위치 끄기');
      }


      modal.find('.sen-edit-wish-recruiting').data('recruiting-type',recruiting_type);
      modal.find('.sen-edit-wish-recruiting').data('action',action);

      console.log(recruiting_type);
      console.log(action);
    });


    

    $(".btn.sen-edit-wish-recruiting").click(function(e){
      e.preventDefault();

      var action = $(this).data('action'); //add or delete
      var recruiting_type = $(this).data('recruiting-type');
      console.log(action);
      console.log(recruiting_type);

      $.ajax({
        url: ajaxObject.ajaxurl,
        type: 'post',
        data: {
          action: 'senlab_cv_edit_wish_recruiting',
          nonce: ajaxObject.nonce,
          recruiting_type: recruiting_type,
          behaving: action
        },
        success:function(output){
          console.log('success');
          console.log('output:'+output);
          window.location.reload();
        },
        error:function(){
          console.log('fail')
        }

      })

    });


  });

})(jQuery);
