<?php
namespace senMatchingRate;

class Bootstrap{
	public function __construct()
	{
		add_action( 'post_updated', array($this, 'post_updated'), 10, 3 );
		//add_action('updated_postmeta',array($this,'updated_postmeta'),10,4);
		add_action('favorites_after_favorite',array($this, 'favorites_after_favorite'),10,4);
	}

	public function post_updated($post_id, $after, $before){
		new MatchingRate\SyncAllMatchingRate($post_id);
	}
	public function updated_postmeta($meta_id, $opject_id, $meta_key, $meta_value){
		$post_type = get_post_type($opject_id);
		if($post_type == 'talent'||$post_type == 'career')
			new MatchingRate\SyncAllMatchingRate($opject_id);
	} 

	public function favorites_after_favorite($post_id, $status, $site_id, $user_id){
		new Matching\SyncMatching($post_id, $status, $site_id, $user_id);
	}
}