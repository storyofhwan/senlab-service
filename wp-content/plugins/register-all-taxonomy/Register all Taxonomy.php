<?php
/*
Plugin Name: Register All Taxonomy
Plugin URI: https://senlab.com/
Description: Talent, Company post type을 추가합니다.
Version: 0.0.1
Author: 최명환
Author URI: 
*/
include 'taxonomy.php';

add_action('init',function(){
	$lists = \taxonomy\listTaxonomy::$like_category;

	foreach($lists as $list){
		$field = $list[0];
		$label = $list[1];
		$object_type = $list[2];
		$ct = new \taxonomy\setTaxonomy($label, $field, $object_type, true);
		$ct -> addTaxonomy();
		$ct -> addTerms();
		delete_option("{$field}_children");
	}
});

add_action('init',function(){
	$lists = \taxonomy\listTaxonomy::$like_tag;

	foreach($lists as $list){
		$field = $list[0];
		$label = $list[1];
		$object_type = $list[2];
		$ct = new \taxonomy\setTaxonomy($label, $field, $object_type, false);
		$ct -> addTaxonomy();
		$ct -> addTerms();
		delete_option("{$field}_children");
	}
});
