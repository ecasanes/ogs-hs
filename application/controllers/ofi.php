<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class OFI extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'OFI';
		$this->document_primary = 'document_id';
		$this->form_primary = 'ofi_id';

		$main_model_str = 'OFI_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$this->no_of_steps = 4;

		$step_titles = array(
			'Create Opportunity for Improvement',
			'Opportunity',
			'Risks and Threats',
			'Next Steps'
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
			$document_name = 'Unnamed Oppurtuniy For Improvement File.';
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
			'title' => 'View OFI',
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

		$document_id = $document_details->document_id;

		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$decf_date = $document_details->date;
		$brief_summary = $document_details->brief_summary;
		$asset_type = $document_details->asset_type;
		$justification = $document_details->area_of_focus;
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

		$timelines = $document_model->get_sub_table( $document_id, 'timeline', $document_primary );
		$failure_impacts = $document_model->get_sub_table( $document_id, 'failure_impact', $document_primary );

		$improvement_summary = $document_details->improvement_summary;
		$risks_and_threats = $document_details->risks_and_threats;

		$constraints = $document_model->get_sub_table( $document_id, 'constraints', $document_primary );
		$next_steps = $document_model->get_sub_table( $document_id, 'next_step', $document_primary );

		$action_tracker = $document_model->get_sub_table( $document_id, 'action_tracker' );

		$type_of_improvements = $main_model->get_sub_table( $document_id, 'type_of_improvement' );
		$benefit_breakdown_items = $main_model->get_sub_table( $document_id, 'benefits_breakdown' );
		$cost_breakdown_items = $main_model->get_sub_table( $document_id, 'cost_breakdown' );
		$maintenance_activity_items = $main_model->get_sub_table( $document_id, 'maintenance_activity' );

		$prerequisites = $main_model->get_sub_table( $document_id, 'prerequisite' );
		$dependencies = $main_model->get_sub_table( $document_id, 'dependency' );
		$enablers = $main_model->get_sub_table( $document_id, 'enabler' );


		$model_data['cover_photo'] = $uploads_folder.'/'.$cover_image_filename;


		//STEP 0
		$model_data['user_name'] = $username;
		$model_data['current_user_email'] = $email_address;
		$model_data['user_date'] = convert_date_to_string( $decf_date );
		$model_data['name'] = $name;
		$model_data['code'] = $code;


		$model_data['case_summary'] = $brief_summary;
		$model_data['asset_type_value'] = $this->get_menu_detail_value( $asset_type, 'asset_type', 'menu', 'name' );
		$model_data['justification_value'] = $this->get_menu_detail_value( $justification, 'area_of_focus', 'menu', 'name' );
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

		//timeline
		$timeline_array = array();

		$counter = 0;
		foreach ( $timelines as $item ) {

			$event = $item->event;
			$time = $item->time;
			$date = $item->date;
			$status = $item->status;

			$timeline_array[$counter]['event'] = $event;
			$timeline_array[$counter]['time'] = convert_date_to_string( $time );
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
			$action_tracker_array[$action_tracker_counter]['status_color'] = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'color_class' );
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
		$model_data['enablers_dependencies'] = $dependencies;
		$model_data['enablers'] = $specialist_requirement_array;
		$model_data['risks'] = $risks_and_threats;
		$model_data['constraints'] = $constraints;
		$model_data['next_steps'] = $next_steps;
		$model_data['maintenance_activities'] = $maintenance_activity_array;

		$model_data['action_tracker'] = $action_tracker_array;

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
			//$this->load->view( 'view/view-basic-decf-new', $model_data );

			$html_pdf = $this->load->view( 'layout/header-pdf', $header_data, true );
			$html_pdf .= $this->load->view( 'view/view-ofi-new', $model_data, true );

			$pdf_file_path = strtolower($code).".pdf";

			include('includes/pdf-printing-snippet.php');

		}else{

			$this->load->view( 'layout/header', $header_data );
			$this->load->view( 'view/view-ofi-new', $model_data );
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
			$this->_edit_root_cause( $id, $step );
			break;
		case 4:
			$this->_edit_solution( $id, $step );
			break;
		default:
			redirect( 'user/my-account' );

		}
	}

	public function save( $id = false, $action = 'update', $save_step = 1 ) {

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
			$this->_save_root_cause( $id, $action );
			break;
		case 4:
			$this->_save_solution( $id, $action );
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

	//Save Step 0
	public function _save_casefile( $id, $action ) {

		include 'includes/document-save-init.php';

		$user_date = convert_string_to_date( $user_date );
		$date_of_issue = convert_string_to_date( $date_of_issue );

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';

			if ( $update_flag ) {

				$main_model->update_step_0( $form_id, $user_date, $case_summary, $asset_type, $area_of_focus, $date_of_issue );

				$document_model->update_document_owner( $model_id, $additional_user_id, $current_user_id );

				$document_model->update( $model_id, $name );

				$document_model->update_equipment_profile( $model_id, $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, $equipment_tag_number, $equipment_unique_id, $equipment_manufacturer, $equipment_model, $equipment_power_output, $equipment_failed_component );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}
	}

	//Save Step 1

	public function _save_problem( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';

			if ( $update_flag ) {

				$main_model->update_step_1( $form_id, $summary );

				$document_model->update_cost_breakdown( $model_id, $cost_item, $cost_description );
				$document_model->update_benefits_breakdown( $model_id, $benefit_item, $benefit_description );
				//$document_model->update_maintenance_activity($model_id, $maintenance_activity);
				//$document_model->update_type_of_improvement( $model_id, $type_of_improvement );
				$document_model->update_enablers( $model_id, $specialist_requirement, $commitment_description );
				//$document_model->update_enablers_prerequisite( $model_id, $prerequisite );
				//$document_model->update_enablers_dependencies( $model_id, $dependencies );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


			}

		}
	}
	//Save Step 2

	public function _save_root_cause( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			//$main_model->update_step_2( $form_id, $risks );

			$document_model->update_constraints( $model_id, $constraints, $mitigating_actions, $responsible );

			foreach($responsible as $single_responsible){
				$this->add_field_storage_item('responsible', $single_responsible);
			}

			$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

		}
	}

	//Save Step 3

	public function _save_solution( $id, $action ) {

		include 'includes/document-save-init.php';

		$new_time_array = array();

		foreach ( $due_date as $date ) {

			$new_time_array[] = convert_string_to_date( $date );

		}

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';

			if ( $update_flag ) {

				//$main_model->update_step_3($form_id);

				//$document_model->update_next_steps($model_id, $process_steps, $process_responsible);

				$this->notify_action_tracker_owner( $model_id, $reference, $owner );

				$document_model->update_action_tracker( $model_id, $reference, $action_process_step, $action_tracker_status, $owner, $new_time_array, $comments );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


			}

		}
	}

	/* END SAVE */

	/* EDIT */

	//EDIT STEP 0
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
		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$ofi_date = $document_details->date;

		$brief_summary = $document_details->brief_summary;
		$asset_type = $document_details->asset_type;
		$area_of_focus = $document_details->area_of_focus;
		$date_of_issue = $document_details->date_of_issue;

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
		$failed_component = $document_details->failed_component;

		$include_null = true;
		$additional_users = $document_model->get_document_owners( $document_id, null );

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['id'] = $document_id;
		$model_data['ref_id'] = $ref_id;
		$model_data['code'] = $code;

		$model_data['user_name'] = $username;
		$model_data['user_date'] = convert_date_to_string( $ofi_date );

		$model_data['name'] = $name;
		$model_data['case_summary'] = $brief_summary;
		//$model_data['asset_type_dropdown'] = $this->get_dropdown_menu( $asset_type, 'asset_type' );
		$model_data['asset_type_dropdown'] = $this->get_dropdown_menu( $asset_type ? $asset_type : $default_asset_value, 'asset_type' );
		$model_data['area_of_focus'] = $this->get_dropdown_menu( $area_of_focus, 'area_of_focus' );
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
		$header_data['current_page_name'] = 'Opportunity for Improvement';

		$footer_data['modals'] = array( 'confirm-delete-modal', 'file-manager-modal', 'edit-filename-modal');


		$this->load->view('layout/header', $header_data);
		$this->load->view( 'ofi/ofi-step-1', $model_data );
		$this->load->view('layout/footer',$footer_data);

	}

	//EDIT STEP 1
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
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$ofi_date = $document_details->date;

		$include_null = true;
		$additional_users = $document_model->get_document_owners( $document_id, null );

		////$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);
		//echo $this->db->last_query();

		$type_of_improvements = $main_model->get_sub_table( $document_id, 'type_of_improvement' );
		$improvement_summary = $document_details->improvement_summary;
		$benefit_breakdown_items = $main_model->get_sub_table( $document_id, 'benefits_breakdown' );
		$cost_breakdown_items = $main_model->get_sub_table( $document_id, 'cost_breakdown' );
		$maintenance_activity_items = $main_model->get_sub_table( $document_id, 'maintenance_activity' );


		$prerequisites = $main_model->get_sub_table( $document_id, 'prerequisite' );
		$dependencies = $main_model->get_sub_table( $document_id, 'dependency' );
		$enablers = $main_model->get_sub_table( $document_id, 'enabler' );

		$type_of_improvement_array = array();

		$improvement_counter = 0;
		foreach ( $type_of_improvements as $improvement ) {

			$type_of_improvement_array[$improvement_counter] = array();
			$type_of_improvement_array[$improvement_counter]['type_of_improvement'] =
				$this->get_dropdown_menu( $improvement->type_of_improvement, 'type_of_improvement' );

			$type_of_improvement_array[$improvement_counter]['type_of_improvement_description'] = $this->get_menu_detail_value( $improvement->type_of_improvement, 'type_of_improvement', 'menu', 'description' );

			$improvement_counter++;
		}
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


		$model_data['type_of_improvements'] = $type_of_improvement_array;
		$model_data['summary'] = $improvement_summary;
		$model_data['benefit_breakdown_items'] = $benefit_breakdown_items_array;
		$model_data['cost_breakdown_items'] = $cost_breakdown_items_array;
		$model_data['enablers'] = $enablers_array;
		$model_data['maintenance_activities'] = $maintenance_activity_array;

		$model_data['enablers_prerequisite'] = $prerequisites;
		$model_data['enablers_dependencies'] = $dependencies;

		$model_data['additional_users'] = $additional_users;

		$model_data['files'] = $files;


		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Opportunity for Improvement';
		$footer_data['modals'] = array( 'file-manager-modal', 'edit-filename-modal');

		$this->load->view('layout/header', $header_data);
		$this->load->view( 'ofi/ofi-step-2', $model_data );
		$this->load->view('layout/footer', $footer_data);
	}

	//EDIT STEP 2

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
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$ofi_date = $document_details->date;

		$name = $document_details->name;

		$improvement_summary = $document_details->improvement_summary;
		$risks_and_threats = $document_details->risks_and_threats;

		$model_data['summary'] = $improvement_summary;
		$model_data['risks'] = $risks_and_threats;


		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);
		$equipment_history_questions = $document_model->get_equipment_history_questions( $document_id );

		$model_data['equipment_history_questions'] = $equipment_history_questions;
		$model_data['files'] = $files;

		$constraints = $document_model->get_sub_table( $document_id, 'constraints', $document_primary );

		$constraints_array = array();

		$constraints_counter = 0;
		foreach($constraints as $item){
			$constraints_array[$constraints_counter] = array();
			$constraints_array[$constraints_counter]['constraints'] = $item->constraints;
			$constraints_array[$constraints_counter]['mitigating_action'] = $item->mitigating_action;
			$constraints_array[$constraints_counter]['responsible_dropdown'] = $this->generate_field_dropdown('responsible', $item->action_party);
			$constraints_array[$constraints_counter]['responsible'] = $item->action_party;

			$constraints_counter++;				
		}
		$next_steps = $document_model->get_sub_table( $document_id, 'next_step', $document_primary );

		$model_data['constraints'] = $constraints_array;
		$model_data['next_steps'] = $next_steps;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Opportunity for Improvement';

		$this->load->view('layout/header', $header_data);
		$this->load->view( 'ofi/ofi-step-3', $model_data );
		$this->load->view('layout/footer');



	}

	//EDIT STEP 3

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
		$name = $document_details->name;
		$code = $document_details->code;
		$action_tracker = $document_model->get_sub_table( $document_id, 'action_tracker' );
		$ref_code = $this->document_code;
		$ofi_date = $document_details->date;

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


		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['action_tracker'] = $action_tracker_array;
		$model_data['files'] = $files;
		$model_data['ref_code'] = $ref_code;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Opportunity for Improvement';

		$this->load->view('layout/header', $header_data);
		$this->load->view( 'ofi/ofi-step-4', $model_data );
		$this->load->view('layout/footer');
	}
	/* END EDIT */


}

/* End of file ofi.php */
/* Location: ./application/controllers/ofi.php */
