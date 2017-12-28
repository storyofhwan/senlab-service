<?php
/*
Plugin Name: SENLab MatchingRate
Plugin URI: https://senlab.co.kr/
Description: SENLab의 매칭/매칭률 기능을 담당합니다.
Version: 0.0.1
Author: 최명환
Author URI: https://facebook.co.kr/storyofhwan
License: 
Text Domain: senlab
*/
if( !class_exists('Bootstrap') ) :
	require_once(__DIR__ . '/vendor/autoload.php');
	require_once(__DIR__ . '/app/senMatchingRate.php');
	require_once(__DIR__ . '/app/ajax.php');
	require_once(__DIR__ . '/app/functions.php');

	senMatchingRate::init();

endif;

add_action( 'wp_enqueue_scripts', 'senlab_matchingrate_enqueue_scripts');
add_action( 'wp_enqueue_scripts', 'senlab_matching_enqueue_scripts');
//add_action( 'wp_enqueue_scripts', 'senlab_new_wisher_enqueue_scripts');




function senlab_matchingrate_enqueue_scripts(){
	wp_enqueue_script('senlab-matchingrate',plugins_url('senlab-matchingrate/assets/js/matchingrate.js',dirname(__FILE__)),['jquery'], null, true);
	$localized_data = [
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce(),
			'logged_in' => is_user_logged_in(),
			'user_id' => get_current_user_id()
		];
	wp_localize_script('senlab-matchingrate', 'ajaxObject', $localized_data);
}


function senlab_matching_enqueue_scripts(){
	wp_enqueue_script('senlab-matching',plugins_url('senlab-matchingrate/assets/js/application.js',dirname(__FILE__)),['jquery'], null, true);
	$localized_data = [
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce(),
			'logged_in' => is_user_logged_in(),
			'user_id' => get_current_user_id()
		];
	wp_localize_script('senlab-matching', 'ajaxObject', $localized_data);
}

function senlab_new_wisher_enqueue_scripts(){
	wp_enqueue_script('senlab-new_wisher',plugins_url('senlab-matchingrate/assets/js/new-wisher.js',dirname(__FILE__)),['jquery'], null, true);
	$localized_data = [
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce(),
			'logged_in' => is_user_logged_in(),
			'user_id' => get_current_user_id()
		];
	wp_localize_script('senlab-matching', 'ajaxObject', $localized_data);
}


