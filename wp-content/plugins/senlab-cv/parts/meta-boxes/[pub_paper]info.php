<?php
/*
Title: 논문 정보
Post Type: pub_paper
*/

piklist('field', [
	'type' => 'text',
	'field' => 'journal',
	'label' => '저널명',
]);

piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '제목',
]);

piklist('field', [
	'type' => 'text',
	'field' => 'author_paper',
	'label' => '저자',
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