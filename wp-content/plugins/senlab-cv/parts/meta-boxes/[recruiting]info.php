<?php
/*
Title: 채용 정보
Post Type: recruiting
*/

piklist('field', [
  'type' => 'text',
  'field' => 'post_title',
  'scope' => 'post',
  'label' => '채용명',
  'columns' => 8
]);

piklist('field',[
  'type' => 'select',
  'field' => 'recruiting_type',
  'label' => '채용유형',
  'columns' => 8,
  'choices' => array('' => '채용 유형을 선택하세요')+senlab_cv_get_terms_name('recruiting_type'),
]);

piklist('field',[
  'type' => 'select',
  'field' => 'major',
  'add_more' => true,
  'label' => '관심전공',
  'choices' => array('' => '채용 유형을 선택하세요')+senlab_cv_get_terms_name('major')
]);

piklist('field',[
  'type' => 'text',
  'field' => 'location',
  'label' => '근무 장소(주소)',
]);

piklist('field',[
  'type' => 'group',
  'field' => 'salary',
  'label' => '연봉',
  'fields' => [
    [
      'type' => 'number',
      'field' => 'salary_min',
      'columns' => 6,
      'description' => '최소 연봉'
    ],
    [
      'type' => 'number',
      'field' => 'salary_max',
      'columns' => 6,
      'description' => '최대 연봉'

    ],


  ]
]);

piklist('field',[
  'type' => 'group',
  'field' => 'period',
  'label' => '모집기간',
  'fields' => [
    [
      'type' => 'datepicker',
      'field' => 'period_start_date',
      'columns' => 6,
      'value' => date('Y.m.d'),
      'options' => [
        'dateFormat' => 'yy.mm.dd'
      ]
    ],
    [
      'type' => 'datepicker',
      'field' => 'period_end_date',
      'columns' => 6,
      'value' => date('Y.m.d'),
      'options' => [
        'dateFormat' => 'yy.mm.dd'
      ]

    ],
    [
      'type' => 'checkbox',
      'field' => 'period_always',
      'choices' => [
        true => '수시모집'
      ]
    ]

  ]
]);


piklist('field', [
  'type' => 'textarea',
  'field' => 'description',
  'label' => '채용 내용',
  'columns' => 10,
  'attributes' => [
    'cols' => 80
  ]
]);