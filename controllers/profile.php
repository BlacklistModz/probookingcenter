<?php

class Profile extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	header("location:".URL."profile/history");
    }
    public function history(){
    	$this->view->setPage('title', "Booking History");

    	$options = array(
    		"company"=>$this->me["company_id"],
    		"unlimit"=>true
    	);
    	$booking = $this->model->query("booking")->lists( $options );
    	$this->view->setData('results', $booking);
    	$this->view->render('profile/history');
    }
    public function sales(){
    	
    }
}