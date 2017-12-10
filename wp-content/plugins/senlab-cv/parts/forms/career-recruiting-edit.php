<?php
/*
Title: Career Edit - Recruiting
Method: post
Logged in: true
Redirect: http://wordpress.dev/c-myinfo
*/

$user_id = get_current_user_id();
$career_id = get_user_meta($user_id,'career',true);

// Set where to save this form
piklist('field', array(
	'type' => 'hidden',
	'scope' => 'post',
	'field' => 'ID',
	'value' => "",
));

piklist('field', array(
    'type' => 'hidden',
    'scope' => 'post',
    'field' => 'post_status',
	'value' => 'publish'
 ));

piklist('field', [
	'type' => 'hidden',
	'scope' => 'post_meta',
	'field' => 'career',
	'value' => $career_id
]);


piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '채용명',
	'columns' => 8
]);

piklist('field',[
  'type' => 'select',
  'field' => 'recruiting_type',
  'scope' => 'post_meta',
  'label' => '채용유형',
  'columns' => 8,
  'choices' => array('' => '채용 유형을 선택하세요')+senlab_cv_get_terms_name('recruiting_type'),
]);

piklist('field',[
  'type' => 'select',
  'field' => 'major',
  'scope' => 'post_meta',
  'add_more' => true,
  'label' => '관심전공',
  'choices' => array('' => '전공을 선택하세요')+senlab_cv_get_terms_name('major')
]);

piklist('field',[
  'type' => 'text',
  'field' => 'location',
  'scope' => 'post_meta',
  'label' => '근무 장소(주소)',
]);

piklist('field',[
	'type' => 'group',
	'field' => 'salary',
	'scope' => 'post_meta',
	'label' => '연봉',
	'fields' => [
		[
			'type' => 'number',
			'field' => 'salary_min',
			'columns' => 6,
			'description' => '최소 연봉'
		],
		[
			'type' => 'number',
			'field' => 'salary_max',
			'columns' => 6,
			'description' => '최대 연봉'

		],


	]
]);

piklist('field',[
	'type' => 'group',
	'field' => 'period',
	'scope' => 'post_meta',
	'label' => '모집기간',
	'fields' => [
		[
			'type' => 'datepicker',
			'field' => 'period_start_date',
			'columns' => 6,
			'value' => date('Y.m.d'),
			'options' => [
        		'dateFormat' => 'Y.m.d'
      		]
		],
		[
			'type' => 'datepicker',
			'field' => 'period_end_date',
			'columns' => 6,
			'value' => date('Y.m.d'),
			'options' => [
        		'dateFormat' => 'Y.m.d'
      		]
		],
		[
			'type' => 'checkbox',
			'field' => 'period_always',
			'choices' => [
				true => '수시모집'
			]
		]

	]
]);


piklist('field', [
	'type' => 'textarea',
	'field' => 'description',
	'scope' => 'post_meta',
	'label' => '채용 내용',
	'columns' => 10,
	'attributes' => [
		'cols' => 80
	]
]);

piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'submit'
    ,'attributes' => array(
      'wrapper_class' => 'sen-edit-submit-real'
    )
  ));