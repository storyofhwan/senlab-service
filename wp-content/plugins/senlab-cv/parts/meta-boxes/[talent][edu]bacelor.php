<?php
/*
Title: 학사 정보
Post Type: talent
Tab: Education
Flow: Talent Flows
*/

piklist('field',[
	'type' => 'text',
	'field' => 'bac_univ_name',
	'label' => '학교',
]);

piklist('field',[
	'type' => 'text',
	'field' => 'bac_department',
	'label' => '학과',
]);

piklist('field',[
	'type' => 'group',
	'field' => 'bac_grade',
	'label' => '학점',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'bac_grade_my',
			'label' => '평균 학점',
			'columns' => 2],
		[
			'type'=> 'select',
			'field' => 'bac_grade_full',
			'label' => '만점',
			'choices' => [
				'4.3' => '4.3','4.5' => '4.5'
			],
			'columns'=> 1]
	]
]);

piklist('field',[
	'type' => 'group',
	'field' => 'bac_ent',
	'label' => '입학 연도/학기',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'bac_ent_year',
			'label' => '입학 연도',
			'columns' => 2],
		[
			'type'=> 'select',
			'field' => 'bac_ent_sem',
			'label' => '학기',
			'choices' => [
				3 => '3월',
				9 => '9월'
			],
			'columns'=> 1]
	]
]);

piklist('field',[
	'type' => 'group',
	'field' => 'bac_gradu',
	'label' => '졸업(예상) 연도/학기',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'bac_gradu_year',
			'label' => '졸업(예상) 연도',
			'columns' => 2],
		[
			'type'=> 'select',
			'field' => 'bac_gradu_sem',
			'label' => '학기',
			'choices' => [
				2 => '2월',
				8 => '8월'
			],
			'columns'=> 1]
	]
]);

piklist('field',[
	'type' => 'text',
	'field' => 'bac_thesis',
	'label' => '학위 논문',
	'columns' => 5,
]);