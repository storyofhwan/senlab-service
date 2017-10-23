<?php
/*
Title: 진로명
Post Type: career
*/

piklist('field',[
	'type' => 'radio',
	'field' => 'career_type',
	'label' => '진로 유형',
	'choices' => piklist(get_terms(array(
      'taxonomy' => 'career_type'
      ,'hide_empty' => false
    ))
    ,array(
      'term_id'
      ,'name'
    )
  )
]);

piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '이름'
]);

piklist('field', [
	'type' => 'text',
	'field' => 'subtitle',
	'label' => '부서명',
	'description' => '부서 별로 채용을 다르게 진행한다면 추가적으로 부서명도 입력'
]);
