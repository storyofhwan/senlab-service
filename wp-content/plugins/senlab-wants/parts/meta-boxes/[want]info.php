<?php
/*
Title: 면접 요청
Post Type: want
*/

piklist('field',[
	'type' => 'text',
	'field' => 'student',
	'label' => '요청받은 학생 ID',
	'columns' => 8
]);

piklist('field',[
	'type' => 'text',
	'field' => 'manager',
	'label' => '요청한 매니저 ID',
	'columns' => 8
]);

piklist('field',[
	'type' => 'select',
	'field' => 'status',
	'label' => '상태',
	'columns' => 6,
	'choices'=> [
		'승인 대기'=>'승인 대기',
		'승인'=>'승인',
		'거절'=>'거절'
	]
]);

piklist('field',[
	'type'=>'datepicker',
	'field'=>'end_date',
	'label'=>'승인 가능 기한',
    'columns' => 6,
    'value' => date('Y.m.d'),
    'options' => [
      'dateFormat' => 'yy.mm.dd'
    ]
]);

piklist('field',[
	'type'=>'textarea',
	'field'=>'description',
	'label'=>'설명',
	'columns'=>12,
]);