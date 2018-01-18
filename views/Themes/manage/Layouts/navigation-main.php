<?php

$this->pageURL = URL.'admin/';

$image = '';
if( !empty($this->me['image_url']) ){
	$image = '<div class="avatar lfloat mrm"><img class="img" src="'.$this->me['image_url'].'" alt="'.$this->me['name'].'"></div>';
}
else{
	$image = '<div class="avatar lfloat no-avatar mrm"><div class="initials"><i class="icon-user"></i></div></div>';
}

echo '<div class="navigation-main-bg navigation-trigger"></div>';
echo '<nav class="navigation-main" role="navigation"><a class="navigation-btn-trigger navigation-trigger"><span></span></a>';

echo '<div class="navigation-main-header"><div class="anchor clearfix">'.$image.'<div class="content"><div class="spacer"></div><div class="massages"><div class="fullname">'.$this->me['name'].'</div><span class="subname">'.$this->me['email'].'</span></div></div></div></div>';

echo '<div class="navigation-main-content">';

 #info
/*$info[] = array('key'=>'dashboard','text'=>$this->lang->translate('menu','Dashboard'),'link'=>$this->pageURL.'dashboard','icon'=>'home');
$info[] = array('key'=>'notifications','text'=>$this->lang->translate('menu','Notifications'),'link'=>$this->pageURL.'notifications','icon'=>'bell-o');
$info[] = array('key'=>'calendar','text'=>$this->lang->translate('menu','Calendar'),'link'=>$this->pageURL.'calendar','icon'=>'calendar');
foreach ($info as $key => $value) {
	if( empty($this->permit[$value['key']]['view']) ) unset($info[$key]);
}
if( !empty($info) ){
	echo $this->fn->manage_nav($info, $this->getPage('on'));
} */

$cog[] = array('key'=>'settings','text'=>$this->lang->translate('menu','Settings'), 'link'=>$this->pageURL.'settings','icon'=>'cog');
echo $this->fn->manage_nav($cog, $this->getPage('on'));




echo '</div>';

	echo '<div class="navigation-main-footer">';


echo '<ul class="navigation-list">'.

	'<li class="clearfix">'.
		'<div class="navigation-main-footer-cogs">'.
			'<a data-plugins="dialog" href="'.URL.'logout/admin?next='.URL.'admin"><i class="icon-power-off"></i><span class="visuallyhidden">Log Out</span></a>'.
			// '<a href="'.URL.'logout/admin"><i class="icon-cog"></i><span class="visuallyhidden">Settings</span></a>'.
		'</div>'.
		'<div class="navigation-brand-logo clearfix"><img class="lfloat mrm" src="'.IMAGES.'logo/logo1.gif">'.( !empty( $this->system['title'] ) ? $this->system['title']:'' ).'</div>'.
	'</li>'.
'</ul>';

echo '</div>';


echo '</nav>';