<?php


$title = array(
	0 =>   
	  array('key'=>'date', 'text'=>$this->lang->translate('Date'), 'sort'=>'date')
	, array('key'=>'email', 'text'=>$this->lang->translate('Type') )
	, array('key'=>'name', 'text'=>$this->lang->translate('Program Name'),'sort'=>'name')
	, array('key'=>'visit', 'text'=>$this->lang->translate('Status') )
	 // , array('key'=>'date', 'text'=>$this->lang->translate('Last Update'))
	
);

// $this->titleStyle = 'row-2';

$this->tabletitle = $title;
$this->getURL =  URL.'admin/programs/';