<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Report extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'CRITICALITY-ANALYSIS';
		$this->document_primary = 'document_id';
		$this->form_primary = 'criticality_analysis_id';

		$main_model_str = 'Criticality_Analysis_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$user_model = new User_Model();

		$this->no_of_steps = 1;
	}

	public function index() {

		$this->is_logged_in();

		$uploads_folder = $this->uploads_folder;

		$this->load->model( 'Document_Model' );

		$this->load->model( 'User_Model' );

		$document_model = new Document_Model();

		$user_model = new User_Model();

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'reports/handover-report', $model_data );
		$this->load->view( 'includes/footer' );
	}

	public function handover_report() {
		$this->is_logged_in();
		$data = $this->input->post();

		$this->load->model( 'Document_Model' );

		$this->load->model( 'User_Model' );

		$document_model = new Document_Model();

		$user_model = new User_Model();

		$user_id = $this->session->userdata( 'session' );
		$username = $this->session->userdata( 'session_user' );
		$case_file_step = $this->session->userdata( 'case_file_step' );


		//echo $user_id;


		$user_result = $user_model->get_record( $user_id );
		$followed_users = $user_model->get_followed_user( $user_id );

		$header_data = array(
			'hidden' => ''
		);

		$model_data = array();
		$model_data['user_option'] = '';

		$userdata = $user_model->get_all_records();

		$userdata_array = array();
		$userdata_counter = 0;

		foreach ( $user_result as $result ) {

			$cover_photo = $result->cover_photo;

		}
		$model_data['cover_filename'] = $cover_photo;

		$model_data['cover_photo'] = $cover_photo;

		$header_data = array(
		);

		$model_data = array();

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'reports/handover-report-new', $model_data );
		$this->load->view( 'layout/footer' );
	}
}




/* End of file criticality_analysis.php */
/* Location: ./application/controllers/criticality_analysis.php */
