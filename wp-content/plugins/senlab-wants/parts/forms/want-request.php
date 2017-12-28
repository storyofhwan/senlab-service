<?php
/*
Title: Request Want
Method: post
Logged in: true
Redirect: http://wordpress.dev/s-matching/s-want
*/

// Set where to save this form
piklist('field', array(
	'type' => 'hidden',
	'scope' => 'post',
	'field' => 'ID',
	'value' => ""
));

piklist('field',[
	'type' => 'hidden',
	'field' => 'status',
	'scope' => 'post_meta',
	'value' => "",
]);

piklist('field', array(
    'type' => 'submit'
    ,'field' => 'submit'
    ,'value' => 'submit'
    ,'attributes' => array(
      'wrapper_class' => 'sen-request-submit-real'
    )
  ));