<?php 

$title = "เซลล์";
$arr["title"] = "เพิ่ม {$title}";
$arr['hiddenInput'][] = array('name'=>'company', 'value'=>$this->me['company_id']);
if( !empty($this->item) ){
	$arr['title'] = "แก้ไข {$title}";
	$arr['hiddenInput'][] = array('name'=>'id','value'=>$this->item['id']);
}

$form = new Form();
$form = $form ->create()
			  ->elem('div')
			  ->addClass('form-insert');

$form   ->field("agen_fname")
         ->label("ชื่อ*")
         ->name('agency[fname]')
         ->addClass('inputtext')
         ->autocomplete('off')
         ->placeholder('ชื่อ')
         ->attr('style', 'color:black;')
         ->value('');

$form   ->field("agen_lname")
         ->label("นามสกุล*")
         ->name('agency[lname]')
         ->addClass('inputtext')
         ->autocomplete('off')
         ->placeholder('นามสกุล')
         ->attr('style', 'color:black;')
         ->value('');

$form   ->field("agen_nickname")
         ->label("ชื่อเล่น")
         ->name('agency[nickname]')
         ->addClass('inputtext')
         ->autocomplete('off')
         ->placeholder('ชื่อเล่น')
         ->attr('style', 'color:black;')
         ->value('');

$form   ->field("agen_position")
         ->label("ตำแหน่ง*")
         ->name('agency[position]')
         ->addClass('inputtext')
         ->autocomplete('off')
         ->placeholder('ตำแหน่ง')
         ->attr('style', 'color:black;')
         ->value('');

$form   ->field("agen_email")
         ->label("อีเมล*")
         ->name('agency[email]')
         ->addClass('inputtext')
         ->autocomplete('off')
         ->placeholder('อีเมล')
         ->attr('style', 'color:black;')
         ->value('');

$form   ->field("agen_tel")
         ->label("มือถือ*")
         ->name('agency[tel]')
         ->addClass('inputtext')
         ->autocomplete('off')
         ->placeholder('มือถือ')
         ->attr('style', 'color:black;')
         ->value('');

$form   ->field("agen_line_id")
         ->label("Line ID")
         ->name('agency[line_id]')
         ->addClass('inputtext')
         ->autocomplete('off')
         ->placeholder('Line ID (ถ้ามี)')
         ->attr('style', 'color:black;')
         ->value('');

$form   ->field("agen_skype")
         ->label("Skype")
         ->name('agency[skype]')
         ->addClass('inputtext')
         ->autocomplete('off')
         ->placeholder('Skype (ถ้ามี)')
         ->attr('style', 'color:black;')
         ->value('');

$form   ->field("agen_user_name")
         ->label("ชื่อเข้าใช้งาน*")
         ->name('agency[user_name]')
         ->addClass('inputtext')
         ->autocomplete('off')
         ->placeholder('Username')
         ->attr('style', 'color:black;')
         ->value('');

         if( empty($this->item) ) { 
         	$form   ->field("agen_password")
         			->label("รหัสผ่าน*")
         			->name('agency[password]')
         			->addClass('inputtext')
         			->autocomplete('off')
         			->type('password')
         			->placeholder('Password')
         			->attr('style', 'color:black;')
         			->value('');

         	$form   ->hr('<h4 class="fwb">กรุณากรอกอย่างน้อย 6 ตัวอักษร</h4>');

         	$form   ->field("agen_password2")
         			->label("ยืนยันรหัสผ่าน*")
         			->name('agency[password2]')
         			->addClass('inputtext')
         			->autocomplete('off')
         			->type('password')
         			->placeholder('ยืนยันรหัสผ่าน')
         			->attr('style', 'color:black;')
         			->value('');
         }

# set form
$arr['form'] = '<form class="js-submit-form" method="post" action="'.URL. 'agency/save"></form>';

# set body
$arr['body'] = $form->html();

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">บันทึก</span></button>';
$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">ยกเลิก</span></a>';

echo json_encode($arr);




