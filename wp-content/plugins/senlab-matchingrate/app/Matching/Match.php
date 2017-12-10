<?php
namespace senMatchingRate\Matching;

use Favorites\Entities\User\UserRepository;
use Favorites\Helpers;

class Match
{

	/**
	* The Site ID
	*/
	private $site_id;

	private $post_id;
	private $user_id;
	private $post_type;

	private $opposite_user_id;
	private $opposite_post_id;
	private $opposite_post_type;

	private $status;


	public function __construct($status, $site_id, $post_id, $user_id, $opposite_post_id, $opposite_user_id)
	{
		$this->site_id = $site_id;
		$this->status = $status;

		$this->user_id = $user_id;
		$this->post_id = $post_id;

		$this->opposite_user_id = $opposite_user_id;
		$this->opposite_post_id = $opposite_post_id;
		

		$this->post_type = get_post_type($post_id);
	
		if(user_can($this->user_id, 'student') && $this->post_type == 'career'){
			$this->opposite_post_type = 'talent';
			$this->user_role = 'student';
		}
		else if(user_can($user_id, 'manager') && $this->post_type == 'talent'){
			$this->opposite_post_type = 'career';
			$this->user_role = 'manager';
		}
	}

	public function updateMatching(){
		if($this->status == 'active') { update_user_meta($this->user_id,'matching_test','active'); return $this->addMatching(); }
		else if($this->status == 'inactive') { update_user_meta($this->user_id,'matching_test','inactive'); return $this->removeMatching();}
	}


	/**
	* is the post matching?
	* @return bool
	*/
	public function checkMatching(){
		if(!empty($this->opposite_post_id)) $posts = \get_posts_that_users_who_favorited_post_make($this->opposite_post_id);
		else return false;

		if(!empty($posts)){
			foreach($posts as $post){
				if($this->post_id == $post->ID) return $post->ID;
			}
		}
		
		

		return false;
	}

	/**
	* Update User Meta (logged in only)
	*/
	public function updateUserMeta($matchings)
	{
		update_user_meta( intval($this->user_id), 'simplematchings', $matchings );
	}


	
	/**
	* Remove a Matching
	* @return array of bool. if the post was matched, return post array. else, return false.
	*/
	private function removeMatching()
	{
		$matchings = $this->getAllMatchings();
		$remove = false;

		foreach($matchings as $key => $site_matchings){
			if ( $site_matchings['site_id'] !== $this->site_id ) continue;
			foreach($site_matchings['posts'] as $k => $mat){
				if ( $mat == $this->post_id ){
					unset($matchings[$key]['posts'][$k]);
					$remove = true;
				}
			}
		}
		$this->updateUserMeta($matchings);
		if($remove == true) return $matchings;
		else return false;
	}

	/**
	* Add a Matching
	* @return array of bool. if the post is new matching, return post array. else, return false.
	*/
	private function addMatching()
	{
		$matchings = $this->getAllMatchings();

		// Loop through each site's matchings, continue if not the correct site id
		foreach($matchings as $key => $site_matchings){
			if ( $site_matchings['site_id'] !== $this->site_id ) continue;
			$matching_post_id = $this->checkMatching();
			if($matching_post_id!=false) $matchings[$key]['posts'][] = $this->post_id;
			else return false;
		}
		$this->updateUserMeta($matchings);
		return $matchings;
	}

	private function getAllMatchings()
	{
		$user_id_post = ( isset($_POST['user_id']) ) ? intval($_POST['user_id']) : get_current_user_id();
		$user_id = ( !is_null($this->user_id) ) ? $this->user_id : $user_id_post;
		$matchings = get_user_meta($user_id, 'simplematchings',true);
		if ( empty($matchings) ) $matchings =  array(array('site_id'=> 1, 'posts' => array() ));

		return $matchings;
	}
}