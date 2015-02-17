<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Page extends MY_Controller {

	protected $parent_name;
	protected $parent_uri;
	protected $current_name;
	protected $current_uri;

  	public function __construct() {

    	parent::__construct();

    	$this->parent_name = 'Page';
    	$this->parent_uri = '/page';

	}

	public function index() {
		if ( $this->session->userdata( 'session' ) ) {
			redirect( 'user/start-activity' );
		}else {
			$this->home();
		}
	}

	public function home() {
		$header_data = array(
			'title' => '',
			'main_group' => '',
			'description' => '',
			'hidden' => ''
		);

		$header_data['data'] = $header_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'pages/home' );
		$this->load->view( 'includes/footer' );
	}

	public function error_404() {
		$header_data = array(
			'title' => '',
			'main_group' => '',
			'description' => ''
		);

		$header_data['data'] = $header_data;

		$this->output->set_status_header( '404' );

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pages/error-404' );
		$this->load->view( 'layout/footer' );
	}

	public function under_construction( $page_heading = '' ) {

		if ( $page_heading == '' ) {
			$page_heading = 'Page';
		}else if ( $page_heading == 'Material_Corrosion' ) {
				$page_heading = 'Material Corrosion & Damage';
			}else if ( $page_heading == 'Non_Compliance' ) {
				$page_heading = 'Non Compliance';
			}else if ( $page_heading == 'Performance_Dashboard' ) {
				$page_heading = 'Performance Dashboard';
			}else if ( $page_heading == 'Status_Window' ) {
				$page_heading = 'Status Window';
			}else if ( $page_heading == 'Action_Tracker' ) {
				$page_heading = 'Action Tracker';
			}else if ( $page_heading == 'Equipment_Repairs' ) {
				$page_heading = 'Equipment Repairs';
			}

		$header_data = array(
			'page_heading' => $page_heading
		);

		$header_data['data'] = $header_data;

		$this->load->view( 'under-construction', $header_data );
	}

	public function tech_help() {

		$header_data = array(
			'title' => '',
			'main_group' => '',
			'description' => '',
			'hidden' => ''
		);

		$header_data['data'] = $header_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'tech-help' );
		$this->load->view( 'includes/footer' );
	}

	public function view_tb_test() {

		$header_data = array(
			'title' => '',
			'main_group' => '',
			'description' => '',
			'hidden' => ''
		);

		$header_data['data'] = $header_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'view/view-tb-test' );
		$this->load->view( 'includes/footer' );
	}

	public function tb_ranking() {

		$header_data = array(
			'title' => '',
			'main_group' => '',
			'description' => '',
			'hidden' => ''
		);

		$header_data['data'] = $header_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'tb-ranking' );
		$this->load->view( 'includes/footer' );
	}

//NEW DASHBOARD THEME

	public function golden_rule() {
		$header_data = array(
			'title' => '',
			'main_group' => '',
			'description' => '',
			'hidden' => ''
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pages/golden-rule-new' );
		$this->load->view( 'layout/footer' );
	}



}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
