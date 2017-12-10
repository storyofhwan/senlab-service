<?php
/*
Title: 진로명
Post Type: career
*/

$users = get_users(['role' => 'manager','fields'=>['ID','user_email']]);
$user_list = [];
foreach($users as $user){
	$user_list[$user->ID] = $user->user_email;
}

piklist('field',[
	'type' => 'radio',
	'field' => 'career_type',
	'label' => '진로 유형',
	'choices' => senlab_cv_get_terms_name('career_type'),
]);

piklist('field', [
	'type' => 'text',
	'field' => 'post_title',
	'scope' => 'post',
	'label' => '이름'
]);

piklist('field', [
	'type' => 'text',
	'field' => 'subtitle',
	'label' => '부서명',
	'description' => '부서 별로 채용을 다르게 진행한다면 추가적으로 부서명도 입력'
]);

piklist('field', [
	'type' => 'select',
	'field' => 'manager',
	'label' => '담당자',
	'description' => '담당자가 회원가입했다면 전화로 체크하고 맞다면 여기에서 해당 이메일을 선택',
	'choices' => [''=> '담당자를 선택해주세요']+$user_list
]);
