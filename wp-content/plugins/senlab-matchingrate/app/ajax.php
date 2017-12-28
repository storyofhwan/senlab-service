<?php
add_action('wp_ajax_senlab_matching_role_change','senlab_matching_role_change');
function senlab_matching_role_change(){
	$id = $_POST['id'];
	wp_publish_post($id);

	wp_die();
}

add_action('wp_ajax_senlab_show_wish_update_modal','senlab_show_wish_update_modal');
function senlab_show_wish_update_modal(){
	$id = $_POST['id'];
	if(current_user_can('student')){
		$matchings = get_user_matchings(get_current_user_id());
		if(in_array($id,$matchings)) echo "<a href=".esc_url(home_url('/s-matching/?matching=matching')).">서로 WISH한 기업</a>에 추가되었습니다.";
		else echo "<a href=".esc_url(home_url('/s-matching')).">내가 WISH한 진로</a>에 추가되었습니다.";
	}
	if(current_user_can('manager')){
		$matchings = get_user_matchings(get_current_user_id());
		if(in_array($id,$matchings)) echo "<a href=".esc_url(home_url('/c-matching/?matching=matching')).">서로 WISH한 인재</a>에 추가되었습니다.";
		else echo "<a href=".esc_url(home_url('/c-matching')).">기업이 WISH한 인재</a>에 추가되었습니다.";
	}
	
	wp_die();
}

add_action('wp_ajax_senlab_new_wisher','senlab_new_wisher');
function senlab_new_wisher(){
	$new_wisher = get_user_meta($_POST['user_id'],'new_wisher');
	if(!empty($new_wisher)) echo 'true';
	else echo 'false';

	wp_die();
}

