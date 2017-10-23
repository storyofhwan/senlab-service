<?php
/*
Title: 인턴 및 직장 경력 정보
Post Type: exp_work
*/

//직책, 회사, 기간, 설명

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
	'field' => 'period',
	'label' => '근무기간'
]);

piklist('field', [
	'type' => 'textarea',
	'field' => 'description',
	'label' => '설명',
	'attributes' => [
		'rows' => 10,
		'cols' => 80
	]
]);