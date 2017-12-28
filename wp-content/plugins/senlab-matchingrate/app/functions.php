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

function is_matching($post_id=null, $user_id=null, $site_id=null){
	global $blog_id;
	$site_id = ( is_multisite() && is_null($site_id) ) ? $blog_id : $site_id;
	if ( !is_multisite() ) $site_id = 1;

	$user_id = (!empty($user_id))?$user_id: get_current_user_id();

	$all_matchings = get_user_meta($user_id,'simplematchings',true);
	foreach($all_matchings as $site_matchings){
		if ( $site_matchings['site_id'] == $site_id && isset($site_matchings['posts']) ){
			if(in_array($post_id,$site_matchings['posts'])) return true;
			else return false;
		}
	}
	return false;
}

function compare_matchingrate($id1, $id2){
	$rate1 = 0;
	$rate2 = 0;
	if(current_user_can('student')){	
		$talent_id = get_user_meta(get_current_user_id(),'talent',true);
        $rate1 = get_matching_rate($talent_id,$id1);
        $rate2 = get_matching_rate($talent_id,$id2);
        
    }
    else if(current_user_can('manager')){
    	$career_id = get_user_meta(get_current_user_id(),'career',true);
    	$rate1 = get_matching_rate($id1,$career_id);
        $rate2 = get_matching_rate($id2,$career_id);
    }

    if($rate1 == $rate2) return 0;
    return ($rate1 < $rate2) ? 1 : -1;
  }

/** Best fit
*	$user_id: 찾고 싶은 사용자 id
*	$number: 가져올 post 개수
*	return: array of post id
**/
function get_user_best_fit($user_id = null, $number = 4){
	$post_type = "";
	$post_ids = [];
	$best_fit = [];
	$user_id = (!empty($user_id))?$user_id:get_current_user_id();
	if(user_can($user_id,'student')){
		$post_type = 'career';
	}
	else if(user_can($user_id,'manager')){
		$post_type = 'talent';
	}

	if(isset($post_type)){
		$posts = get_posts(['nopaging'=> true, 'post_type' => $post_type,'post_status'=>'publish']);
        foreach($posts as $post) $post_ids[] = $post->ID;
        usort($post_ids,"compare_matchingrate");
	}

	for($i = 0; $i<4; $i++){
		$best_fit[$i] = $post_ids[$i];
	}

	return $best_fit;
}