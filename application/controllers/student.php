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
			'Module.Student.filter_student()',
			'Module.Student.search_student()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'student/index', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);

	}

	public function filter_student(){

		$data = $this->input->get();
		$controller = $this->controller;
		$user_type = $this->session->userdata('user_type');

		if($data){

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			$results = $main_model->get_student_by_search_key_and_year_level($search, $year_level);

			if($user_type == 1){
				$action = true;
			}else{
				$action = false;
			}

			//var_dump($results);

			$model_data = array(
				'results' => $results,
				'action' => $action,
				'user_type' => $user_type
			);

			echo $this->load->view($controller.'/list', $model_data, true);
		}
	}

	public function update_student(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$main_model->update_student_year_level($user_id, $year_level);
		}

		
	}
}

/* End of file instructor.php */
/* Location: ./application/controllers/instructor.php */