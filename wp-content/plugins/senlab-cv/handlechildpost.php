<?php
class theChildPost{
	private $postarr = [
		'user_id' => get_current_user_id(),
		'id' => null,
		'parent_id' => null,
		'post_type' => 'post',
		'meta_arr' => []
	]
	private function checkRightChild(){
		$arr = $this -> postarr;
		$parent_type = get_post_type($arr['parent_id']);

		if($parent_type == 'talent') $child_list = \childPostType\listChild::$talentChild;
		else if($parent_type == 'career') $child_list = \childPostType\listChild::$careerChild;
		else return false;

		if(array_key_exists($arr['post_type'],$child_list)) return true;
			else return false;
	}

	public function __constructor($arr){
		$this -> postarr = array_merge($this -> postarr, $arr);
	}

	public function addThePost(){
		extract($this -> postarr);
		$title = $meta_arr['title'];

		if(empty($title) || empty($user_id) || empty($parent_id) || empty($post_type)) return false;
		else{
			if(checkRightChild()) return false;
			$meta_arr['__relate_post'] = $parent_id;
		
			$arr = [
				'post_author' => $user_id;
				'post_title' => $title;
				'post_status' => 'publish';
				'post_type' => $post_type;
				'meta_input' => $meta_arr;
			]

			if($id = wp_insert_post($arr)){
				$this -> id = $id;
				return true;
			}
			else return false;
		}
	}

	public function deleteThePost(){

	}
	public function updateThePost();

	//특정 Child Post를 리턴
	public function getThePost();

	//$post_type에 해당하는 child post를 모두 가져옴
	public static function getChildPosts($post_type){
		
	}
}