<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class File extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_primary = 'document_id';
		$this->form_primary = 'file_id';

		$main_model_str = 'File_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;
	}

	public function upload() {

		echo 'test';

	}

	public function upload_test() {

		if ( isset( $_FILES["myfile"] ) ) {
			//Filter the file types , if you want.
			if ( $_FILES["myfile"]["error"] > 0 ) {
				echo "Error: " . $_FILES["file"]["error"] . "<br>";
			}
			else {
				//move the uploaded file to uploads folder;
				move_uploaded_file( $_FILES["myfile"]["tmp_name"], $output_dir. $_FILES["myfile"]["name"] );

				echo "Uploaded File :".$_FILES["myfile"]["name"];
			}

		}
	}

}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
