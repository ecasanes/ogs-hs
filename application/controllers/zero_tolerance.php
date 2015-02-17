<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Zero_Tolerance extends MY_Controller {

	public function index() {
		$data = array(
			'title' => '',
			'main_group' => '',
			'description' => '',
			'hidden' => ''
		);
		$this->load->view( 'includes/header-with-logout', $data );
		$this->load->view( 'zero-tolerance' );
		$this->load->view( 'includes/footer' );

	}




}

/* End of file zero-tolerance.php */
/* Location: ./application/controllers/zero-tolerance.php */
