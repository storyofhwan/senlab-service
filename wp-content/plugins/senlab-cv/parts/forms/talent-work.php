<?php
/*
Title: Talent Add - Work
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
	'field' => 'post_type',
	'value' => 'exp_work'
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


piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '직함',
	'colunms' => 8
]);

piklist('field', [
	'type' => 'text',
	'field' => 'company',
	'scope' => 'post_meta',
	'label' => '회사 혹은 연구소',
	'colunms' => 8
]);

piklist('field', [
	'type' => 'text',
	'field' => 'location',
	'scope' => 'post_meta',
	'label' => '지역',
	'colunms' => 8
]);

$years =[];
for($i = date("Y"); $i > 1970; $i--){
	$years[$i] = $i.'년';
}

$months = [];
for($i = 1; $i < 13; $i ++){
	$months[$i] = $i.'월';
}

piklist('field',[
	'type' => 'group',
	'field' => 'period',
	'scope' => 'post_meta',
	'label' => '근무기간',
	'fields' => [
		[
			'type' => 'select',
			'field' => 'period_start_year',
			'columns' => 6,
			'value' => date("Y"),
			'choices' => $years,
		],
		[
			'type' => 'select',
			'field' => 'period_end_year',
			'columns' => 6,
			'value' => date("Y"),
			'choices' => $years,
		],
		[
			'type' => 'select',
			'field' => 'period_start_month',
			'columns' => 6,
			'value' => date("m"),
			'choices' => $months,
		],
		[
			'type' => 'select',
			'field' => 'period_end_month',
			'columns' => 6,
			'value' => date("m"),
			'choices' => $months,
		]

	]
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

piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'submit'
    ,'attributes' => array(
      'wrapper_class' => 'sen-edit-submit-real'
    )
  ));


