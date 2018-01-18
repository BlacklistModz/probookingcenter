<?php

class Admin extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	// print_r('hello');die;
    	$this->error();
    }
    public function settings($section='my',$tap=''){
    	$this->view->setPage('on', 'settings' );
        $this->view->setPage('title', 'ตั้งค่า');
        $this->view->setData('section', $section);
        if( !empty($tap) ) $this->view->setData('tap', $tap);

        if( $section=='my' ){

            if( empty($tap) ) $tap = 'basic';

    		$this->view->setPage('on', 'settings' );
    		$this->view->setData('section', 'my');
    		$this->view->setData('tap', 'display');
    		$this->view->setData('_tap', $tap);

    		if( $tap=='basic' ){

    			$this->view
    			->js(  VIEW .'Themes/'.$this->view->getPage('theme').'/assets/js/bootstrap-colorpicker.min.js', true)
    			->css( VIEW .'Themes/'.$this->view->getPage('theme').'/assets/css/bootstrap-colorpicker.min.css', true);

    			$this->view->setData('prefixName', $this->model->query('system')->prefixName());
    		}
    	}elseif( $section=='system' ){

    		if( empty($tap) ) $tap = 'basic';

    		$this->view->setPage('on', 'settings' );
    		$this->view->setData('section', 'system');
    		$this->view->setData('tap', 'display');
    		$this->view->setData('_tap', $tap);

    		if( empty($this->permit['system']['view']) ) $this->error();

    		if( !empty($_POST) && $this->format=='json' ){

                foreach ($_POST as $key => $value) {
                    $this->model->query('system')->set( $key, $value);
                }

                $arr['url'] = 'refresh';
                $arr['message'] = 'บันทึกเรียบร้อย';

                echo json_encode($arr); die;
            }

            if( empty($tap) ) $tap = 'basic';
            if( $tap=='locations' ){
                $this->view->setData('city', $this->model->query('system')->city());
            }
            if( $tap=='fonts' ){
                $this->view->setData('results', $this->model->query('font')->lists());
            }

            $this->view->setData('tap', 'display');
            $this->view->setData('_tap', $tap);
        }
    	elseif( $section=='users' ){

    		if($tap==''){

                $data = array();

                if( $this->format=="json" ){
                   $this->view->setData('results', $this->model->query('user')->lists());
                   $render = 'settings/sections/users/users/json';
                }

                // $this->view->setData("roles", $this->model->query("users")->roles());
                // print_r($data); die;
            }
            elseif( $tap=='group' ){
                $data = $this->model->query('user')->group();
            }
            else{
                $this->error();
            }

            $this->view->setData('data', $data);
    	}
    	else{
    		$this->error();
    	}

    	$this->view->render( !empty($render) ? $render : "settings/display");
    }
}