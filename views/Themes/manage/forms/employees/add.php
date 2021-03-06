<?php

$title = 'Employees';

$form = new Form();
$form = $form->create()
	// set From
	->elem('div')
    // ->style('horizontal')
	->addClass('form-insert');

$form   ->field("emp_username")
        ->label('Username*')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->value( !empty($this->item['username'])? $this->item['username']:'' );
        
if( empty($this->item) ){

$form   ->field("emp_password")
        ->label('Password*')
        ->type('password')
        ->maxlength(30)
        ->autocomplete('off')
        ->addClass('inputtext');
}

$form   ->field("name")
        ->label('Name')
        ->text( $this->fn->q('form')->fullname( !empty($this->item)?$this->item:array(), array('field_first_name'=>'emp_') ) );

$form   ->field("birthday")
        ->label('Birthday')
        ->text( $this->fn->q('form')->birthday( !empty($this->item)?$this->item:array(), array('field_first_name'=>'emp_') ) );


$department = '<option value="">-</option>';
foreach ($this->department as $key => $value) {
    
    $selected = '';
    if( !empty($this->item['dep_id']) ){
        if( $this->item['dep_id']==$value['id'] ){
            $selected = ' selected="1"';
        }
    }

    $department .= '<option'.$selected.' value="'.$value['id'].'">'.$value['name'].'</option>';
}

$department = '<select class="inputtext" name="emp_dep_id">'.$department.'</select>';
$form   ->field("emp_dep_id")
        ->label('Department')
        ->text( $department );

$position = '<option value="">-</option>';
foreach ($this->position as $key => $value) {
    $selected = '';
    if( !empty($this->item['pos_id']) ){
        if( $this->item['pos_id']==$value['id'] ){
            $selected = ' selected="1"';
        }
    }

    $position .= '<option'.$selected.' value="'.$value['id'].'">'.$value['name'].'</option>';
}
$position = '<select class="inputtext" name="emp_pos_id">'.$position.'</select>';
$form   ->field("emp_pos_id")
        ->label('Position')
        ->text( $position );

$form   ->field("emp_address")
        ->name('emp[address]')
        ->label('Address')
        ->text( $this->fn->q('form')->address( !empty($this->item['address'])? $this->item['address']:array(), array('city'=>$this->city ) ) );

$form   ->field("emp_phone_number")
        ->label('Phone Number')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->placeholder('')
        ->value( !empty($this->item['phone_number'])? $this->item['phone_number']:'' );

$form   ->field("emp_email")
        ->label('Email')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->placeholder('')
        ->value( !empty($this->item['email'])? $this->item['email']:'' );

$form   ->field("emp_line_id")
        ->label('Line ID')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->placeholder('')
        ->value( !empty($this->item['line_id'])? $this->item['line_id']:'' );

$form   ->field("emp_notes")
        ->label('Note')
        ->type('textarea')
        ->autocomplete('off')
        ->addClass('inputtext')
        ->attr('data-plugins', 'autosize')
        ->placeholder('')
        ->value( !empty($this->item['notes'])? $this->fn->q('text')->textarea($this->item['notes']):'' );

# set form
$arr['form'] = '<form class="js-submit-form" data-plugins="empposition" method="post" action="'.URL. 'employees/save"></form>';

# body
$arr['body'] = $form->html();

# title
if( !empty($this->item) ){
    $arr['title']= "Edit {$title}";
    $arr['hiddenInput'][] = array('name'=>'id','value'=>$this->item['id']);
}
else{
    $arr['title']= "New {$title}";
}

# fotter: button
$arr['button'] = '<button type="submit" class="btn btn-primary btn-submit"><span class="btn-text">Save</span></button>';
$arr['bottom_msg'] = '<a class="btn" role="dialog-close"><span class="btn-text">Cancel</span></a>';

$arr['width'] = 550;

echo json_encode($arr);