<?php
/*
Title: 인턴 및 직장 경력 정보
Post Type: exp_work
*/


piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '직함'
]);

piklist('field', [
	'type' => 'text',
	'field' => 'company',
	'label' => '회사 혹은 연구소'
]);

piklist('field', [
	'type' => 'text',
	'field' => 'location',
	'label' => '지역'
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
	'label' => '근무기간',
	'fields' => [
		[
			'type' => 'select',
			'field' => 'period_start_year',
			'columns' => 6,
			'choices' => $years,
		],
		[
			'type' => 'select',
			'field' => 'period_end_year',
			'columns' => 6,
			'choices' => $years,
		],
		[
			'type' => 'select',
			'field' => 'period_start_month',
			'columns' => 6,
			'choices' => $months,
		],
		[
			'type' => 'select',
			'field' => 'period_end_month',
			'columns' => 6,
			'choices' => $months,
		]

	]
]);

piklist('field', [
	'type' => 'textarea',
	'field' => 'description',
	'label' => '설명',
	'column' => 10,
	'attributes' => [
		'cols' => 80
	]
]);