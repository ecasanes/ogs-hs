<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Weekly_Plan extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'WEEKLY-PLAN';
		$this->document_primary = 'document_id';
		$this->form_primary = 'weekly_plan_id';

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$this->no_of_steps = 1;
	}

	public function index() {

		$this->is_logged_in();
		$data = $this->input->post();

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );

		$header_data = array(
			'hidden' => '',
			'container_class' => 'fixed',
			'container_size' => 'sm'
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';

		$results = $document_model->get_weekly_plan( $user_id );

		$model_data['upload_error'] = '';

		$model_data['status_dropdown'] = $this->get_dropdown_menu( null, 'weekly_plan_status' );
		$model_data['specialist_requirement_dropdown'] = $this->get_dropdown_menu( null, 'specialist_requirement', 'menu' );

		$model_data['user_option'] = $this->get_user_dropdown();

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view('layout/header', $header_data);
		$this->load->view( 'wp/weekly-plan-new', $model_data );
		$this->load->view('layout/footer');
	}

	public function create() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			//var_dump($data);

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$date = convert_string_to_date( $date );

			$weekly_plan_id = $document_model->create_weekly_plan( $work_order, $job_description, $specialist_requirement, $date, $comments, $status, $current_user_id );

			redirect( 'weekly-plan' );



		}
	}

	public function create_empty() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;

			$user_id = $this->session->userdata( 'session' );

			$document_model->create_empty_sub_table( $user_id, 'weekly_plan', 1, 'user_id' );

			echo $this->db->last_query();

			//echo $test;


		}

	}

	public function update() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$date = convert_string_to_date( $date );

			$document_model->update_single_weekly_plan( $weekly_plan_id, $work_order, $job_description, $specialist_requirement, $category, $date, $comment, $status );

			echo $this->db->last_query();



		}
	}

	public function remove() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$document_model->delete_value( $weekly_plan_id, 'weekly_plan', 'weekly_plan_id' );

			echo $this->db->last_query();



		}
	}

	public function get_weekly_plan() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$day = date( 'j' );
			$month = date( 'n' );
			$year = date( 'Y' );

			$json_array = array();
			$table_info = array();
			$user_info = array();

			$user_dropdown = $this->get_user_dropdown();
			$status_dropdown = $this->get_dropdown_menu( null, 'weekly_plan_status' );
			$specialist_requirement_dropdown = $this->get_dropdown_menu( null, 'specialist_requirement', 'menu' );

			$table_info['user_dropdown'] = $user_dropdown;
			$table_info['status_dropdown'] = $status_dropdown;
			$table_info['specialist_requirement_dropdown'] = $specialist_requirement_dropdown;


			$user_id = $this->input->post( 'user_id' );
			$single_user = $this->input->post( 'single_user' ); //true or false

			if ( !isset( $user_id ) ) {
				$user_id = $this->session->userdata( 'session' );
			}

			$user_info['user_id'] = $user_id;
			$user_info['current_day'] = $day;
			$user_info['current_month'] = $month;
			$user_info['current_year'] = $year;

			$results = $document_model->get_weekly_plan( $user_id );


			$json_array = array(
				"table_data" => $result,
				"table_info" => $table_info,
				"user_info" => $user_info
			);

			echo json_encode( $json_array );

		}

	}



}

/* End of file action_tracker.php */
/* Location: ./application/controllers/action_tracker.php */
