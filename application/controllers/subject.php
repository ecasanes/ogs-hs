<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Subject extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'Subject_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->form_primary = 'subject_id';
	}

	public function index() {
		redirect('subject/add');
	}

	/*pages*/
	public function add(){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();
		$model_data = array(
				'grade_level_dropdown' => $this->grade_level_dropdown(),
				'school_year_dropdown' => $this->school_year_dropdown()
			);
		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Subject.add_subject()', 
			'Module.Subject.refresh_subject_list()',
			'Module.Subject.edit_subject()',
			'Module.Subject.filter_subject()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'subject/add', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function assign_subject_grade_level(){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();
		$model_data = array(
				'no_grade_level_subject_dropdown' => $this->no_grade_level_subject_dropdown(),
				'grade_level_dropdown' => $this->grade_level_dropdown(),
				'school_year_dropdown' => $this->school_year_dropdown(),
				'error' => $this->session->flashdata('error'),
				'success' => $this->session->flashdata('success')
			);
		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.AssignSubject.get_subject_per_year_level()',
			'Module.AssignSubject.filter_assigned_subjects()',
			'Module.AssignSubject.refresh_assigned_subject_list()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'subject/assign-subject-grade-level', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);

	}

	/*validations*/
	public function subject_code_grade_level_exist($sy_start, $sy_end, $grade_level, $subject_id){

		$main_model = $this->main_model;

		$count = $main_model->count_subject_by_grade_level($sy_start, $sy_end, $grade_level, $subject_id);

		/*var_dump($this->db->last_query());
		var_dump($count);*/

		if($count > 0){
			return true;
		}else{
			return false;
		}
	}


	public function subject_code_year_level_exist($grade_level, $subject_id){

		$main_model = $this->main_model;

		$count = $main_model->count_subject_by_year_level($grade_level, $subject_id);

		/*var_dump($this->db->last_query());
		var_dump($count);*/

		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	/*submits*/
	public function create_subject(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$this->load->model('Curiculum_Model');
			$curiculum_model = new Curiculum_Model;
			$main_model = $this->main_model;

			$this->load->library( 'form_validation' );

			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_message( 'is_unique', 'failed' );

			$this->form_validation->set_rules( 'subject_code', 'Subject Code', 'is_unique[tbl_subject.subj_code]' );

			/*$school_year = explode('-', $school_year);
			$sy_start = $school_year[0];
			$sy_end = $school_year[1];*/

			$subject_code_unique = $this->form_validation->run();
			//$grade_level_exist = $this->subject_code_grade_level_exist($sy_start, $sy_end, $grade_level, $subject_code);
			$grade_level_exist = $this->subject_code_year_level_exist($grade_level, $subject_code);

			if( $subject_code_unique == false && $grade_level_exist == true){

				$message ="Subject was already assigned to Year Level";
				$result = "failed";
				$field_group = "school_year";

			}else if(($subject_code_unique == false && $grade_level_exist == false) || ($subject_code_unique == true && $grade_level_exist == false)){

				$subj_id = $main_model->create_subject($subject_code, $subject_unit, $subject_description, $grade_level);
				//$grade_level_id = $curiculum_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);
				//$main_model->add_subject_grade_level($subj_id, $grade_level_id);

				$message = "Subject was added successfully. ";
				$result = "success";
				$field_group = "";

			}else if($subject_code_unique == false){

				$message = "Subject Code already exist.";
				$result = "failed";
				$field_group = "subject_code";
				
			}

			$json_result = array(
				'result' => $result,
				'message' => $message,
				'field_group' => $field_group,
				'subject_code_unique' => $subject_code_unique,
				'grade_level_exist' => $grade_level_exist
			);

			echo json_encode($json_result);

		}
	}

	public function submit_assign_grade_level(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$this->load->model('Curiculum_Model');
			$curiculum_model = new Curiculum_Model;
			$main_model = $this->main_model;

			$school_year = explode('-', $school_year);
			$sy_start = $school_year[0];
			$sy_end = $school_year[1];

			foreach($subject as $subj){

				$exist = $this->subject_code_grade_level_exist($sy_start, $sy_end, $grade_level, $subj);

				if ( !$exist ) {

					$grade_level_id = $curiculum_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);
					$main_model->add_subject_grade_level($subj, $grade_level_id);

					//var_dump($this->db->last_query());

					$this->session->set_flashdata( 'success', 'Grade level successfully assigned to subject.' );

				}else{

					$this->session->set_flashdata( 'error', 'Subject already assigned to grade level.' );
					
				}

			}

			

			redirect('subject/assign-subject-grade-level');




		}
	}

	public function remove(){

		$data = $this->input->post();

		if($data){

			$main_model = $this->main_model;

			$id = $this->input->post('id');

			//$subj_offerid = $main_model->get_subj_offerid_by_subject($id);

			//$main_model->delete_all_with_subj_offerid($subj_offerid);

			$main_model->remove_subject($id);

			$json_result = array(
					'success' => true,
					'message' => "Subject successfully removed."
				);

			echo json_encode($json_result);
		}
	}

	public function update(){

		$data = $this->input->post();

		if($data){

			$main_model = $this->main_model;

			extract( $data, EXTR_SKIP );

			$main_model->update_subject($id, $subj_code, $subj_desc, $subj_unit);

			$json_result = array(
					'success' => true,
					'id' => $id,
					'message' => "Subject successfully updated."
				);

			echo json_encode($json_result);
		}
	}

	/*lists*/
	public function data_list(){

		$main_model = $this->main_model;
		$controller = $this->controller;

		$results = $main_model->get_subjects();

		$model_data = array(
			'results' => $results
			);

		$this->load->view($controller.'/list', $model_data);
	}

	public function filter_subject(){

		$main_model = $this->main_model;
		$controller = $this->controller;

		$school_year = $this->input->get('school_year');
		$year_level = $this->input->get('grade_level');

		if(isset($school_year) && $school_year != ''){
			$school_year = explode('-', $school_year);
			$sy_start = $school_year[0];
			$sy_end = $school_year[1];
		}else{
			$sy_start = null;
			$sy_end = null;
		}
		

		$results = $main_model->get_subjects_by_school_year_and_grade_level($sy_start, $sy_end, $year_level);

		$model_data = array(
			'results' => $results
			);

		$this->load->view($controller.'/lists/assigned-subject-list', $model_data);
	}

	public function search_list(){

		$main_model = $this->main_model;
		$user_model = $this->user_model;
		$user_type = $this->user_type;
		$controller = $this->controller;

		$search_key = $this->input->get('search');

		$results = $main_model->search_list($search_key, $user_type);

		$model_data = array(
			'results' => $results
			);

		$this->load->view($controller.'/list', $model_data);
	}

	public function list_assigned_subjects_per_school_year($school_year){
		//by grade level from school year
		//then list subjects
	}

	/*dropdowns*/
	public function no_grade_level_subject_dropdown(){

		$main_model = $this->main_model;

		$results = $main_model->get_subjects_with_no_grade_level();

		$option = "";

	    foreach($results as $result){

	      $subj_id = $result->subj_id;
	      $subj_code = $result->subj_code;
	      $subj_desc = $result->subj_desc;

	      $option .= '<option value="'.$subj_id.'">'.$subj_code.'</option>';
	    }

	    return $option;
	}

	public function with_grade_level_subject_dropdown(){

		$main_model = $this->main_model;

		$results = $main_model->get_subjects_with_grade_level();

		$option = "";

	    foreach($results as $result){

	      $subj_id = $result->subj_id;
	      $subj_code = $result->subj_code;
	      $subj_desc = $result->subj_desc;

	      $option .= '<option value="'.$subj_id.'">'.$subj_code.'</option>';
	    }

	    return $option;
	}

	public function ajax_subjects_by_year_level($html_type = "dropdown"){

		$data = $this->input->get();

		if($data){

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			if($html_type == "dropdown"){
				$option = '<option value="">Select</option>';
			}else{
				$option = "";
			}
			
			$option .= $this->subjects_by_year_level_dropdown($school_year, $year_level, $html_type);

			if($html_type == "dropdown"){
				if($option == '<option value="">Select</option>'){
					$success = false;
				}else{
					$success = true;
				}
			}else{
				if($option == ""){
					$success = false;
				}else{
					$success = true;
				}
			}
			

			$json_array = array(
					'success' => $success,
					'html' => $option
				);

			echo json_encode($json_array);
		}
	}

	public function subjects_by_year_level_dropdown($school_year, $year_level, $html_type = "dropdown"){

		$main_model = $this->main_model;

	    $school_year = explode('-', $school_year);
		$sy_start = $school_year[0];
		$sy_end = $school_year[1];

	    $results = $main_model->get_subjects_not_assigned_by_school_year_and_year_level($sy_start, $sy_end, $year_level);

	    $option = "";

	    foreach($results as $result){

	      $subj_id = $result->subj_id;
	      $subj_code = $result->subj_code;

	      if($html_type == "dropdown"){
	      	$option .= '<option value="'.$subj_id.'">'.$subj_code.'</option>';
	      }else{
	      	$option .= '<div class="checkbox"><label><input value="'.$subj_id.'" name="subject[]" type="checkbox"> '.$subj_code.' </label></div>';
	      }
	      
	    }

	    return $option;
	}

	public function assigned_subjects_list(){

		$main_model = $this->main_model;
		$controller = $this->controller;

		$results = $main_model->get_assigned_subjects();

		$model_data = array(
			'results' => $results
			);

		$this->load->view($controller.'/lists/assigned-subject-list', $model_data);
	}

}

/* End of file subject.php */
/* Location: ./application/controllers/subject.php */