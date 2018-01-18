<?php

class Login extends Controller {

	public function __construct() {
		parent::__construct();
	}

	// home
	public function index() {

		if( empty($_POST) ) $this->error();

		$this->login();

	}

	public function login() {

		Session::init();

		if( !empty($_POST) && empty($error) ) {

			try {
				$form = new Form();

				$form->post('user')->val('is_empty')
				     ->post('pass')->val('is_empty');

				$form->submit();
				$post = $form->fetch();

				$id = $this->model->query('agency')->login( $post['user'], $post['pass'] );

				if ( ! empty( $id ) ) {
					Cookie::set( COOKIE_KEY_AGENCY, $id, time() + ( 3600 * 24 ) );
					Session::set( 'isPushedLeft', 1 );

					$redirect = URL;
					$arr['message'] = 'เข้าสู่ระบบเรียบร้อย';
					$arr['url'] = $redirect;
				} else {
					$arr['error']['user'] = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
					$arr['error']['pass'] = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
				}

			} catch ( Exception $e ) {
				$arr['error'] = $this->_getError( $e->getMessage() );
			}
		}
		echo json_encode($arr);
	}

}