<?php
/*
Title: 참여 연구 프로젝트 정보
Post Type: exp_research
*/

//직책, 회사, 기간, 설명

piklist('field', [
	'type' => 'text',
	'field' => 'position',
	'label' => '역할'
]);

piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '프로젝트명'
]);

piklist('field', [
	'type' => 'text',
	'field' => 'period',
	'label' => '연구기간'
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

