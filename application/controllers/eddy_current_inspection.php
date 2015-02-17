<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eddy_Current_Inspection extends MY_Controller {

	public function __construct(){

	     parent::__construct();

	    $this->document_code = 'ECI';
	    $this->document_primary = 'document_id';
	    $this->form_primary = 'id';

	    $main_model_str = 'Eddy_Current_Inspection_Model';
	    $this->load->model($main_model_str);
	    $this->main_model = new $main_model_str;

	    $this->load->model('Document_Model');
	    $this->document_model = new Document_Model();

	 
	}

	public function index() {
		redirect( 'user/my-account' );
	}

	public function view( $id, $action = ''){

		$form_redirect = false;
		$editable = $this->_form_check( $id, $form_redirect );

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;
		$no_of_steps = $this->no_of_steps;
		$uploads_folder = $this->uploads_folder;

		$header_data = array(
			'title' => 'View Case File',
			'hidden' => ''
		);

		$model_data = array();

		$user_id = $this->session->userdata( 'session' );
	}

	public function add(){

		$data = $this->input->post();

		if($data){

			extract($data, EXTR_SKIP);

			$this->load->model('Eddy_Current_Inspection_Model');

			$inspection_model = new Eddy_Current_Inspection_Model;

			$inspection_id = $inspection_model->add_eddy_current($customer, $location, $po_num, $project, $report_num, $surface, $procede, 
                    $equipment, $serial_num, $client, $item, $drawing_num, $acceptance_standard, $material, $size, $quantity, 
                    $identification, $absolute_freq, $absolute_gain, $absolute_phase, $absolute_calibration, $absolute_serial, 
                    $bridge_freq, $bridge_gain, $bridge_phase, $bridge_calibration, $bridge_serial, $coating, $geometry, $heat_treatment,
                    $welding_process, $joint_type, $calibration_block, $scope, $restrictions, $results, $inspector, $signature, 
                    $date, $for_client, $for_certify);

			//redirect('eddy-current-inspection/edit/'.$inspection_id);

		}

	}

	public function edit($id){

		$current_page_name = 'Edit General Inspection Report';

		$this->is_logged_in();
		$user_model = $this->user_model;
		$main_model = $this->main_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array();

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$inspection_details = $main_model->get_record( $id );
		$inspection_details = $inspection_details[0];

		//var_dump($inspection_details);

		$id = $inspection_details->id;
		$customer = $inspection_details->customer;
		$location = $inspection_details->location;
		$po_num = $inspection_details->po_num;
		$project = $inspection_details->project;
		$report_num = $inspection_details->report_num;
		$surface = $inspection_details->surface;
		$procede = $inspection_details->procede;
		$equipment = $inspection_details->equipment;
		$inspection_type = $inspection_details->inspection_type;
		$serial_num = $inspection_details->serial_num;
		$client = $inspection_details->client;
		$item = $inspection_details->item;
		$drawing_num = $inspection_details->drawing_num;
		$acceptance_standard = $inspection_details->acceptance_standard;
		$material = $inspection_details->material;
		$size = $inspection_details->size;
		$quantity = $inspection_details->quantity;
		$identification = $inspection_details->identification;
		$scope = $inspection_details->scope;
		$restriction = $inspection_details->restriction;
		$results = $inspection_details->results;
		$inspector = $inspection_details->inspector;
		$signature = $inspection_details->results;
		$date = $inspection_details->date;
		$for_client = $inspection_details->for_client;
		$for_certify = $inspection_details->for_certify;

		$model_data['id'] = $id;
		$model_data['customer'] = $customer;
		$model_data['location'] = $location;
		$model_data['po_num'] = $po_num;
		$model_data['project'] = $project;
		$model_data['report_num'] = $report_num;
		$model_data['surface'] = $surface;
		$model_data['procede'] = $procede;
		$model_data['equipment'] = $equipment;
		$model_data['inspection_type'] = $inspection_type;
		$model_data['serial_num'] = $serial_num;
		$model_data['client'] = $client;
		$model_data['item'] = $item;
		$model_data['drawing_num'] = $drawing_num;
		$model_data['acceptance_standard'] = $acceptance_standard;
		$model_data['material'] = $material;
		$model_data['size'] = $size;
		$model_data['quantity'] = $quantity;
		$model_data['identification'] = $identification;
		$model_data['scope'] = $scope;
		$model_data['restriction'] = $restriction;
		$model_data['results'] = $results;
		$model_data['inspector'] = $inspector;
		$model_data['signature'] = $signature;
		$model_data['date'] = $date;
		$model_data['for_client'] = $for_client;
		$model_data['for_certify'] = $for_certify;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/edit-general-inspection', $model_data);
		$this->load->view( 'layout/footer' );
	}


	public function edit_general_inspection($id){

		
	}	


	public function save($id){

		$data = $this->input->post();

		if($data){

			extract($data, EXTR_SKIP);

			$this->load->model('General_Inspection_Model');

			$inspection_model = new General_Inspection_Model;

			$inspection_id = $inspection_model->update_general_inspection($id, $customer, $location, $po_num, $project, $report_num, $surface, $procede, $equipment, 
			$inspection_type, $serial_num, $client, $item, $drawing_num, $acceptance_standard, $material, $size, $quantity, 
			$identification, $scope, $restriction, $results, $inspector, $signature, $date, $for_client, $for_certify);

			redirect('general-inspection/edit/'.$inspection_id);

		}
	}


	/* END EDIT */

}
