<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Performance_Dashboard extends MY_Controller {

	public function __construct(){

	     parent::__construct();

	     $user_model = new User_Model();
	}

	public function index(){
		redirect('performance-dashboard/current-availability');
	}

	public function current_availability(){

		$current_page_name = 'Current Availability';

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
		//$this->load->view( 'performance_dashboard/current-availability' );
		$this->load->view( 'layout/footer' );

	}

	public function my_actions(){

		$current_page_name = 'My Actions';

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
		//$this->load->view( 'performance_dashboard/my-actions' );
		$this->load->view( 'layout/footer' );

	}

	public function priority_actions(){

		$current_page_name = 'Priority Actions';

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
		$this->load->view( 'performance_dashboard/priority-actions' );
		$this->load->view( 'layout/footer' );

	}

	public function risk_register(){

		$current_page_name = 'Risk Register';

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
		//$this->load->view( 'performance_dashboard/risk-register' );
		$this->load->view( 'layout/footer' );

	}
}