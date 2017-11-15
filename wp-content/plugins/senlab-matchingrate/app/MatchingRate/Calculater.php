<?php

namespace senMatchingRate\MatchingRate;

use senMatchingRate\Post\Talent;
use senMatchingRate\Post\Career;

class Calculater{
	
	private $talent;
	private $career;
	private $calculate_step;
	private $career_type;

	public function __constructor($talent_id, $career_id){
		$this->talent = new Talent($talent_id);
		$this->career = new Career($career_id);
		$this->calulate_step = $this->talent->status;
		$this->career_type = $this->career->type;
		$this->calculateRate();
	}


	public function calculateRate(){
		switch($calcuate_step){
			case 'basic': return $this->basic();
			case 'standard' : return $this->standard();
			case 'advance' : return $this->advance();
		}
	}

	private function basic(){
		return $rate;
	}

	private function standard(){
		return $rate;
	}

	private function advance(){
		return $rate;
	}
}