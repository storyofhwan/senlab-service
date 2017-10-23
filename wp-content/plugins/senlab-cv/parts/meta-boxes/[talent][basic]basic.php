<?php
/*
Title: 기본 정보
Post Type: talent
Tab: Basic
Flow: Talent Flows
*/

piklist('field', [
	'type' => 'text',
	'field' => 'name',
	'label' => '이름',
	'attributes' => [
 		'class' => 'text'
 	]
]);

piklist('field',[
	'type'	=> 'select',
	'field'	=> 'degree',
	'label'	=> '학력',
	'attributes' => [
		'class'	=> 'text'
	],
	'choices' => [
		'석사과정'=>'석사과정',
		'석사'=>'석사',
		'박사과정'=>'박사과정',
		'박사수료'=>'박사수료',
		'박사'=>'박사'
	]
]);