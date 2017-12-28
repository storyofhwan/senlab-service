<?php
/*
Title: Talent Edit - Paper
Method: post
Logged in: true
Redirect: http://wordpress.dev/s-myinfo
*/

$user_id = get_current_user_id();
$talent_id = get_user_meta($user_id,'talent',true);

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
	'field' => 'talent',
	'value' => $talent_id
]);


/*저널명, 제목, 저자, 저자구분*/
piklist('field', [
	'type' => 'text',
	'field' => 'journal',
	'scope' => 'post_meta',
	'label' => '저널명',
	'columns' => 8
]);

piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '제목',
	'columns' => 8
]);

piklist('field', [
	'type' => 'text',
	'field' => 'author',
	'scope' => 'post_meta',
	'label' => '저자',
	'columns' => 8
]);

piklist('field', [
	'type' => 'select',
	'field' => 'author_type',
	'scope' => 'post_meta',
	'label' => '저자구분',
	'choices' => [
		"" => '저자 유형을 선택해주세요',
		'주저자' => '주저자',
		'공저자' => '공저자',
		'책임저자' => '책임저자'
	],
	'columns'=> 8
]);
piklist('field', [
	'type' => 'textarea',
	'field' => 'description',
	'scope' => 'post_meta',
	'label' => '설명',
	'columns' => 10,
	'attributes' => [
		'cols' => 80
	]
]);


/*submit button*/
piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'submit'
    ,'attributes' => array(
      'wrapper_class' => 'sen-edit-submit-real'
    )
  ));
