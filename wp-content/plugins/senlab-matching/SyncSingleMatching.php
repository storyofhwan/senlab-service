<?php
namespace senMatching

use Favorites\Entities\User\UserRepository;
use Favorites\Helpers;

class Matching
{
	/**
	* The Post ID
	*/
	private $post_id;

	/**
	* The Site ID
	*/
	private $site_id;

	/**
	* User ID
	*/
	private $user_id;

	/**
	* Status: active or inactive
	*/
	private $status


	public function __construct($post_id, $status, $site_id, $user_id)
	{
		$this->user_id = $user_id;
		$this->post_id = $post_id;
		$this->site_id = $site_id;
		$this->status = $status;
	}

	public function updateMatching(){
		if($this->status == 'active') return $this->addMatching;
		else if($this->status == 'inactive') return $this->removeMatching;
	}


	/**
	* is the post matching?
	* @return bool
	*/
	public checkMatching(){
		$post_type = get_post_type($this->post_id);
		if(user_can($this->user_id, 'student') && $post_type == 'career') $user_relation_post_type = 'talent';
		else if(user_can($this->user_id, 'career') && $post_type == 'talent') $user_relation_post_type = 'career';
		$user_relation_post_id = get_user_meta($user_id, $user_relation_post_type, true);
		if(!empty($user_relation_post_id)) $posts = get_posts_that_users_who_favorited_post_make($user_relation_post_id);
		else return false;
		
		foreach($posts as $post){
			if($this->post_id == $post->ID) return true;
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
		$matchings = $this->getAllMatchings($this->site_id);
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
		$matchings = $this->getAllMatchings($this->site_id);
		if ( !Helpers::siteExists($this->site_id, $matchings) ){
			$matchings[] = array(
				'site_id' => $this->site_id,
				'posts' => array(),
			);
		}
		// Loop through each site's matchings, continue if not the correct site id
		foreach($matchings as $key => $site_matchings){
			if ( $site_matchings['site_id'] !== $this->site_id ) continue;
			if($this->checkMatching()) $matchings[$key]['posts'][] = $this->post_id;
			else return false;
		}
		$this->updateUserMeta($matchings);
		return $matchings;
	}

	private getAllMatchings($site_id = $this->site_id)
	{
		$user_id_post = ( isset($_POST['user_id']) ) ? intval($_POST['user_id']) : get_current_user_id();
		$user_id = ( !is_null($user_id) ) ? $user_id : $user_id_post;
		$matchings = get_user_meta($user_id, 'simplematchings');
		if ( empty($matchings) ) return array(array('site_id'=> 1, 'posts' => array() ));

		return $matchings;

	}