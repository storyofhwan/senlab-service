<?php
/*
Title: 대표 정보
Post Type: career
*/

piklist('field',[
	'type' => 'select',
	'field' => 'c_major',
	'label' => '관심전공',
	'choices' => ['' => '관심 전공을 모두 선택하세요']+senlab_cv_get_terms_name('major'),
  'attributes' => [
    	'multiple' => 'multiple'
    ]
]);

piklist('field',[
	'type' => 'select',
	'field' => 'c_location',
	'label' => '소재지',
	'choices' => array('' => '기업 위치를 모두 선택하세요')+senlab_cv_get_terms_name('location'),
    'attributes' => [
    	'multiple' => 'multiple'
    ]
]);

piklist('field',[
	'type' => 'group',
	'field' => 'c_salary',
	'label' => '연봉',
	'fields' => [
		[	'type' => 'number',
			'field' => 'c_salary_graduate_school',
			'label' => '대학원연봉',
			'columns' => 2
		],
		['type'=> 'number',
			'field' => 'c_salary_section_chief',
			'label' => '과장연봉',
			'columns'=> 2
		]
	]
]);


piklist('field',[
  'type' => 'checkbox',
  'field' => 'c_recruiting_type',
  'label' => '채용유형',
  'choices' => senlab_cv_get_terms_name('recruiting_type'),
  'attributes' => [
    'multiple' => 'multiple'
  ]
]);

piklist('field', [
  'type' => 'textarea',
  'field' => 'c_branch',
  'label' => '연구/업무 분야',
  'attributes' => array(
      'class' => 'large-text'
    )
]);





