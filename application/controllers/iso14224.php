<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class ISO14224 extends MY_Controller {

	public function index() {
		$data = array(
			'title' => '',
			'main_group' => '',
			'description' => '',
			'hidden' => ''
		);
		$this->load->view( 'includes/header-with-logout', $data );
		$this->load->view( 'iso14224' );
		$this->load->view( 'includes/footer' );

	}




}

/* End of file iso14224.php */
/* Location: ./application/controllers/iso14224.php */
