<?php
namespace senMatchingRate\Matching;

use senMatchingRate\Matching\Match;

class SyncMatching{

	private $site_id;
	private $user_role;
	private $opposite_user_role;

	private $post_id;
	private $user_id;
	private $post_type;

	private $opposite_user_id;
	private $opposite_post_id;
	private $opposite_post_type;


	public function __construct($post_id, $status, $site_id, $user_id){
		global $blog_id;
		$site_id = ( is_multisite() && is_null($site_id) ) ? $blog_id : $site_id;
		if ( !is_multisite() ) $site_id = 1;
		$this->site_id = $site_id;

		$this->post_id = $post_id;
		$this->user_id = $user_id;
		$this->post_type = get_post_type($post_id);
	
		if(user_can($this->user_id, 'student') && $this->post_type == 'career'){
			$this->opposite_post_type = 'talent';
			$this->user_role = 'student';
			$this->opposite_user_role = 'manager';
		}
		else if(user_can($user_id, 'manager') && $this->post_type == 'talent'){
			$this->opposite_post_type = 'career';
			$this->user_role = 'manager';
			$this->opposite_user_role = 'student';
		}

		$this->opposite_post_id = get_user_meta($this->user_id, $this->opposite_post_type, true);
		$this->opposite_user_id = get_post_meta($this->post_id, $this->opposite_user_role, true);


		if(!empty($this->opposite_user_id)){
			$matching = $this->update_matching($this->post_id, $status, $this->site_id, $this->user_id, $this->opposite_post_id, $this->opposite_user_id);

			//매칭이라면 opposite user도 업데이트
			if($matching!=false){
				$this->update_matching($this->opposite_post_id, $status, $this->site_id, $this->opposite_user_id, $this->post_id, $this->user_id);
			}
		}
		
	}

	public function update_matching($post_id, $status, $site_id, $user_id, $opposite_post_id, $opposite_user_id){
		$matching = new Match($status, $site_id, $post_id, $user_id, $opposite_post_id, $opposite_user_id);
		return $matching->updateMatching();
	}
}
