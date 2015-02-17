<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class MY_Secure_Controller extends MY_Controller {
	function __construct() {
		parent::__construct();

		$this->is_logged_in();

	}

}

?>
