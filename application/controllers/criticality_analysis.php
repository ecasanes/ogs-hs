<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Criticality_Analysis extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'CRITICALITY-ANALYSIS';
		$this->document_primary = 'document_id';
		$this->form_primary = 'criticality_analysis_id';

		$main_model_str = 'Criticality_Analysis_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$user_model = new User_Model();

		$this->no_of_steps = 1;
	}

    # Generates a CSV Report of Either ANALYZED or UNANALYED CE Reports.
    public function generate_ce_report() 
    {
    	# Receive HTTP Request.
    	$data = $this->input->get();

    	if($data)
    	{ # http://localhost/reliabilitysolutions/criticality-analysis/generate_ce_report?report_type=Analyzed
    		
			extract( $data, EXTR_SKIP );
    		//$report_type = 'Unanalyzed';
    		
			# If there is a report type...
    		if($report_type === 'Analyzed' || $report_type === 'Unanalyzed')
    		{
    			# Change header download name.
		    	header("Content-type: text/csv");
				header("Cache-Control: no-store, no-cache");
				
    			# Load Model.
    			$main_model = $this->main_model;

    			# Result.
    			$result = array();

    			# Get reports based on request.
    			if($report_type === 'Analyzed') { $result = $main_model->get_ca_list(); }
    			if($report_type === 'Unanalyzed') { $result = $main_model->get_ce_not_analysed(); }

    			# DB data container.
    			$data_array = array();

    			# Process CSV filed based on results.
    			array_push($data_array, 'Asset<->Parent SCE<->Tag No<->Sub System / Equipment Description<->Code<->Primary Role<->Inspection Frequency<->CAS');

    			# Build CSV data.
		    	foreach ($result as $data) {
		    		$data = ( $data->asset_code.'<->'.$data->sce_name.'<->'.$data->tag_number.'<->'.$data->subsystem_component
		    				.'<->'.$data->code.'<->'.$data->role_name.'<->'.$data->ip_letter.'<->'.$data->cas );

		    		array_push($data_array, $data);
		    	}

		    	# CSV Directory.
		    	$dir ='csv_reports/';

		    	# Date Created.
		    	$date_created = (string)date("M_t_Y__h-i-s_A");

		    	# CSV Filename.
		    	if($report_type === 'Analyzed') { $dir .= 'Analyzed_Reports__'.$date_created; }
    			if($report_type === 'Unanalyzed') { $dir .= 'Unanalyzed_Reports__'.$date_created; }

    			# Filename Extension.
    			$dir .= '.csv';

    			# change header name.
    			header('Content-Disposition: attachment; filename="'.$dir.'"');

    			# Make the CSV file.
		    	$file = fopen('php://output','w');

		    	# Build the CSV data.
				foreach ($data_array as $line) { fputcsv( $file, explode( '<->',$line) ) ; }

				# Close and save CSV file.
				fclose($file);
    		}
    		else { print('Failed.'); } # IF not a valid report analysis.
    	}
    	else { print('Failed.'); }  # IF no HTTP Requests sent.    	
    }

	public function hehe()
	{
		$this->is_logged_in();
		$data = $this->input->post();

		$this->load->model('Criticality_Analysis_Model');
		$criticality_analysis_model = new Criticality_Analysis_Model();

		// Initial Alert Data.
		$alert_status = false;
		$alert_class = 'alert-dismissible';
		$alert_message = '';

		if($data) 
		{
			// $this->load->model('Criticality_Analysis_Model');
			$criticality_analysis_model = new Criticality_Analysis_Model();

			// trim and prep data.
			$ref = trim($this->input->post('ref'));
			$notes = trim($this->input->post('notes'));
			$cas = trim($this->input->post('cas'));
			$spof = trim($this->input->post('spof'));
			$critical_equipment_id = trim($this->input->post('critical_equipment_id'));
			$ca_role_id = trim($this->input->post('role'));
            $sce = trim($this->input->post('sce'));
            $ece = trim($this->input->post('ece'));
            $pce = trim($this->input->post('pce'));
            $ex = trim($this->input->post('ex'));
            $sis = trim($this->input->post('sis'));



			// Insert command.
			$result = $criticality_analysis_model->add_critical_analysis_stage($ref, $notes, $cas, $spof, $critical_equipment_id, $ca_role_id, 
                                                $sce, $ece, $pce, $ex, $sis);

			if( is_numeric($result) )
			{
				// Modify Alert Data.
				$alert_status = true;
				$alert_class = 'alert-success';
				$alert_message = '<strong>Success!</strong> Critical Data Scoring Sheet Added Successfully!';

				// Insert Questions.
				
			}
			else 
			{
				// Modify Alert Data.
				$alert_status = true;
				$alert_class = 'alert-danger';
				$alert_message = '<strong>Fail!</strong> Critical Data Scoring Sheet Adding Failed!';
			}
		}

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array();

		$model_data = array(
				'questions' => $this->get_ca_questions(),
				'roles' => $criticality_analysis_model->get_all_roles(),
				'alert_status' => $alert_status,
				'alert_class' => $alert_class,
				'alert_message' => $alert_message
		);


		$footer_data = array();
		$footer_data['listeners'] = array('Module.Criticality_Analysis.get_tag_data()');
		
		
		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/criticality-analysis-scoring', $model_data );
		$this->load->view( 'layout/footer_2', $footer_data );
	}



	public function index() {

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		//CRITICALITY ANALYSIS CATEGORY

		$groups = $main_model->get_criticality_analysis_groups();

		$group_dropdown = get_dynamic_key_value_dropdown( $groups, null, false, 'group' );

		//END CRITICALITY ANALYSIS CATEGORY

		$header_data = array(
			'container_class' => 'fixed',
			'container_size' => 'sm'
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['session_site_role'] = $session_site_role;
		$model_data['group_dropdown'] = $group_dropdown;


		$results = array();


		$model_data['upload_error'] = '';

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );
		$model_data['criticality_redundancy'] = $this->get_simple_dropdown_menu( 'criticality_redundancy' );
		$model_data['criticality_safety'] = $this->get_simple_dropdown_menu( 'criticality_safety' );
		$model_data['criticality_environment'] = $this->get_simple_dropdown_menu( 'criticality_environment' );
		$model_data['criticality_operation'] = $this->get_simple_dropdown_menu( 'criticality_operation' );
		$model_data['criticality_reinstatement'] = $this->get_simple_dropdown_menu( 'criticality_reinstatement' );
		$model_data['criticality_score'] = $this->get_simple_dropdown_menu( 'criticality_score' );
		$model_data['criticality_last_review_date'] = $this->get_dropdown_menu( null, 'criticality_last_review_date' );



		$criticality_category_results = $main_model->get_main_menu( 'criticality_equipment_category' );
		$model_data['criticality_equipment_category'] = $criticality_category_results;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;
		$footer_data['modals'] = array('create-criticality-analysis-modal', 'edit-criticality-analysis-modal');

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/criticality-analysis-stage-one', $model_data );
		$this->load->view( 'layout/footer', $footer_data );
	}

	public function ajax_get_critical_equipment() {
		$this->load->model('Criticality_Analysis_Model');
		$criticality_analysis_model = new Criticality_Analysis_Model();

		$result = $criticality_analysis_model->get_criticaly_equipments();

		print( json_encode($result) );
	}

	public function ajax_get_single_critical_equipment() {
		$this->load->model('Criticality_Analysis_Model');
		$criticality_analysis_model = new Criticality_Analysis_Model();

		$critical_equipment_id = $this->input->get('critical_equipment_id');

		$result = $criticality_analysis_model->get_single_critical_equipment($critical_equipment_id);

		print( json_encode($result) );
	}

	//COMPUTATION FUNCTIONS

	public function drop_ca_tables(){

		$main_model = $this->main_model;

		$main_model->drop_criticality_analysis_tables();

	}

	public function execute_all_computations($criticality_analysis_id){

		$main_model = $this->main_model;

		$record = $main_model->get_ca_simple($criticality_analysis_id);

		$se_val = $record->se_value;
		$sp_val = $record->spof_value;



		$this->compute($criticality_analysis_id);
		$risk_total = $this->compute_risk_total($criticality_analysis_id);
		$se = $this->compute_se($se_val);
		$sp = $this->compute_redundancy_sp($sp_val);

		echo "SES: ".$se;
		echo "<br>";
		echo "SPFS: ".$sp;
		echo "<br>";
		echo "RT: ".$risk_total;
		echo "<br>";

		//$pc = $this->compute_pc($criticality_analysis_id, 2);
		$overall_criticality = $this->compuate_overall_criticality($risk_total, $se, $sp);

		echo "OC: ".$overall_criticality;
		echo "<br>";

		$compuate_cas = $this->compute_cas($overall_criticality);

		echo "CAS: ".$compuate_cas;
		echo "<br>";

		//echo 'risk total: '.$risk_total;


		$this->update_computed_functions($criticality_analysis_id, $sp, $se, $risk_total, $overall_criticality, $compuate_cas);
	

	}

	public function update_computed_functions($criticality_analysis_id, $spof_result, $se_result, $risk_total, $overall_criticality, $cas){

		$main_model = $this->main_model;

		$main_model->update_criticality_analysis_computations($criticality_analysis_id, $spof_result, $se_result, $risk_total, $overall_criticality, $cas);
	}

	public function compute($criticality_analysis_id){

		$main_model = $this->main_model;

		$answers = $main_model->get_ca_answers($criticality_analysis_id);

		foreach($answers as $answer){

			/*echo '<pre>';
			var_dump($answer);
			echo '</pre>';*/

			$formula_category_id = $answer->formula_category_id;
			$answer_value = $answer->ans_value;
			$question_value = $answer->q_value;
			$category_answer = $answer->answer;
			$answer_id = $answer->ca_answer_id;

			//$computed_result = $this->compute_by_formula($formula_category_id, $answer_value);

			$computed_result = $answer_value * $question_value;

			$main_model->update_ca_answer_total($answer_id, $computed_result);
		}

		$this->compute_category_answer_total($criticality_analysis_id);
	}

	public function compute_by_formula($formula_category_id, $value){

		$main_model = $this->main_model;

		if($value != 0){

			$formula_detail = $main_model->get_operation_value($formula_category_id, $value);

			$operation = $formula_detail->operation;
			$operation_value = $formula_detail->operation_value;

			$result = calculate($value, $operation, $operation_value);

			echo "SUM: ".$result.' = '. $value . ' * ' . $operation_value;
			echo '<br>';

		}else{
			$result = 0;
		}

		return $result;
	}

	public function compuate_overall_criticality($risk_total, $se, $sp){

		$result = ((($risk_total) * $se ) * $sp);

		return $result;
	}

	public function compute_cas($highest_overall_criticality){

		$result = $highest_overall_criticality * 0.0091;

		return $result;
	}

	public function compute_se($se_yes){

		$result = $this->compuate_overall_reliability_score($se_yes);

		return $result;
	}

	public function compute_pc($ce_id, $sum_group){

		$main_model = $this->main_model;

		$pc = $main_model->get_group_sum($ce_id, $sum_group);

		return $pc;
	}

	public function compuate_overall_reliability_score($overall_reliability_value){ //compute secondary effect --- param: secondary effect yes

		$value = $overall_reliability_value;

		if($value == 0){
			$result = 1;
		}else if($value == 1){
			$result = 1.2;
		}else if($value == 2){
			$result = 1.4;
		}else if($value >= 3 && $value <= 5){
			$result = 1.6;
		}else if($value >= 6 && $value <= 10){
			$result = 1.8;
		}else if($value >= 11){
			$result = 2;
		}

		return $result;
	}

	public function compute_redundancy_sp($value){ //spof

		if($value == 0){
			$result = 2;
		}else if($value == 1){
			$result = 1.8;
		}else if($value == 2){
			$result = 1.6;
		}else if($value >= 3 && $value <= 5){
			$result = 1.4;
		}else if($value >= 6 && $value <= 10){
			$result = 1.2;
		}else if($value >= 11){
			$result = 1;
		}

		return $result;
	}

	public function compute_risk_total($criticality_analysis_id){

		$main_model = $this->main_model;

		$risk_total = $main_model->get_risk_total($criticality_analysis_id);

		//echo 'RISK TOTAL: '. $risk_total;

		$main_model->update_risk_total($risk_total, $criticality_analysis_id);

		return $risk_total;
	}

	public function compute_category_answer_total($criticality_analysis_id){

		//todo: get all question category by ca_id
		//todo:

		$main_model = $this->main_model;

		$totals = $main_model->get_ca_category_totals($criticality_analysis_id);

		foreach($totals as $total){

			/*echo '<pre>';
			var_dump($total);
			echo '</pre>';*/

			$cat_ans_id = $total->ca_q_category_answer_id;
			$sum_total = $total->sum_total;

			echo 'TOTAL :'.$sum_total;
			echo "<br>";

			$main_model->update_category_answer_total($cat_ans_id, $sum_total);

		}
	}

	//END COMPUTATION FUNCTIONS

	public function get_ca_questions($action = 'add', $ca_id = null){

		$main_model = $this->main_model;

		$questions = $main_model->get_ca_question_categories();

		$output = '';

		foreach($questions as $question){
			$category_id = $question->ca_question_category_id;
			$category_name = $question->name;

			if($action == 'edit' && $ca_id != null){
				$category_value = $main_model->get_category_answer($category_id, $ca_id);

			}else{
				$category_value = '';
			}

			
			$output .= '<p><b>'.$category_name.'</b></p>';

			$question_details = $main_model->get_ca_questions_by_category($category_id);
			$output .= '<div class="row-content main_container group-question">';
			$output .= '<div class="row">';
				$output .= '<div class="col-xs-10">';
					$output .= '<p class="bg-grey bg-padding"> '.$question->general_question.' </p>';
				$output .= '</div>';
				$output .= '<div class="col-xs-2">';
					$output .= '<div class="form-group input-group-sm">';
						$output .= '<select name="category_answer['.$category_id.']" class="form-control select_value group-answer" required>';
							$output .= yes_no_default($category_value, true, '- Select -', true);
							$output .= '<option value="1">Yes</option>';
							$output .= '<option value="0">No</option>';
						$output .= '</select>';
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';

			if($category_value == 1){
				$category_value_display = '';
			}else{
				$category_value_display = 'hidden';
			}

			$output .= '<table id="safety" class="table table-bordered '.$category_value_display.' inside_container table-condensed">';
					$output .= '<tbody>';
						$output .= '<tr>';
							$output .= '<td></td>';
							$output .= '<td width="150" class="bg-yellow text-center"> 1-5</td>';
						$output .= '</tr>';

			$counter = 0;
			foreach($question_details as $question_detail){

						$question_detail_id = $question_detail->ca_question_id;

						if($action == 'edit' && $ca_id != null){
							$question_answer = $main_model->get_ca_answer($question_detail_id, $ca_id);

						}else{
							$question_answer = '';
						}
						
				
						$output .= '<tr>';
							$output .= '<td>'.$question_detail->question.'</td>';
							$output .= '<td>';
								$output .= '<div class="input-group-sm">';
									$output .= '<select data-selected="0" data-index="'.$counter.'" class="answer form-control text-center" name="answer['.$question_detail_id.']">';
										
										//$output .= default_option((int)$question_answer, (int)$question_answer, 0);
										
										$values = array(0, 1, 2, 3, 4, 5);

										foreach($values as $data) 
										{
											$selected = ($data == $question_answer ? "selected" : '');

											if($data != 0) 
											{
												$output .= "<option value=\"$data\" $selected>$data</option>";
											}
											else 
											{
												$output .= "<option value=\"\" $selected>$data</option>";
											}
										}

										
										/*$output .= '<option value="2">2</option>';
										$output .= '<option value="3">3</option>';
										$output .= '<option value="4">4</option>';
										$output .= '<option value="5">5</option>';*/
									$output .= '</select>';
								$output .= '</div>';
							$output .= '</td>';
						$output .= '</tr>';

						$counter++;
				
			}

				$output .= '</tbody>';
			$output .= '</table>';
			$output .= '</div>';

			

		}

		return $output;
	}

	public function get_critical_equipment($return_result = 'json'){

		$criticality_analysis_model = $this->main_model;

		$equipments = $criticality_analysis_model->get_critical_equipment();
		$table_count = count($equipments);

		$result_array = array(
				'table_data' => $equipments,
				'count' => $table_count
			);

		switch($return_result){
			case "json":
				echo json_encode($result_array);
				break;

			case "table":
				echo $this->load->view('criticality_analysis/critical-equipment-table', $result_array);
				break;
		}	
	}

	public function criticality_analysis_old() {

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		//CRITICALITY ANALYSIS CATEGORY

		$groups = $main_model->get_criticality_analysis_groups();

		$group_dropdown = get_dynamic_key_value_dropdown( $groups, null, false, 'group' );

		//END CRITICALITY ANALYSIS CATEGORY

		$header_data = array(
			'container_class' => 'fixed',
			'container_size' => 'sm'
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['session_site_role'] = $session_site_role;
		$model_data['group_dropdown'] = $group_dropdown;


		$results = array();


		$model_data['upload_error'] = '';

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );
		$model_data['criticality_redundancy'] = $this->get_simple_dropdown_menu( 'criticality_redundancy' );
		$model_data['criticality_safety'] = $this->get_simple_dropdown_menu( 'criticality_safety' );
		$model_data['criticality_environment'] = $this->get_simple_dropdown_menu( 'criticality_environment' );
		$model_data['criticality_operation'] = $this->get_simple_dropdown_menu( 'criticality_operation' );
		$model_data['criticality_reinstatement'] = $this->get_simple_dropdown_menu( 'criticality_reinstatement' );
		$model_data['criticality_score'] = $this->get_simple_dropdown_menu( 'criticality_score' );
		$model_data['criticality_last_review_date'] = $this->get_dropdown_menu( null, 'criticality_last_review_date' );



		$criticality_category_results = $main_model->get_main_menu( 'criticality_equipment_category' );
		$model_data['criticality_equipment_category'] = $criticality_category_results;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;
		$footer_data['modals'] = array('create-criticality-analysis-modal', 'edit-criticality-analysis-modal');

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/criticality-analysis-new', $model_data );
		$this->load->view( 'layout/footer', $footer_data );
	}

	public function create() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			var_dump( $data );

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$criticality_analysis_id = $main_model->create_simple_criticality_analysis( $asset, $category, $tag_number, $description, $equipment_code, $last_review_date, $current_user_id );

			$main_model->update_single_business_criticality_category( $criticality_analysis_id, $pce, $sce, $ece, $sis );

			$group_name = '';

			if ( $group == 'other' ) {
				$group_name = $new_group;
			}else {
				$group_name = $group;
			}

			$main_model->update_group( $criticality_analysis_id, $group_name );

			redirect( 'criticality-analysis' );



		}
	}

	public function update() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$redundancy_value = $this->get_menu_detail_value( $reliability_redundancy, 'criticality_redundancy', 'menu', 'value' );
			$safety_value = $this->get_menu_detail_value( $safety_health_criticality, 'criticality_safety', 'menu', 'value' );
			$enviromental_value = $this->get_menu_detail_value( $environmental_criticality, 'criticality_environment', 'menu', 'value' );
			$operation_value = $this->get_menu_detail_value( $operational_criticality, 'criticality_operation', 'menu', 'value' );
			$reinstatement_value = $this->get_menu_detail_value( $reinstatement, 'criticality_reinstatement', 'menu', 'value' );


			$cas_value = $this->solve_cas( $redundancy_value, $safety_value, $enviromental_value, $operation_value, $reinstatement_value );



			$cas = $main_model->get_menu_id_by_value( $cas_value, 'criticality_score', 'menu' );

			$main_model->update_single_criticality_analysis( $criticality_analysis_id, $asset, $tag_number, $description, $reliability_redundancy, $safety_health_criticality, $environmental_criticality, $operational_criticality, $reinstatement, $status, $cas, $frequency );
			$main_model->update_single_business_criticality_category( $criticality_analysis_id, $pce, $sce, $ece, $sis, $atex_m, $atex_e );

			//redirect('criticality-analysis');

		}
	}

	public function update_failure_rate() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$start_date = convert_string_to_date( $start_date );
			$fail_date = convert_string_to_date( $fail_date );
			$repair_date = convert_string_to_date( $repair_date );

			$fail_menu_id = $main_model->get_menu_id_by_code( 'FAIL', 'criticality_status', 'menu' );
			$repair_menu_id = $main_model->get_menu_id_by_code( 'OK', 'criticality_status', 'menu' );


			$failure_calculations = $this->get_average_time_by_status( $criticality_analysis_id, $start_date );

			$n = $failure_calculations['n'];
			$t = $failure_calculations['t'];
			$failure_rate = $failure_calculations['n/t'];
			$mtbf = $failure_calculations['mtbf'];

			$repair_calculations = $this->get_average_time_by_multiple_status( $criticality_analysis_id, $start_date );

			$mttr = $repair_calculations['mttr'];

			$last_failed_date_details = $main_model->get_last_equipment_with_status( $criticality_analysis_id, $fail_menu_id, $start_date );

			//echo $this->db->last_query();

			$last_repaired_date_details = $main_model->get_last_equipment_with_status( $criticality_analysis_id, $repair_menu_id, $start_date );

			//echo $this->db->last_query();

			$fail_date = $last_failed_date_details->criticality_date;
			$repair_date = $last_repaired_date_details->criticality_date;

			$estimated_repair_time = calculate_time_between_dates( $repair_date, $fail_date );
			$estimated_repair_time = $estimated_repair_time['hours'];


			$main_model->update_failure_rate( $criticality_analysis_id, $asset, $tag_number, $description, $start_date, $failure_rate, $mtbf, $mttr, $fail_date, $repair_date, $estimated_repair_time, $actual_repair_time );


		}
	}

	public function delete() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$main_model->delete_single_criticality_analysis( $criticality_analysis_id );

			redirect( 'criticality-analysis' );

		}
	}

	public function solve_cas( $redundancy_value, $safety_value, $enviromental_value, $operation_value, $reinstatement_value ) {

		$redundancy_value = intval( $redundancy_value );
		$safety_value = intval( $safety_value );
		$enviromental_value = intval( $enviromental_value );
		$operation_value = intval( $operation_value );
		$reinstatement_value = intval( $reinstatement_value );

		$cas = $redundancy_value + $safety_value + $enviromental_value + $operation_value + $reinstatement_value;

		return $cas;
	}

	public function test() {

		$main_model = $this->main_model;
		$user_model = $this->user_model;

		$test =  $main_model->get_criticality_analysis( null, null, null, null, null, null );

		var_dump( $test );
	}

	public function get_criticality_analysis( $type = null ) {

		$data = $this->input->post();

		if ( $data ) {

			$day = date( 'j' );
			$month = date( 'n' );
			$year = date( 'Y' );

			extract( $data, EXTR_SKIP );

			$json_array = array();
			$table_info = array();
			$user_info = array();

			$user_id = $this->session->userdata( 'session' );

			/*$asset = null;
	      $category = null;
	      $code = null;
	      $last_review_date = null;
	      $status = null;
	      $owner_id = null;
	      $query_type = null;*/

			$asset = $this->input->post( 'asset' );
			$category = $this->input->post( 'category' );
			$code = $this->input->post( 'code' );
			$last_review_date = $this->input->post( 'last_review_date' );
			$status = $this->input->post( 'status' );
			$owner_id = $this->input->post( 'owner_id' );
			$query_type = $this->input->post( 'query_type' );

			$new_order_sql = null;

			switch ( $query_type ) {
			case "compliance":
				$new_order_sql = " ORDER BY a.asset,a.group ";
				break;
			}

			$last_review_date_value = $this->get_menu_detail_value( $last_review_date, 'criticality_last_review_date', 'menu', 'value' );

			//initialize models
			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$user_model = $this->user_model;

			//initialize argument variables
			$asset_role = $user_model->get_value( $user_id, 'asset_role' );
			$site_role = $user_model->get_value( $user_id, 'role' );
			$user_asset = $user_model->get_value( $user_id, 'asset' );

			//initialize dropdown
			$criticality_asset_dropdown = $this->get_simple_dropdown_menu( 'criticality_asset' );
			$criticality_redundancy_dropdown = $this->get_simple_dropdown_menu( 'criticality_redundancy' );
			$criticality_safety_dropdown = $this->get_simple_dropdown_menu( 'criticality_safety' );
			$criticality_environment_dropdown = $this->get_simple_dropdown_menu( 'criticality_environment' );
			$criticality_operation_dropdown = $this->get_simple_dropdown_menu( 'criticality_operation' );
			$criticality_reinstatement_dropdown = $this->get_simple_dropdown_menu( 'criticality_reinstatement' );
			$criticality_cas_dropdown = $this->get_simple_dropdown_menu( 'criticality_cas' );
			$criticality_defect_elimination_dropdown = $this->get_simple_dropdown_menu( 'criticality_defect_elimination' );
			$criticality_project_plan_dropdown = $this->get_simple_dropdown_menu( 'criticality_project_plan' );
			$criticality_technical_bulletin_dropdown = $this->get_simple_dropdown_menu( 'criticality_technical_bulletin' );
			$pce_dropdown = '<select name="pce" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$sce_dropdown = '<select name="sce" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$ece_dropdown = '<select name="ece" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$sis_dropdown = '<select name="sis" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$atex_m_dropdown = '<select name="atex_m" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$atex_e_dropdown = '<select name="atex_e" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$user_dropdown = $this->get_user_dropdown( 'None' );


			$table_info['criticality_asset_dropdown'] = $criticality_asset_dropdown;
			$table_info['criticality_redundancy_dropdown'] = $criticality_redundancy_dropdown;
			$table_info['criticality_safety_dropdown'] = $criticality_safety_dropdown;
			$table_info['criticality_environment_dropdown'] = $criticality_environment_dropdown;
			$table_info['criticality_operation_dropdown'] = $criticality_operation_dropdown;
			$table_info['criticality_reinstatement_dropdown'] = $criticality_reinstatement_dropdown;
			$table_info['criticality_cas_dropdown'] = $criticality_cas_dropdown;
			$table_info['criticality_defect_elimination_dropdown'] = $criticality_defect_elimination_dropdown;
			$table_info['criticality_project_plan_dropdown'] = $criticality_project_plan_dropdown;
			$table_info['criticality_technical_bulletin_dropdown'] = $criticality_technical_bulletin_dropdown;
			$table_info['pce_dropdown'] = $pce_dropdown;
			$table_info['sce_dropdown'] = $sce_dropdown;
			$table_info['ece_dropdown'] = $ece_dropdown;
			$table_info['sis_dropdown'] = $sis_dropdown;
			$table_info['atex_m_dropdown'] = $atex_m_dropdown;
			$table_info['atex_e_dropdown'] = $atex_e_dropdown;
			$table_info['user_dropdown'] = $user_dropdown;


			if ( $asset_role == 'user' && ( $user_asset != 0 || $user_asset != '' ) ) {
				$asset = $user_asset;
			}










			//initialize results
			if ( isset( $single_index_of_failing_equipment ) && $single_index_of_failing_equipment == 'true' ) {
				$results = $main_model->get_current_day_criticality_analysis( $asset_role, $asset, $category, $code, $last_review_date_value, $status, $category_list, $owner_id );
			}
			else {
				$results = $main_model->get_criticality_analysis( $asset_role, $asset, $category, $code, $last_review_date_value, $status, $category_list, $owner_id, $new_order_sql );
			}


			$cv_value = $main_model->get_cv_value( $day, $month, $year );

			$user_info['last_query'] = $this->db->last_query();
			$user_info['user_id'] = $user_id;
			$user_info['asset_role'] = $asset_role;
			$user_info['asset'] = $asset;
			$user_info['site_role'] = $site_role;

			foreach ( $results as $result ) {

				$criticality_analysis_id = $result->criticality_analysis_id;






				$asset_id = $result->asset;
				$tag_number = $result->tag_number;
				$description = $result->description;

				$code = $result->code;
				$group = $result->group;
				$cv = $result->cv;

				$reliability_redundancy_id = $result->reliability_redundancy;
				$safety_health_criticality_id = $result->safety_health_criticality;
				$environmental_criticality_id = $result->environmental_criticality;
				$operational_criticality_id = $result->operational_criticality;
				$reinstatement_id = $result->reinstatement;
				$status_id = $result->status;
				$cas_id = $result->cas;
				$frequency_id = $result->frequency;

				$performance_standard = (double)$result->performance_standard;
				$unit_currently_available = $result->unit_currently_available;
				$resultant_availability = $result->resultant_availability;
				$compliant = $result->compliant;

				$defect_elimination = $result->defect_elimination;
				$project_plan = $result->project_plan;
				$technical_bulletin = $result->technical_bulletin;

				$day_status = $result->day_status;

				$user_id = $result->user_id;
				$user_value = $user_model->get_full_name( $user_id );



				$failure_rate = $result->failure_rate;
				$mtbf = $result->mtbf;
				$mttr = $result->mttr;
				$start_date = convert_date_to_string( $result->start_date, true );
				$fail_date = convert_date_to_string( $result->fail_date, true );
				$repair_date = convert_date_to_string( $result->repair_date, true );
				$estimated_repair_time = $result->estimated_repair_time;
				$actual_repair_time = $result->actual_repair_time;

				$asset = $this->get_menu_detail_value( $asset_id, 'criticality_asset', 'menu', 'name' );
				$reliability_redundancy = $this->get_menu_detail_value( $reliability_redundancy_id, 'criticality_redundancy', 'menu', 'name' );
				$safety_health_criticality = $this->get_menu_detail_value( $safety_health_criticality_id, 'criticality_safety', 'menu', 'name' );
				$environmental_criticality = $this->get_menu_detail_value( $environmental_criticality_id, 'criticality_environment', 'menu', 'name' );
				$operational_criticality = $this->get_menu_detail_value( $operational_criticality_id, 'criticality_operation', 'menu', 'name' );
				$reinstatement = $this->get_menu_detail_value( $reinstatement_id, 'criticality_reinstatement', 'menu', 'name' );
				$cas = $this->get_menu_detail_value( $cas_id, 'criticality_score', 'menu', 'name' );
				$day_status_value = $this->get_menu_detail_value( $day_status, 'criticality_status', 'menu', 'name' );


				$reliability_redundancy_value = $this->get_menu_detail_value( $reliability_redundancy_id, 'criticality_redundancy', 'menu', 'value' );
				$safety_health_criticality_value = $this->get_menu_detail_value( $safety_health_criticality_id, 'criticality_safety', 'menu', 'value' );
				$environmental_criticality_value = $this->get_menu_detail_value( $environmental_criticality_id, 'criticality_environment', 'menu', 'value' );
				$operational_criticality_value = $this->get_menu_detail_value( $operational_criticality_id, 'criticality_operation', 'menu', 'value' );
				$reinstatement_value = $this->get_menu_detail_value( $reinstatement_id, 'criticality_reinstatement', 'menu', 'value' );
				$cas_value = $this->get_menu_detail_value( $cas_id, 'criticality_score', 'menu', 'value' );
				$frequency_value = $this->get_menu_detail_value( $cas_id, 'criticality_score', 'menu', 'description' );

				$defect_elimination_value = $this->get_menu_detail_value( $defect_elimination, 'criticality_defect_elimination', 'menu', 'name' );
				$project_plan_value = $this->get_menu_detail_value( $project_plan, 'criticality_project_plan', 'menu', 'name' );
				$technical_bulletin_value = $this->get_menu_detail_value( $technical_bulletin, 'criticality_technical_bulletin', 'menu', 'name' );

				//business category
				$business_criticality_category_results = $main_model->get_business_criticality_category_results( $criticality_analysis_id );

				$pce_value = 0;
				$sce_value = 0;
				$ece_value = 0;
				$sis_value = 0;
				$atex_m_value = 0;
				$atex_e_value = 0;

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
						if ( $category_type == 'Mechanical ATEX Equipment' ) {
							$atex_m_value = $business_result->value;
						}
						if ( $category_type == 'Electrical ATEX Equipment' ) {
							$atex_e_value = $business_result->value;
						}
					}
				}

				$temp_array = array();

				//business category
				$temp_array['pce_value'] = $pce_value;
				$temp_array['sce_value'] = $sce_value;
				$temp_array['ece_value'] = $ece_value;
				$temp_array['sis_value'] = $sis_value;
				$temp_array['atex_m_value'] = $atex_m_value;
				$temp_array['atex_e_value'] = $atex_e_value;

				$temp_array['pce'] = 'Y';
				$temp_array['sce'] = 'Y';
				$temp_array['ece'] = 'Y';
				$temp_array['sis'] = 'Y';
				$temp_array['atex_m'] = 'Y';
				$temp_array['atex_e'] = 'Y';

				if ( $pce_value == 0 ) {
					$temp_array['pce'] = 'N';
				}
				if ( $sce_value == 0 ) {
					$temp_array['sce'] = 'N';
				}
				if ( $ece_value == 0 ) {
					$temp_array['ece'] = 'N';
				}
				if ( $sis_value == 0 ) {
					$temp_array['sis'] = 'N';
				}
				if ( $atex_m_value == 0 ) {
					$temp_array['atex_m'] = 'N';
				}
				if ( $atex_e_value == 0 ) {
					$temp_array['atex_e'] = 'N';
				}

				$temp_array['criticality_analysis_id'] = $criticality_analysis_id;
				$temp_array['asset_id'] = $asset_id;
				$temp_array['tag_number'] = $tag_number;
				$temp_array['description'] = $description;

				$temp_array['code'] = $code;
				$temp_array['group'] = $group;



				//cv_value
				$check_day = 0;
				$cv_flag = 0;
				foreach ( $cv_value as $cv ) {
					if ( $criticality_analysis_id == $cv->criticality_analysis_id ) {
						if ( $cv->day > $check_day ) {
							if ( $cv->day_cv != null ) {
								$temp_array['cv'] = $cv->day_cv;
							}
							else {
								$temp_array['cv'] = '0';
							}
							$check_day = $cv->day;
						}
						$cv_flag = 1;
					}
				}

				if ( $cv_flag == 0 ) {
					$temp_array['cv'] = '0';
				}

				//end cv_value

				$alert = $this->solve_cv_alert( $temp_array['cv'], $cas_value );

				if ( $alert == 'Y' ) {
					$temp_array['alert_color'] = 'bg-green';
				}else {
					$temp_array['alert_color'] = 'bg-red';
				}

				$temp_array['alert'] = $alert;




				//GET LATEST EQUIPMENT AVAILABILITY

				$latest_availability_month = $main_model->get_latest_equipment_availability_month( $criticality_analysis_id, $year );



				$available_right_now = '';




				$month_counter = 1;
				while ( $month_counter <= 12 ) {

					$latest_availability_status = '';

					$single_availability_percentage = 0;

					$latest_availability = $main_model->get_latest_equipment_availability( $criticality_analysis_id, $month_counter, $year );
					$single_availability_percentage = $main_model->get_monthly_availability_percentage( $criticality_analysis_id, $month_counter, $year );

					if ( !empty( $single_availability_percentage ) ) {
						$single_availability_percentage = $single_availability_percentage * 100;
					}else {
					}



					if ( !empty( $latest_availability ) ) {
						$latest_availability_status = $this->get_menu_detail_value( $latest_availability->day_availability, 'criticality_avail', 'menu', 'name' );
						$available_right_now = $latest_availability_status;
					}else {
						if ( $latest_availability_month >= $month_counter ) {
						}else {
						}
					}

					if ( $latest_availability_status == 'Y' ) {
						$latest_availability_status_color = 'bg-green';
					}elseif ( $latest_availability_status == 'N' ) {
						$latest_availability_status_color = 'bg-red';
					}else {
						$latest_availability_status_color = '';
					}


					switch ( $single_availability_percentage ) {
					case $single_availability_percentage > 0 && $single_availability_percentage <= 5:
						$percentage_color = 'bg-5';
						break;
					case $single_availability_percentage > 5 && $single_availability_percentage <= 10:
						$percentage_color = 'bg-10';
						break;
					case $single_availability_percentage > 10 && $single_availability_percentage <= 15:
						$percentage_color = 'bg-15';
						break;
					case $single_availability_percentage > 15 && $single_availability_percentage <= 20:
						$percentage_color = 'bg-20';
						break;
					case $single_availability_percentage > 20 && $single_availability_percentage <= 25:
						$percentage_color = 'bg-25';
						break;
					case $single_availability_percentage > 25 && $single_availability_percentage <= 30:
						$percentage_color = 'bg-30';
						break;
					case $single_availability_percentage > 30 && $single_availability_percentage <= 35:
						$percentage_color = 'bg-35';
						break;
					case $single_availability_percentage > 35 && $single_availability_percentage <= 40:
						$percentage_color = 'bg-40';
						break;
					case $single_availability_percentage > 40 && $single_availability_percentage <= 45:
						$percentage_color = 'bg-45';
						break;
					case $single_availability_percentage > 45 && $single_availability_percentage <= 50:
						$percentage_color = 'bg-50';
						break;
					case $single_availability_percentage > 50 && $single_availability_percentage <= 55:
						$percentage_color = 'bg-55';
						break;
					case $single_availability_percentage > 55 && $single_availability_percentage <= 60:
						$percentage_color = 'bg-60';
						break;
					case $single_availability_percentage > 60 && $single_availability_percentage <= 65:
						$percentage_color = 'bg-65';
						break;
					case $single_availability_percentage > 65 && $single_availability_percentage <= 70:
						$percentage_color = 'bg-70';
						break;
					case $single_availability_percentage > 70 && $single_availability_percentage <= 75:
						$percentage_color = 'bg-75';
						break;
					case $single_availability_percentage > 75 && $single_availability_percentage <= 80:
						$percentage_color = 'bg-80';
						break;
					case $single_availability_percentage > 80 && $single_availability_percentage <= 85:
						$percentage_color = 'bg-85';
						break;
					case $single_availability_percentage > 85 && $single_availability_percentage <= 90:
						$percentage_color = 'bg-90';
						break;
					case $single_availability_percentage > 90 && $single_availability_percentage <= 95:
						$percentage_color = 'bg-95';
						break;
					case $single_availability_percentage > 95 && $single_availability_percentage <= 100:
						$percentage_color = 'bg-100';
						break;
					default:
						$percentage_color = 'bg-0';
						break;
					}

					if ( empty( $single_availability_percentage ) ) {
						$percentage_color = 'bg-white';
					}

					if ( $available_right_now == '' ) {
						$available_right_now = 'N';
					}



					$temp_array['availability_info'][$month_counter-1] = array(
						'availability_record' => $latest_availability_status,
						'availability_percentage_raw' => $single_availability_percentage,
						'availability_percentage' => empty( $single_availability_percentage )?'':$single_availability_percentage.'%',
						'availability_record_color' => $latest_availability_status_color,
						'percentage_color' => "bg-percent ".$percentage_color
					);

					//echo $this->db->last_query();

					$month_counter++;
				}

				if ( $available_right_now == 'Y' ) {
					$arn_color = 'bg-green';
				}else {
					$arn_color = 'bg-red';
				}






				$temp_array['available_right_now'] = $available_right_now;
				$temp_array['arn_color'] = $arn_color;

				//END LATEST EQUIPMENT AVAILABILITY



				$temp_array['reliability_redundancy_id'] = $reliability_redundancy_id;
				$temp_array['safety_health_criticality_id'] = $safety_health_criticality_id;
				$temp_array['environmental_criticality_id'] = $environmental_criticality_id;
				$temp_array['operational_criticality_id'] = $operational_criticality_id;
				$temp_array['reinstatement_id'] = $reinstatement_id;
				$temp_array['cas_id'] = $cas_id;
				$temp_array['status_id'] = $status_id;

				$temp_array['reliability_redundancy_value'] = $reliability_redundancy_value;
				$temp_array['safety_health_criticality_value'] = $safety_health_criticality_value;
				$temp_array['environmental_criticality_value'] = $environmental_criticality_value;
				$temp_array['operational_criticality_value'] = $operational_criticality_value;
				$temp_array['reinstatement_value'] = $reinstatement_value;
				$temp_array['cas_value'] = $cas_value;
				$temp_array['frequency_value'] = $frequency_value;
				//$temp_array['status_value'] = $status_value;


				$temp_array['frequency_id'] = $frequency_id;
				$temp_array['user_id'] = $user_id;
				$temp_array['user_value'] = $user_value;
				$temp_array['asset'] = $asset;
				$temp_array['reliability_redundancy'] = $reliability_redundancy;
				$temp_array['safety_health_criticality'] = $safety_health_criticality;
				$temp_array['environmental_criticality'] = $environmental_criticality;
				$temp_array['operational_criticality'] = $operational_criticality;
				$temp_array['reinstatement'] = $reinstatement;
				$temp_array['cas'] = $cas;

				if ( $temp_array['cv'] > $temp_array['cas'] ) {
					$temp_array['cv_greater_than_cas'] = true;
				}else {
					$temp_array['cv_greater_than_cas'] = false;
				}

				$temp_array['performance_standard'] = $performance_standard;
				$temp_array['unit_currently_available'] = $unit_currently_available;
				$temp_array['resultant_availability'] = $resultant_availability;
				$temp_array['compliant'] = $compliant;

				$temp_array['defect_elimination'] = $defect_elimination;
				$temp_array['project_plan'] = $project_plan;
				$temp_array['technical_bulletin'] = $technical_bulletin;

				$temp_array['defect_elimination_value'] = $defect_elimination_value;
				$temp_array['project_plan_value'] = $project_plan_value;
				$temp_array['technical_bulletin_value'] = $technical_bulletin_value;

				$temp_array['day_status'] = $day_status_value;
				$temp_array['day_status_color'] = $this->get_menu_detail_value( $day_status, 'criticality_status', 'menu', 'color_class' );

				$temp_array['start_date'] = $start_date;

				$temp_array['failure_rate'] = $failure_rate;
				$temp_array['mtbf'] = $mtbf;
				$temp_array['mttr'] = $mttr;

				$temp_array['fail_date'] = $fail_date;
				$temp_array['repair_date'] = $repair_date;
				$temp_array['estimated_repair_time'] = $estimated_repair_time;
				$temp_array['actual_repair_time'] = $actual_repair_time;

				$json_array[] = $temp_array;
			}








			//START GROUP

			$groups = array();
			$availability_yes_count = 0;
			$availability_no_count = 0;
			$performance_standard = 0;
			$group_count = 1;
			$previous_group = '';
			$group_counter = 0;

			$index = 0;
			foreach ( $json_array as $item ) {

				$group = $item['group'];
				$available_right_now = $item['available_right_now'];
				$single_performance_standard = $item['performance_standard'];

				if ( $previous_group == $group ) {
					$group_count++;
				}else {
					$previous_group = $group;
					$group_count = 1;
					$availability_yes_count = 0;
					$availability_no_count = 0;
					$performance_standard = 0;
					$group_counter++;
				}

				if ( $available_right_now == 'Y' ) {
					$availability_yes_count++;
				}else {
					$availability_no_count++;
				}

				$performance_standard += $single_performance_standard;

				$total_performance_standard = $performance_standard;
				$average_performance_standard = $total_performance_standard/$group_count;

				$groups[$group_counter-1] = array(

					"group_name" => $group,
					"group_count" => $group_count,
					"yes_count" => $availability_yes_count,
					"no_count" => $availability_no_count,
					"total_performance_standard" => $total_performance_standard,
					"average_performance_standard" => $average_performance_standard

				);


				$json_array[$index]['group_rowspan'] = null;
				$json_array[$index]['resultant'] = '';
				$json_array[$index]['resultant_raw'] = null;
				$json_array[$index]['average_performance_standard'] = 0;
				$json_array[$index]['compliant'] = '';
				$json_array[$index]['compliant_color'] = '';

				$index++;

			}



			$table_data_index = 0;
			$index = 0;

			foreach ( $groups as $item ) {

				$group_count = $item['group_count'];
				$yes_count = $item['yes_count'];
				$no_count = $item['no_count'];
				$average_performance_standard = $item['average_performance_standard'];

				$json_array[$table_data_index]['group_rowspan'] = $group_count;

				$resultant = ( $yes_count/( $yes_count+$no_count ) )*100;
				if ( $resultant != 100 && $resultant != 0 ) {
					$resultant = number_format( $resultant, 2, '.', '' );
				}
				$resultant_string = $resultant.'%';

				$groups[$index]["resultant"] = $resultant;
				$groups[$index]["resultant_string"] = $resultant_string;

				$json_array[$table_data_index]['resultant'] = $resultant_string;
				$json_array[$table_data_index]['resultant_raw'] = $resultant;
				$json_array[$table_data_index]['average_performance_standard'] = $average_performance_standard;

				if ( $resultant>$average_performance_standard ) {
					$compliant = "Yes";
					$compliant_color = "bg-green";
				}else {
					$compliant = "No";
					$compliant_color = "bg-red";
				}

				$json_array[$table_data_index]['compliant'] = $compliant;
				$json_array[$table_data_index]['compliant_color'] = $compliant_color;

				$table_data_index += $group_count;
				$index++;
			}


			//END GROUP








			$main_array = array(
				'table_data' => $json_array,
				'table_info' => $table_info,
				'user_info' => $user_info,
				'table_cv' => $cv_value
			);

			if ( $type == "csv" ) {
				$this->load->helper( 'csv' );
				$csv_filename = 'test_';
				array_to_csv( $json_array, $csv_filename.date( 'M_d_y' ).'.xls' );
			}else {
				echo json_encode( $main_array );
			}



		}
	}

	public function data_input() {

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$asset_role = $user_model->get_value( $user_id, 'asset_role' );
		$site_role = $user_model->get_value( $user_id, 'role' );
		$user_asset = $user_model->get_value( $user_id, 'asset' );
		$user_asset_value = $this->get_menu_detail_value( $user_asset, 'criticality_asset', 'menu', 'name' );

		$header_data = array(
			'container_class' => 'wide',
			'container_size' => 'lg'
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';

		$model_data['asset_role'] = $asset_role;
		$model_data['user_asset'] = $user_asset;
		$model_data['user_asset_value'] = $user_asset_value;

		$results = array();

		$model_data['upload_error'] = '';

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );
		$model_data['criticality_redundancy'] = $this->get_dropdown_menu( null, 'criticality_redundancy' );
		$model_data['criticality_safety'] = $this->get_dropdown_menu( null, 'criticality_safety' );
		$model_data['criticality_environment'] = $this->get_dropdown_menu( null, 'criticality_environment' );
		$model_data['criticality_operation'] = $this->get_dropdown_menu( null, 'criticality_operation' );
		$model_data['criticality_reinstatement'] = $this->get_dropdown_menu( null, 'criticality_reinstatement' );
		$model_data['criticality_score'] = $this->get_dropdown_menu( null, 'criticality_score' );
		$model_data['criticality_last_review_date'] = $this->get_dropdown_menu( null, 'criticality_last_review_date' );

		$criticality_category_results = $main_model->get_main_menu( 'criticality_equipment_category' );
		$model_data['criticality_equipment_category'] = $criticality_category_results;

		$model_data['user_option'] = '';
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		/*$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'criticality_analysis/criticality-analysis-history', $model_data );
		$this->load->view( 'includes/footer' );*/

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/criticality-analysis-history-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function single_index_of_failing_equipment() {

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$asset_role = $user_model->get_value( $user_id, 'asset_role' );
		$site_role = $user_model->get_value( $user_id, 'role' );
		$user_asset = $user_model->get_value( $user_id, 'asset' );
		$user_asset_value = $this->get_menu_detail_value( $user_asset, 'criticality_asset', 'menu', 'name' );

		$header_data = array(
			"container_class" => 'fixed',
			"container_size" => 'sm'
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';

		$model_data['asset_role'] = $asset_role;
		$model_data['user_asset'] = $user_asset;
		$model_data['user_asset_value'] = $user_asset_value;


		$results = array();


		$model_data['upload_error'] = '';

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );
		$model_data['criticality_redundancy'] = $this->get_simple_dropdown_menu( 'criticality_redundancy' );
		$model_data['criticality_safety'] = $this->get_simple_dropdown_menu( 'criticality_safety' );
		$model_data['criticality_environment'] = $this->get_simple_dropdown_menu( 'criticality_environment' );
		$model_data['criticality_operation'] = $this->get_simple_dropdown_menu( 'criticality_operation' );
		$model_data['criticality_reinstatement'] = $this->get_simple_dropdown_menu( 'criticality_reinstatement' );
		$model_data['criticality_score'] = $this->get_simple_dropdown_menu( 'criticality_score' );
		$model_data['criticality_last_review_date'] = $this->get_dropdown_menu( null, 'criticality_last_review_date' );
		$model_data['criticality_status'] = $this->get_dropdown_menu( null, 'criticality_status' );

		$criticality_category_results = $main_model->get_main_menu( 'criticality_equipment_category' );
		$model_data['criticality_equipment_category'] = $criticality_category_results;


		$user_dropdown = $this->get_user_dropdown( 'All Users' );

		$model_data['user_dropdown'] = $user_dropdown;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/single-index-of-failing-equipment-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function spare_analysis() {
		$this->is_logged_in();
		$data = $this->input->post();

		$document_model = $this->document_model;
		$user_model = $this->user_model;
		$main_model = $this->main_model;

		$user_id = $this->session->userdata( 'session' );

		$header_data = array(
			'container_class' => 'fixed',
			'container_size' => 'md'
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';


		$results = array();

		$model_data['upload_error'] = '';

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );
		$model_data['criticality_redundancy'] = $this->get_dropdown_menu( null, 'criticality_redundancy' );
		$model_data['criticality_safety'] = $this->get_dropdown_menu( null, 'criticality_safety' );
		$model_data['criticality_environment'] = $this->get_dropdown_menu( null, 'criticality_environment' );
		$model_data['criticality_operation'] = $this->get_dropdown_menu( null, 'criticality_operation' );
		$model_data['criticality_reinstatement'] = $this->get_dropdown_menu( null, 'criticality_reinstatement' );
		$model_data['criticality_score'] = $this->get_dropdown_menu( null, 'criticality_score' );

		$criticality_category_results = $main_model->get_main_menu( 'criticality_equipment_category' );
		$model_data['criticality_equipment_category'] = $criticality_category_results;

		$model_data['user_option'] = '';

		$userdata = $user_model->get_all_records();

		$userdata_counter = 0;
		foreach ( $userdata as $result ) {
			//var_dump($result);

			$full_name = $result->first_name. ' ' .$result->last_name;

			$userdata_array[$userdata_counter] = array();

			$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';
		}

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/spare-analysis-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function get_criticality_analysis_history_daily() {

		$data = $this->input->post();

		if ( $data ) {

			$json_array = array();
			$table_info = array();
			$user_info = array();

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$user_model = $this->user_model;

			//initialize user info
			$current_user_id = $this->session->userdata( 'session' );
			$asset_role = $user_model->get_value( $current_user_id, 'asset_role' );
			$site_role = $user_model->get_value( $current_user_id, 'role' );
			$user_asset = $user_model->get_value( $current_user_id, 'asset' );

			$pce_dropdown = '<select name="pce" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$sce_dropdown = '<select name="sce" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$ece_dropdown = '<select name="ece" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$sis_dropdown = '<select name="sis" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$atex_m_dropdown = '<select name="atex_m" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$atex_e_dropdown = '<select name="atex_e" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';

			$table_info['criticality_spf_dropdown'] = $this->get_simple_dropdown_menu( 'criticality_spf', '--' );
			$table_info['criticality_avail_dropdown'] = $this->get_simple_dropdown_menu( 'criticality_avail', '--' );
			$table_info['criticality_status_dropdown'] = $this->get_simple_dropdown_menu( 'criticality_status', '--' );
			$table_info['criticality_obs_dropdown'] = $this->get_simple_dropdown_menu( 'criticality_obs', '--' );

			$table_info['pce_dropdown'] = $pce_dropdown;
			$table_info['sce_dropdown'] = $sce_dropdown;
			$table_info['ece_dropdown'] = $ece_dropdown;
			$table_info['sis_dropdown'] = $sis_dropdown;
			$table_info['atex_m_dropdown'] = $atex_m_dropdown;
			$table_info['atex_e_dropdown'] = $atex_e_dropdown;

			if ( $asset_role == 'user' && ( $user_asset != 0 || $user_asset != '' ) ) {
				$asset = $user_asset;
			}


			$results = $main_model->get_critical_analysis_history_daily_values_new( $day, $month, $year, $asset_role, $asset, $category, $code, $last_review_date, $category_list, $owner_id );

			$user_info['last_query'] = $this->db->last_query();
			$user_info['user_id'] = $current_user_id;
			$user_info['asset_role'] = $asset_role;
			$user_info['asset'] = $user_asset;
			$user_info['site_role'] = $site_role;

			foreach ( $results as $result ) {

				$hours = $result->hours;
				if ( $hours == null || $hours == 'null' ) {
					$hours = 0;
				}

				$temp_array = array();
				$temp_array['day'] = $result->day;
				$temp_array['month'] = $result->month;
				$temp_array['year'] = $result->year;
				$temp_array['day_spf'] = $result->day_spf;
				$temp_array['day_spf_value'] = $this->get_menu_detail_value( $result->day_spf, 'criticality_spf', 'menu', 'name' );
				$temp_array['day_spf_color'] = $this->get_menu_detail_value( $result->day_spf, 'criticality_spf', 'menu', 'color_class' );
				$temp_array['day_obs'] = $result->day_obs;
				$temp_array['day_availability'] = $result->day_availability;
				$temp_array['day_availability_value'] = $this->get_menu_detail_value( $result->day_availability, 'criticality_avail', 'menu', 'name' );
				$temp_array['day_availability_color'] = $this->get_menu_detail_value( $result->day_availability, 'criticality_avail', 'menu', 'color_class' );
				$temp_array['day_status'] = $result->day_status;
				$temp_array['day_status_value'] = $this->get_menu_detail_value( $result->day_status, 'criticality_status', 'menu', 'name' );
				$temp_array['day_status_color'] = $this->get_menu_detail_value( $result->day_status, 'criticality_status', 'menu', 'color_class' );
				$temp_array['day_hours'] = $hours;
				$temp_array['day_cv'] = $result->day_cv;
				$temp_array['criticality_analysis_id'] = $result->c_analysis_id;

				$json_array[] = $temp_array;
			}

			//testing analysis
			$equipment_list_array = array();

			$results_list = $main_model->get_criticality_analysis( $asset_role, $asset, $category, $code, $last_review_date, null, $category_list );
			$cv_value = $main_model->get_cv_value( $day, $month, $year );
			$availability_and_hour_value = $main_model->get_availability_hour_value( $month, $year );

			foreach ( $results_list as $result ) {

				$asset_id = $result->asset;
				$crit_id = $result->criticality_analysis_id;
				$asset = $this->get_menu_detail_value( $asset_id, 'criticality_asset', 'menu', 'name' );
				$category = $result->category;

				$category_value = $this->get_menu_detail_value( $category, 'criticality_equipment_category', 'menu', 'name' );

				$table_info['category'] = $category_value;

				//business category
				$business_criticality_category_results = $main_model->get_business_criticality_category_results( $result->criticality_analysis_id );

				$pce_value = 0;
				$sce_value = 0;
				$ece_value = 0;
				$sis_value = 0;
				$atex_m_value = 0;
				$atex_e_value = 0;

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
						if ( $category_type == 'Mechanical ATEX Equipment' ) {
							$atex_m_value = $business_result->value;
						}
						if ( $category_type == 'Electrical ATEX Equipment' ) {
							$atex_e_value = $business_result->value;
						}
					}
				}

				$temp_array = array();

				//business category
				$temp_array['pce_value'] = $pce_value;
				$temp_array['sce_value'] = $sce_value;
				$temp_array['ece_value'] = $ece_value;
				$temp_array['sis_value'] = $sis_value;
				$temp_array['atex_m_value'] = $atex_m_value;
				$temp_array['atex_e_value'] = $atex_e_value;

				$temp_array['pce'] = 'Y';
				$temp_array['sce'] = 'Y';
				$temp_array['ece'] = 'Y';
				$temp_array['sis'] = 'Y';
				$temp_array['atex_m'] = 'Y';
				$temp_array['atex_e'] = 'Y';

				if ( $pce_value == 0 ) {
					$temp_array['pce'] = 'N';
				}
				if ( $sce_value == 0 ) {
					$temp_array['sce'] = 'N';
				}
				if ( $ece_value == 0 ) {
					$temp_array['ece'] = 'N';
				}
				if ( $sis_value == 0 ) {
					$temp_array['sis'] = 'N';
				}
				if ( $atex_m_value == 0 ) {
					$temp_array['atex_m'] = 'N';
				}
				if ( $atex_e_value == 0 ) {
					$temp_array['atex_e'] = 'N';
				}

				//$temp_array = array();
				$temp_array['criticality_analysis_id'] = $result->criticality_analysis_id;
				$temp_array['asset'] = $asset;
				$temp_array['tag_number'] = $result->tag_number;
				$temp_array['description'] = $result->description;
				$temp_array['obs'] = $result->obs;
				$temp_array['obs_color'] = $this->get_menu_detail_value( $result->obs, 'criticality_obs', 'menu', 'color_class' );
				$temp_array['cas'] = $this->get_menu_detail_value( $result->cas, 'criticality_score', 'menu', 'value' );
				$temp_array['hours'] = $result->hours;

				//cv_value
				$check_day = 0;
				$cv_flag = 0;
				foreach ( $cv_value as $cv ) {
					if ( $crit_id == $cv->criticality_analysis_id ) {
						if ( $cv->day > $check_day ) {
							if ( $cv->day_cv != null ) {
								$temp_array['cv'] = $cv->day_cv;
							}
							else {
								$temp_array['cv'] = '0';
							}
							$check_day = $cv->day;
						}
						$cv_flag = 1;
					}
				}

				if ( $cv_flag == 0 ) {
					$temp_array['cv'] = '0';
				}

				$alert = $this->solve_cv_alert( $temp_array['cv'], $temp_array['cas'] );




				$temp_array['alert'] = $alert;

				//end cv_value

				//availability_value

				$yes_counter = 0;
				$no_counter = 0;
				$total_hours = 0;

				foreach ( $availability_and_hour_value as $availability ) {
					if ( $crit_id == $availability->criticality_analysis_id ) {
						if ( $availability->day_availability != 0 ) {
							$avail_value = $this->get_menu_detail_value( $availability->day_availability, 'criticality_avail', 'menu', 'value' );

							//availability
							if ( $avail_value == 0 ) {
								$no_counter += 1;
							}
							if ( $avail_value == 1 ) {
								$yes_counter += 1;
							}
						}
						//hours
						$hours = $availability->hours;
						if ( $availability->hours == null || $availability->hours == '' ) {
							$hours = 0;
						}

						$total_hours += $hours;
					}
				}

				//availability
				if ( $yes_counter == 0 && $no_counter == 0 ) {
					$temp_array['availability'] = '--';
				}
				elseif ( $yes_counter == 0 && $no_counter > 0 ) {
					$temp_array['availability'] = '0%';
				}
				else {
					$total_counter = $yes_counter + $no_counter;
					$avail_percentage = ( $yes_counter / $total_counter ) * 100;
					$avail_percentage = number_format( $avail_percentage, 2, '.', '' );

					$temp_array['availability'] = $avail_percentage.'%';
				}

				//hours
				$temp_array['hours'] = $total_hours;

				$equipment_list_array[] = $temp_array;
			}

			//end testing

			$result_array = array(

				'table_data' => $json_array,
				'table_info' => $table_info,
				'user_info' => $user_info,
				'item_list' => $equipment_list_array

			);

			echo json_encode( $result_array );
			//var_dump($json_array);
		}
	}

	public function get_criticality_analysis_history_monthly() {

		$data = $this->input->post();

		if ( $data ) {

			$json_array = array();
			$table_info = array();
			$user_info = array();

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$user_model = $this->user_model;

			//initialize user info
			$current_user_id = $this->session->userdata( 'session' );
			$asset_role = $user_model->get_value( $current_user_id, 'asset_role' );
			$site_role = $user_model->get_value( $current_user_id, 'role' );
			$user_asset = $user_model->get_value( $current_user_id, 'asset' );


			$pce_dropdown = '<select name="pce" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$sce_dropdown = '<select name="sce" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$ece_dropdown = '<select name="ece" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$sis_dropdown = '<select name="sis" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$atex_m_dropdown = '<select name="atex_m" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';
			$atex_e_dropdown = '<select name="atex_e" class="table-select" ><option value="1">Y</option><option value="0">N</option></select>';

			$table_info['criticality_spf_dropdown'] = $this->get_simple_dropdown_menu( 'criticality_spf', '--' );
			$table_info['criticality_avail_dropdown'] = $this->get_simple_dropdown_menu( 'criticality_avail', '--' );
			$table_info['criticality_status_dropdown'] = $this->get_simple_dropdown_menu( 'criticality_status', '--' );
			$table_info['criticality_obs_dropdown'] = $this->get_simple_dropdown_menu( 'criticality_obs', '--' );

			$table_info['pce_dropdown'] = $pce_dropdown;
			$table_info['sce_dropdown'] = $sce_dropdown;
			$table_info['ece_dropdown'] = $ece_dropdown;
			$table_info['sis_dropdown'] = $sis_dropdown;
			$table_info['atex_m_dropdown'] = $atex_m_dropdown;
			$table_info['atex_e_dropdown'] = $atex_e_dropdown;


			if ( $asset_role == 'user' && ( $user_asset != 0 || $user_asset != '' ) ) {
				$asset = $user_asset;
			}


			$results = $main_model->get_critical_analysis_history_monthly_values( $start_day, $end_day, $month, $year, $asset_role, $asset, $category, $code, $last_review_date, $category_list, $owner_id );

			$user_info['last_query'] = $this->db->last_query();
			$user_info['user_id'] = $current_user_id;
			$user_info['asset_role'] = $asset_role;
			$user_info['asset'] = $user_asset;
			$user_info['site_role'] = $site_role;

			//$count = $main_model->count_critical_analysis($asset);

			foreach ( $results as $result ) {

				$hours = $result->hours;
				if ( $hours == null || $hours == 'null' ) {
					$hours = 0;
				}

				$temp_array = array();
				$temp_array['day'] = $result->day;
				$temp_array['month'] = $result->month;
				$temp_array['year'] = $result->year;
				$temp_array['day_spf'] = $result->day_spf;
				$temp_array['day_spf_value'] = $this->get_menu_detail_value( $result->day_spf, 'criticality_spf', 'menu', 'name' );
				$temp_array['day_spf_color'] = $this->get_menu_detail_value( $result->day_spf, 'criticality_spf', 'menu', 'color_class' );
				$temp_array['day_obs'] = $result->day_obs;
				$temp_array['day_availability'] = $result->day_availability;
				$temp_array['day_availability_value'] = $this->get_menu_detail_value( $result->day_availability, 'criticality_avail', 'menu', 'name' );
				$temp_array['day_availability_color'] = $this->get_menu_detail_value( $result->day_availability, 'criticality_avail', 'menu', 'color_class' );
				$temp_array['day_status'] = $result->day_status;
				$temp_array['day_status_value'] = $this->get_menu_detail_value( $result->day_status, 'criticality_status', 'menu', 'name' );
				$temp_array['day_status_color'] = $this->get_menu_detail_value( $result->day_status, 'criticality_status', 'menu', 'color_class' );
				$temp_array['day_hours'] = $hours;
				$temp_array['day_cv'] = $result->day_cv;
				$temp_array['criticality_analysis_id'] = $result->c_analysis_id;

				$json_array[] = $temp_array;
			}

			$count = $main_model->count_critical_analysis( $asset_role, $asset, $category, $code, $last_review_date, $category_list );

			//testing analysis
			$equipment_list_array = array();

			$results_list = $main_model->get_criticality_analysis( $asset_role, $asset, $category, $code, $last_review_date, null, $category_list );
			$cv_value = $main_model->get_cv_value( $end_day, $month, $year );
			$availability_and_hour_value = $main_model->get_availability_hour_value( $month, $year );

			foreach ( $results_list as $result ) {

				$asset_id = $result->asset;
				$crit_id = $result->criticality_analysis_id;
				$asset = $this->get_menu_detail_value( $asset_id, 'criticality_asset', 'menu', 'name' );
				$category = $result->category;

				$category_value = $this->get_menu_detail_value( $category, 'criticality_equipment_category', 'menu', 'name' );

				$table_info['category'] = $category_value;

				//business category
				$business_criticality_category_results = $main_model->get_business_criticality_category_results( $result->criticality_analysis_id );

				$pce_value = 0;
				$sce_value = 0;
				$ece_value = 0;
				$sis_value = 0;
				$atex_m_value = 0;
				$atex_e_value = 0;

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
						if ( $category_type == 'Mechanical ATEX Equipment' ) {
							$atex_m_value = $business_result->value;
						}
						if ( $category_type == 'Electrical ATEX Equipment' ) {
							$atex_e_value = $business_result->value;
						}
					}
				}

				$temp_array = array();

				//business category
				$temp_array['pce_value'] = $pce_value;
				$temp_array['sce_value'] = $sce_value;
				$temp_array['ece_value'] = $ece_value;
				$temp_array['sis_value'] = $sis_value;
				$temp_array['atex_m_value'] = $atex_m_value;
				$temp_array['atex_e_value'] = $atex_e_value;

				$temp_array['pce'] = 'Y';
				$temp_array['sce'] = 'Y';
				$temp_array['ece'] = 'Y';
				$temp_array['sis'] = 'Y';
				$temp_array['atex_m'] = 'Y';
				$temp_array['atex_e'] = 'Y';

				if ( $pce_value == 0 ) {
					$temp_array['pce'] = 'N';
				}
				if ( $sce_value == 0 ) {
					$temp_array['sce'] = 'N';
				}
				if ( $ece_value == 0 ) {
					$temp_array['ece'] = 'N';
				}
				if ( $sis_value == 0 ) {
					$temp_array['sis'] = 'N';
				}
				if ( $atex_m_value == 0 ) {
					$temp_array['atex_m'] = 'N';
				}
				if ( $atex_e_value == 0 ) {
					$temp_array['atex_e'] = 'N';
				}


				$temp_array['criticality_analysis_id'] = $result->criticality_analysis_id;
				$temp_array['asset'] = $asset;
				$temp_array['tag_number'] = $result->tag_number;
				$temp_array['description'] = $result->description;
				$temp_array['obs'] = $result->obs;
				$temp_array['obs_color'] = $this->get_menu_detail_value( $result->obs, 'criticality_obs', 'menu', 'color_class' );
				$temp_array['cas'] = $this->get_menu_detail_value( $result->cas, 'criticality_score', 'menu', 'value' );
				$temp_array['hours'] = $result->hours;

				//cv_value
				$check_day = 0;
				$cv_flag = 0;
				foreach ( $cv_value as $cv ) {
					if ( $crit_id == $cv->criticality_analysis_id ) {
						if ( $cv->day > $check_day ) {
							if ( $cv->day_cv != null ) {
								$temp_array['cv'] = $cv->day_cv;
							}
							else {
								$temp_array['cv'] = '0';
							}
							$check_day = $cv->day;
						}
						$cv_flag = 1;
					}
				}

				if ( $cv_flag == 0 ) {
					$temp_array['cv'] = '0';
				}

				$alert = $this->solve_cv_alert( $temp_array['cv'], $temp_array['cas'] );



				$temp_array['alert'] = $alert;

				//end cv_value

				//availability_value

				$yes_counter = 0;
				$no_counter = 0;
				$total_hours = 0;

				foreach ( $availability_and_hour_value as $availability ) {
					if ( $crit_id == $availability->criticality_analysis_id ) {
						if ( $availability->day_availability != 0 ) {
							$avail_value = $this->get_menu_detail_value( $availability->day_availability, 'criticality_avail', 'menu', 'value' );

							//availability
							if ( $avail_value == 0 ) {
								$no_counter += 1;
							}
							if ( $avail_value == 1 ) {
								$yes_counter += 1;
							}
						}
						//hours
						$hours = $availability->hours;
						if ( $availability->hours == null || $availability->hours == '' ) {
							$hours = 0;
						}

						$total_hours += $hours;
					}
				}

				//availability
				if ( $yes_counter == 0 && $no_counter == 0 ) {
					$temp_array['availability'] = '--';
				}
				elseif ( $yes_counter == 0 && $no_counter > 0 ) {
					$temp_array['availability'] = '0%';
				}
				else {
					$total_counter = $yes_counter + $no_counter;
					$avail_percentage = ( $yes_counter / $total_counter ) * 100;
					$avail_percentage = number_format( $avail_percentage, 2, '.', '' );

					$temp_array['availability'] = $avail_percentage.'%';
				}

				//hours
				$temp_array['hours'] = $total_hours;

				$equipment_list_array[] = $temp_array;
			}

			//end testing




			$main_array = array(
				'table_data' => $json_array,
				'table_info' => $table_info,
				'sis_count' => $count,
				'user_info' => $user_info,
				'item_list' => $equipment_list_array
			);

			echo json_encode( $main_array );
			//var_dump($json_array);
		}
	}

	public function update_single_criticality_analysis_history_values() {
		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$user_model = $this->user_model;



			$day_obs = '';

			$row_exist = $main_model->check_criticality_analysis_history_row( $day, $month, $year, $criticality_analysis_id );

			//var_dump($row_exist);

			if ( $row_exist == false ) {
				$cas_id = $main_model->get_value( $criticality_analysis_id, 'cas' );
				$cas_value = $this->get_menu_detail_value( $cas_id, 'criticality_score', 'menu', 'value' );
				$spf_value = $this->get_menu_detail_value( $day_spf, 'criticality_spf', 'menu', 'value' );
				$status_value = $this->get_menu_detail_value( $day_status, 'criticality_status', 'menu', 'value' );
				$cv_value = $this->solve_criticality_value( $cas_value, $status_value, $spf_value );
				//$cv_value = 0;
				$main_model->create_criticality_analysis_history_row( $day, $month, $year, $day_spf, $day_availability, $day_status, $hours, $day_obs, $criticality_analysis_id, $cv_value );
			}
			else {
				$cas_id = $main_model->get_value( $criticality_analysis_id, 'cas' );
				$cas_value = $this->get_menu_detail_value( $cas_id, 'criticality_score', 'menu', 'value' );
				$spf_value = $this->get_menu_detail_value( $day_spf, 'criticality_spf', 'menu', 'value' );
				$status_value = $this->get_menu_detail_value( $day_status, 'criticality_status', 'menu', 'value' );
				$cv_value = $this->solve_criticality_value( $cas_value, $status_value, $spf_value );
				$main_model->update_single_criticality_analysis_history_row( $row_exist, $day_spf, $day_availability, $day_status, $hours, $day_obs, $cv_value );

			}


			$start_date = $main_model->get_value( $criticality_analysis_id, 'start_date' );

			if ( !empty( $start_date ) ) {

				$fail_menu_id = $main_model->get_menu_id_by_code( 'FAIL', 'criticality_status', 'menu' );
				$repair_menu_id = $main_model->get_menu_id_by_code( 'OK', 'criticality_status', 'menu' );

				$failure_calculations = $this->get_average_time_by_status( $criticality_analysis_id, $start_date );

				$n = $failure_calculations['n'];
				$t = $failure_calculations['t'];
				$failure_rate = $failure_calculations['n/t'];
				$mtbf = $failure_calculations['mtbf'];

				$repair_calculations = $this->get_average_time_by_multiple_status( $criticality_analysis_id, $start_date );

				$mttr = $repair_calculations['mttr'];

				$last_failed_date_details = $main_model->get_last_equipment_with_status( $criticality_analysis_id, $fail_menu_id, $start_date );

				//echo $this->db->last_query();

				$last_repaired_date_details = $main_model->get_last_equipment_with_status( $criticality_analysis_id, $repair_menu_id, $start_date );

				//echo $this->db->last_query();

				$fail_date = $last_failed_date_details->criticality_date;
				$repair_date = $last_repaired_date_details->criticality_date;

				$estimated_repair_time = calculate_time_between_dates( $repair_date, $fail_date );
				$estimated_repair_time = $estimated_repair_time['hours'];

				$main_model->update_failure_rate_calculations( $criticality_analysis_id, $failure_rate, $mtbf, $mttr, $fail_date, $repair_date, $estimated_repair_time );

			}



			$json_array = array(
				'day' => $day,
				'month' => $month,
				'year' => $year
			);

			echo json_encode( $json_array );
			//var_dump($json_array);
		}
	}

	public function update_compliance() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$main_model->update_compliance( $criticality_analysis_id, $performance_standard );

			/*echo $criticality_analysis_id;

			echo '<br>';

			echo $performance_standard;*/


		}
	}

	public function update_single_index() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;
			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			$main_model->update_single_index( $criticality_analysis_id, $owner, $defect_elimination, $project_plan, $technical_bulletin );

			/*echo $criticality_analysis_id;

			echo '<br>';

			echo $performance_standard;*/


		}
	}

	public function compliance_dashboard() {

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$asset_role = $user_model->get_value( $user_id, 'asset_role' );
		$site_role = $user_model->get_value( $user_id, 'role' );
		$user_asset = $user_model->get_value( $user_id, 'asset' );
		$user_asset_value = $this->get_menu_detail_value( $user_asset, 'criticality_asset', 'menu', 'name' );

		$header_data = array();

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';

		$model_data['asset_role'] = $asset_role;
		$model_data['user_asset'] = $user_asset;
		$model_data['user_asset_value'] = $user_asset_value;

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );
		$model_data['criticality_redundancy'] = $this->get_dropdown_menu( null, 'criticality_redundancy' );
		$model_data['criticality_safety'] = $this->get_dropdown_menu( null, 'criticality_safety' );
		$model_data['criticality_environment'] = $this->get_dropdown_menu( null, 'criticality_environment' );
		$model_data['criticality_operation'] = $this->get_dropdown_menu( null, 'criticality_operation' );
		$model_data['criticality_reinstatement'] = $this->get_dropdown_menu( null, 'criticality_reinstatement' );
		$model_data['criticality_score'] = $this->get_dropdown_menu( null, 'criticality_score' );
		$model_data['criticality_last_review_date'] = $this->get_dropdown_menu( null, 'criticality_last_review_date' );
		//$model_data['criticality_equipment_category'] = $this->get_dropdown_menu(null, 'criticality_equipment_category');

		$criticality_category_results = $main_model->get_main_menu( 'criticality_equipment_category' );
		$model_data['criticality_equipment_category'] = $criticality_category_results;


		$results = array();


		$model_data['upload_error'] = '';

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/compliance-dashboard-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function solve_cv_alert( $cv, $cas_value ) {

		if ( ( $cv == 0 || $cas_value == '' ) && ( $cas_value == 0 || $cas_value == '' ) ) {
			return 'N';
		}else if ( $cv>$cas_value ) {
				return 'Y';
			}else {
			return 'N';
		}
	}

	public function get_menu_edit() {

		$data = $this->input->post();

		if ( $data ) {

			$json_array = array();
			$table_data = array();
			$table_info = array();
			$user_info = array();

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;
			$user_model = $this->user_model;

			$asset_role = $user_model->get_value( $current_user_id, 'asset_role' );
			$site_role = $user_model->get_value( $current_user_id, 'role' );

			$user_info['asset_role'] = $asset_role;
			$user_info['site_role'] = $site_role;

			$table_data = $main_model->get_main_menu( $menu_type );

			$frequency_dropdown = '';
			$frequency_dropdown .= '<option value="12Hours">12 Hours</option>';
			$frequency_dropdown .= '<option value="48Hours">48 Hours</option>';
			$frequency_dropdown .= '<option value="Daily">Daily</option>';
			$frequency_dropdown .= '<option value="Weekly">Weekly</option>';

			$table_info['frequency'] = $frequency_dropdown;

			$json_array = array(
				'table_data' => $table_data,
				'table_info' => $table_info,
				'user_info' => $user_info
			);

			echo json_encode( $json_array );

		}
	}

	public function update_criticality_criteria() {

		$data = $this->input->post();

		if ( $data ) {

			$this->load->model( 'Menu_Category_Model' );
			$main_model = new Menu_Category_Model();

			extract( $data, EXTR_SKIP );

			$main_model->update_dynamic_menu( $id, $menu_category_id, $name, $value, $description, $secondary_description, $color_class, $code, $order, $level );

		}
	}

	public function criticality_criteria() {

		$this->is_logged_in();
		$data = $this->input->post();

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );
		$session_asset_role = $user_model->get_value( $user_id, 'asset_role' );

		$spf_id = 523;
		$obs_id = 521;
		$spf_menu_type = "criticality_spf";
		$obs_menu_type = "criticality_obs";
		$menu_level = "menu";

		$spf_value = $this->get_menu_detail_value( $spf_id, $spf_menu_type, $menu_level, 'value' );
		$spf_description = $this->get_menu_detail_value( $spf_id, $spf_menu_type, $menu_level, 'description' );
		$spf_menu_category_id = $this->get_menu_detail_value( $spf_id, $spf_menu_type, $menu_level, 'menu_category_id' );

		$obs_value = $this->get_menu_detail_value( $obs_id, $obs_menu_type, $menu_level, 'value' );
		$obs_description = $this->get_menu_detail_value( $obs_id, $obs_menu_type, $menu_level, 'description' );
		$obs_menu_category_id = $this->get_menu_detail_value( $obs_id, $obs_menu_type, $menu_level, 'menu_category_id' );

		$header_data = array();
		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['session_site_role'] = $session_site_role;
		$model_data['session_asset_role'] = $session_asset_role;

		$model_data['spf_id'] = $spf_id;
		$model_data['obs_id'] = $obs_id;

		$model_data['spf_value'] = $spf_value;
		$model_data['spf_description'] = $spf_description;
		$model_data['spf_menu_category_id'] = $spf_menu_category_id;

		$model_data['obs_value'] = $obs_value;
		$model_data['obs_description'] = $obs_description;
		$model_data['obs_menu_category_id'] = $obs_menu_category_id;

		$results = array();

		$header_data['current_page_name'] = "Criticality Criteria";
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/criticality-criteria', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function history_availability_old() {
		$this->is_logged_in();
		$data = $this->input->post();

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'container_class' => 'fixed',
			'container_size' => 'md'
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['session_site_role'] = $session_site_role;


		$results = array();


		$model_data['upload_error'] = '';

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );
		$model_data['criticality_redundancy'] = $this->get_simple_dropdown_menu( 'criticality_redundancy' );
		$model_data['criticality_safety'] = $this->get_simple_dropdown_menu( 'criticality_safety' );
		$model_data['criticality_environment'] = $this->get_simple_dropdown_menu( 'criticality_environment' );
		$model_data['criticality_operation'] = $this->get_simple_dropdown_menu( 'criticality_operation' );
		$model_data['criticality_reinstatement'] = $this->get_simple_dropdown_menu( 'criticality_reinstatement' );
		$model_data['criticality_score'] = $this->get_simple_dropdown_menu( 'criticality_score' );
		$model_data['criticality_last_review_date'] = $this->get_dropdown_menu( null, 'criticality_last_review_date' );
		$model_data['criticality_equipment_category'] = $this->get_dropdown_menu( null, 'criticality_equipment_category' );

		//sis dropdown
		$model_data['sis_dropdown'] = '<option value="">- Select -</option>';

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'criticality_analysis/history-availability', $model_data );
		$this->load->view( 'includes/footer' );
	}

	public function failure_rate() {

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'container_class' => 'fixed',
			'container_size' => 'sm'
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['session_site_role'] = $session_site_role;


		$results = array();


		$model_data['upload_error'] = '';

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );
		$model_data['criticality_redundancy'] = $this->get_simple_dropdown_menu( 'criticality_redundancy' );
		$model_data['criticality_safety'] = $this->get_simple_dropdown_menu( 'criticality_safety' );
		$model_data['criticality_environment'] = $this->get_simple_dropdown_menu( 'criticality_environment' );
		$model_data['criticality_operation'] = $this->get_simple_dropdown_menu( 'criticality_operation' );
		$model_data['criticality_reinstatement'] = $this->get_simple_dropdown_menu( 'criticality_reinstatement' );
		$model_data['criticality_score'] = $this->get_simple_dropdown_menu( 'criticality_score' );
		$model_data['criticality_last_review_date'] = $this->get_dropdown_menu( null, 'criticality_last_review_date' );



		$criticality_category_results = $main_model->get_main_menu( 'criticality_equipment_category' );
		$model_data['criticality_equipment_category'] = $criticality_category_results;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/failure-rate-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function get_average_time_by_multiple_status( $criticality_analysis_id, $start_date, $first_status = 'FAIL', $second_status = 'OK', $include_start_date = false, $result = 'hours' ) {

		$criticality_analysis_model = $this->main_model;

		$first_menu_id = $criticality_analysis_model->get_menu_id_by_code( $first_status, 'criticality_status', 'menu' );
		$second_menu_id = $criticality_analysis_model->get_menu_id_by_code( $second_status, 'criticality_status', 'menu' );

		$equipments = $criticality_analysis_model->get_equipment_with_multiple_status( $criticality_analysis_id, $first_menu_id, $second_menu_id, $start_date );

		$equipment_count = count( $equipments )-1;

		if ( $equipment_count < 1 ) {

			$results = array(
				'n' => 0,
				't' => 0,
				'n/t' => 0,
				'mttr' => 0
			);

		}else {

			//solve for start date - first fail
			$start_date = convert_date_to_string( $start_date, false, false, 'm/d/Y' );
			$start_date_time = strtotime( $start_date );

			$first_fail_month = $equipments[0]->month;
			$first_fail_day = $equipments[0]->day;
			$first_fail_year = $equipments[0]->year;

			$first_fail_date = $first_fail_month.'/'.$first_fail_day.'/'.$first_fail_year;
			$first_fail_time = strtotime( $first_fail_date );

			$first_fail_seconds = $first_fail_time - $start_date_time;
			$first_fail_days = ( $first_fail_seconds/60/60/24 )+1;
			$final_first_fail_hours = $first_fail_days*24;

			/*echo '<pre>';
  			var_dump($equipments);
  			echo '</pre>';*/

			$total_hours = 0;
			$counter = 0;

			$final_days = 0;

			$status_counter = 0;

			while ( $counter < $equipment_count ) {

				$day_status_1 = $equipments[$counter]->day_status;
				$day_status_2 = $equipments[$counter+1]->day_status;

				if ( $day_status_1 == $first_menu_id && $day_status_2 == $second_menu_id ) {

					$day_1 = $equipments[$counter]->day;
					$day_2 = $equipments[$counter+1]->day;

					$month_1 = $equipments[$counter]->month;
					$month_2 = $equipments[$counter+1]->month;

					$year_1 = $equipments[$counter]->year;
					$year_2 = $equipments[$counter+1]->year;

					$date_1 = $month_1.'/'.$day_1.'/'.$year_1;
					$date_2 = $month_2.'/'.$day_2.'/'.$year_2;

					/*echo $date_1.' - '.$date_2;
	  				echo '<br>';*/


					$datetime_1 = strtotime( $date_1 );
					$datetime_2 = strtotime( $date_2 );

					$seconds = $datetime_2 - $datetime_1;
					$minutes = $seconds/60;
					$hours = $minutes/60;
					$days = $hours/24;

					$final_days=$final_days+$days;

					$status_counter++;

				}

				$counter++;
			}

			//$total_hours = $total_hours+$final_first_fail_hours;
			//$counter = $counter+1;

			$final_hours = $final_days*24;

			if ( $final_hours <= 0 ) {
				$status_counter = 0;
				$final_hours = 0;
				$nt = 0;
			}else {
				$nt = $status_counter/$final_hours;
			}

			$results = array(
				'n' => $status_counter,
				't' => $final_hours,
				'n/t' => $nt,
				'mttr' => $final_hours
			);



		}

		/*echo '<pre>';
  		var_dump($results);
  		echo '</pre>';*/

		return $results;
	}

	public function get_average_time_by_status( $criticality_analysis_id, $start_date, $status = 'FAIL', $result = 'hours' ) {

		$criticality_analysis_model = $this->main_model;

		$menu_id = $criticality_analysis_model->get_menu_id_by_code( $status, 'criticality_status', 'menu' );

		$equipments = $criticality_analysis_model->get_equipment_with_status( $criticality_analysis_id, $menu_id, $start_date );

		$equipment_count = count( $equipments )-1;

		if ( $equipment_count < 1 ) {

			$results = array(
				'n' => 0,
				't' => 0,
				'n/t' => 0,
				'mtbf' => 0
			);

		}else {

			//solve for start date - first fail
			$start_date = convert_date_to_string( $start_date, false, false, 'm/d/Y' );
			$start_date_time = strtotime( $start_date );

			$first_fail_month = $equipments[0]->month;
			$first_fail_day = $equipments[0]->day;
			$first_fail_year = $equipments[0]->year;

			$first_fail_date = $first_fail_month.'/'.$first_fail_day.'/'.$first_fail_year;
			$first_fail_time = strtotime( $first_fail_date );

			$first_fail_seconds = $first_fail_time - $start_date_time;
			$first_fail_days = ( $first_fail_seconds/60/60/24 )+1;
			$final_first_fail_hours = $first_fail_days*24;

			/*echo '<pre>';
  			var_dump($equipments);
  			echo '</pre>';*/



			$total_hours = 0;
			$counter = 0;
			while ( $counter < $equipment_count ) {

				$day_1 = $equipments[$counter]->day;
				$day_2 = $equipments[$counter+1]->day;

				$month_1 = $equipments[$counter]->month;
				$month_2 = $equipments[$counter+1]->month;

				$year_1 = $equipments[$counter]->year;
				$year_2 = $equipments[$counter+1]->year;

				$date_1 = $month_1.'/'.$day_1.'/'.$year_1;
				$date_2 = $month_2.'/'.$day_2.'/'.$year_2;

				$datetime_1 = strtotime( $date_1 );
				$datetime_2 = strtotime( $date_2 );

				$seconds = $datetime_2 - $datetime_1;
				$minutes = $seconds/60;
				$hours = $minutes/60;
				$days = $hours/24;
				$days = $days+1;
				$final_hours = $days*24;

				/*echo $hours;
  				echo '<br>';*/

				$total_hours += $final_hours;

				$counter++;
			}

			$total_hours = $total_hours+$final_first_fail_hours;
			$counter = $counter+1;



			$results = array(
				'n' => $counter,
				't' => $total_hours,
				'n/t' => number_format( $counter/$total_hours, 4, '.', '' ),
				'mtbf' => $total_hours/$counter
			);



		}

		/*echo '<pre>';
  		var_dump($results);
  		echo '</pre>';*/

		return $results;
	}

	//NEW DASHBOARD THEME

	public function history_availability() {
		$this->is_logged_in();
		$data = $this->input->post();

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		$header_data = array(
			'container_class' => 'fixed',
			'container_size' => 'md'
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['session_site_role'] = $session_site_role;


		$results = array();


		$model_data['upload_error'] = '';

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );
		$model_data['criticality_redundancy'] = $this->get_simple_dropdown_menu( 'criticality_redundancy' );
		$model_data['criticality_safety'] = $this->get_simple_dropdown_menu( 'criticality_safety' );
		$model_data['criticality_environment'] = $this->get_simple_dropdown_menu( 'criticality_environment' );
		$model_data['criticality_operation'] = $this->get_simple_dropdown_menu( 'criticality_operation' );
		$model_data['criticality_reinstatement'] = $this->get_simple_dropdown_menu( 'criticality_reinstatement' );
		$model_data['criticality_score'] = $this->get_simple_dropdown_menu( 'criticality_score' );
		$model_data['criticality_last_review_date'] = $this->get_dropdown_menu( null, 'criticality_last_review_date' );
		$model_data['criticality_equipment_category'] = $this->get_dropdown_menu( null, 'criticality_equipment_category' );

		//sis dropdown
		$model_data['sis_dropdown'] = '<option value="">- Select -</option>';

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/history-availability-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function remove_redundancy($ce_id){

		$main_model = $this->main_model;

		$redundancies = $main_model->get_ca_redundancy($ce_id);

		foreach($redundancies as $redundancy){

			$critical_equipment_id = $redundancy->critical_equipment_id;
			$ce_id_redundant = $redundancy->ce_id_redundant;
			echo $critical_equipment_id.', '.$ce_id_redundant;
			echo '<br>';
			echo $ce_id_redundant.', '.$critical_equipment_id;
			echo '<br>';
			$main_model->remove_specific_redundancy($critical_equipment_id, $ce_id_redundant);
			$main_model->remove_specific_redundancy($ce_id_redundant, $critical_equipment_id);
		}

		echo $ce_id;
		echo '<br>';
		$main_model->remove_ca_redundancy($ce_id);
	}

	public function insert_redundancy($ce_id, $ce_id_r){

		$main_model = $this->main_model;

		$count = $main_model->count_specific_redundancy_count($ce_id, $ce_id_r);
		if($count == 0){
			echo 'insert';
			$main_model->insert_ca_redundancy($ce_id, $ce_id_r);
		}
		
	}

	protected function insert_role($ce_id, $ca_role_id, $role_type = 'main'){

		$main_model = $this->main_model;

		$role_exist = $main_model->ca_role_exist($ce_id, $role_type);
		if($role_exist){
			$main_model->update_role($ce_id, $ca_role_id, $role_type);
		}else{
			$main_model->insert_role($ce_id, $ca_role_id, $role_type);
		}
		


	}

	public function calculate_scoring($return_type = "link", $action_type = "create"){

		$data = $this->input->post();

		/*extract( $data, EXTR_SKIP );

		echo '<pre>';
		var_dump($ca_multi_role);
		echo '</pre>';*/

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$se_value = $spof_value;
			if(!isset($spof_answer)){
				$spof_answer = 1;
			}

			$se_answer = 1;

			$main_model->update_criticality_analysis($critical_equipment_id, $ref, $notes, $spof_answer, $se_answer, $multi_answer, $sce, $ece, $pce, $ex, $sis, $inspection_periodicity_hrs, $spof_value, $se_value);
			$this->insert_role($critical_equipment_id, $ca_role_id, 'main');

			if(isset($ca_multi_role)){
				//remove ca_roles
				$main_model->delete_ca_role($critical_equipment_id);
				//reinsert ca_roles
				foreach($ca_multi_role as $multi_role){
					$main_model->insert_ca_role($critical_equipment_id, $multi_role);
				}
			}
			






			//remove category answers cascade removal of individual answers
			$delete_success = $main_model->delete_category_answer($critical_equipment_id);
			
			//reinsert answers
			if($delete_success){
				$questions = $main_model->get_ca_question_categories();

				//echo '<pre>';
				//var_dump($questions);
				//echo '</pre>';

				foreach($questions as $question){
					$category_id = $question->ca_question_category_id;
					$category_name = $question->name;
					$question_details = $main_model->get_ca_questions_by_category($category_id);
					$category_answer_value = $category_answer[$category_id];
					
					$category_answer_id = $main_model->insert_category_answer($critical_equipment_id, $category_id, $category_answer_value );
				

					foreach($question_details as $question_detail)
					{
						$question_detail_id = $question_detail->ca_question_id;
						$ca_answer = $answer[$question_detail_id];
						
						$main_model->insert_ca_answer($question_detail_id, $category_answer_id, $ca_answer);
					
					}
				}

				$this->execute_all_computations($critical_equipment_id);
			}

			

			$redundant_id = explode(',', $redundant_ids);
			$redundant_ids_count = count($redundant_id);

			$this->remove_redundancy($critical_equipment_id);

			if($redundant_ids_count > 0){
				if($redundant_id[0] != null && $redundant_id[0] != ''){



					$ca_details = $main_model->get_ca_simple($critical_equipment_id);
					$ca_ref = $ca_details->ref;
					$ca_notes = $ca_details->notes;
					$ca_spof_answer = $ca_details->spof_answer;
					$ca_se_answer = $ca_details->se_answer;
					$ca_multi_answer = $ca_details->multi_answer;
					$ca_sce = $ca_details->sce;
					$ca_ece = $ca_details->ece;
					$ca_pce = $ca_details->pce;
					$ca_ex = $ca_details->ex;
					$ca_sis = $ca_details->sis;
					$ca_spof_value = $ca_details->spof_value;
					$ca_se_value = $ca_details->se_value;
					$ca_spof_result = $ca_details->spof_result;
					$ca_se_result = $ca_details->se_result;
					$ca_risk_total = $ca_details->risk_total;
					$ca_overall_criticality = $ca_details->overall_criticality;
					$ca_overall_reliability_score = $ca_details->overall_reliability_score;
					$ca_status_value_adjustment = $ca_details->status_value_adjustment;
					$ca_inspection_periodicity_hrs = $ca_details->inspection_periodicity_hrs;
					$ca_spf_criticality = $ca_details->spf_criticality;
					$ca_cas = $ca_details->cas;
					//$critical_equipment_id = $ca_details->critical_equipment_id;
					//$criticality_analysis_id = $ca_details->criticality_analysis_id;

					$new_cas = array();

					foreach($redundant_id as $re_id){

						$main_model->update_critical_equipment_redundancy($re_id, $ca_ref, $ca_notes, $ca_spof_answer, $ca_se_answer, $ca_multi_answer, $ca_sce, $ca_ece, $ca_pce, $ca_ex, $ca_sis, $ca_spof_value, $ca_se_value, $ca_spof_result, $ca_se_result, $ca_risk_total, $ca_overall_criticality, $ca_overall_reliability_score, $ca_status_value_adjustment, $ca_inspection_periodicity_hrs, $ca_spf_criticality, $ca_cas);

						$this->insert_role($re_id, $ca_role_id);


						if(isset($ca_multi_role)){
							//remove ca_roles
							$main_model->delete_ca_role($re_id);
							//reinsert ca_roles
							foreach($ca_multi_role as $multi_role){
								$main_model->insert_ca_role($re_id, $multi_role);
							}
						}
						

						//remove category answers cascade removal of individual answers
						$delete_success = $main_model->delete_category_answer($re_id);
						/*echo '<pre>';
						var_dump($this->db->last_query());
						echo '</pre>';*/
						
						//reinsert answers
						if($delete_success){
							$questions = $main_model->get_ca_question_categories_by_ce($critical_equipment_id);

							//echo '<pre>';
							//var_dump($questions);
							//echo '</pre>';

							foreach($questions as $question){
								$category_id = $question->ca_question_category_id;
								$category_name = $question->name;
								$category_total = $question->total;
								$question_details = $main_model->get_ca_questions_by_category($category_id);
								/*echo '<pre>';
								var_dump($this->db->last_query());
								echo '</pre>';*/
								$category_answer_value = $category_answer[$category_id];
								
								$category_answer_id = $main_model->insert_category_answer($re_id, $category_id, $category_answer_value, $category_total );
								
							

								foreach($question_details as $question_detail)
								{
									$question_detail_id = $question_detail->ca_question_id;
									$ca_answer = $answer[$question_detail_id];
									
									$main_model->insert_ca_answer($question_detail_id, $category_answer_id, $ca_answer);
									/*echo '<pre>';
									var_dump($this->db->last_query());
									echo '</pre>';*/
								
								}
							}
						}

						

					}

					$ce_ids = $redundant_id;

					$uninserted_redundancies = array();

					foreach($redundant_id as $re_id){

						//$main_model->insert_ca_redundancy($critical_equipment_id, $re_id);
						$this->insert_redundancy($critical_equipment_id, $re_id);

						foreach($ce_ids as $ce_id){

							if($ce_id != $re_id){
								//$main_model->insert_ca_redundancy($re_id, $ce_id);
								$this->insert_redundancy($re_id, $ce_id);
								$uninserted_redundancies[] = $re_id;
								
							}
						}
					}

					$uninserted_redundancies = array_unique($uninserted_redundancies);

					foreach($uninserted_redundancies as $new_re_id){
						//$main_model->insert_ca_redundancy($new_re_id, $critical_equipment_id);
						$this->insert_redundancy($new_re_id, $critical_equipment_id);
					}



				}

				
				
				
			}
			

			

			switch($return_type){
				case "link":
					switch($action_type){
						case "create":
							redirect('criticality-analysis/scoring/edit/'.$critical_equipment_id);
							break;
						case "edit":
							redirect('criticality-analysis/scoring/edit/'.$critical_equipment_id);
							break;
					}
					break;
				case "json":
					$details = $main_model->get_ca($critical_equipment_id);
					$cas = $details->cas;
					$json_array = array(
						'cas' => $cas
					);
					echo json_encode($json_array);
					break;
			}
		}
	}


	public function get_ca_roles_checkbox($id = null){

		$main_model = $this->main_model;

		if($id == null){
			$roles = $main_model->get_ca_role_empty_checkbox();
		}else{
			$roles = $main_model->get_ca_role_checkbox($id);
			//echo $this->db->last_query();
		}
		


		$output = '<table id="roles-checkbox" class="table table-bordered table-condensed">';

		/*$output .= '<thead class="sticky-role-thead">';
		$output .= '<tr><th>Role Name</th><th></th></tr>';
		$output .= "</thead>";*/

		$output .= "<tbody>";
		foreach($roles as $role){
			$checked = $role->checked;
			$role_name = $role->role_name;
			$role_id = $role->menu_id;

			if($checked == 1){
				$check_display = 'checked="checked"';
			}else{
				$check_display = '';
			}

			$output .= '<tr>';
		    $output .= '<td>'.$role_name.'</td>';
		    $output .= '<td class="text-center"><input type="checkbox" name="ca_multi_role[]" value="'.$role_id.'" '.$check_display.'></td>';
		    $output .= '</tr>';
		}

		$output .= "</tbody>";

		$output .= '</table>';

		return $output;
	}


	public function scoring($action, $id){

		//$this->is_logged_in();

		$main_model = $this->main_model;
		$user_model = $this->user_model;

		$model_data = array();

		switch($action){
			case "create":

				$result = $main_model->get_ce($id);
				$role_dropdown = $this->get_dropdown_menu(null, 'ca_role');

				$ce_id = $result->critical_equipment_id;
				$ce_ref = $result->parent_sce_ref;
				$parent_sce = $result->name;
				$tag_no = $result->tag_number;
				$subsystem = $result->subsystem_component;
				$code = $result->code;
				$quantity = $result->quantity;
				$ce_group_id = $result->ce_group_id;
				$asset_code = $result->asset_code;

				//$redundancy_count = $main_model->get_redundancy_count($ce_group_id);
				$redundancy_count = $main_model->get_ce_redundancy_count($code);
				if($redundancy_count > 0){
					$redundancy_count = $redundancy_count - 1;
				}



				$model_data['criticality_analysis_id'] = '';
				$model_data['ce_id'] = $ce_id;
				$model_data['ce_ref'] = $ce_ref;
				$model_data['parent_sce'] = $parent_sce;
				$model_data['tag_no'] = $tag_no;
				$model_data['subsystem'] = $subsystem;
				$model_data['code'] = $code;
				$model_data['quantity'] = $quantity;
				$model_data['role_output'] = '';
				$model_data['ce_group_id'] = $ce_group_id;
				$model_data['redundancy_count'] = $redundancy_count;
				$model_data['asset_code'] = $asset_code;
				$model_data['role_dropdown'] = $role_dropdown;

				//empty data
				$model_data['notes'] = '';
				$model_data['spof_answer'] = null;
				$model_data['multi_answer'] = null;
				$model_data['sce'] = '';
				$model_data['ece'] = '';
				$model_data['pce'] = '';
				$model_data['ex'] = '';
				$model_data['sis'] = '';
				$model_data['spof_value'] = 0;
				$model_data['cas'] = '';

				$model_data['inspection_periodicity_hrs'] = default_option('', '');

				$model_data['form_submit_url'] = 'criticality_analysis/calculate_scoring/link';
				$model_data['action'] = $action;
				$model_data['questions'] = $this->get_ca_questions();

				$roles = $this->get_ca_roles_checkbox();
				$model_data['roles_checkbox'] = $roles;

				$model_data['redundant_ids'] = '';

				break;

			case "edit":
				//ca_id

				$result = $main_model->get_ca($id);

				$ce_id = $result->critical_equipment_id;
				$ce_ref = $result->parent_sce_ref;
				$parent_sce = $result->name;
				$tag_no = $result->tag_number;
				$subsystem = $result->subsystem_component;
				$code = $result->code;
				$quantity = $result->quantity;
				$ce_group_id = $result->ce_group_id;
				$asset_code = $result->asset_code;

				//$redundancy_count = $main_model->get_redundancy_count($ce_group_id);
				$redundancy_count = $main_model->get_ce_redundancy_count($code);
				if($redundancy_count > 0){
					$redundancy_count = $redundancy_count - 1;
				}

				$model_data['criticality_analysis_id'] = $id;
				$model_data['ce_id'] = $ce_id;
				$model_data['ce_ref'] = $ce_ref;
				$model_data['parent_sce'] = $parent_sce;
				$model_data['tag_no'] = $tag_no;
				$model_data['subsystem'] = $subsystem;
				$model_data['code'] = $code;
				$model_data['quantity'] = $quantity;
				$model_data['ce_group_id'] = $ce_group_id;
				$model_data['redundancy_count'] = $redundancy_count;
				$model_data['asset_code'] = $asset_code;
				
				$ref = $result->ref;
				$notes = $result->notes;
				$spof_answer = $result->spof_answer;
				$multi_answer = $result->multi_answer;
				$sce = $result->sce;
				$ece = $result->ece;
				$pce = $result->pce;
				$ex = $result->ex;
				$sis = $result->sis;
				$spof_value = (int) $result->spof_value;
				$cas = $result->cas;

				$notes = $result->notes;
				$inspection_periodicity_hrs = (int) $result->inspection_periodicity_hrs;

				$model_data['ref'] = $ref;
				$model_data['notes'] = $notes;
				$model_data['spof_answer'] = $spof_answer;
				$model_data['multi_answer'] = $multi_answer;
				$model_data['sce'] = $sce;
				$model_data['ece'] = $ece;
				$model_data['pce'] = $pce;
				$model_data['ex'] = $ex;
				$model_data['sis'] = $sis;
				$model_data['spof_value'] = $spof_value;
				$model_data['cas'] = $cas;

				$model_data['inspection_periodicity_hrs'] = default_option($inspection_periodicity_hrs, $inspection_periodicity_hrs);

				//get main role
				$main_role = $main_model->get_ca_role($id, 'main');
				$main_ca_role_id = $main_role->ca_role_id;
				$main_role_id = $main_role->role_id;
				$main_role_name = $main_role->name;

				$model_data['ca_role_id'] = $main_ca_role_id;
				$model_data['role_id'] = $main_role_id;
				$model_data['role_name'] = $main_role_name;
				
				$role_dropdown = $this->get_dropdown_menu($main_role_id, 'ca_role');
				$model_data['role_dropdown'] = $role_dropdown;

				$roles = $this->get_ca_roles_checkbox($id);
				$model_data['roles_checkbox'] = $roles;


				$model_data['form_submit_url'] = 'criticality_analysis/calculate_scoring/link/edit';
				$model_data['action'] = $action;
				$model_data['questions'] = $this->get_ca_questions('edit', $id);

				$redundant_equipments = $main_model->get_ca_redundancy($id);

				/*echo '<pre>';
				var_dump($redundant_equipments);
				echo '</pre>';*/

				$redundant_ids = array();

				foreach($redundant_equipments as $redundant_equipment){
					$redundant_ids[] = $redundant_equipment->ce_id_redundant;
				}

				$redundant_ce = implode(",",$redundant_ids);

				$model_data['redundant_ids'] = $redundant_ce;
				
				break;
		}

		$header_data = array();
		# Inlude roles in database.
		$this->load->model('Criticality_Analysis_Model');
		$criticality_analysis_model = new Criticality_Analysis_Model();

		$model_data['roles'] = $criticality_analysis_model->get_all_roles();

		// Add Javascript Listener.
		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Criticality_Analysis.get_tag_data()', 
			'Module.Criticality_Analysis.ca_yes_no()',
			'Module.Criticality_Analysis.role_multi_test()',
			'Module.Criticality_Analysis.available_redundancy()',
			'Module.Criticality_Analysis.mutually_exclusive_dropdown()',
			'Module.Criticality_Analysis.calculate_cas()',
			'Module.Scoring.Sticky()',
			'Module.Scoring.Loading()',
			'Module.Scoring.Suggest()',
			'Module.Criticality_Analysis.multi_role()',
			'Module.Criticality_Analysis.add_reset_button()',
			'Module.Scoring.multi_functional()',
			'Module.Criticality_Analysis.insert_ce_code_data()',
			'Module.Criticality_Analysis.change_final_redundancies()'
		);

		# end of modification.
		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'criticality_analysis/criticality-analysis-scoring', $model_data );
		$this->load->view( 'layout/footer_2', $footer_data );
	}

	public function ajax_get_all_parent_sce() 
	{
		$asset_id = $this->input->get('asset_id');
		$result = $this->main_model->get_all_parent_sce($asset_id);

		print( json_encode($result) );
	}

	public function ajax_get_ce_equipment_code() {
		$data = $this->input->post();

		if($data) 
		{
			
			if( isset($data['code']) ) 
			{
				$code = trim($data['code']);
				$critical_equipment_id = trim($data['critical_equipment_id']);

				$result = $this->main_model->get_ce_by_exclusion($code, $critical_equipment_id);

				$data = array();
				$data['result'] = $result;

				$checked_ce = explode(',', $this->input->post('redundant_ids'));
				$data['checked_ce'] = $checked_ce;

				print $this->load->view('criticality_analysis/criticality-analysis-get-table', $data);
			}
		}
	}

	public function critical_equipment(){

		$data = $this->input->post();

		// Define alert messages.
		$alert_status = false;
		$alert_class = '';
		$alert_message = '';

		$main_model = $this->main_model;

		if($data)
		{
			// Isolate and insert.
			$ref = $this->input->post('ref');
            $tag_number = $this->input->post('tag_number');
            $subsystem_component = $this->input->post('subsystem_component');
            $code = $this->input->post('code');
            $quantity = $this->input->post('quantity');
            $conflict = $this->input->post('conflict');
            $availability = $this->input->post('availability');
            $rule_set = $this->input->post('rule_set');
            $source_of_information = $this->input->post('source_of_information');
            $ce_group_id = $this->input->post('ce_group_id');
            $ce_parent_sce_id = $this->input->post('ce_parent_sce_id');

			$result = $main_model->add_ce($ref, $tag_number, $subsystem_component, $code, $quantity, $conflict, 
                        $availability, $rule_set, $source_of_information, $ce_group_id, $ce_parent_sce_id);

			if( is_numeric($result) ) 
			{
				// Confirmation message change.
				$alert_status = true;
				$alert_class = 'alert-success';
				$alert_message = '<b>Critical Equipment Added!</b>';
			}
		}

		//$this->is_logged_in();
		$data = $this->input->post();

		$model_data = array();

		$dropdown_values = $main_model->get_asset_ce();
		
		$model_data['dropdown_values'] = $dropdown_values;
		$model_data['asset_ce_dropdown'] = $this->get_dropdown_menu(null, 'criticality_asset');
		$model_data['groups'] = $this->main_model->get_all_groups();
		$model_data['alert_status'] = $alert_status;
		$model_data['alert_class'] = $alert_class;
		$model_data['alert_message'] = $alert_message;

		$footer_data = array();
		$footer_data['listeners'] = array('Module.Critical_Equipment.asset_listener()',	
										  'Module.Critical_Equipment.parent_sce_listener()',
										  'Module.Critical_Equipment.getCriticalEquipment()',
										  'Module.Critical_Equipment.get_critical_equipment_edit_details()'
										 );
		
		$this->load->view( 'layout/header' );
		$this->load->view( 'criticality_analysis/critical-equipment', $model_data );
		$this->load->view( 'layout/footer_2', $footer_data );
	}


	public function filter_cas(){

		$data = $this->input->get();

		if($data){

			$main_model = $this->main_model;

			extract( $data, EXTR_SKIP );

			switch($main_filter){
				case "analysed":
					$ca_list = $main_model->get_ca_list();
					$model_data = array(
							'list' => $ca_list
						);
					echo $this->load->view( 'criticality_analysis/ca-analysed-list', $model_data );
					break;

				case "awaiting_analysis":
					$ce_list = $main_model->get_ce_not_analysed();
					$model_data = array(
							'list' => $ce_list
						);
					echo $this->load->view( 'criticality_analysis/ca-analysed-list', $model_data );
					break;

				default:
					$ce_list = $main_model->get_ce_not_analysed();
					$model_data = array(
							'list' => $ce_list
						);
					echo $this->load->view( 'criticality_analysis/ca-analysed-list', $model_data );
					break;
			}
		}
	}

	public function filter_cas_2(){

		$data = $this->input->get();

		if($data){

			$main_model = $this->main_model;

			extract( $data, EXTR_SKIP );

			switch($main_filter){
				case "analysed":
					$ca_list = $main_model->get_ca_list();
					$model_data = array(
							'list' => $ca_list
						);
					echo $this->load->view( 'criticality_analysis/ca-analysed-list_new', $model_data );
					break;

				case "awaiting_analysis":
					$ce_list = $main_model->get_ce_not_analysed();
					$model_data = array(
							'list' => $ce_list
						);
					echo $this->load->view( 'criticality_analysis/ca-analysed-list_new', $model_data );
					break;

				default:
					$ce_list = $main_model->get_ce_not_analysed();
					$model_data = array(
							'list' => $ce_list
						);
					echo $this->load->view( 'criticality_analysis/ca-analysed-list_new', $model_data );
					break;
			}
		}
	}

	public function stage(){

		//$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;

		$ca_list = $main_model->get_ca_list();

		//$details = $main_model->get_ca();

		$model_data = array(
				'list' => $ca_list,
				'controller' => $this->controller,
				'method' => $this->method
			);

		//var_dump($ca_list);
		//var_dump($details);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Criticality_Analysis.filter_cas()',
			'Module.Criticality_Analysis.refresh_cas_list()',
			'Module.Criticality_Analysis.CSV_process()'
		);

		$this->load->view( 'layout/header' );
		$this->load->view( 'criticality_analysis/criticality-analysis-stage', $model_data );
		$this->load->view( 'layout/footer_2', $footer_data );

	}

	public function stage_new(){

		//$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;

		$ca_list = $main_model->get_ca_list();

		//$details = $main_model->get_ca();

		$model_data = array(
				'list' => $ca_list,
				'controller' => $this->controller,
				'method' => $this->method
			);

		//var_dump($ca_list);
		//var_dump($details);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Criticality_Analysis.filter_cas_2()',
			'Module.Criticality_Analysis.refresh_cas_list_2()',
			'Module.Criticality_Analysis.CSV_process()'
		);

		$this->load->view( 'layout/header' );
		$this->load->view( 'criticality_analysis/criticality-analysis-stage', $model_data );
		$this->load->view( 'layout/footer_2', $footer_data );

	}

	public function ajax_get_scoring_detail_totals()
	{
		$criticality_analysis_id = $this->input->get('criticality_analysis_id');

		// Load model and query.
		$scoring_detail_totals = $this->main_model->get_scoring_detail_totals($criticality_analysis_id);

		print( json_encode( $scoring_detail_totals ) );
	}

	public function ajax_update_critical_equipment() 
	{
		$data = $this->input->post();

		if($data) 
		{
			$this->load->model('Criticality_Analysis_Model');
			$criticality_analysis_model = new Criticality_Analysis_Model();

			$result = $criticality_analysis_model->update_critical_equipment($data);

			if($result) 
			{
				print 'True.';
			}
			else 
			{
				print 'False.';
			}
		}
	}

	public function stage_details($id){

		// $this->is_logged_in();
		$data = $this->input->get();

		$main_model = $this->main_model;
		$details = $main_model->get_ca($id);
		
		$model_data = array();

		//Detail values for cas
		$model_data['se_value'] = $details->se_value;
		$model_data['ce_parent_sce_id'] = $details->ce_parent_sce_id;
		$model_data['total_scoring_details'] = $this->main_model->get_scoring_detail_totals($id);
		$model_data['id'] = $id;

		$results = array();

		//$model_data['data'] = $model_data;
		//$this->load->view( 'layout/header' );
		echo $this->load->view( 'criticality_analysis/criticality-analysis-stage-modal', $model_data, true );
		//$this->load->view( 'layout/footer' );

	}


	public function edit_ce($id){

		//modal content
		$main_model = $this->main_model;

		$result = $main_model->get_ce_id($id);

		//var_dump($result);

		$model_data = array();

		$model_data['critical_equipment_id'] = $result->critical_equipment_id;
		$model_data['ref'] = $result->ref;
		$model_data['tag_number'] = $result->tag_number;
		$model_data['subsystem_component'] = $result->subsystem_component;
		$model_data['code'] = $result->code;
		$model_data['quantity'] = $result->quantity;
		$model_data['conflict'] = $result->conflict;
		$model_data['availability'] = $result->availability;
		$model_data['rule_set'] = $result->rule_set;
		$model_data['source_of_information'] = $result->rule_set;
		$model_data['ce_group_id'] = $result->rule_set;
		$model_data['ce_parent_sce_id'] = $result->rule_set;

		$results = array();

		//$model_data['data'] = $model_data;
		//$this->load->view( 'layout/header' );
		echo $this->load->view( 'criticality_analysis/ce-edit', $model_data, true );
		//$this->load->view( 'layout/footer' );
	}


	public function create_ce(){

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );
		
		var_dump($data);

		if($data){

			extract( $data, EXTR_SKIP );

			//var_dump($data);

			$main_model = $this->main_model;

			$main_model->add_ce($tag_number, $subsystem_component, $code, $quantity, $conflict, $availability, $rule_set, $source_of_information, $ce_parent_sce_id);

			redirect('criticality-analysis/critical-equipment');
			
		}
	}

	public function edit_critical_equipment($id){

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );



		if($data){

			extract( $data, EXTR_SKIP );

			//var_dump($data);

			$main_model = $this->main_model;

			$main_model->edit_ce($id, $asset_id, $ref, $tag_number, $subsystem_component, $code, $quantity, $conflict, $availability, $rule_set, $source_of_information, $ce_group_id);

			redirect('criticality-analysis/critical-equipment');
			
		}

	}

	public function delete_critical_equipment($id){

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$session_site_role = $user_model->get_value( $user_id, 'role' );

		//var_dump($id);

		$main_model->delete_ce($id);
		
		redirect('criticality-analysis/critical-equipment');
	}

	public function role_list(){

		$data = $this->input->post();

		var_dump($data);
	}


	public function get_multi_role(){

		$this->is_logged_in();
		$data = $this->input->post();

		$main_model = $this->main_model;


		//$this->load->view( 'layout/header' );
		$this->load->view( 'criticality_analysis/get-role' );
		//$this->load->view( 'layout/footer' );

	}


	public function get_ce_by_group(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$checked_ce = explode(',', $redundant_ids);

			//$critical_equipment_id = 172;
			//$code = "PUGN";

			$main_model = $this->main_model;

			$results = $main_model->get_ce_by_group_id($code, $critical_equipment_id);
			$results2 = $main_model->get_ce_by_exclusion($code, $critical_equipment_id);

			$model_data = array(
					'equipments' => $results,
					'excluded_equipments' => $results2,
					'code' => $code,
					'checked_ce' => $checked_ce
				);

			echo $this->load->view('criticality_analysis/ce-redundancy', $model_data);

		}
	}


	public function get_ce_by_ids(){

		$data = $this->input->post();

		if($data){
			$main_model = $this->main_model;
			extract( $data, EXTR_SKIP );



			$checked_ce = explode(',', $redundant_ids);
			$results = $main_model->get_redundancy_with_ids($redundant_ids, $code);

			//var_dump($this->db->last_query());

			$output = '';

			if(!empty($results)){
				foreach($results as $result){

					$ce_id = $result->critical_equipment_id;
					if(!empty($checked_ce)){
						if(in_array($ce_id, $checked_ce)){
							$checked_ce_display = "checked";
						}else{
							$checked_ce_display = "";
						}
					}else{
						$checked_ce_display = "";
					}

					$output .= '<tr>';
					$output .= '	<td>'.$result->asset_code.'</td>';
					$output .= '	<td>'.$result->tag_number.'</td>';
					$output .= '	<td>'.$result->subsystem_component.'</td>';
					$output .= '	<td>'.$result->code.'</td>';
					$output .= '	<td class="text-center">';
					$output .= '		<input  data-full='.json_encode($result).' name="add_equipment['.$ce_id.']" value="'.$ce_id.'" type="checkbox" '.$checked_ce_display.'>';
					$output .= '	</td>';
					$output .= '</tr>';
				}
			}

			echo $output;
		}


	}

	public function process_available_redundancy(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$ce_array = array();

			if(!empty($add_equipment)){
				foreach($add_equipment as $ce){
					$ce_array[] = $ce;
				}

				$redundant_ce = implode(",",$ce_array);

				$equipment_count = count($add_equipment);
			}else{
				$equipment_count = 0;
				$redundant_ce = '';
			}
			

			$json_array = array(
					'equipment_count' => $equipment_count,
					'redundant_ids' => $redundant_ce
				);

			echo json_encode($json_array);

			//echo $add_equipment_count;
			//echo $redundant_ce;
		}
	}


	public function inspection_frequency(){


		$data = $this->input->post();

		$main_model = $this->main_model;

		$footer_data = array();
		$footer_data['listeners'] = array(
			//'Module.Criticality_Analysis.filter_cas()',
			//'Module.Criticality_Analysis.refresh_cas_list()'
		);

		$this->load->view( 'layout/header' );
		$this->load->view( 'criticality_analysis/inspection-frequency');
		$this->load->view( 'layout/footer_2', $footer_data );


	}


	public function ip(){

		$main_model = $this->main_model;

		$results = $main_model->get_ip_list();
		$ce_count = $main_model->get_inspected_ce_count();

		$model_data = array(
				'results' => $results,
				'ce_count' => $ce_count
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			//'Module.Criticality_Analysis.filter_cas()',
			//'Module.Criticality_Analysis.refresh_cas_list()'
		);

		$this->load->view( 'layout/header' );
		$this->load->view( 'criticality_analysis/ip', $model_data);
		$this->load->view( 'layout/footer_2', $footer_data );

	}


}

/* End of file criticality_analysis.php */
/* Location: ./application/controllers/criticality_analysis.php */
