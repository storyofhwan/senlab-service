<?php
/*
Title: 참여 연구 프로젝트
Post Type: talent
Tab: Experience
Flow: Talent Flows
*/

piklist('field',[
	'type' => 'select',
	'scope' => 'post_meta',
	'field' => 'exp_research',
	'label' => '목록',
	'attributes' => [
		'multiple' => 'multiple'
	],
    'choices' => piklist(
		get_posts([
			'post_type' => 'exp_research',
			'hide_empty' => false 
		]), ['ID','post_title'])
]);