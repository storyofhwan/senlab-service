<?php
/*
Plugin Name: SENLab Matching
Plugin URI: https://senlab.co.kr/
Description: favorite 플러그인의 확장 기능이 포함된 플러그인입니다. Matching 기능을 담당합니다.
Version: 0.0.1
Author: 최명환
Author URI: https://facebook.co.kr/storyofhwan
License: 
Text Domain: senlab
*/


use senMatching\Matching;

add_action('favorites_after_favorite','updateMatching',10,4);
function updateMatching($post_id, $status, $site_id, $user_id){
	global $blog_id;
	$site_id = ( is_multisite() && is_null($site_id) ) ? $blog_id : $site_id;
	if ( !is_multisite() ) $site_id = 1;

	$post_type = get_post_type($this->post_id);
	$user_relation_post_type = null;
	
	if(user_can($this->user_id, 'student') && $post_type == 'career'){
		$user_relation_post_type = 'talent';
		$user_role = 'student';
	}
	else if(user_can($this->user_id, 'career') && $post_type == 'talent'){
		$user_relation_post_type = 'career';
		$user_role = 'manager';
	}

	if(is_null($user_relation_post_type)) return false;
	else{
		$matching = new Matching($post_id, $status, $site_id, $user_id);
		$matching->updateMatching();

		$post_id = get_user_meta($user_id, $user_relation_post_type, true);
		$user_id = get_post_meta($user_id, $user_role, true);

		$matching = new Matching($post_id, $status, $site_id, $user_id);
		$matching->updateMatching();
	} 
}