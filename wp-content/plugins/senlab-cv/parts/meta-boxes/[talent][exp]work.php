<?php
/*
Title: 인턴 및 직장 경력
Post Type: talent
Tab: Experience
Flow: Talent Flows
*/

piklist('field',[
	'type' => 'select',
	'scope' => 'post_meta',
	'field' => 'exp_work',
	'label' => '목록',
	'attributes' => [
		'multiple' => 'multiple'
	],
    'choices' => piklist(
		get_posts([
			'post_type' => 'exp_work',
			'hide_empty' => false 
		]), ['ID','post_title'])
]);