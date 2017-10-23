<?php
/**
* Secondary plugin API functions
*/

/**
* Get an array of Posts that users who favorited post 
* @return array of WP_Post object
**/
function get_posts_that_users_who_favorited_post_make($post_id = null, $site_id = null, $user_role = null)
{
	$post_type = get_post_type($post_id);
	if($post_type == 'talent') $favoriting_post_type = 'career';
	else if($post_type == 'career') $favoriting_post_type = 'talent'

	get_users_who_favorited_post($post_id);
	$posts = array();

	foreach($users as $user){
		$favoriting_post_id = get_user_meta($user->ID, $favoriting_post_type , true);
		if(isset($favoriting_post_id)) $posts[] = get_post($favoriting_post_id);
	}
	$posts = array_unique($post);
	return $posts;
}


/**
* Get an array of User Matchings
* @param $user_id int, defaults to current user
* @param $site_id int, defaults to current blog/site
* @param $filters array of post types/taxonomies
* @return array
*/
function get_user_matchings($user_id = null, $site_id = null){
	global $blog_id;
	$site_id = ( is_multisite() && is_null($site_id) ) ? $blog_id : $site_id;
	if ( !is_multisite() ) $site_id = 1;

	$all_matchings = get_user_meta($user_id, 'simplematchings');
	foreach($all_matchings as $site_matchings){
		if ( $site_favorites['site_id'] == $site_id && isset($site_favorites['posts']) ) return $site_favorites['posts'];
	}
	return array();
}

