<?php 
$formCom = new Form();
$formCom = $formCom ->create()
                ->addClass('form-insert')
				->elem('div');

$formCom 	->field("agen_note_com_name")
            ->label("บริษัท*")
            ->addClass('inputtext')
            ->autocomplete('off')
            ->placeholder('บริษัท')
            ->attr('style', 'color:black;')
            ->value('');

$formCom 	->field("agen_note_com_address1")
            ->label("ที่อยู่บริษัท")
            ->addClass('inputtext')
            ->autocomplete('off')
            ->type('textarea')
            ->attr('data-plugins', 'autosize')
            ->placeholder('ที่อยู่บริษัท')
            ->attr('style', 'color:black;')
            ->value('');

$formCom 	->field("agen_note_com_tel")
            ->label("เบอร์โทร")
            ->addClass('inputtext')
            ->autocomplete('off')
            ->placeholder('เบอร์โทร')
            ->attr('style', 'color:black;')
            ->value('');

$formCom 	->field("agen_note_com_fax")
            ->label("แฟ็กซ์")
            ->addClass('inputtext')
            ->autocomplete('off')
            ->placeholder('แฟ็กซ์')
            ->attr('style', 'color:black;')
            ->value('');

$formCom 	->field("agen_note_com_ttt_on")
            ->label("เลข ททท")
            ->addClass('inputtext')
            ->autocomplete('off')
            ->placeholder('เลข ททท.')
            ->attr('style', 'color:black;')
            ->value('');
$form2 = new Form();
$form2 = $form2 ->create()
                ->addClass('form-insert')
                ->elem('div');
            
$form2      ->field("agen_note_com_ttt_on_1")
            ->label("เลข ททท")
            ->addClass('inputtext')
            ->autocomplete('off')
            ->placeholder('เลข ททท.')
            ->attr('style', 'color:black;')
            ->value('');  
   
?>
<section id="product" class="module parallax product" style="padding-top: 180px; background-image: url(<?=IMAGES?>/demo/curtain/curtain-3.jpg)">
	<div class=" container clearfix">
		<div class="primary-content post">
			<div class="card">
				<header class="header clearfix">
					<h1 class="tac"><i class="icon-pencil-square-o"></i> สมัครเป็นตัวแทนจำหน่าย</h1>
				</header>

				<div class="clearfix" data-plugins="formRegister">
					<form class="js-submit-form" action="<?=URL?>agency/save" method="POST">
                        <div class="beadcrumbs">
                        <ul class="breadcrumb js-current-step">
                        <li class="js_step_1"> <a class="js-change-step active" data-target="#form1"> step 1</a></li>
                        <li class="js_step_2"><a class="js-change-step" data-target="#form2">step 2</a></li>
                        <li class="js_step_3"><a class="js-change-step" data-target="#form3">step 3</a></li>
                        </ul>
                        </div>
                        <div id="form1" class="js-hidden-form">
                            <?=$formCom->html();?>
                        </div>
                        <div class="js-hidden-form" id="form2">
                            <?=$form2->html();?>
                        </div>
                        <div class="js-hidden-form preview" id="form3">
                            <h1>This is preview </h1>
                        </div>
                        <div class="mtl clearfix">
                            <a href="#" class="btn btn-red hidden_elem" id="btn-back"><i class="icon-arrow-left"></i> กลับ</a>
                            <a href="#" class="btn btn-green rfloat" id="btn-next">ต่อไป <i class="icon-arrow-right"></i></a>
                            <button type="submit" class="btn btn-blue btn-submit rfloat hidden_elem">บันทึก</button>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>