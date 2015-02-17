<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Update extends MY_Controller {

	public function __construct() {

		parent::__construct();

	}

	public function cron() {

		$databases = $this->databases;

		foreach ( $databases as $database ) {

			if ( empty( $database ) || $database == '' ) {
				$database = 'default';
			}

			echo "\n".$database.":\n";

			$this->db = $this->load->database( $database, TRUE );

			$this->update_daily_equipment_status_version2();

		}

	}


}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
