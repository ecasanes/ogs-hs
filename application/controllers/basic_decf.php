<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Basic_Decf extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'DECF';
		$this->document_primary = 'document_id';
		$this->form_primary = 'decf_id';

		$main_model_str = 'CaseFile_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$this->no_of_steps = 6;

		$step_titles = array(
			'Create Case File',
			'Build Equipment History (1)',
			'Build Equipment History (2)',
			'Establishing Root Cause',
			'The Solution',
			//'Test Process',
			//'Recommendations',
			'Evaluate the Results'
		);

		$this->step_titles = $step_titles;
	}

	public function index() {
		redirect( 'user/my-account' );
	}

	public function view( $id, $action = '' ) {

		$form_redirect = false;
		$editable = $this->_form_check( $id, $form_redirect );

		# Log -----------------------------------------------------------------------------
		$this->load->model('Document_Tracker_Model');
		$document_tracker_model = new Document_Tracker_Model();

		$user_id = $this->session->userdata('session');
		$action = '<span class="text-success">Viewed</span> Document';
		$document_name = $document_tracker_model->get_name_by_id($id);

		// If the document is not named.
		if($document_name == '')
		{
			$document_name = 'Unnamed Defect Elimination File.';
		}

		$document_tracker_model->add_action_track($user_id, $action.' '.$document_name);
		# end of Log -----------------------------------------------------------------------

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;
		$no_of_steps = $this->no_of_steps;
		$uploads_folder = $this->uploads_folder;

		$header_data = array(
			'title' => 'View Case File',
			'hidden' => ''
		);
		

		$model_data = array();

		$user_id = $this->session->userdata( 'session' );

		$username = $user_model->get_value( $user_id, 'user_name' );
		$email_address = $user_model->get_value( $user_id, 'email_address' );
		$cover_image_filename = $user_model->get_value( $user_id, 'cover_photo' );

		$current_user_id = $user_id;

		$document_details = $main_model->get_document( $id );

		//redirect if no document is found
		if ( count( $document_details ) <1 ) {
			redirect( 'user/my-account' );
		}

		//var_dump($document_details);

		$document_id = $document_details->document_id;

		$owner_details = $main_model->get_owner_details_of_document($document_id);

		//STEP 0
		$owner_username = $owner_details->user_name;
		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$decf_date = $document_details->decf_date;
		$brief_summary = $document_details->brief_summary;
		$asset_type = $document_details->asset_type;
		$justification = $document_details->justification;
		$date_of_issue = $document_details->date_of_issue;

		$system = $document_details->system_id;
		$system_subcategory = $document_details->system_subcategory_id;
		$equipment_category = $document_details->equipment_category_id;
		$equipment_class = $document_details->equipment_class_id;
		$equipment_description = $document_details->equipment_description_id;

		$tag_number = $document_details->tag_number;
		$unique_id = $document_details->unique_id;
		$manufacturer = $document_details->manufacturer;
		$model = $document_details->model;
		$power_output = $document_details->power_output;
		$failed_component = $document_details->failed_component;

		$include_null = true;
		$additional_users = $document_model->get_document_owners( $document_id, null );






		//START EQUIPMENT HISTORY

		$equipment_history_questions = $document_model->get_all_equipment_history_questions_with_answer( $document_id, '1' );
		$equipment_history_categories = $document_model->get_equipment_history_categories('1');

		$equipment_history_questions_array = array();
		$equipment_history_question_array = array();
		$equipment_history_category_answer_ids = array();

		$equipment_history_answer_array = array();


		$counter = 0;



		foreach ( $equipment_history_categories as $category ) {

			$category_id = $category->category_id;

			$equipment_history_questions_array[$counter] = $document_model->get_equipment_history_questions_by_category( $category_id, '1' );

			$counter++;
		}


		foreach ( $equipment_history_questions as $equipment_questions ) {

			$question_id = $equipment_questions->equipment_history_question_id;
			$answer_id = $equipment_questions->equipment_history_answer_id;
			$question_answer = $equipment_questions->answer;
			$answer_start_date = $equipment_questions->start_date;
			$answer_end_date = $equipment_questions->end_date;
			$duration = $equipment_questions->duration;

			if ( $question_answer == 'n/a' ) {
				$question_answer = '';
			}

			$equipment_history_answer_array[$question_id] = $answer_id;
			$equipment_history_question_array[$question_id] = $question_answer;
			$equipment_history_question_details_array[$question_id] = array(
				'start_date' => $answer_start_date,
				'end_date' => $answer_end_date,
				'duration' => $duration
			);

		}

		$equipment_categories = array();

		$model_data['equipment_history_questions'] = $equipment_history_questions_array;
		$model_data['equipment_history_question_array'] = $equipment_history_question_array;
		$model_data['equipment_history_question_details_array'] = $equipment_history_question_details_array;
		$model_data['equipment_history_answer_array'] = $equipment_history_answer_array;
		$model_data['equipment_history_categories'] = $equipment_history_categories;

		//END EQUIPMENT HISTORY







		//STEP 2
		$problem_definition = $document_details->problem_definition;
		$detection_notification = $document_details->notification;
		$notification_date = $document_details->notification_date;
		$notification_description = $document_details->notification_description;
		$notification_details = $document_details->notification_details;
		$failure_mode_notification = $document_details->failure_mode_notification;
		$failure_mode_description = $document_details->failure_mode_description;

		$timelines = $document_model->get_sub_table( $document_id, 'timeline', $document_primary );
		$failure_impacts = $document_model->get_sub_table( $document_id, 'failure_impact', $document_primary );

		//START EQUIPMENT HISTORY

		$equipment_history_questions = $document_model->get_equipment_history_questions_with_answer( $document_id );
		$equipment_history_categories = $document_model->get_equipment_history_categories_with_answer( $document_id );

		$answers = array();

		$counter = 0;
		foreach ( $equipment_history_categories as $category ) {

			$category_id = $category->category_id;

			$answers[$category_id] = $document_model->get_equipment_history_answer_by_category( $document_id, $category_id );

			$counter++;
		}


		$model_data['equipment_history_categories'] = $equipment_history_categories;
		$model_data['answers'] = $answers;



		//END EQUIPMENT HISTORY

		//STEP 3
		$five_why_count = $document_model->five_why_count( $document_id );
		$failure_mechanism = $document_details->failure_mechanism;
		$failure_mechanism_subdivision = $document_details->failure_mechanism_subdivision;
		$definitive_statement = $document_details->definitive_statement;

		$failure_causes = $document_model->get_sub_table( $document_id, 'failure_cause', $document_primary );


		//STEP 4
		$improvement_summary = $document_details->improvement_summary;
		$risks_and_threats = $document_details->risks_and_threats;

		$constraints = $document_model->get_sub_table( $document_id, 'constraints', $document_primary );
		$next_steps = $document_model->get_sub_table( $document_id, 'next_step', $document_primary );

		$type_of_improvements = $main_model->get_sub_table( $document_id, 'type_of_improvement' );
		$benefit_breakdown_items = $main_model->get_sub_table( $document_id, 'benefits_breakdown' );
		$cost_breakdown_items = $main_model->get_sub_table( $document_id, 'cost_breakdown' );
		$maintenance_activity_items = $main_model->get_sub_table( $document_id, 'maintenance_activity' );

		$action_tracker = $document_model->get_sub_table( $document_id, 'action_tracker' );

		$prerequisites = $main_model->get_sub_table( $document_id, 'prerequisite' );
		$dependencies = $main_model->get_sub_table( $document_id, 'dependency' );
		$enablers = $main_model->get_sub_table( $document_id, 'enabler' );

		//STEP 5
		$pass_or_fail = $document_details->pass_or_fail;
		$test_processes = $main_model->get_sub_table( $document_id, 'test_process' );

		//STEP 6
		$evaluate_results_summary = $document_details->evaluate_results;
		$rate_of_success = $main_model->get_sub_table( $document_id, 'rate_of_success' );

		//STEP 7
		$findings = $document_details->findings;
		$share_summary = $document_details->share_summary;
		$detection = $document_details->detection;
		$prevention = $document_details->prevention;
		$recommendations = $document_details->recommendations;








		$model_data['cover_photo'] = $uploads_folder.'/'.$cover_image_filename;


		//STEP 0
		$model_data['owner_username'] = $owner_username;
		$model_data['user_name'] = $username;
		$model_data['current_user_email'] = $email_address;
		$model_data['user_date'] = convert_date_to_string( $decf_date );
		$model_data['name'] = $name;
		$model_data['code'] = $code;


		$model_data['case_summary'] = $brief_summary;
		$model_data['asset_type_value'] = $this->get_menu_detail_value( $asset_type, 'asset_type', 'menu', 'name' );
		$model_data['justification_value'] = $this->get_menu_detail_value( $justification, 'justification', 'menu', 'name' );
		$model_data['date_of_issue'] = convert_date_to_string( $date_of_issue );

		$model_data['system_value'] = $this->get_menu_detail_value( $system, 'system', 'menu', 'name' );
		$model_data['system_subcategory_value'] = $this->get_menu_detail_value( $system_subcategory, 'system', 'subcategory', 'name' );
		$model_data['equipment_category_value'] = $this->get_menu_detail_value( $equipment_category, 'equipment_category', 'menu', 'name' );
		$model_data['equipment_class_value'] = $this->get_menu_detail_value( $equipment_class, 'equipment_category', 'subcategory', 'name' );
		$model_data['equipment_description_value'] = $this->get_menu_detail_value( $equipment_description, 'equipment_category', 'deep_subcategory', 'name' );
		$model_data['equipment_tag_number'] = $tag_number;
		$model_data['equipment_unique_id'] = $unique_id;

		$model_data['equipment_manufacturer'] = $manufacturer;
		$model_data['equipment_code_value'] = $this->get_menu_detail_value( $equipment_description, 'equipment_category', 'deep_subcategory', 'code' );
		$model_data['equipment_model'] = $model;
		$model_data['equipment_power_output'] = $power_output;
		$model_data['equipment_failed_component'] = $failed_component;

		$model_data['additional_users'] = $additional_users;



		//STEP 2
		$model_data['define_problem_summary'] = $problem_definition;
		$model_data['detection_notification_value'] = $this->get_menu_detail_value( $detection_notification, 'method_of_detection_notification', 'menu', 'name' );
		$model_data['detection_date'] = convert_date_to_string( $notification_date, true );
		$model_data['detection_description'] = $this->get_menu_detail_value( $notification_description, 'method_of_detection_notification', 'menu', 'description' );;
		$model_data['detection_details'] = $notification_details;

		$model_data['failure_notification_value'] = $this->get_menu_detail_value( $failure_mode_notification, 'failure_mode', 'menu', 'name' );
		$model_data['failure_description_value'] = $this->get_menu_detail_value( $failure_mode_description, 'failure_mode', 'subcategory', 'name' );
		$model_data['failure_code'] = $this->get_menu_detail_value( $failure_mode_description, 'failure_mode', 'subcategory', 'code' );

		//timeline
		$timeline_array = array();

		$counter = 0;
		foreach ( $timelines as $item ) {

			$event = $item->event;
			$time = $item->time;
			$date = $item->date;
			$status = $item->status;

			$timeline_array[$counter]['event'] = $event;
			$timeline_array[$counter]['time'] = convert_date_to_string( $time, true, true );
			$timeline_array[$counter]['date'] = convert_date_to_string( $date );
			$timeline_array[$counter]['status'] = $this->get_menu_detail_value( $status, 'timeline_status', 'menu', 'name' );

			$counter++;
		}


		//failure impact
		$failure_impacts_array = array();

		$counter = 0;
		foreach ( $failure_impacts as $item ) {

			$area_of_impact_id = $item->area_of_impact_id;
			$consequence_id = $item->consequence_id;
			$area_of_impact_consequnce_id = $item->area_of_impact_consequence_id;

			$failure_impacts_array[$counter]['area_of_impact_value'] = $this->get_menu_detail_value( $area_of_impact_id, 'area_of_impact', 'menu', 'name' );
			$failure_impacts_array[$counter]['consequence_value'] = $this->get_menu_detail_value( $consequence_id, 'consequence', 'menu', 'name' );
			$failure_impacts_array[$counter]['area_of_impact_description'] = $main_model->get_value( $area_of_impact_consequnce_id, 'description', 'area_of_impact_consequence', 'area_of_impact_consequence_id' );

			$counter++;
		}


		$model_data['timelines'] = $timeline_array;
		$model_data['failure_impacts'] = $failure_impacts_array;


		//STEP 3


		//failure cause
		$failure_causes_array = array();

		$counter = 0;
		foreach ( $failure_causes as $item ) {

			$failure_cause_category_id = $item->failure_cause_category_id;
			$failure_cause_subdivision_id = $item->failure_cause_subdivision_id;

			$failure_causes_array[$counter]['failure_cause_value'] = $this->get_menu_detail_value( $failure_cause_category_id, 'failure_cause', 'menu', 'name' );
			$failure_causes_array[$counter]['sub_division_value'] = $this->get_menu_detail_value( $failure_cause_subdivision_id, 'failure_cause', 'subcategory', 'name' );
			$failure_causes_array[$counter]['failure_cause_description'] = $this->get_menu_detail_value( $failure_cause_subdivision_id, 'failure_cause', 'subcategory', 'description' );

			$counter++;
		}

		$model_data['failure_causes'] = $failure_causes_array;
		$model_data['five_why_count'] = $five_why_count;
		$model_data['failure_mechanism_value'] = $this->get_menu_detail_value( $failure_mechanism, 'failure_mechanism', 'menu', 'name' );
		$model_data['failure_mechanism_subdivision_value'] = $this->get_menu_detail_value( $failure_mechanism_subdivision, 'failure_mechanism', 'subcategory', 'name' );
		$model_data['definitive_statement'] = $definitive_statement;

		//STEP 4

		//failure cause
		$type_of_improvements_array = array();

		$counter = 0;
		foreach ( $type_of_improvements as $item ) {

			$type_of_improvement = $item->type_of_improvement;

			$type_of_improvements_array[$counter]['type_of_improvement_value'] = $this->get_menu_detail_value( $type_of_improvement, 'type_of_improvement', 'menu', 'name' );
			$type_of_improvements_array[$counter]['type_of_improvement_description'] = $this->get_menu_detail_value( $type_of_improvement, 'type_of_improvement', 'menu', 'description' );

			$counter++;
		}

		//benefits_breakdown_items
		$benefits_breakdown_array = array();

		$counter = 0;
		foreach ( $benefit_breakdown_items as $item ) {

			$item_id = $item->item_id;
			$description = $item->description;

			$benefits_breakdown_array[$counter]['item_description_value'] = $this->get_menu_detail_value( $item_id, 'benefits_breakdown_item', 'menu', 'name' );
			$benefits_breakdown_array[$counter]['item_description_text'] = $description;

			$counter++;
		}

		//benefits_breakdown_items
		$cost_breakdown_array = array();

		$counter = 0;
		foreach ( $cost_breakdown_items as $item ) {

			$item_id = $item->item_id;
			$description = $item->description;

			$cost_breakdown_array[$counter]['item_description_value'] = $this->get_menu_detail_value( $item_id, 'cost_breakdown_item', 'menu', 'name' );
			$cost_breakdown_array[$counter]['item_description_text'] = $description;

			$counter++;
		}


		//specialist_requirement
		$specialist_requirement_array = array();

		$counter = 0;
		foreach ( $enablers as $item ) {

			$specialist_requirement_id = $item->specialist_requirement_id;
			$description = $item->description;

			$specialist_requirement_array[$counter]['special_requirement_value'] = $this->get_menu_detail_value( $specialist_requirement_id, 'specialist_requirement', 'menu', 'name' );
			$specialist_requirement_array[$counter]['description'] = $description;

			$counter++;
		}


		//maintennace_activities
		$maintenance_activity_array = array();

		$counter = 0;
		foreach ( $maintenance_activity_items as $item ) {

			$activity_id = $item->activity_id;

			$maintenance_activity_array[$counter]['maintenance_activity_value'] = $this->get_menu_detail_value( $activity_id, 'maintenance_activity', 'menu', 'name' );
			$maintenance_activity_array[$counter]['maintenance_activity_description'] = $this->get_menu_detail_value( $activity_id, 'maintenance_activity', 'menu', 'description' );

			$counter++;
		}

		//ACTION TRACKER ARRAY
		$action_tracker_array = array();

		$action_tracker_counter = 0;
		foreach ( $action_tracker as $item ) {

			$full_name = $user_model->get_full_name( $item->owner );

			$action_tracker_array[$action_tracker_counter] = array();
			$action_tracker_array[$action_tracker_counter]['reference'] = $item->reference;
			$action_tracker_array[$action_tracker_counter]['action_process_step'] = $item->action_process_step;
			$action_tracker_array[$action_tracker_counter]['status'] = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'name' );
			$action_tracker_array[$action_tracker_counter]['description'] = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'description' );
			$action_tracker_array[$action_tracker_counter]['owner'] = $item->owner;
			$action_tracker_array[$action_tracker_counter]['full_name'] = $full_name;
			$action_tracker_array[$action_tracker_counter]['due_date'] = $item->due_date;
			$action_tracker_array[$action_tracker_counter]['duration'] = $item->duration;
			$action_tracker_array[$action_tracker_counter]['comments'] = $item->comments;

			$action_tracker_counter++;
		}


		$model_data['type_of_improvements'] = $type_of_improvements_array;
		$model_data['possible_solution_summary'] = $improvement_summary;
		$model_data['benefit_breakdown_items'] = $benefits_breakdown_array;
		$model_data['cost_breakdown_items'] = $cost_breakdown_array;
		$model_data['enablers_prerequisite'] = $prerequisites;
		//$model_data['enablers_dependencies'] = $dependencies;
		$model_data['enablers'] = $specialist_requirement_array;
		$model_data['risks'] = $risks_and_threats;
		$model_data['constraints'] = $constraints;
		$model_data['next_steps'] = $next_steps;
		$model_data['maintenance_activities'] = $maintenance_activity_array;

		$model_data['action_tracker'] = $action_tracker_array;

		//STEP 5
		$model_data['pass_fail'] = $pass_or_fail;
		$model_data['responsible_parties'] = $test_processes;

		//STEP 6

		//rate of success
		$rate_of_success_array = array();

		$counter = 0;
		foreach ( $rate_of_success as $item ) {

			$area_of_impact_id = $item->area_of_impact_id;
			$result_id = $item->result_id;

			$rate_of_success_array[$counter]['area_of_impact_value'] = $this->get_menu_detail_value( $area_of_impact_id, 'area_of_impact', 'menu', 'name' );
			$rate_of_success_array[$counter]['result_value'] = $this->get_menu_detail_value( $result_id, 'rate_of_success_result', 'menu', 'name' );

			$counter++;
		}

		$model_data['evaluate_results_summary'] = $evaluate_results_summary;
		$model_data['rate_of_success'] = $rate_of_success_array;

		//STEP 7
		$model_data['findings'] = $findings;
		$model_data['share_requirements_summary'] = $share_summary;
		$model_data['detection'] = $detection;
		$model_data['prevention'] = $prevention;
		$model_data['recommendations'] = $recommendations;

		//ranking
		$model_data['ranking_title'] = 'Rate this Case File';
		include 'includes/ranking-snippet.php';
		$model_data['editable'] = $editable;

		//files
		/*for ( $i=0;$i<=$no_of_steps;$i++ ) {
			$model_data['files_'.$i] = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $i );
		}*/

		$model_data['no_of_steps'] = $no_of_steps;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;


		$pdf_status = $this->uri->segment(4, null);

		if($pdf_status == "pdf"){

			//$this->load->view( 'layout/header-pdf', $header_data );
			//$this->load->view( 'view/view-basic-decf', $model_data );

			$html_pdf = $this->load->view( 'layout/header-pdf', $header_data, true );
			$html_pdf .= $this->load->view( 'view/view-basic-decf', $model_data, true );

			$pdf_file_path = strtolower($code).".pdf";

			include('includes/pdf-printing-snippet.php');

		}else{

			//$this->load->view( 'layout/header-pdf', $header_data );
			//$this->load->view( 'view/view-basic-decf', $model_data );

			$this->load->view( 'layout/header', $header_data );
			$this->load->view( 'view/view-basic-decf', $model_data );
			if ( $action == 'rank' ) {
				$this->load->view( 'includes/ranking', $model_data );
			}
			$this->load->view( 'layout/footer' );

		}


		
	}



	/* CRUD */
	public function create() {

		$this->create_document();
	}

	public function edit( $id, $step = 1 ) {


		$this->_form_check( $id );

		if ( !is_numeric( $step ) ) {
			redirect( 'user/my-account' );
		}


		switch ( $step ) {
		case 1:
			$this->_edit_casefile( $id, $step );
			break;
		case 2:
			$this->_edit_problem( $id, $step );
			break;
		case 3:
			$this->_edit_equipment_history( $id, $step );
			break;
		case 4:
			$this->_edit_root_cause( $id, $step );
			break;
		case 5:
			$this->_edit_solution( $id, $step );
			break;
		/*case 6:
			$this->_edit_process( $id, $step );
			break;
		case 7:
			$this->_edit_requirements( $id, $step );
			*/
			break;
		case 6:
			$this->_edit_results( $id, $step );
			break;
		default:
			redirect( 'user/my-account' );


		}
	}

	public function save( $id = false, $action = 'update', $save_step = 0 ) {

		$this->_form_check( $id );

		$form_model = $this->main_model;

		if ( !is_numeric( $save_step ) ) {
			redirect( 'user/my-account' );
		}

		switch ( $save_step ) {
		case 1:
			$this->_save_casefile( $id, $action );
			break;
		case 2:
			$this->_save_problem( $id, $action );
			break;
		case 3:
			$this->_save_equipment_history( $id, $action );
			break;
		case 4:
			$this->_save_root_cause( $id, $action );
			break;
		case 5:
			$this->_save_solution( $id, $action );
			break;
		/*case 6:
			$this->_save_process( $id, $action );
			break;
		case 7:
			$this->_save_requirements( $id, $action );
			break;*/
		case 6:
			$this->_save_results( $id, $action );
			break;
		default:
			redirect( 'user/my-account' );
		}
	}

	public function delete( $id ) {

		if ( $this->input->post() ) {
			$id = $this->input->post( 'id' );
			$this->delete_document( $id );
		}else {
			$redirect = true;
			$this->delete_document( $id, $redirect );
		}
	}

	public function duplicate( $id ) {

		$this->duplicate_document( $id );

	}
	/* END CRUD */

	/* SAVE */
	public function _save_casefile( $id, $action ) {

		include 'includes/document-save-init.php';

		$user_date = convert_string_to_date( $user_date );
		$date_of_issue = convert_string_to_date( $date_of_issue );

		if ( $action == 'update' ) {

			//include('includes/upload-snippet.php');
			$update_flag = true;

			if ( !isset( $equipment_description ) ) {
				$equipment_description = null;
			}

			if ( $update_flag ) {

				$main_model->update_step_0( $form_id, $user_date, $case_summary, $asset_type, $justification, $date_of_issue );

				$document_model->update_document_owner( $model_id, $additional_user_id, $current_user_id );

				$document_model->update( $model_id, $name );

				$document_model->update_equipment_profile( $model_id, $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, $equipment_tag_number, $equipment_unique_id, $equipment_manufacturer, $equipment_model, $equipment_power_output, $equipment_failed_component );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}
	}

	public function _save_equipment_history( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$update_flag = true;

			if ( $update_flag ) {

				//var_dump($duration_days);
				//var_dump($duration_no);
				//var_dump($duration_no[29]);

				foreach ( $equipment_history_question_id as $question_id ) {

					$answer = $equipment_history_question[$question_id];
					$answer_id = $equipment_history_answer_id[$question_id];

					

					if(isset($duration_number[$question_id])){

						$duration_no = $duration_number[$question_id];
						$duration_day = $duration_days[$question_id];

						if($duration_no != ''){
							$duration_string = $duration_no.' '.$duration_day;
							$answer = 'yes';
						}else{
							$duration_string = null;
						}
					}else{
						$duration_string = null;
					}

					if(isset($start_date[$question_id])){
						$start_date_answer = $start_date[$question_id];
						$end_date_answer = $end_date[$question_id];
						if($start_date_answer != '' && $end_date_answer != ''){
							$start_date_answer = convert_string_to_date($start_date_answer);
							$end_date_answer = convert_string_to_date($end_date_answer);
							$answer = 'yes';
						}else{
							$start_date_answer = '';
							$end_date_answer = '';
						}
						
					}else{
						$start_date_answer = '';
						$end_date_answer = '';
					}


					

					

					$document_model->update_answer( $model_id, $answer_id, $answer, '', $start_date_answer, $end_date_answer, '', '', $duration_string );

				}

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


			}

		}
	}

	public function _save_problem( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$update_flag = true;

			if ( $update_flag ) {

				//TIME CONVERSION
				//TODO: time conversion
				$new_time_array = array();


				foreach ( $time as $time_value ) {
					$new_time_array[] = convert_string_to_time( $time_value );

				}

				//END TIME CONVERSION


				//DATE CONVERSTION
				$new_date_array = array();
				foreach ( $timeline_date as $results ) {
					$new_date_array[] = convert_string_to_date( $results );
					//var_dump($results);
				}

				$detection_date = convert_string_to_date( $detection_date );

				$main_model->update_step_2( $form_id, $summary, $detection_notification, $detection_date, $detection_details, $failure_notification, $failure_description );

				$document_model->update_failure_impact( $model_id, $area_of_impact, $consequence );
				$document_model->update_timeline( $model_id, $event, $new_time_array, $new_date_array, $status );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


			}

		}
	}

	public function _save_root_cause( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';

			if ( $update_flag ) {

				foreach ( $equipment_history_answer_id as $answer_id ) {

					$single_five_why_answer = $five_why_answer[$answer_id];
					$single_why_1 = $why_1[$answer_id];
					$single_why_2 = $why_2[$answer_id];
					$single_why_3 = $why_3[$answer_id];
					$single_why_4 = $why_4[$answer_id];
					$single_why_5 = $why_5[$answer_id];

					$single_six_why_answer = $six_why_answer[$answer_id];
					$single_six_why_1 = $six_why_1[$answer_id];
					$single_six_why_2 = $six_why_2[$answer_id];
					$single_six_why_3 = $six_why_3[$answer_id];
					$single_six_why_4 = $six_why_4[$answer_id];
					$single_six_why_5 = $six_why_5[$answer_id];
					$single_six_why_6 = $six_why_6[$answer_id];

					$document_model->update_why( $answer_id, $single_why_1, $single_why_2, $single_why_3, $single_why_4, $single_why_5, $single_five_why_answer, $single_six_why_answer, $single_six_why_1, $single_six_why_2, $single_six_why_3, $single_six_why_4, $single_six_why_5, $single_six_why_6 );
				}


				$main_model->update_step_3( $form_id, $failure_mechanism, $failure_mechanism_subdivision, $definitive_statement );

				$document_model->update_failure_cause( $model_id, $failure_cause, $failure_cause_subdivision );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


			}

		}
	}

	public function _save_solution( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';

			$new_time_array = array();

			foreach ( $due_date as $date ) {

				$new_time_array[] = convert_string_to_date( $date );

			}

			if ( $update_flag ) {

				$main_model->update_step_4( $form_id, $summary, "" );

				//$document_model->update_next_steps($model_id, $process_steps, $process_responsible);
				$document_model->update_maintenance_activity( $model_id, $maintenance_activity );
				//$document_model->update_type_of_improvement( $model_id, $type_of_improvement );

				$this->notify_action_tracker_owner( $model_id, $reference, $owner );

				$document_model->update_action_tracker( $model_id, $reference, $action_process_step, $action_tracker_status, $owner, $new_time_array, $comments );
				$document_model->update_constraints( $model_id, $constraints, $mitigating_actions, $action_parties );

				$document_model->update_test_process( $model_id, $event, $responsible );

				foreach($responsible as $single_responsible){
					$this->add_field_storage_item('responsible', $single_responsible);
				}

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


			}

		}
	}

	public function _save_process( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';

			if ( $update_flag ) {

				$main_model->update_step_5( $form_id, $pass_or_fail );

				

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


			}

		}
	}

	public function _save_results( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';

			if ( $update_flag ) {

				$main_model->update_step_6( $form_id, $summary );

				$document_model->update_rate_of_success( $model_id, $area_of_impact, $result );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}
	}

	public function _save_requirements( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';


			if ( $update_flag ) {

				$main_model->update_step_7( $form_id, $findings, $summary, $detection, $prevention, $recommendations );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


			}

		}
	}
	/* END SAVE */

	/* EDIT */
	public function _edit_casefile( $id, $step = 1, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Case File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);


		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		//get asset operation value
		$default_asset_value = $user_model->get_value( $user_id, 'asset_operation', 'user', 'user_id' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;

		$owner_details = $main_model->get_owner_details_of_document($document_id);

		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$decf_date = $document_details->decf_date;
		$brief_summary = $document_details->brief_summary;
		$asset_type = $document_details->asset_type;
		$justification = $document_details->justification;
		$date_of_issue = $document_details->date_of_issue;

		$system = $document_details->system_id;
		$system_subcategory = $document_details->system_subcategory_id;
		$equipment_category = $document_details->equipment_category_id;
		$equipment_class = $document_details->equipment_class_id;
		$equipment_description = $document_details->equipment_description_id;

		$tag_number = $document_details->tag_number;
		$unique_id = $document_details->unique_id;
		$manufacturer = $document_details->manufacturer;
		$model = $document_details->model;
		$power_output = $document_details->power_output;
		$failed_component = $document_details->failed_component;

		$include_null = true;
		$additional_users = $document_model->get_document_owners( $document_id, null );

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);


		include 'includes/document-status-snippet.php';

		$model_data['id'] = $document_id;
		$model_data['user_name'] = $owner_details->user_name;
		$model_data['user_date'] = convert_date_to_string( $decf_date );
		$model_data['name'] = $name;
		$model_data['code'] = $code;
		$model_data['case_summary'] = $brief_summary;
		$model_data['asset_type_dropdown'] = $this->get_dropdown_menu( $asset_type ? $asset_type : $default_asset_value, 'asset_type' );
		$model_data['justification_dropdown'] = $this->get_dropdown_menu( $justification, 'justification' );
		$model_data['date_of_issue'] = convert_date_to_string( $date_of_issue );

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

		$model_data['additional_users'] = $additional_users;

		$model_data['files'] = $files;

		$model_data['user_option'] = '';

		$userdata = $user_model->get_all_records();

		$userdata_array = array();
		$userdata_counter = 0;
		foreach ( $userdata as $result ) {

			$full_name = $result->first_name. ' ' .$result->last_name;

			$userdata_array[$userdata_counter] = array();

			$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';
		}

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$header_data['current_page_name'] = 'Defect Elimination';


		$this->load->view('layout/header', $header_data);
		$this->load->view( 'basic_decf/basic-decf-'.$step, $model_data );
		$this->load->view('layout/footer');
	}

	public function _edit_equipment_history( $id, $step ) {


		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Case File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);


		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$name = $document_details->name;

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);
		$model_data['files'] = $files;



		//START EQUIPMENT HISTORY

		$equipment_history_questions = $document_model->get_all_equipment_history_questions_with_answer( $document_id, '1' );
		$equipment_history_categories = $document_model->get_equipment_history_categories( '1' );

		$equipment_history_questions_array = array();
		$equipment_history_question_array = array();
		$equipment_history_category_answer_ids = array();

		$equipment_history_answer_array = array();


		$counter = 0;



		foreach ( $equipment_history_categories as $category ) {

			$category_id = $category->category_id;

			$equipment_history_questions_array[$counter] = $document_model->get_equipment_history_questions_by_category( $category_id, '1' );

			$counter++;
		}


		foreach ( $equipment_history_questions as $equipment_questions ) {

			/*echo '<pre>';
			var_dump($equipment_questions);
			echo '</pre>';*/

			$question_id = $equipment_questions->equipment_history_question_id;
			$answer_id = $equipment_questions->equipment_history_answer_id;
			$question_answer = $equipment_questions->answer;
			$answer_start_date = $equipment_questions->start_date;
			$answer_end_date = $equipment_questions->end_date;
			$duration = $equipment_questions->duration;

			if ( $question_answer == 'n/a' ) {
				$question_answer = '';
			}

			$equipment_history_answer_array[$question_id] = $answer_id;
			$equipment_history_question_array[$question_id] = $question_answer;
			$equipment_history_question_details_array[$question_id] = array(
				'start_date' => $answer_start_date,
				'end_date' => $answer_end_date,
				'duration' => $duration
			);

		}

		$equipment_categories = array();

		$model_data['equipment_history_questions'] = $equipment_history_questions_array;
		$model_data['equipment_history_question_array'] = $equipment_history_question_array;
		$model_data['equipment_history_question_details_array'] = $equipment_history_question_details_array;
		$model_data['equipment_history_answer_array'] = $equipment_history_answer_array;
		$model_data['equipment_history_categories'] = $equipment_history_categories;

		//END EQUIPMENT HISTORY


		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$header_data['current_page_name'] = 'Level 1 - Defect Elimination';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'basic_decf/basic-decf-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_problem( $id, $step ) {


		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Case File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);


		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$name = $document_details->name;
		$problem_definition = $document_details->problem_definition;
		$detection_notification = $document_details->notification;
		$notification_date = $document_details->notification_date;
		$notification_description = $document_details->notification_description;
		$notification_details = $document_details->notification_details;
		$failure_mode_notification = $document_details->failure_mode_notification;
		$failure_mode_description = $document_details->failure_mode_description;

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);
		$timelines = $document_model->get_sub_table( $document_id, 'timeline', $document_primary );
		$failure_impacts = $document_model->get_sub_table( $document_id, 'failure_impact', $document_primary );

		$model_data['summary'] = $problem_definition;
		$model_data['detection_notification_dropdown'] = $this->get_dropdown_menu( $detection_notification, 'method_of_detection_notification' );
		$model_data['detection_date'] = convert_date_to_string( $notification_date, true );
		$model_data['detection_description'] = $this->get_menu_detail_value( $detection_notification, 'method_of_detection_notification', 'menu', 'description' );;
		$model_data['detection_details'] = $notification_details;

		$model_data['failure_notification'] = $this->get_dropdown_menu( $failure_mode_notification, 'failure_mode' );
		$model_data['failure_description_dropdown'] = $this->get_dropdown_subcategory( $failure_mode_notification, 'failure_mode', $failure_mode_description );
		$model_data['failure_code'] = $this->get_menu_detail_value( $failure_mode_description, 'failure_mode', 'subcategory', 'code' );


		$model_data['files'] = $files;

		//TIMELINE
		$timeline_array = array();

		$time_counter = 0;
		foreach ( $timelines as $time ) {

			$time_date = $time->date;

			$single_time = convert_date_to_string( $time->time, true, true );

			$status = $this->get_dropdown_menu( $time->status, 'timeline_status' );
			$event = $time->event;

			$timeline_array[$time_counter] = array();
			$timeline_array[$time_counter]['timeline_date'] = convert_date_to_string( $time_date, true );

			$timeline_array[$time_counter]['event'] = $event;
			$timeline_array[$time_counter]['timeline_status_dropdown'] = $status;
			$timeline_array[$time_counter]['time'] = $single_time;

			$time_counter++;
		}
		//END TIMELINE





		//FAILURE IMPACT
		$failure_impact_array = array();

		$impact_counter = 0;
		foreach ( $failure_impacts as $impact ) {

			$failure_impact_array[$impact_counter] = array();
			$failure_impact_array[$impact_counter]['area_of_impact'] =
				$this->get_dropdown_menu( $impact->area_of_impact_id, 'area_of_impact' );

			$failure_impact_array[$impact_counter]['consequence'] = $this->get_dropdown_menu( $impact->consequence_id, 'consequence' );
			$failure_impact_array[$impact_counter]['consequence_value'] = $this->get_menu_detail_value( $impact->consequence_id, 'consequence', 'menu', 'color_class' );

			$failure_impact_array[$impact_counter]['area_of_impact_description'] = $main_model->get_value( $impact->area_of_impact_consequence_id, 'description', 'area_of_impact_consequence', 'area_of_impact_consequence_id' );

			$impact_counter++;
		}
		//END FAILURE IMPACT



		$model_data['failure_impacts'] = $failure_impact_array;
		$model_data['timelines'] = $timeline_array;



		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$header_data['current_page_name'] = 'Level 1 - Defect Elimination';


		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'basic_decf/basic-decf-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_root_cause( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Case File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);


		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$name = $document_details->name;
		$failure_mechanism = $document_details->failure_mechanism;
		$failure_mechanism_subdivision = $document_details->failure_mechanism_subdivision;
		$definitive_statement = $document_details->definitive_statement;


		$model_data['failure_mechanism'] = $this->get_dropdown_menu( $failure_mechanism, 'failure_mechanism', 'menu', true, false );
		$model_data['failure_mechanism_subdivision'] = $this->get_dropdown_subcategory( $failure_mechanism, 'failure_mechanism', $failure_mechanism_subdivision );
		$model_data['definitive_statement'] = $definitive_statement;



		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);
		$model_data['files'] = $files;





		//START EQUIPMENT HISTORY

		$equipment_history_questions = $document_model->get_equipment_history_questions_with_answer( $document_id, '1' );
		$equipment_history_categories = $document_model->get_equipment_history_categories_with_answer( $document_id );

		$answers = array();

		$counter = 0;
		foreach ( $equipment_history_categories as $category ) {

			$category_id = $category->category_id;

			$answers[$category_id] = $document_model->get_equipment_history_answer_by_category( $document_id, $category_id );

			$counter++;
		}


		$model_data['equipment_history_categories'] = $equipment_history_categories;
		$model_data['answers'] = $answers;



		//END EQUIPMENT HISTORY






		$failure_causes = $document_model->get_sub_table( $document_id, 'failure_cause', $document_primary );

		//FAILURE CAUSE
		$failure_cause_array = array();

		$failure_cause_counter = 0;
		foreach ( $failure_causes as $item ) {

			$failure_cause_category_id = $item->failure_cause_category_id;
			$failure_cause_subdivision_id = $item->failure_cause_subdivision_id;

			$failure_cause_array[$failure_cause_counter] = array();
			$failure_cause_array[$failure_cause_counter]['failure_cause'] = $this->get_dropdown_menu( $failure_cause_category_id, 'failure_cause' );
			$failure_cause_array[$failure_cause_counter]['sub_division'] = $this->get_dropdown_subcategory( $failure_cause_category_id, 'failure_cause', $failure_cause_subdivision_id );

			$failure_cause_array[$failure_cause_counter]['failure_cause_description'] = $this->get_menu_detail_value( $failure_cause_subdivision_id, 'failure_cause', 'subcategory', 'description' );

			$failure_cause_counter++;
		}
		//END FAILURE CAUSE



		$model_data['failure_causes'] = $failure_cause_array;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$header_data['current_page_name'] = 'Level 1 - Defect Elimination';


		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'basic_decf/basic-decf-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_solution( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Case File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);


		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;

		$name = $document_details->name;
		$failure_mechanism = $document_details->failure_mechanism;
		$failure_mechanism_subdivision = $document_details->failure_mechanism_subdivision;
		$definitive_statement = $document_details->definitive_statement;

		$improvement_summary = $document_details->improvement_summary;
		$risks_and_threats = $document_details->risks_and_threats;

		$model_data['summary'] = $improvement_summary;
		$model_data['risks'] = $risks_and_threats;


		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);
		$equipment_history_questions = $document_model->get_equipment_history_questions( $document_id, '1' );

		$model_data['equipment_history_questions'] = $equipment_history_questions;
		$model_data['files'] = $files;

		$constraints = $document_model->get_sub_table( $document_id, 'constraints', $document_primary );
		//$next_steps = $document_model->get_sub_table($document_id, 'next_step', $document_primary);

		$type_of_improvements = $main_model->get_sub_table( $document_id, 'type_of_improvement' );
		$benefit_breakdown_items = $main_model->get_sub_table( $document_id, 'benefits_breakdown' );
		$cost_breakdown_items = $main_model->get_sub_table( $document_id, 'cost_breakdown' );
		$maintenance_activity_items = $main_model->get_sub_table( $document_id, 'maintenance_activity' );

		$action_tracker = $document_model->get_sub_table( $document_id, 'action_tracker' );
		$ref_code = $this->document_code;

		$prerequisites = $main_model->get_sub_table( $document_id, 'prerequisite' );
		$dependencies = $main_model->get_sub_table( $document_id, 'dependency' );
		$enablers = $main_model->get_sub_table( $document_id, 'enabler' );




		//TYPE OF IMPROVEMENT
		/*$type_of_improvement_array = array();

		$improvement_counter = 0;
		foreach ( $type_of_improvements as $improvement ) {

			$type_of_improvement_array[$improvement_counter] = array();
			$type_of_improvement_array[$improvement_counter]['type_of_improvement'] =
				$this->get_dropdown_menu( $improvement->type_of_improvement, 'type_of_improvement' );

			$type_of_improvement_array[$improvement_counter]['type_of_improvement_description'] = $this->get_menu_detail_value( $improvement->type_of_improvement, 'type_of_improvement', 'menu', 'description' );

			$improvement_counter++;
		}*/
		//END TYPE OF IMPROVEMENT



		//BENEFIT BREAKDOWN
		$benefit_breakdown_items_array = array();

		$benefit_breakdown_items_counter = 0;
		foreach ( $benefit_breakdown_items as $item ) {

			$benefit_breakdown_items_array[$benefit_breakdown_items_counter] = array();
			$benefit_breakdown_items_array[$benefit_breakdown_items_counter]['item_description'] =
				$this->get_dropdown_menu( $item->item_id, 'benefits_breakdown_item' );
			$benefit_breakdown_items_array[$benefit_breakdown_items_counter]['text'] = $item->description;
			$benefit_breakdown_items_counter++;
		}


		//COST BREAKDOWN
		$cost_breakdown_items_array = array();

		$cost_breakdown_items_counter = 0;
		foreach ( $cost_breakdown_items as $item ) {

			$cost_breakdown_items_array[$cost_breakdown_items_counter] = array();
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['item_description'] =
				$this->get_dropdown_menu( $item->item_id, 'cost_breakdown_item' );
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['text'] = $item->description;
			$cost_breakdown_items_counter++;
		}
		//END COST BREAKDOWN


		//ENABLERS
		$enablers_array = array();

		$enablers_counter = 0;
		foreach ( $enablers as $enabler ) {

			$enablers_array[$enablers_counter] = array();
			$enablers_array[$enablers_counter]['special_requirement'] =
				$this->get_dropdown_menu( $enabler->specialist_requirement_id, 'specialist_requirement' );

			$enablers_array[$enablers_counter]['commitment_summary'] = $enabler->description;

			$enablers_counter++;
		}
		//END ENABLERS

		//ACTION TRACKER ARRAY
		$action_tracker_array = array();

		$action_tracker_counter = 0;
		foreach ( $action_tracker as $item ) {

			$full_name = $user_model->get_full_name( $item->owner );

			$action_tracker_array[$action_tracker_counter] = array();
			$action_tracker_array[$action_tracker_counter]['reference'] = $item->reference;
			$action_tracker_array[$action_tracker_counter]['action_process_step'] = $item->action_process_step;
			$action_tracker_array[$action_tracker_counter]['status'] = $this->get_dropdown_menu( $item->status, 'action_tracker_status', 'menu', true, false, '' );
			$action_tracker_array[$action_tracker_counter]['status_color'] = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'color_class' );
			$action_tracker_array[$action_tracker_counter]['description'] = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'description' );
			$action_tracker_array[$action_tracker_counter]['owner'] = $item->owner;
			$action_tracker_array[$action_tracker_counter]['full_name'] = $full_name.'&nbsp;';
			$action_tracker_array[$action_tracker_counter]['due_date'] = $item->due_date;
			$action_tracker_array[$action_tracker_counter]['duration'] = $item->duration;
			$action_tracker_array[$action_tracker_counter]['comments'] = $item->comments;

			$action_tracker_counter++;
		}

		$model_data['user_option'] = '';

		$userdata = $user_model->get_all_records();

		$userdata_array = array();
		$userdata_counter = 0;
		foreach ( $userdata as $result ) {

			$full_name = $result->first_name. ' ' .$result->last_name;

			$userdata_array[$userdata_counter] = array();

			$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';
		}


		//MAINTENANCE ACTIVITY

		$maintenance_activity_array = array();

		$activity_counter = 0;
		foreach ( $maintenance_activity_items as $activity ) {

			$maintenance_activity_array[$activity_counter] = array();
			$maintenance_activity_array[$activity_counter]['maintenance_activity'] =
				$this->get_dropdown_menu( $activity->activity_id, 'maintenance_activity' );

			$maintenance_activity_array[$activity_counter]['maintenance_activity_description'] = $this->get_menu_detail_value( $activity->activity_id, 'maintenance_activity', 'menu', 'description' );

			$activity_counter++;
		}

		//END MAINTENANCE ACTIVITY


		$responsible_parties = $main_model->get_sub_table( $document_id, 'test_process' );

		//START RESPONSIBLE PARTIES
		$responsible_parties_array = array();

		$responsible_parties_counter = 0;
		foreach ( $responsible_parties as $party ) {

			$responsible_parties_array[$responsible_parties_counter] = array();
			$responsible_parties_array[$responsible_parties_counter]['event'] = $party->event;
			$responsible_parties_array[$responsible_parties_counter]['responsible'] = $party->responsible;
			$responsible_parties_array[$responsible_parties_counter]['responsible_dropdown'] = $this->generate_field_dropdown('responsible', $party->responsible);

			$responsible_parties_counter++;
		}
		
		$model_data['responsible_parties'] = $responsible_parties_array;
		//END RESPONSIBLE PARTIES

		//$model_data['type_of_improvements'] = $type_of_improvement_array;
		$model_data['benefit_breakdown_items'] = $benefit_breakdown_items_array;
		$model_data['cost_breakdown_items'] = $cost_breakdown_items_array;
		$model_data['enablers'] = $enablers_array;
		$model_data['maintenance_activities'] = $maintenance_activity_array;

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['action_tracker'] = $action_tracker_array;
		$model_data['files'] = $files;
		$model_data['ref_code'] = $ref_code;

		$model_data['constraints'] = $constraints;
		//$model_data['next_steps'] = $next_steps;
		$model_data['enablers_prerequisite'] = $prerequisites;
		$model_data['enablers_dependencies'] = $dependencies;


		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$header_data['current_page_name'] = 'Level 1 - Defect Elimination';


		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'basic_decf/basic-decf-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_process( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Case File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);


		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;

		$pass_or_fail = $document_details->pass_or_fail;
		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);


		$model_data['model_id'] = $document_id;
		$model_data['pass_or_fail'] = $pass_or_fail;

		$model_data['files'] = $files;






		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$header_data['current_page_name'] = 'Level 1 - Defect Elimination';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'basic_decf/basic-decf-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_results( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Case File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);


		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$summary = $document_details->evaluate_results;

		$rate_of_success = $main_model->get_sub_table( $document_id, 'rate_of_success' );

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);




		// RATE OF SUCCESS
		$rate_of_success_array = array();

		$success_counter = 0;
		foreach ( $rate_of_success as $success ) {

			$rate_of_success_array[$success_counter] = array();
			$rate_of_success_array[$success_counter]['area_of_impact'] = $this->get_dropdown_menu( $success->area_of_impact_id, 'area_of_impact' );

			$rate_of_success_array[$success_counter]['result'] = $this->get_dropdown_menu( $success->result_id, 'rate_of_success_result' );

			//TODO: implement colored dropdown select
			//$rate_of_success_array[$success_counter]['result'] = $this->get_dropdown_menu($success->result_id, 'result');

			$success_counter++;
		}
		// END RATE OF SUCCESS

		$model_data['files'] = $files;
		$model_data['rate_of_success'] = $rate_of_success_array;
		$model_data['summary'] = $summary;


		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$header_data['current_page_name'] = 'Level 1 - Defect Elimination';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'basic_decf/basic-decf-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_requirements( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Case File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);


		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;

		$recommendations = $document_details->recommendations;

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['recommendations'] = $recommendations;

		$model_data['files'] = $files;




		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$header_data['current_page_name'] = 'Level 1 - Defect Elimination';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'basic_decf/basic-decf-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	/* END EDIT */



}

/* End of file basic_decf.php */
/* Location: ./application/controllers/basic_decf.php */
