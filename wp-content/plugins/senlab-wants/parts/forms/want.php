<?php
/*
Title: Add Want
Method: post
Logged in: true
Redirect: http://wordpress.dev/c-matching/
*/
$user_id = get_current_user_id();
$career_id = get_user_meta($user_id,'career',true);
$title = get_the_title($career_id);

// Set where to save this form
piklist('field', array(
	'type' => 'hidden',
	'scope' => 'post',
	'field' => 'post_type',
	'value' => 'want'
));

piklist('field', array(
	'type' => 'hidden',
	'scope' => 'post',
	'field' => 'post_status',
	'value' => 'publish'
));

piklist('field',[
	'type' => 'hidden',
	'field'=>'post_title',
	'scope'=>'post',
	'value'=>$title
]);
piklist('field',[
	'type' => 'hidden',
	'field' => 'student',
	'scope' => 'post_meta',
	'value' => "",
]);

piklist('field',[
	'type' => 'hidden',
	'field' => 'manager',
	'scope' => 'post_meta',
	'value' => $user_id,
]);

piklist('field',[
	'type' => 'hidden',
	'field' => 'status',
	'scope' => 'post_meta',
	'value' => '승인 대기',
]);

piklist('field',[
	'type'=>'datepicker',
	'field'=>'end_date',
	'scope' => 'post_meta',
	'label'=>'승인 가능 기한',
    'columns' => 6,
    'value' => date('Y.m.d'),
    'options' => [
      'dateFormat' => 'yy.mm.dd'
    ]
]);

piklist('field',[
	'type'=>'textarea',
	'field'=>'description',
	'scope' => 'post_meta',
	'label'=>'설명',
	'columns'=>12,
]);

piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'submit'
    ,'attributes' => array(
      'wrapper_class' => 'sen-edit-submit-real'
    )
  ));