<?php
namespace senMatchingRate\Post;

class Talent{

	public $user_id;

	public $id;

	/**
	*학생의 정보입력 정도
	**/
	public $status;


	public $major;
	public $location;
	public $degree;
	public $school;

	public $branch = array();

	public $edu = array(
		'bacelor' => null,
		'master' => null,
		'doctor' => null
	);

	public $exp = array();

	public $pub = array();

	public $weightedValues = array();

	public function __construct($talent_id){
		$this->id = $talent_id;
		$this->user_id = get_post_meta($talent_id,'student',true);
		if(get_post_status($talent_id) == 'publish'){
			if(get_post_meta($talent_id,'_survey',true)!='Y')
				$this->status = 'standard';
			else
				$this->status = 'advance';
		}
		else
			$this->status = 'basic';
	}
	
}