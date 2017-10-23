<?php
namespace taxonomy;

class listTaxonomy{
	const T = 'talent';
	const C = 'career';
	const R = 'recruiting';
	
	public static $like_category = [
		['department','학교 및 학과',self::T],
		['major','전공 분류', [self::T,self::C]]
	];

	public static $like_tag = [
		['career_type','진로 유형', self::C],
		['recruiting_type','채용 유형',self::R],
		['degree','학위 분류',self::T],
		['location','지역 분류',self::C],
		['branch','연구 분야',[self::T,self::C]]
	];
}

class listTerms{
	private static $department = [
		'snu' => [
			'수리과학','통계학','물리학','화학','생명과학','지구환경과학','수학교육','과학교육','식물생산과학','산림과학','농생명공학','바이오시스템소재학','생태조경','지역시스템공학','농산업교육','식품영양학','의류학','간호학','약학','천문학','뇌인지과학','생물물리 및 화학생물학','바이오모듈레이션','건설환경공학','기계공학','우주항공공학','산업공학','조선해양공학','에너지시스템공학','건축학','멀티스케일기계설계','하이브리드재료','에너지환경화학융합기술'],
		'postech' => [
			'수학과','물리학과','화학과','생명과학과','신소재공학과','기계공학과','산업경영공학과','전자전기공학과','컴퓨터공학과','화학공학과','창의it융합공학과','첨단재료과학부','융합생명공학부','정보전자융합공학부','첨단원자력공학부','환경공학부','시스템생명공학부','정보통신대학원','철강대학원','엔지니어링대학원'],
		'kaist' => [
			'물리학과','수리과학과','화학과','나노과학기술대학원','생명과학과','의과학대학원','기계공학과','항공우주공학과','전기전자공학부','전산학부','건설및환경공학과','바이오및뇌공학과','산업디자인학과','산업및시스템공학과','생명화학공학과','신소재공학과','원자력및양자공학과','정보통신공학과','조천식녹색교통대학원','EEWS대학원']
	];
	private static $major = [
		'수학/통계' => [],
		'물리/천문'=>[],
		'화학'=>[],
		'생명'=>[],
		'지구/환경'=>[],
		'기계공학'=>[],
		'소재/재료공학'=>[],
		'전자/전기공학'=>[],
		'정밀/에너지'=>[],
		'컴퓨터/통신'=>[],
		'산업공학'=>[],
		'화학공학'=>[]
	];
	private static $career_type = [
		'기업',
		'대학/연구소',
		'포닥'
	];
	private static $recruiting_type = [
		'수시 채용',
		'공개 채용',
		'전문연구요원',
		'산학장학생'
	];
	private static $degree = [
		'석사 과정',
		'석사',
		'박사 과정',
		'박사 수료',
		'박사'
	];
	private static $location = [
		'서울',
		'경기/인천',
		'대전/충남/충북',
		'광주/전남/전북',
		'대구/경북',
		'부산/울산/경남',
		'강원',
		'제주',
		'해외'
	];
	public static function getTermList($taxonomy){
		switch($taxonomy){
			case 'department': $term_list = self::$department; break;
			case 'major': $term_list = self::$major; break;
			case 'career_type': $term_list =  self::$career_type; break;
			case 'recruiting_type': $term_list =  self::$recruiting_type; break;
			case 'degree': $term_list =  self::$degree; break;
			case 'location': $term_list =  self::$location; break;
			default: return 0;
		}
		return $term_list;
	}
}

class setTaxonomy{
	private $name;
	private $slug;
	private $object_type;
	private $hierarchical = false;
	private $terms = null;

	private $labels = [];
	private $arg = [];

	public function __construct($name,$slug,$object_type,$hierarchical){
		$this -> name = $name;
		$this -> slug = $slug;
		$this -> object_type = $object_type;
		$this -> hierarchical = $hierarchical;
		$this -> setArg($name, $this -> hierarchical);
		if($arr = \taxonomy\listTerms::getTermList($slug))
			$this -> terms = $arr;
	}

	private function setArg($name,$hierarchical){
		$this -> labels = [
			'name' 			=> $name.' 목록',
			'singular_name' => $name,
			'add_new'		=> '새 '.$name,
			'menu_name'		=> $name,
			'edit'			=> '수정',
			'edit_item'		=> '수정',
			'new_item'		=> $name.' 추가',
			'view'			=> $name.' 정보 보기',
			'search_items'	=> $name.' 검색',
			'not_found'		=> $name.' 없음',
			'not_found_in_trash'	=> $name.' 없음'
		];
		$labels = $this -> labels;

		$this -> arg = [
			'labels' => $labels,
			'hierarchical' => $hierarchical
		];
	}

	public function addTaxonomy(){
		register_taxonomy($this -> slug,$this -> object_type, $this -> arg);
	} 

	public function addTerms(){
		$term_arr = $this -> terms;
		$taxonomy = $this -> slug;
		if($this -> hierarchical == false){
			if(is_array($term_arr)){
			foreach($term_arr as $term){
				wp_insert_term($term,$taxonomy);
			}}
		}

		else{
			foreach($term_arr as $parent_term => $child_terms){
				$result = wp_insert_term($parent_term,$taxonomy);
				if(is_array($result) && !empty($child_terms)){
					foreach($child_terms as $child_term){
						wp_insert_term($child_term, $taxonomy, ['parent' => $result['term_id'] ]);
					}
				}
			}
		}
	}
}