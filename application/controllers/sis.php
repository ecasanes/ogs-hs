<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Sis extends MY_Controller {

	//user: Adrian Sangil
	//email: adrian.sangil01@gmail.com
	public function __construct() {

		parent::__construct();
		$this->controller_uri = 'uri';

		$main_model_str = 'Sis_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

	}

	public function index() {

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );

		$header_data = array(
			'title' => 'Safety Instrumented System',
			'hidden' => ''
		);

		$model_data = array(

		);

		$user_model = $this->user_model;
		$form_model = $this->main_model;

		$model_data['current_user_id'] = $user_id;
		//$results = $form_model->get_menu_records();
		//$menu_results = $form_model->get_menu_category_records();

		//$model_data['results'] = $results;
		//$model_data['categories'] = $menu_results;
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'sis', $model_data );
		$this->load->view( 'includes/footer' );
	}

	public function get_sis_list() {

		$data = $this->input->post();

		//var_dump($data);

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$json_array = array();
			$table_info = array();

			//initialize models
			$main_model = $this->main_model;
			$document_model = $this->document_model;

			$results = $main_model->get_sis_records();

			foreach ( $results as $result ) {
				$sis_id = $result->sis_id;
				$tag_number = $result->tag_number;
				$code = $result->code;
				$description = $result->description;

				$temp_array = array();
				$temp_array['sis_id'] = $sis_id;
				$temp_array['tag_number'] = $tag_number;
				$temp_array['code'] = $code;
				$temp_array['description'] = $description;

				$json_array[] = $temp_array;
			}

			echo json_encode( $json_array );
			//var_dump($data);
		}
	}

	public function update() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$main_model->update_single_sis( $sis_id, $tag_number, $description, $code );

			redirect( 'sis' );

		}
	}

	public function create() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			//var_dump($data);

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$criticality_analysis_id = $main_model->create_sis( $tag_number, $description, $code );

			redirect( 'sis' );



		}
	}

}
