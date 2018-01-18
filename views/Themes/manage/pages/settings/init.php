<?php

$this->count_nav = 0;

/* System */
$sub = array();
$sub[] = array('text' => 'ระบบ','key' => 'system','url' => $this->pageURL.'settings/system');
// $sub[] = array('text'=>'Dealer','key'=>'dealer','url'=>$this->pageURL.'settings/dealer');
$sub[] = array('text' => 'โปรไฟล์ส่วนตัว','key' => 'my','url' => $this->pageURL.'settings/my');

// foreach ($sub as $key => $value) {
// 	if( empty($this->permit[$value['key']]['view']) ) unset($sub[$key]);
// }
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text' => 'Preferences', 'url' => $this->pageURL.'settings/system', 'sub' => $sub);
}


/**/
/* Accounts */
/**/
$sub = array();
$sub[] = array('text'=> 'จัดการผู้ใช้งาน','key'=>'users','url'=>$this->pageURL.'settings/users');
$sub[] = array('text'=> 'กลุ่มผู้ใช้งาน','key'=>'group','url'=>$this->pageURL.'settings/users/group');
// $sub[] = array('text'=> $this->lang->translate('User Roles'),'key'=>'roles','url'=>$this->pageURL.'settings/users/roles');

/* foreach ($sub as $key => $value) {
	if( empty($this->permit[$value['key']]['view']) ) unset($sub[$key]);
} */
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text'=> $this->lang->translate('Accounts'),'sub' => $sub, 'url' => $this->pageURL.'settings/users/');
}

/*Booking*/
$sub = array();
$sub[] = array('text'=> 'สายการบิน', 'key'=>'airline', 'url'=>$this->pageURL.'settings/booking/airline');
$sub[] = array('text'=> 'ประเทศ', 'key'=>'country', 'url'=>$this->pageURL.'settings/booking/country');
$sub[] = array('text'=> 'สมุดธนาคาร', 'key'=>'bookbank', 'url'=>$this->pageURL.'settings/booking/bookbank');
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text'=> 'รายการตั้งค่า','sub' => $sub, 'url' => $this->pageURL.'settings/booking/');
}


/*Agency*/
$sub = array();
$sub[] = array('text'=>'บริษัท Agency', 'key'=>'company', 'url'=>$this->pageURL.'settings/agency/company');
if( !empty($sub) ){
	$this->count_nav+=count($sub);
	$menu[] = array('text'=> 'ตั้งค่า Agency','sub' => $sub, 'url' => $this->pageURL.'settings/agency/');
}