<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Integrity_Management extends MY_Controller {

	public function __construct(){

	     parent::__construct();

	     $user_model = new User_Model();
	}

	public function index(){
		redirect('integrity-management/mcdr');
	}


	public function mcdr(){

		$current_page_name = 'MCDR';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/mcdr' );
		$this->load->view( 'layout/footer' );

	}

	public function mcdr_edit(){

		$current_page_name = 'MCDR Form';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/mcdr-edit' );
		$this->load->view( 'layout/footer' );
	}

	public function temporary_repair_register(){

		$current_page_name = 'Temporary Repair Register';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		//$this->load->view( 'integrity_management/temporary-repair-register' );
		$this->load->view( 'layout/footer' );

	}

	public function temporary_refuge_and_loss_control(){

		$current_page_name = 'Temporary Refuge & Loss Control';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		//$this->load->view( 'integrity_management/temporary-refuge-and-loss-control' );
		$this->load->view( 'layout/footer' );

	}

	public function psv(){

		$current_page_name = 'PSV and Pressure Vessels';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		//$this->load->view( 'integrity_management/psv' );
		$this->load->view( 'layout/footer' );

	}

	public function certification(){

		$current_page_name = 'Certification';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		//$this->load->view( 'integrity_management/certification' );
		$this->load->view( 'layout/footer' );

	}

	public function flexible_hoses(){

		$current_page_name = 'Flexible Hoses';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		//$this->load->view( 'integrity_management/flexible-hoses' );
		$this->load->view( 'layout/footer' );

	}

	public function atex(){

		$current_page_name = 'ATEX';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		//$this->load->view( 'integrity_management/atex' );
		$this->load->view( 'layout/footer' );

	}

	public function remedial_action_register(){

		$current_page_name = 'Remedial Action Register';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/remedial-action-register' );
		$this->load->view( 'layout/footer' );

	}

	public function management_of_change(){

		$current_page_name = 'Management of Change';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);


		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/management-of-change' );
		$this->load->view( 'layout/footer' );

	}


	public function fgas_register(){

		$current_page_name = 'F-Gas Register';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/fgas-register' );
		$this->load->view( 'layout/footer' );

	}

	public function rats(){

		$current_page_name = 'Register of Alarms, Trips & Set Points';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/rats' );
		$this->load->view( 'layout/footer' );

	}


	public function esd_psd(){

		$current_page_name = 'ESD/PSD Values';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/esd-psd' );
		$this->load->view( 'layout/footer' );

	}


	public function fire_dampers(){

		$current_page_name = 'Fire Dampers';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/fire-dampers' );
		$this->load->view( 'layout/footer' );

	}


	public function critical_drainage(){

		$current_page_name = 'Critical Drainage';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/critical-drainage' );
		$this->load->view( 'layout/footer' );

	}


	public function dpi(){

		$current_page_name = 'Dye Penetrant Inspection';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/dpi');
		$this->load->view( 'layout/footer' );
	}


	public function eci(){

		$current_page_name = 'Eddy Current Inspection Report';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/eci');
		$this->load->view( 'layout/footer' );
	}

	public function mpi(){
		$current_page_name = 'Magnetic Particle Inspection Report';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/mpi');
		$this->load->view( 'layout/footer' );
	}


	public function gip()
	{
		
		
		$current_page_name = 'General Inspection Report';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$data = $this->input->post();

		// Variables.
		$post_vars = array();
		$post_vars['report_no'] = '';
	    $post_vars['customer'] = '';
	    $post_vars['location'] = ''; 
	    $post_vars['procedure'] = '';
	    $post_vars['project'] = '';
	    $post_vars['surface'] = '';
	    $post_vars['equipment'] = '';
	    $post_vars['equipment_serial_no'] = '';
	    $post_vars['type_of_inspection'] = '';
	    $post_vars['item'] = '';
	    $post_vars['drawing_no'] = '';
	    $post_vars['specification'] = '';
	    $post_vars['material'] = '';
	    $post_vars['size'] = '';
	    $post_vars['quantity'] = '';
	    $post_vars['scope'] = '';
	    $post_vars['restrictions'] = '';
	    $post_vars['inspection_results'] = '';
	    $post_vars['inspector'] = '';
	    $post_vars['date'] = '';
	    $post_vars['for_client_use'] = '';
	    $post_vars['for_cert_auth'] = '';
	    $post_vars['serial_no'] = '';
	    $post_vars['signature'] = '';
	    $post_vars['purchase_no'] = '';
	    $post_vars['qual'] = '';
	    $post_vars['confirm_msg'] = $this->session->flashdata('confirm_msg'); // Included here to prevent the error, and so we can reuse the gip.php

		// Config for dismissible alerts.	    
	    $post_vars['alert_class'] = 'alert-success';

	  	if( $this->session->flashdata('alert_class') )
	  	{
	  		$post_vars['alert_class'] = $this->session->flashdata('alert_class');
	  	}

		if( $data ) 
		{
			// Trim all data.
			foreach($post_vars as $input) {
				$input = trim($input);
			}

			// Post variables.
			$post_vars['report_no'] = $this->input->post('report_no');
	        $post_vars['customer'] = $this->input->post('customer');
			$post_vars['location'] = $this->input->post('location'); 
	        $post_vars['procedure'] = $this->input->post('procedure');
	        $post_vars['project'] = $this->input->post('project');
	        $post_vars['surface'] = $this->input->post('surface');
	        $post_vars['equipment'] = $this->input->post('equipment');
	        $post_vars['equipment_serial_no'] = $this->input->post('equipment_serial_no');
	        $post_vars['type_of_inspection'] = $this->input->post('type_of_inspection');
	        $post_vars['item'] = $this->input->post('item');
	        $post_vars['drawing_no'] = $this->input->post('drawing_no');
	        $post_vars['specification'] = $this->input->post('specification');
	        $post_vars['material'] = $this->input->post('material');
	        $post_vars['size'] = $this->input->post('size');
	        $post_vars['quantity'] = $this->input->post('quantity');
	        $post_vars['scope'] = $this->input->post('scope');
	        $post_vars['restrictions'] = $this->input->post('restrictions');
	        $post_vars['inspection_results'] = $this->input->post('inspection_results');
	        $post_vars['inspector'] = $this->input->post('inspector');
	        $post_vars['date'] = $this->input->post('date');
	        $post_vars['for_client_use'] = $this->input->post('for_client_use');
	        $post_vars['for_cert_auth'] = $this->input->post('for_cert_auth');
	        $post_vars['serial_no'] = $this->input->post('serial_no');
	        $post_vars['signature'] = $this->input->post('signature');
	        $post_vars['purchase_no'] = $this->input->post('purchase_no');
	        $post_vars['qual'] = $this->input->post('qual');

			// Form validation.
			$this->load->library('form_validation');

			// Set rules.
			$this->form_validation->set_rules('customer', 'customer', 'required');
			$this->form_validation->set_rules('location', 'location', 'required');
			$this->form_validation->set_rules('purchase_no', 'purchase_no', 'required');
			$this->form_validation->set_rules('project', 'project', 'required');
			$this->form_validation->set_rules('report_no', 'report_no', 'required|is_unique[general_inspection_report.report_no]');
			
			/*$this->form_validation->set_rules('procedure', 'procedure', 'required');
			
			$this->form_validation->set_rules('surface', 'surface', 'required');
			$this->form_validation->set_rules('equipment', 'equipment', 'required');
			$this->form_validation->set_rules('equipment_serial_no', 'equipment_serial_no', 'required');
			$this->form_validation->set_rules('type_of_inspection', 'type_of_inspection', 'required');
			$this->form_validation->set_rules('item', 'item', 'required');
			$this->form_validation->set_rules('drawing_no', 'drawing_no', 'required');
			$this->form_validation->set_rules('specification', 'specification', 'required');
			$this->form_validation->set_rules('material', 'material', 'required');
			$this->form_validation->set_rules('size', 'size', 'required');
			$this->form_validation->set_rules('quantity', 'quantity', 'required');
			$this->form_validation->set_rules('scope', 'scope', 'required');
			$this->form_validation->set_rules('restrictions', 'restrictions', 'required');
			$this->form_validation->set_rules('inspection_results', 'inspection_results', 'required');
			$this->form_validation->set_rules('inspector', 'inspector', 'required');
			$this->form_validation->set_rules('date', 'date', 'required');
			$this->form_validation->set_rules('for_client_use', 'for_client_use', 'required');
			$this->form_validation->set_rules('for_cert_auth', 'for_cert_auth', 'required');
			$this->form_validation->set_rules('serial_no', 'serial_no', 'required');
			$this->form_validation->set_rules('signature', 'signature', 'required');
			
			$this->form_validation->set_rules('qual', 'qual', 'required');*/

			// Run if ok.
			if( $this->form_validation->run() == TRUE )
			{
				// Run model.
				$this->load->model('General_Inspection_Model');
				$general_inspection_model = new General_Inspection_Model();

				// Insert.
				$result = $general_inspection_model->add_general_inspection($data);
				
				if($result == false) { die('ERROR on INSERT'); }
				else 
				{  
					$this->session->set_flashdata('confirm_msg', 'Report No: <b>'.$result.'</b> Successfully Added!');
					redirect( base_url().'integrity_management/gip_edit/'.$result ); 
				}

			}
			else // Display pre-data if it doesn't run.
			{
				$this->load->view( 'layout/header', $header_data );
				$this->load->view( 'integrity_management/gip', $post_vars);
				$this->load->view( 'layout/footer' );
			}
		}
		else 
		{
			// Load normally with pre-data.
			$this->load->view( 'layout/header', $header_data );
			$this->load->view( 'integrity_management/gip', $post_vars);
			$this->load->view( 'layout/footer' );
		}
	}

	public function gip_edit($report_no)
	{
		// Check if logged in.
		$this->is_logged_in();
		$user_model = $this->user_model;

		// Get user data.
		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		// Load libs.
		$this->load->model('General_Inspection_Model');
		$general_inspection_model = new General_Inspection_Model();

		// Check report no.
		$general_inspection_report = $general_inspection_model->get_general_inspection($report_no);

		// Check report no if it is valid.
		if( ! $general_inspection_report )
		{
			// Else Redirect.
			$this->session->set_flashdata('confirm_msg', 'Report No does to be edited <b>not exist.</b>');
			$this->session->set_flashdata('alert_class', 'alert-warning');
			redirect( base_url().'integrity_management/gip/'.$result ); 
		}

		# END OF INSPECTION PHASE.
		
		// Confirmation message if there is.
		$general_inspection_report['confirm_msg'] = $this->session->flashdata('confirm_msg');
		$general_inspection_report['alert_class'] = 'alert-success';
		$current_page_name = 'General Inspection Report';

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		// Check if edit is set.
		$data = $this->input->post();

		if( $data )
		{
			// Post variables.
			$general_inspection_report['report_no'] = $this->input->post('report_no');
	        $general_inspection_report['customer'] = $this->input->post('customer');
			$general_inspection_report['location'] = $this->input->post('location'); 
	        $general_inspection_report['procedure'] = $this->input->post('procedure');
	        $general_inspection_report['project'] = $this->input->post('project');
	        $general_inspection_report['surface'] = $this->input->post('surface');
	        $general_inspection_report['equipment'] = $this->input->post('equipment');
	        $general_inspection_report['equipment_serial_no'] = $this->input->post('equipment_serial_no');
	        $general_inspection_report['type_of_inspection'] = $this->input->post('type_of_inspection');
	        $general_inspection_report['item'] = $this->input->post('item');
	        $general_inspection_report['drawing_no'] = $this->input->post('drawing_no');
	        $general_inspection_report['specification'] = $this->input->post('specification');
	        $general_inspection_report['material'] = $this->input->post('material');
	        $general_inspection_report['size'] = $this->input->post('size');
	        $general_inspection_report['quantity'] = $this->input->post('quantity');
	        $general_inspection_report['scope'] = $this->input->post('scope');
	        $general_inspection_report['restrictions'] = $this->input->post('restrictions');
	        $general_inspection_report['inspection_results'] = $this->input->post('inspection_results');
	        $general_inspection_report['inspector'] = $this->input->post('inspector');
	        $general_inspection_report['date'] = $this->input->post('date');
	        $general_inspection_report['for_client_use'] = $this->input->post('for_client_use');
	        $general_inspection_report['for_cert_auth'] = $this->input->post('for_cert_auth');
	        $general_inspection_report['serial_no'] = $this->input->post('serial_no');
	        $general_inspection_report['signature'] = $this->input->post('signature');
	        $general_inspection_report['purchase_no'] = $this->input->post('purchase_no');
	        $general_inspection_report['qual'] = $this->input->post('qual');

			// Validation rules.
			$this->load->library('form_validation');

			// Set rules.
			$this->form_validation->set_rules('customer', 'customer', 'required');
			$this->form_validation->set_rules('location', 'location', 'required');
			$this->form_validation->set_rules('purchase_no', 'purchase_no', 'required');
			$this->form_validation->set_rules('project', 'project', 'required');
			$this->form_validation->set_rules('report_no', 'report_no', 'required');
			
			// Validate.
			if($this->form_validation->run()) 
			{
				// Rup Update and Repopulate display.
				$result = $general_inspection_model->update_general_inspection($general_inspection_report);

				// Run query again.
				$result = $general_inspection_model->get_general_inspection($report_no);

				if($result)
				{
					// Query again.
					$general_inspection_model->get_general_inspection($report_no);
					$general_inspection_report['confirm_msg'] = 'Report no <b>'.$report_no.'</b> Updated!';
					$general_inspection_report['alert_class'] = 'alert-success';
				}
				else 
				{
					die('update failed.');
				}
			}
		}
		
		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/gip_edit', $general_inspection_report);
		$this->load->view( 'layout/footer' );
	}	


	public function ut(){

		$current_page_name = 'Ultrasonic Inspection Report';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/ut');
		$this->load->view( 'layout/footer' );
	}


	public function gip_corrosion(){

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'General Inspection',
			'hidden' => ''
		);

		$model_data = array();
		
		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );
		$current_user_id = $user_id;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/gip-corrosion' );
		$this->load->view( 'layout/footer' );
	}


	public function gip_coating(){

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'General Inspection',
			'hidden' => ''
		);

		$model_data = array();
		
		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );
		$current_user_id = $user_id;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/gip-coating' );
		$this->load->view( 'layout/footer' );
	}


	public function edit_general_inspection(){
		$current_page_name = 'Inspection Report';

		$this->is_logged_in();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/edit-general-inspection');
		$this->load->view( 'layout/footer' );
	}


	public function inspection_type(){

		$current_page_name = 'Inspection Report';

		$this->is_logged_in();
		$user_model = $this->user_model;
		$user_model = new User_Model();
		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/inspection_type' );
		$this->load->view( 'layout/footer' );
	}


	public function check_add_general_inspection()
	{
		// Model.
		$this->load->model('general_inspection_model');
		$general_inspection_model = new General_Inspection_Model();

		$report_no = 'R1423-GVI-008';
		$customer = 'Transocean';
		$location = 'Galaxy II';
		$procedure = 'RMS-GVI-001';
		$project = 'R1423';
		$surface = 'As found';
		$equiptment = 'Digital Camera';
		$equiptment_serial_no = '';
		$type_of_inspection = 'Derrick Sweep';
		$item = 'Derrick Area';
		$drawing_no = 'N/A';
		$specification = 'Report All Findings';
		$material = 'Carbon Steel';
		$size = 'N/A';
		$quantity = '';
		$scope = 'A Derrick sweep was carried out as per instruction from the client to ascertain whether there were any potential dropped Objects...';
		$extent_of_inspection = '100% of all areas were inspected, no restrictions encountered.';
		$results = 'The above item was inspected in accordance with procedure. No potential dropped objects were foudn during this sweep;...';
		$inspector = 'B. Quinn';
		$date = 'now()';
		$for_client_use = '';
		$for_cert_auth = '';
		$serial_no = '';
		$signature = 'Image to be posted.';

		print $general_inspection_model->add_general_inspection($report_no, $customer, $location, $procedure, $project, $surface, 
                                    $equiptment, $equiptment_serial_no, $type_of_inspection, $item, $drawing_no, 
                                    $specification, $material, $size, $quantity, $scope, $extent_of_inspection, 
                                    $results, $inspector, $date, $for_client_use, $for_cert_auth, $serial_no, 
                                    $signature);

		
	}


	public function inspection_type_dashboard(){


		$current_page_name = 'Inspection Type Dashboard';

		$this->is_logged_in();
		$user_model = $this->user_model;
		$user_model = new User_Model();
		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'current_page_name' => $current_page_name
		);

		$model_data = array(
			'session_site_role' => $session_site_role
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'integrity_management/inspection_type_dashboard' );
		$this->load->view( 'layout/footer' );

	}
}

/* End of file integrity_management.php */
/* Location: ./application/controllers/integrity_management.php */