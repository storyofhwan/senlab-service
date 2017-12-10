<?php
/*
Title: Doctor
Method: post
Logged in: true
Redirect: http://wordpress.dev/s-myinfo
*/

$user_id = get_current_user_id();
$id = get_user_meta($user_id,'talent',true);
$input_status = get_post_meta($id, '_edu',true);
$input_status['doc'] = 'Y';

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
	'field' => 'doc_univ_name',
	'label' => '학교',
	'required' => true,
	'choices' => senlab_cv_get_terms_name('school'),
  	'value' => get_post_meta($id, 'doc_univ_name',true),
  	'attributes' => array(
  		'wrapper_class' => 	'text-uppercase'
    )
]);

piklist('field',[
	'type' => 'text',
	'scope' => 'post_meta',
	'field' => 'doc_department',
	'label' => '학과',
	'required' => true,
	'value' => get_post_meta($id, 'doc_department', true),
	'columns' => 8,
]);

piklist('field',[
	'type' => 'text',
	'scope' => 'post_meta',
	'field' => 'doc_major',
	'required' => true,
	'value' => get_post_meta($id, 'doc_major', true),
	'label' => '세부전공',
	'columns' => 8,
]);

piklist('field',[
	'type' => 'group',
	'scope' => 'post_meta',
	'field' => 'doc_grade',
	'value' => get_post_meta($id, 'doc_grade', true),
	'label' => '학점',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'doc_grade_my',
			'label' => '평균 학점',
			'columns' => 4],
		[
			'type'=> 'radio',
			'field' => 'doc_grade_full',
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
	'field' => 'doc_ent',
	'value' => get_post_meta($id, 'doc_ent', true),
	'required' => true,
	'label' => '입학 연도/학기',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'doc_ent_year',
			'required' => true,
			'label' => '입학 연도',
			'columns' => 4],
		[
			'type'=> 'radio',
			'field' => 'doc_ent_sem',
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
	'field' => 'doc_gradu',
	'value' => get_post_meta($id, 'doc_gradu', true),
	'required' => true,
	'label' => '졸업(예상) 연도/학기',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'doc_gradu_year',
			'label' => '졸업(예상) 연도',
			'required' => true,
			'columns' => 4],
		[
			'type'=> 'radio',
			'field' => 'doc_gradu_sem',
			'label' => '학기',
			'required' => true,
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
	'field' => 'doc_thesis',
	'value' => get_post_meta($id, 'doc_thesis', true),
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