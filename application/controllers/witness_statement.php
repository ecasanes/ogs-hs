<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Witness_Statement extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'WS';
		$this->document_primary = 'document_id';
		$this->form_primary = 'witness_statement_id';

		$main_model_str = 'WitnessStatement_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();
		$this->no_of_steps = 1;

		$step_titles = array(
			'Create Witness Statement'
		);

		$this->step_titles = $step_titles;


	}

	public function index() {
		redirect( 'user/my-account' );
	}


	public function view( $id ) {

		$form_redirect = false;
		$editable = $this->_form_check( $id, $form_redirect );

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Create a Witness Statement',
			'hidden' => ''
		);



		$model_data = array();


		$user_id = $this->session->userdata( 'session' );

		$username = $user_model->get_value( $user_id, 'user_name' );
		$email_address = $user_model->get_value( $user_id, 'email_address' );
		$current_user_id = $user_id;

		$document_details = $main_model->get_document( $id );

		//redirect if no document is found
		if ( count( $document_details ) <1 ) {
			redirect( 'user/my-account' );
		}

		$document_id = $document_details->document_id;

		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$decf_date = $document_details->date;

		$time = convert_string_to_time( $document_details->time );
		$conducted_by = $document_details->conducted_by;
		$conducted_email = $document_details->conducted_email;
		$recorded_by = $document_details->recorded_by;
		$recorded_email = $document_details->recorded_email;
		$witness_name = $document_details->witness_name;
		$witness_email = $document_details->witness_email;
		$accompanied_by = $document_details->accompanied_by;
		$accompanied_email = $document_details->accompanied_email;
		$witness_position = $document_details->witness_position;
		$employer = $document_details->employer;
		$witness_nickname = $document_details->witness_nickname;
		$witness_street_1 = $document_details->witness_street_1;
		$witness_street_2 = $document_details->witness_street_2;
		$witness_city = $document_details->witness_city;
		$witness_country = $document_details->witness_country;
		$witness_postal_code = $document_details->witness_postal_code;
		$incident_title = $document_details->incident_title;
		$incident_number = $document_details->incident_number;
		$incident_description = $document_details->incident_description;
		$statement = $document_details->statement;
		$signature = $document_details->signature;



		$model_data['user_name'] = $username;
		$model_data['user_date'] = convert_date_to_string( $decf_date );
		$model_data['code'] = $code;
		$model_data['installation'] = $name;
		$model_data['time'] = $time;
		$model_data['conducted_by'] = $conducted_by;
		$model_data['conducted_email'] = $conducted_email;
		$model_data['recorded_by'] = $recorded_by;
		$model_data['recorded_email'] = $recorded_email;
		$model_data['witness_name'] = $witness_name;
		$model_data['witness_email'] = $witness_email;
		$model_data['accompanied_by'] = $accompanied_by;
		$model_data['accompanied_email'] = $accompanied_email;
		$model_data['witness_position'] = $witness_position;
		$model_data['employer'] = $employer;
		$model_data['witness_nickname'] = $witness_nickname;
		$model_data['witness_street_1'] = $witness_street_1;
		$model_data['witness_street_2'] = $witness_street_2;
		$model_data['witness_city'] = $witness_city;
		$model_data['witness_country'] = $witness_country;
		$model_data['witness_postal_code'] = $witness_postal_code;
		$model_data['incident_title'] = $incident_title;
		$model_data['incident_number'] = $incident_number;
		$model_data['incident_description'] = $incident_description;
		$model_data['statement'] = $statement;
		$model_data['signature'] = $signature;

		$model_data['editable'] = $editable;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'view/view-ws-new', $model_data );
		$this->load->view( 'layout/footer' );
	}


	public function create() {

		$this->create_document();
	}



	public function edit( $id, $step = 1 ) {


		$this->_form_check( $id );

		if ( !is_numeric( $step ) ) {
			redirect( 'user/my-account' );
		}

		switch ( $step ) {
		case 1:
			$this->_edit_witness_statement( $id, $step );
			break;
		default:
			redirect( 'user/my-account' );
		}
	}

	public function save( $id = false, $action = 'update', $save_step = 1 ) {

		$this->_form_check( $id );

		if ( !is_numeric( $save_step ) ) {
			redirect( 'user/my-account' );
		}

		switch ( $save_step ) {
		case 1:
			$this->_save_witness_statement( $id, $action );
			break;
		default:
			redirect( 'user/my-account' );
		}
	}

	public function delete( $id ) {

		if ( $this->input->post() ) {
			$id = $this->input->post( 'id' );
			$this->delete_document( $id );
		}else {
			$redirect = true;
			$this->delete_document( $id, $redirect );
		}
	}

	public function duplicate( $id ) {

		$this->duplicate_document( $id );

	}


	public function _edit_witness_statement( $id, $step = 1 ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$form_redirect = false;
		$editable = $this->_form_check( $id, $form_redirect );


		$header_data = array(
			'title' => 'Create a Witness Statement',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$decf_date = $document_details->date;

		include 'includes/document-status-snippet.php';

		$name = $document_details->name;
		$time = convert_date_to_string( $document_details->time, false, true );
		$conducted_by = $document_details->conducted_by;
		$conducted_email = $document_details->conducted_email;
		$recorded_by = $document_details->recorded_by;
		$recorded_email = $document_details->recorded_email;
		$witness_name = $document_details->witness_name;
		$witness_email = $document_details->witness_email;
		$accompanied_by = $document_details->accompanied_by;
		$accompanied_email = $document_details->accompanied_email;
		$witness_position = $document_details->witness_position;
		$employer = $document_details->employer;
		$witness_nickname = $document_details->witness_nickname;
		$witness_street_1 = $document_details->witness_street_1;
		$witness_street_2 = $document_details->witness_street_2;
		$witness_city = $document_details->witness_city;
		$witness_country = $document_details->witness_country;
		$witness_postal_code = $document_details->witness_postal_code;
		$incident_title = $document_details->incident_title;
		$incident_number = $document_details->incident_number;
		$incident_description = $document_details->incident_description;
		$statement = $document_details->statement;
		$signature = $document_details->signature;

		$include_null = true;
		$additional_users = $document_model->get_document_owners( $document_id, null );

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['user_name'] = $username;
		$model_data['user_date'] = convert_date_to_string( $decf_date );
		$model_data['name'] = $name;
		$model_data['code'] = $code;
		$model_data['installation'] = $name;
		$model_data['time'] = $time;
		$model_data['conducted_by'] = $conducted_by;
		$model_data['conducted_email'] = $conducted_email;
		$model_data['recorded_by'] = $recorded_by;
		$model_data['recorded_email'] = $recorded_email;
		$model_data['witness_name'] = $witness_name;
		$model_data['witness_email'] = $witness_email;
		$model_data['accompanied_by'] = $accompanied_by;
		$model_data['accompanied_email'] = $accompanied_email;
		$model_data['witness_position'] = $witness_position;
		$model_data['employer'] = $employer;
		$model_data['witness_nickname'] = $witness_nickname;
		$model_data['witness_street_1'] = $witness_street_1;
		$model_data['witness_street_2'] = $witness_street_2;
		$model_data['witness_city'] = $witness_city;
		$model_data['witness_country'] = $witness_country;
		$model_data['witness_postal_code'] = $witness_postal_code;
		$model_data['incident_title'] = $incident_title;
		$model_data['incident_number'] = $incident_number;
		$model_data['incident_description'] = $incident_description;
		$model_data['statement'] = $statement;
		$model_data['signature'] = $signature;

		$model_data['editable'] = $editable;
		$model_data['files'] = $files;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Witness Statement';


		$this->load->view('layout/header', $header_data);
		$this->load->view( 'ws/witness-statement-0-new', $model_data );
		$this->load->view('layout/footer');
	}


	/* SAVE */
	public function _save_witness_statement( $id, $action ) {

		include 'includes/document-save-init.php';
		$user_date = convert_string_to_date( $user_date );
		$user_time = convert_string_to_time( $time );

		//var_dump($user_date);
		//var_dump($time);

		$main_model->update_step_0( $form_id, $user_time, $user_date, $conducted_by, $conducted_email, $recorded_by, $recorded_email, $witness_name, $witness_email, $accompanied_by, $accompanied_email, $witness_position, $employer, $witness_nickname, $witness_street_1, $witness_street_2, $witness_city, $witness_country, $witness_postal_code, $incident_title, $incident_number, $incident_description, $statement, $signature );

		$document_model->update( $model_id, $name );

		$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


	}

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
