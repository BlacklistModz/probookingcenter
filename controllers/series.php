<?php

class Series extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {
    	$this->view->setPage('title', 'ซีรีย์ทัวร์ ออนไลน์');
    	$options = array(
            'unlimited' => true,
            'period' => true,
            'status' => 1,
        );

        $results = $this->model->query('products')->lists( $options );
        $this->view->setData('results', $results);
    	$this->view->render("series/display");
    }

}