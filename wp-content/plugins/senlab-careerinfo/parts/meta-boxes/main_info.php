<?php
/*
Title: 대표 정보
Post Type: career
*/
piklist('field',[
	'type' => 'select',
	'field' => 'c_major',
	'label' => '관심전공',
	'choices' => array('' => '관심 전공을 모두 선택하세요')
    + piklist(get_terms(array(
      'taxonomy' => 'major'
      ,'hide_empty' => false
    ))
    ,array(
      'term_id'
      ,'name'
    )
  ),
    'attributes' => [
    	'multiple' => 'multiple'
    ]
]);

piklist('field',[
	'type' => 'select',
	'field' => 'c_location',
	'label' => '소재지',
	'choices' => array('' => '기업 위치를 모두 선택하세요')
    + piklist(get_terms(array(
      'taxonomy' => 'location'
      ,'hide_empty' => false
    ))
    ,array(
      'term_id'
      ,'name'
    )
  ),
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
			'field' => 'c_salary_low',
			'label' => '최소',
			'columns' => 2
		],
		['type'=> 'number',
			'field' => 'c_salary_high',
			'label' => '최대',
			'columns'=> 2
		]
	]
]);


piklist('field',[
  'type' => 'checkbox',
  'field' => 'c_recruiting_type',
  'label' => '채용유형',
  'choices' => piklist(get_terms(array(
    'taxonomy' => 'recruiting_type',
    'hide_empty' => false
    )),
    array(
      'term_id',
      'name'
    )
  ),
  'attributes' => [
    'multiple' => 'multiple'
  ]
]);