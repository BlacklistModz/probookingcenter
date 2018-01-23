<?php 

$arr['title'] = 'เปลี่ยนรหัสผ่าน';
$arr['hiddenInput'][] = array('name'=>'id','value'=>$this->item['id']);

$form = new Form();
$form = $form->create()
			 ->elem('div')
			 ->addClass("form-insert");

$form 	->field("new_password")
		->label("รหัสผ่านใหม่")
		->addClass("inputtext")
		->