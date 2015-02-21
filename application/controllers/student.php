<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Student extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'Student_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->form_primary = 'student_id';
		$this->user_type = 3;
		$this->user_title = "Student";
	}

	public function index() {
		
		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();
		$model_data = array();

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.User.add_user()', 
			'Module.User.search_user()',
			'Module.User.refresh_user_list()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'student/index', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);

	}

	public function scores(){

	}

	public function assignment(){

	}

	public function exam(){

	}

	public function project(){

	}

	public function quiz(){

	}

	public function recitation(){

	}
}

/* End of file instructor.php */
/* Location: ./application/controllers/instructor.php */