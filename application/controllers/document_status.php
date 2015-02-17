<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Document_Status extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'ACTION-TRACK';
		$this->document_primary = 'document_id';
		$this->form_primary = 'action_tracker_id';

		/*$main_model_str = 'ActionTracker_Model';
	    $this->load->model($main_model_str);
	    $this->main_model = new $main_model_str;*/

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$this->no_of_steps = 1;
	}

	public function index() {

		$this->is_logged_in();

		$uploads_folder = $this->uploads_folder;

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


		foreach ( $user_result as $result ) {

			$fullname = $result->first_name.' '.$result->last_name;
		}


		$model_data['current_user_id'] = $user_id;
		$model_data['current_user_name'] = $fullname;
		$model_data['document_status_value'] = '';




		$decf_results = $document_model->count_document_per_type( $user_id, 'decf', 'decf' );
		$basic_decf_results = $document_model->count_document_per_type( $user_id, 'decf', 'BASIC' );
		$ofi_results = $document_model->count_document_per_type( $user_id, 'ofi' );
		$pp_results = $document_model->count_document_per_type( $user_id, 'project_plan' );
		$tb_results = $document_model->count_document_per_type( $user_id, 'technical_bulletin' );
		$ws_results = $document_model->count_document_per_type( $user_id, 'witness_statement' );
		$tq_results = $document_model->count_document_per_type( $user_id, 'technical_query' );

		$model_data['decf_results'] = $decf_results;
		$model_data['basic_decf_results'] = $basic_decf_results;
		$model_data['ofi_results'] = $ofi_results;
		$model_data['pp_results'] = $pp_results;
		$model_data['tb_results'] = $tb_results;
		$model_data['ws_results'] = $ws_results;
		$model_data['tq_results'] = $tq_results;

		$header_data['current_page_name'] = "Document Status";
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'document/document-status-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	/* END EDIT */



}

/* End of file action_tracker.php */
/* Location: ./application/controllers/action_tracker.php */
