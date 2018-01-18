<?php 

$title = 'กลุ่มผู้ใช้งาน';
$arr['title'] = "เพิ่ม {$title}";
if( !empty($this->item) ){
	$arr['title'] = "แก้ไข {$title}";
	$arr['hiddenInput'][] = array('name'=>'id', 'value'=>$this->item['id']);
}

$form = new Form();
$form = $form->create()
			 ->elem('div')
			 ->addClass('form-insert');

$form 	->field("group_name")
		->label("ชื่อ")
		->addClass('inputtext')
		->placeholder('')
		->autocomplete('off')
		->value( !empty($this->item['name']) ? $this->item['name'] : '' );

# set form
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. 'user/save_group"></form>';

# body
$arr['body'] = $form->html();

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">บันทึก</span></button>';
$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">Cancel</span></a>';

// $arr['width'] = 782;

echo json_encode($arr);