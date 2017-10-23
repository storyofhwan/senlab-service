<?php

namespace senMatchingRate\MatchingRate;

use senMatchingRate\MatchingRate\MatchingRateArray;
use senMatchingRate\MatchingRate\SyncMatchingRate;

class SyncAllMatchingRate{

	private $updateType;

	private $post_id;
	private $post_type;

	private $ids;

	public function __constructor($post_id){
		$this->post_id = $post_id
		$this->post_type = get_post_type($post_id);
		//$this->career_ids = get_posts(array('post_type'=>'career','posts_per_page'=> -1, 'post_status' => 'publish', 'fields' => 'ids'));
		//$this->talent_ids = get_posts(array('post_type'=>'talent','posts_per_page'=> -1, 'post_status' => 'publish', 'fields' => 'ids'));
		$this->sync();
	}
	
	private function sync(){
		switch($this->post_type){
			case 'talent':
				$this->ids = get_posts(array('post_type'=>'career','posts_per_page'=> -1, 'post_status' => 'publish', 'fields' => 'ids'));
				$this->talentUpdating($this->post_id);
				break;
			case 'career':
				$this->ids = get_posts(array('post_type'=>'talent','posts_per_page'=> -1, 'post_status' => 'publish', 'fields' => 'ids'));
				$this->CareerUpdating($this->post_id);
				break;
			default: break;
		}
	}

	private function talentUpdating($talent_id){
		//함수 실행할 조건 삽입
		$allMatchingRate = new MatchingRateArray($talent_id);
		$matchingRateArray = $allMatchingRate->getMatchingRateArray();

		foreach($this->career_ids as $career_id){
			$newMatchingRate = new SyncMatchingRate($talent_id, $career_id, $matchingRateArray);
			$matchingRateArray = $newMatchingRate->getMatchingRateArray();
		}

		$this->updateTalentMeta();
	}

	private function CareerUpdating($career_id){
		//함수 실행할 조건 삽입
		foreach($this->talent_ids as $talent_id){
			$allMatchingRate = new MatchingRateArray($talent_id);
			$matchingRateArray = $allMatchingRate->getMatchingRateArray();

			$newMatchingRate = new SyncMatchingRate($talent_id, $career_id, $matchingRateArray);
			$newMatchingRate->updateOneRate();
		}
	}



	private function updateTalentMeta($talent_id){
		update_post_meta($talent_id, 'matching_rate_array',$this->matching_rate_array);
	}
}