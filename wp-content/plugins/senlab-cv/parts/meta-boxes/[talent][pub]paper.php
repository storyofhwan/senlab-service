<?php
/*
Title: 논문
Post Type: talent
Tab: Publishing
Flow: Talent Flows
*/

piklist('field',[
	'type' => 'select',
	'scope' => 'post_meta',
	'field' => 'pub_paper',
	'label' => '목록',
	'attributes' => [
		'multiple' => 'multiple'
	],
    'choices' => piklist(
		get_posts([
			'post_type' => 'pub_paper',
			'hide_empty' => false 
		]), ['ID','post_title'])
]);