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

piklist('field', [
	'type' => 'radio',
	'field' => 'author_type',
	'scope' => 'post_meta',
	'label' => '저자구분',
	'choices' => [
		'주저자' => '주저자',
		'공저자' => '공저자',
		'책임저자' => '책임저자'
	],
	'columns'=> 8
]);