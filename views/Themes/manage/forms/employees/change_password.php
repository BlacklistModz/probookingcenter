<?php

$f = new Form();
$form = $f->create()
	
	// set From
	->elem('div')
	->addClass('form-insert')

	->field("password_new")
		->label('New Password')
		->type('password')
		->addClass('inputtext')
		->maxlength(30)
		->required(true)
		->autocomplete("off")

	->field("password_confirm")
		->label('Verify Password')
		->type('password')
		->addClass('inputtext')
		->maxlength(30)
		->required(true)
		->autocomplete("off");

$arr['hiddenInput'][] = array('name'=>'id', 'value'=> $this->item['id']);
$arr['body'] = $form->html();
$arr['title'] = 'Change Password';	
$arr['form'] = '<form class="form-insert-people js-submit-form" action="'.URL.'employees/change_password"></form>';
$arr['bottom_msg'] = '<a href="#" class="btn btn-cancel" role="dialog-close"><span class="btn-text">ยกเลิก</span></a>';
$arr['button'] = '<button type="submit" class="btn btn-blue btn-submit"><span class="btn-text">บันทึก</span></button>';

$arr['width'] = 330;
echo json_encode($arr);