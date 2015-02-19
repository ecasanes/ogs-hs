<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Curiculum extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'Curiculum_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;
	}

	public function index() {
		
		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();
		$model_data = array();
		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.add_grade_level()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/index', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);


	}

	public function create_grade_level(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$exist = $this->grade_level_exist($grade_level, $sy_start, $sy_end);

			if(!$exist){

				$grade_level_id = $main_model->create_grade_level($sy_start, $sy_end, $grade_level);
				$success_message = "Grade Level was added successfully. ";

				if($grade_level_id){

					$json_result = array(
						'grade_level_id' => $grade_level_id,
						'result' => 'success',
						'success_message' => $success_message
						);
				}else{
					$json_result = array(
						'result' => 'failed'
						);
				}

				$json_result['grade_level'] = 'success';      

			}else{
				$json_result = array(
					'grade_level' => 'failed',
					'grade_level_message' => 'Grade Level already exist. ',
					'result' => 'failed'
					);
			}

			echo json_encode($json_result);




		}
	}


	public function grade_level_exist($grade_level, $sy_start, $sy_end){

		$main_model = $this->main_model;

		$count = $main_model->count_grade_level($grade_level, $sy_start, $sy_end);

		if($count > 0){
			return true;
		}else{
			return false;
		}

	}



}

/* End of file curiculum.php */
/* Location: ./application/controllers/curiculum.php */