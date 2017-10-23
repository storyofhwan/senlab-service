<?php
/*
Title: 특허 정보
Post Type: pub_patent
*/

piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '특허명'
]);

piklist('field', [
	'type' => 'text',
	'field' => 'application_number',
	'label' => '등록(출원)번호'
]);