<?php

class Profile extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	header("location:".URL."profile/history");
    }
    public function history(){
    	if( empty($this->me) || empty($this->me['company_id']) ) $this->error();
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
    	// if( empty($this->me) || empty($this->me['company_id']) ) $this->error();
    	$this->view->setPage('title', "Manage Sales");

    	$options = array(
    		"company"=>$this->me["company_id"],
    		"unlimit"=>true
    	);
    	$agency = $this->model->query("agency")->lists( $options );
    	$this->view->setData("results", $agency);
    	$this->view->render('profile/manage');
    }
}