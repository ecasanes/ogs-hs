<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quality_Management extends MY_Controller {

	public function __construct(){

	     parent::__construct();

	     $user_model = new User_Model();
	}

	public function index(){
		redirect('quality-management/temporary_equipment');
	}

	public function temporary_equipment(){

		$current_page_name = 'Temporary Equipment';

		$this->is_logged_in();

		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		if($session_site_role == 'admin' || $session_site_role == 'siteadmin'){
			$hidden_display = '';
		}else{
			$hidden_display = 'hidden';
		}

		$header_data = array(
			'current_page_name' => $current_page_name,
			'container_class' => 'fixed',
			'container_size' => 'sm'
		);

		$model_data = array(
			'session_site_role' => $session_site_role,
			'hidden_display' => $hidden_display
		);


		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'quality_management/temporary-equipment', $model_data );
		$this->load->view( 'layout/footer' );

	}

	public function performance_report(){

		$current_page_name = 'Performance Report';

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
		//$this->load->view( 'quality_management/performance-report' );
		$this->load->view( 'layout/footer' );

	}

	public function non_compliance_report(){

		$current_page_name = 'Non Compliance Report';

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
		//$this->load->view( 'quality_management/non-compliance-report' );
		$this->load->view( 'layout/footer' );

	}

	public function audit_report(){

		$current_page_name = 'Audit Report';

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
		//$this->load->view( 'quality_management/audit-report' );
		$this->load->view( 'layout/footer' );

	}

	public function master_data(){

		$current_page_name = 'Master Data';

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
		//$this->load->view( 'quality_management/master-data' );
		$this->load->view( 'layout/footer' );

	}



}

/* End of file project_plan.php */
/* Location: ./application/controllers/quality_management.php */