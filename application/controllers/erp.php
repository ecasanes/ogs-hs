<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class ERP extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'ERP';
		$this->document_primary = 'document_id';
		$this->form_primary = 'erp_id';

		$main_model_str = 'ERP_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$this->no_of_steps = 5;

		$step_titles = array(
			'Create Equipment Repair File',
			'Status',
			'Message Board',
			'Repair Report',
			'Observations & Recommendations'
		);

		$this->step_titles = $step_titles;
	}

	public function index() {

		$this->load->model( 'ERP_Model' );

		$this->load->model( 'Document_Model' );

		$this->load->model( 'User_Model' );

		$erp_model = new ERP_Model();

		$document_model = new Document_Model();

		$user_model = new User_Model();

		$user_id = $this->session->userdata( 'session' );
		$username = $this->session->userdata( 'session_user' );
		$erp_step = $this->session->userdata( 'erp_step' );


		$user_result = $user_model->get_record( $user_id );

		$header_data = array(
			'hidden' => ''
		);

		$model_data = array();




		$results = $erp_model->get_user_form( $user_id );

		$model_data['results'] = $results;

		$erp_results = $document_model->count_document_per_type( $user_id, 'erp' );

		$model_data['user_id'] = $user_id;
		$model_data['erp_results'] = $erp_results;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;
		$footer_data['modals'] = array('confirm-delete-modal');

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'erp/erp-list-new', $model_data );
		$this->load->view( 'layout/footer', $footer_data );
	}

	public function view( $id, $action = '' ) {

		$form_redirect = false;
		$editable = $this->_form_check( $id, $form_redirect );

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;
		$no_of_steps = $this->no_of_steps;
		$uploads_folder = $this->uploads_folder;

		$header_data = array(
			'title' => 'View ERP',
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

		//STEP 0
		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;

		//to do
		/*$repair_criticality*/
		$responsible_party_roles = $main_model->get_sub_table( $document_id, 'responsible_party' );
		$interested_party_roles = $main_model->get_sub_table( $document_id, 'interested_party' );
		$repair_criticality = $document_details->repair_criticality_id;
		$date_of_raised = $document_details->date_of_raised;
		$criticality_justification = $document_details->criticality_justification_id;
		$date_reqd_on_board = $document_details->date_required_on_board;
		$work_order_number = $document_details->work_order_number;
		$equipment_repair_history = $document_details->equipment_repair_history;
		$asset_type = $document_details->asset_type_id;
		$justification = $document_details->justification_id;
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

		//RESPONSIBLE PARTY
		$responsible_party_role_array = array();

		$responsible_party_role_counter = 0;
		foreach ( $responsible_party_roles as $role ) {

			$responsible_party_role_array[$responsible_party_role_counter] = array();
			$responsible_party_role_array[$responsible_party_role_counter]['role'] = $this->get_menu_detail_value( $role->role_id, 'responsible_party_role', 'menu', 'name' );
			$responsible_party_role_array[$responsible_party_role_counter]['firstname'] = $user_model->get_value( $role->name_id, 'first_name' );
			$responsible_party_role_array[$responsible_party_role_counter]['lastname'] = $user_model->get_value( $role->name_id, 'last_name' );
			$responsible_party_role_array[$responsible_party_role_counter]['user_id'] = $role->name_id;

			$responsible_party_role_counter++;
		}

		//END RESPONSIBLE PARTY

		//INTERESTED PARTY
		$interested_party_role_array = array();

		$interested_party_role_counter = 0;
		foreach ( $interested_party_roles as $role ) {

			$interested_party_role_array[$interested_party_role_counter] = array();
			$interested_party_role_array[$interested_party_role_counter]['role'] = $this->get_menu_detail_value( $role->role_id, 'interested_party_role', 'menu', 'name' );
			$interested_party_role_array[$interested_party_role_counter]['firstname'] = $user_model->get_value( $role->name_id, 'first_name' );
			$interested_party_role_array[$interested_party_role_counter]['lastname'] = $user_model->get_value( $role->name_id, 'last_name' );
			$interested_party_role_array[$interested_party_role_counter]['user_id'] = $role->name_id;

			$interested_party_role_counter++;
		}

		//END INTERESTED PARTY

		//STEP 1
		//TO DO
		/*$asset;
		$status;
		$mode;
		$last_location;
		$next_location;
		$repair_vendor;
		$due_date;
		$receiving_party;*/
		$notes = $document_details->notes;

		//STEP 2
		//TO DO:
		/*$from = ;
		$to = ;
		$cc = ;
		$status =;*/
		$message_board_summary = $document_details->message_board_summary;

		//STEP 3
		$scope = $document_details->scope;
		$test_processes = $main_model->get_sub_table( $document_id, 'test_process' );
		$pass_fail = $document_details->pass_or_fail;
		$equipment_history_questions = $document_model->get_equipment_history_questions( $document_id );

		//STEP 4
		$findings = $document_details->findings;
		$summary = $document_details->summary;
		$recommendations = $document_details->recommendations;

		$model_data['cover_photo'] = $uploads_folder.'/'.$cover_image_filename;

		//STEP 0z
		$model_data['user_name'] = $username;
		$model_data['current_user_email'] = $email_address;
		$model_data['name'] = $name;
		$model_data['code'] = $code;
		$model_data['responsible_party_roles'] = $responsible_party_role_array;
		$model_data['interested_party_roles'] = $interested_party_role_array;
		$model_data['date_of_raised'] = convert_date_to_string( $date_of_raised );
		$model_data['repair_criticality_value'] = $this->get_menu_detail_value( $repair_criticality, 'repair_criticality', 'menu', 'name' );
		$model_data['date_reqd_on_board'] = convert_date_to_string( $date_reqd_on_board );
		$model_data['criticality_justification_value'] = $this->get_menu_detail_value( $criticality_justification, 'criticality_justification', 'menu', 'name' );
		$model_data['work_order_number'] = $work_order_number;
		$model_data['equipment_repair_history'] = $equipment_repair_history;
		$model_data['asset_type_value'] = $this->get_menu_detail_value( $asset_type, 'asset_type', 'menu', 'name' );
		$model_data['justification_value'] = $this->get_menu_detail_value( $justification, 'justification', 'menu', 'name' );
		$model_data['date_of_issue'] = convert_date_to_string( $date_of_issue );

		//$model_data['repair_criticality'] = $repair_criticality;

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

		//STEP 1
		//TO DO:
		/*$model_data['asset'];
		$model_data['status'];
		$model_data['mode'];
		$model_data['last_location'];
		$model_data['next_location'];
		$model_data['repair_vendor'];
		$model_data['due_date'];
		$model_data['receiving_party'];*/
		$model_data['notes'] = $notes;

		//STEP 2
		//TO DO:
		/*$model_data['from'] = ;
		$model_data['to'] = ;
		$model_data['cc'] = ;
		$model_data['status'] = ;*/
		$model_data['message_board_summary'] = $message_board_summary;

		//STEP 3
		$model_data['scope'] = $scope;
		$model_data['deliverables'] = $main_model->get_sub_table( $document_id, 'deliverable' );
		$model_data['responsible_parties'] = $test_processes;
		$model_data['pass_fail'] = $pass_fail;
		$model_data['equipment_history_questions'] = $equipment_history_questions;

		//STEP 4
		$model_data['findings'] = $findings;
		$model_data['summary'] = $summary;
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

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'view/view-erp-new', $model_data );
		if ( $action == 'rank' ) {
			$this->load->view( 'includes/ranking', $model_data );
		}
		$this->load->view( 'layout/footer' );
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
			$this->_edit_profile( $id, $step );
			break;
		case 2:
			$this->_edit_status_report( $id, $step );
			break;
		case 3:
			$this->_edit_message_board( $id, $step );
			break;
		case 4:
			$this->_edit_repair_report( $id, $step );
			break;
		case 5:
			$this->_edit_observation( $id, $step );
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
			$this->_save_profile( $id, $action );
			break;
		case 2:
			$this->_save_status_report( $id, $action );
			break;
		case 3:
			$this->_save_message_board( $id, $action );
			break;
		case 4:
			$this->_save_repair_report( $id, $action );
			break;
		case 5:
			$this->_save_observation( $id, $action );
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
	public function _save_profile( $id, $action ) {

		include 'includes/document-save-init.php';

		$date_of_raised = convert_string_to_date( $date_of_raised );
		$date_reqd_on_board = convert_string_to_date( $date_reqd_on_board );
		$date_of_issue = convert_string_to_date( $date_of_issue );

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';


			if ( $update_flag ) {

				$main_model->update_step_0( $form_id, $repair_criticality, $date_of_raised, $criticality_justification, $date_reqd_on_board, $work_order_number, $equipment_repair_history, $asset_type, $justification, $date_of_issue );

				$document_model->update_responsible_party( $model_id, $responsible_party_role, $responsible_party_role_user_id );

				$document_model->update_interested_party_role( $model_id, $interested_party_role, $interested_party_role_user_id );

				$document_model->update_document_owner( $model_id, $additional_user_id, $current_user_id );

				$document_model->update( $model_id, $erp_equipment_description );

				$document_model->update_equipment_profile( $model_id, $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, $equipment_tag_number, $equipment_unique_id, $equipment_manufacturer, $equipment_model, $equipment_power_output, $equipment_failed_component );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}
	}




	public function _save_status_report( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';


			if ( $update_flag ) {

				//TO DO: status report function

				/*$new_due_date = array();
				foreach($due_date as $single_date){
					$new_due_date[] = convert_string_to_date($single_date);
				}*/

				$main_model->update_step_1( $form_id, $free_notes );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}
	}




	public function _save_message_board( $id, $action ) {

		include 'includes/document-save-init.php';


		if ( $action == 'update' ) {

			$ref_id = $form_model->get_value( $id, 'ref_id' );
			$code = $form_model->get_value( $id, 'code' );

			include 'includes/upload-snippet.php';


			if ( $update_flag ) {

				$model_table_array = $this->model_table_array;
				$model_main_table = $this->model_main_table;

				// $equipment_history_questions = $main_model->get_equipment_history_questions($code, 3, $model_id);
				$main_model->update_status_report_status( $code, 2, $model_id, $status_report_status, $status_cat );
				$main_model->update_responsible_party_role( $code, 2, $model_id, $current_step_no, $step_id );
				$main_model->update( $$id, $free_notes, $cc, $status_report_status, $user_from, $user_to );

				$new_start_date = array();
				$new_end_date = array();


				$main_model->update_value( $model_id, 'step_completed', 2 );

				$main_model->get_form_status( $code, $ref_id, $model_table_array, $model_main_table );

				$this->redirect_form( $id, $current_step, $link_to );


			}

		}
	}

	public function _save_repair_report( $id, $action ) {

		include 'includes/document-save-init.php';

		$new_time_array = array();

		foreach ( $due_date as $date ) {

			$new_time_array[] = convert_string_to_date( $date );

		}


		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';


			if ( $update_flag ) {

				$main_model->update_step_3( $form_id, $scope_comment, $summary, $pass_fail );

				$document_model->update_deliverable( $model_id, $deliverables_description, $new_time_array );

				$document_model->update_test_process( $model_id, $event, $responsible );


				$equipment_history_questions = $document_model->get_equipment_history_questions( $model_id );

				foreach ( $equipment_history_questions as $question ) {

					$question_id = $question->equipment_history_answer_id;
					$select_type = $question->dropdown_type;

					$start_date[$question_id] = convert_string_to_date( $start_date[$question_id], true );
					$end_date[$question_id] = convert_string_to_date( $end_date[$question_id], true );

					if ( $select_type != 'none' ) {
						$document_model->update_answer( $model_id, $question_id, $select[$question_id], $comment[$question_id], $start_date[$question_id], $end_date[$question_id], $start_date_dropdown[$question_id], $end_date_dropdown[$question_id] );
					}else {
						$document_model->update_answer( $model_id, $question_id, '', $comment[$question_id], $start_date[$question_id], $end_date[$question_id], $start_date_dropdown[$question_id], $end_date_dropdown[$question_id] );
					}

				}



				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );


			}

		}
	}

	public function _save_observation( $id, $action ) {

		include 'includes/document-save-init.php';


		if ( $action == 'update' ) {

			include 'includes/upload-snippet.php';


			if ( $update_flag ) {

				$main_model->update_step_4( $form_id, $findings, $summary, $recommendations );

				$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );

			}

		}
	}
	/* END SAVE */

	/* EDIT */
	public function _edit_profile( $id, $step = 1, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Create Equipment Repair File',
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
		$responsible_party_roles = $main_model->get_sub_table( $document_id, 'responsible_party' );
		$interested_party_roles = $main_model->get_sub_table( $document_id, 'interested_party' );
		$repair_criticality = $document_details->repair_criticality_id;
		$date_of_raised = $document_details->date_of_raised;
		$criticality_justification = $document_details->criticality_justification_id;
		$date_reqd_on_board = $document_details->date_required_on_board;
		$work_order_number = $document_details->work_order_number;
		$equipment_repair_history = $document_details->equipment_repair_history;
		$asset_type = $document_details->asset_type_id;
		$justification = $document_details->justification_id;
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

		//RESPONSIBLE PARTY
		$responsible_party_role_array = array();

		$responsible_party_role_counter = 0;
		foreach ( $responsible_party_roles as $role ) {

			$responsible_party_role_array[$responsible_party_role_counter] = array();
			$responsible_party_role_array[$responsible_party_role_counter]['role'] = $this->get_dropdown_menu( $role->role_id, 'responsible_party_role' );
			$responsible_party_role_array[$responsible_party_role_counter]['firstname'] = $user_model->get_value( $role->name_id, 'first_name' );
			$responsible_party_role_array[$responsible_party_role_counter]['lastname'] = $user_model->get_value( $role->name_id, 'last_name' );
			$responsible_party_role_array[$responsible_party_role_counter]['user_id'] = $role->name_id;

			$responsible_party_role_counter++;
		}

		//END RESPONSIBLE PARTY

		//INTERESTED PARTY
		$interested_party_role_array = array();

		$interested_party_role_counter = 0;
		foreach ( $interested_party_roles as $role ) {

			$interested_party_role_array[$interested_party_role_counter] = array();
			$interested_party_role_array[$interested_party_role_counter]['role'] = $this->get_dropdown_menu( $role->role_id, 'interested_party_role' );
			$interested_party_role_array[$interested_party_role_counter]['firstname'] = $user_model->get_value( $role->name_id, 'first_name' );
			$interested_party_role_array[$interested_party_role_counter]['lastname'] = $user_model->get_value( $role->name_id, 'last_name' );
			$interested_party_role_array[$interested_party_role_counter]['user_id'] = $role->name_id;

			$interested_party_role_counter++;
		}

		//END INTERESTED PARTY

		$model_data['user_name'] = $username;
		$model_data['code'] = $code;

		$model_data['erp_equipment_description'] = $name;
		$model_data['responsible_party_roles'] = $responsible_party_role_array;
		$model_data['interested_party_roles'] = $interested_party_role_array;
		$model_data['date_of_raised'] = convert_date_to_string( $date_of_raised );
		$model_data['repair_criticality_dropdown'] = $this->get_dropdown_menu( $repair_criticality, 'repair_criticality' );
		$model_data['date_reqd_on_board'] = convert_date_to_string( $date_reqd_on_board );
		$model_data['criticality_justification_dropdown'] = $this->get_dropdown_menu( $criticality_justification, 'criticality_justification' );
		$model_data['work_order_number'] = $work_order_number;
		$model_data['equipment_repair_history'] = $equipment_repair_history;
		$model_data['asset_type_dropdown'] = $this->get_dropdown_menu( $asset_type, 'asset_type' );
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


		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'erp/erp-0-new', $model_data );
		$this->load->view( 'layout/footer' );

	}

	public function _edit_status_report( $id, $step = 1, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Create Equipment Repair File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$notes = $document_details->notes;

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['free_notes'] = $notes;
		$model_data['files'] = $files;

		//$status_reports = $form_model->get_record_subcategory($step_1_id, 'status_report_item', 'step_id', '*', true, $code, 1, false, true, 'ORDER BY due_date DESC');
		$main_model->get_sub_table( $document_id, 'interested_party' );

		$status_report_array = array();

		$status_report_counter = 0;

		/*foreach($status_reports as $report){

			$status_report_array[$status_report_counter] = array();

			$status_report_array[$status_report_counter]['asset'] = $report->asset;
			//$status_report_array[$status_report_counter]['asset'] = default_select($report->asset);
			//$status_report_array[$status_report_counter]['asset'] .= $this->get_dropdown('status_report_asset', 'asset_cat', $report->asset);

			$status_report_array[$status_report_counter]['status'] = default_select($report->status);
			$status_report_array[$status_report_counter]['status'] .= $this->get_dropdown('status_report_status', 'status_cat', $report->status);

			$status_report_array[$status_report_counter]['mode'] = default_select($report->mode);
			$status_report_array[$status_report_counter]['mode'] .= $this->get_dropdown('status_report_mode', 'mode_cat', $report->mode);

			$status_report_array[$status_report_counter]['last_location'] = default_select($report->last_location);
			$status_report_array[$status_report_counter]['last_location'] .= $this->get_dropdown('status_report_last_location', 'last_location_name', $report->last_location);

			$status_report_array[$status_report_counter]['next_location'] = default_select($report->next_location);
			$status_report_array[$status_report_counter]['next_location'] .= $this->get_dropdown('status_report_next_location', 'next_location_name', $report->next_location);

			$status_report_array[$status_report_counter]['repair_vendor'] = default_select($report->repair_vendor);
			$status_report_array[$status_report_counter]['repair_vendor'] .= $this->get_dropdown('status_report_repair_vendor', 'repair_vendor_cat', $report->last_location);

			$status_report_array[$status_report_counter]['due_date'] = convert_date_to_string($report->due_date);

			$status_report_array[$status_report_counter]['receiving_party'] = default_select($report->receiving_party);
			$status_report_array[$status_report_counter]['receiving_party'] .= $this->get_dropdown('status_report_receive_party', 'receive_party_name', $report->receiving_party);

			$status_report_counter++;
		}*/

		//$model_data['status_reports'] = $status_report_array;

		/*$current_step = $uri_step = $this->uri->segment(4,0);

		$current_user_id = $this->session->userdata('session');

		$ref_id = $form_model->get_value($id, 'ref_id');
		$code = $form_model->get_value($id, 'code');



		$main_details = $main_model->get_record_by_code($ref_id, $code);

		$user_id = $form_model->get_value($id, 'user_id');
		$model_data['id'] = $id;

		foreach($main_details as $detail){

			$step_1_id = $detail->id;

			$model_data['model_id'] = $step_1_id;
			$model_data['ref_id'] = $detail->ref_id;
			$model_data['code'] = $detail->code;
			$model_data['free_notes'] = $detail->free_notes;
			$model_data['step_completed'] = $detail->step_completed;
		}


		$model_id = $model_data['model_id'];



		$status_reports = $form_model->get_record_subcategory($step_1_id, 'status_report_item', 'step_id', '*', true, $code, 1, false, true, 'ORDER BY due_date DESC');

		$status_report_array = array();

		$status_report_counter = 0;

		foreach($status_reports as $report){

			$status_report_array[$status_report_counter] = array();

			$status_report_array[$status_report_counter]['asset'] = $report->asset;
			//$status_report_array[$status_report_counter]['asset'] = default_select($report->asset);
			//$status_report_array[$status_report_counter]['asset'] .= $this->get_dropdown('status_report_asset', 'asset_cat', $report->asset);

			$status_report_array[$status_report_counter]['status'] = default_select($report->status);
			$status_report_array[$status_report_counter]['status'] .= $this->get_dropdown('status_report_status', 'status_cat', $report->status);

			$status_report_array[$status_report_counter]['mode'] = default_select($report->mode);
			$status_report_array[$status_report_counter]['mode'] .= $this->get_dropdown('status_report_mode', 'mode_cat', $report->mode);

			$status_report_array[$status_report_counter]['last_location'] = default_select($report->last_location);
			$status_report_array[$status_report_counter]['last_location'] .= $this->get_dropdown('status_report_last_location', 'last_location_name', $report->last_location);

			$status_report_array[$status_report_counter]['next_location'] = default_select($report->next_location);
			$status_report_array[$status_report_counter]['next_location'] .= $this->get_dropdown('status_report_next_location', 'next_location_name', $report->next_location);

			$status_report_array[$status_report_counter]['repair_vendor'] = default_select($report->repair_vendor);
			$status_report_array[$status_report_counter]['repair_vendor'] .= $this->get_dropdown('status_report_repair_vendor', 'repair_vendor_cat', $report->last_location);

			$status_report_array[$status_report_counter]['due_date'] = convert_date_to_string($report->due_date);

			$status_report_array[$status_report_counter]['receiving_party'] = default_select($report->receiving_party);
			$status_report_array[$status_report_counter]['receiving_party'] .= $this->get_dropdown('status_report_receive_party', 'receive_party_name', $report->receiving_party);

			$status_report_counter++;
		}

		$model_data['status_reports'] = $status_report_array;
		*/

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'erp/erp-1-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_message_board( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;


		$header_data = array(
			'title' => 'Create Equipment Repair File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$message_board_summary = $document_details->message_board_summary;

		$include_null = true;
		$additional_users = $document_model->get_document_owners( $document_id, null );
		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['message_board_summary'] = $message_board_summary;
		//$model_data['additional_users'] = $additional_users;
		$model_data['files'] = $files;

		//TO DO: TO, FROM AND CC
		/*foreach($main_details as $detail){
			$model_data['model_id'] = $detail->id;
			$model_data['ref_id'] = $detail->ref_id;
			$model_data['code'] = $detail->code;
			$model_data['free_notes'] = $detail->free_notes;
			$model_data['step_completed'] = $detail->step_completed;
			$model_data['upload_filename'] = $detail->upload_filename;
			$model_data['responsible_party_role'] = $detail->responsible_party_role;
			$model_data['cc'] = $detail->cc;
			$model_data['status_cat'] = $detail->status_report_status;
			$model_data['user_from'] = $detail->user_from;
			$model_data['user_to'] = $detail->user_to;


		}



		$model_id = $model_data['model_id'];
//
		$responsible_party_role = $model_data['responsible_party_role'];
		$status_report_status = $model_data['status_cat'];



		//additional users

		$user_exception = "AND (user_id != {$user_id} OR user_id is null)";

		$additional_users = $main_model->get_record_subcategory($ref_id, 'additional_user', 'ref_id', '*', true, $code, null, true, true, $user_exception);

		$additional_user_array = array();

		$additional_user_counter = 0;
		foreach($additional_users as $user){

			$additional_user_id = $user->user_id;

			$additional_user_array[$additional_user_counter] = array();
			$additional_user_array[$additional_user_counter]['user_id'] = $additional_user_id;
			$additional_user_array[$additional_user_counter]['first_name'] = $user_model->get_value($additional_user_id, 'first_name');
			$additional_user_array[$additional_user_counter]['last_name'] = $user_model->get_value($additional_user_id, 'last_name');
			$additional_user_array[$additional_user_counter]['user_name'] = $user_model->get_value($additional_user_id, 'user_name');
			$additional_user_array[$additional_user_counter]['email_address'] = $user_model->get_value($additional_user_id, 'email_address');
			//$additional_user_counter++;
		}

		$model_data['additional_users'] = $additional_user_array;

		$model_data['current_form_step'] = 2;
		$model_data['current_step'] = $current_step;
		$model_data['user_name'] = $user_model->get_value($user_id, 'user_name');
		$model_data['id'] = $id;
		$model_data['upload_error'] = $this->session->flashdata('upload_error_2');
//
		$model_data['responsible_party_role_dropdown'] = $this->get_dropdown('responsible_party_role', 'name', $responsible_party_role);
		$model_data['status_report_status_dropdown'] = $this->get_dropdown('status_report_status', 'status_cat', $status_report_status);

		$model_data['constraints'] = $main_model->get_record_subcategory($model_id, 'constraints', 'step_id', '*', true, $code, 2);
		$model_data['files'] = $main_model->get_record_subcategory($model_id, 'file', 'step_id', '*', true, $code, 2);
*/

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'erp/erp-2-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_repair_report( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Create Equipment Repair File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$scope = $document_details->scope;
		$quality_control_summary = $document_details->quality_control_summary;
		$test_processes = $main_model->get_sub_table( $document_id, 'test_process' );
		$pass_fail = $document_details->pass_or_fail;
		$equipment_history_questions = $document_model->get_equipment_history_questions( $document_id );

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['scope_comment'] = $scope;
		$model_data['deliverables'] = $main_model->get_sub_table( $document_id, 'deliverable' );
		$model_data['summary'] = $quality_control_summary;
		$model_data['responsible_parties'] = $test_processes;
		$model_data['pass_fail'] = $pass_fail;
		$model_data['equipment_history_questions'] = $equipment_history_questions;

		$model_data['files'] = $files;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'erp/erp-3-new', $model_data );
		$this->load->view( 'layout/footer' );
	}


	public function _edit_observation( $id, $step ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Create Equipment Requirement File',
			'hidden' => ''
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$user_id = $this->session->userdata( 'session' );
		$username = $user_model->get_value( $user_id, 'user_name' );

		$document_details = $main_model->get_document( $id );

		$document_id = $document_details->document_id;
		$findings = $document_details->findings;
		$summary = $document_details->summary;
		$recommendations = $document_details->recommendations;

		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);

		$model_data['findings'] = $findings;
		$model_data['summary'] = $summary;
		$model_data['recommendations'] = $recommendations;

		$model_data['files'] = $files;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'erp/erp-4-new', $model_data );
		$this->load->view( 'layout/footer' );
	}
	/* END EDIT */


}

/* End of file erp.php */
/* Location: ./application/controllers/erp.php */
