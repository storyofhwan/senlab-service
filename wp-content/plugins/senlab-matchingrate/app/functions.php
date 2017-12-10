<?php

//api

function get_matching_rate($talent_id, $career_id){
	$matching_rate_array = get_post_meta($talent_id,'matching_rate_array',true);
	if(empty($matching_rate_array)) return 0;
	else{
		$columns = array_column($matching_rate_array,'ID');
		$found_key = array_search($career_id,$columns);
		return $matching_rate_array[$found_key]['rate'];
	}
}
//wisher post 객체 리턴
function get_posts_that_users_who_favorited_post_make($post_id = null, $site_id = null, $user_role = null)
{
	$post_type = get_post_type($post_id);
	if($post_type == 'talent') $favoriting_post_type = 'career';
	else if($post_type == 'career') $favoriting_post_type = 'talent';

	$users = get_users_who_favorited_post($post_id);
	$posts = array();

	foreach($users as $user){
		$favoriting_post_id = get_user_meta($user->ID, $favoriting_post_type , true);
		if(isset($favoriting_post_id)) $posts[] = get_post($favoriting_post_id);
	}
	//$posts = array_unique($posts);
	return $posts;
}
//matching post id 리턴
function get_user_matchings($user_id = null, $site_id = null){
	global $blog_id;
	$site_id = ( is_multisite() && is_null($site_id) ) ? $blog_id : $site_id;
	if ( !is_multisite() ) $site_id = 1;

	$all_matchings = get_user_meta($user_id, 'simplematchings',true);
	foreach($all_matchings as $site_matchings){
		if ( $site_matchings['site_id'] == $site_id && isset($site_matchings['posts']) ) return $site_matchings['posts'];
	}
	return array();
}

function compare_matchingrate($id1, $id2){
    $talent_id = get_user_meta(get_current_user_id(),'talent',true);
    $rate1 = get_matching_rate($talent_id,$id1);
    $rate2 = get_matching_rate($talent_id,$id2);
    if($rate1 == $rate2) return 0;
    return ($rate1 < $rate2) ? 1 : -1;
  }
