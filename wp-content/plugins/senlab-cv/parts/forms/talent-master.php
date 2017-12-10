<?php
/*
Title: Talent Edit - Master
Method: post
Logged in: true
Redirect: http://wordpress.dev/s-myinfo
*/

$user_id = get_current_user_id();
$id = get_user_meta($user_id,'talent',true);
$input_status = get_post_meta($id, '_edu',true);
$input_status['mas'] = 'Y';

// Set where to save this form
piklist('field', array(
	'type' => 'hidden',
	'scope' => 'post',
	'field' => 'ID',
	'value' => $id
));

piklist('field',[
	'type' => 'radio',
	'scope' => 'post_meta',
	'field' => 'mas_univ_name',
	'label' => '학교',
	'choices' => senlab_cv_get_terms_name('school'),
  	'value' => get_post_meta($id, 'mas_univ_name',true),
  	'attributes' => array(
  		'wrapper_class' => 	'text-uppercase'
    ),
    'required' => true
]);

piklist('field',[
	'type' => 'text',
	'scope' => 'post_meta',
	'field' => 'mas_department',
	'label' => '학과',
	'value' => get_post_meta($id, 'mas_department', true),
	'columns' => 8,
	'required' => true,
]);

piklist('field',[
	'type' => 'text',
	'scope' => 'post_meta',
	'field' => 'mas_major',
	'value' => get_post_meta($id, 'mas_major', true),
	'required' => true,
	'label' => '세부전공',
	'columns' => 8,
]);

piklist('field',[
	'type' => 'group',
	'scope' => 'post_meta',
	'field' => 'mas_grade',
	'value' => get_post_meta($id, 'mas_grade', true),
	'fields' => [
		[
			'type' => 'text',
			'field' => 'mas_grade_my',
			'label' => '평균 학점',
			'columns' => 4],
		[
			'type'=> 'radio',
			'field' => 'mas_grade_full',
			'label' => '만점',
			'choices' => [
				'4.3' => '4.3','4.5' => '4.5'
			],
			'columns'=> 2]
	]
]);

piklist('field',[
	'type' => 'group',
	'scope' => 'post_meta',
	'field' => 'mas_ent',
	'value' => get_post_meta($id, 'mas_ent', true),
	'fields' => [
		[
			'type' => 'text',
			'field' => 'mas_ent_year',
			'required' => true,
			'label' => '입학 연도',
			'columns' => 4],
		[
			'type'=> 'radio',
			'field' => 'mas_ent_sem',
			'required' => true,
			'label' => '학기',
			'choices' => [
				3 => '3월',
				9 => '9월'
			],
			'columns'=> 2]
	]
]);

piklist('field',[
	'type' => 'group',
	'scope' => 'post_meta',
	'field' => 'mas_gradu',
	'value' => get_post_meta($id, 'mas_gradu', true),
	'required' => true,
	'fields' => [
		[
			'type' => 'text',
			'field' => 'mas_gradu_year',
			'label' => '졸업(예상) 연도',
			'required' => true,
			'columns' => 4],
		[
			'type'=> 'radio',
			'field' => 'mas_gradu_sem',
			'required' => true,
			'label' => '학기',
			'choices' => [
				2 => '2월',
				8 => '8월'
			],
			'columns'=> 2]
	]
]);

piklist('field',[
	'type' => 'text',
	'scope' => 'post_meta',
	'field' => 'mas_thesis',
	'value' => get_post_meta($id, 'mas_thesis', true),
	'label' => '학위 논문',
	'columns' => 8,
]);

piklist('field',[
	'type' => 'group',
	'scope' => 'post_meta',
	'field' => '_edu',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'doc',
			'value' => $input_status['doc'],
			'attributes' => [
				'class' => 'd-none'
			]
		],
		[
			'type' => 'text',
			'field' => 'mas',
			'value' => $input_status['mas'],
			'attributes' => [
				'class' => 'd-none'
			]
		],
		[
			'type' => 'text',
			'field' => 'bac',
			'value' => $input_status['bac'],
			'attributes' => [
				'class' => 'd-none'
			]
		],
	],
]);

piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'submit'
    ,'attributes' => array(
      'wrapper_class' => 'sen-edit-submit-real'
    )
  ));