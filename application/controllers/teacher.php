<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Teacher extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'Teacher_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->form_primary = 'teacher_id';
		$this->user_type = 2;
		$this->user_title = "Instructor";
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
		$this->load->view( 'teacher/index', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);


	}


	/*assign*/
	

	
	public function assign_project(){

	}

	public function assign_quiz(){

	}

	public function assign_recitation(){
		
	}

	public function assign_assignment(){

	}

	public function assign_exam(){

	}




	/*submit assign */
	


	

}

/* End of file instructor.php */
/* Location: ./application/controllers/instructor.php */