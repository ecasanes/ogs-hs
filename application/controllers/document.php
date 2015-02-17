<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Document extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'Document_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;
	}

	public function index() {
		redirect( 'user/my_account' );
	}

	public function get_document($document_id){

		$document_model = $this->main_model;
		$user_model = $this->user_model;

		$document_details = $document_model->get_document( $document_id );

		echo json_encode($document_details);
	}

	public function get_document_modal_details($document_id){

		$user_model = $this->user_model;
		$main_model = $this->main_model;

		$document_code = $main_model->get_document_type($document_id);

		switch($document_code){
			case "basic-decf":
				$this->load->model('CaseFile_Model');
				$document_model = new CaseFile_Model;
				break;
			case "technical-bulletin":
				$this->load->model("TB_Model");
				$document_model = new TB_Model;
				break;
			case "ofi":
				$this->load->model("OFI_Model");
				$document_model = new OFI_Model;
				break;
			case "mcdr":
				$this->load->model("MCDR_Model");
				$document_model = new MCDR_Model;
				break;
			case "project-plan":
				$this->load->model("PP_Model");
				$document_model = new PP_Model;
				break;
			case "technical-query":
				$this->load->model("TQ_Model");
				$document_model = new TQ_Model;
				break;
			case "witness-statement":
				$this->load->model("WitnessStatement_Model");
				$document_model = new WitnessStatement_Model;
				break;
		}

		
		$document_details = $document_model->get_document( $document_id );

		$document_code = $document_details->document_code;

		$model_data = array();

		//var_dump($document_details);

		$document_id = $document_details->document_id;
		$document_name = $document_details->name;
		$document_status_id = $document_details->document_status;
		$document_status = $this->get_menu_detail_value($document_status_id, 'document_status', 'menu', 'name');
		$date_created = convert_date_to_string($document_details->date_created);
		$equipment_category_id = $document_details->equipment_category_id;
		$equipment_category = $this->get_menu_detail_value( $equipment_category_id, 'equipment_category', 'menu', 'name' );
		$link = base_url($document_code.'/view/'.$document_id);

		$model_data['document_id'] = $document_id;
		$model_data['document_name'] = $document_name;
		$model_data['document_status'] = $document_status;
		$model_data['author'] = "[TODO]"; //TODO: get_document_author
		$model_data['date_created'] = $date_created;
		$model_data['equipment_category'] = $equipment_category;
		$model_data['link'] = $link;

		switch($document_code){

			case "basic-decf":

				$asset_type_id = $document_details->asset_type;
				$asset_type = $this->get_menu_detail_value( $asset_type_id, 'asset_type', 'menu', 'name' );
				$date_of_issue = convert_date_to_string($document_details->date_of_issue);

				$model_data['date_of_issue'] = $date_of_issue;
				$model_data['asset_type'] = $asset_type;
				
				echo $this->load->view('modal_details/decf-details', $model_data, true);
				break;

			case "technical-bulletin":

				$relevance = $document_details->relevance;
				$summary_of_events = $document_details->summary_of_events;

				$model_data['relevance'] = $relevance;
				$model_data['summary_of_events'] = $summary_of_events;

				echo $this->load->view('modal_details/tb-details', $model_data, true);
				break;

			case "ofi":

				$asset_type_id = $document_details->asset_type;
				$asset_type = $this->get_menu_detail_value( $asset_type_id, 'asset_type', 'menu', 'name' );
				$date_of_issue = convert_date_to_string($document_details->date_of_issue);

				$model_data['date_of_issue'] = $date_of_issue;
				$model_data['asset_type'] = $asset_type;
				
				echo $this->load->view('modal_details/ofi-details', $model_data, true);
				break;

		}

		/*echo '<pre>';
		var_dump($document_details);
		echo '</pre>';*/

	}

	public function load_image(){

		$image = $this->load->view('document/floorplan-test', true);

		echo $image;
	}

	public function test(){

		/*$footer_data['footer_scripts'] = array(
			'plugins/zoom/wheelzoom'
		);*/

		$footer_data['footer_scripts_head'] = array(
			'plugins/jquery/jquery-ui'
		);

		$footer_data['footer_scripts'] = array(
			'plugins/image_notes/jquery.fs.zoetrope.min', 
			'plugins/image_notes/toe.min',
			'plugins/image_notes/jquery.mousewheel.min',
			'plugins/image_notes/imgViewer.min',
			'plugins/image_notes/printThis',
			'plugins/image_notes/imgNotes');

		$footer_data['modals'] = array(
			'add-point-modal'
		);

		$this->load->view('layout/header');
		$this->load->view('document/floorplan-options');
		$this->load->view('layout/footer', $footer_data);
	}

	public function get_floorplan_detail($floorplan_id){

		$this->load->model('Floorplan_Model');
		$floorplan_model = new Floorplan_Model();

		$floorplan_info = $floorplan_model->get_record($floorplan_id);

		$floorplan_positions = $floorplan_model->get_floorplan_positions($floorplan_id);

		$json_data = array(
			'info' => $floorplan_info,
			'positions' => $floorplan_positions
		);

		echo json_encode($json_data);

		/*echo '<pre>';
		var_dump($floorplan_details);
		echo '</pre>';*/
	}

	public function add_floorplan_position(){

		$this->load->model('Floorplan_Model');
		$floorplan_model = new Floorplan_Model();

		$floorplan_id = $this->input->post('floorplan_id');
		$x = $this->input->post('x');
		$y = $this->input->post('y');
		$note = $this->input->post('note');

		$floorplan_id = $floorplan_model->add_floorplan_position($floorplan_id, $x, $y, $note);

		if($floorplan_id){
			echo 'add floorplan success';
		}
	}

	public function remove_floorplan_position(){

		$this->load->model('Floorplan_Model');
		$floorplan_model = new Floorplan_Model();

		$floorplan_id = $this->input->post('floorplan_id');
		$x = $this->input->post('x');
		$y = $this->input->post('y');

		$floorplan_id = $floorplan_model->remove_floorplan_position_by_detail($floorplan_id, $x, $y);

		if($floorplan_id){
			echo 'remove floorplan by detail - success';
		}
	}

	public function search_old() {

		$this->load->library( 'form_validation' );

		$main_model = $this->main_model;

		$this->load->model( 'User_Model' );
		$user_model = new User_Model();

		$current_user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $current_user_id, 'user_name' );

		$header_data = array(
			'hidden' => ''
		);

		$model_data = array();

		$asset_type = '';
		$justification = '';

		$system = '';
		$system_subcategory = '';

		$equipment_category = '';
		$equipment_class = '';
		$equipment_description = '';
		$tag_number = '';
		$unique_id = '';
		$manufacturer = '';
		$model = '';
		$power_output = '';
		$failed_component = '';


		$model_data['asset_type_dropdown'] = $this->get_dropdown_menu( $asset_type, 'asset_type' );
		$model_data['justification_dropdown'] = $this->get_dropdown_menu( $justification, 'justification' );

		$model_data['system_dropdown'] = $this->get_dropdown_menu( $system, 'system' );
		$model_data['system_subcategory_dropdown'] = $this->get_dropdown_subcategory( $system, 'system', $system_subcategory );

		$model_data['equipment_category_dropdown'] = $this->get_dropdown_menu( $equipment_category, 'equipment_category' );
		$model_data['equipment_class_dropdown'] = $this->get_dropdown_subcategory( $equipment_category, 'equipment_category', $equipment_class );
		$model_data['equipment_description_dropdown'] = $this->get_dropdown_deep_subcategory( $equipment_class, 'equipment_category', $equipment_description );
		$model_data['equipment_tag_number'] = $tag_number;
		$model_data['equipment_unique_id'] = $unique_id;

		$model_data['equipment_manufacturer'] = $manufacturer;
		$model_data['equipment_code'] = $this->get_menu_detail_value( $equipment_description, 'equipment_category', 'deep_subcategory', 'code' );
		$model_data['equipment_model'] = $model;
		$model_data['equipment_power_output'] = $power_output;
		$model_data['equipment_failed_component'] = $failed_component;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		/*$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'document/document-search', $model_data );
		$this->load->view( 'includes/footer' );*/

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'document/document-search', $model_data );
		$this->load->view( 'layout/footer' ); //depreciated
	}

	public function get_results_old() { //depreciated


		$data = $this->input->post();
		$controller_uri = $this->controller_uri;

		if ( $data ) {

			$current_user_id = $this->session->userdata( 'session' );

			$main_model = $this->main_model;

			extract( $data, EXTR_SKIP );

			$search = false;

			//check if variable exist
			if ( empty( $system_subcategory ) ) {
				$system_subcategory = '';
			}

			if ( empty( $equipment_class ) ) {
				$equipment_class = '';
			}

			if ( empty( $equipment_description ) ) {
				$equipment_description = '';
			}

			//end check variable exist

			foreach ( $data as $value ) {
				if ( $value == null || $value = '' ) {
					$search = false;
				}else {
					$search = true;
					break;
				}
			}

			if ( !$search ) {
				$this->session->set_flashdata( 'search_need_input', 'Please input at least 1 field to search casefile.' );
				redirect( $controller_uri.'/search' );
			}



			if ( $user_date != null ) {
				$user_date = convert_string_to_date( $user_date );
			}

			if ( $date_of_issue != null ) {
				$date_of_issue = convert_string_to_date( $date_of_issue );
			}



			$results = $main_model->search_document( $user_name, $name, $code, $user_date, $asset_type, $justification, $date_of_issue, $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, $equipment_code, $equipment_tag_number, $equipment_unique_id, $equipment_manufacturer, $equipment_model, $equipment_power_output, $equipment_failed_component );

			$new_form_results = array();

			$new_form_container = array();

			foreach ( $results as $result ) {
				$new_form_container['document_type'] = $result->document_code;

				$new_form_container['id'] = $result->document_id;
				$new_form_container['name'] = $result->name;
				$new_form_container['code'] = $result->code;
				$new_form_container['form_completed'] = $result->document_completed;
				$new_form_container['permitted'] = $main_model->verify_form_permission( $result->code, $result->ref_id, $current_user_id );

				$new_form_results[] = $new_form_container;
			}


			$header_data = array(
				'hidden' => '' );

			$model_data = array(
				'results' => $new_form_results
			);

			$header_data['data'] = $header_data;
			$model_data['data'] = $model_data;

			/*$this->load->view( 'includes/header', $header_data );
			$this->load->view( 'document/document-search-results', $model_data );
			$this->load->view( 'includes/footer' );*/

			$this->load->view( 'layout/header', $header_data );
			$this->load->view( 'document/document-search-results', $model_data );
			$this->load->view( 'layout/footer' );

		}
	}

	public function get_user_document_status($return_type = "json", $limit = 5, $offset = 0) {

		$data = $this->input->post();

		if ( $data ) {

			$user_id = $this->input->post( 'current_user_id' );
			$document_id = $this->input->post( 'document_id' );

			$this->load->model( 'Document_Model' );
			$document_model = new Document_Model();

			$results = $document_model->get_user_document_status( $document_id, $limit, $offset );
			$count = $document_model->count_user_document_status( $document_id );

			$json_array = array();

			foreach ( $results as $result ) {
				$temp_array = array();
				$temp_array['fullname'] = $result->first_name.' '.$result->last_name;
				$temp_array['status'] = $result->status_name;
				$temp_array['date'] = convert_date_to_string( $result->status_date, false, false, "M j, Y - g:i A" );
				$json_array[] = $temp_array;
			}


			switch($return_type){

				case "json":	
					echo json_encode( $json_array );
					break;

				case "array":
					return $json_array;
					break;

				case "table":
					$model_data = array(
						'document_status' => $json_array,
						'count' => $count,
						'current_offset' => $offset
					);
					echo $this->load->view( 'document/document-status-list', $model_data,  true );
					break;
			}
			

		}
	}

	public function get_user_document_status_post() {

		if ( $this->input->post() ) {

			$json_array = array();
			$table_data = array();
			$user_info = array();
			$table_info = array();

			$main_model = $this->main_model;

			$document_id = $this->input->post( 'document_id' );
			$limit = $this->input->post( 'limit' );
			$offset = $this->input->post( 'offset' );



			$results = $main_model->get_user_document_status( $document_id, $limit, $offset );
			$count = $main_model->count_user_document_status( $document_id );

			$table_info['document_id'] = $document_id;
			$table_info['last_query'] = $this->db->last_query();
			$table_info['limit'] = $limit;
			$table_info['offset'] = $offset;
			$table_info['count'] = $count;

			$table_data = array();

			foreach ( $results as $result ) {
				$temp_array = array();
				$temp_array['fullname'] = $result->first_name.' '.$result->last_name;
				$temp_array['status'] = $result->status_name;
				$temp_array['date'] = convert_date_to_string( $result->status_date, false, false, "M j, Y - g:i A" );
				$table_data[] = $temp_array;
			}

			$json_array = array(
				'table_data' => $table_data,
				'user_info' => $user_info,
				'table_info' => $table_info
			);

			echo json_encode( $json_array );

		}

	}


	public function get_action_tracker() {

		$data = $this->input->post();

		if ( $data ) {

			$user_id = $this->input->post( 'current_user_id' );
			$document_id = $this->input->post( 'document_id' );
			$status = $this->input->post( 'status' );
			$reference = $this->input->post( 'reference' );

			if ( $document_id == '' ) {
				$document_id = null;
			}

			if ( $status == '' ) {
				$status = null;
			}

			if ( $reference == '' ) {
				$reference = null;
			}

			$this->load->model( 'Document_Model' );
			$document_model = new Document_Model();

			$this->load->model( 'User_Model' );
			$user_model = new User_Model();

			$results = $document_model->get_action_tracker( $user_id, $document_id, $status, $reference );

			$json_array = array();

			foreach ( $results as $result ) {

				$owner_id = $result->owner;
				$full_name = $user_model->get_full_name( $owner_id );

				$action_tracker_id = $result->action_tracker_id;
				$document_id = $result->document_id;
				$reference = $result->reference;
				$action_process = $result->action_process_step;
				$status_id = $result->status;
				$status = $this->get_menu_detail_value( $status_id, 'action_tracker_status', 'menu', 'color_class' );
				$document_name = $result->name;
				$document_code = $result->code;
				$due_date = convert_date_to_string( $result->due_date );
				$comment = $result->comments;


				$temp_array = array();
				$temp_array['ref_id'] = $reference;
				$temp_array['document_code'] = $document_code;
				$temp_array['document_name'] = $document_name;
				$temp_array['action_process'] = $action_process;
				$temp_array['action_tracker_id'] = $action_tracker_id;
				$temp_array['status_color'] = $status;
				$temp_array['status_id'] = $status_id;
				$temp_array['owner'] = $owner_id;
				$temp_array['due_date'] = $due_date;
				$temp_array['comment'] = $comment;
				$json_array[] = $temp_array;
			}

			echo json_encode( $json_array );

		}
	}

	public function get_hired_equipment_register() {

		$data = $this->input->post();

		if ( $data ) {

			$user_id = $this->input->post( 'current_user_id' );

			$status = $this->input->post( 'status' );

			if ( $status == '' ) {
				$status = null;
			}

			$this->load->model( 'Document_Model' );
			$document_model = new Document_Model();

			$this->load->model( 'User_Model' );
			$user_model = new User_Model();


			$results = $document_model->get_hired_equipment_register( $user_id, $status );

			$json_array = array();

			foreach ( $results as $result ) {

				$owner_id = $result->owner;
				$full_name = $user_model->get_full_name( $owner_id );

				$hired_equipment_register_id = $result->hired_equipment_register_id;
				$po_number = $result->po_number;
				$equipment = $result->equipment;
				$on_hire_to = $result->on_hire_to;
				$quantity = $result->quantity;
				$duration = $result->duration;
				$cost = $result->cost;
				$total = $result->total;
				$status_id = $result->status;
				$status = $this->get_menu_detail_value( $status_id, 'equipment_register_status', 'menu', 'name' );
				$off_hire_due_date = convert_date_to_string( $result->off_hire_due_date );


				$temp_array = array();
				$temp_array['equipment'] = $equipment;
				$temp_array['hired_equipment_register_id'] = $hired_equipment_register_id;
				$temp_array['po_number'] = $po_number;
				$temp_array['on_hire_to'] = $on_hire_to;
				$temp_array['quantity'] = $quantity;
				$temp_array['duration'] = $duration;
				$temp_array['cost'] = $cost;
				$temp_array['total'] = $total;
				$temp_array['status_value'] = $status;
				$temp_array['status_id'] = $status_id;
				$temp_array['owner'] = $owner_id;
				$temp_array['off_hire_due_date'] = $off_hire_due_date;
				$json_array[] = $temp_array;
			}

			echo json_encode( $json_array );

		}
	}

	public function get_weekly_plan() {

		$data = $this->input->post();

		if ( $data ) {

			$json_array = array();
			$table_data = array();
			$table_info = array();
			$user_info = array();

			$user_id = $this->input->post( 'user_id' );
			//$single_user = $this->input->post('single_user'); //true or false

			if ( !isset( $user_id ) ) {
				$user_id = $this->session->userdata( 'session' );
			}

			$user_info['user_id'] = $user_id;

			$this->load->model( 'Document_Model' );
			$document_model = new Document_Model();

			$this->load->model( 'User_Model' );
			$user_model = new User_Model();

			$user_dropdown = $this->get_user_dropdown();
			$status_dropdown = $this->get_dropdown_menu( null, 'weekly_plan_status' );
			$specialist_requirement_dropdown = $this->get_dropdown_menu( null, 'specialist_requirement', 'menu' );
			$category_dropdown = $this->get_dropdown_menu( null, 'equipment_category', 'menu' );

			$table_info['user_dropdown'] = $user_dropdown;
			$table_info['status_dropdown'] = $status_dropdown;
			$table_info['specialist_requirement_dropdown'] = $specialist_requirement_dropdown;
			$table_info['category_dropdown'] = $category_dropdown;

			$results = $document_model->get_weekly_plan( $user_id );

			foreach ( $results as $result ) {

				$owner_id = $result->user_id;
				$full_name = $user_model->get_full_name( $owner_id );

				$weekly_plan_id = $result->weekly_plan_id;
				$work_order = $result->work_order;
				$job_description = $result->job_description;
				$specialist_requirement = $result->specialist_requirement;
				$date = convert_date_to_string( $result->date );
				$comments = $result->comments;
				$status = $result->status_name;
				$status_id = $result->status;

				$category = $result->category;
				$category_value = $this->get_menu_detail_value( $category, 'equipment_category', 'menu', 'name' );


				$temp_array = array();
				$temp_array['weekly_plan_id'] = $weekly_plan_id;
				$temp_array['work_order'] = $work_order;
				$temp_array['job_description'] = $job_description;
				$temp_array['specialist_requirement'] = $this->get_menu_detail_value( $specialist_requirement, 'specialist_requirement', 'menu', 'name' );
				$temp_array['date'] = $date;
				$temp_array['comments'] = $comments;
				$temp_array['status_id'] = $status_id;
				$temp_array['status'] = $status;
				$temp_array['owner'] = $owner_id;
				$temp_array['owner_fullname'] = $full_name;
				$temp_array['specialist_requirement_id'] = $specialist_requirement;
				$temp_array['category'] = $category_value;
				$temp_array['category_id'] = $category;
				$table_data[] = $temp_array;
			}

			$json_array =  array(
				"table_data" => $table_data,
				"table_info" => $table_info,
				"user_info" => $user_info,
			);

			echo json_encode( $json_array );

		}
	}

	public function ajax_get_document_tracks()
	{
		header('Access-Control-Allow-Origin: *');
		
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');

		if( is_numeric( trim($limit) ) && is_numeric( trim($offset) ) )
		{
			$this->load->model('document_tracker_model');
			$document_tracker_model = new Document_Tracker_Model();

			$result = $document_tracker_model->get_action_tracks($limit, $offset);
			unset($result['count']);
			unset($result['actual_count']);
			print( json_encode( $result ) );
		}
		else 
		{
			print( 'No data found.' );
		}
	}

	public function recent_document(){
		$this->is_logged_in();

		$document_model = $this->main_model;

		$header_data = array(
			'hidden' => ''
		);

		// Remake.
		$this->load->model('Document_Tracker_Model');
		$document_tracker_model = new Document_Tracker_Model();

		$document_tracks = $document_tracker_model->get_action_tracks(10);
		$count = $document_tracks['count'];

		unset($document_tracks['count']);

		$model_data = array(
			'recent_document_actions' => $document_tracks,
			'count' => $count
		);

		// JS.

		$footer_data = array(
			'listeners' => array('get_more_document_tracks'),
			'module' => 'module2'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'document/recent-document', $model_data );
		$this->load->view( 'layout/footer_2', $footer_data );
	}

	public function get_document_updates($document_id){

		$document_model = $this->main_model;
		$uploads_folder = $this->uploads_folder;

		$form_redirect = false;
		$editable = $this->_form_check( $document_id, $form_redirect );

		$user_id = $this->session->userdata( 'session' );
		
		$document_details = $document_model->get_document( $document_id );
		$document_creator = $document_model->get_value( $document_id,'user_id', 'document_owner', 'document_id' );

		$document_updates = $document_model->get_document_updates($document_id);

		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;

		$new_document_updates = array();

		foreach($document_updates as $update){

			$document_update_id = $update->document_update_id;
			$title = $update->title;
			$description = $update->description;
			$first_name = $update->first_name;
			$last_name = $update->last_name;

			$user_photo = $update->user_photo;

			$user_photo = base_url( $uploads_folder.'/'.$user_photo );
			$user_photo = image_exist($user_photo, 'circle', 'url');

			$update_date = convert_date_to_string( $update->update_date, false, false, "M j, Y - g:i A" );

			$document_update_comments = $document_model->get_document_update_comments($document_update_id);

			$temp_array = array(
				'document_update_id' => $document_update_id,
				'title' => $title,
				'description' => $description,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'uploads_folder' => $uploads_folder,
				'user_photo' => $user_photo,
				'update_date' => $update_date,
				'document_update_comments' => $document_update_comments
			);

			$new_document_updates[] = $temp_array;

			
		}


		$model_data = array(
				'name' => $name,
				'code' => $code,
				'ref_id' => $ref_id,
				'editable' => $editable,
				'document_updates' => $new_document_updates,
				'document_id' => $document_id
			);

		$data = $this->load->view( 'updates/document-updates', $model_data, true );

		echo $data;
	}

	public function get_document_update_comments($document_update_id){

		$document_model = $this->main_model;
		$uploads_folder = $this->uploads_folder;

		$document_update_comments = $document_model->get_document_update_comments($document_update_id);

		$model_data = array(
				'document_update_comments' => $document_update_comments,
				'uploads_folder' => $uploads_folder
			);

		$data = $this->load->view( 'updates/update-comments', $model_data, true );

		echo $data;
	}

	public function new_document_update_comment(){

		$document_model = $this->main_model;

		$document_update_id = $this->input->post('document_update_id');
		$comment = $this->input->post('comment');

		$user_id = $this->session->userdata( 'session' );

		$document_model->update_document_comment($document_update_id, $comment, $user_id);
	}

	//new search function

	public function search() {

		$this->load->library( 'form_validation' );

		$main_model = $this->main_model;

		$this->load->model( 'User_Model' );
		$user_model = new User_Model();

		$current_user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $current_user_id, 'user_name' );

		$userdata = $user_model->get_all_records(); //get all users
		$doc_type = $main_model->get_document_types(); //get all doc types
		
		$header_data = array(
			'hidden' => ''
		);

		$model_data = array();

		$system = '';
		$system_subcategory = '';

		$equipment_category = '';
		$equipment_class = '';
		$equipment_description = '';
		$tag_number = '';
		$unique_id = '';
		$manufacturer = '';
		$model = '';
		$power_output = '';
		$failed_component = '';

		$model_data['system_dropdown'] = $this->get_dropdown_menu( $system, 'system' );
		$model_data['system_subcategory_dropdown'] = $this->get_dropdown_subcategory( $system, 'system', $system_subcategory );

		$model_data['equipment_category_dropdown'] = $this->get_dropdown_menu( $equipment_category, 'equipment_category' );
		$model_data['equipment_class_dropdown'] = $this->get_dropdown_subcategory( $equipment_category, 'equipment_category', $equipment_class );
		$model_data['equipment_description_dropdown'] = $this->get_dropdown_deep_subcategory( $equipment_class, 'equipment_category', $equipment_description );
		$model_data['equipment_tag_number'] = $tag_number;
		$model_data['equipment_unique_id'] = $unique_id;

		$model_data['equipment_manufacturer'] = $manufacturer;
		$model_data['equipment_code'] = $this->get_menu_detail_value( $equipment_description, 'equipment_category', 'deep_subcategory', 'code' );
		$model_data['equipment_model'] = $model;
		$model_data['equipment_power_output'] = $power_output;
		$model_data['equipment_failed_component'] = $failed_component;

		$model_data['user_option'] = '<option value>  &nbsp;- Select -</option>';
		$model_data['document_type_option'] = '<option value>- Select -</option>';
		$model_data['document_status_dropdown'] = $this->get_dropdown_menu( null, 'document_status' );

		foreach ( $userdata as $result ) {

			$full_name = $result->first_name. ' ' .$result->last_name;

			$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';
		}
		

		foreach ( $doc_type as $result ) {

			$model_data['document_type_option'] .= '<option value="'.$result->document_code.'">'.$result->document_name.'</option>';
		}

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'document/document-search-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function get_results() {


		

		$search_data = $this->session->userdata( 'search_data' );
		$data = $this->input->post();


		if($data){
			$this->session->set_userdata( 'search_data', $data );
		}else{
			$data = $search_data;
		}

		$controller_uri = $this->controller_uri;

		

		if ( $data ) {

			$current_user_id = $this->session->userdata( 'session' );

			$main_model = $this->main_model;

			extract( $data, EXTR_SKIP );

			$search = false;

			//check if variable exist
			$system = isset($system) ? $system: null;
			$system_subcategory = isset($system_subcategory) ? $system_subcategory: null;
			$equipment_category = isset($equipment_category) ? $equipment_category: null;
			$equipment_class = isset($equipment_class) ? $equipment_class: null;
			$equipment_description = isset($equipment_description) ? $equipment_description: null;
			$equipment_code = isset($equipment_code) ? $equipment_code: null;
			$equipment_tag_number = isset($equipment_tag_number) ? $equipment_tag_number: null;
			$equipment_unique_id = isset($equipment_unique_id) ? $equipment_unique_id: null;
			$equipment_manufacturer = isset($equipment_manufacturer) ? $equipment_manufacturer: null;
			$equipment_power_output = isset($equipment_power_output) ? $equipment_power_output: null;
			$equipment_model = isset($equipment_model) ? $equipment_model: null;
			$equipment_failed_component = isset($equipment_failed_component) ? $equipment_failed_component: null;

			//end check variable exist
			//var_dump($data);

			if($start_date != null || $start_date != ''){
				$start_date = convert_string_to_date( $start_date );
			}

			if($end_date != null || $end_date != ''){
				$end_date = convert_string_to_date( $start_date );
			}
			

			foreach ( $data as $value ) {
				if ( $value == null || $value = '' ) {
					$search = false;
				}else {
					$search = true;
					break;
				}
			}

			if ( !$search ) {
				$this->session->set_flashdata( 'search_need_input', 'Please input at least 1 field to search casefile.' );
				redirect( $controller_uri.'/search-new' );
			}

			$results = $main_model->search_document_new($author, $document_name, $document_type, $document_status, $start_date, $end_date, $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, $equipment_code, $equipment_tag_number, $equipment_unique_id, $equipment_manufacturer, $equipment_model, $equipment_power_output, $equipment_failed_component);

			//echo $this->db->last_query();

			$new_form_results = array();

			$new_form_container = array();

			foreach ( $results as $result ) {
				$new_form_container['document_type'] = $result->document_code;

				$new_form_container['id'] = $result->document_id;
				$new_form_container['name'] = $result->name;
				$new_form_container['code'] = $result->code;
				$new_form_container['status'] = $this->get_menu_detail_value( $result->document_status, 'document_status','menu','name');
				$new_form_container['form_completed'] = $result->document_completed;
				$new_form_container['permitted'] = $main_model->verify_form_permission( $result->document_id, $current_user_id );

				$new_form_results[] = $new_form_container;
			}


			$header_data = array(
				'hidden' => '' );

			$model_data = array(
				'results' => $new_form_results
			);

			$header_data['data'] = $header_data;
			$model_data['data'] = $model_data;

			/*$this->load->view( 'includes/header', $header_data );
			$this->load->view( 'document/document-search-results', $model_data );
			$this->load->view( 'includes/footer' );*/
			$footer_data['modals'] = array( 'confirm-delete-modal');

			$this->load->view( 'layout/header', $header_data );
			$this->load->view( 'document/document-search-results-new', $model_data );
			$this->load->view( 'layout/footer' , $footer_data);

		}
	}

	//functions

	public function get_document_selection($select_name = "document_id", $select_class = "form-control select2-dropdown"){

		$document_type = $this->input->post('document_type'); 
		$documents = $this->get_documents_by_type($document_type);

		$model_data = array(
			'documents' => $documents,
			'select_name' => $select_name,
			'select_class' => $select_class
		);

		echo $this->load->view('document/document-selection', $model_data, true);
		//var_dump($documents);
	}

	public function get_documents_by_type($document_type){

		$document_model = $this->main_model;

		$documents = $document_model->get_documents_by_type($document_type);

		return $documents;
	}

	public function create(){

		$document_id = $this->input->post('document_id');
		$document_name = $this->input->post('document_name');
		$document_type = $this->input->post('document_type');
		$document_creation = $this->input->post('document_creation');

		if($document_type == 'project-plan'){
			$start_date = $this->input->post('start_date');
			$duration_no = $this->input->post('duration_no');
			$duration_days = $this->input->post('duration_days');
			$duration = $duration_no . ' ' . $duration_days;

			$this->session->set_userdata('start_date', $start_date);
			$this->session->set_userdata('duration', $duration);
		}

		$this->session->set_userdata('new_document_name', $document_name);

		if($document_creation == 'new'){
			redirect( $document_type.'/create' );
		}else if($document_creation == 'duplicate'){
			redirect( $document_type.'/duplicate/'.$document_id );
		}	
	}

	public function get_document_followers($return_type = "json"){

		$main_model = $this->main_model;

		$user_id = $this->session->userdata('session');

		$results = $main_model->get_document_followers_by_user($user_id);

		$model_data = array(
			'document_followers' => $results
		);

		switch($return_type){
			case "json":
				echo json_encode($results);
				break;

			case "table":
				echo $this->load->view('document/document-followers', $model_data, true);
				break;

			case "array":
				return $results;
				break;

			default:
				echo json_encode($results);
				break;
		}
	}

}

/* End of file document.php */
/* Location: ./application/controllers/document.php */
