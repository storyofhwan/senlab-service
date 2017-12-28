<?php
/*
Title: 저서 정보
Post Type: pub_book
*/

/*제목, 저자, 출판사, 출판 날짜, 설명*/
piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '제목',
	'colunms' => 8
]);

piklist('field', [
	'type' => 'text',
	'field' => 'author',
	'label' => '저자',
	'colunms' => 8
]);

piklist('field', [
	'type' => 'text',
	'field' => 'publisher',
	'label' => '출판사',
	'colunms' => 8
]);

piklist('field',[
	'type' => 'datepicker',
	'field' => 'publication_date',
	'label' => '출판 날짜',
	'columns' => 6,
	'value' => date('Y.m.d'),
	'options' => [
        'dateFormat' => 'yy.mm.dd'
    ]
]);

piklist('field', [
	'type' => 'textarea',
	'field' => 'description',
	'label' => '설명',
	'columns' => 10,
	'attributes' => [
		'cols' => 80
	]
]);