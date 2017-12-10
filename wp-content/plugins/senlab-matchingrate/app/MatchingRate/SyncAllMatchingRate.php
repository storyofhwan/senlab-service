<?php

namespace senMatchingRate\MatchingRate;

use senMatchingRate\MatchingRate\MatchingRateArray;
use senMatchingRate\MatchingRate\SyncMatchingRate;

class SyncAllMatchingRate{

	private $updateType;

	private $post_id;
	private $post_type;

	//post의 id
	private $ids;

	private $matching_rate_array=['test' => 'test'];



	public function __construct($post_id){
		$this->post_id = $post_id;
		$this->post_type = get_post_type($post_id);
		$this->sync();
	}
	
	private function sync(){
		switch($this->post_type){
			case 'talent':
				$this->ids = get_posts(array('post_type'=>'career','posts_per_page'=> -1, 'post_status' => 'publish', 'fields' => 'ids'));
				update_post_meta($this->post_id,'matching_rate_array','success');
				$this->talentUpdating($this->post_id);
				break;
			case 'career':
				$this->ids = get_posts(array('post_type'=>'talent','posts_per_page'=> -1, 'post_status' => ['publish','draft'], 'fields' => 'ids'));
				$this->CareerUpdating($this->post_id);
				break;
			default: break;
		}
	}

	private function talentUpdating($talent_id){
		//함수 실행할 조건 삽입
		$allMatchingRate = new MatchingRateArray($talent_id);
		$matchingRateArray = $allMatchingRate->getMatchingRateArray();

		foreach($this->ids as $id){
			$newMatchingRate = new SyncMatchingRate($talent_id, $id, $matchingRateArray);
			$matchingRateArray = $newMatchingRate->getMatchingRateArray();
		}

		$this->matching_rate_array = $matchingRateArray;

		$this->updateTalentMeta();
	}

	private function CareerUpdating($career_id){
		//함수 실행할 조건 삽입
		foreach($this->ids as $talent_id){
			$allMatchingRate = new MatchingRateArray($talent_id);
			$matchingRateArray = $allMatchingRate->getMatchingRateArray();

			$newMatchingRate = new SyncMatchingRate($talent_id, $career_id, $matchingRateArray);
			$newMatchingRate->updateOneRate();
		}
	}



	private function updateTalentMeta(){
		update_post_meta($this->post_id, 'matching_rate_array',$this->matching_rate_array);
	}
}