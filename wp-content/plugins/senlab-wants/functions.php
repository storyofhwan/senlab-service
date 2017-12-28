<?php

//api
function get_wants_button($post_id=null){
	if(get_post_type($post_id) != 'talent') return "";
	$wish_recruiting_type = array_filter(get_post_meta($post_id,'wish_recruiting_type'));

	$status = (!empty($wish_recruiting_type))?1:0;
	$name = get_the_title($post_id);
	$student = get_post_meta($post_id,'student',true);


	$output = "<div><button class='btn btn-success w-100 mt-2 sen-want' data-student=".$student." data-status=".$status." data-name='".$name."'>면접요청</button></div>";
	return $output;
}