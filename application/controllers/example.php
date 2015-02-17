<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Example extends CI_Controller {

		public function index() {

			$footer_data = array();
			$footer_data['listeners'] = array();

			// Scripts to call.
			array_push($footer_data['listeners'], 'hehe');
			array_push($footer_data['listeners'], 'haha');

			$this->load->view( 'layout/example' );
			$this->load->view( 'layout/footer_example', $footer_data );
		}	

		public function add_action_track()
		{
			$this->load->model('Document_Tracker_Model');
			$document_tracker_model = new Document_Tracker_Model();

			$document_id = 171;
			$user_id = 1;
			$action = 'Modified';

			$document_tracker_model->add_action_track($document_id, $user_id, $action);
		}

		public function get_action_track_data() 
		{
			$limit = 10;
			$offset = 0;

			$this->load->model('Document_Tracker_Model');
			$document_tracker_model = new Document_Tracker_Model();

			$result = $document_tracker_model->get_action_tracks($limit, $offset);

			var_dump($result);
		}
	}
?>