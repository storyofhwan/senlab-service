<?php
/*
Plugin Name: SENLab CV
Plugin URI: https://senlab.co.kr/
Description: 학생과 기업의 상세 정보 등록, 수정, 삭제
Version: 0.0.1
Author: 최명환
Author URI: https://facebook.co.kr/storyofhwan
License: 
Text Domain: senlab
Plugin Type: Piklist
*/

/*Enqueue*/
/*application.js 파일 enqueue*/
function senlab_cv_enqueue_scripts(){
	wp_enqueue_script('senlab-cv',plugins_url('senlab-cv/assets/js/application.js',dirname(__FILE__)),['jquery'], null, true);
	$localized_data = [
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce(),
			'logged_in' => is_user_logged_in(),
			'user_id' => get_current_user_id()
		];
	wp_localize_script('senlab-cv', 'ajaxObject', $localized_data);
}
add_action( 'wp_enqueue_scripts', 'senlab_cv_enqueue_scripts');







/*Action*/
/*Child Post등록 시 Post의 정보 업데이트*/
function senlab_cv_save_child_post($post_id, $post, $update){
	//$url = "http://wordpress.dev/s-myinfo";
	$post_type = get_post_type($post_id);

	//child post의 상위 포스트의 id
	if(!is_user_logged_in()) return;
	if(current_user_can('student')){
		$talent_id = get_user_meta(get_current_user_id(),'talent',true);
		if(empty($talent_id)||get_post_type($talent_id)!='talent') return;
		switch($post_type){
			case "exp_work":
			case "exp_research":
			update_post_meta($talent_id,'_exp',"Y");
			if(!in_array($post_id, get_post_meta($talent_id,$post_type))) add_post_meta($talent_id,$post_type,$post_id);
			break;

			case "pub_paper":
			case "pub_conf":
			case "pub_patent":
			case "pub_book":
			update_post_meta($talent_id,'_pub',"Y");
			if(!in_array($post_id, get_post_meta($talent_id,$post_type))) add_post_meta($talent_id,$post_type,$post_id);
			break;

			default: break;
		}
	}
	else if(current_user_can('manager')){
		$career_id = get_user_meta(get_current_user_id(),'career',true);
		if(empty($career_id)||get_post_type($career_id)!='career') return;
		switch($post_type){
			case "recruiting":
			update_post_meta($career_id,'_rec',"Y");
			if(!in_array($post_id, get_post_meta($career_id,$post_type))) add_post_meta($career_id,$post_type,$post_id);
			break;

			default: return;
		}
	}

}
add_action('wp_insert_post', 'senlab_cv_save_child_post', 10, 3 );


function update_manager_meta_career($meta_id, $post_id, $meta_key, $meta_value){
  if(get_post_type($post_id)=='career' && $meta_key == 'manager'){
    update_user_meta((int)$meta_value,'career',$post_id);
  }
  else return;
}
add_action('updated_postmeta','update_manager_meta_career',10,4);











/*AJAX*/
/*ajax 정보를 받아 child post의 정보 수정*/
function edit_child_post(){
	$id = empty($_POST['id'])?"":$_POST['id'];
	$post_type = $_POST['post_type'];
	$output =[];
	if($_POST['behave']=='edit'&&!empty($id)){
		switch($post_type){
			case 'recruiting';
			$output['title'] = get_the_title($id);
			$output['recruiting_type'] = get_post_meta($id, 'recruiting_type',true);
			$output['major'] = get_post_meta($id, 'major');
			$output['location'] = get_post_meta($id,'location',true);
			$output['salary'] = get_post_meta($id,'salary',true);
			$output['period'] = get_post_meta($id,'period',true);
			$output['description'] = get_post_meta($id, 'description',true);
			break;

			case 'exp_work':
			$output['title'] = get_the_title($id);
			$output['company'] = get_post_meta($id,'company',true);
			$output['location'] = get_post_meta($id, 'location',true);
			$output['period'] = get_post_meta($id, 'period',true);
			$output['description'] = get_post_meta($id, 'description',true);
			break;
		}
	}
	else if($_POST['behave']=='delete'){
		if($post_type == 'recruiting'){
			$career_id = get_post_meta($id,'career',true);
			delete_post_meta($career_id,$post_type,$id);
			wp_delete_post($id);

			$output['id'] = $id;
			$output['career_id'] = $career_id;
			$output['post_type'] = $post_type;
		}
		else{
			$talent_id = get_post_meta($id,'talent',true);
			delete_post_meta($talent_id,$post_type,$id);
			wp_delete_post($id);
			if(empty(get_post_meta($talent_id,$post_type))){
				switch($post_type){
					case "exp_work":
					case "exp_research":
					update_post_meta($talent_id,'_exp',"N");
					break;	

					case "pub_paper":
					case "pub_conf":
					case "pub_patent":
					case "pub_book":
					update_post_meta($talent_id,'_pub',"N");
					break;
				}
			}	
			$output['id'] = $id;
			$output['talent_id'] = $talent_id;
			$output['post_type'] = $post_type;
		}
		
	}


	echo json_encode($output);
	wp_die();
}
add_action('wp_ajax_senlab_cv_edit_child_post','edit_child_post');



function edit_wish_recruiting(){
	$user_id = get_current_user_id();
	$talent_id = get_user_meta($user_id,'talent',true);
	$recruiting_type = $_POST['recruiting_type'];
	$action = $_POST['behaving'];
	
	if($action=='add'){
		add_post_meta($talent_id,'wish_recruiting_type',$recruiting_type);
	}
	else if($action=='delete'){
		delete_post_meta($talent_id,'wish_recruiting_type',$recruiting_type);
	}
	echo 'test';
	wp_die();
}
add_action('wp_ajax_senlab_cv_edit_wish_recruiting','edit_wish_recruiting');













/*filter*/

function really_simple_csv_importer_save_meta_filter( $meta, $post, $is_update ) {
    // serialize metadata
    $c_salary_array = array();
    if (isset($meta['c_salary_graduate_school'])) $meta_array['c_salary_graduate_school'] = $meta['c_salary_graduate_school'];
    if (isset($meta['c_salary_section_chief'])) $meta_array['c_salary_section_chief'] = $meta['c_salary_section_chief'];
    unset($meta['c_salary_graduate_school']);
    unset($meta['c_salary_section_chief']);
    $meta = $meta+array( 'c_salary' => $meta_array );

    return $meta;
}
add_filter( 'really_simple_csv_importer_save_meta', 'really_simple_csv_importer_save_meta_filter', 10, 3 );




/*API*/
function senlab_cv_get_terms_name($taxonomy){
	$names = [];
	$names_terms = get_terms(array('taxonomy'=>$taxonomy,'hide_empty'=>false));
	foreach($names_terms as $term){
    	$names[$term->name] = $term->name;
  	}
  	return $names;
}



