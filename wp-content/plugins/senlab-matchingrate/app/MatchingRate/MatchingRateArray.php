<?php
namespace senMatchingRate\MatchingRate;

class MatchingRateArray{
	
	private $talent_id;

	private $matchingRateArray;

	public function __construct($talent_id){
		$this->talent_id = $talent_id;
		$this->setMatchingRateArray();
	}

	private function setMatchingRateArray(){
		$matching_rate_array =  get_post_meta($this->talent_id, 'matching_rate_array',true);

		if(empty($matching_rate_array)||!is_array($matching_rate_array)){
			$matching_rate_array = array();
		}

		$this->matchingRateArray = $matching_rate_array;
	}

	public function getMatchingRateArray(){
		return $this->matchingRateArray;
	}


}