<?php

class agency extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	$this->error();
    }
    public function add($company=null){
        $company = isset($_REQUEST["company"]) ? $_REQUEST["company"] : $company;
        if( empty($this->me) || empty($company) || $this->format!='json' ) $this->error();

        $this->view->setData('company', $this->me['company_name']);
        $this->view->render('forms/agency/add');
    }
    public function edit($id=null){
        $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : $id;
        if( empty($id) || empty($this->me) || $this->format!='json' ) $this->error();

        $item = $this->model->get($id);
        if( empty($item) ) $this->error();

        $this->view->setData('item', $item);
        $this->view->render('forms/agency/add');
    }
    public function save(){
        if( empty($_POST) ) $this->error();

        $id = isset($_POST["id"]) ? $_POST["id"] : null;
        if( !empty($id) ){
            $item = $this->model->get($id);
            if( empty($item) ) $this->error();
        }

        try{
            $form = new Form();
            $form   ->post('agen_fname')->val('is_empty')
                    ->post('agen_lname')
                    ->post('agen_nickname')
                    ->post('agen_position')
                    ->post('agen_email')->val('email')
                    ->post('agen_tel')
                    ->post('agen_line_id')
                    ->post('agen_skype')
                    ->post('agen_user_name')->val('is_empty');
            $form->submit();
            $postData = $form->fetch();

            if( empty($id) ){
                if( strlen($_POST["agen_password"]) < 6 ){
                    $arr['error']['agen_password'] = 'รหัสผ่านต้องมีความยาว 6 ตัวอักษรขึ้นไป';
                }
                elseif( $_POST["agen_password"] != $_POST["agen_password2"] ){
                    $arr['error']['agen_password2'] = 'รหัสยืนยันไม่ตรงกับรหัสผ่าน';
                }
                else{
                    $postData['agen_password'] = substr(md5(trim($_POST["agen_password"])),0,20);
                }
            }

            if( empty($arr['error']) ){
                if( !empty($id) ){
                    $this->model->update($id, $postData);
                }
                else{
                    $postData['status'] = 1;
                    $postData['agen_role'] = 'sales';
                    $postData['agency_company_id'] = $this->me['company_id'];
                    $this->model->insert($postData);
                }
                $arr['message'] = 'บันทึกข้อมูลเรียบร้อย';
                $arr['url'] = 'refresh';
            }

        } catch (Exception $e) {
            $arr['error'] = $this->_getError($e->getMessage());
        }
        echo json_encode($arr);
    }

    public function set(){
        if( empty($_POST) ) $this->error();

        try{
            $postCompany = array();
            $postData = array();

            if( $_POST["type"] == "company" ){
                if( empty($_POST["agency_company_id"]) ){
                    foreach ($_POST["company"] as $key => $value) {
                        if( $key != 'com_fax' ){
                            if( empty($value) ) $arr['error']['agen_'.$key] = 'กรุณากรอกข้อมูล';
                        }
                    }
                }
            }

            if( $_POST["type"] == "agency" ){
                foreach ($_POST["agency"] as $key => $value) {
                    if( $key != 'lname' && $key != 'nickname' && $key != 'position' && $key != 'tel' && $key != 'line_id' && $key != 'skype' ){
                        if( empty($value) ) $arr['error']['agen_'.$key] = 'กรุณากรอกข้อมูล';
                    }
                }

                if( $this->model->is_username($_POST["agency"]["user_name"]) ){
                    $arr['error']['agen_user_name'] = 'มี Username นี้ในระบบ';
                }
                if( $this->model->is_email($_POST["agency"]["email"]) ){
                    $arr['error']['agen_email'] = 'มี Email ซ้ำในระบบ';
                }

                if( strlen($_POST["agency"]["password"]) < 4 ){
                    $arr["error"]["agen_password"] = "กรุณากรอกรหัสผ่านให้มีความยาว 4 ตัวอักษรขึ้นไป";
                }
                elseif( $_POST["agency"]["password"] != $_POST["agency"]["password2"] ){
                    $arr["error"]["agen_password"] = "กรุณากรอกรหัสผ่านให้ตรงกัน";
                    $arr["error"]["agen_password2"] = "กรุณากรอกรหัสผ่านให้ตรงกัน";
                }
            }

            if( $_POST["type"] == "save" ){
                if( empty($_POST["agency_company_id"]) ){
                    foreach ($_POST["company"] as $key => $value) {
                        $postCompany["agen_".$key] = $value;
                    }
                    $postCompany["status"] = 0;
                    $postData["agency_company_id"] = $this->model->query('agency_company')->insert($postCompany);
                    $postData["agen_role"] = 'admin';
                }
                else{
                    $postData["agency_company_id"] = $_POST["agency_company_id"];
                    $postData['agen_role'] = 'sales';
                }

                foreach ($_POST["agency"] as $key => $value) {
                    if( $key == 'password2' ) continue;
                    if( $key == "password" ) $value = substr(md5(trim($value)),0,20);
                    $postData["agen_".$key] = $value;
                }

                $postData["status"] = 0;
                $this->model->insert($postData);
            }

            if( empty($arr['error']) ){
                if( $_POST["type"] != "save" ){
                    $arr['status'] = 1;
                }
                else{
                    $arr["message"] = "ขอบคุณที่เข้าร่วมกับเรา";
                    $arr["url"] = isset($_REQUEST["next"]) ? $_REQUEST["next"] : URL;
                }
            }

        } catch (Exception $e) {
            $arr['error'] = $this->_getError($e->getMessage());
        }
        echo json_encode($arr);
    }
    public function _save(){
        if( empty($_POST) ) $this->error();

        $id = !empty($_POST["id"]) ? $_POST["id"] : null;
        if( !empty($id) ){
            $item = $this->model->get($id);
            if( empty($item) ) $this->error();
        }

        try{
            $form = new Form();
            $form   ->post('agen_fname')->val('is_empty')
                    ->post('agen_lname')
                    ->post('agen_nickname')
                    ->post('agen_position')
                    ->post('agen_email')
                    ->post('agen_tel')
                    ->post('agen_line_id')
                    ->post('agen_skype')
                    ->post('agen_user_name')->val('is_empty')
                    ->post('agen_password')->val('is_empty')
                    ->post('agen_note_com_name')->val('is_empty')
                    ->post('agen_note_com_address1')
                    ->post('agen_note_com_tel')->val('is_empty')
                    ->post('agen_note_com_fax')
                    ->post('agen_note_com_ttt_on')->val('is_empty');
            $form->submit();
            $postData = $form->fetch();

            $has_name = true;
            $has_email = true;
            if( $this->model->is_username($postData['agen_user_name']) && $has_name ){
                $arr['error']['agen_user_name'] = 'มีชื่อผู้ใช้นี้ในระบบแล้ว';
            }
            if( $this->model->is_email($postData['agen_email']) && $has_email ){
                $arr['error']['agen_email'] = 'มีอีเมลนี้ในระบบแล้ว';
            }

            if( strlen($postData['agen_password']) < 6 ){
                $arr['error']['agen_password'] = 'กรุณากรอกรหัสผ่าน 6 ตัวอักษรขึ้นไป';
            }
            if( $_POST["agen_password2"] != $postData['agen_password'] ){
                $arr['error']['agen_password2'] = 'รหัสยืนยันไม่ตรงกับรหัสผ่าน';
            }

            // if( empty($item) && !empty($_POST["co"]) ){
            //     $company = array();
            //     foreach ($_POST["co"] as $key => $value) {
            //         if( $key=='com_name' || $key=='com_tel' || $key=='com_ttt_on' ){
            //             if( empty($value) ) $arr['error']['co_'.$key] = 'กรุณากรอกข้อมูล';
            //         }

            //         if( empty($value) ) continue;
            //         $company['agen_note_'.$key] = $value;
            //         /* $company .= !empty($company) ? " " : "";
            //         $company .= $value; */
            //     }
            // }

            if( empty($arr['error']) ){
                if( !empty($id) ){
                    $this->model->update($id, $postData);
                }
                else{
                    $postData['agen_password'] = substr(md5(trim($postData['agen_password'])),0,20);
                    $postData['agen_show'] = 2;
                    $postData['status'] = 1;
                    $postData['agency_company_id'] = 365;
                    $this->model->insert($postData);
                }

                /* if( !empty($company) ){
                    $this->model->insertCompany($company);
                } */

                $arr['message'] = 'ขอบคุณที่เข้าร่วมกับเรา';
                $arr['url'] = isset($_REQUEST["next"]) ? $_REQUEST["next"] : 'refresh';
            }

        } catch (Exception $e) {
            $arr['error'] = $this->_getError($e->getMessage());
        }
        echo json_encode($arr);
    }

    public function listsCompany(){
        if( $this->format!='json' ) $this->error();
        echo json_encode( $this->model->query('agency_company')->lists() );
    }
}