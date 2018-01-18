<?php

class agency extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    	$this->error();
    }
    public function save(){
        if( empty($_POST) ) $this->error();

        try{
            $postCompany = array();
            $postData = array();

            if( $_POST["type"] == "company" ){
                if( empty($_POST["agency_company_id"]) ){
                    foreach ($_POST["company"] as $key => $value) {
                        if( empty($value) ) $arr['error']['agen_'.$key] = 'กรุณากรอกข้อมูล';
                    }
                }
            }

            if( $_POST["type"] == "agency" ){

            }

            if( $_POST["type"] == "save" ){
                if( empty($_POST["agency_company_id"]) ){
                    foreach ($_POST["company"] as $key => $value) {
                        $postCompany["agen_".$key] = $value;
                    }
                }
                else{
                    $postData["agency_company_id"] = $_POST["agency_company_id"];
                }
                foreach ($_POST["agency"] as $key => $value) {
                    $postData["agen_".$key] = $value;
                }
            }

            if( empty($arr['error']) ){
                $arr['status'] = 1;
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
        if( empty($this->me) || $this->format!='json' ) $this->error();
        echo json_encode( $this->model->query('agency_company')->lists() );
    }
}