<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Action_Tracker extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'ACTION-TRACK';
		$this->document_primary = 'document_id';
		$this->form_primary = 'action_tracker_id';

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$this->load->model( 'ActionTracker_Model' );
		$this->main_model = new ActionTracker_Model();

		$this->no_of_steps = 1;
	}

	public function index() { //test comment

		$action_tracker_id_flash = $this->session->flashdata('action_tracker_id');
		$subaction_flash = $this->session->flashdata('subaction');

		//echo $action_tracker_id_flash;

		$this->is_logged_in();
		$data = $this->input->post();



		//$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );

		$header_data = array(
			'hidden' => ''/*,
			'container_class'=> 'wide',
			'container_size'=> 'xl'*/
		);


		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$action_tracker = $document_model->get_action_tracker( $user_id, $document_id, $status, $reference );

		}else {
			$action_tracker = $document_model->get_action_tracker( $user_id );
		}



		$user_documents = $document_model->get_user_documents( $user_id );

		foreach ( $user_documents as $document ) {
			$model_data['existing_document_name_dropdown'] .= '<option value="'.$document->document_id.'">'.$document->code.': '.$document->name.'&nbsp;</option>';
		}

		//ACTION TRACKER ARRAY
		$action_tracker_array = array();

		$action_tracker_counter = 0;
		foreach ( $action_tracker as $item ) {

			$full_name = $user_model->get_short_name( $item->owner );

			$action_tracker_id = $item->action_tracker_id;
			$document_id = $item->document_id;
			$reference = $item->reference;
			$action_process = $item->action_process_step;
			$status_id = $item->status;
			$status = $this->get_menu_detail_value( $status_id, 'action_tracker_status', 'menu', 'color_class' );
			$document_name = $item->name;
			$document_code = $item->code;
			$reply = $item->reply ?: '';
			$author_name = $user_model->get_full_name( $item->author );
			$author_id = $item->author;

			if ( $action_process == '' && $status == '' ) {
				continue;
			}

			if ( $document_name == '' ) {
				$document_name = ' ';
			}
			$model_data['document_name_dropdown'] .= '<option value="'.$document_id.'">'.$document_code.': '.$document_name.'&nbsp;</option>';
			
			$action_tracker_array[$action_tracker_counter] = array();

			$action_tracker_array[$action_tracker_counter]['action_tracker_id'] = $action_tracker_id;
			$action_tracker_array[$action_tracker_counter]['reference'] = $reference;
			$action_tracker_array[$action_tracker_counter]['action_process'] = $action_process;
			$action_tracker_array[$action_tracker_counter]['status'] = $this->get_dropdown_menu( $item->status, 'action_tracker_status', 'menu', true, false, '' );
			$action_tracker_array[$action_tracker_counter]['status_id'] = $status_id;
			$action_tracker_array[$action_tracker_counter]['status_color'] = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'color_class' );
			$action_tracker_array[$action_tracker_counter]['document_name'] = $document_name;
			$action_tracker_array[$action_tracker_counter]['document_code'] = $document_code;
			$action_tracker_array[$action_tracker_counter]['owner'] = $item->owner;
			$action_tracker_array[$action_tracker_counter]['due_date'] = convert_date_to_string( $item->due_date, false, false, 'j/n/y' );
			$action_tracker_array[$action_tracker_counter]['comments'] = $item->comments;
			$action_tracker_array[$action_tracker_counter]['full_name'] = $full_name.'&nbsp;';
			$action_tracker_array[$action_tracker_counter]['author_name'] = $author_name;
			$action_tracker_array[$action_tracker_counter]['author_id'] = $author_id;
			$action_tracker_array[$action_tracker_counter]['reply'] = $reply;

			$action_tracker_counter++;
		}

		$model_data['action_trackers'] = $action_tracker_array;
		$model_data['upload_error'] = '';

		$model_data['status_dropdown'] = $this->get_dropdown_menu( null, 'action_tracker_status', 'menu', true, false, '' );

		$current_user_full_name = $user_model->get_full_name( $user_id );

		$model_data['user_option'] = '<option value="'.$user_id.'">'.$current_user_full_name.'</option>';
		$model_data['flash_action_id'] = $action_tracker_id_flash ? :null;
		$model_data['flash_subaction_id'] = $subaction_flash ? :null;

		$userdata = $user_model->get_all_records();

		$userdata_counter = 0;
		foreach ( $userdata as $result ) {
			//var_dump($result);

			$full_name = $result->first_name. ' ' .$result->last_name;

			$userdata_array[$userdata_counter] = array();

			if($user_id != $result->user_id){
				$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';	
			}
			
		}

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;
		$footer_data['modals'] = array(
									'confirm-delete-modal', 
									'action-tracker-upload-form-modal',
									'action-tracker-create-modal', 
									'action-tracker-edit-modal'
								);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'action_tracker/action-tracker-list-new', $model_data );
		$this->load->view( 'layout/footer',$footer_data );
	} 

	public function ajax_action_tracker()
	{
		$this->load->model('Document_Tracker_Model');
		$document_tracker_model = new Document_Tracker_Model();

		# PAGINATION. -----------------------------------------------------------------------------------------
		$row_limit = 20;
		$page_limit = 10;
		$curr_page = 1;
		$row_count = 0;

		// Change page if valid.
		if(  intval(trim($this->input->get('page'))) > 0 )
		{
		  $curr_page = intval($this->input->get('page'));
		}

		$pagination = new Pagination($row_limit, $page_limit, $curr_page);

		# use class variables to include offset and limit.
		$row_offset = $pagination->get_offset($curr_page);

		// Pass the row limit and offset in the query.
		$results = $document_tracker_model->get_all_action_tracks($row_limit, $row_offset);
		$count = $results['count'];
		unset($results['count']);;

		// Pass count in pagination.
		$pagination->get_query_count($count);
		# END OF PAGINATION. -----------------------------------------------------------------------------------		
	
		if( ! empty($results) )
		{
			print('<p>Records found: <span class="text-danger">'.$count.'</span></p>');
			print('<table class="table">');
			foreach ($results as $data) {
				print('<tr>');
				print('<td>'.$data['reference'].'</td>');
				print('<td>'.$data['document_name'].'</td>');
				print('<td>'.$data['action_process_step'].'</td>');
				print('<td><span class="status-btn bg-green">'.$data['name'].'</span></td>');
				print('<td>'.$data['full_name'].'</td>');
				print('<td>'.$data['due_date'].'</td>');
				print('<td>'.$data['comments'].'</td>');
				print('</tr>');
			}
			print('</table>');

			print('<div class="text-center" id="paginated-links">');
            print('<ul class="pagination pagination-centered">');    
            	// Pagination Bootstrap Links.
            	$pagination->display_paginated_links();
            print('</ul>');    
            print('</div>');
		}
		else { print('Fail.'); }
	}

	public function action_tracker_pagination()
	{
		$this->load->model('Document_Tracker_Model');
		$document_tracker_model = new Document_Tracker_Model();

		# PAGINATION. -----------------------------------------------------------------------------------------
		$row_limit = 20;
		$page_limit = 10;
		$curr_page = 1;
		$row_count = 0;

		if(  intval(trim($this->input->get('page'))) )
		{
		  $curr_page = intval($this->input->get('page'));
		}

		$pagination = new Pagination($row_limit, $page_limit, $curr_page);

		# use class variables to include offset and limit.
		$offset = $pagination->get_offset($curr_page);

		// Pass the row limit and offset in the query.
		$results = $document_tracker_model->get_all_action_tracks($row_limit, $offset);
		$count = $results['count'];
		unset($results['count']);;

		// Pass count in pagination.
		$pagination->get_query_count($count);

		# END OF PAGINATION. -----------------------------------------------------------------------------------

		$header_data = array();
		$model_data = array();
		$footer_data = array();

		// Put results.
		$model_data['results'] = $results;
		$model_data['count'] = $count;
		$model_data['pagination'] = $pagination;
		$model_data['limit'] = $row_limit;
		$model_data['current_user_id'] = $this->session->userdata('session');

		$footer_data['listeners'] = array('Module.Paginate_Action_Tracks.listen_pagination_links()', 'Module.module1.filterMasterActionTracker()');
		//$footer_data['listeners'] = array();

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'action_tracker/action-tracker-list-new-pagination', $model_data );
		$this->load->view( 'layout/footer_2', $footer_data );
	}

	public function create() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$user_id = $this->session->userdata( 'session' );

			//var_dump($data);
			//check if data variables exist
			if ( !isset( $document_id ) ) {
				$document_id = null;
				
			}else{
				$document_code = $document_model->get_value($document_id, 'code');
				$reference_document_code = @explode('-',$document_code);
				$reference_document_code = $reference_document_code[0];

			}

			if ( !isset( $reference ) ) {
				$reference = '';
			}

			if ( !isset( $action_process ) ) {
				$action_process = '';
			}

			if ( !isset( $action_tracker_status ) ) {
				$action_tracker_status = null;
			}

			if ( !isset( $owner ) ) {
				$owner = '';
			}

			if ( !isset( $due_date ) ) {
				$due_date = null;
			}else{
				$due_date = convert_string_to_date($due_date);
			}

			if ( !isset( $comments ) ) {
				$comments = '';
			}

			if ( !isset( $author ) ) {
				$author = $user_id;
			}

			$action_tracker_id = $document_model->create_master_action_tracker( $document_id, $reference, $action_process, $action_tracker_status, $owner, $due_date, $comments , $author);

			if(isset($document_id) && $reference == ''){
				$reference = $reference_document_code.'-'.$action_tracker_id;
				$document_model->update_value($action_tracker_id, 'reference', $reference, 'action_tracker', 'action_tracker_id');
			}

			//echo $action_tracker_id;

			if ( !isset( $ajax_add ) ) {
				redirect( 'action-tracker' );
			}

			redirect('action-tracker');


		}
	}

	public function update_document_action_tracker(){

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$user_id = $this->session->userdata( 'session' );
			if ( !isset( $document_id ) ) {
				$document_id = null;
				
			}else{
				$document_code = $document_model->get_value($document_id, 'code');
				$reference_document_code = explode('-',$document_code);
				$reference_document_code = $reference_document_code[0];
				$reference = $reference_document_code.'-'.$action_tracker_id;
			}

			if ( !isset( $reference ) ) {
				$reference = '';
			}

			if ( !isset( $action_process ) ) {
				$action_process = '';
			}

			if ( !isset( $action_tracker_status ) ) {
				$action_tracker_status = null;
			}

			if ( !isset( $owner ) ) {
				$owner = '';
			}

			if ( !isset( $due_date ) ) {
				$due_date = null;
			}else{
				$due_date = convert_string_to_date($due_date);
			}

			if ( !isset( $comments ) ) {
				$comments = '';
			}

			if ( !isset( $author ) ) {
				$author = $user_id;
			}

			$document_model->update_document_action_tracker( $action_tracker_id, $action_process, $action_tracker_status, $owner, $due_date, $comments, $document_id, $reference );

		}
	}

	public function create_subaction() {

		$data = $this->input->post();

		if ( $data ) {

			$document_model = $this->document_model;

			extract( $data, EXTR_SKIP );

			$subaction_tracker_id = $document_model->create_subaction_tracker( $action_tracker_id, $owner, $author );

			echo json_encode( $subaction_tracker_id );

		}
	}

	public function update() { //updates action tracker

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;



			//var_dump($data);
			//check if variables exist
			if ( !isset( $action_document ) || $action_document == 'null' ) {
				$action_document = null;
			}

			if ( !isset( $reference_code ) ) {
				$reference_code = '';
			}

			if ( !isset( $location ) || $location == 'null' ) {
				$location = null;
			}

			//check dates
			if ( $due_date != '' ) {
				$due_date = convert_string_to_date( $due_date );
			}
			else {
				$due_date = null;
			}
			if ( $entry_date != '' ) {
				$entry_date = convert_string_to_date( $entry_date );
			}
			else {
				$entry_date = null;
			}

			//category
			if ( $action_category == '' ) {
				$action_category = null;
			}

			//cv value
			$day = date( 'j' );
			$month = date( 'n' );
			$year = date( 'Y' );

			//
			$data_array = array();

		    $previous_owner = $document_model->get_value( $action_tracker_id, 'owner', 'action_tracker', 'action_tracker_id' );
		    $proposed_date = $document_model->get_value( $action_tracker_id, 'proposed_date', 'action_tracker', 'action_tracker_id' );
			
		    if($proposed_date == $due_date && $proposed_date != null){
		    	$document_model->update_value($action_tracker_id, 'reply', 'accepted', 'action_tracker', 'action_tracker_id');
		    }

			$document_model->update_single_action_tracker( $action_tracker_id, $action_process, $action_tracker_status, $owner, $due_date, $entry_date, $comments, $action_document, $action_category, $reference_code, $improvement, $location, $progress, $criticality_analysis_id, $author );

			$action_tracker_notification_values = $this->notify_owner_action_tracker($action_tracker_id, $previous_owner);

			$data_array['notification_values'] = $action_tracker_notification_values;
			

			if ( $action_document != null ) {
				$reference = $document_model->get_value( $action_document, 'code', 'document', 'document_id' );
				$ref_array = explode( "-", $reference );
				array_pop( $ref_array );
				$reference_code = implode( "-", $ref_array );
				$reference_code = strtoupper( $reference_code ).'-'.$action_tracker_id;
				$document_model->update_value( $action_tracker_id, 'reference', $reference_code, 'action_tracker', 'action_tracker_id' );
			}

			$return_value = $document_model->get_single_master_action_tracker( $action_tracker_id );

			//var_dump($reference_code);
			

			if ( $return_value->criticality_analysis_id != null ) {

				$this->load->model( 'Criticality_Analysis_Model' );
				$criticality_analysis_model = new Criticality_Analysis_Model();

				$cv_value = $criticality_analysis_model->get_cv_value( $day, $month, $year );

				$business_criticality_category_results = $criticality_analysis_model->get_business_criticality_category_results( $criticality_analysis_id );

				$pce_value = 0;
				$sce_value = 0;
				$ece_value = 0;
				$sis_value = 0;

				if ( count( $business_criticality_category_results ) > 0 ) {
					foreach ( $business_criticality_category_results as $business_result ) {
						$category_type = $this->get_menu_detail_value( $business_result->menu_id, 'criticality_equipment_category', 'menu', 'name' );
						if ( $category_type == 'Production Critical Equipment' ) {
							$pce_value = $business_result->value;
						}
						if ( $category_type == 'Safety Critical Equipment' ) {
							$sce_value = $business_result->value;
						}
						if ( $category_type == 'Environment Critical Equipment' ) {
							$ece_value = $business_result->value;
						}
						if ( $category_type == 'Safety Instrumented System' ) {
							$sis_value = $business_result->value;
						}
					}
				}

				//business category
				$data_array['pce_value'] = $pce_value;
				$data_array['sce_value'] = $sce_value;
				$data_array['ece_value'] = $ece_value;
				$data_array['sis_value'] = $sis_value;

				$data_array['pce'] = 'Y';
				$data_array['sce'] = 'Y';
				$data_array['ece'] = 'Y';
				$data_array['sis'] = 'Y';

				if ( $pce_value == 0 ) {
					$data_array['pce'] = 'N';
				}
				if ( $sce_value == 0 ) {
					$data_array['sce'] = 'N';
				}
				if ( $ece_value == 0 ) {
					$data_array['ece'] = 'N';
				}
				if ( $sis_value == 0 ) {
					$data_array['sis'] = 'N';
				}

				//cv_value
				$check_day = 0;
				$cv_flag = 0;
				foreach ( $cv_value as $cv ) {
					if ( $criticality_analysis_id == $cv->criticality_analysis_id ) {
						if ( $cv->day > $check_day ) {
							if ( $cv->day_cv != null ) {
								$data_array['cv'] = $cv->day_cv;
							}
							else {
								$data_array['cv'] = '0';
							}
							$check_day = $cv->day;
						}
						$cv_flag = 1;
					}
				}

				if ( $cv_flag == 0 ) {
					$data_array['cv'] = '0';
				}
				//end cv_value


				$current_sife_values = $criticality_analysis_model->get_criticality_analysis_history_current_day_values( $return_value->criticality_analysis_id );

				if ( count( $current_sife_values ) > 0 ) {
					$spf_id = $current_sife_values->day_spf;
					$obs_id = $current_sife_values->day_obs;
					$day_status_id = $current_sife_values->day_status;
					$availability_id = $current_sife_values->day_availability;

					$data_array['spf'] = $this->get_menu_detail_value( $spf_id, 'criticality_spf', 'menu', 'name' );
					$data_array['obs'] = $this->get_menu_detail_value( $obs_id, 'criticality_obs', 'menu', 'name' );
					$data_array['day_status'] = $this->get_menu_detail_value( $day_status_id, 'criticality_status', 'menu', 'name' );
					$data_array['availability'] = $this->get_menu_detail_value( $availability_id, 'criticality_availability', 'menu', 'name' );
				}
			}

			$data_array['asset'] = $this->get_menu_detail_value( $return_value->asset, 'criticality_asset', 'menu', 'name' );
			$data_array['tag_number'] = $return_value->tag_number;
			$data_array['code'] = $return_value->code;
			$data_array['cas'] = $return_value->cas;
			$data_array['reply'] = $return_value->reply;

			echo json_encode( $data_array );

		}
	}

	public function update_subaction() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;



			//var_dump($data);
			//check if variables exist
			if ( !isset( $action_document ) || $action_document == 'null' ) {
				$action_document = null;
			}

			if ( !isset( $reference_code ) ) {
				$reference_code = '';
			}

			if ( !isset( $location ) || $location == 'null' ) {
				$location = null;
			}

			//check dates
			if ( $due_date != '' ) {
				$due_date = convert_string_to_date( $due_date );
			}
			else {
				$due_date = null;
			}
			if ( $entry_date != '' ) {
				$entry_date = convert_string_to_date( $entry_date );
			}
			else {
				$entry_date = null;
			}

			//category
			if ( $action_category == '' ) {
				$action_category = null;
			}

			//cv value
			$day = date( 'j' );
			$month = date( 'n' );
			$year = date( 'Y' );

			$previous_owner = $document_model->get_value( $subaction_tracker_id, 'subaction_owner', 'subaction_tracker', 'subaction_tracker_id' );
			$proposed_date = $document_model->get_value( $subaction_tracker_id, 'proposed_date', 'subaction_tracker', 'subaction_tracker_id' );
			
		    if($proposed_date == $due_date && $proposed_date != null){
		    	$document_model->update_value($subaction_tracker_id, 'reply', 'accepted', 'subaction_tracker', 'subaction_tracker_id');
		    }

		    $data['reply'] = $document_model->get_value($subaction_tracker_id, 'reply', 'subaction_tracker', 'subaction_tracker_id');

			$document_model->update_single_subaction_tracker( $subaction_tracker_id, $action_process, $action_tracker_status, $owner, $due_date, $entry_date, $comments, $action_document, $action_category, $reference_code, $improvement, $location, $progress );
			$action_tracker_notification_values = $this->notify_owner_action_tracker($subaction_tracker_id, $previous_owner, 'subaction');

			if ( $action_document != null ) {
				$reference = $document_model->get_value( $action_document, 'code', 'document', 'document_id' );
				$ref_array = explode( "-", $reference );
				array_pop( $ref_array );
				$reference_code = implode( "-", $ref_array );
				$reference_code = strtoupper( $reference_code ).'-'.$subaction_tracker_id;
				$document_model->update_value( $subaction_tracker_id, 'subaction_reference', $reference_code, 'subaction_tracker', 'subaction_tracker_id' );
			}


			echo json_encode( $data );

		}
	}

	public function get_single_action_tracker($action_tracker_id){

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$action_tracker_details = $document_model->get_single_action_tracker($action_tracker_id);

		$json_array = array();

		$document_id = $action_tracker_details->document_id;
		$document_type = $action_tracker_details->document_name;
		$document_code = $action_tracker_details->code;
		$entry_date = convert_date_to_string($action_tracker_details->entry_date);
		$last_update = convert_date_to_string($action_tracker_details->last_update);
		$owner_id = $action_tracker_details->owner;
		$owner = $user_model->get_full_name( $owner_id );
		$due_date = convert_date_to_string($action_tracker_details->due_date);
		$action_process_step = $action_tracker_details->action_process_step;
		$comments = $action_tracker_details->comments;
		$status_id = $action_tracker_details->status;
		$status_color = $this->get_menu_detail_value( $status_id, 'action_tracker_status', 'menu', 'color_class' );
		$status_value = $this->get_menu_detail_value( $status_id, 'action_tracker_status', 'menu', 'name' );

		$status_value_lowercase = strtolower($status_value);

		switch($status_value_lowercase){
			case "open":
				$status_text_color = "text-success";
				break;
			case "closed":
				$status_text_color = "text-danger";
				break;
			case "due":
				$status_text_color = "text-warning";
				break;
		}

		$json_array['action_tracker_id'] = $action_tracker_id;
		$json_array['document_id'] = $document_id;
		$json_array['document_type'] = $document_type;
		$json_array['document_code'] = $document_code;
		$json_array['entry_date'] = $entry_date;
		$json_array['last_update'] = $last_update;
		$json_array['owner_id'] = $owner_id;
		$json_array['owner'] = $owner;
		$json_array['due_date'] = $due_date;
		$json_array['action_process_step'] = $action_process_step;
		$json_array['comments'] = $comments;
		$json_array['status_id'] = $status_id;
		$json_array['status_color'] = $status_color;
		$json_array['status_text_color'] = $status_text_color;
		$json_array['status_value'] = $status_value;

		echo json_encode($json_array);
	}

	public function get_action_tracker() {

		$ce_id = null;
		$test_data = '';

		$document_model = $this->document_model;
		$user_model = $this->user_model;
		$action_tracker_model = $this->main_model;

		$data = $this->input->post();

		$extract_result = false;

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			/*
			POST DATA

			main_filter
			sub_filter
			optional_filter
			optional_subfilter
			*/
			$current_user_id = $this->session->userdata( 'session' );

			// Pagination.
			# PAGINATION Phase 1----------------------------------------------------------------------------------
			# Establishing limits and offsets
			$row_limit = 20;
			$page_limit = 10;
			$curr_page = 1;
			$row_count = 0;

			if(  $this->input->post('page') )
			{
			  $curr_page = $this->input->post('page');
			}

			$pagination = new Pagination($row_limit, $page_limit, $curr_page);

			# use class variables to include offset and limit.
			$offset = $pagination->get_offset($curr_page);

			# END OF PAGINATION. -----------------------------------------------------------------------------------

			if($main_filter == 'basic-decf' || $main_filter == 'ofi'){

				switch($sub_filter){
					case "":
						$actions = $action_tracker_model->get_action_tracker_by_document_type($main_filter, $row_limit, $offset);
						break;
					case "due_now":
						$actions = $action_tracker_model->get_action_tracker_due_now($main_filter);
						break;
					case "overdue":
						$actions = $action_tracker_model->get_action_tracker_overdue($main_filter);
						break;
					case "system":

						if($optional_filter != '' && $optional_subfilter == ''){
							//selected system without subsystem
							$actions = $action_tracker_model->get_action_tracker_by_system($main_filter, $optional_filter);
							$test_data = 'with system no subsystem';
						}else if($optional_filter != '' && $optional_subfilter != ''){
							//with system and subsystem
							$actions = $action_tracker_model->get_action_tracker_by_subsystem($main_filter, $optional_subfilter);
							$test_data = 'with system and subsystem';
						}else{
							$test_data = 'not null system';
							$actions = $action_tracker_model->get_action_tracker_by_system($main_filter, null);
						}

						
						break;
					case "subsystem":
						$actions = $action_tracker_model->get_action_tracker_by_subsystem($main_filter, $optional_filter);
						break;
				}

			}else if($main_filter == 'project-plan'){

				switch($sub_filter){
					case "":
						$actions = $action_tracker_model->get_action_tracker_by_document_type($main_filter);
						break;
					case "due_now":
						$actions = $action_tracker_model->get_action_tracker_due_now($main_filter);
						break;
					case "overdue":
						$actions = $action_tracker_model->get_action_tracker_overdue($main_filter);
						break;
				}

			}else if($main_filter == 'critical equipment'){

				$ece_id = $this->get_menu_id_by_code('ECE', 'criticality_equipment_category');
				$pce_id = $this->get_menu_id_by_code('PCE', 'criticality_equipment_category');
				$sce_id = $this->get_menu_id_by_code('SCE', 'criticality_equipment_category');
				$sis_id = $this->get_menu_id_by_code('SIS', 'criticality_equipment_category');
				$mex_id = $this->get_menu_id_by_code('MEX', 'criticality_equipment_category');
				$eex_id = $this->get_menu_id_by_code('EEX', 'criticality_equipment_category');

				switch($sub_filter){
					case "all":
						$actions = $action_tracker_model->get_action_tracker_critical_equipment_all();
						break;
					case "environment":
						$ce_id = $ece_id;
						$actions = $action_tracker_model->get_action_tracker_critical_equipment_category($ce_id, 0);
						break;
					case "safety":
						$ce_id = $sce_id;
						$actions = $action_tracker_model->get_action_tracker_critical_equipment_category($ce_id, 1);
						break;
					case "production":
						$ce_id = $pce_id;
						$actions = $action_tracker_model->get_action_tracker_critical_equipment_category($ce_id, 1);
						break;
					case "tag_no":
						$actions = $action_tracker_model->get_action_tracker_critical_equipment_tag_no($optional_filter);
						break;
				}

			}else if($main_filter == null){
				$actions = $action_tracker_model->get_action_tracker_all();
			}else if($main_filter == "all"){
				$actions = $action_tracker_model->get_action_tracker_all();
			}

			// unset action count.
			/*$row_count = $actions['count'];
			unset($actions['count']);*/

			if( isset($actions['count']) ) { unset($actions['count']); }

			// Pagination. Phase 2 ----------------------------------------------------------------------
			// Pass the row limit and offset in the query.
			// Pass count in pagination.
			$pagination->get_query_count($row_count);

			// End. -------------------------------------------------------------------------------------

			$last_query = $this->db->last_query();

			/*var_dump($actions);*/
			$action_array = array();

			if($extract_result){
				if(!empty($actions)){
					foreach($actions as $action){

						$action_tracker_id = $action->action_tracker_id;
						$reference = $action->reference;
						$action_process = $action->action_process_step;
						$status_id = $action->status;
						$owner = $action->owner;
						$due_date = $action->due_date;
						$comments = $action->comments;

						$action_array[] = array(
							'action_tracker_id' => $action_tracker_id,
							'reference' => $reference,
							'action_process' => $action_process,
							'status_id' => $status_id,
							'owner' => $owner,
							'due_date' => $due_date,
							'comments' => $comments
						);
					}
				}
			}else{
				$action_array = $actions;
			}

			

			

			//TODO: 

			//action_tracker_id
			//reference
			//action_tracker_type
			//action_process
			//status_color
			//status_value
			//full_name
			//due_date
			//trimmed_comments
			//comments



			$existing_document_name_dropdown= '';
			$document_name_dropdown = '<option value="">&nbsp;</option>';

			$user_documents = $document_model->get_user_documents( $current_user_id );

			foreach ( $user_documents as $document ) {
				$existing_document_name_dropdown .= '<option value="'.$document->document_id.'">'.$document->code.': '.$document->name.'&nbsp;</option>';
			}

			//dropdowns
			$equipment_list = $document_model->get_master_action_tracker_equipment();

			$equipment_dropdown = '';

			foreach ( $equipment_list as $equipment ) {
				$equipment_dropdown .= '<option value="'.$equipment->criticality_analysis_id.'">'.$equipment->description.'&nbsp;</option>';
			}

			$status_dropdown = $this->get_dropdown_menu( null, 'action_tracker_status', 'menu', true, false, '' );
			$select_user_dropdown = $this->get_user_dropdown( ' ', true );

			$userdata = $user_model->get_all_records();



			$main_array = array(
				'table_data' 						=> $action_array,
				'last_query'						=> $last_query,
				'ce_id'								=> $ce_id,
				'test_data'							=> $test_data,
				'count'								=> $row_count,
				'pagination_data' => $pagination->generate_pagination_links()
				/*'status_dropdown' 					=> $status_dropdown,
				'user_option_values' 				=> $select_user_dropdown,
				'document_name_dropdown' 			=> $document_name_dropdown,
				'existing_document_name_dropdown' 	=> $existing_document_name_dropdown,
				'equipment_dropdown' 				=> $equipment_dropdown,*/
			);

			echo json_encode( $main_array );
		}
	}

	public function get_action_tracker_old() {

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$this->load->model( 'Criticality_Analysis_Model' );
		$criticality_analysis_model = new Criticality_Analysis_Model();

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			/*
			POST
			current_user_id
			owner
			status
			*/

			$action_tracker = $document_model->get_master_action_tracker( $owner, $status );

			$db_last_query = $this->db->last_query();

			//to do filter

			$existing_document_name_dropdown= '';
			$document_name_dropdown = '<option value="">&nbsp;</option>';

			$user_documents = $document_model->get_user_documents( $current_user_id );

			//cv value
			$day = date( 'j' );
			$month = date( 'n' );
			$year = date( 'Y' );

			$cv_value = $criticality_analysis_model->get_cv_value( $day, $month, $year );

			foreach ( $user_documents as $document ) {
				$existing_document_name_dropdown .= '<option value="'.$document->document_id.'">'.$document->code.': '.$document->name.'&nbsp;</option>';
			}

			//ACTION TRACKER ARRAY
			$action_tracker_array = array();

			$action_tracker_counter = 0;
			foreach ( $action_tracker as $item ) {

				$action_tracker_array[$action_tracker_counter] = array();

				$full_name = $user_model->get_short_name( $item->owner );

				$criticality_analysis_id = $item->criticality_analysis_id;
				$asset_id = $item->asset;
				$tag_number = $item->tag_number;
				$code = $item->code;
				$cas_id = $item->cas;


				//business category, spf, cv, obs, status
				if ( $criticality_analysis_id != null ) {
					$business_criticality_category_results = $criticality_analysis_model->get_business_criticality_category_results( $criticality_analysis_id );

					$pce_value = 0;
					$sce_value = 0;
					$ece_value = 0;
					$sis_value = 0;

					if ( count( $business_criticality_category_results ) > 0 ) {
						foreach ( $business_criticality_category_results as $business_result ) {
							$category_type = $this->get_menu_detail_value( $business_result->menu_id, 'criticality_equipment_category', 'menu', 'name' );
							if ( $category_type == 'Production Critical Equipment' ) {
								$pce_value = $business_result->value;
							}
							if ( $category_type == 'Safety Critical Equipment' ) {
								$sce_value = $business_result->value;
							}
							if ( $category_type == 'Environment Critical Equipment' ) {
								$ece_value = $business_result->value;
							}
							if ( $category_type == 'Safety Instrumented System' ) {
								$sis_value = $business_result->value;
							}
						}
					}

					//business category
					$action_tracker_array[$action_tracker_counter]['pce_value'] = $pce_value;
					$action_tracker_array[$action_tracker_counter]['sce_value'] = $sce_value;
					$action_tracker_array[$action_tracker_counter]['ece_value'] = $ece_value;
					$action_tracker_array[$action_tracker_counter]['sis_value'] = $sis_value;

					$action_tracker_array[$action_tracker_counter]['pce'] = 'Y';
					$action_tracker_array[$action_tracker_counter]['sce'] = 'Y';
					$action_tracker_array[$action_tracker_counter]['ece'] = 'Y';
					$action_tracker_array[$action_tracker_counter]['sis'] = 'Y';

					if ( $pce_value == 0 ) {
						$action_tracker_array[$action_tracker_counter]['pce'] = 'N';
					}
					if ( $sce_value == 0 ) {
						$action_tracker_array[$action_tracker_counter]['sce'] = 'N';
					}
					if ( $ece_value == 0 ) {
						$action_tracker_array[$action_tracker_counter]['ece'] = 'N';
					}
					if ( $sis_value == 0 ) {
						$action_tracker_array[$action_tracker_counter]['sis'] = 'N';
					}

					//cv_value
					$check_day = 0;
					$cv_flag = 0;
					foreach ( $cv_value as $cv ) {
						if ( $criticality_analysis_id == $cv->criticality_analysis_id ) {
							if ( $cv->day > $check_day ) {
								if ( $cv->day_cv != null ) {
									$action_tracker_array[$action_tracker_counter]['cv'] = $cv->day_cv;
								}
								else {
									$action_tracker_array[$action_tracker_counter]['cv'] = '0';
								}
								$check_day = $cv->day;
							}
							$cv_flag = 1;
						}
					}

					if ( $cv_flag == 0 ) {
						$action_tracker_array[$action_tracker_counter]['cv'] = '0';
					}
					//end cv_value

					//spf
					$current_sife_values = $criticality_analysis_model->get_criticality_analysis_history_current_day_values( $criticality_analysis_id );

					if ( count( $current_sife_values ) > 0 ) {
						$spf_id = $current_sife_values->day_spf;
						$obs_id = $current_sife_values->day_obs;
						$day_status_id = $current_sife_values->day_status;
						$availability_id = $current_sife_values->day_availability;

						$action_tracker_array[$action_tracker_counter]['spf'] = $this->get_menu_detail_value( $spf_id, 'criticality_spf', 'menu', 'name' );
						$action_tracker_array[$action_tracker_counter]['obs'] = $this->get_menu_detail_value( $obs_id, 'criticality_obs', 'menu', 'name' );
						$action_tracker_array[$action_tracker_counter]['day_status'] = $this->get_menu_detail_value( $day_status_id, 'criticality_status', 'menu', 'name' );
						$action_tracker_array[$action_tracker_counter]['availability'] = $this->get_menu_detail_value( $availability_id, 'criticality_availability', 'menu', 'name' );
					}

				}

				$action_tracker_id = $item->action_tracker_id;
				$document_id = $item->document_id;
				$last_query = $db_last_query;
				$reference = $item->reference;
				$action_process = $item->action_process_step;
				$status_id = $item->status;
				$type_of_improvement_id = $item->improvement_type;
				$category_id = $item->category;
				$location_id = $item->location;
				$progress_id = $item->pg;
				$status = $this->get_menu_detail_value( $status_id, 'action_tracker_status', 'menu', 'color_class' );
				$status_value = $this->get_menu_detail_value( $status_id, 'action_tracker_status', 'menu', 'name' );
				$category = $this->get_menu_detail_value( $category_id, 'equipment_category', 'menu', 'name' );
				$document_name = $item->name;
				$document_code = $item->doc_code;
				$due_date = '';
				$entry_date = '';
				$reply = $item->reply ?: '';
				$author_name = $user_model->get_full_name( $item->author );
				$author_id = $item->author;

				if($document_id != null){
					$document_type_code = explode('-', $document_code);
					$document_type_code = $document_type_code[0];
				}

				//check action tracker type
				if($document_id != null && $criticality_analysis_id != null){
					$action_tracker_type = $document_type_code.'/CE';
					$action_tracker_popup_type = 'document-ce';
				}else if($document_id == null && $criticality_analysis_id != null){
					$action_tracker_type = 'CE';
					$action_tracker_popup_type = 'ce';
				}else if($document_id != null && $criticality_analysis_id == null){
					$action_tracker_type = $document_type_code;
					$action_tracker_popup_type = 'document';
				}else{
					$action_tracker_type = 'None';
					$action_tracker_popup_type = 'none';
				}


				//uploads
				$action_tracker_uploads = $document_model->get_files_master_action_tracker( $action_tracker_id, null );

				$upload_counter = 0;
				$upload_array = array();
				foreach ( $action_tracker_uploads as $upload ) {
					$upload_array[$upload_counter]['filename'] = $upload->filename;
					$upload_counter++;
				}

				$action_tracker_array[$action_tracker_counter]['uploads'] = $upload_array;

				//end uploads

				if ( $item->due_date != null ) {
					$due_date = convert_date_to_string( $item->due_date, false, false, 'j/n/y' );
				}
				if ( $item->entry_date != null ) {
					$entry_date = convert_date_to_string( $item->entry_date, false, false, 'j/n/y' );
				}

				if ( $document_code ==null ) {
					$document_code = '';
				}



				if ( $document_name == '' ) {
					$document_name = ' ';
				}
				$document_name_dropdown .= '<option value="'.$document_id.'">'.$document_code.': '.$document_name.'&nbsp;</option>';


				$action_tracker_array[$action_tracker_counter]['last_query'] = $last_query;
				$action_tracker_array[$action_tracker_counter]['action_tracker_type'] = $action_tracker_type;
				$action_tracker_array[$action_tracker_counter]['action_tracker_popup_type'] = $action_tracker_popup_type;

				//SIFE
				$action_tracker_array[$action_tracker_counter]['asset'] = $this->get_menu_detail_value( $asset_id, 'criticality_asset', 'menu', 'name' );
				$action_tracker_array[$action_tracker_counter]['tag_number'] = $tag_number;
				$action_tracker_array[$action_tracker_counter]['criticality_analysis_id'] = $criticality_analysis_id;
				$action_tracker_array[$action_tracker_counter]['equipment_description'] = $document_model->get_value( $criticality_analysis_id, 'description', 'criticality_analysis', 'criticality_analysis_id' );
				$action_tracker_array[$action_tracker_counter]['action_tracker_id'] = $action_tracker_id;
				$action_tracker_array[$action_tracker_counter]['code'] = $code;
				$action_tracker_array[$action_tracker_counter]['cas'] =  $this->get_menu_detail_value( $cas_id, 'criticality_score', 'menu', 'name' );

				$action_tracker_array[$action_tracker_counter]['action_tracker_id'] = $action_tracker_id;
				$action_tracker_array[$action_tracker_counter]['reference'] = $reference;
				$action_tracker_array[$action_tracker_counter]['action_process'] = $action_process;
				$action_tracker_array[$action_tracker_counter]['status'] = $this->get_dropdown_menu( $item->status, 'action_tracker_status', 'menu', true, false, '' );

				$action_tracker_array[$action_tracker_counter]['improvement_id'] = $type_of_improvement_id;
				$action_tracker_array[$action_tracker_counter]['improvement']  = $this->get_dropdown_menu( $type_of_improvement_id, 'action_tracker_types_of_improvement', 'menu', true, false, '' );

				$action_tracker_array[$action_tracker_counter]['category_id'] = $category_id;
				$action_tracker_array[$action_tracker_counter]['category']  = $this->get_dropdown_menu( $category_id, 'equipment_category', 'menu', true, false, '' );

				$action_tracker_array[$action_tracker_counter]['location_id'] = $location_id;
				$action_tracker_array[$action_tracker_counter]['location']  = $this->get_dropdown_menu( $location_id, 'action_tracker_location', 'menu', true, false, '' );

				$action_tracker_array[$action_tracker_counter]['progress_id'] = $progress_id;
				$action_tracker_array[$action_tracker_counter]['progress']  = $this->get_dropdown_menu( $progress_id, 'action_tracker_progress', 'menu', true, false, '' );

				if ( $status != null ) {
					$action_tracker_array[$action_tracker_counter]['status_id'] = $status_id;
					$action_tracker_array[$action_tracker_counter]['status_value'] = $status_value;
					$action_tracker_array[$action_tracker_counter]['status_color'] = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'color_class' );
				}
				else {
					$action_tracker_array[$action_tracker_counter]['status_color'] = 'bg-white';
					$action_tracker_array[$action_tracker_counter]['status_value'] = $status_value;
				}

				$action_tracker_array[$action_tracker_counter]['document_id'] = $document_id;
				$action_tracker_array[$action_tracker_counter]['document_name'] = $document_name;
				$action_tracker_array[$action_tracker_counter]['document_code'] = $document_code;
				$action_tracker_array[$action_tracker_counter]['owner'] = $item->owner;
				$action_tracker_array[$action_tracker_counter]['due_date'] = $due_date;
				$action_tracker_array[$action_tracker_counter]['entry_date'] = $entry_date;
				$action_tracker_array[$action_tracker_counter]['comments'] = $item->comments;
				$action_tracker_array[$action_tracker_counter]['trimmed_comments'] = truncate($item->comments, 38);
				$action_tracker_array[$action_tracker_counter]['full_name'] = $full_name.'&nbsp;';
				$action_tracker_array[$action_tracker_counter]['author_name'] = $author_name;
				$action_tracker_array[$action_tracker_counter]['author_id'] = $author_id;
				$action_tracker_array[$action_tracker_counter]['reply'] = $reply;


				$action_tracker_counter++;
			}

			$subaction_tracker = $document_model->get_subaction_tracker();
			//SUB ACTION TRACKER ARRAY
			$subaction_tracker_array = array();
			$subaction_tracker_counter = 0;

			foreach ( $subaction_tracker as $subaction ) {

				$doc_name = $subaction->name;
				$doc_code = $subaction->doc_code;
				$comments = $subaction->subaction_comments;
				$entry_date = '';
				$due_date = '';
				$reply = $subaction->reply ?: '';
				$author_name = $user_model->get_full_name( $subaction->author );
				$author_id = $subaction->author;

				if ( $subaction->subaction_due_date != null ) {
					$due_date = convert_date_to_string( $subaction->subaction_due_date, false, false, 'j/n/y' );
				}
				if ( $subaction->subaction_entry_date != null ) {
					$entry_date = convert_date_to_string( $subaction->subaction_entry_date, false, false, 'j/n/y' );
				}

				if ( $subaction->name == null ) {
					$doc_name = '';
				}

				if ( $subaction->doc_code == null ) {
					$doc_code = '';
				}

				if ( $subaction->subaction_comments == null ) {
					$comments = '';
				}

				//uploads
				$subaction_tracker_uploads = $document_model->get_files_master_action_tracker( null, $subaction->subaction_tracker_id );

				$upload_counter = 0;
				$upload_array = array();

				foreach ( $subaction_tracker_uploads as $upload ) {
					$upload_array[$upload_counter]['filename'] = $upload->filename;
					$upload_counter++;
				}

				$subaction_tracker_array[$subaction_tracker_counter]['uploads'] = $upload_array;

				//end upload

				$subaction_full_name = $user_model->get_short_name( $subaction->subaction_owner );

				$subaction_tracker_array[$subaction_tracker_counter]['subaction_tracker_id'] = $subaction->subaction_tracker_id;
				$subaction_tracker_array[$subaction_tracker_counter]['action_tracker_id'] = $subaction->action_tracker_id;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_document_id'] = $subaction->document_id;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_document_code'] = $doc_code;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_document_name'] = $doc_name;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_process'] = $subaction->subaction_process_step;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_owner'] = $subaction->subaction_owner;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_entry_date'] = $entry_date;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_due_date'] = $due_date;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_comments'] = $comments;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_tracker_id'] = $subaction->subaction_tracker_id;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_status'] = $this->get_dropdown_menu( $subaction->subaction_status, 'action_tracker_status', 'menu', true, false, '' );
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_full_name'] = $subaction_full_name.'&nbsp;';

				$subaction_tracker_array[$subaction_tracker_counter]['subaction_improvement_id'] = $subaction->subaction_improvement_type;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_improvement'] = $this->get_dropdown_menu( $subaction->subaction_improvement_type, 'action_tracker_types_of_improvement', 'menu', true, false, '' );

				$subaction_tracker_array[$subaction_tracker_counter]['subaction_category_id'] = $subaction->subaction_group;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_category'] = $this->get_dropdown_menu( $subaction->subaction_group, 'equipment_category', 'menu', true, false, '' );

				$subaction_tracker_array[$subaction_tracker_counter]['subaction_location_id'] = $subaction->subaction_location;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_location'] = $this->get_dropdown_menu( $subaction->subaction_location, 'action_tracker_location', 'menu', true, false, '' );

				$subaction_tracker_array[$subaction_tracker_counter]['subaction_progress_id'] = $subaction->subaction_progress;
				$subaction_tracker_array[$subaction_tracker_counter]['subaction_progress'] = $this->get_dropdown_menu( $subaction->subaction_progress, 'action_tracker_progress', 'menu', true, false, '' );

				if ( $subaction->subaction_status != null ) {
					$subaction_tracker_array[$subaction_tracker_counter]['subaction_status_id'] = $subaction->subaction_status;
					$subaction_tracker_array[$subaction_tracker_counter]['subaction_status_color'] = $this->get_menu_detail_value( $subaction->subaction_status, 'action_tracker_status', 'menu', 'color_class' );
				}
				else {
					$subaction_tracker_array[$subaction_tracker_counter]['subaction_status_color'] = 'bg-white';
				}

				$subaction_tracker_array[$subaction_tracker_counter]['author_name'] = $author_name;
				$subaction_tracker_array[$subaction_tracker_counter]['author_id'] = $author_id;
				$subaction_tracker_array[$subaction_tracker_counter]['reply'] = $reply;

				$subaction_tracker_counter++;

			}

			//$model_data['upload_error'] = '';



			//dropdowns
			$equipment_list = $document_model->get_master_action_tracker_equipment();

			$equipment_dropdown = '';

			foreach ( $equipment_list as $equipment ) {
				$equipment_dropdown .= '<option value="'.$equipment->criticality_analysis_id.'">'.$equipment->description.'&nbsp;</option>';
			}

			$defect_elimination_dropdown = $this->get_simple_dropdown_menu( 'criticality_defect_elimination', 'N/A' );
			$project_plan_dropdown = $this->get_simple_dropdown_menu( 'criticality_project_plan', 'N/A' );
			$technical_bulletin_dropdown = $this->get_simple_dropdown_menu( 'criticality_technical_bulletin', 'N/A' );

			$status_dropdown = $this->get_dropdown_menu( null, 'action_tracker_status', 'menu', true, false, '' );


			$select_user_dropdown = $this->get_user_dropdown( ' ', true );

			$userdata = $user_model->get_all_records();



			$main_array = array(
				'table_data' => $action_tracker_array,
				'status_dropdown' => $status_dropdown,
				//'group_dropdown' => $group_dropdown,
				'user_option_values' => $select_user_dropdown,
				'document_name_dropdown' => $document_name_dropdown,
				'existing_document_name_dropdown' => $existing_document_name_dropdown,
				'de_dropdown' => $defect_elimination_dropdown,
				'pp_dropdown' => $project_plan_dropdown,
				'tb_dropdown' => $technical_bulletin_dropdown,
				'equipment_dropdown' => $equipment_dropdown,
				'subaction_table_data' => $subaction_tracker_array
			);

			echo json_encode( $main_array );
		}
	}

	public function delete_action_tracker() {
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$subactions = $document_model->get_subaction_tracker( $action_tracker_id );

			foreach ( $subactions as $subaction ) {
				$subaction_id = $subaction->subaction_tracker_id;
				$this->multiple_unlink_file( true, $subaction_id, false, true );
				$document_model->delete_value( $subaction_id, 'subaction_tracker', 'subaction_tracker_id' );
			}

			$this->multiple_unlink_file( true, $action_tracker_id, true, false );
			$document_model->delete_value( $action_tracker_id, 'action_tracker', 'action_tracker_id' );

		}
	}

	public function delete_subaction_tracker() {
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model->delete_value( $subaction_tracker_id, 'subaction_tracker', 'subaction_tracker_id' );
			$this->multiple_unlink_file( true, $subaction_tracker_id, false, true );
		}
	}

	public function upload() {

		$upload_config = $this->file_config;
		$this->load->library( 'upload', $upload_config );

		$data = $this->input->post();

		//var_dump($data);

		if ( $data ) {

			$document_model = $this->document_model;

			extract( $data, EXTR_SKIP );

			$uploads_folder = $this->uploads_folder;

			$absolute_path = FCPATH.$uploads_folder."\\";

			$filenames = array();
			$errors = array();

			//var_dump($_FILES);

			$files = $_FILES;

			$cpt = count( $_FILES['userfile']['name'] );

			$check_file = array();

			for ( $i=0; $i<$cpt; $i++ ) {

				$single_name = $files['userfile']['name'][$i];

				$single_filename = get_filename( $single_name );
				$single_filename = generate_slug( $single_filename );
				$single_extension = get_filename_extension( $single_name );

				$single_new_name = $single_filename.'.'.$single_extension;



				$single_type = $files['userfile']['type'][$i];
				$single_tmp_name = $files['userfile']['tmp_name'][$i];
				$single_error = $files['userfile']['error'][$i];
				$single_size = $files['userfile']['size'][$i];

				$_FILES['userfile']['name']= $single_new_name;
				$_FILES['userfile']['type']= $single_type;
				$_FILES['userfile']['tmp_name']= $single_tmp_name;
				$_FILES['userfile']['error']= $single_error;
				$_FILES['userfile']['size']= $single_size;

				$this->upload->initialize( $upload_config );


				if ( ! $this->upload->do_upload() ) {
					if ( $single_name != '' ) {
						$errors[] = array(
							'filename' => $single_new_name,
							'error' => $this->upload->display_errors( '', '' )
						);
					}

					$filenames[$i] = '';
					$check_file[$i]['checked'] = 0;
				}else {
					$upload_data = $this->upload->data();
					$filenames[$i] = $upload_data['file_name'];
					$check_file[$i]['checked'] = 1;
				}

			}




			if ( !isset( $action_tracker_id ) ) {
				$action_tracker_id = null;
			}

			if ( !isset( $subaction_tracker_id ) ) {
				$subaction_tracker_id = null;
			}

			$document_model->create_file_action_tracker( $action_tracker_id, $subaction_tracker_id, $filenames );


			$files = $document_model->get_files_master_action_tracker( $action_tracker_id, $subaction_tracker_id );

			//errors
			$error_message = '';
			if ( count( $errors )>0 ) {

				foreach ( $errors as $error ) {
					if ( $error['filename'] ) {
						$error_message = '<p>'.$error_message.' &nbsp; '.$error['filename'].' - '.$error['error'].'</p>';
					}
				}

			}

			//return uploads
			$upload_counter = 0;
			$upload_array = array();

			foreach ( $files as $file ) {
				$upload_array[$upload_counter]['filename'] = $file->filename;
				$upload_counter++;
			}

			$main_array = array(
				'errors' => $error_message,
				'upload_data' => $upload_array,
				'file_check' => $check_file
			);

			echo json_encode( $main_array );
		}
	}

	public function get_action_tracker_document_owner() {
		$document_model = $this->document_model;

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$existing_document_name_dropdown= '';
			$user_documents = $document_model->get_user_documents( $current_user_id );

			foreach ( $user_documents as $document ) {
				$existing_document_name_dropdown .= '<option value="'.$document->document_id.'">'.$document->code.': '.$document->name.'&nbsp;</option>';
			}

			echo json_encode( $existing_document_name_dropdown );

		}
	}

	public function accept($action_tracker_id, $subaction = 0){

		$document_model = $this->document_model;

		$this->session->set_flashdata( 'action_tracker_id', $action_tracker_id );
		$this->session->set_flashdata( 'subaction', $subaction);

		if($subaction == 1){
			$document_model->update_value($action_tracker_id, 'reply', 'accepted', 'subaction_tracker', 'subaction_tracker_id');
			redirect('action-tracker');
		}else if($subaction == 0){
			$document_model->update_value($action_tracker_id, 'reply', 'accepted', 'action_tracker', 'action_tracker_id');
			redirect('action-tracker');
		}else{
			redirect();
		}
	}

	public function reject($action_tracker_id, $subaction = 0){

		$document_model = $this->document_model;

		$this->session->set_flashdata( 'action_tracker_id', $action_tracker_id );
		$this->session->set_flashdata( 'subaction', $subaction);

		if($subaction == 1){
			$document_model->update_value($action_tracker_id, 'reply', 'rejected', 'subaction_tracker', 'subaction_tracker_id');
			redirect('action-tracker');
		}else if($subaction == 0){
			$document_model->update_value($action_tracker_id, 'reply', 'rejected', 'action_tracker', 'action_tracker_id');
			redirect('action-tracker');
		}else{
			redirect();
		}
	}

	public function propose_date($action_tracker_id, $subaction = 0){

		$document_model = $this->document_model;

		$this->session->set_flashdata( 'action_tracker_id', $action_tracker_id );
		$this->session->set_flashdata( 'subaction', $subaction);

		$header_data = array();

		$model_data = array(
			'action_tracker_id' => $action_tracker_id,
			'subaction' => $subaction
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'action_tracker/propose-date', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function submit_date_proposal(){

		$document_model = $this->document_model;

		$action_tracker_id = $this->input->post('action_tracker_id');
		$subaction = $this->input->post('subaction');
		$propose_date = $this->input->post('propose_date');
		$proposed_date = convert_string_to_date($propose_date);
		//$comment = $this->input->post('comment');

		//echo $propose_date;

		if($subaction == 1){
			$document_model->update_value($action_tracker_id, 'proposed_date', $proposed_date, 'subaction_tracker', 'subaction_tracker_id');
			$document_model->update_value($action_tracker_id, 'reply', 'proposed date to '.$propose_date , 'subaction_tracker', 'subaction_tracker_id');
			redirect('action-tracker');
		}else if($subaction == 0){
			$document_model->update_value($action_tracker_id, 'proposed_date', $proposed_date ,'action_tracker', 'action_tracker_id');
			$document_model->update_value($action_tracker_id, 'reply', 'proposed date to '.$propose_date, 'action_tracker', 'action_tracker_id');
			redirect('action-tracker');
		}else{
			redirect();
		}
	}

	public function get_action_tracker_past_due_date($result = "json"){

		$main_model = $this->main_model;

		$results = $main_model->get_action_tracker_past_due_date();

		$model_data = array(
			'action_trackers' => $results
		);

		switch($result){
			case "json":
				echo json_encode($results);
				break;

			case "table":
				echo $this->load->view( 'action_tracker/action-tracker-due-date', $model_data, true);
				break;

			case "object":
				return $results;
				break;
		}
	}

	public function notify_action_tracker_past_due_date(){

		$main_model = $this->main_model;

		$results = $this->get_action_tracker_past_due_date("object");

		foreach($results as $info){

			$action_tracker_id = $info->action_tracker_id;
			$email_address = $info->email_address;
			$fullname = $info->first_name . ' ' . $info->last_name;
			$action_tracker = $info->action_process_step;
			$due_date = convert_date_to_string($info->due_date);
			$notification_sent = $info->due_date_notification_sent;

			if($notification_sent != 1){

				$message = "Hi " . $fullname . ", ";
				$message .= "\n";
				$message .= "Action Tracker with name of " . $action_tracker . " has already passed its due date which is " . $due_date;

				echo $message;
				echo '<br>';

				$main_model->update_value($action_tracker_id, 'due_date_notification_sent', 1);
				$this->basic_send_mail($email_address, 'Action Tracker Past Due Date', $message);


			}

		}
	}

	public function get_allowed_documents_for_action_tracker(){

		$this->load->model('Document_Model');
		$document_model = new Document_Model;

		$documents = $document_model->get_allowed_documents_for_action_tracker();

		$options = "";

		foreach($documents as $document){
			var_dump($document);
		}
	}

	public function get_sub_filter(){

		$option = $this->input->post('main_filter');

		

		switch($option){
			case "all":
				$options = '<option value="">N/A</option>';
				break;
			case "basic-decf":
				$options = '<option value="">N/A</option>';
				$options .= '<option value="due_now">Due Now (<1 Week)</option>';
				$options .= '<option value="overdue">Overdue</option>';
				$options .= '<option value="system">System</option>';
				$options .= '<option value="subsystem">Subsystem</option>';
				break;
			case "ofi":
				$options = '<option value="">N/A</option>';
				$options .= '<option value="due_now">Due Now (<1 Week)</option>';
				$options .= '<option value="overdue">Overdue</option>';
				$options .= '<option value="system">System</option>';
				$options .= '<option value="subsystem">Subsystem</option>';	
				break;
			case "project-plan":
				$options = '<option value="">N/A</option>';
				$options .= '<option value="due_now">Due Now (<1 Week)</option>';
				$options .= '<option value="overdue">Overdue</option>';
				break;
			case "critical equipment":
				$options = '<option value="all">All</option>';
				$options .= '<option value="environment">Environment</option>';
				$options .= '<option value="safety">Safety</option>';
				$options .= '<option value="production">Production</option>';
				$options .= '<option value="tag_no">Tag No</option>';
				break;
			case "incident":

				break;
			case "verification anomaly":

				break;
			default:

				break;
		}

		echo $options;
	}

	public function get_optional_dropdown($document_code, $filter, $optional_filter = null){

		$action_tracker_model = $this->main_model;

		switch($filter){
			case "system":
				$dropdown = $this->get_dropdown_menu( null, 'system', 'menu', true, false, 'N/A' );
				break;
			case "subsystem":
				$dropdown = $this->get_all_subcategories_dropdown( null, 'system', true, false, 'N/A' );
				break;
			case "system_subsystem":
				//$dropdown = $optional_filter;
				$dropdown = $this->get_dropdown_subcategory( $optional_filter, 'system', '', null, 'N/A');
				break;
		}

		return $dropdown;
	}

	public function get_optional_filter(){

		$main_filter = $this->input->post('main_filter');
		$sub_filter = $this->input->post('sub_filter');

		$filter_data = array(
				'display_optional_filter' => false
			);


		$options = '<option value="">N/A</option>';

		if($main_filter == 'basic-decf' || $main_filter == 'ofi'){

			switch($sub_filter){
				case "due_now":

					break;
				case "overdue":
					break;
				case "system":
					$filter_data['display_optional_filter'] = true;
					$filter_data['options'] = $this->get_optional_dropdown($main_filter, $sub_filter);
					break;
				case "subsystem":
					$filter_data['display_optional_filter'] = true;
					$filter_data['options'] = $this->get_optional_dropdown($main_filter, $sub_filter);
					break;
			}

		}else if($main_filter == 'project-plan'){

			switch($sub_filter){
				case "due_now":

					break;
				case "overdue":
					break;
			}

		}else if($main_filter == 'critical equipment'){

			switch($sub_filter){
				case "all":

					break;
				case "environment":
					
					break;

				case "safety":

					break;
				case "production":

					break;

				case "tag_no":

					break;
			}

		}

		

		echo json_encode($filter_data);
	}

	public function get_optional_subfilter(){

		$main_filter = $this->input->post('main_filter');
		$sub_filter = $this->input->post('sub_filter');
		$optional_filter = $this->input->post('optional_filter');

		$filter_data = array(
				'display_optional_subfilter' => false
			);


		$options = '<option value="">N/A</option>';

		if($sub_filter == 'system' && $optional_filter != ''){
			$sub_filter_response = 'system_subsystem';
			$filter_data['display_optional_filter'] = true;
			$filter_data['options'] = $this->get_optional_dropdown($main_filter, $sub_filter_response, $optional_filter);
			$filter_data['last_query'] = $this->db->last_query();
		}

		

		echo json_encode($filter_data);
	}

}

/* End of file action_tracker.php */
/* Location: ./application/controllers/action_tracker.php */
