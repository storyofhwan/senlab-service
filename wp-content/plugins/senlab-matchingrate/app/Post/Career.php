<?php
namespace senMatchingRate\Post;

class Career{
	
	public $user_id;

	public $id;

	public $type;

	public $major;
	public $location;
	public $salary;

	public $branch;

	public $welfare;

	public function __construct($career_id){
		$this->id = $career_id;
	}

}