<?php


$title = array(
	0 =>   
	  array('key'=>'name', 'text'=>$this->lang->translate('Visitor Name'),'sort'=>'m_fname')
	, array('key'=>'visit', 'text'=>$this->lang->translate('Status') )
	 // , array('key'=>'date', 'text'=>$this->lang->translate('Last Update'))
);

// $this->titleStyle = 'row-2';

$this->tabletitle = $title;
$this->getURL =  URL.'admin/visitors/';