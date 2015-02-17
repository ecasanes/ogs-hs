<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Reliability_Maintenance extends MY_Controller {

	public function __construct(){

	    parent::__construct();

	    $user_model = new User_Model();

	    $this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();
		
	}

	public function index(){
		redirect('reliability-maintenance/condition_monitoring');
	}

	public function condition_monitoring(){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		if($session_site_role == 'admin' || $session_site_role == 'siteadmin'){
			$hidden_display = '';
		}else{
			$hidden_display = 'hidden';
		}

		$header_data = array(
			'container_class' => 'fixed',
			'container_size' => 'sm'
		);

		$model_data = array(
			'session_site_role' => $session_site_role,
			'hidden_display' => $hidden_display
		);

		
		


		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'reliability_maintenance/condition-monitoring', $model_data );
		$this->load->view( 'layout/footer');

	}

	public function project_tracker(){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		if($session_site_role == 'admin' || $session_site_role == 'siteadmin'){
			$hidden_display = '';
		}else{
			$hidden_display = 'hidden';
		}

		$header_data = array(
			'container_class' => 'fixed',
			'container_size' => 'sm'
		);

		$model_data = array(
			'session_site_role' => $session_site_role,
			'hidden_display' => $hidden_display
		);
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$model_data['current_user_id'] = $user_id;
		$model_data['project_condition_dropdown'] = $this->get_dropdown_menu( '', 'project_condition');
		$model_data['work_party_dropdown'] = $this->get_dropdown_menu( '', 'work_party' );

		$footer_data['modals'] = array('project-tracker-modal');

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'reliability_maintenance/project-tracker', $model_data );
		$this->load->view( 'layout/footer',$footer_data  );

	}

	public function get_project_tracker() {

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$this->load->model( 'Project_Tracker_Model' );
		$project_tracker_model = new Project_Tracker_Model();

		$user_id = $this->session->userdata( 'session' );

		


		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			/*if($project_number == ''){
				$project_number = null;
			}*/

			//var_dump($data);

			$project_tracker = $project_tracker_model->get_project_tracker_list( $project_name, $project_number, $author, $start_date, $project_condition, $work_party ); //to do

			//to do filter

			//PROJECT TRACKER ARRAY
			$project_tracker_array = array();

			$project_tracker_counter = 0;
			foreach ( $project_tracker as $item ) {

				$project_tracker_array[$project_tracker_counter] = array();

				$document_id = $item->document_id;

				$document_creator = $project_tracker_model->get_value( $document_id,'user_id', 'document_owner', 'document_id' );
				
				$project_plan_id = $item->project_plan_id;
				$document_id = $item->document_id;

				$disabled = '';

				if($user_id != $document_creator){
					$disabled = 'disabled';
				}


				$follow_status = $document_model->get_user_document_follow_status($document_id, $user_id);
				//$follow_status = 1;

				if($follow_status == 1){
					$check_class = 'fa-check-square-o';
				}else{
					$check_class = 'fa-square-o';
				}

				$name = $item->project_name;
				$code = $item->code;
				$estimated_total = $item->cost_breakdown_estimated_total;
				$actual_total = $item->cost_breakdown_actual_total;
				$author = $item->author;
				$start_date = convert_date_to_string($item->estimated_start_date,true);
				$project_condition = $item->project_condition_id;
				$work_party = $item->work_party_id;

				if($author == null){
					$author = '';
				}



				$project_tracker_array[$project_tracker_counter]['document_id'] = $document_id;
				$project_tracker_array[$project_tracker_counter]['project_plan_id'] = $project_plan_id;
				$project_tracker_array[$project_tracker_counter]['name'] = $name;
				$project_tracker_array[$project_tracker_counter]['code'] = $code;
				$project_tracker_array[$project_tracker_counter]['author'] = $author;
				$project_tracker_array[$project_tracker_counter]['estimated_total'] = $estimated_total;
				$project_tracker_array[$project_tracker_counter]['actual_total'] = $actual_total;
				$project_tracker_array[$project_tracker_counter]['start_date'] = $start_date;
				$project_tracker_array[$project_tracker_counter]['disabled'] = $disabled;
				$project_tracker_array[$project_tracker_counter]['project_condition'] = $this->get_menu_detail_value( $project_condition, 'project_condition', 'menu', 'name' );
				$project_tracker_array[$project_tracker_counter]['work_party'] = $this->get_menu_detail_value( $work_party, 'work_party', 'menu', 'name' );
				//$project_tracker_array[$project_tracker_counter]['follow_status'] = $follow_status;
				$project_tracker_array[$project_tracker_counter]['check_class'] = $check_class;
				$project_tracker_array[$project_tracker_counter]['updates_url'] = base_url('project-plan/updates/'.$document_id);

				$project_tracker_counter++;
			}

			//dropdowns here

			$main_array = array(
				'table_data' => $project_tracker_array,
			);

			echo json_encode( $main_array );
		}
	}


	public function get_cost_breakdown_per_id($document_id){	

		$this->load->model( 'Project_Tracker_Model' );
		$project_tracker_model = new Project_Tracker_Model();

		$user_id = $this->session->userdata( 'session' );


			$document_creator = $project_tracker_model->get_value( $document_id,'user_id', 'document_owner', 'document_id' );

			$cost_breakdown = $project_tracker_model->get_cost_breakdown($document_id);

			$model_data = array();

			$cost_breakdown_array = array();

			$cost_breakdown_counter = 0;

			foreach($cost_breakdown as $cost){
				$item_id = $cost->item_id;
				$item_name = $this->get_menu_detail_value( $cost->item_id, 'cost_breakdown_item', 'menu', 'name' );

				if($item_name == null || $item_name == ''){
					$item_name = ' &nbsp;';
				}
				
				$platform_date = convert_date_to_string($cost->due_date_on_platform,true);

				$cost_breakdown_array[$cost_breakdown_counter] = array();
				$cost_breakdown_array[$cost_breakdown_counter]['cost_breakdown_id'] = $cost->cost_breakdown_id;
				$cost_breakdown_array[$cost_breakdown_counter]['item_id'] = $cost->item_id;
				$cost_breakdown_array[$cost_breakdown_counter]['item_name'] = $item_name;
				$cost_breakdown_array[$cost_breakdown_counter]['item_description'] = $cost->description;
				$cost_breakdown_array[$cost_breakdown_counter]['e_unit_cost'] = $cost->estimated_unit_cost;
				$cost_breakdown_array[$cost_breakdown_counter]['e_volume'] = $cost->estimated_volume;
				$cost_breakdown_array[$cost_breakdown_counter]['e_subtotal'] = $cost->estimated_subtotal;
				$cost_breakdown_array[$cost_breakdown_counter]['a_unit_cost'] = $cost->actual_unit_cost;
				$cost_breakdown_array[$cost_breakdown_counter]['a_volume'] = $cost->actual_volume;
				$cost_breakdown_array[$cost_breakdown_counter]['a_subtotal'] = $cost->actual_subtotal;
				$cost_breakdown_array[$cost_breakdown_counter]['status'] = $this->get_menu_detail_value( $cost->status, 'cost_breakdown_status', 'menu', 'name' );
				$cost_breakdown_array[$cost_breakdown_counter]['platform_date'] = $platform_date;
				$cost_breakdown_array[$cost_breakdown_counter]['po_number'] = $cost->po_number;
				$cost_breakdown_array[$cost_breakdown_counter]['supplier'] = $cost->supplier;
				$cost_breakdown_array[$cost_breakdown_counter]['component_location'] = $cost->component_location;
				$cost_breakdown_array[$cost_breakdown_counter]['waiting_status'] = $this->get_menu_detail_value( $cost->waiting_status, 'cost_breakdown_waiting_status', 'menu', 'name' );
				$cost_breakdown_array[$cost_breakdown_counter]['waiting_status_dropdown'] = $this->get_dropdown_menu( $cost->waiting_status, 'cost_breakdown_waiting_status' );


				$cost_breakdown_counter++;
			}

			$model_data['cost_breakdown'] = $cost_breakdown_array;
			$model_data['user_id'] = $user_id;
			$model_data['document_creator'] = $document_creator;
			

			$special_view = $this->load->view( 'reliability_maintenance/cost-breakdown-table', $model_data, true );

			echo $special_view;
		
	}

	public function get_specialist_requirement_per_id($document_id){	

		$this->load->model( 'Project_Tracker_Model' );
		$project_tracker_model = new Project_Tracker_Model();


	

			$specialist_requirement = $project_tracker_model->get_specialist_requirement($document_id);

			$model_data = array();

			$specialist_array = array();

			$specialist_counter = 0;

			foreach($specialist_requirement as $specialist){
				$specialist_requirement_id = $specialist->specialist_requirement_id;
				$item_name = $this->get_menu_detail_value( $specialist->specialist_requirement_id, 'specialist_requirement', 'menu', 'name' );

				if($item_name == null || $item_name == ''){
					$item_name = ' &nbsp;';
				}
				

				$specialist_array[$specialist_counter] = array();
				$specialist_array[$specialist_counter]['specialist_requirement'] = $item_name;
				$specialist_array[$specialist_counter]['description'] = $specialist->description;
				$specialist_array[$specialist_counter]['due_date'] = convert_date_to_string($specialist->due_date,true);

				$specialist_counter++;
			}

			$model_data['specialist_requirement'] = $specialist_array;

			$special_view = $this->load->view( 'reliability_maintenance/specialist-requirement-table', $model_data, true );

			echo $special_view;
		
	}

	public function update_cost_breakdown_row(){

		$this->load->model( 'Project_Tracker_Model' );
		$project_tracker_model = new Project_Tracker_Model();

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$c_due_date = convert_string_to_date($c_due_date, true);

			$id = $project_tracker_model->update_cost_breakdown($c_id, $c_supplier, $c_due_date, $c_status, $c_po_number, $c_component_location); //to do

			/*var_dump($id);*/
		}

	}

	public function project_tracker_gantt_chart($document_id = null){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$this->load->model( 'Project_Tracker_Model' );
		$project_tracker_model = new Project_Tracker_Model();

		$pp_id = "";

		if($document_id != null){
			$project_data = $project_tracker_model->count_project($document_id);
			$pp_id = $project_data->project_plan_id;

			if(count($project_data) < 1){
				redirect(base_url('reliability_maintenance/project_tracker_gantt_chart'));
			}

		}

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		if($session_site_role == 'admin' || $session_site_role == 'siteadmin'){
			$hidden_display = '';
		}else{
			$hidden_display = 'hidden';
		}

		$header_data = array(
			'container_class' => 'fixed',
			'container_size' => 'sm'
		);

		$model_data = array(
			'document_id' => $document_id ? : '',
			'session_site_role' => $session_site_role,
			'hidden_display' => $hidden_display
		);

		

		$title = $pp_id ? 'PP-'.$pp_id.' Gantt Chart' : 'Project Tracker Gantt Chart';


		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;
		$model_data['title'] = $title;

		$model_data['current_user_id'] = $user_id;

		$footer_data['footer_scripts'] = array('plugins/jquery_gantt/jquery.fn.gantt');

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'reliability_maintenance/project-tracker-gantt-chart', $model_data );
		$this->load->view( 'layout/footer',$footer_data  );

	}

	public function get_project_gantt_chart($id = null){

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$this->load->model('PP_model');
		$pp_model = new PP_Model();

		$this->load->model( 'Project_Tracker_Model' );
		$project_tracker_model = new Project_Tracker_Model();

		$user_id = $this->session->userdata( 'session' );
		
		if($id != null){
			$project_data = $project_tracker_model->count_project($id);

			if(count($project_data) < 1){
				redirect(base_url('reliability_maintenance/project_tracker_gantt_chart'));
			}

			$multi_value = 0;

			$single_gantt_data = $project_tracker_model->get_single_project_tracker_gantt_chart($id); //entire project
			$constraints = $document_model->get_sub_table( $id, 'constraints', 'document_id' ); // constraints
			$enablers = $pp_model->get_sub_table( $id, 'enabler' ); //enabler
			$deliverables = $pp_model->get_sub_table( $id, 'deliverable' ); //deliverables
			$action_log = $pp_model->get_sub_table( $id, 'action_log' ); //associated activities
			$action_tracker = $document_model->get_sub_table( $id, 'action_tracker' ); //action tracker
			$milestone = $pp_model->get_sub_table( $id, 'milestone' ); //milestone
			$change_management = $pp_model->get_sub_table( $id, 'change_management' ); //change management

			$gantt_array = array();

			$project_plan_id = $single_gantt_data->project_plan_id;
			$document_id = $single_gantt_data->document_id;	
			$name = $single_gantt_data->project_name;
			$duration = $single_gantt_data->estimated_project_duration;

			if($name == null){
				$name = '';
			}
				
			$code = $single_gantt_data->code;

			$end_date = '';

			$project_start_date = convert_date_to_string($single_gantt_data->estimated_start_date,true,false,'m/d/Y');

			$project_end_date = '';

			if($duration != null || $duration != ''){
				$new_start_date = date('m/d/Y', strtotime("-1 days", strtotime($project_start_date)));
				$new_start_date = convert_date_to_string($new_start_date,true,false,'m/d/Y');

				$project_end_date = date('m/d/Y', strtotime("+".$duration, strtotime($new_start_date)));
			}

			//risks and threats
			$constraints_array = array();

			$constraints_counter = 0;
			foreach ( $constraints as $item ) {

				$label = ($item->action_party ? : '[Action Party]').' - '.($item->mitigating_action ? : '[Mitigating Action]');
				
				$constraints_array[$constraints_counter] = array();
				/*$constraints_array[$constraints_counter]['mitigating_action'] = $item->mitigating_action;
				$constraints_array[$constraints_counter]['action_party'] = $item->action_party;
				$constraints_array[$constraints_counter]['full_name'] = $user_model->get_full_name( $item->action_party ).'&nbsp;';
				$constraints_array[$constraints_counter]['document_id'] = $item->document_id;*/
				$constraints_array[$constraints_counter]['name'] = '';
				$constraints_array[$constraints_counter]['desc'] = $item->constraints ? : 'Risks and Threats - '.($constraints_counter+1);
				$constraints_array[$constraints_counter]['from'] = $project_start_date;
				$constraints_array[$constraints_counter]['to'] = convert_date_to_string($item->due_date_on_status,true,false,'m/d/Y');
				$constraints_array[$constraints_counter]['label'] = $item->action_party ? : 'No Owner';
				$constraints_array[$constraints_counter]['customClass'] = 'gantt-color-blue';
				$constraints_array[$constraints_counter]['ppTitle'] = 'Owner';
				$constraints_array[$constraints_counter]['ppDescription'] = $item->action_party ? : 'No Owner yet.';
					 
				$constraints_counter++;
			}

			//specialist requirement
			$enablers_array = array();

			$enablers_counter = 0;
			foreach ( $enablers as $enabler ) {

				
					$specialist_requirement_id = $enabler->specialist_requirement_id;

					$enablers_array[$enablers_counter] = array();
					//$enablers_array[$enablers_counter]['commitment_summary'] = $enabler->description;
					//$enablers_array[$enablers_counter]['responsible'] = $enabler->responsible;
					$enablers_array[$enablers_counter]['name'] = '';
					$enablers_array[$enablers_counter]['desc'] = $this->get_menu_detail_value( $specialist_requirement_id, 'specialist_requirement', 'menu', 'name' ) ? : 'Specialist Requirement - '.($enablers_counter+1);
					$enablers_array[$enablers_counter]['to'] = convert_date_to_string($enabler->due_date,true,false,'m/d/Y');
					$enablers_array[$enablers_counter]['from'] = $project_start_date;
					$enablers_array[$enablers_counter]['label'] = '';
					$enablers_array[$enablers_counter]['customClass'] = 'gantt-color-blue';
					$enablers_array[$enablers_counter]['ppTitle'] = 'Owner';
					$enablers_array[$enablers_counter]['ppDescription'] = $enabler->responsible ? : 'No Owner yet';
					
					$enablers_counter++;
				
			}

			//deliverables


			$deliverable_array = array();

			$counter = 0;

			foreach($deliverables as $item){

				$deliverable_duration = $item->duration;
				$due_date = convert_date_to_string($item->due_date,true,false,'m/d/Y');

				$deliverable_start_date = '';

				if($due_date != '' || $due_date != null){
					if($deliverable_duration != null || $deliverable_duration != ''){
						$new_due_date = date('m/d/Y', strtotime("+1 days", strtotime($due_date)));
						$new_due_date = convert_date_to_string($new_due_date,true,false,'m/d/Y');

						$deliverable_start_date = date('m/d/Y', strtotime("-".$deliverable_duration, strtotime($new_due_date)));
					}
				}
					
				$deliverable_array[$counter] = array();

				$label = ($item->responsible ?: '[Responsible]').' - '.($item->location ? : '[Location]');
				/*$deliverable_array[$counter]['location'] = $item->location;
				$deliverable_array[$counter]['responsible'] = $item->responsible;*/	
				$deliverable_array[$counter]['name'] = '';
				$deliverable_array[$counter]['desc'] = $item->description ? : 'Deliverable - '.($counter+1);
				$deliverable_array[$counter]['from'] = $deliverable_start_date ? : $project_start_date;
				$deliverable_array[$counter]['to'] = convert_date_to_string($due_date,true,false,'m/d/Y');
				$deliverable_array[$counter]['label'] = '';//$label;
				$deliverable_array[$counter]['customClass'] = 'gantt-color-violet';
				$deliverable_array[$counter]['ppTitle'] = 'Owner';
				$deliverable_array[$counter]['ppDescription'] = $item->responsible ? : 'No Owner yet.';

				$counter++;
			}

			//associated activities

			$action_log_array = array();

			$action_counter = 0;
			foreach ( $action_log as $item ) {

				$status_id = $item->status_id;
				$action_id = $item->action;

				$action_log_array[$action_counter] = array();
				//$action_log_array[$action_counter]['action_party'] = $item->action_party;
				//$action_log_array[$action_counter]['status'] = $this->get_menu_detail_value( $status_id, 'action_log_status', 'menu', 'name' );
				$action_log_array[$action_counter]['name'] = '';
				$action_log_array[$action_counter]['desc'] = $this->get_menu_detail_value( $action_id, 'associated_activities', 'menu', 'name' ) ? : 'Activity -'.($action_counter+1);
				$action_log_array[$action_counter]['from'] = $project_start_date;
				$action_log_array[$action_counter]['to'] = convert_date_to_string( $item->due_date,true,false,'m/d/Y' );
				$action_log_array[$action_counter]['label'] = '';
				$action_log_array[$action_counter]['customClass'] = 'gantt-color-blue';
				$action_log_array[$action_counter]['ppTitle'] = 'Owner';
				$action_log_array[$action_counter]['ppDescription'] = $item->action_party ? : 'No Owner yet.';
				$action_counter++;
			}

			//ACTION TRACKER ARRAY
			$action_tracker_array = array();

			$action_tracker_counter = 0;
			foreach ( $action_tracker as $item ) {

				$full_name = $user_model->get_full_name( $item->owner );

				$action_tracker_array[$action_tracker_counter] = array();
				//$action_tracker_array[$action_tracker_counter]['reference'] = $item->reference;
				//$action_tracker_array[$action_tracker_counter]['status'] = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'name' );
				//$action_tracker_array[$action_tracker_counter]['full_name'] = $full_name;
				$action_tracker_array[$action_tracker_counter]['name'] = '';
				$action_tracker_array[$action_tracker_counter]['desc'] = $item->action_process_step ? : 'Action - '.($action_tracker_counter+1);
				$action_tracker_array[$action_tracker_counter]['from'] =  $project_start_date;
				$action_tracker_array[$action_tracker_counter]['to'] =  convert_date_to_string( $item->due_date,true,false,'m/d/Y' );
				$action_tracker_array[$action_tracker_counter]['label'] = '';
				$action_tracker_array[$action_tracker_counter]['customClass'] = 'gantt-color-blue';
				$action_tracker_array[$action_tracker_counter]['ppTitle'] = 'Owner';
				$action_tracker_array[$action_tracker_counter]['ppDescription'] = $full_name ? : 'No Owner yet.';

				$action_tracker_counter++;
			}

			//MILESTONE ARRAY
		
			$milestone_array = array();

			$milestone_counter = 0;
			foreach ( $milestone as $item ) {

				$date = convert_date_to_string( $item->milestone_date,true,false,'m/d/Y' );
				//$date = convert_string_to_date( $date, true);

				$milestone_array[$milestone_counter] = array();
				$milestone_array[$milestone_counter]['name'] = '' ;
				$milestone_array[$milestone_counter]['desc'] = $item->event ? : 'Milestone - '.($milestone_counter+1);
				$milestone_array[$milestone_counter]['from'] = $project_start_date;
				$milestone_array[$milestone_counter]['to'] = $date ? : '';
				$milestone_array[$milestone_counter]['label'] = '';
				$milestone_array[$milestone_counter]['customClass'] = 'gantt-color-blue';
				$milestone_array[$milestone_counter]['ppTitle'] = 'Event Name';
				$milestone_array[$milestone_counter]['ppDescription'] = $item->event ? : 'Milestone - '.($milestone_counter+1);
				//$milestone_array[$milestone_counter]['milestone_status'] = $this->get_menu_detail_value( $item->milestone_status, 'milestone_status', 'menu', 'name' );
				$milestone_counter++;
			}

			//CHANGE MANAGEMENT ARRAY
			$change_management_array = array();

			$change_management_counter = 0;
			foreach ( $change_management as $item ) {

				$change_management_array[$change_management_counter] = array();
				/*$change_management_array[$change_management_counter]['responsible_party'] = $item->responsible_party;
				$change_management_array[$change_management_counter]['area_of_authority'] = $this->get_menu_detail_value( $item->area_of_authority, 'area_of_authority', 'menu', 'name' );*/
				$change_management_array[$change_management_counter]['name'] = '';
				$change_management_array[$change_management_counter]['desc'] = $item->event ? : 'Event - '.($change_management_counter+1);
				$change_management_array[$change_management_counter]['to'] = convert_date_to_string( $item->due_date,true,false,'m/d/Y' );
				$change_management_array[$change_management_counter]['from'] = $project_start_date;
				$change_management_array[$change_management_counter]['label'] = '';
				$change_management_array[$change_management_counter]['customClass'] = 'gantt-color-blue';
				$change_management_array[$change_management_counter]['ppTitle'] = 'Owner';
				$change_management_array[$change_management_counter]['ppDescription'] = $item->responsible_party ? : 'No Owner yet.';

				
				$change_management_counter++;
			}


			//whole project duration
			$gantt_array['document_id'] = $document_id;
			$gantt_array['project_plan_id'] = $project_plan_id;
			$gantt_array['name'] = $name;
			$gantt_array['code'] = $code;
			$gantt_array['start_date'] = $project_start_date;
			$gantt_array['end_date'] = $project_end_date;

			$main_array = array(
				'table_data' => $gantt_array,
				'multi_project' => $multi_value,
				'constraints' => $constraints_array,
				'specialist_requirement' => $enablers_array,
				'deliverables' => $deliverable_array,
				'action_log' => $action_log_array,
				'action_tracker' => $action_tracker_array,
				'milestone' => $milestone_array,
				'change_management' => $change_management_array
			);



		}else{
			$gantt_data = $project_tracker_model->get_project_tracker_gantt_chart();

			

			$gantt_array = array();

			$gantt_counter = 0;
			foreach ( $gantt_data as $item ) {

				$gantt_array[$gantt_counter] = array();
					
				$project_plan_id = $item->project_plan_id;
				$document_id = $item->document_id;	
				$name = $item->project_name;
				$duration = $item->estimated_project_duration;

				if($name == null){
					$name = '';
				}
				
				$code = $item->code;

				$end_date = '';

				$start_date = convert_date_to_string($item->estimated_start_date,true,false,'m/d/Y');

				if($duration != null || $duration != ''){
					$new_start_date = date('m/d/Y', strtotime("-1 days", strtotime($start_date)));
					$new_start_date = convert_date_to_string($new_start_date,true,false,'m/d/Y');

					$end_date = date('m/d/Y', strtotime("+".$duration, strtotime($new_start_date)));
				}

				$gantt_array[$gantt_counter]['document_id'] = $document_id;
				$gantt_array[$gantt_counter]['project_plan_id'] = $project_plan_id;
				$gantt_array[$gantt_counter]['name'] = $name;
				$gantt_array[$gantt_counter]['code'] = $code;
				$gantt_array[$gantt_counter]['start_date'] = $start_date;
				$gantt_array[$gantt_counter]['end_date'] = $end_date;

				$gantt_counter++;
			}

			$multi_value = 1;

			$main_array = array(
				'table_data' => $gantt_array,
				'multi_project' => $multi_value,
			);
		}

			

		

		echo json_encode( $main_array );

	}


}