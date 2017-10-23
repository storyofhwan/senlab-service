<?php
namespace senMatchingRate\Post

class Talent{

	private $user_id;

	private $id;

	/**
	*학생의 정보입력 정도
	**/
	private $status;


	private $major;
	private $location;
	private $degree;
	private $school;

	private $branch = array();

	private $edu = array(
		'bacelor' => null,
		'master' => null,
		'doctor' => null
	);

	private $exp = array();

	private $pub = array();

	private $weightedValues = array();

	public function __constructor($talent_id){
		$this->id = $talent_id;
	}
	
}