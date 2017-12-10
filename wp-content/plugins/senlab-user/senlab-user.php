<?php
/*
Plugin Name: SENLab User
Plugin URI: https://senlab.co.kr/
Description: 유저에 관한 기능이 모여있는 플러그인입니다.
Version: 0.0.1
Author: 최명환
Author URI: https://facebook.co.kr/storyofhwan
License: 
Text Domain: senlab
*/

add_action('um_after_save_registration_details', 'sen_create_new_talent',20,2);
function sen_create_new_talent($user_id,$submitted){
	$postarr = [];
	if(user_can($user_id,'student')){
		if(isset($submitted['nickname'])){
			$postarr['post_title'] = $submitted['nickname'];
			$postarr['post_name'] = $postarr['post_title'];
		}
		else $postarr['post_title'] = 'Cant get submitted';

		$postarr['post_type'] = 'talent';
		$postarr['post_author'] = $user_id;
		$postarr['meta_input'] = [
			'name' => $submitted['nickname'],
			'degree' => $submitted['degree']
		];
		$post_id = wp_insert_post($postarr);

		if(isset($post_id)){
			update_user_meta($user_id, 'talent', $post_id);
			update_post_meta($post_id, 'student', $user_id);
			add_post_meta($post_id, '_edu', ['doc'=>'N', 'mas'=>'N', 'bac'=>'N']);
			add_post_meta($post_id, '_exp', 'N');
			add_post_meta($post_id, '_pub', 'N');
			add_post_meta($post_id, '_survey', 'N');
		}
	}
}


