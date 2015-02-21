<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Curiculum extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'Curiculum_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;
	}

	public function index() {
		
		redirect('curiculum/manage_curiculum');
	}

	/*pages */
	public function manage_curiculum(){
		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();

		$model_data = array(
				'school_year_dropdown' => $this->school_year_dropdown()
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.add_grade_level()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/index', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function offer_subject(){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();

		$model_data = array(
				'grade_level_dropdown' => $this->grade_level_dropdown(),
				'school_year_dropdown' => $this->school_year_dropdown(),
				'error' => $this->session->flashdata('error'),
				'success' => $this->session->flashdata('success')
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.offer_subject()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/offer-subject', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function add_section(){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();

		$model_data = array(
				'grade_level_dropdown' => $this->grade_level_dropdown(),
				'school_year_dropdown' => $this->school_year_dropdown()
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.add_grade_level()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/add-section', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function assign_instructor(){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();

		$model_data = array(
				'grade_level_dropdown' => $this->grade_level_dropdown(),
				'school_year_dropdown' => $this->school_year_dropdown(),
				'error' => $this->session->flashdata('error'),
				'success' => $this->session->flashdata('success')
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.assign_instructor()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/assign-instructor', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function enroll_student(){

		$this->is_logged_in();

		$user_model = $this->user_model;
		$student_user_type = 3;
		$user_dropdown = $this->user_dropdown(3);

		$header_data = array();

		$model_data = array(
				'grade_level_dropdown' => $this->grade_level_dropdown(),
				'school_year_dropdown' => $this->school_year_dropdown(),
				'student_dropdown' => $user_dropdown,
				'error' => $this->session->flashdata('error'),
				'success' => $this->session->flashdata('success')
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.enroll_student()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/enroll-student', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function manage_grades(){

		/*
		
		FOR ADMIN
		select school year
		grade level
		section name
		offered subjects
		autocomplete instructor name

		FOR INSTRUCTOR
		user id from session
		school year
		assigned grade level
		assigned section
		assigned subjects

		*/

		$this->is_logged_in();

		$user_model = $this->user_model;
		$student_user_type = 3;
		$user_dropdown = $this->user_dropdown(3);

		$header_data = array();

		$model_data = array(
				'grade_level_dropdown' => $this->grade_level_dropdown(),
				'school_year_dropdown' => $this->school_year_dropdown(),
				'student_dropdown' => $user_dropdown,
				'error' => $this->session->flashdata('error'),
				'success' => $this->session->flashdata('success')
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.manage_grades()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/manage-grades', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	/* submits */
	public function create_grade_level(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$exist = $this->school_year_exist($sy_start, $sy_end);

			if(!$exist){

				for($i=1;$i<=4;$i++){
					$grade_level_id = $main_model->create_grade_level($sy_start, $sy_end, $i);
				}
				
				$success_message = "Grade Level was added successfully. ";

				if($grade_level_id){

					$json_result = array(
						'grade_level_id' => $grade_level_id,
						'result' => 'success',
						'success_message' => $success_message
						);
				}else{
					$json_result = array(
						'result' => 'failed'
						);
				}

				$json_result['grade_level'] = 'success';      

			}else{
				$json_result = array(
					'grade_level' => 'failed',
					'grade_level_message' => 'Grade Level already exist. ',
					'result' => 'failed'
					);
			}

			echo json_encode($json_result);




		}
	}

	public function create_single_grade_level(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$exist = $this->grade_level_exist($grade_level, $sy_start, $sy_end);

			if(!$exist){

				$grade_level_id = $main_model->create_grade_level($sy_start, $sy_end, $grade_level);
				$success_message = "Grade Level was added successfully. ";

				if($grade_level_id){

					$json_result = array(
						'grade_level_id' => $grade_level_id,
						'result' => 'success',
						'success_message' => $success_message
						);
				}else{
					$json_result = array(
						'result' => 'failed'
						);
				}

				$json_result['grade_level'] = 'success';      

			}else{
				$json_result = array(
					'grade_level' => 'failed',
					'grade_level_message' => 'Grade Level already exist. ',
					'result' => 'failed'
					);
			}

			echo json_encode($json_result);




		}
	}

	public function submit_add_section(){

		$data = $this->input->post();

		if($data){
			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$school_year = explode('-', $school_year);
			$sy_start = $school_year[0];
			$sy_end = $school_year[1];

			$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);

			$exist = $this->section_exist($grade_level_id, $section);

			if($exist){
				echo json_encode('failed');
			}else{
				$offer_id = $main_model->add_section($grade_level_id, $section);
				redirect('curiculum/add-section');
			}
			
		}
	}

	public function submit_offer_subject(){

		$data = $this->input->post();

		if($data){
			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			if($section != '' && $subject != ''){

				

				$exist = $this->subject_offer_exist($section, $subject);

				if($exist){
					$this->session->set_flashdata( 'error', 'Subject already offered.' );
				}else{
					var_dump($data);
					$subj_offerid = $main_model->offer_subject($section, $subject);
					$this->assign_subject_defaults($subj_offerid);
					$this->session->set_flashdata( 'success', 'Subject was successfully offered.' );
				}

			}else{
				$this->session->set_flashdata( 'error', 'Please select section and subject.' );
			}

			redirect('curiculum/offer-subject');

			
			
		}
	}

	public function submit_assign_instructor(){

		$data = $this->input->post();

		if($data){
			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			if($section != '' && $subject != '' && $user != ''){

				$subj_offerid = $main_model->get_subject_offerid($section, $subject);

				$exist = $this->teacher_subject_exist($subj_offerid, $user);

				if($exist){
					$this->session->set_flashdata( 'error', 'Instructor already assigned to subject.' );
				}else{
					var_dump($data);
					$main_model->assign_instructor($subj_offerid, $user);
					
					$this->session->set_flashdata( 'success', 'Instructor was successfully assigned.' );
				}

			}else{
				$this->session->set_flashdata( 'error', 'Please select section ,subject and instructor name.' );
			}

			redirect('curiculum/assign-instructor');

			
			
		}
	}

	public function submit_enroll_student(){

		$data = $this->input->post();

		if($data){
			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			if($school_year != '' && $grade_level != '' && $section != '' && $student != ''){

				$school_year = explode('-', $school_year);
				$sy_start = $school_year[0];
				$sy_end = $school_year[1];

				$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);
				$exist = $this->enroll_student_exist($grade_level_id, $student);

				if($exist){
					$this->session->set_flashdata( 'error', 'Student already enrolled.' );
				}else{
					var_dump($data);
					$main_model->enroll_student($section, $student);
					
					$this->session->set_flashdata( 'success', 'Student was successfully enrolled.' );
				}

			}else{
				$this->session->set_flashdata( 'error', 'Please select schoolyear, grade level and section.' );
			}

			redirect('curiculum/enroll-student');	
		}
	}

	public function submit_manage_grades(){

		$data = $this->input->post();

		if($data){
			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			if($school_year != '' && $grade_level != '' && $section != '' && $student != ''){

				$school_year = explode('-', $school_year);
				$sy_start = $school_year[0];
				$sy_end = $school_year[1];

				$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);
				$exist = $this->enroll_student_exist($grade_level_id, $student);

				if($exist){
					$this->session->set_flashdata( 'error', 'No Grades Allocated.' );
				}else{
					var_dump($data);
					$main_model->enroll_student($section, $student);
					$this->session->set_flashdata( 'success', 'Student was successfully enrolled.' );
				}

			}else{
				$this->session->set_flashdata( 'error', 'Please select schoolyear, grade level and section.' );
			}

			redirect('curiculum/manage-grades');	
		}
	}

	/* adds */
	public function assign_subject_defaults($subj_offerid){

		for($i=1;$i<=4;$i++){

			//exam
			$exam_id = $main_model->add_exam($subj_offerid, '', $i);

			//quiz
			for($quiz_counter=1;$quiz_counter<=6;$quiz_counter++){
				$main_model->add_quiz($subj_offerid, '', $i, 'Q'.$quiz_counter);
			}

			//recitation
			for($recitation_counter=1;$recitation_counter<=4;$recitation_counter++){
				$main_model->add_recitation($subj_offerid, '', $i, 'R'.$recitation_counter);
			}

			//assignment
			for($assignment_counter=1;$assignment_counter<=5;$assignment_counter++){
				$main_model->add_assignment($subj_offerid, '', $i, 'A'.$assignment_counter);
			}

			//project
			for($project_counter=1;$project_counter<=2;$project_counter++){
				$main_model->add_assignment($subj_offerid, '', $i, 'P'.$project_counter);
			}
			
		}
	}




	/* validations */
	public function school_year_exist($sy_start, $sy_end){

		$main_model = $this->main_model;

		$count = $main_model->count_school_year($sy_start, $sy_end);

		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	public function single_grade_level_exist($grade_level, $sy_start, $sy_end){

		$main_model = $this->main_model;

		$count = $main_model->count_grade_level($grade_level, $sy_start, $sy_end);

		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	public function section_exist($grade_level_id, $section){

		$main_model = $this->main_model;

		$count = $main_model->count_section($grade_level_id, $section);

		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	public function subject_offer_exist($section, $subject){

		$main_model = $this->main_model;

		$count = $main_model->count_offered_subject($section, $subject);

		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	public function teacher_subject_exist($subj_offerid, $user_id){

		$main_model = $this->main_model;

		$count = $main_model->count_assigned_teachers($subj_offerid, $user_id);

		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	public function enroll_student_exist($grade_level_id, $user_id){

		$main_model = $this->main_model;

		$count = $main_model->count_enrolled_students($grade_level_id, $user_id);

		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	/* lists */
	public function class_offerings($sy_start = '2015', $sy_end = '2016'){

		$main_model = $this->main_model;

		$year_levels = $main_model->get_available_year_level_by_school_year($sy_start, $sy_end);

		$output = "";

		foreach($year_levels as $year){

			$grade_level_id = $year->gl_id;
			$grade_level = $year->grade_level;

			$output .= '<h3>Grade '.$grade_level.'</h3>';

			$sections = $main_model->get_sections_by_grade_level($grade_level_id);

			$output .= '<table class="table no-border">';

			if(empty($sections)){
				$output .= "<tr><td>No Sections Added.</td></tr>";
			}else{
				foreach($sections as $section){

					$offer_id = $section->offer_id;
					$section_name = $section->section;

					$output .= '<tr>';
					$output .= '<td>Grade '.$section_name.'</td>';
					$output .= '<td><a href="#">View</a></td>';
					$output .= '</tr>';
				}
			}
			

			$output .= "</table>";
		}


		echo $output;
	}

	/*dropdown ajax */
	public function section_dropdown_by_info(){

		$data = $this->input->get();

		if($data){

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			if($school_year != '' && $grade_level != ''){
				$school_year = explode('-', $school_year);
				$sy_start = $school_year[0];
				$sy_end = $school_year[1];

				$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);
				$option = '<option value="">Select</option>';
				$option .= $this->section_dropdown($grade_level_id);

				if($option == '<option value="">Select</option>'){
					$success = false;
				}else{
					$success = true;
				}
				
			}else{
				$option = '';

				if($option == ''){
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

	public function subjects_not_assigned_dropdown_by_info(){

		$data = $this->input->get();

		if($data){

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			$school_year = explode('-', $school_year);
			$sy_start = $school_year[0];
			$sy_end = $school_year[1];

			$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);

			$option = '<option value="">Select</option>';

			$option .= $this->subjects_not_assigned_by_detail_dropdown($grade_level_id, $section);

			if($option == '<option value="">Select</option>'){
				$success = false;
			}else{
				$success = true;
			}

			$json_array = array(
					'success' => $success,
					'html' => $option
				);

			echo json_encode($json_array);
		}
	}

	public function subjects_not_offered_dropdown_by_info(){

		$data = $this->input->get();

		if($data){

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			$option = '<option value="">Select</option>';

			$option .= $this->subjects_not_offered_dropdown($section);

			if($option == '<option value="">Select</option>'){
				$success = false;
			}else{
				$success = true;
			}

			$json_array = array(
					'success' => $success,
					'html' => $option
				);

			echo json_encode($json_array);
		}
	}

	public function subjects_offered_dropdown_by_info(){

		$data = $this->input->get();

		if($data){

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			$option = '<option value="">Select</option>';

			$option .= $this->subjects_offered_dropdown($section);

			if($option == '<option value="">Select</option>'){
				$success = false;
			}else{
				$success = true;
			}

			$json_array = array(
					'query' => $this->db->last_query(),
					'success' => $success,
					'html' => $option
				);

			echo json_encode($json_array);
		}
	}

	public function unassigned_instructors_dropdown_by_info(){

		$data = $this->input->get();

		if($data){

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			$option = '<option value="">Select</option>';

			$option .= $this->unassigned_instructors_dropdown($section, $subject);

			if($option == '<option value="">Select</option>'){
				$success = false;
			}else{
				$success = true;
			}

			$json_array = array(
					'success' => $success,
					'html' => $option
				);

			echo json_encode($json_array);
		}
	}

	/*dropdown*/
  	public function section_dropdown($grade_level_id){

	    $this->load->model('Curiculum_Model');
	    $main_model = new Curiculum_Model;

	    $results = $main_model->get_sections_by_grade_level($grade_level_id);

	    $option = "";

	    foreach($results as $result){

	      $offer_id = $result->offer_id;
	      $section = $result->section;

	      $option .= '<option value="'.$offer_id.'">'.$section.'</option>';
	    }

	    return $option;
	}

	public function subjects_not_assigned_by_detail_dropdown($grade_level_id, $section_id){

		$this->load->model('Curiculum_Model');
	    $main_model = new Curiculum_Model;

	    $results = $main_model->get_subjects_not_assigned_by_detail($grade_level_id, $section_id);

	    $option = "";

	    foreach($results as $result){

	      $subj_id = $result->subj_id;
	      $subj_code = $result->subj_code;

	      $option .= '<option value="'.$subj_id.'">'.$subj_code.'</option>';
	    }

	    return $option;
	}

	public function subjects_not_offered_by_detail_dropdown($grade_level_id, $section_id){

		$this->load->model('Curiculum_Model');
	    $main_model = new Curiculum_Model;

	    $results = $main_model->get_subjects_not_offered_by_detail($grade_level_id, $section_id);

	    $option = "";

	    foreach($results as $result){

	      $subj_id = $result->subj_id;
	      $subj_code = $result->subj_code;

	      $option .= '<option value="'.$subj_id.'">'.$subj_code.'</option>';
	    }

	    return $option;
	}

	public function subjects_not_offered_dropdown($section_id){

		$this->load->model('Curiculum_Model');
	    $main_model = new Curiculum_Model;

	    $results = $main_model->get_subjects_not_offered($section_id);

	    $option = "";

	    foreach($results as $result){

	      $subj_id = $result->subj_id;
	      $subj_code = $result->subj_code;

	      $option .= '<option value="'.$subj_id.'">'.$subj_code.'</option>';
	    }

	    return $option;
	}

	public function subjects_offered_dropdown($section_id){

		$this->load->model('Curiculum_Model');
	    $main_model = new Curiculum_Model;

	    $results = $main_model->get_subjects_offered($section_id);

	    $option = "";

	    foreach($results as $result){

	      $subj_id = $result->subj_id;
	      $subj_code = $result->subj_code;

	      $option .= '<option value="'.$subj_id.'">'.$subj_code.'</option>';
	    }

	    return $option;
	}

	public function unassigned_instructors_dropdown($section, $subject){

		$this->load->model('Curiculum_Model');
	    $main_model = new Curiculum_Model;

	    $results = $main_model->get_unassigned_instructors_by_subject_offering($section, $subject);

	    $option = "";

	    foreach($results as $result){

	      $user_id = $result->user_id;
	      $fullname = $result->fname . ' ' . $result->mname . ' ' . $result->lname;

	      $option .= '<option value="'.$user_id.'">'.$fullname.'</option>';
	    }

	    return $option;
	}



}

/* End of file curiculum.php */
/* Location: ./application/controllers/curiculum.php */