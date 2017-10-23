<?php
/*
Title: 학회
Post Type: talent
Tab: Publishing
Flow: Talent Flows
*/

piklist('field',[
	'type' => 'select',
	'scope' => 'post_meta',
	'field' => 'pub_conf',
	'label' => '목록',
	'attributes' => [
		'multiple' => 'multiple'
	],
    'choices' => piklist(
		get_posts([
			'post_type' => 'pub_conf',
			'hide_empty' => false 
		]), ['ID','post_title'])
]);