<?php

namespace senMatchingRate\MatchingRate;

use senMatchingRate\MatchingRate\Calculater;

if (!class_exists('SyncMatchingRate')) {
class SyncMatchingRate
{
	private $talent_id;
	private $career_id;
	private $matching_rate;
	private $matching_rate_array=[];

	public function __construct($talent_id, $career_id,$matching_rate_array = null){
		$this->talent_id = $talent_id;
		$this->career_id = $career_id;
		$this->matching_rate_array = $matching_rate_array;
		$this->setMatchingRate();
		$this->setMatchingRateArray();
	}

	//특정 career에 대한 matching rate를 업데이트한다. 
	private function setMatchingRateArray(){
		if(is_null($this->matching_rate_array)){
			//update_post_meta($this->talent_id,'setMatchingRateArray','test');
			return;
		}
		else{
			//update_post_meta($this->talent_id,'setMatchingRateArray','success2');
			foreach($this->matching_rate_array as $k => $rate_array){
				if($rate_array['ID'] != $this->career_id) continue;
				else{
					$this->matching_rate_array[$k] = $this->matching_rate;
					return;
				}
			}
			$this->matching_rate_array[] = $this->matching_rate;
		}
	}

	private function setMatchingRate(){
		$calculater = new calculater($this->talent_id, $this->career_id);
		$rate = $calculater->calculateRate();
		$this->matching_rate = array('ID'=>$this->career_id, 'rate'=>(int)$rate);
	}

	public function getMatchingRateArray(){
		return $this->matching_rate_array;
	}

	public function updateOneRate(){
		update_post_meta($this->talent_id, 'matching_rate_array', $this->matching_rate_array);
	}

}
}
