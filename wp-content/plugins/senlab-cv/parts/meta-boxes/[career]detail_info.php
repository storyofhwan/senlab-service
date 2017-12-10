<?php
/*
Title: 상세 정보
Post Type: career
*/

piklist('field', [
	'type' => 'textarea',
	'field' => 'introduce',
	'label' => '기업 소개',
	'attributes' => array(
      'rows' => 10,
      'cols' => 50,
      'class' => 'large-text'
    )
]);


piklist('field', [
	'type' => 'select',
	'field' => 'c_welfare',
	'label' => '복지',
	'choices' => ['' => '복지를 모두 선택하세요']+senlab_cv_get_terms_name('welfare'),
  	'attributes' => [
    	'multiple' => 'multiple'
    ]
]);