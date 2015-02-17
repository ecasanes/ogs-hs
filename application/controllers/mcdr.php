<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class MCDR extends MY_Controller {
	//material corrosion damage report

	public function __construct() {

		parent::__construct();

		$this->document_code = 'MCDR';
		$this->document_primary = 'document_id';
		$this->form_primary = 'mcdr_id';

		$main_model_str = 'MCDR_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$this->no_of_steps = 7;

		$step_titles = array(
			'Process/Structural Integrity Material/Corrosion Damage Report',
			'Process/Structural Integrity Material/Corrosion Damage Report',
			'Process/Structural Integrity Material/Corrosion Damage Report',
			'Ultrasonic Thickness Inspection Report',
			'Continuation Sheet',
			'Continuation Sheet',
			'Continuation Sheet'
		);

		$this->step_titles = $step_titles;
	}

	public function index() {
		redirect( 'user/my-account' );
	}

	public function view( $id, $action = '' ){

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
			$document_name = 'Unnamed MCDR Document.';
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

		if ( count( $document_details ) <1 ) {
			redirect( 'user/my-account' );
		}

		$document_id = $document_details->document_id;

		//STEP 0
		$name = $document_details->name;
		$installation = $document_details->installation;
		$id_tag_line_no = $document_details->id_tag_line_no;
		$maximo_wo_no = $document_details->maximo_wo_no;
		$date_reported = $document_details->date_reported;
		$module = $document_details->module;
		$mcdr_raised_by = $document_details->mcdr_raised_by;
		$location = $document_details->location;
		$pressure_design = $document_details->pressure_design;
		$pressure_operating = $document_details->pressure_operating;
		$date_of_last_inspection = $document_details->date_of_last_inspection;
		$system = $document_details->system;
		$temp_design = $document_details->temp_design;
		$temp_operating = $document_details->temp_operating;
		$estimated_time_of_service = $document_details->estimated_time_of_service;
		$safety_critical = $document_details->safety_critical;
		$flow_design = $document_details->flow_design;
		$flow_operating = $document_details->flow_operating;
		$other_mcdr = $document_details->other_mcdr;
		$ps_no = $document_details->ps_no;
		$process = $document_details->process;
		$related_reports = $document_details->related_reports;
		$material_type = $document_details->material_type;
		$component_size = $document_details->component_size;
		$schedule = $document_details->schedule;
		$nwt = $document_details->nwt;
		$dca = $document_details->dca;
		$ps_mawt = $document_details->ps_mawt;
		$equipment_type = $document_details->equipment_type;
		$component = $document_details->component;
		$area_on_component = $document_details->area_on_component;
		$coating_system_details = $document_details->coating_system_details;
		$insulated_class = $document_details->insulated_class;
		$degradation_type = $document_details->degradation_type;
		$degradation_mechanism = $document_details->degradation_mechanism;
		$pitting_depth = $document_details->pitting_depth;
		$extent = $document_details->extent;
		$area = $document_details->area;
		$mrwt = $document_details->mrwt;
		$corrosion_grading = $document_details->corrosion_grading;
		$other_remarks = $document_details->other_remarks;
		$leak = $document_details->leak;
		$deferment = $document_details->deferment;
		$added_to_mcdr_register = $document_details->added_to_mcdr_register;
		$temp_repair_applied = $document_details->temp_repair_applied;
		$type_of_repair = $document_details->type_of_repair;
		$leaking = $document_details->leaking;
		$temp_repair_reg_no = $document_details->temp_repair_reg_no;
		$remedial_action_type = $document_details->remedial_action_type;
		$fabric_maint_priority = $document_details->fabric_maint_priority;
		$target_close_out_date = $document_details->target_close_out_date;
		$drawings_pid_etc = $document_details->drawings_pid_etc;
		$mcdr_additional_info = $document_details->mcdr_additional_info;
		$maint_superintendent = $document_details->maint_superintendent;
		$oie_integrity_coordinator_recommendation = $document_details->oie_integrity_coordinator_recommendation;
		$oie_integrity_coordinator = $document_details->oie_integrity_coordinator;
		$oie_integrity_date = $document_details->oie_integrity_date;
		$technical_authority_recommendation = $document_details->technical_authority_recommendation;
		$technical_authority = $document_details->technical_authority;
		$technical_authority_date = $document_details->technical_authority_date;
		$closed_out = $document_details->closed_out;
		$closed_out_coordinator = $document_details->closed_out_coordinator;
		$closed_out_date = $document_details->closed_out_date;

		$can_location = $document_details->can_location;
		$can_date = $document_details->can_date;
		$can_job_no = $document_details->can_job_no;
		$can_report_no = $document_details->can_report_no;
		$client_order_no = $document_details->client_order_no;
		$can_sheet = $document_details->can_sheet;
		$can_sheet_of = $document_details->can_sheet_of;
		$component_description_drawing = $document_details->component_description_drawing;
		$material = $document_details->material;
		$procedure_work_instruction = $document_details->procedure_work_instruction;
		$equipment_make_model = $document_details->equipment_make_model;
		$probe_type_frequency = $document_details->probe_type_frequency;
		$couplant = $document_details->couplant;
		$surface_condition = $document_details->surface_condition;
		$acceptance_standard = $document_details->acceptance_standard;
		$material_serial_no = $document_details->material_serial_no;
		$test_blocks = $document_details->test_blocks;
		$calibration_range = $document_details->calibration_range;
		$can_results = $document_details->can_results;
		$associative_reports = $document_details->associative_reports;
		$can_feature = $document_details->can_feature;
		$can_type = $document_details->can_type;
		$can_scan = $document_details->can_scan;
		$can_min = $document_details->can_min;
		$can_min_location = $document_details->can_min_location;
		$can_line_number = $document_details->can_line_number;
		$can_inspector_sign = $document_details->can_inspector_sign;
		$can_inspector_name = $document_details->can_inspector_name;
		$can_inspector_quals = $document_details->can_inspector_quals;
		$issuing_authority_sign = $document_details->issuing_authority_sign;
		$issuing_authority_name = $document_details->issuing_authority_name;
		$issuing_authority_date = $document_details->issuing_authority_date;
		$client_sign = $document_details->client_sign;
		$client_name = $document_details->client_name;
		$client_date = $document_details->client_date;
		$module_plot_plan = $document_details->module_plot_plan;
		$pid_iso = $document_details->pid_iso;


		//conversion
		if($date_reported != null || $date_reported != ''){
			$date_reported = convert_date_to_string($date_reported);
		}


		//model data
		$model_data['name'] = $name;
		$model_data['installation'] = $installation;
		$model_data['id_tag_line_no'] = $id_tag_line_no;
		$model_data['maximo_wo_no'] = $maximo_wo_no;
		$model_data['date_reported'] = $date_reported; 
		$model_data['module'] = $module;
		$model_data['mcdr_raised_by'] = $mcdr_raised_by;
		$model_data['location'] = $location;
		$model_data['pressure_design'] = $pressure_design;
		$model_data['pressure_operating'] = $pressure_operating;
		$model_data['date_of_last_inspection'] = $date_of_last_inspection;
		$model_data['system'] = $system;
		$model_data['temp_design'] = $temp_design;
		$model_data['temp_operating'] = $temp_operating;
		$model_data['estimated_time_of_service'] = $estimated_time_of_service;
		$model_data['safety_critical'] = $safety_critical;
		$model_data['flow_design'] = $flow_design;
		$model_data['flow_operating'] = $flow_operating;
		$model_data['other_mcdr'] = $other_mcdr;
		$model_data['ps_no'] = $ps_no;
		$model_data['process'] = $process;
		$model_data['related_reports'] = $related_reports;
		$model_data['material_type'] = $material_type;
		$model_data['component_size'] = $component_size;
		$model_data['schedule'] = $schedule;
		$model_data['nwt'] = $nwt;
		$model_data['dca'] = $dca;
		$model_data['ps_mawt'] = $ps_mawt;
		$model_data['equipment_type'] = $equipment_type;
		$model_data['component'] = $component;
		$model_data['area_on_component'] = $area_on_component;
		$model_data['coating_system_details'] = $coating_system_details;
		$model_data['insulated_class'] = $insulated_class;
		$model_data['degradation_type'] = $degradation_type;
		$model_data['degradation_mechanism'] = $degradation_mechanism;
		$model_data['pitting_depth'] = $pitting_depth;
		$model_data['extent'] = $extent;
		$model_data['area'] = $area;
		$model_data['mrwt'] = $mrwt;
		$model_data['corrosion_grading'] = $corrosion_grading;
		$model_data['other_remarks'] = $other_remarks;
		$model_data['leak'] = $leak;
		$model_data['deferment'] = $deferment;
		$model_data['added_to_mcdr_register'] = $added_to_mcdr_register;
		$model_data['temp_repair_applied'] = $temp_repair_applied;
		$model_data['type_of_repair'] = $type_of_repair;
		$model_data['leaking'] = $leaking;
		$model_data['temp_repair_reg_no'] = $temp_repair_reg_no;
		$model_data['remedial_action_type'] = $remedial_action_type;
		$model_data['fabric_maint_priority'] = $fabric_maint_priority;
		$model_data['target_close_out_date'] = $target_close_out_date;
		$model_data['drawings_pid_etc'] = $drawings_pid_etc;
		$model_data['mcdr_additional_info'] = $mcdr_additional_info;
		$model_data['maint_superintendent'] = $maint_superintendent;
		$model_data['oie_integrity_coordinator_recommendation'] = $oie_integrity_coordinator_recommendation;
		$model_data['oie_integrity_coordinator'] = $oie_integrity_coordinator;
		$model_data['oie_integrity_date'] = $oie_integrity_date;
		$model_data['technical_authority_recommendation'] = $technical_authority_recommendation;
		$model_data['technical_authority'] = $technical_authority;
		$model_data['technical_authority_date'] = $technical_authority_date;
		$model_data['closed_out'] = $closed_out;
		$model_data['closed_out_coordinator'] = $closed_out_coordinator;
		$model_data['closed_out_date'] = $closed_out_date;

		$model_data['can_location'] = $can_location;
		$model_data['can_date'] = convert_date_to_string($can_date);
		$model_data['can_job_no'] = $can_job_no;
		$model_data['can_report_no'] = $can_report_no;
		$model_data['client_order_no'] = $client_order_no;
		$model_data['can_sheet'] = $can_sheet;
		$model_data['can_sheet_of'] = $can_sheet_of;
		$model_data['component_description_drawing'] = $component_description_drawing;
		$model_data['material'] = $material;
		$model_data['procedure_work_instruction'] = $procedure_work_instruction;
		$model_data['equipment_make_model'] = $equipment_make_model;
		$model_data['probe_type_frequency'] = $probe_type_frequency;
		$model_data['couplant'] = $couplant;
		$model_data['surface_condition'] = $surface_condition;
		$model_data['acceptance_standard'] = $acceptance_standard;
		$model_data['material_serial_no'] = $material_serial_no;
		$model_data['test_blocks'] = $test_blocks;
		$model_data['calibration_range'] = $calibration_range;
		$model_data['can_results'] = $can_results;
		$model_data['associative_reports'] = $associative_reports;
		$model_data['can_feature'] = $can_feature;
		$model_data['can_type'] = $can_type;
		$model_data['can_scan'] = $can_scan;
		$model_data['can_min'] = $can_min;
		$model_data['can_min_location'] = $can_min_location;
		$model_data['can_line_number'] = $can_line_number;
		$model_data['can_inspector_sign'] = $can_inspector_sign;
		$model_data['can_inspector_name'] = $can_inspector_name;
		$model_data['can_inspector_quals'] = $can_inspector_quals;
		$model_data['issuing_authority_sign'] = $issuing_authority_sign;
		$model_data['issuing_authority_name'] = $issuing_authority_name;
		$model_data['issuing_authority_date'] = convert_date_to_string($issuing_authority_date);
		$model_data['client_sign'] = $client_sign;
		$model_data['client_name'] = $client_name;
		$model_data['client_date'] = convert_date_to_string($client_date);
		$model_data['module_plot_plan'] = $module_plot_plan;
		$model_data['pid_iso'] = $pid_iso;


		$model_data['document_id'] = $document_id;


		//ranking
		$model_data['ranking_title'] = 'Rate this Case File';
		include 'includes/ranking-snippet.php';
		$model_data['editable'] = $editable;




		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'view/view-mcdr', $model_data );
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
			$this->_edit_mcdr_0( $id, $step );
			break;
		case 2:
			$this->_edit_mcdr_1( $id, $step);
			break;
		case 3:
			$this->_edit_mcdr_2( $id, $step);
			break;
		case 4:
			$this->_edit_mcdr_3( $id, $step);
			break;
		case 5:
			$this->_edit_mcdr_4( $id, $step);
			break;
		case 6:
			$this->_edit_mcdr_5( $id, $step);
			break;
		case 7:
			$this->_edit_mcdr_6( $id, $step);
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
			$this->_save_mcdr_0( $id, $action );
			break;
		case 2:
			$this->_save_mcdr_1( $id, $action );
			break;
		case 3:
			$this->_save_mcdr_2( $id, $action );
			break;
		case 4:
			$this->_save_mcdr_3( $id, $action );
			break;
		case 5:
			$this->_save_mcdr_4( $id, $action );
			break;
		case 6:
			$this->_save_mcdr_5( $id, $action );
			break;
		case 7:
			$this->_save_mcdr_6( $id, $action );
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
	public function _save_mcdr_0( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$date_reported = convert_string_to_date($date_reported);
			$date_of_last_inspection = convert_string_to_date($date_of_last_inspection);
			$target_close_out_date = convert_string_to_date($target_close_out_date);

			$main_model->update_step_0( $form_id, $installation, $id_tag_line_no, $maximo_wo_no, $date_reported, $module, $pressure_design, $pressure_operating, $temp_design, $temp_operating, $flow_design, $flow_operating, $location, $system, $safety_critical, $mcdr_raised_by, $date_of_last_inspection, $estimated_time_of_service, $other_mcdr, $ps_no, $process, $related_reports, $material_type, $component_size, $schedule, $nwt, $dca, $ps_mawt, $equipment_type, $component, $area_on_component, $coating_system_details, $insulated_class, $degradation_type, $degradation_mechanism, $pitting_depth, $extent, $area, $mrwt, $corrosion_grading, $other_remarks, $leak, $deferment, $added_to_mcdr_register, $temp_repair_applied, $type_of_repair, $leaking, $temp_repair_reg_no, $remedial_action_type, $fabric_maint_priority, $target_close_out_date, $drawings_pid_etc, $mcdr_additional_info, $maint_superintendent );

			$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );
		}

	}

	public function _save_mcdr_1( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$oie_integrity_date = convert_string_to_date($oie_integrity_date);
			$technical_authority_date = convert_string_to_date($technical_authority_date);
			$closed_out_date = convert_string_to_date($closed_out_date);

			$main_model->update_step_1( $form_id, $oie_integrity_coordinator_recommendation, $oie_integrity_coordinator, $oie_integrity_date, $technical_authority_recommendation, $technical_authority, $technical_authority_date, $closed_out, $closed_out_coordinator, $closed_out_date);

			$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );
		}

	}


	public function _save_mcdr_2( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$oie_integrity_date = convert_string_to_date($oie_integrity_date);
			$technical_authority_date = convert_string_to_date($technical_authority_date);
			$closed_out_date = convert_string_to_date($closed_out_date);

			$main_model->update_step_1( $form_id, $oie_integrity_coordinator_recommendation, $oie_integrity_coordinator, $oie_integrity_date, $technical_authority_recommendation, $technical_authority, $technical_authority_date, $closed_out, $closed_out_coordinator, $closed_out_date);

			$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );
		}

	}


	public function _save_mcdr_3( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$can_date = convert_string_to_date($can_date);
			$issuing_authority_date = convert_string_to_date($issuing_authority_date);
			$client_date = convert_string_to_date($client_date);

			$main_model->update_step_3( $form_id, $can_location, $can_date, $can_job_no, $can_report_no, $client_order_no, $can_sheet, $can_sheet_of, $component_description_drawing, $material, $procedure_work_instruction, $equipment_make_model, $probe_type_frequency, $couplant, $surface_condition, $acceptance_standard, $material_serial_no, $test_blocks, $calibration_range, $can_results, $associative_reports, $can_feature, $can_type, $can_scan, $can_min, $can_min_location, $can_line_number, $can_inspector_sign, $can_inspector_name, $can_inspector_quals, $issuing_authority_sign, $issuing_authority_name, $issuing_authority_date, $client_sign, $client_name, $client_date);

			$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );
		}

	}


	public function _save_mcdr_4( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$cont_date = convert_string_to_date($cont_date);
			$cont_issuing_authority_date = convert_string_to_date($cont_issuing_authority_date);
			$cont_client_date = convert_string_to_date($cont_client_date);

			$main_model->update_step_4( $form_id, $cont_location, $cont_date, $cont_job_no, $cont_report_no, $cont_client_no, $cont_sheet, $cont_sheet_of, $cont_component_description, $cont_image_caption, $cont_inspector_sign, $cont_inspector_name, $cont_inspector_quals, $cont_issuing_authority_sign, $cont_issuing_authority_name, $cont_issuing_authority_date, $cont_client_sign, $cont_client_name, $cont_client_date);

			$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );
		}

	}


	public function _save_mcdr_5( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$main_model->update_step_5( $form_id, $module_plot_plan);

			$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );
		}

	}


	public function _save_mcdr_6( $id, $action ) {

		include 'includes/document-save-init.php';

		if ( $action == 'update' ) {

			$main_model->update_step_6( $form_id, $pid_iso);

			$this->save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to );
		}

	}

	/* END SAVE */

	/* EDIT */
	public function _edit_mcdr_0( $id, $step = 1, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'current_page_name' => 'Edit MCDR'
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

		$installation = $document_details->installation;
		$id_tag_line_no = $document_details->id_tag_line_no;
		$maximo_wo_no = $document_details->maximo_wo_no;
		$date_reported = $document_details->date_reported;
		$module = $document_details->module;
		$pressure_design = $document_details->pressure_design;
		$pressure_operating = $document_details->pressure_operating;
		$temp_design = $document_details->temp_design;
		$temp_operating = $document_details->temp_operating;
		$flow_design = $document_details->flow_design;
		$flow_operating = $document_details->flow_operating;
		$location = $document_details->location;
		$system = $document_details->system;
		$safety_critical = $document_details->safety_critical;
		$mcdr_raised_by = $document_details->mcdr_raised_by;
		$date_of_last_inspection = $document_details->date_of_last_inspection;
		$estimated_time_of_service = $document_details->estimated_time_of_service;
		$other_mcdr = $document_details->other_mcdr;
		$ps_no = $document_details->ps_no;
		$process = $document_details->process;
		$related_reports = $document_details->related_reports;
		$material_type = $document_details->material_type;
		$component_size = $document_details->component_size;
		$schedule = $document_details->schedule;
		$nwt = $document_details->nwt;
		$dca = $document_details->dca;
		$ps_mawt = $document_details->ps_mawt;
		$equipment_type = $document_details->equipment_type;
		$component = $document_details->component;
		$area_on_component = $document_details->area_on_component;
		$coating_system_details = $document_details->coating_system_details;
		$insulated_class = $document_details->insulated_class;
		$degradation_type = $document_details->degradation_type;
		$degradation_mechanism = $document_details->degradation_mechanism;
		$pitting_depth = $document_details->pitting_depth;
		$extent = $document_details->extent;
		$area = $document_details->area;
		$mrwt = $document_details->mrwt;
		$corrosion_grading = $document_details->corrosion_grading;
		$other_remarks = $document_details->other_remarks;
		$leak = $document_details->leak;
		$deferment = $document_details->deferment;
		$added_to_mcdr_register = $document_details->added_to_mcdr_register;
		$temp_repair_applied = $document_details->temp_repair_applied;
		$type_of_repair = $document_details->type_of_repair;
		$leaking = $document_details->leaking;
		$temp_repair_reg_no = $document_details->temp_repair_reg_no;
		$remedial_action_type = $document_details->remedial_action_type;
		$fabric_maint_priority = $document_details->fabric_maint_priority;
		$target_close_out_date = $document_details->target_close_out_date;
		$drawings_pid_etc = $document_details->drawings_pid_etc;
		$mcdr_additional_info = $document_details->mcdr_additional_info;
		$maint_superintendent = $document_details->maint_superintendent;



		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);


		include 'includes/document-status-snippet.php';





		$model_data['user_name'] = $username;
		$model_data['name'] = $name;
		$model_data['code'] = $code;

		$model_data['files'] = $files;


		$model_data['installation'] = $installation;
		$model_data['id_tag_line_no'] = $id_tag_line_no;
		$model_data['maximo_wo_no'] = $maximo_wo_no;
		$model_data['date_reported'] = convert_date_to_string($date_reported);
		$model_data['module'] = $module;
		$model_data['pressure_design'] = $pressure_design;
		$model_data['pressure_operating'] = $pressure_operating;
		$model_data['temp_design'] = $temp_design;
		$model_data['temp_operating'] = $temp_operating;
		$model_data['flow_design'] = $flow_design;
		$model_data['flow_operating'] = $flow_operating;
		$model_data['location'] = $location;
		$model_data['system'] = $system;
		$model_data['safety_critical'] = $safety_critical;
		$model_data['mcdr_raised_by'] = $mcdr_raised_by;
		$model_data['date_of_last_inspection'] = convert_date_to_string($date_of_last_inspection);
		$model_data['estimated_time_of_service'] = $estimated_time_of_service;
		$model_data['other_mcdr'] = $other_mcdr;
		$model_data['ps_no'] = $ps_no;
		$model_data['process'] = $process;
		$model_data['related_reports'] = $related_reports;
		$model_data['material_type'] = $material_type;
		$model_data['component_size'] = $component_size;
		$model_data['schedule'] = $schedule;
		$model_data['nwt'] = $nwt;
		$model_data['dca'] = $dca;
		$model_data['ps_mawt'] = $ps_mawt;
		$model_data['equipment_type'] = $equipment_type;
		$model_data['component'] = $component;
		$model_data['area_on_component'] = $area_on_component;
		$model_data['coating_system_details'] = $coating_system_details;
		$model_data['insulated_class'] = $insulated_class;
		$model_data['degradation_type'] = $degradation_type;
		$model_data['degradation_mechanism'] = $degradation_mechanism;
		$model_data['pitting_depth'] = $pitting_depth;
		$model_data['extent'] = $extent;
		$model_data['area'] = $area;
		$model_data['mrwt'] = $mrwt;
		$model_data['corrosion_grading'] = $corrosion_grading;
		$model_data['other_remarks'] = $other_remarks;
		$model_data['leak'] = $leak;
		$model_data['deferment'] = $deferment;
		$model_data['added_to_mcdr_register'] = $added_to_mcdr_register;
		$model_data['temp_repair_applied'] = $temp_repair_applied;
		$model_data['type_of_repair'] = $type_of_repair;
		$model_data['leaking'] = $leaking;
		$model_data['temp_repair_reg_no'] = $temp_repair_reg_no;
		$model_data['remedial_action_type'] = $remedial_action_type;
		$model_data['fabric_maint_priority'] = $fabric_maint_priority;
		$model_data['target_close_out_date'] = convert_date_to_string($target_close_out_date);
		$model_data['drawings_pid_etc'] = $drawings_pid_etc;
		$model_data['mcdr_additional_info'] = $mcdr_additional_info;
		$model_data['maint_superintendent'] = $maint_superintendent;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'mcdr/mcdr-edit-'.$step, $model_data );
		$this->load->view( 'layout/footer' );
	}


	public function _edit_mcdr_1( $id, $step, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'current_page_name' => 'Edit MCDR'
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

		
		$oie_integrity_coordinator_recommendation = $document_details->oie_integrity_coordinator_recommendation;
		$oie_integrity_coordinator = $document_details->oie_integrity_coordinator;
		$oie_integrity_date = $document_details->oie_integrity_date;
		$technical_authority_recommendation = $document_details->technical_authority_recommendation;
		$technical_authority = $document_details->technical_authority;
		$technical_authority_date = $document_details->technical_authority_date;
		$closed_out = $document_details->closed_out;
		$closed_out_coordinator = $document_details->closed_out_coordinator;
		$closed_out_date = $document_details->closed_out_date;


		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);


		include 'includes/document-status-snippet.php';





		$model_data['user_name'] = $username;
		$model_data['name'] = $name;
		$model_data['code'] = $code;

		$model_data['files'] = $files;

		$model_data['oie_integrity_coordinator_recommendation'] = $oie_integrity_coordinator_recommendation;
		$model_data['oie_integrity_coordinator'] = $oie_integrity_coordinator;
		$model_data['oie_integrity_date'] = convert_date_to_string($oie_integrity_date);
		$model_data['technical_authority_recommendation'] = $technical_authority_recommendation;
		$model_data['technical_authority'] = $technical_authority;
		$model_data['technical_authority_date'] = convert_date_to_string($technical_authority_date);
		$model_data['closed_out'] = $closed_out;
		$model_data['closed_out_coordinator'] = $closed_out_coordinator;
		$model_data['closed_out_date'] = convert_date_to_string($closed_out_date);
		

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'mcdr/mcdr-edit-'.$step, $model_data );
		$this->load->view( 'layout/footer' );
	}



	public function _edit_mcdr_2( $id, $step, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'current_page_name' => 'Edit MCDR'
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

		



		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);


		include 'includes/document-status-snippet.php';





		$model_data['user_name'] = $username;
		$model_data['name'] = $name;
		$model_data['code'] = $code;

		$model_data['files'] = $files;


		

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'mcdr/mcdr-edit-'.$step, $model_data );
		$this->load->view( 'layout/footer' );
	}


	public function _edit_mcdr_3( $id, $step, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'current_page_name' => 'Edit MCDR'
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

		
		$can_location = $document_details->can_location;
		$can_date = $document_details->can_date;
		$can_job_no = $document_details->can_job_no;
		$can_report_no = $document_details->can_report_no;
		$client_order_no = $document_details->client_order_no;
		$can_sheet = $document_details->can_sheet;
		$can_sheet_of = $document_details->can_sheet_of;
		$component_description_drawing = $document_details->component_description_drawing;
		$material = $document_details->material;
		$procedure_work_instruction = $document_details->procedure_work_instruction;
		$equipment_make_model = $document_details->equipment_make_model;
		$probe_type_frequency = $document_details->probe_type_frequency;
		$couplant = $document_details->couplant;
		$surface_condition = $document_details->surface_condition;
		$acceptance_standard = $document_details->acceptance_standard;
		$material_serial_no = $document_details->material_serial_no;
		$test_blocks = $document_details->test_blocks;
		$calibration_range = $document_details->calibration_range;
		$can_results = $document_details->can_results;
		$associative_reports = $document_details->associative_reports;
		$can_feature = $document_details->can_feature;
		$can_type = $document_details->can_type;
		$can_scan = $document_details->can_scan;
		$can_min = $document_details->can_min;
		$can_min_location = $document_details->can_min_location;
		$can_line_number = $document_details->can_line_number;
		$can_inspector_sign = $document_details->can_inspector_sign;
		$can_inspector_name = $document_details->can_inspector_name;
		$can_inspector_quals = $document_details->can_inspector_quals;
		$issuing_authority_sign = $document_details->issuing_authority_sign;
		$issuing_authority_name = $document_details->issuing_authority_name;
		$issuing_authority_date = $document_details->issuing_authority_date;
		$client_sign = $document_details->client_sign;
		$client_name = $document_details->client_name;
		$client_date = $document_details->client_date;


		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);


		include 'includes/document-status-snippet.php';





		$model_data['user_name'] = $username;
		$model_data['name'] = $name;
		$model_data['code'] = $code;

		$model_data['files'] = $files;


		$model_data['can_location'] = $can_location;
		$model_data['can_date'] = convert_date_to_string($can_date);
		$model_data['can_job_no'] = $can_job_no;
		$model_data['can_report_no'] = $can_report_no;
		$model_data['client_order_no'] = $client_order_no;
		$model_data['can_sheet'] = $can_sheet;
		$model_data['can_sheet_of'] = $can_sheet_of;
		$model_data['component_description_drawing'] = $component_description_drawing;
		$model_data['material'] = $material;
		$model_data['procedure_work_instruction'] = $procedure_work_instruction;
		$model_data['equipment_make_model'] = $equipment_make_model;
		$model_data['probe_type_frequency'] = $probe_type_frequency;
		$model_data['couplant'] = $couplant;
		$model_data['surface_condition'] = $surface_condition;
		$model_data['acceptance_standard'] = $acceptance_standard;
		$model_data['material_serial_no'] = $material_serial_no;
		$model_data['test_blocks'] = $test_blocks;
		$model_data['calibration_range'] = $calibration_range;
		$model_data['can_results'] = $can_results;
		$model_data['associative_reports'] = $associative_reports;
		$model_data['can_feature'] = $can_feature;
		$model_data['can_type'] = $can_type;
		$model_data['can_scan'] = $can_scan;
		$model_data['can_min'] = $can_min;
		$model_data['can_min_location'] = $can_min_location;
		$model_data['can_line_number'] = $can_line_number;
		$model_data['can_inspector_sign'] = $can_inspector_sign;
		$model_data['can_inspector_name'] = $can_inspector_name;
		$model_data['can_inspector_quals'] = $can_inspector_quals;
		$model_data['issuing_authority_sign'] = $issuing_authority_sign;
		$model_data['issuing_authority_name'] = $issuing_authority_name;
		$model_data['issuing_authority_date'] = convert_date_to_string($issuing_authority_date);
		$model_data['client_sign'] = $client_sign;
		$model_data['client_name'] = $client_name;
		$model_data['client_date'] = convert_date_to_string($client_date);


		

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'mcdr/mcdr-edit-'.$step, $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_mcdr_4( $id, $step, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'current_page_name' => 'Edit MCDR'
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

		
		$cont_location = $document_details->cont_location;
		$cont_date = $document_details->cont_date;
		$cont_job_no = $document_details->cont_job_no;
		$cont_client_no = $document_details->cont_client_no;
		$cont_report_no = $document_details->cont_report_no;
		$cont_sheet = $document_details->cont_sheet;
		$cont_sheet_of = $document_details->cont_sheet_of;
		$cont_component_description = $document_details->cont_component_description;
		$cont_image_caption = $document_details->cont_image_caption;
		$cont_inspector_sign = $document_details->cont_inspector_sign;
		$cont_inspector_name = $document_details->cont_inspector_name;
		$cont_inspector_quals = $document_details->cont_inspector_quals;
		$cont_issuing_authority_sign = $document_details->cont_issuing_authority_sign;
		$cont_issuing_authority_name = $document_details->cont_issuing_authority_name;
		$cont_issuing_authority_date = $document_details->cont_issuing_authority_date;
		$cont_client_sign = $document_details->cont_client_sign;
		$cont_client_name = $document_details->cont_client_name;
		$cont_client_date = $document_details->cont_client_date;


		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);


		include 'includes/document-status-snippet.php';





		$model_data['user_name'] = $username;
		$model_data['name'] = $name;
		$model_data['code'] = $code;

		$model_data['files'] = $files;

		$model_data['cont_location'] = $cont_location;
		$model_data['cont_date'] = convert_date_to_string($cont_date);
		$model_data['cont_job_no'] = $cont_job_no;
		$model_data['cont_client_no'] = $cont_client_no;
		$model_data['cont_report_no'] = $cont_report_no;
		$model_data['cont_sheet'] = $cont_sheet;
		$model_data['cont_sheet_of'] = $cont_sheet_of;
		$model_data['cont_component_description'] = $cont_component_description;
		$model_data['cont_image_caption'] = $cont_image_caption;
		$model_data['cont_inspector_sign'] = $cont_inspector_sign;
		$model_data['cont_inspector_name'] = $cont_inspector_name;
		$model_data['cont_inspector_quals'] = $cont_inspector_quals;
		$model_data['cont_issuing_authority_sign'] = $cont_issuing_authority_sign;
		$model_data['cont_issuing_authority_name'] = $cont_issuing_authority_name;
		$model_data['cont_issuing_authority_date'] = convert_date_to_string($cont_issuing_authority_date);
		$model_data['cont_client_sign'] = $cont_client_sign;
		$model_data['cont_client_name'] = $cont_client_name;
		$model_data['cont_client_date'] = convert_date_to_string($cont_client_date);


		

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'mcdr/mcdr-edit-'.$step, $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_mcdr_5( $id, $step, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'current_page_name' => 'Edit MCDR'
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

		$module_plot_plan = $document_details->module_plot_plan;



		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);


		include 'includes/document-status-snippet.php';





		$model_data['user_name'] = $username;
		$model_data['name'] = $name;
		$model_data['code'] = $code;

		$model_data['files'] = $files;

		$model_data['module_plot_plan'] = $module_plot_plan;
		

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'mcdr/mcdr-edit-'.$step, $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function _edit_mcdr_6( $id, $step, $warning_status = '' ) {

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'current_page_name' => 'Edit MCDR'
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

		
		$pid_iso = $document_details->pid_iso;


		//$files = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $step );
		$files = $main_model->get_files_by_document_step($document_id, $step);


		include 'includes/document-status-snippet.php';





		$model_data['user_name'] = $username;
		$model_data['name'] = $name;
		$model_data['code'] = $code;

		$model_data['files'] = $files;

		$model_data['pid_iso'] = $pid_iso;


		

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'mcdr/mcdr-edit-'.$step, $model_data );
		$this->load->view( 'layout/footer' );
	}

	/* END EDIT */

	public function get_floor_plan(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$floor_plans = $this->main_model->get_floor_plans($document_id);

			$floor_plan_array = array();

			$floor_plan_counter = 0;
			foreach ( $floor_plans as $item ) {

				$id = $item->floorplan_id;
				$name = $item->name;

				$floor_plan_array[$floor_plan_counter]['floor_plan_id'] = $id;
				$floor_plan_array[$floor_plan_counter]['name'] = $name;

				$floor_plan_counter++;
			}

			$main_array = array(
				'table_data'=>$floor_plan_array
			);

			echo json_encode($main_array);
		}
	}

	public function create_floor_plan(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$floor_plan_id = $this->main_model->create_floor_plan($document_id);

			echo json_encode($floor_plan_id);
		}
	}

	public function delete_floor_plan(){

		$data = $this->input->post();

		if($data){

			$this->load->model( 'Document_Model' );
			$document_model = new Document_Model();

			extract( $data, EXTR_SKIP );
			//to do delete actual file
			$document_model->delete_value( $floor_plan_id, 'floorplan', 'floorplan_id' );
		}
	}

	public function view_floor_plan($floor_plan_id = null){

		if($floor_plan_id == null){
			redirect(base_url());
		}

		$floor_plan = $this->main_model->get_specific_floor_plan($floor_plan_id);

		if(count($floor_plan) < 1){
			redirect(base_url());
		}

		$header_data = array(
			'current_page_name' => 'View Floor Plan'
		);

		$model_data = array(
			'upload_error' => $this->session->flashdata( 'upload_error' )
		);

		$uploads_folder = $this->uploads_folder;

		$floor_plan_id = $floor_plan->floorplan_id;
		$name = $floor_plan->name;
		$description = $floor_plan->description;
		$file_name = $floor_plan->filename;
		$document_id = $floor_plan->document_id;

		$model_data['floor_plan_id'] = $floor_plan_id;
		$model_data['name'] = $name;
		$model_data['description'] = $description;
		$model_data['file_name'] = $file_name;
		$model_data['document_id'] = $document_id;

		include('includes/document-variables.php');

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
			'add-point-modal',
			'confirm-upload-modal'
		);
		

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'mcdr/view-floor-plan', $model_data );
		$this->load->view( 'layout/footer',$footer_data );

	}

	public function upload_floor_plan() {

		$upload_config = $this->file_config;
		$this->load->library( 'upload', $upload_config );

		$data = $this->input->post();

		//var_dump($data);

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$uploads_folder = $this->uploads_folder;

			$absolute_path = FCPATH.$uploads_folder."\\";

			/*$filenames = array();*/
			$errors = array();

			//var_dump($_FILES);

			$files = $_FILES;

			//var_dump($files);


				$single_name = $files['userfile']['name'];

				$single_filename = get_filename( $single_name );
				$single_filename = generate_slug( $single_filename );
				$single_extension = get_filename_extension( $single_name );

				$single_new_name = $single_filename.'.'.$single_extension;



				$single_type = $files['userfile']['type'];
				$single_tmp_name = $files['userfile']['tmp_name'];
				$single_error = $files['userfile']['error'];
				$single_size = $files['userfile']['size'];

				$_FILES['userfile']['name']= $single_new_name;
				$_FILES['userfile']['type']= $single_type;
				$_FILES['userfile']['tmp_name']= $single_tmp_name;
				$_FILES['userfile']['error']= $single_error;
				$_FILES['userfile']['size']= $single_size;

				$this->upload->initialize( $upload_config );


				if ( ! $this->upload->do_upload() ) {
					if ( $single_name != '' ) {
						$errors = array(
							'filename' => $single_new_name,
							'error' => $this->upload->display_errors( '', '' )
						);
					}

					$filenames = '';
					$check_file['checked'] = 0;
				}else {
					$upload_data = $this->upload->data();
					$filenames = $upload_data['file_name'];
					$check_file['checked'] = 1;
				}

			//}




			

			$this->main_model->create_file_path($filenames, $floor_plan_id);

			$this->main_model->delete_value( $floor_plan_id, 'floorplan_detail', 'floorplan_id' );

			$file = $this->main_model->get_floor_plan_file( $floor_plan_id );





			//errors
			$error_message = '';
			if ( count( $errors )>0 ) {
					if ( $errors['filename'] ) {
						$error_message = '<p>'.$error_message.' &nbsp; '.$errors['filename'].' - '.$errors['error'].'</p>';
					}
				//}

			}

			//return uploads
			//$upload_counter = 0;
			$upload_array = array();

			/*foreach ( $files as $file ) {*/
				$upload_array['filename'] = $file->filename;
			//	$upload_counter++;
			/*}*/

			$main_array = array(
				'errors' => $error_message,
				'upload_data' => $upload_array,
				'file_check' => $check_file
			);

			echo json_encode( $main_array );
		}
	}


	public function load_floor_plan_image(){

		$data = $this->input->post();

		if($data){

			extract($data, EXTR_SKIP);

			$file = $this->main_model->get_floor_plan_file( $floor_plan_id );

			$filename = $file->filename;

			if($filename == null || $filename == ''){
				$filename = '';
			}

			$model_data['file_name'] = $filename;

			$image = $this->load->view('mcdr/floor-plan-image', $model_data, true);

			echo $image;

			
		}
	}

	public function update_floor_plan_description(){

        $data = $this->input->post();

        if($data){
            extract($data, EXTR_SKIP);

            $this->main_model->update_value($floorplan_id, 'description', $description, 'floorplan', 'floorplan_id');

            redirect(base_url('mcdr/view-floor-plan/'.$floorplan_id));
            
        }
    }

    public function get_floor_plan_plot_points(){

    	$data = $this->input->post();

    	if($data){

    		extract($data, EXTR_SKIP);

    		$details = $this->main_model->get_plot_points($floor_plan_id);

    		$point_array = array();

    		$counter = 0;

    		foreach($details as $detail):
    			$point_array[$counter]['x_pos'] = $detail->x_position;
    			$point_array[$counter]['y_pos'] = $detail->y_position;
    			$point_array[$counter]['plot_num'] = $counter + 1;
    			$point_array[$counter]['note'] = $detail->note;

    			$counter++;
    		endforeach;

    		echo json_encode($point_array);	
    	}

    }

}

/* End of file mcdr.php */
/* Location: ./application/controllers/mcdr.php */
