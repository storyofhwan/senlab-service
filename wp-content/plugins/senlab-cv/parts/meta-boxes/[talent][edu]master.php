<?php
/*
Title: 석사 정보
Post Type: talent
Tab: Education
Flow: Talent Flows
*/

piklist('field',[
	'type' => 'radio',
	'field' => 'mas_univ_name',
	'label' => '학교',
	'choices' => senlab_cv_get_terms_name('school'),
  	'attributes' => array(
  		'wrapper_class' => 	'text-uppercase'
    )
]);

piklist('field',[
	'type' => 'text',
	'field' => 'mas_department',
	'label' => '학과',
]);

piklist('field',[
	'type' => 'text',
	'field' => 'mas_major',
	'label' => '세부전공',
]);

piklist('field',[
	'type' => 'group',
	'scope' => 'post_meta',
	'field' => 'mas_grade',
	'label' => '학점',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'mas_grade_my',
			'label' => '평균 학점',
			'columns' => 4],
		[
			'type'=> 'radio',
			'field' => 'mas_grade_full',
			'label' => '만점',
			'choices' => [
				'4.3' => '4.3','4.5' => '4.5'
			],
			'columns'=> 2]
	]
]);
piklist('field',[
	'type' => 'group',
	'field' => 'mas_ent',
	'label' => '입학 연도/학기',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'mas_ent_year',
			'label' => '입학 연도',
			'columns' => 4],
		[
			'type'=> 'radio',
			'field' => 'mas_ent_sem',
			'label' => '학기',
			'list' => false,
			'choices' => [
				3 => '3월',
				9 => '9월'
			],
			'columns'=> 2]
	]
]);

piklist('field',[
	'type' => 'group',
	'field' => 'mas_gradu',
	'label' => '졸업(예상) 연도/학기',
	'fields' => [
		[
			'type' => 'text',
			'field' => 'mas_gradu_year',
			'label' => '졸업(예상) 연도',
			'columns' => 4],
		[
			'type'=> 'radio',
			'field' => 'mas_gradu_sem',
			'label' => '학기',
			'list' => false,
			'choices' => [
				2 => '2월',
				8 => '8월'
			],
			'columns'=> 2]
	]
]);

piklist('field',[
	'type' => 'text',
	'field' => 'mas_thesis',
	'label' => '학위 논문',
	'columns' => 5,
]);