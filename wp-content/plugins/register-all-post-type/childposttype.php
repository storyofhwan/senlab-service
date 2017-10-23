<?php
namespace childPostType;

class listChild {
	public static $talentChild = [
		'exp_work' => '인턴 및 직장 경력',
		'exp_research' => '참여 연구 프로젝트',
		'pub_paper' => '논문',
		'pub_conf' => '학회',
		'pub_patent' => '특허',
		'pub_book' => '저서'
	];

	public static $careerChild = [
		'recruiting' => '채용'
	];
}

class setChild {
	private $name;
	private $slug;
	private $parent_post_type;

	private $labels = [];
	private $arg = [];
	public function __construct($name,$slug,$parent){
		$this -> name = $name;
		$this -> slug = $slug;
		$this -> parent_post_type = $parent;
		$this -> setArg($name, $parent);
	}


	private function setArg($name,$parent){
		$this -> labels = [
			'name' 			=> $name.' 목록',
			'singular_name' => $name,
			'add_new'		=> '새 '.$name,
			'menu_name'		=> $name,
			'edit'			=> '수정',
			'edit_item'		=> '정보 수정',
			'new_item'		=> $name.' 추가',
			'view'			=> $name.' 정보 보기',
			'search_items'	=> $name.' 검색',
			'not_found'		=> $name.' 없음',
			'not_found_in_trash'	=> $name.' 없음'
		];

		$labels = $this -> labels;

		$this -> arg = [
			'labels' 				=> $labels,
			'public'				=> true,
			'show_ui'				=> true,
			'show_in_menu'			=> 'edit.php?post_type='.$parent,
			'show_in_nav_menus'		=> false,
			'exclude_from_search'	=> false,
			'has_archive'			=> false,
			'capability_type'		=> 'post',
			'supports'				=> ['title']
		];
	}

	public function addPostType(){
		register_post_type($this -> slug,$this -> arg);
	} 
}