<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Subject extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'Subject_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->form_primary = 'subject_id';
	}

	public function index() {
		
		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();
		$model_data = array();
		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Subject.add_subject()', 
			'Module.Subject.refresh_subject_list()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'subject/index', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);


	}

	public function create_subject(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$this->load->library( 'form_validation' );

			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_message( 'is_unique', 'failed' );

			$this->form_validation->set_rules( 'subject_code', 'Subject Code', 'is_unique[tbl_subject.subj_code]' );

			if ( $this->form_validation->run() ) {

				$subject_id = $main_model->create_subject($subject_code, $subject_unit, $subject_description);
				$success_message = "Subject was added successfully. ";

				if($subject_id){

					$json_result = array(
						'subject_id' => $subject_id,
						'result' => 'success',
						'success_message' => $success_message
						);
				}else{
					$json_result = array(
						'result' => 'failed'
						);
				}

				$json_result['subject_code'] = 'success';      

			}else{
				$json_result = array(
					'subject_code' => form_error('subject_code'),
					'subject_code_message' => 'Subject Code already exist. ',
					'result' => 'failed'
					);
			}

			echo json_encode($json_result);




		}
	}

	public function data_list(){

		$main_model = $this->main_model;
		$controller = $this->controller;

		$results = $main_model->get_subjects();

		$model_data = array(
			'results' => $results
			);

		$this->load->view($controller.'/list', $model_data);
	}

	public function search_list(){

		$main_model = $this->main_model;
		$user_model = $this->user_model;
		$user_type = $this->user_type;
		$controller = $this->controller;

		$search_key = $this->input->get('search');

		$results = $user_model->search_list($search_key, $user_type);

		$model_data = array(
			'results' => $results
			);

		$this->load->view($controller.'/list', $model_data);
	}

}

/* End of file subject.php */
/* Location: ./application/controllers/subject.php */