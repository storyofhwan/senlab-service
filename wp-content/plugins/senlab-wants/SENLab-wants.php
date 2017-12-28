<?php
/*
Plugin Name: SENLab Wants
Plugin URI: https://senlab.co.kr/
Description: Wants기능을 담당합니다.
Version: 0.0.1
Author: 최명환
Author URI: https://facebook.co.kr/storyofhwan
License: 
Text Domain: senlab
Plugin Type: Piklist
*/

require_once(__DIR__ . '/functions.php');

/*Enqueue*/
/*application.js 파일 enqueue*/
function senlab_wants_enqueue_scripts(){
	wp_enqueue_script('senlab-wants',plugins_url('senlab-wants/assets/js/application.js',dirname(__FILE__)),['jquery'], null, true);
	$localized_data = [
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce(),
			'logged_in' => is_user_logged_in(),
			'user_id' => get_current_user_id()
		];
	wp_localize_script('senlab-wants', 'ajaxObject', $localized_data);
}
add_action( 'wp_enqueue_scripts', 'senlab_wants_enqueue_scripts');

/*action*/
//Want 등록 시
/*
function update_student_wants_request($post_id, $post, $update){
	if(get_post_type($post_id)!='want') return;
	 //if ( isset( $_POST['student'] ) ) $student_id = (int)$_POST['student'];
	 //if ( isset( $_POST['manager'] ) ) $manager_id = (int)$_POST['manager'];
	$student_id = $_POST['_post_meta[student]'];
	$manager_id = $_POST['_post_meta[manager]'];
	 update_post_meta($post_id,'want_test_student','student id='.$student_id);
	 update_post_meta($post_id,'want_test_manager','manager id='.$manager_id);


	 if(user_can($student_id,'student')&&user_can($manager_id,'manager')){
	 	add_user_meta($manager_id,'wants_list',$post_id);
	 	add_user_meta($student_id,'wants_request',$post_id);
	 	update_user_meta($student_id,'new_wants',true);
	 }
}
add_action('save_post', 'update_student_wants_request', 1000, 3 );

//Want 삭제 시
add_action('before_delete_post', function($post_id){
	if(get_post_type($post_id)!='want') return;
	 $student_id = get_post_meta($post_id,'student',true);
	 $manager_id = get_post_meta($post_id,'manager',true);

	 if(user_can($student_id,'student')&&user_can($manager_id,'manager')){
	 	delete_user_meta($manager_id,'wants_list',$post_id);
	 	delete_user_meta($student_id,'wants_request',$post_id);
	 }
});
*/