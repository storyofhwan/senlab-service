<?php
/*
Title: 희망 정보
Post Type: talent
Tab: Basic
Flow: Talent Flows
*/

piklist('field',[
	'type'	=> 'checkbox',
	'field'	=> 'wish_recruiting_type',
	'label'	=> '희망 채용 유형',
	'attributes' => [
		'class'	=> 'text'
	],
	'choices' => [
		'rec_normal' => '일반 채용',
		'rec_army' => '전문연구요원',
		'rec_scholar' => '산학장학생'
	]
]);