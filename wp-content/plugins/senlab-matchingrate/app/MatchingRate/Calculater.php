<?php

namespace senMatchingRate\MatchingRate;

use senMatchingRate\Post\Talent;
use senMatchingRate\Post\Career;

if(!class_exists('Calculater')){
class Calculater
{
	
	private $talent;
	private $career;
	private $calculate_step;
	private $career_type;

	public function __construct($talent_id, $career_id){
		$this->talent = new Talent($talent_id);
		$this->career = new Career($career_id);
		$this->calculate_step = $this->talent->status;
		$this->career_type = $this->career->type;
	}


	public function calculateRate(){
		switch($this->calculate_step){
			case 'basic': $matching_rate = $this->basic(); break;
			case 'standard' : $matching_rate =  $this->standard(); break;
			case 'advance' : $matching_rate = $this->advance(); break;
			default: $matching_rate = 0;
		}

		return $matching_rate;
	}

	private function basic(){
		$rate = 50+1;
		return (int)$rate;
	}

	private function standard(){
		$rate = ($this->career->id)*($this->career->id)%100+2;
		//$rate = 10;
		return $rate;
	}

	private function advance(){
		$rate = 99;
		return $rate;
	}
}
}