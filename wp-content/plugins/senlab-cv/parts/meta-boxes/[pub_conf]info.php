<?php
/*
Title: 학회 정보
Post Type: pub_conf
*/

piklist('field', [
	'type' => 'text',
	'field' => 'conference',
	'label' => '학회명',
	'description' => '개최연도도 포함 ex)대한기계공학회(2017)'
]);

piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post'
	'label' => '제목'
]);

piklist('field', [
	'type' => 'text',
	'field' => 'author',
	'label' => '저자',
	'attributes' => [
 		'class' => 'text'
 	]
]);

piklist('field',[
	'type'	=> 'select',
	'field'	=> 'author_type',
	'label'	=> '저자구분',
	'attributes' => [
		'class'	=> 'text'
	],
	'choices' => [
		'lead-author' => '주저자',
		'co-author' => '공저자',
		'responsible-author' => '책임저자'
	]
]);