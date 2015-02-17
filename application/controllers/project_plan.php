<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Project_Plan extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'PP';
		$this->document_primary = 'document_id';
		$this->form_primary = 'project_plan_id';

		$main_model_str = 'PP_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$user_model = new User_Model();

		$this->no_of_steps = 8;

		$step_titles = array(
			'Develop Project Work Pack',
			'Describe the Opportunity to Improve',
			'About the Solution',
			'Risk Management',
			'Phase Team & Reporting',
			'Specify the Implementation',
			'Schedule of Activities',
			'Quality Control'
		);

		$this->step_titles = $step_titles;
	}

	public function index() {
		redirect( 'user/my-account' );
	}

	public function updates( $id ){

		$form_redirect = false;
		$editable = $this->_form_check( $id, $form_redirect );

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;
		$no_of_steps = $this->no_of_steps;
		$uploads_folder = $this->uploads_folder;

		$header_data = array(
			'title' => 'View Project Plan',
			'hidden' => ''
		);

		

		$user_id = $this->session->userdata( 'session' );

		$username = $user_model->get_value( $user_id, 'user_name' );
		$email_address = $user_model->get_value( $user_id, 'email_address' );
		$cover_image_filename = $user_model->get_value( $user_id, 'cover_photo' );

		$current_user_id = $user_id;

		$document_details = $main_model->get_document( $id );
		$document_creator = $main_model->get_value( $id,'user_id', 'document_owner', 'document_id' );

		//redirect if no document is found
		if ( count( $document_details ) <1 ) {
			redirect( 'user/my-account' );
		}

		$document_id = $document_details->document_id;



		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$author = $document_details->author;


		$model_data = array(
				'name' => $name,
				'code' => $code,
				'ref_id' => $ref_id,
				'author' => $author,
				'editable' => $editable,
				'document_id' => $document_id
			);




		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'updates/document-update-container', $model_data );
		$this->load->view( 'layout/footer' );

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
			$document_name = 'Unnamed Project Plan Document.';
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
			'title' => 'View Project Plan'
		);

		

		$user_id = $this->session->userdata( 'session' );

		$username = $user_model->get_value( $user_id, 'user_name' );
		$email_address = $user_model->get_value( $user_id, 'email_address' );
		$cover_image_filename = $user_model->get_value( $user_id, 'cover_photo' );

		$current_user_id = $user_id;

		$document_details = $main_model->get_document( $id );
		$document_creator = $main_model->get_value( $id,'user_id', 'document_owner', 'document_id' );

		//redirect if no document is found
		if ( count( $document_details ) <1 ) {
			redirect( 'user/my-account' );
		}

		//var_dump($document_details);

		$document_id = $document_details->document_id;

		$owner_details = $main_model->get_owner_details_of_document($document_id);


		$code = $document_details->code; 
		$ref_id = $document_details->ref_id;
		$author = $owner_details->first_name.' '.$owner_details->last_name;

		//step 1
		$project_leader = $document_details->author;
		$date = convert_date_to_string($document_details->project_plan_date, true);
		$project_sponsor = $document_details->person_in_charge;
		$target_start_date = convert_date_to_string($document_details->estimated_start_date, true);
		$project_name = $document_details->name;
		$estimated_project_duration = $document_details->estimated_project_duration;
		$project_condition = $this->get_menu_detail_value( $document_details->project_condition_id, 'project_condition', 'menu', 'name' );
		$justification = $this->get_menu_detail_value( $document_details->justification_id, 'justification', 'menu', 'name' );
		$work_party = $this->get_menu_detail_value( $document_details->work_party_id, 'work_party', 'menu', 'name' );
		$costs = $document_details->cost_breakdown_estimated_total;

		//step 2
		$project_definition = $document_details->about_the_project;
		$purpose = $document_details->purpose;
		$success_criteria = $document_details->success_criteria;
		$first_day_offshore = $document_details->first_day_offshore;
		$last_day_offshore = $document_details->last_day_offshore;

		//step 3
		$benefit_breakdown_items = $main_model->get_sub_table( $document_id, 'benefits_breakdown' );
		$cost_breakdown_items = $main_model->get_sub_table( $document_id, 'cost_breakdown' );


		//BENEFIT BREAKDOWN
		$benefit_breakdown_items_array = array();

		$benefit_breakdown_items_counter = 0;
		foreach ( $benefit_breakdown_items as $item ) {

			$item_id = $item->item_id;

			$benefit_breakdown_items_array[$benefit_breakdown_items_counter] = array();
			$benefit_breakdown_items_array[$benefit_breakdown_items_counter]['item_description'] = $this->get_menu_detail_value( $item_id, 'benefits_breakdown_item', 'menu', 'name' );
			$benefit_breakdown_items_array[$benefit_breakdown_items_counter]['text'] = $item->description;
			$benefit_breakdown_items_counter++;
		}
		//END BENEFIT BREAKDOWN


		//COST BREAKDOWN
		$cost_breakdown_items_array = array();

		$cost_breakdown_items_counter = 0;
		foreach ( $cost_breakdown_items as $item ) {

			$item_id = $item->item_id;

			$cost_breakdown_items_array[$cost_breakdown_items_counter] = array();
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['item_description'] = $this->get_menu_detail_value( $item_id, 'cost_breakdown_item', 'menu', 'name' );
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['text'] = $item->description;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['e_unit_cost'] = $item->estimated_unit_cost;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['e_volume'] = $item->estimated_volume;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['e_subtotal'] = $item->estimated_subtotal;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['a_unit_cost'] = $item->actual_unit_cost;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['a_volume'] = $item->actual_volume;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['a_subtotal'] = $item->actual_subtotal;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['status'] = $this->get_menu_detail_value( $item->status, 'cost_breakdown_status', 'menu', 'name' );
			$cost_breakdown_items_counter++;
		}
		//END COST BREAKDOWN

		//step 4
		$constraints = $document_model->get_sub_table( $document_id, 'constraints', $document_primary );

		//RISK AND THREATS CONSTRAINTS 
		$constraints_array = array();

		$constraints_counter = 0;
		foreach ( $constraints as $item ) {

			$constraints_array[$constraints_counter] = array();
			$constraints_array[$constraints_counter]['constraints_id'] = $item->constraints_id;
			$constraints_array[$constraints_counter]['constraints'] = $item->constraints;
			$constraints_array[$constraints_counter]['mitigating_action'] = $item->mitigating_action;
			$constraints_array[$constraints_counter]['action_party'] = $item->action_party;
			$constraints_array[$constraints_counter]['document_id'] = $item->document_id;
			$constraints_array[$constraints_counter]['due_date_on_status'] = convert_date_to_string($item->due_date_on_status,true);
			$constraints_counter++;

		}
		//END RISK AND THREATS

		//step 8
		$cost_breakdown_actual_total = $document_details->cost_breakdown_actual_total;
		$cost_breakdown_variation = $document_details->cost_breakdown_variation;

		$model_data = array(
			'name' => $project_name,
			'code' => $code,

			'current_user_id' => $current_user_id,
			'document_creator' => $document_creator,
			'user_name' => $username,
			'current_user_email' => $email_address,

			//step 1
			'author' => $author,
			'number' => $code,
			'project_leader' => $project_leader,
			'date' => $date,
			'project_sponsor' => $project_sponsor,
			'project_name' => $project_name,
			'target_start_date' => $target_start_date,
			'project_duration' => $estimated_project_duration,
			'project_condition' => $project_condition,
			'justification_for_change' => $justification,
			'work_party' => $work_party,
			'costs' => $costs,

			'project_definition' => $project_definition,
			'purpose' => $purpose,
			'success_criteria' => $success_criteria,
			'first_day_offshore' => convert_date_to_string($first_day_offshore, true),
			'last_day_offshore' => convert_date_to_string($last_day_offshore, true),

			'benefit_breakdown_items' => $benefit_breakdown_items_array,
			'cost_breakdown_items' => $cost_breakdown_items_array,

			'constraints' => $constraints_array,

			'cost_breakdown_actual_total' => $cost_breakdown_actual_total,
			'cost_breakdown_variation' => $cost_breakdown_variation

		);
		

		$benefits = $document_details->benefits;

		$boundaries = $document_details->boundaries;
		$prerequisites = $main_model->get_sub_table( $document_id, 'prerequisite' );
		$dependencies = $main_model->get_sub_table( $document_id, 'dependency' );
		$enablers = $main_model->get_sub_table( $document_id, 'enabler' );
		$assumptions = $document_details->assumptions;

		$organisations = $document_model->get_sub_table( $document_id, 'organisation' );
		$reporting = $main_model->get_sub_table( $document_id, 'reporting' );
		$meeting = $main_model->get_sub_table( $document_id, 'meeting' );

		$quality_control_summary =  $document_details->quality_control_summary;
		//$test_processes = $main_model->get_sub_table($document_id, 'test_process');
		$process_steps = $main_model->get_sub_table( $document_id, 'process_step' );
		$quality_control_steps = $main_model->get_sub_table( $document_id, 'quality_control_step' );
		$pass_or_fail = $document_details->pass_or_fail;

		$gantt_chart = $document_details->chart;
		$action_tracker = $document_model->get_sub_table( $document_id, 'action_tracker' );

		$action_log = $main_model->get_sub_table( $document_id, 'action_log' );
		$milestone = $main_model->get_sub_table( $document_id, 'milestone' );
		$change_management = $main_model->get_sub_table( $document_id, 'change_management' );
		$lesson_learned = $document_details->lesson_learned;



		//QUALITY CONTROL STEPS
		//quality control step
		$quality_control_array = array();

		$quality_control_counter = 0;
		foreach ( $quality_control_steps as $item ) {
			$quality_control_array[$quality_control_counter] = array();
			$quality_control_array[$quality_control_counter]['quality_control_step_id'] = $item->quality_control_step_id;
			$quality_control_array[$quality_control_counter]['responsible'] = $item->responsible;
			$quality_control_array[$quality_control_counter]['event'] = $this->get_menu_detail_value( $item->event, 'quality_control_step_event', 'menu', 'name' );

			$quality_control_counter++;
		}


		

		//ENABLERS
		$enablers_array = array();

		$enablers_counter = 0;
		foreach ( $enablers as $enabler ) {

			$specialist_requirement_id = $enabler->specialist_requirement_id;

			$enablers_array[$enablers_counter] = array();
			$enablers_array[$enablers_counter]['special_requirement'] = $this->get_menu_detail_value( $specialist_requirement_id, 'specialist_requirement', 'menu', 'name' );

			$enablers_array[$enablers_counter]['commitment_summary'] = $enabler->description;
			$enablers_array[$enablers_counter]['due_date'] = convert_date_to_string($enabler->due_date);
			$enablers_array[$enablers_counter]['responsible'] = $enabler->responsible;

			$enablers_counter++;
		}
		//END ENABLERS



		//ORGANISATION ARRAY
		$organisation_array = array();

		$organisation_counter = 0;
		foreach ( $organisations as $item ) {

			$role_id = $item->role;

			$organisation_array[$organisation_counter] = array();
			$organisation_array[$organisation_counter]['name'] = $item->name;
			$organisation_array[$organisation_counter]['role'] = $this->get_menu_detail_value( $role_id, 'role', 'menu', 'name' );
			$organisation_array[$organisation_counter]['email'] = $item->email;
			$organisation_array[$organisation_counter]['commitment'] = $item->commitment;
			$organisation_array[$organisation_counter]['other'] = $item->other;

			$organisation_counter++;
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
			$action_tracker_array[$action_tracker_counter]['status_color'] = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'color_class' );
			$action_tracker_array[$action_tracker_counter]['owner'] = $item->owner;
			$action_tracker_array[$action_tracker_counter]['full_name'] = $full_name;
			$action_tracker_array[$action_tracker_counter]['due_date'] = convert_date_to_string($item->due_date, true);
			$action_tracker_array[$action_tracker_counter]['duration'] = $item->duration;
			$action_tracker_array[$action_tracker_counter]['comments'] = $item->comments;

			$action_tracker_counter++;
		}

		//REPORTING ARRAY
		$reporting_array = array();

		$reporting_counter = 0;
		foreach ( $reporting as $item ) {

			$frequency_id = $item->frequency_id;
			$format_id = $item->format_id;

			$reporting_array[$reporting_counter] = array();
			$reporting_array[$reporting_counter]['frequency'] = $this->get_menu_detail_value( $frequency_id, 'frequency', 'menu', 'name' );
			$reporting_array[$reporting_counter]['format'] = $this->get_menu_detail_value( $format_id, 'format', 'menu', 'name' );
			$reporting_array[$reporting_counter]['originator'] = $item->originator;
			$reporting_array[$reporting_counter]['receiver'] = $item->receiver;

			$reporting_counter++;
		}
		//END REPORTING ARRAY

		//MEETING ARRAY

		$meeting_array = array();

		$meeting_counter = 0;
		foreach ( $meeting as $item ) {

			$frequency_id = $item->frequency_id;

			$meeting_array[$meeting_counter] = array();
			$meeting_array[$meeting_counter]['frequency'] = $this->get_menu_detail_value( $frequency_id, 'frequency', 'menu', 'name' );
			$meeting_array[$meeting_counter]['location'] = $item->location;
			$meeting_array[$meeting_counter]['attendees'] = $item->attendees;
			$meeting_array[$meeting_counter]['agenda'] = $item->agenda;
			$meeting_counter++;
		}

		//END MEETING ARRAY

		//ACTION LOG ARRAY

		$action_log_array = array();

		$action_counter = 0;
		foreach ( $action_log as $item ) {

			$status_id = $item->status_id;
			$action_id = $item->action;

			$action_log_array[$action_counter] = array();
			$action_log_array[$action_counter]['action'] = $this->get_menu_detail_value( $action_id, 'associated_activities', 'menu', 'name' );
			$action_log_array[$action_counter]['action_party'] = $item->action_party;
			$action_log_array[$action_counter]['due_date'] = convert_date_to_string( $item->due_date );
			$action_log_array[$action_counter]['status'] = $this->get_menu_detail_value( $status_id, 'action_log_status', 'menu', 'name' );
			$action_counter++;
		}

		//MILESTONE ARRAY
		
		$milestone_array = array();

		$milestone_counter = 0;
		foreach ( $milestone as $item ) {

			$milestone_array[$milestone_counter] = array();
			$milestone_array[$milestone_counter]['event'] = $item->event;
			$milestone_array[$milestone_counter]['milestone_date'] = convert_date_to_string( $item->milestone_date );
			$milestone_array[$milestone_counter]['milestone_status'] = $this->get_menu_detail_value( $item->milestone_status, 'milestone_status', 'menu', 'name' );
			$milestone_counter++;
		}

		//CHANGE MANAGEMENT ARRAY
		$change_management_array = array();

		$change_management_counter = 0;
		foreach ( $change_management as $item ) {

			$change_management_array[$change_management_counter] = array();
			$change_management_array[$change_management_counter]['event'] = $item->event;
			$change_management_array[$change_management_counter]['responsible_party'] = $item->responsible_party;
			$change_management_array[$change_management_counter]['change_date'] = convert_date_to_string( $item->due_date );
			$change_management_array[$change_management_counter]['area_of_authority'] = $this->get_menu_detail_value( $item->area_of_authority, 'area_of_authority', 'menu', 'name' );
			$change_management_counter++;
		}

		$model_data['cover_photo'] = $uploads_folder.'/'.$cover_image_filename;


		//STEP 3
		$model_data['plan_description'] = $boundaries;
		$model_data['enablers'] = $enablers_array;
		$model_data['enablers_prerequisite'] = $prerequisites;
		$model_data['enablers_dependencies'] = $dependencies;
		$model_data['assumptions'] = $assumptions;

		//STEP 4
		$model_data['organisations'] = $organisation_array;
		$model_data['reporting'] = $reporting_array;
		$model_data['meetings'] = $meeting_array;

		//STEP 5
		$model_data['expectations'] = $main_model->get_sub_table( $document_id, 'expectation' );
		$deliverables = $main_model->get_sub_table( $document_id, 'deliverable' );

		$counter = 0;

		$deliverable_array = array();

		foreach($deliverables as $item){

			$deliverable_duration = $item->duration;

			if($deliverable_duration != '' || $deliverable_duration != null){
				$duration = explode(' ',$deliverable_duration);
				$deliverable_duration_number = $duration[0];
				$deliverable_duration_days = $duration[1];

				if($deliverable_duration_number == '1'){
					$deliverable_duration_days = rtrim($deliverable_duration_days, "s");
					$deliverable_duration = $deliverable_duration_number.' '.$deliverable_duration_days;
				}
			}

			$deliverable_array[$counter] = array();
			$deliverable_array[$counter]['description'] = $item->description;
			$deliverable_array[$counter]['deliverable_duration'] = $deliverable_duration;
			$deliverable_array[$counter]['due_date'] = convert_date_to_string($item->due_date,true);
			$deliverable_array[$counter]['start_date'] = convert_date_to_string($item->start_date,true);
			$deliverable_array[$counter]['location'] = $item->location;
			$deliverable_array[$counter]['responsible'] = $item->responsible;	

			$counter++;
		}

		//deliverables
		$model_data['deliverables'] = $deliverable_array;
		$model_data['quality_control'] = $quality_control_summary;
		//$model_data['responsible_parties'] = $test_processes;
		$model_data['process_steps'] = $process_steps;
		$model_data['quality_control_steps'] = $quality_control_array;
		$model_data['pass_fail'] = $pass_or_fail;

		//STEP 6
		$model_data['gantt_chart'] = $gantt_chart;
		$model_data['action_tracker'] = $action_tracker_array;

		//STEP 7
		$model_data['action_logs'] = $action_log_array;
		$model_data['milestones'] = $milestone_array;
		$model_data['change_management'] = $change_management_array;
		$model_data['lesson_learned'] = $lesson_learned;

		//ranking
		$model_data['ranking_title'] = 'Rate this Case File';
		include 'includes/ranking-snippet.php';
		$model_data['editable'] = $editable;

		//files
		/*for ( $i=0;$i<=$no_of_steps;$i++ ) {
			$model_data['files_'.$i] = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $i );
		}*/

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		


		$pdf_status = $this->uri->segment(4, null);

		if($pdf_status == "pdf"){

			//$this->load->view( 'layout/header-pdf', $header_data );
			//$this->load->view( 'view/view-basic-decf', $model_data );

			$html_pdf = $this->load->view( 'layout/header-pdf', $header_data, true );
			$html_pdf .= $this->load->view( 'view/view-pp', $model_data, true );

			$pdf_file_path = strtolower($code).".pdf";

			include('includes/pdf-printing-snippet.php');

		}else{

			$this->load->view( 'layout/header', $header_data );
			$this->load->view( 'view/view-pp', $model_data );
			if ( $action == 'rank' ) {
				$this->load->view( 'includes/ranking', $model_data );
			}
			$this->load->view( 'layout/footer' );

		}
	}


	public function duplicate( $id ) {

		$this->duplicate_document( $id );

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
			$this->_edit_pp( $id, $step );
			break;
		case 2:
			$this->_edit_pp_executive_summary( $id, $step );
			break;
		case 3:
			$this->_edit_pp_business_case( $id, $step );
			break;
		case 4:
			$this->_edit_pp_plan_description( $id, $step );
			break;
		case 5:
			$this->_edit_pp_structure( $id, $step );
			break;
		case 6:
			$this->_edit_pp_schedule_of_activities( $id, $step );
			break;
		case 7:
			$this->_edit_pp_work_breakdown_structure( $id, $step );
			break;
		case 8:
			$this->_edit_pp_next_steps( $id, $step );
			break;
		default:
			redirect( 'user/my-account' );
		}
	}

	public function save( $id = false, $action = 'update', $save_step = 1 ) {

		$this->_form_check( $id );

		if ( !is_numeric( $save_step ) ) {
			redirect( 'user/my-account' );
		}

		$form_model = $this->main_model;

		switch ( $save_step ) {
		case 1:
			$this->_save_pp( $id, $action );
			break;
		case 2:
			$this->_save_pp_executive_summary( $id, $action );
			break;
		case 3:
			$this->_save_pp_business_case( $id, $action );
			break;
		case 4:
			$this->_save_pp_plan_description( $id, $action );
			break;
		case 5:
			$this->_save_pp_structure( $id, $action );
			break;
		case 6:
			$this->_save_pp_work_breakdown_structure( $id, $action );
			break;
		case 7:
			$this->_save_pp_schedule_of_activities( $id, $action );
			break;
		case 8:
			$this->_save_pp_next_steps( $id, $action );
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
	/* END CRUD */

	/* SAVE */
	public function _save_pp( $id, $action ) {

		include 'includes/document-save-init.php';

		$date = convert_string_to_date( $date );

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';

			$estimated_start_date = convert_string_to_date($estimated_start_date, false);

			


			if ( $update_flag ) {

				//update specialist due date start

				$estimated_project_duration = $estimated_project_duration_number.' '.$estimated_project_duration_days;

				$old_start_date = $main_model->get_value( $form_id,'estimated_start_date', 'project_plan', 'project_plan_id' );
				$old_duration = $main_model->get_value( $form_id,'estimated_project_duration', 'project_plan', 'project_plan_id' );

				$costs = '';

				$main_model->update_step_0( $form_id, $author, $date, $person_in_charge, $justification, $costs, $estimated_start_date, $project_condition, $work_party, $estimated_project_duration );

				$this->add_field_storage_item('project_leader', $author);
				$this->add_field_storage_item('project_sponsor', $person_in_charge);

				$new_start_date = $main_model->get_value( $form_id,'estimated_start_date', 'project_plan', 'project_plan_id' );
				$new_duration = $main_model->get_value( $form_id,'estimated_project_duration', 'project_plan', 'project_plan_id' );

				$project_end_date = '';

				if($new_duration != null || $new_duration != ''){
					$new_start_date_ref = date('m/d/Y', strtotime("-1 days", strtotime($new_start_date)));
					$new_start_date_ref = convert_date_to_string($new_start_date_ref,true,false,'m/d/Y');

					$project_end_date = date('m/d/Y', strtotime("+".$new_duration, strtotime($new_start_date_ref)));
					$project_end_date = new DateTime($project_end_date);

					//var_dump($project_end_date);
				}
				
				if($old_start_date != null || $old_start_date != '' || $old_start_date != $estimated_start_date){

					$new_start_date = new DateTime($new_start_date);
        			$old_start_date = new DateTime($old_start_date);

        			//var_dump($new_start_date);
        			//update due dates in the steps to reflect the new start date
					$main_model->update_due_date($model_id, $new_start_date, $old_start_date, $project_end_date, 'document_id', 'enabler' , 'enabler_id', 'due_date');
					$main_model->update_due_date($model_id, $new_start_date, $old_start_date, $project_end_date, 'document_id', 'constraints' , 'constraints_id', 'due_date_on_status');
					$main_model->update_due_date($model_id, $new_start_date, $old_start_date, $project_end_date, 'document_id', 'deliverable' , 'deliverable_id', 'due_date');
					$main_model->update_due_date($model_id, $new_start_date, $old_start_date, $project_end_date, 'document_id', 'action_log' , 'action_log_id', 'due_date');
					$main_model->update_due_date($model_id, $new_start_date, $old_start_date, $project_end_date, 'document_id', 'milestone' , 'milestone_id', 'milestone_date');
					$main_model->update_due_date($model_id, $new_start_date, $old_start_date, $project_end_date, 'document_id', 'change_management' , 'change_management_id', 'due_date');
					$main_model->update_due_date($model_id, $new_start_date, $old_start_date, $project_end_date, 'document_id', 'action_tracker' , 'action_tracker_id', 'due_date');
					//$sample = $main_model->update_specialist_due_date($model_id, $new_start_date, $old_start_date);
				}

				//update specialist due date end								

				$document_model->update_document_owner($model_id, $additional_user_id, $current_user_id);

				$document_model->update( $model_id, $name );

				$document_model->update_equipment_profile( $model_id, $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, $equipment_tag_number, $equipment_unique_id, $equipment_manufacturer, $equipment_model, $equipment_power_output, $equipment_failed_component );
				
				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );
			}

		}
	}

	public function _save_pp_executive_summary( $id, $action ) {

		include 'includes/document-save-init.php';

		$estimated_start_date = convert_string_to_date( $estimated_start_date, true );

		//$estimated_project_duration = $estimated_project_duration_number.' '.$estimated_project_duration_days;

		if ( $action == 'update' ) {

			$update_flag = true;


			if ( $update_flag ) {

				$locations = '';

				$first_day_offshore = convert_string_to_date($first_day_offshore, true);

				$last_day_offshore = convert_string_to_date($last_day_offshore, true);

				$main_model->update_step_1( $form_id, $summary, $purpose, $drivers, $success_criteria, $locations, $first_day_offshore, $last_day_offshore ); //remove start date and move to step 0

				//$document_model->update_document_owner($model_id, $additional_user_id, $current_user_id);

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}
	}

	public function _save_pp_business_case( $id, $action ) {

		include 'includes/document-save-init.php';


		if ( $action == 'update' ) {

			$update_flag = true;


			if ( $update_flag ) {

				

				$main_model->update_step_2( $form_id, $benefits );

				$document_model->update_cost_breakdown( $model_id, $cost_item, $cost_description, $c_estimated_unit_cost, $c_estimated_volume, $c_estimated_subtotal, $c_status );

				$document_model->update_document_cost_breakdown( $model_id, $c_estimated_total );

				//$document_model->update_enablers_prerequisite( $model_id, $prerequisite );
				//$document_model->update_enablers_dependencies( $model_id, $dependencies );

				$document_model->update_benefits_breakdown( $model_id, $benefit_item, $benefit_description, $b_unit_cost, $b_volume, $b_subtotal, $b_status );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );



			}

		}
	}

	public function _save_pp_plan_description( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$update_flag = true;

			$new_time_array = array();

			foreach ( $specialist_due_date as $date ) {

				$new_time_array[] = convert_string_to_date( $date, true );

			}


			if ( $update_flag ) {

				$due_date = array();

				foreach($due_date_on_status as $date){
					$due_date[] = convert_string_to_date($date,true);
				}

				$main_model->update_step_3( $form_id, null, $assumptions );

				$document_model->update_constraints( $model_id, $constraints, $mitigating_actions, $action_parties, $due_date );

				foreach($action_parties as $single_party){
					$this->add_field_storage_item('responsible', $single_party);
				}

				$document_model->update_enablers( $model_id, $specialist_requirement, $commitment_description, $responsible, $new_time_array );

				foreach($responsible as $single_responsible){
					$this->add_field_storage_item('responsible', $single_responsible);
				}
				

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}
	}

	public function _save_pp_structure( $id, $action ) {

		include 'includes/document-save-init.php';



		if ( $action == 'update' ) {

			$update_flag = true;

			if ( $update_flag ) {

				$document_model->update_organisation( $model_id, $name, $role, $organisation_role, $mobile, $email, $commitment );

				$document_model->update_reporting( $model_id, $originator, $receiver, $reporting_frequency, $format );

				$document_model->update_meeting( $model_id, $attendees, $agenda, $meeting_frequency, $location );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}
	}

	public function _save_pp_work_breakdown_structure( $id, $action ) {

		include 'includes/document-save-init.php';

		$new_action_log_date_array = array();

		foreach ( $action_log_due_date as $date ) {

			$new_action_log_date_array[] = convert_string_to_date( $date, true );

		}

		$new_start_date_deliverable_array = array();
		$new_end_date_deliverable_array = array();

		//start date deliverable
		foreach ( $start_date_deliverable as $date ) {

			$new_start_date_deliverable_array[] = convert_string_to_date( $date, true );

		}

		//end date deliverable
		foreach ( $end_date_deliverable as $date ) {

			$new_end_date_deliverable_array[] = convert_string_to_date( $date, true );

		}

		if ( $action == 'update' ) {

			$update_flag = true;

			if ( $update_flag ) {

				$main_model->update_step_5( $form_id, $summary, $pass_fail );

				//$document_model->update_expectation( $model_id, $supplier, $input, $process_deliverable, $output, $receiver );

				$document_model->update_deliverable( $model_id, $deliverables_description, $location, $responsible, $new_start_date_deliverable_array, $new_end_date_deliverable_array);

				foreach($responsible as $single_responsible){
					$this->add_field_storage_item('responsible', $single_responsible);
				}
				

				//$document_model->update_test_process($model_id, $event, $responsible);

				$document_model->update_process_step( $model_id, $process_event, $process_responsible );

				$document_model->update_action_log( $model_id, $action_description, $action_party, $new_action_log_date_array, $status );

				


				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}


			

		}
	}

	public function _save_pp_schedule_of_activities( $id, $action ) {

		include 'includes/document-save-init.php';

		$new_time_array = array();

		foreach ( $due_date as $date ) {

			$new_time_array[] = convert_string_to_date( $date );

		}

		if ( $action == 'update' ) {

			$update_flag = true;


			if ( $update_flag ) {

				$document_model->update_action_tracker( $model_id, $reference, $action_process_step, $action_tracker_status, $owner, $new_time_array, $comments, $change_status);

				$this->notify_action_tracker_owner( $model_id, $reference, $owner );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}


	}

	public function _save_pp_next_steps( $id, $action ) {

		include 'includes/document-save-init.php';

		$new_time_array = array();
		$new_milestone_date = array();

		foreach ( $due_date as $date ) {
			$new_time_array[] = convert_string_to_date( $date, true );
		}

		foreach ( $milestone_date as $date ) {
			$new_milestone_date[] = convert_string_to_date( $date, true );
		}

		foreach ( $change_due_date as $date ) {
			$new_change_date[] = convert_string_to_date( $date, true );
		}

		if ( $action == 'update' ) {

			$update_flag = true;


			if ( $update_flag ) {

				$main_model->update_step_7( $form_id, $lesson_learned );

				

				$document_model->update_change_management( $model_id, $change_event, $change_party, $new_change_date, $change_area_of_authority );

				foreach($change_party as $single_party){
					$this->add_field_storage_item('responsible', $single_party);
				}

				$document_model->update_quality_control_step( $model_id, $quality_event, $quality_responsible );

				foreach($quality_responsible as $single_responsible){
					$this->add_field_storage_item('responsible', $single_responsible);
				}

				$document_model->update_milestone( $model_id, $event, $new_milestone_date, $milestone_status );

				$document_model->update_cost_breakdown_total_actual( $model_id, $cost_description, $c_estimated_unit_cost, $c_estimated_volume, $c_estimated_subtotal, $c_actual_unit_cost, $c_actual_volume, $c_actual_subtotal );

				$document_model->update_document_cost_breakdown( $model_id, $c_estimated_total, $c_actual_total, $c_variation );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );



			}

		}
	}
	/* END SAVE */

	/* EDIT */
	public function _edit_pp( $id, $step = 1 ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Project Plan',
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
		$author = $document_details->author; //project leader
		$project_plan_date = convert_date_to_string( $document_details->project_plan_date );
		$person_in_charge = $document_details->person_in_charge;
		$brief_summary = $document_details->brief_summary;
		$justification = $document_details->justification_id;
		$project_condition = $document_details->project_condition_id;
		$work_party = $document_details->work_party_id;
		$costs = $document_details->costs;
		$associated_documents = $document_details->associated_documents;
		$estimated_start_date = $document_details->estimated_start_date;
		$cost_breakdown_estimated_total = $document_details->cost_breakdown_estimated_total;

		include 'includes/document-status-snippet.php';

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
		//$failed_component = $document_details->failed_component;

		$estimated_project_duration = $document_details->estimated_project_duration;

		$project_end_date = '';

		if($estimated_project_duration != '' || $estimated_project_duration != null){
			$duration = explode(' ',$estimated_project_duration);
			$estimated_project_duration_number = $duration[0];
			$estimated_project_duration_days = $duration[1];
		}
		else{
			$estimated_project_duration_number = '';
			$estimated_project_duration_days = '';
		}

		$include_null = true;
		//$additional_users = $document_model->get_document_owners($document_id, null);

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$project_leader_dropdown = $this->generate_field_dropdown('project_leader', $author);
		$project_sponsor_dropdown = $this->generate_field_dropdown('project_sponsor', $person_in_charge);
		$model_data['project_leader_dropdown'] = $project_leader_dropdown;
		$model_data['project_sponsor_dropdown'] = $project_sponsor_dropdown;

		$model_data['id'] = $document_id;
		$model_data['ref_id'] = $ref_id;
		$model_data['code'] = $code;

		$model_data['user_name'] = $username;
		//$model_data['user_date'] = convert_date_to_string($date);

		$model_data['name'] = $name;
		$model_data['author'] = $author;
		$model_data['date'] = $project_plan_date;
		$model_data['person_in_charge'] = $person_in_charge;
		$model_data['brief_summary'] = $brief_summary;
		$model_data['justification_dropdown'] = $this->get_dropdown_menu( $justification, 'justification' );
		$model_data['costs'] = $costs;
		$model_data['associated_documents'] = $associated_documents;
		$model_data['estimated_start_date'] = convert_date_to_string($estimated_start_date, true);
		$model_data['estimated_project_duration_number'] = $estimated_project_duration_number;
		$model_data['estimated_project_duration_days'] = $estimated_project_duration_days;

		$model_data['project_condition_dropdown'] = $this->get_dropdown_menu( $project_condition, 'project_condition');
		$model_data['work_party_dropdown'] = $this->get_dropdown_menu( $work_party, 'work_party' );

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
		//$model_data['equipment_failed_component'] = $failed_component;

		if($cost_breakdown_estimated_total == 0 || $cost_breakdown_estimated_total == ''){
			$model_data['cost_breakdown_estimated_total'] = 'You have not entered any costs yet in Step 3';
		}else{
			$model_data['cost_breakdown_estimated_total'] = $cost_breakdown_estimated_total;
		}
		


		$model_data['files'] = $files;
		
		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Create Project Work Pack';

		$footer_data['modals'] = array('file-manager-modal');

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pp/pp-'.$step.'', $model_data );
		$this->load->view( 'layout/footer', $footer_data );
	}

	public function _edit_pp_executive_summary( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Project Plan',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;

		$about_the_project = $document_details->about_the_project;
		$purpose = $document_details->purpose;
		$drivers = $document_details->drivers;
		$success_criteria = $document_details->success_criteria;
		//$locations = $document_details->locations;
		$estimated_project_duration = $document_details->estimated_project_duration;
		$estimated_start_date = convert_date_to_string( $document_details->estimated_start_date, true );
		$first_day_offshore = $document_details->first_day_offshore;
		$last_day_offshore = $document_details->last_day_offshore;

		if($estimated_project_duration != '' || $estimated_project_duration != null){
			$duration = explode(' ',$estimated_project_duration);
			$estimated_project_duration_number = $duration[0];
			$estimated_project_duration_days = $duration[1];
		}
		else{
			$estimated_project_duration_number = '';
			$estimated_project_duration_days = '';
		}

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['id'] = $document_id;

		$model_data['summary'] = $about_the_project;
		$model_data['purpose'] = $purpose;
		$model_data['drivers'] = $drivers;
		$model_data['success_criteria'] = $success_criteria;
		//$model_data['locations'] = $locations;
		$model_data['estimated_project_duration_number'] = $estimated_project_duration_number;
		$model_data['estimated_project_duration_days'] = $estimated_project_duration_days;
		$model_data['estimated_start_date'] = $estimated_start_date;
		$model_data['first_day_offshore'] = convert_date_to_string($first_day_offshore, true);
		$model_data['last_day_offshore'] = convert_date_to_string($last_day_offshore, true);

		$model_data['files'] = $files;
		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Project Work Pack';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pp/pp-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_pp_business_case( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Project Plan',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;

		$benefits = $document_details->benefits;
		$benefit_breakdown_items = $main_model->get_sub_table( $document_id, 'benefits_breakdown' );
		//$risks = $document_details->risks_and_threats;
		//$cost_breakdown = $document_details->cost_breakdown;
		
		$prerequisites = $main_model->get_sub_table( $document_id, 'prerequisite' );
		$dependencies = $main_model->get_sub_table( $document_id, 'dependency' );

		
		$cost_breakdown_estimated_total = $document_details->cost_breakdown_estimated_total;

		$cost_breakdown_items = $main_model->get_sub_table( $document_id, 'cost_breakdown' );

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		//BENEFIT BREAKDOWN
		$benefit_breakdown_items_array = array();

		$benefit_breakdown_items_counter = 0;
		foreach ( $benefit_breakdown_items as $item ) {

			$benefit_breakdown_items_array[$benefit_breakdown_items_counter] = array();
			$benefit_breakdown_items_array[$benefit_breakdown_items_counter]['item_description'] =
				$this->get_dropdown_menu( $item->item_id, 'benefits_breakdown_item' );
			$benefit_breakdown_items_array[$benefit_breakdown_items_counter]['text'] = $item->description;
			$benefit_breakdown_items_array[$benefit_breakdown_items_counter]['color_value'] = $this->get_menu_detail_value( $item->status, 'benefits_breakdown_status', 'menu', 'color_class' );
			$benefit_breakdown_items_counter++;
		}
		//END BENEFIT BREAKDOWN

		//COST BREAKDOWN
		$cost_breakdown_items_array = array();

		$cost_breakdown_items_counter = 0;
		foreach ( $cost_breakdown_items as $item ) {

			$cost_breakdown_items_array[$cost_breakdown_items_counter] = array();
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['item_description'] =
				$this->get_dropdown_menu( $item->item_id, 'cost_breakdown_item' );
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['text'] = $item->description;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['estimated_unit_cost'] = $item->estimated_unit_cost;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['estimated_volume'] = $item->estimated_volume;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['estimated_subtotal'] = $item->estimated_subtotal;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['status'] = $this->get_dropdown_menu( $item->status, 'cost_breakdown_status' );
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['color_value'] = $this->get_menu_detail_value( $item->status, 'cost_breakdown_status', 'menu', 'color_class' );
			$cost_breakdown_items_counter++;
		}
		//END COST BREAKDOWN


		
		//END CONSTRAINTS


		$model_data['user_option'] = '';

		$userdata = $user_model->get_all_records();

		$userdata_array = array();
		$userdata_counter = 0;
		foreach ( $userdata as $result ) {

			$full_name = $result->first_name. ' ' .$result->last_name;

			$userdata_array[$userdata_counter] = array();

			$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';
		}



		$model_data['id'] = $document_id;

		$model_data['benefits'] = $benefits;
		$model_data['benefit_breakdown_items'] = $benefit_breakdown_items_array;
		//$model_data['risks'] = $risks;
		
		$model_data['estimated_total'] = $cost_breakdown_estimated_total;
		//$model_data['cost_breakdown'] = $cost_breakdown;
		$model_data['cost_breakdown_items'] = $cost_breakdown_items_array;
		$model_data['enablers_prerequisite'] = $prerequisites;
		$model_data['enablers_dependencies'] = $dependencies;

		$model_data['files'] = $files;
		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Project Work Pack';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pp/pp-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_pp_plan_description( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Project Plan',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;

		$boundaries = $document_details->boundaries;
		//$prerequisites = $main_model->get_sub_table( $document_id, 'prerequisite' );
		//$dependencies = $main_model->get_sub_table( $document_id, 'dependency' );
		$constraints = $document_model->get_sub_table( $document_id, 'constraints', $document_primary );
		$enablers = $main_model->get_sub_table( $document_id, 'enabler' );
		$assumptions = $document_details->assumptions;
		$estimated_start_date = $document_details->estimated_start_date;
		$estimated_project_duration = $document_details->estimated_project_duration;

		$project_start_date = convert_date_to_string($estimated_start_date,true,false,'m/d/Y');

		$project_end_date = '';

		if($estimated_project_duration != null || $estimated_project_duration != ''){
			$new_start_date = date('m/d/Y', strtotime("-1 days", strtotime($project_start_date)));
			$new_start_date = convert_date_to_string($new_start_date,true,false,'m/d/Y');

			$project_end_date = date('m/d/Y', strtotime("+".$estimated_project_duration, strtotime($new_start_date)));
		}

		//$responsible_dropdown = $this->generate_field_dropdown('responsible', $author);


		//ENABLERS
		$enablers_array = array();

		$enablers_counter = 0;
		foreach ( $enablers as $enabler ) {

			$enablers_array[$enablers_counter] = array();
			$enablers_array[$enablers_counter]['special_requirement'] =
				$this->get_dropdown_menu( $enabler->specialist_requirement_id, 'specialist_requirement' );
			$enablers_array[$enablers_counter]['due_date'] = convert_date_to_string($enabler->due_date,true);

			$enablers_array[$enablers_counter]['commitment_summary'] = $enabler->description;
			$enablers_array[$enablers_counter]['responsible'] = $enabler->responsible;
			$responsible_dropdown = $this->generate_field_dropdown('responsible', $enabler->responsible);
			$enablers_array[$enablers_counter]['responsible_dropdown'] = $responsible_dropdown;

			$enablers_counter++;
		}
		//END ENABLERS

		//CONSTRAINTS
		$constraints_array = array();

		$constraints_counter = 0;
		foreach ( $constraints as $item ) {

			$due_date = convert_date_to_string($item->due_date_on_status,true);

			$constraints_array[$constraints_counter] = array();
			$constraints_array[$constraints_counter]['constraints_id'] = $item->constraints_id;
			$constraints_array[$constraints_counter]['constraints'] = $item->constraints;
			$constraints_array[$constraints_counter]['mitigating_action'] = $item->mitigating_action;
			$constraints_array[$constraints_counter]['responsible'] = $item->action_party;
			$responsible_dropdown = $this->generate_field_dropdown('responsible', $item->action_party);
			$constraints_array[$constraints_counter]['responsible_dropdown'] = $responsible_dropdown;			
			$constraints_array[$constraints_counter]['document_id'] = $item->document_id;
			$constraints_array[$constraints_counter]['due_date_on_status'] = $due_date;
			$constraints_counter++;

		}


		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['plan_description'] = $boundaries;
		$model_data['enablers'] = $enablers_array;
		/*$model_data['enablers_prerequisite'] = $prerequisites;
		$model_data['enablers_dependencies'] = $dependencies;*/
		$model_data['assumptions'] = $assumptions;
		$model_data['estimated_start_date'] = convert_date_to_string($estimated_start_date, true);
		$model_data['estimated_end_date'] = convert_date_to_string($project_end_date, true);
		$model_data['constraints'] = $constraints_array;


		$model_data['files'] = $files;
		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Project Work Pack';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pp/pp-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_pp_structure( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Project Plan',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$organisations = $document_model->get_sub_table( $document_id, 'organisation' );
		$reporting = $main_model->get_sub_table( $document_id, 'reporting' );
		$meeting = $main_model->get_sub_table( $document_id, 'meeting' );
		$name = $document_details->name;
		

		//ORGANISATION ARRAY
		$organisation_array = array();

		$organisation_counter = 0;
		foreach ( $organisations as $item ) {

			//var_dump($item);
			$organisation_array[$organisation_counter] = array();
			$organisation_array[$organisation_counter]['name'] = $item->name;
			$organisation_array[$organisation_counter]['role'] = $this->get_dropdown_menu( $item->role, 'role' );
			$organisation_array[$organisation_counter]['role_value'] = $this->get_menu_detail_value( $item->role, 'role', 'menu', 'name' );
			$organisation_array[$organisation_counter]['other'] = $item->other;
			$organisation_array[$organisation_counter]['email'] = $item->email;
			$organisation_array[$organisation_counter]['commitment'] = $item->commitment;

			$organisation_counter++;
		}

		//REPORTING ARRAY
		$reporting_array = array();

		$reporting_counter = 0;
		foreach ( $reporting as $item ) {

			$reporting_array[$reporting_counter] = array();
			$reporting_array[$reporting_counter]['frequency'] = $this->get_dropdown_menu( $item->frequency_id, 'frequency' );
			$reporting_array[$reporting_counter]['format'] = $this->get_dropdown_menu( $item->format_id, 'format' );
			$reporting_array[$reporting_counter]['originator'] = $item->originator;
			$reporting_array[$reporting_counter]['receiver'] = $item->receiver;

			$reporting_counter++;
		}
		//END REPORTING ARRAY

		//MEETING ARRAY

		$meeting_array = array();

		$meeting_counter = 0;
		foreach ( $meeting as $item ) {

			$meeting_array[$meeting_counter] = array();
			$meeting_array[$meeting_counter]['frequency'] = $this->get_dropdown_menu( $item->frequency_id, 'frequency' );
			$meeting_array[$meeting_counter]['location'] = $item->location;
			$meeting_array[$meeting_counter]['attendees'] = $item->attendees;
			$meeting_array[$meeting_counter]['agenda'] = $item->agenda;
			$meeting_counter++;
		}

		//END MEETING ARRAY

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['organisations'] = $organisation_array;
		$model_data['reporting'] = $reporting_array;
		$model_data['meetings'] = $meeting_array;

		$model_data['files'] = $files;
		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Project Work Pack';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pp/pp-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_pp_work_breakdown_structure( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Project Plan',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$action_tracker = $document_model->get_sub_table( $document_id, 'action_tracker' );
		$ref_code = $this->document_code;
		$estimated_start_date = $document_details->estimated_start_date;
		$estimated_project_duration = $document_details->estimated_project_duration;

		$project_start_date = convert_date_to_string($estimated_start_date,true,false,'m/d/Y');

		if($estimated_project_duration != null || $estimated_project_duration != ''){
			$new_start_date = date('m/d/Y', strtotime("-1 days", strtotime($project_start_date)));
			$new_start_date = convert_date_to_string($new_start_date,true,false,'m/d/Y');

			$project_end_date = date('m/d/Y', strtotime("+".$estimated_project_duration, strtotime($new_start_date)));
		}




		//ACTION TRACKER ARRAY
		$action_tracker_count = count($action_tracker);

		$action_tracker_array = array();

		$action_tracker_counter = 0;
		foreach ( $action_tracker as $item ) {

			$action_tracker_id = $item->action_tracker_id;
			$full_name = $user_model->get_full_name( $item->owner ) . '&nbsp;';
			$reference = $item->reference;
			$action_process_step = $item->action_process_step;
			$status_id = $item->status;
			$status_dropdown = $this->get_dropdown_menu( $item->status, 'action_tracker_status', 'menu', true, false, ' ' );
			$status_color = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'color_class' );
			$status_description = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'description' );
			$owner = $item->owner;
			$due_date = $item->due_date;
			$duration = $item->duration;
			$comments = $item->comments;


			$action_tracker_array[$action_tracker_counter] = array();
			$action_tracker_array[$action_tracker_counter]['action_tracker_id'] = $action_tracker_id;
			$action_tracker_array[$action_tracker_counter]['reference'] = $reference;
			$action_tracker_array[$action_tracker_counter]['action_process_step'] = $action_process_step;
			$action_tracker_array[$action_tracker_counter]['status_id'] = $status_id;
			$action_tracker_array[$action_tracker_counter]['status'] = $status_dropdown;
			$action_tracker_array[$action_tracker_counter]['status_color'] = $status_color;
			$action_tracker_array[$action_tracker_counter]['description'] = $status_description;
			$action_tracker_array[$action_tracker_counter]['owner'] = $item->owner;
			$action_tracker_array[$action_tracker_counter]['full_name'] = $full_name;
			$action_tracker_array[$action_tracker_counter]['due_date'] = $due_date;
			$action_tracker_array[$action_tracker_counter]['duration'] = $duration;
			$action_tracker_array[$action_tracker_counter]['comments'] = $comments;

			
			if($action_process_step == '' && $status_description == '' && $owner == '' && $comments == ''){
				$action_tracker_change_status = 'new';
				$action_tracker_array[$action_tracker_counter]['change_status'] = $action_tracker_change_status;
			}else{
				$action_tracker_array[$action_tracker_counter]['change_status'] = 'old';
			}
			

			$action_tracker_counter++;
		}

		$model_data['user_option'] = '';
		$model_data['initial_action_tracker_count'] = $action_tracker_count;

		$userdata = $user_model->get_all_records();

		$userdata_array = array();
		$userdata_counter = 0;
		foreach ( $userdata as $result ) {

			$full_name = $result->first_name. ' ' .$result->last_name;

			$userdata_array[$userdata_counter] = array();

			$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';
		}


		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['action_tracker'] = $action_tracker_array;
		$model_data['files'] = $files;
		$model_data['ref_code'] = $ref_code;
		$model_data['estimated_start_date'] = convert_date_to_string($estimated_start_date, true);
		$model_data['estimated_end_date'] = convert_date_to_string($project_end_date, true);
		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Project Work Pack';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pp/pp-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_pp_schedule_of_activities( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Project Plan',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$quality_control_summary =  $document_details->quality_control_summary;
		//$test_processes = $main_model->get_sub_table($document_id, 'test_process');
		$process_step = $main_model->get_sub_table( $document_id, 'process_step' );
		$estimated_start_date = $document_details->estimated_start_date;
		$estimated_project_duration = $document_details->estimated_project_duration;

		$project_start_date = convert_date_to_string($estimated_start_date,true,false,'m/d/Y');

		$project_end_date = '';

		if($estimated_project_duration != null || $estimated_project_duration != ''){
			$new_start_date = date('m/d/Y', strtotime("-1 days", strtotime($project_start_date)));
			$new_start_date = convert_date_to_string($new_start_date,true,false,'m/d/Y');

			$project_end_date = date('m/d/Y', strtotime("+".$estimated_project_duration, strtotime($new_start_date)));
		}

		
		$pass_or_fail = $document_details->pass_or_fail;


		//ASSOCIATED ACTIVITIES
		$action_log = $main_model->get_sub_table( $document_id, 'action_log' );

		$action_log_array = array();

		$action_counter = 0;
		foreach ( $action_log as $item ) {

			$action_log_array[$action_counter] = array();
			$action_log_array[$action_counter]['action'] = $this->get_dropdown_menu( $item->action, 'associated_activities' );
			$action_log_array[$action_counter]['action_party'] = $item->action_party;
			$action_log_array[$action_counter]['due_date'] = convert_date_to_string( $item->due_date,true );
			$action_log_array[$action_counter]['status'] = $this->get_dropdown_menu( $item->status_id, 'action_log_status' );
			$action_counter++;
		}

		$model_data['action_logs'] = $action_log_array;
		//END ASSOCIATED ACTIVITIES



		$deliverables = $main_model->get_sub_table( $document_id, 'deliverable' );

		$deliverable_array = array();

		$counter = 0;

		foreach($deliverables as $item){

			$deliverable_duration = $item->duration;
			$location = $item->location;
			$responsible = $item->responsible;

			if($deliverable_duration != '' || $deliverable_duration != null){
				$duration = explode(' ',$deliverable_duration);
				$deliverable_duration_number = $duration[0];
				$deliverable_duration_days = $duration[1];
			}
			else{
				$deliverable_duration_number = '';
				$deliverable_duration_days = '';
			}

			$deliverable_array[$counter] = array();
			$deliverable_array[$counter]['description'] = $item->description;
			$deliverable_array[$counter]['deliverable_duration_number'] = $deliverable_duration_number;
			$deliverable_array[$counter]['deliverable_duration_days'] = $deliverable_duration_days;
			$deliverable_array[$counter]['start_date'] = convert_date_to_string($item->start_date,true);
			$deliverable_array[$counter]['due_date'] = convert_date_to_string($item->due_date,true);
			$deliverable_array[$counter]['location'] = $location;
			$deliverable_array[$counter]['responsible'] = $responsible;
			$responsible_dropdown = $this->generate_field_dropdown('responsible', $responsible);
			$deliverable_array[$counter]['responsible_dropdown'] = $responsible_dropdown;

			$counter++;
		}
			

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		//$model_data['expectations'] = $main_model->get_sub_table( $document_id, 'expectation' );
		$model_data['deliverables'] = $deliverable_array;
		$model_data['summary'] = $quality_control_summary;
		$model_data['estimated_start_date'] = convert_date_to_string($estimated_start_date, true);
		$model_data['estimated_end_date'] = convert_date_to_string($project_end_date, true);
		//$model_data['responsible_parties'] = $test_processes;
		$model_data['process_step'] = $process_step;

		
		$model_data['pass_fail'] = $pass_or_fail;


		$model_data['files'] = $files;
		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Project Work Pack';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pp/pp-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );


	}

	public function _edit_pp_next_steps( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Project Plan',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		
		$milestone = $main_model->get_sub_table( $document_id, 'milestone' );
		$change_management = $main_model->get_sub_table( $document_id, 'change_management' );
		$lesson_learned = $document_details->lesson_learned;
		$cost_breakdown_items = $main_model->get_sub_table( $document_id, 'cost_breakdown' );

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);
		$cost_breakdown_actual_total = $document_details->cost_breakdown_actual_total;
		$cost_breakdown_variation = $document_details->cost_breakdown_variation;
		$cost_breakdown_estimated_total = $document_details->cost_breakdown_estimated_total;
		$estimated_start_date = $document_details->estimated_start_date;
		$estimated_project_duration = $document_details->estimated_project_duration;

		$project_start_date = convert_date_to_string($estimated_start_date,true,false,'m/d/Y');

		$project_end_date = '';

		if($estimated_project_duration != null || $estimated_project_duration != ''){
			$new_start_date = date('m/d/Y', strtotime("-1 days", strtotime($project_start_date)));
			$new_start_date = convert_date_to_string($new_start_date,true,false,'m/d/Y');

			$project_end_date = date('m/d/Y', strtotime("+".$estimated_project_duration, strtotime($new_start_date)));
		}

		//QUALITY CONTROL STEP
		$quality_control_step = $main_model->get_sub_table( $document_id, 'quality_control_step' );

		$quality_control_array = array();

		$quality_control_counter = 0;
		foreach ( $quality_control_step as $item ) {
			$quality_control_array[$quality_control_counter] = array();
			$quality_control_array[$quality_control_counter]['quality_control_step_id'] = $item->quality_control_step_id;
			$quality_control_array[$quality_control_counter]['responsible'] = $item->responsible;
			$responsible_dropdown = $this->generate_field_dropdown('responsible', $item->responsible);
			$quality_control_array[$quality_control_counter]['responsible_dropdown'] = $responsible_dropdown;
			$quality_control_array[$quality_control_counter]['event'] = $this->get_dropdown_menu( $item->event, 'quality_control_step_event' );

			$quality_control_counter++;
		}

		$model_data['quality_control_step'] = $quality_control_array;



		$milestone_array = array();

		$milestone_counter = 0;
		foreach ( $milestone as $item ) {

			$milestone_array[$milestone_counter] = array();
			$milestone_array[$milestone_counter]['event'] = $item->event;
			$milestone_array[$milestone_counter]['milestone_date'] = convert_date_to_string( $item->milestone_date, true );
			$milestone_array[$milestone_counter]['milestone_status'] = $this->get_dropdown_menu( $item->milestone_status, 'milestone_status' );
			$milestone_counter++;
		}

		$change_management_array = array();

		$change_management_counter = 0;
		foreach ( $change_management as $item ) {

			$change_management_array[$change_management_counter] = array();
			$change_management_array[$change_management_counter]['event'] = $item->event;
			$change_management_array[$change_management_counter]['responsible'] = $item->responsible_party;
			$responsible_dropdown = $this->generate_field_dropdown('responsible', $item->responsible_party);
			$change_management_array[$change_management_counter]['responsible_dropdown'] = $responsible_dropdown;
			//$change_management_array[$change_management_counter]['responsible_party'] = $item->responsible_party;
			$change_management_array[$change_management_counter]['change_date'] = convert_date_to_string( $item->due_date, true );
			$change_management_array[$change_management_counter]['area_of_authority'] = $this->get_dropdown_menu( $item->area_of_authority, 'area_of_authority' );
			$change_management_counter++;
		}

		$cost_breakdown_items_array = array();

		$cost_breakdown_items_counter = 0;
		foreach ( $cost_breakdown_items as $item ) {

			$cost_breakdown_items_array[$cost_breakdown_items_counter] = array();
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['item_description'] =
				$this->get_dropdown_menu( $item->item_id, 'cost_breakdown_item' );
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['text'] = $item->description;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['estimated_unit_cost'] = $item->estimated_unit_cost;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['estimated_volume'] = $item->estimated_volume;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['estimated_subtotal'] = $item->estimated_subtotal;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['actual_unit_cost'] = $item->actual_unit_cost;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['actual_volume'] = $item->actual_volume;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['actual_subtotal'] = $item->actual_subtotal;
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['status'] = $this->get_dropdown_menu( $item->status, 'cost_breakdown_status' );
			$cost_breakdown_items_array[$cost_breakdown_items_counter]['color_value'] = $this->get_menu_detail_value( $item->status, 'cost_breakdown_status', 'menu', 'color_class' );
			$cost_breakdown_items_counter++;
		}


		$model_data['estimated_start_date'] = convert_date_to_string($estimated_start_date, true);
		$model_data['estimated_end_date'] = convert_date_to_string($project_end_date, true);
		$model_data['change_management'] = $change_management_array;
		$model_data['milestones'] = $milestone_array;
		$model_data['lesson_learned'] = $lesson_learned;
		$model_data['cost_breakdown_items'] = $cost_breakdown_items_array;
		$model_data['cost_breakdown_actual_total'] = $cost_breakdown_actual_total;
		$model_data['cost_breakdown_estimated_total'] = $cost_breakdown_estimated_total;
		$model_data['cost_breakdown_variation'] = $cost_breakdown_variation;
		$model_data['files'] = $files;
		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Project Work Pack';

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'pp/pp-'.$step.'', $model_data );
		$this->load->view( 'layout/footer' );
	}
	/* END EDIT */

}

/* End of file project_plan.php */
/* Location: ./application/controllers/project_plan.php */
