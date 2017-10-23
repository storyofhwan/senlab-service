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