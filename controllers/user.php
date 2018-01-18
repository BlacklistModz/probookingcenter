<?php

class User extends Controller {

    public function __construct() {
        parent::__construct();
    }
    public function index(){
    	$this->error();
    }

    public function add(){

    }
    public function edit($id=null){

    }
    public function save(){

    }
    public function del($id=null){

    }

    /*GROUP*/
    public function add_group(){
    	if( empty($this->me) || $this->format!='json' ) $this->error();

    	$this->view->setPage('path','Themes/manage/forms/user/group');
    	$this->view->render('add');
    }
    public function edit_group($id=null){
    	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
    	if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

    	$item = $this->model->group($id);
    	if( empty($item) ) $this->error();

    	$this->view->setData('item', $item);
    	$this->view->setPage('path','Themes/manage/forms/user/group');
    	$this->view->render('add');
    }
    public function save_group(){
    	if( empty($_POST) ) $this->error();

    	$id = isset($_POST["id"]) ? $_POST["id"] : null;
    	if( !empty($id) ){
    		$item = $this->model->group($id);
    		if( empty($item) ) $this->error();
    	}

    	try{
    		$form = new Form();
    		$form 	->post('group_name')->val('is_empty');
    		$form->submit();
    		$postData = $form->fetch();

            $has_name = true;
            if( !empty($item) ){
                if( $item['name'] == $postData['group_name'] ) $has_name = false;
            }
            if( $this->model->is_groupname($postData['group_name']) && $has_name ){
                $arr['error']['group_name'] = 'มีชื่อนี้ในระบบแล้ว';
            }

            if( empty($arr['error']) ){
                if( !empty($id) ){
                    $postData['update_user_id'] = $this->me['id'];
                    $this->model->updateGroup($id, $postData);
                }
                else{
                    $postData['create_user_id'] = $this->me['id'];
                    $this->model->insertGroup($postData);
                }
                $arr['message'] = 'บันทึกเรียบร้อย';
                $arr['url'] = 'refresh';
            }

    	} catch (Exception $e) {
    		$arr['error'] = $this->_getError($e->getMessage());
    	}
    	echo json_encode($arr);
    }
    public function del_group($id=null){

    }
}