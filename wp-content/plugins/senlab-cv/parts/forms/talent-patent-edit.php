<?php
/*
Title: Talent Edit - Patent
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

/*특허명, 등록(출원) 번호*/
piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '특허명',
	'colunms' => 8
]);

piklist('field', [
	'type' => 'text',
	'field' => 'application_number',
	'scope' => 'post_meta',
	'label' => '등록(출원) 번호',
	'colunms' => 8
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
