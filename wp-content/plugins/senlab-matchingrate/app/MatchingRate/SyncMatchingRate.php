<?php

namespace senMatchingRate\MatchingRate;

use senMatchingRate\MatchingRate\Calculater;

class SyncMatchingRate{


	private $talent_id;
	private $career_id;
	private $matching_rate;
	private $matching_rate_array;

	public function __constructor($talent_id, $career_id,$matching_rate_array = null){
		$this->talent_id = $talent_id;
		$this->career_id = $career_id;
		$this->matching_rate_array = $matching_rate_array;
		$this->setMatchingRate();
		$this->setMatchingRateArray();

	}


	private function setMatchingRate(){
		if(is_null($this->matchig_rate_array)) return false;
		else{
			foreach($this->matching_rate_array as $k => $rate_array){
				if($rate_array['ID'] != $this->career_id) continue;

				$this->matching_rate_array[$k] = $this->matching_rate;
			}
		}
	}

	private function setMatchingRate(){
		$calculater = new calculater($talent_id, $career_id);
		$rate = $calculater->calculateRate();
		$this->matching_rate = array('ID'=>$this->career_id, 'rate'=>$rate);
	}

	public function getMatchingRateArray(){
		return $this->matching_rate_array;
	}

	public function updateOneRate(){
		update_post_meta($talent_id, 'matching_rate_array', $matching_rate_array);
	}

}