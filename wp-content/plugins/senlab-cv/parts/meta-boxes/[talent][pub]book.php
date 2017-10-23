<?php
/*
Title: 저서
Post Type: talent
Tab: Publishing
Flow: Talent Flows
*/

piklist('field',[
	'type' => 'select',
	'scope' => 'post_meta',
	'field' => 'pub_book',
	'label' => '목록',
	'attributes' => [
		'multiple' => 'multiple'
	],
    'choices' => piklist(
		get_posts([
			'post_type' => 'pub_book',
			'hide_empty' => false 
		]), ['ID','post_title'])
]);