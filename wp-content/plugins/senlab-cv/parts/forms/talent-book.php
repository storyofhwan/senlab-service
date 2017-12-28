<?php
/*
Title: Talent Add - Book
Method: post
Logged in: true
Redirect: http://wordpress.dev/s-myinfo
*/

$user_id = get_current_user_id();
$talent_id = get_user_meta($user_id,'talent',true);

// Set where to save this form
piklist('field', array(
	'type' => 'hidden',
	'scope' => 'post',
	'field' => 'post_type',
	'value' => 'pub_book'
));

piklist('field', array(
    'type' => 'hidden',
    'scope' => 'post',
    'field' => 'post_status',
	'value' => 'publish'
 ));

piklist('field', [
	'type' => 'hidden',
	'scope' => 'post_meta',
	'field' => 'talent',
	'value' => $talent_id
]);

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
	'scope' => 'post_meta',
	'label' => '저자',
	'colunms' => 8
]);

piklist('field', [
	'type' => 'text',
	'field' => 'publisher',
	'scope' => 'post_meta',
	'label' => '출판사',
	'colunms' => 8
]);

piklist('field',[
	'type' => 'datepicker',
	'field' => 'publication_date',
	'scope' => 'post_meta',
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
	'scope' => 'post_meta',
	'label' => '설명',
	'columns' => 10,
	'attributes' => [
		'cols' => 80
	]
]);

/*submit button*/
piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'submit'
    ,'attributes' => array(
      'wrapper_class' => 'sen-edit-submit-real'
    )
  ));


