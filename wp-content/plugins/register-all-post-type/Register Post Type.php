<?php
/*
Plugin Name: Register All Post Type and Role
Plugin URI: https://senlab.com/
Description: Talent, Company post type을 추가합니다.
Version: 0.0.1
Author: 최명환
Author URI: 
Plugin Type: Piklist
*/
include 'childposttype.php';
add_action('init',function(){
	// talent post type 추가
	$labels = [
		'name' 			=> '인재',
		'singular_name' => '인재',
		'add_new'		=> '새 인재',
		'menu_name'		=> '인재 관리',
		'edit'			=> '인재 정보 수정',
		'edit_item'		=> '인재 정보 수정',
		'new_item'		=> '인재 추가',
		'view'			=> '인재 정보 보기',
		'search_items'	=> '인재 검색',
		'not_found'		=> '인재가 없습니다',
		'not_found_in_trash'	=> '인재가 없습니다'
	];

	$arg = [
		'labels' 				=> $labels,
		'description'			=> '석,박사의 상세정보가 저장된 post입니다',
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> false,
		'exclude_from_search'	=> false,
		'has_archive'			=> false,
		'capability_type'		=> 'post',
		'menu_position'			=> 6,
		'supports'				=> ['title']
	];

	//custom post type [talent] 추가
	register_post_type('talent',$arg);

	//[talent]의 child post type 추가

	$lists = \childPostType\listChild::$talentChild;

	foreach($lists as $field => $label){
		$cpt = new \childPostType\setChild($label, $field, 'talent');
		$cpt -> addPostType();
	}
});

// company post type 추가
add_action('init',function(){
	$labels = [
		'name' 			=> '진로',
		'singular_name' => '진로',
		'add_new'		=> '새 진로',
		'menu_name'		=> '진로 관리',
		'edit'			=> '진로 정보 수정',
		'edit_item'		=> '진로 정보 수정',
		'new_item'		=> '진로 추가',
		'view'			=> '진로 정보 보기',
		'search_items'	=> '진로 검색',
		'not_found'		=> '진로가 없습니다',
		'not_found_in_trash'	=> '진로가 없습니다'
	];

	$arg = [
		'labels' 				=> $labels,
		'description'			=> '다양한 진로의 상세정보가 저장된 post입니다',
		'public'				=> true,
		'show_ui'				=> true,
		'show_in_menu'			=> true,
		'show_in_nav_menus'		=> false,
		'exclude_from_search'	=> false,
		'has_archive'			=> false,
		'capability_type'		=> 'post',
		'menu_position'			=> 7,
		'supports'				=> ['title']
	];

	register_post_type('career',$arg);

	//[career]의 child post type 추가
	$lists = \childPostType\listChild::$careerChild;

	foreach($lists as $list){
		$name = $list[0];
		$slug = $list[1];

		$cpt = new \childPostType\setChild($name, $slug, 'career');
		$cpt -> addPostType();
	}
});

function add_roles_on_plugin_activation() {
 	add_role( 'student', '학생');
    add_role('manager','인사담당자');
}register_activation_hook( __FILE__, 'add_roles_on_plugin_activation' );