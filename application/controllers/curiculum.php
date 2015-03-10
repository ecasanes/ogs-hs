<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Curiculum extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'Curiculum_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->lowest_grade = 65;
	}

	public function index() {
		
		redirect('curiculum/manage_curiculum');
	}

	/*pages */
	public function manage_curiculum(){
		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();

		$year_lowest_limit = date('Y', strtotime(date("Y", strtotime( date('Y'))) . " - 1 year"));

		$model_data = array(
				'school_year_dropdown' => $this->school_year_dropdown(),
				'year_minus_a_year' => $year_lowest_limit
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.view_class_record()',
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
			'Module.Curiculum.offer_subject()',
			'Module.Subject.filter_offered_subject()',
			'Module.Subject.search_offered_subject()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/offer-subject', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function add_section(){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();

		$success = $this->session->flashdata('success');
		$error = $this->session->flashdata('error');

		$model_data = array(
				'grade_level_dropdown' => $this->grade_level_dropdown(),
				'school_year_dropdown' => $this->school_year_dropdown(),
			);

		if($success){
			$model_data['result'] = true;
			$model_data['message'] = $success;
		}else if($error){
			$model_data['result'] = false;
			$model_data['message'] = $error;
		}

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Section.filter_section()',
			'Module.Section.search_section()'
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
			'Module.Curiculum.assign_instructor()',
			'Module.Subject.filter_offered_subject()',
			'Module.Subject.search_offered_subject()'
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
		
		$main_model = $this->main_model;
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

		//$manage_grade_info = $this->submit_manage_grades();

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.manage_grades()',
			'Module.Curiculum.modify_grades()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/manage-grades', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function view_grades(){

		$this->is_logged_in();

		$user_id = $this->session->userdata('session');

		$user_model = $this->user_model;

		$header_data = array();

		$model_data = array(
				'school_year_dropdown' => $this->student_school_year_dropdown($user_id)
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.view_class_record()',		
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/view-grades', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function manage_grading_system(){

		$this->is_logged_in();
		
		$main_model = $this->main_model;
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

		//$manage_grade_info = $this->submit_manage_grades();

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.Curiculum.manage_grading_system()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/manage-grading-system', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function grade_lock(){

		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();

		$model_data = array(
				'grade_level_dropdown' => $this->grade_level_dropdown(),
				'school_year_dropdown' => $this->school_year_dropdown()
			);

		$footer_data = array();
		$footer_data['listeners'] = array(
			'Module.GradeLock.filter_grade_lock()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'curiculum/grade-lock', $model_data );
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

				if($sy_start >= $sy_end){
					$json_result = array(
						'grade_level' => 'failed',
						'grade_level_message' => 'School year must not start with a much greater value than SY End. ',
						'result' => 'failed'
					);
				}else{

					for($i=1;$i<=4;$i++){
						$grade_level_id = $main_model->create_grade_level($sy_start, $sy_end, $i);
					}
					
					$success_message = "Year Level was added successfully. ";

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
				}

				   

			}else{
				$json_result = array(
					'grade_level' => 'failed',
					'grade_level_message' => 'Year Level already exist. ',
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
				$this->session->set_flashdata( 'error', 'Section already exists.' );
			}else{
				$this->session->set_flashdata( 'success', 'Section successfully saved.' );
				$offer_id = $main_model->add_section($grade_level_id, $section);
				
			}

			redirect('curiculum/add-section');
			
		}
	}

	public function compensate_scores_for_enrolled_students($offer_id, $subj_id, $subj_offerid){

		$main_model = $this->main_model;

		//get enrolled students - section 
		$students = $main_model->get_enrolled_students_by_section($offer_id);

		foreach($students as $student){
			$student_user_id = $student->user_id;
			$this->assign_initial_scores($offer_id, $student_user_id, $subj_offerid);
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
					$this->compensate_scores_for_enrolled_students($section, $subject, $subj_offerid);
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

			if($school_year != '' && $grade_level != '' && $section != '' && !empty($enrolled_students)){

				$school_year = explode('-', $school_year);
				$sy_start = $school_year[0];
				$sy_end = $school_year[1];

				$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);

				foreach($enrolled_students as $student_user_id){

					$exist = $this->enroll_student_exist($grade_level_id, $student_user_id);

					if($exist){
						$this->session->set_flashdata( 'error', 'Student already enrolled.' );
					}else{
						$main_model->enroll_student($section, $student_user_id);
						$this->assign_initial_scores($section, $student_user_id);
						$this->session->set_flashdata( 'success', 'Student was successfully enrolled.' );
					}
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

			if($school_year != '' && $grade_level != '' && $section != '' && $subject != '' && $term != ''){

				$school_year = explode('-', $school_year);
				$sy_start = $school_year[0];
				$sy_end = $school_year[1];

				//$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);
				$exist = $this->enrolled_students_in_section_exist($section);

				if(!$exist){
					$this->session->set_flashdata( 'error', 'No Grades Allocated.' );
				}else{
					//select all students for this subject by section and subj_id
					$enrolled_students = $main_model->get_enrolled_students_by_section_and_subject($section, $subject);
					$subj_offerid = $main_model->get_subject_offerid($section, $subject);
					$results = array(
							'enrolled_students' => $enrolled_students,
							'term' => $term,
							'subj_offerid' => $subj_offerid
						);

					return $results;
				}

			}else{
				$this->session->set_flashdata( 'error', 'Please select schoolyear, grade level and section.' );
			}
		}else{
			return null;
		}
	}

	public function submit_manage_grades_ajax($activity_type = 'quiz'){

		$data = $this->input->get();

		if($data){
			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			if($school_year != '' && $grade_level != '' && $section != '' && $subject != '' && $term != ''){

				$input_school_year = $school_year;

				$school_year = explode('-', $school_year);
				$sy_start = $school_year[0];
				$sy_end = $school_year[1];

				$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);
				$exist = $this->enrolled_students_in_section_exist($section);

				if(!$exist){
					
					$success = false;
					$message = "No enrolled students for this section.";

					$json_array = array(
							'success' => $success,
							'message' => $message,
							'content' => ''
						);

					echo json_encode($json_array);

				}else{
					//select all students for this subject by section and subj_id
					$enrolled_students = $main_model->get_enrolled_students_by_section_and_subject($section, $subject);
					$subj_offerid = $main_model->get_subject_offerid($section, $subject);
					$activity_weight = $this->get_activity_weight($subj_offerid, $term, $activity_type);
					$activity_column = $this->get_activity_column($subj_offerid, $term, $activity_type);

					$success = true;
					$message = "Search success.";

					$json_array = array(
							'success' => $success,
							'message' => $message,
							'content' => $this->display_activity_modification_table($term, $enrolled_students, $subj_offerid, $section, $subject, $grade_level_id, $activity_type),
							'term' => $term,
							'subj_offerid' => $subj_offerid,
							'activity_type' => $activity_type,
							'section' => $section,
							'subject' => $subject,
							'school_year' => $input_school_year,
							'grade_level' => $grade_level,
							'activity_weight' => $activity_weight,
							'activity_column' => $activity_column
						);

					echo json_encode($json_array);
				}

			}else{

				$success = false;
				$message = "Please select from all fields.";

				$json_array = array(
						'success' => $success,
						'message' => $message,
						'content' => ''
					);

				echo json_encode($json_array);
			}
		}
	}

	public function get_student_subject_grades($activity_type = "quiz"){

		$data = $this->input->get();

		if($data){
			extract( $data, EXTR_SKIP );

			$user_id = $this->user_id;

			$main_model = $this->main_model;

			if($section != '' && $subject != '' && $term != ''){

				/*$input_school_year = $school_year;

				$school_year = explode('-', $school_year);
				$sy_start = $school_year[0];
				$sy_end = $school_year[1];

				$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $grade_level);*/
				/*$exist = $this->enrolled_students_in_section_exist($section);

				if(!$exist){
					
					$success = false;
					$message = "No enrolled students for this section.";

					$json_array = array(
							'success' => $success,
							'message' => $message,
							'content' => ''
						);

					echo json_encode($json_array);

				}else{*/
					//select all students for this subject by section and subj_id
					$enrolled_students = $main_model->get_enrolled_students_by_section_and_subject($section, $subject, $user_id);
					$subj_offerid = $main_model->get_subject_offerid($section, $subject);
					$activity_weight = $this->get_activity_weight($subj_offerid, $term, $activity_type);
					$activity_column = $this->get_activity_column($subj_offerid, $term, $activity_type);

					$success = true;
					$message = "Search success.";

					$json_array = array(
							'success' => $success,
							'message' => $message,
							'content' => $this->display_activity_modification_table($term, $enrolled_students, $subj_offerid, $section, $subject, $grade_level_id, $activity_type),
							'term' => $term,
							'subj_offerid' => $subj_offerid,
							'activity_type' => $activity_type,
							'section' => $section,
							'subject' => $subject,
							'activity_weight' => $activity_weight,
							'activity_column' => $activity_column,
							'grade_level_id' => $grade_level_id
						);

					echo json_encode($json_array);
				//}

			}else{

				$success = false;
				$message = "Please select from all fields.";

				$json_array = array(
						'success' => $success,
						'message' => $message,
						'content' => ''
					);

				echo json_encode($json_array);
			}
		}
	
	}

	public function update_activity(){

		$data = $this->input->post();

		if($data){

			$main_model = $this->main_model;
			extract( $data, EXTR_SKIP );

			//activity_id
			//activity_type
			//scores[]
			//users[]
			$no_of_items = $items;
			$activity_item_id = $this->get_update_activity_items($activity_id, $no_of_items, $activity_type);

			$counter = 0;
			foreach($users as $user){
				$updated_activity_id = $this->get_update_user_activity($activity_id, $user, $scores[$counter], $activity_type);
				$counter++;
			}
		}
	}

	public function update_column_rows($previous_column_count, $new_column_count, $subj_offerid, $term, $activity_type){

		$main_model = $this->main_model;

		$remove_count = 0;
		$add_count = 0;

		if($previous_column_count > $new_column_count){ //delete column

			/*for($i=$new_column_count+1;$i<=$previous_column_count;$i++){
				$remove_count++;
			}*/
			$remove_count = $previous_column_count - $new_column_count;

			switch($activity_type){

				case "quiz":
						$ids = $main_model->select_quiz_columns($subj_offerid, $term, $remove_count);
						$new_ids = array();
						foreach($ids as $id){
							$new_ids[] = $id->activity_id;
						}
						$column_ids = implode(',', $new_ids);
						$main_model->delete_quiz_columns($column_ids);
						break;
					case "project":
						$ids = $main_model->select_project_columns($subj_offerid, $term, $remove_count);
						$new_ids = array();
						foreach($ids as $id){
							$new_ids[] = $id->activity_id;
						}
						$column_ids = implode(',', $new_ids);
						$main_model->delete_project_columns($column_ids);
						break;
					case "assignment":
						$ids = $main_model->select_assignment_columns($subj_offerid, $term, $remove_count);
						$new_ids = array();
						foreach($ids as $id){
							$new_ids[] = $id->activity_id;
						}
						$column_ids = implode(',', $new_ids);
						$main_model->delete_assignment_columns($column_ids);
						break;
					case "recitation":
						$ids = $main_model->select_recitation_columns($subj_offerid, $term, $remove_count);
						$new_ids = array();
						foreach($ids as $id){
							$new_ids[] = $id->activity_id;
						}
						$column_ids = implode(',', $new_ids);
						$main_model->delete_recitation_columns($column_ids);
						break;
					case "exam":
						//$main_model->delete_quiz_columns($remove_count);
						//only 4 columns
						break;
			}


		}else if($previous_column_count == $new_column_count){ //no action

		}else{ //add columns

			$add_count = $new_column_count - $previous_column_count;

			$students = $main_model->get_enrolled_students_by_offered_subject($subj_offerid);

			switch($activity_type){

				case "quiz":
						for($i=1;$i<=$add_count;$i++){
							$tag = $main_model->get_max_quiz_tag_by_subj_offerid($subj_offerid, $term);
							$activity_id = $main_model->add_quiz($subj_offerid, 0, $term, $tag+1);
							
							foreach($students as $student){
								$user_id = $student->user_id;
								$main_model->assign_student_quiz($user_id, $activity_id);
							}
						}
					break;
				case "project":
						for($i=1;$i<=$add_count;$i++){
							$tag = $main_model->get_max_project_tag_by_subj_offerid($subj_offerid, $term);
							$activity_id = $main_model->add_project($subj_offerid, 0, $term, $tag+1);

							foreach($students as $student){
								$user_id = $student->user_id;
								$main_model->assign_student_project($user_id, $activity_id);
							}
						}
					break;
				case "assignment":
						for($i=1;$i<=$add_count;$i++){
							$tag = $main_model->get_max_assignment_tag_by_subj_offerid($subj_offerid, $term);
							$activity_id = $main_model->add_assignment($subj_offerid, 0, $term, $tag+1);

							foreach($students as $student){
								$user_id = $student->user_id;
								$main_model->assign_student_assignment($user_id, $activity_id);
							}
						}
					break;
				case "recitation":
						for($i=1;$i<=$add_count;$i++){
							$tag = $main_model->get_max_recitation_tag_by_subj_offerid($subj_offerid, $term);
							$activity_id = $main_model->add_recitation($subj_offerid, 0, $term, $tag+1);

							foreach($students as $student){
								$user_id = $student->user_id;
								$main_model->assign_student_recitation($user_id, $activity_id);
							}
						}
					break;
				case "exam":
					//$main_model->delete_quiz_columns($remove_count);
					//only 4 columns
					break;
			}

		}

		return $this->db->last_query();

		
	}

	public function process_activity_settings($activity_type){

		$data = $this->input->get();

		if($data){
			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			switch($activity_type){

				case "quiz":
						$main_model->update_quiz_weight($activity_weight, $subj_offerid, $term);
						$column_count = $main_model->get_quiz_column($subj_offerid, $term);
						$last_query = $this->update_column_rows($column_count, $activity_column, $subj_offerid, $term, $activity_type);
						$main_model->update_quiz_column($activity_column, $subj_offerid, $term);
						break;
					case "project":
						$main_model->update_project_weight($activity_weight, $subj_offerid, $term);
						$column_count = $main_model->get_project_column($subj_offerid, $term);
						$last_query = $this->update_column_rows($column_count, $activity_column, $subj_offerid, $term, $activity_type);
						$main_model->update_project_column($activity_column, $subj_offerid, $term);
						break;
					case "assignment":
						$main_model->update_assignment_weight($activity_weight, $subj_offerid, $term);
						$column_count = $main_model->get_assignment_column($subj_offerid, $term);
						$last_query = $this->update_column_rows($column_count, $activity_column, $subj_offerid, $term, $activity_type);
						$main_model->update_assignment_column($activity_column, $subj_offerid, $term);
						break;
					case "recitation":
						$main_model->update_recitation_weight($activity_weight, $subj_offerid, $term);
						$column_count = $main_model->get_recitation_column($subj_offerid, $term);
						$last_query = $this->update_column_rows($column_count, $activity_column, $subj_offerid, $term, $activity_type);
						$main_model->update_recitation_column($activity_column, $subj_offerid, $term);
						break;
					case "exam":
						$main_model->update_exam_weight($activity_weight, $subj_offerid, $term);
						//only 4 columns
						$last_query = '';
						break;
			}

			$json_result = array(
				'last_query' => $last_query,
				'message' => 'Settings successfully saved.',
				);

			echo json_encode($json_result);
		}
	
	}


	/* ajax content */
	public function get_single_activity_form($activity_type = "quiz"){

		$data = $this->input->get();

		if($data){

			$main_model = $this->main_model;
			extract( $data, EXTR_SKIP );

			$enrolled_students = $main_model->get_enrolled_students_by_section_and_subject($section, $subject);

			$activity_type_variables = $this->get_activity_type_variables($activity_type);
			$activity_info = $this->get_single_activity($activity_id, $activity_type);
			extract( $activity_type_variables, EXTR_SKIP );

			$activity_id = $activity_info->{$activity_id_column};
			$items = $activity_info->{$item_column};
			$tag = $activity_info->{$tag_column};

			$output = "";
			$output .= '<table class="table table-bordered table-hover">';

			$output .= '<tr>';
			$output .= '<td></td>';
			$output .= '<td class="quiz-cell">'.$tag_letter.$tag.'</td>';
			$output .= '</tr>';

			$output .= '<tr>';
			$output .= '<td>No. of Items</td>';
			$output .= '<td class="quiz-cell">';
			$output .= '<input type="text" name="items" value="'.$items.'" class="">';
			$output .= '</td>';
			$output .= '</tr>';

			foreach($enrolled_students as $student){

				$user_id = $student->user_id;
				$fullname = $student->lname . ', ' . $student->fname . ' ' . $student->mname; 
				$subj_offerid = $student->subj_offerid;

				$user_activity_info = $this->get_single_student_activity($activity_id, $user_id, $activity_type);
				$score = $user_activity_info->{$score_column};

				$output .= '<tr>';
				$output .= '<td>'.$fullname.'</td>';
				$output .= '<td class="quiz-cell">';
				$output .= '<input type="hidden" name="users[]" value="'.$user_id.'" class="">';
				$output .= '<input type="text" name="scores[]" value="'.$score.'" class="">';
				$output .= '</td>';
				$output .= '</tr>';

			}

			$output .= '</table>';

			echo $output;

			

		}
	}

	public function display_activity_modification_table($term, $enrolled_students, $subj_offerid, $offer_id, $subj_id, $grade_level_id, $activity_type = "quiz"){

		$user_type = $this->user_type;

		$main_model = $this->main_model;

		$activity_type_variables = $this->get_activity_type_variables($activity_type);
		$activity_info = $this->get_activities($subj_offerid, $term, $activity_type);
		$lock_status = $main_model->get_subject_lock_status($subj_id, $grade_level_id);
		extract( $activity_type_variables, EXTR_SKIP );

		$output = "";

		if(!empty($enrolled_students)){

			
			$output .= '<table class="table table-bordered table-hover">';

			$output .= '<tr>';
			$output .= '<td>';
			$output .= "<h3>Student Name</h3>";
			$output .= '</td>';

			$total_items = 0;
			
			//tag and items
			//activity_info
			foreach($activity_info as $detail){
				$activity_id = $detail->{$activity_id_column};
				$items = $detail->{$item_column};
				$tag = $detail->{$tag_column};
				$total_items = $total_items + $items;


				$output .= '<td class="quiz-cell no-padding">';
				$output .= '<table class="table table-bordered table-hover">';
				$output .= '<tr><td class="quiz-cell">';
				$output .= $tag_letter.$tag;
				$output .= '<input type="hidden" value="'.$activity_id.'" class="">';
				$output .='</td></tr>';
				

				$output .= '<tr>';
				if($lock_status || $user_type == 3 || $user_type == 1){
					$output .= '<td class="quiz-cell compensate-padding">'.$items.'</td>';
				}else{
					$output .= '<td class="quiz-cell"><input data-id="'.$activity_id.'" data-section="'.$offer_id.'" data-subject="'.$subj_id.'" type="text" value="'.$items.'" class="activity-toggle"></td>';
				}
				
				$output .= '</tr>';
				$output .= '</table>';
				$output .= '</td>';
			}

			//total
			$output .= '<td class="quiz-cell no-padding">';
			$output .= '<table class="table table-bordered table-hover">';
			$output .= '<tr>';
			$output .= '<td class="quiz-cell">';
			$output .= 'Total';
			$output .='</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td class="quiz-cell compensate-padding">'.$total_items.'</td>';
			$output .= '</tr>';
			$output .= '</table>';
			$output .= '</td>';

			//average
			$output .= '<td class="quiz-cell no-padding">';
			$output .= '<table class="table table-bordered table-hover">';
			$output .= '<tr>';
			
			$output .= '<td class="quiz-cell">';
			$output .= 'Ave.';
			$output .='</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td class="quiz-cell compensate-padding">100 %</td>';
			$output .= '</tr>';
			$output .= '</table>';
			$output .= '</td>';

			//rating
			/*$output .= '<td class="quiz-cell no-padding">';
			$output .= '<table class="table table-bordered table-hover">';
			$output .= '<tr>';*/
			
			/*$output .= '<td class="quiz-cell">';
			$output .= 'Rate';
			$output .='</td>';
			$output .= '</tr>';
			
			$output .= '<tr>';
			$output .= '<td class="quiz-cell compensate-padding">'.(1*24+65).'</td>';
			$output .= '</tr>';
			$output .= '</table>';
			$output .= '</td>';*/


			foreach($enrolled_students as $student){

				$user_id = $student->user_id;
				$fullname = $student->lname . ', ' . $student->fname . ' ' . $student->mname; 
				$subj_offerid = $student->subj_offerid;

				//student name
				$output .= '<tr>';
				$output .= '<td>';
				$output .= $fullname;
				$output .= '</td>';

				//activity scores
				$activities = $this->get_student_activites_by_info($user_id, $subj_offerid, $term, $activity_type);
				$total_activity_score = 0;
				$quiz_count = 0;

				/*var_dump($activities)*/

				if(!empty($activities)){
					foreach($activities as $activity){

						$activity_id = $activity->{$activity_id_column};
						$score = $activity->{$score_column};
						$total_activity_score = $total_activity_score + $score;
						$quiz_count++;

						$output .= '<td class="quiz-cell">';
						$output .= $score;
						$output .= '</td>';

					}	
				}
				

				//average
				if($total_activity_score == 0){
					$total_activity_score = 1;
					$total_activity_score_display = 0;
				}else{
					$total_activity_score_display = $total_activity_score;	
				}

				if($total_items == 0){
					$total_items = 1;
				}




				$average = ($total_activity_score/$total_items);
				$string_average = $average*100;
				$average = number_format($average, 2);
				$string_average = number_format($string_average, 2);
				$output .= '<td class="quiz-cell ">';
				$output .= $total_activity_score_display;
				$output .= '</td>';
				$output .= '<td class="quiz-cell ">';
				if($user_type == 3){
					$output .= $string_average.' %';
				}else{
					if($lock_status){
						$output .= '<i class="fa fa-lock text-danger"></i> ' . $string_average.' %';
					}else{
						$output .= $string_average.' %';
					}
				}
				
				
				$output .= '</td>';
				/*$output .= '<td class="quiz-cell ">';
				$output .= $average*24+65;
				$output .= '</td>';*/

				$output .= '</tr>';
			}

			$output .= '</table>';
		}

		return $output;
		
	}

	/* initializations */
	public function assign_subject_defaults($subj_offerid){

		$main_model = $this->main_model;

		$quiz_limit = 6;
		$recitation_limit = 4;
		$assignment_limit = 5;
		$project_limit = 2;
		$exam_limit = 1;

		for($i=1;$i<=4;$i++){

			//grade system
			$main_model->add_grade_system($subj_offerid, $i);

			//grade column
			$main_model->add_grade_column($quiz_limit, $assignment_limit, $recitation_limit, $project_limit, $subj_offerid, $i);

			//exam
			$exam_id = $main_model->add_exam($subj_offerid, '', $i, $i);

			//quiz
			for($quiz_counter=1;$quiz_counter<=$quiz_limit;$quiz_counter++){
				$main_model->add_quiz($subj_offerid, '', $i, $quiz_counter);
			}

			//recitation
			for($recitation_counter=1;$recitation_counter<=$recitation_limit;$recitation_counter++){
				$main_model->add_recitation($subj_offerid, '', $i, $recitation_counter);
			}

			//assignment
			for($assignment_counter=1;$assignment_counter<=$assignment_limit;$assignment_counter++){
				$main_model->add_assignment($subj_offerid, '', $i, $assignment_counter);
			}

			//project
			for($project_counter=1;$project_counter<=$project_limit;$project_counter++){
				$main_model->add_project($subj_offerid, '', $i, $project_counter);
			}


			
		}
	}

	public function assign_initial_scores($offer_id, $user_id, $subj_offerid = null){

		$main_model = $this->main_model;

		$initial_score = 0;

		/*for($term=1;$term<=4;$term++){

		}*/

		//exam
		$results = $main_model->get_student_exam($offer_id, $user_id, $subj_offerid);

		foreach($results as $result){

			$user_id = $result->user_id;
			$activity_id = $result->exam_id;

			$main_model->assign_student_exam($user_id, $activity_id);
		}

		//project
		$results = $main_model->get_student_project($offer_id, $user_id, $subj_offerid);

		foreach($results as $result){

			$user_id = $result->user_id;
			$activity_id = $result->PID;

			$main_model->assign_student_project($user_id, $activity_id);
		}

		//quizzes
		$results = $main_model->get_student_quiz($offer_id, $user_id, $subj_offerid);

		foreach($results as $result){

			$user_id = $result->user_id;
			$activity_id = $result->QID;

			$main_model->assign_student_quiz($user_id, $activity_id);
		}

		//recitation
		$results = $main_model->get_student_recitation($offer_id, $user_id, $subj_offerid);

		foreach($results as $result){

			$user_id = $result->user_id;
			$activity_id = $result->RID;

			$main_model->assign_student_recitation($user_id, $activity_id);
		}

		//assignment
		$results = $main_model->get_student_assignment($offer_id, $user_id, $subj_offerid);

		foreach($results as $result){

			$user_id = $result->user_id;
			$activity_id = $result->AID;

			$main_model->assign_student_assignment($user_id, $activity_id);
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

	public function enrolled_students_in_section_exist($section){

		$main_model = $this->main_model;

		$count = $main_model->count_enrolled_students_in_section($section);

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
					'html' => $option,
					'last_query' => $this->db->last_query()
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

	    $user_type = $this->user_type;
		$user_id = $this->user_id;

		if($user_type == 1){
			$results = $main_model->get_sections_by_grade_level($grade_level_id);
		}else if($user_type == 2){
			$results = $main_model->get_sections_by_teacher_detail($grade_level_id, $user_id);
		}
	    

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

	    $user_type = $this->user_type;
		$user_id = $this->user_id;

		if($user_type == 1){
			$results = $main_model->get_subjects_offered($section_id);
		}else if($user_type == 2){
			$results = $main_model->get_subjects_assigned_by_teacher($user_id, $section_id);
		}
	    

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

	public function student_school_year_dropdown($user_id){

	    $this->load->model('Curiculum_Model');
	    $main_model = new Curiculum_Model;

	    $results = $main_model->get_school_year();

	    $option = "";

	    foreach($results as $result){

	      $grade_level_id = $result->gl_id;
	      $sy_start = $result->sy_start;
	      $sy_end = $result->sy_end;

	      $option .= '<option value="'.$sy_start.'-'.$sy_end.'">'.$sy_start.' - '.$sy_end.'</option>';
	    }

	    return $option;
	  }

	/*get*/
	public function get_all_projects($subj_offerid){

		$main_model = $this->main_model;

		$results = $main_model->get_project_by_subj_offerid($subj_offerid);

		/*echo '<pre>';
		var_dump($results);
		echo '</pre>';*/
	}

	public function get_single_student_activity($activity_id, $user_id, $activity_type = "quiz"){

		$main_model = $this->main_model;

		switch($activity_type){

			case "quiz":
				$activity = $main_model->get_single_student_quiz($activity_id, $user_id);
				break;
			case "project":
				$activity = $main_model->get_single_student_project($activity_id, $user_id);
				break;
			case "assignment":
				$activity = $main_model->get_single_student_assignment($activity_id, $user_id);
				break;
			case "recitation":
				$activity = $main_model->get_single_student_recitation($activity_id, $user_id);
				break;
			case "exam":
				$activity = $main_model->get_single_student_exam($activity_id, $user_id);
				break;
		}

		return $activity;
	}

	public function get_student_activites_by_info($user_id, $subj_offerid, $term, $activity_type = "quiz"){

		$main_model = $this->main_model;

		switch($activity_type){

			case "quiz":
				$activities = $main_model->get_student_quiz_by_subject($user_id, $subj_offerid, $term);
				break;
			case "project":
				$activities = $main_model->get_student_project_by_subject($user_id, $subj_offerid, $term);
				break;
			case "assignment":
				$activities = $main_model->get_student_assignment_by_subject($user_id, $subj_offerid, $term);
				break;
			case "recitation":
				$activities = $main_model->get_student_recitation_by_subject($user_id, $subj_offerid, $term);
				break;
			case "exam":
				$activities = $main_model->get_student_exam_by_subject($user_id, $subj_offerid, $term);
				break;
			default:
				$activities = $main_model->get_student_quiz_by_subject($user_id, $subj_offerid, $term);
				break;
		}

		return $activities;
	}

	public function get_activities($subj_offerid, $term, $activity_type){

		$main_model = $this->main_model;

		switch($activity_type){

			case "quiz":
				$activity_info = $main_model->get_quiz_by_subj_offerid($subj_offerid, $term);
				break;
			case "project":
				$activity_info = $main_model->get_project_by_subj_offerid($subj_offerid, $term);
				break;
			case "assignment":
				$activity_info = $main_model->get_assignment_by_subj_offerid($subj_offerid, $term);
				break;
			case "recitation":
				$activity_info = $main_model->get_recitation_by_subj_offerid($subj_offerid, $term);
				break;
			case "exam":
				$activity_info = $main_model->get_exam_by_subj_offerid($subj_offerid, $term);
				break;
		}

		return $activity_info;
	}

	public function get_single_activity($activity_id, $activity_type){

		$main_model = $this->main_model;

		switch($activity_type){

			case "quiz":
				$activity_info = $main_model->get_quiz_info_by_id($activity_id);
				break;
			case "project":
				$activity_info = $main_model->get_project_info_by_id($activity_id);
				break;
			case "assignment":
				$activity_info = $main_model->get_assignment_info_by_id($activity_id);
				break;
			case "recitation":
				$activity_info = $main_model->get_recitation_info_by_id($activity_id);
				break;
			case "exam":
				$activity_info = $main_model->get_exam_info_by_id($activity_id);
				break;
		}

		return $activity_info;
	}

	public function get_update_user_activity($activity_id, $user_id, $score, $activity_type){

		$main_model = $this->main_model;

		switch($activity_type){

			case "quiz":
				$id = $main_model->update_student_quiz($activity_id, $user_id, $score);
				break;
			case "project":
				$id = $main_model->update_student_project($activity_id, $user_id, $score);
				break;
			case "assignment":
				$id = $main_model->update_student_assignment($activity_id, $user_id, $score);
				break;
			case "recitation":
				$id = $main_model->update_student_recitation($activity_id, $user_id, $score);
				break;
			case "exam":
				$id = $main_model->update_student_exam($activity_id, $user_id, $score);
				break;
		}

		return $id;
	}

	public function get_update_activity_items($activity_id, $items, $activity_type){

		$main_model = $this->main_model;

		switch($activity_type){

			case "quiz"://todo: update
				$activity_id = $main_model->update_quiz($activity_id, $items);
				break;
			case "project":
				$activity_id = $main_model->update_project($activity_id, $items);
				break;
			case "assignment":
				$activity_id = $main_model->update_assignment($activity_id, $items);
				break;
			case "recitation":
				$activity_id = $main_model->update_recitation($activity_id, $items);
				break;
			case "exam":
				$activity_id = $main_model->update_exam($activity_id, $items);
				break;
		}

		return $activity_id;
	}

	public function get_activity_type_variables($activity_type){

		$main_model = $this->main_model;

		switch($activity_type){

			case "quiz":
				$activity_id_column = "QID";
				$score_column = "qscore";
				$item_column = "q_item";
				$tag_column = "qtag";
				$tag_letter = "Q";
				break;
			case "project":
				$activity_id_column = "PID";
				$score_column = "pscore";
				$item_column = "p_item";
				$tag_column = "ptag";
				$tag_letter = "P";
				break;
			case "assignment":
				$activity_id_column = "AID";
				$score_column = "ascore";
				$item_column = "a_item";
				$tag_column = "atag";
				$tag_letter = "A";
				break;
			case "recitation":
				$activity_id_column = "RID";
				$score_column = "rscore";
				$item_column = "r_item";
				$tag_column = "rtag";
				$tag_letter = "R";
				break;
			case "exam":
				$activity_id_column = "exam_id";
				$score_column = "escore";
				$item_column = "e_item";
				$tag_column = "etag";
				$tag_letter = "E";
				break;
		}

		$result = array(
				'activity_id_column' => $activity_id_column,
				'score_column' => $score_column,
				'item_column' => $item_column,
				'tag_column' => $tag_column,
				'tag_letter' => $tag_letter
			);

		return $result;
	}

	public function get_term_constant($term){

		switch($term){
			case "1":
				$constant = 24;
				break;
			case "2":
				$constant = 26;
				break;
			case "3":
				$constant = 28;
				break;
			case "4":
				$constant = 28;
				break;
		}

		return $constant;
	}

	public function get_activity_weight($subj_offerid, $term, $activity_type = 'quiz'){

		$main_model = $this->main_model;

		switch($activity_type){
			case "quiz":
				$weight = $main_model->get_quiz_weight($subj_offerid, $term);
				break;
			case "assignment":
				$weight = $main_model->get_assignment_weight($subj_offerid, $term);
				break;
			case "project":
				$weight = $main_model->get_project_weight($subj_offerid, $term);
				break;
			case "recitation":
				$weight = $main_model->get_recitation_weight($subj_offerid, $term);
				break;
			case "exam":
				$weight = $main_model->get_exam_weight($subj_offerid, $term);
				break;
			default:
				$weight = $main_model->get_quiz_weight($subj_offerid, $term);
				break;
		}

		return $weight;
	}

	public function get_activity_column($subj_offerid, $term, $activity_type = 'quiz'){

		$main_model = $this->main_model;

		switch($activity_type){
			case "quiz":
				$column = $main_model->get_quiz_column($subj_offerid, $term);
				break;
			case "assignment":
				$column = $main_model->get_assignment_column($subj_offerid, $term);
				break;
			case "project":
				$column = $main_model->get_project_column($subj_offerid, $term);
				break;
			case "recitation":
				$column = $main_model->get_recitation_column($subj_offerid, $term);
				break;
			case "exam":
				$column = 1;
				break;
			default:
				$column = $main_model->get_quiz_column($subj_offerid, $term);
				break;
		}

		return $column;
	}

	public function get_student_activity_term_calculations($user_id, $subj_offerid, $term, $term_constant, $lowest_grade, $activity_type = 'quiz'){

		$main_model = $this->main_model;

		switch($activity_type){
			case "quiz":
				$calculations = $main_model->get_student_quiz_computations($user_id, $subj_offerid, $term, $term_constant, $lowest_grade);
				break;
			case "assignment":
				$calculations = $main_model->get_student_assignment_computations($user_id, $subj_offerid, $term, $term_constant, $lowest_grade);
				break;
			case "project":
				$calculations = $main_model->get_student_project_computations($user_id, $subj_offerid, $term, $term_constant, $lowest_grade);
				break;
			case "recitation":
				$calculations = $main_model->get_student_recitation_computations($user_id, $subj_offerid, $term, $term_constant, $lowest_grade);
				break;
			case "exam":
				$calculations = $main_model->get_student_exam_computations($user_id, $subj_offerid, $term, $term_constant, $lowest_grade);
				break;
		}

		return $calculations;
	}

	public function get_student_subject_activity_term_score($user_id, $subj_offerid, $term, $activity_type = 'quiz'){

		$main_model = $this->main_model;
		$lowest_grade = $this->lowest_grade;

		$term_constant = $this->get_term_constant($term);
		$calculations = $this->get_student_activity_term_calculations($user_id, $subj_offerid, $term, $term_constant, $lowest_grade, $activity_type);

		//$activity_weight = $this->get_activity_weight($subj_offerid, $term, $activity_type);
		/*echo '<pre>';
		var_dump($this->db->last_query());
		echo '</pre>';*/
		$term_activity_score = $calculations->term_activity_score;

		return $term_activity_score;
	}

	public function get_student_final_subject_grade($user_id, $subj_offerid){

		$grand_total = 0;

		for($term=1;$term<=4;$term++){

			$term_total = $this->get_student_final_subject_term_grade($user_id, $subj_offerid, $term);
			$grand_total = $grand_total + $term_total;
		}

		$subject_average = $grand_total/4;
		$subject_average = number_format($subject_average, 2);

		return $subject_average;
	}

	public function get_student_final_subject_term_grade($user_id, $subj_offerid, $term){

		//quiz score
		$quiz_score = $this->get_student_subject_activity_term_score($user_id, $subj_offerid, $term, 'quiz');

		//assignment score
		$assignment_score = $this->get_student_subject_activity_term_score($user_id, $subj_offerid, $term, 'assignment');

		//project score
		$project_score = $this->get_student_subject_activity_term_score($user_id, $subj_offerid, $term, 'project');

		//recitation score
		$recitation_score = $this->get_student_subject_activity_term_score($user_id, $subj_offerid, $term, 'recitation');

		//exam score
		$exam_score = $this->get_student_subject_activity_term_score($user_id, $subj_offerid, $term, 'exam');

		//total score = grade
		$total_score = $quiz_score + $assignment_score + $project_score + $recitation_score + $exam_score;
		$total_score = number_format($total_score, 2);

		return $total_score;
	}

	public function get_student_final_grade($user_id, $offer_id){
	}

	public function get_grading_system_tooltip($subj_offerid, $term){

		$main_model = $this->main_model;

		//assignment
		$assignment_weight = $main_model->get_assignment_weight($subj_offerid, $term);

		//quiz
		$quiz_weight = $main_model->get_quiz_weight($subj_offerid, $term);

		//recitation
		$recitation_weight = $main_model->get_recitation_weight($subj_offerid, $term);

		//project
		$project_weight = $main_model->get_project_weight($subj_offerid, $term);

		//exam
		$exam_weight = $main_model->get_exam_weight($subj_offerid, $term);

		$output = "";
		$output .= '<ul>';
		$output .= '<li> Quiz - '.$quiz_weight.'% </li>';
		$output .= '<li> Assignment - '.$assignment_weight.'% </li>';
		$output .= '<li> Recitation - '.$recitation_weight.'% </li>';
		$output .= '<li> Project - '.$project_weight.'% </li>';
		$output .= '<li> Exam - '.$exam_weight.'% </li>';
		$output .= "</ul>";

		return $output;
	}

	public function display_student_grade_per_subject_term(){

		$data = $this->input->get();
		$user_type = $this->user_type;
		$student_user_id = $this->user_id;

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$section_info = $main_model->get_section_info($offer_id);
			$subject_info = $main_model->get_subject_info($subj_offerid);

			//var_dump($subj_offerid);

			$section_name = $section_info->section;
			$grade_level = $section_info->grade_level;

			$sy_start = $section_info->sy_start;
			$sy_end = $section_info->sy_end;
			$input_school_year = $sy_start.'-'.$sy_end;

			$grade_level_id = $section_info->gl_id;

			$subject_name = $subject_info->subj_code;
			$subj_id = $subject_info->subj_id;
			$instructor_user_id = $subject_info->user_id;

			if(empty($instructor_user_id)){
				$instructor_name = "Instructor not assigned yet";
			}else{
				$instructor_name = $subject_info->lname . ', ' . $subject_info->fname . ' ' . $subject_info->mname;
			}

			

			$output = '<h3>SY ' . $sy_start . ' - ' . $sy_end . '</h3>';
			$output .= '<h3> Grade ' . $grade_level . ' - ' . $section_name . '</h3>';
			$output .= '<h3>'.$subject_name . ' - ' . $instructor_name . '</h3>';

			$output .= '<table class="table table-bordered table-hover">';

			$output .= '<tr>';

			$output .= "<td>";
			$output .= "Student Name";
			$output .= "</td>";

			$subjects = $main_model->get_subjects_offered($offer_id);
			$subject_count = 0;

			for($term=1;$term<=4;$term++){

				switch($term){
					case 1:
						$term_title = "1st Grading";
						/*$quiz_weight = $main_model->get_quiz_weight($subj_offerid);
						$assignment_weight
						$project_weight
						$recitation_weight
						$exam_weight*/
						break;
					case 2:
						$term_title = "2nd Grading";
						break;
					case 3:
						$term_title = "3rd Grading";
						break;
					case 4:
						$term_title = "4th Grading";
						break;
				}

				$grade_book_class = "view-grade-book";
				$percentage_tooltip = '<i class="hidden-print fa fa-question-circle list-tooltip" data-toggle="tooltip" data-placement="top" title="'.$this->get_grading_system_tooltip($subj_offerid, $term).'"></i>';

				if($user_type == 1){
					$output .= '<td>'.$term_title.' '.$percentage_tooltip.'</td>';
				}else{
					$output .= '<td>';
					$output .= '<a href="#" class="'.$grade_book_class.'" data-grade_level="'.$grade_level.'" data-sy="'.$input_school_year.'" data-user="'.$user_type.'" data-term="'.$term.'" data-subject="'.$subj_id.'" data-section="'.$offer_id.'" data-gl="'.$grade_level_id.'" data-title="'.$term_title.'">'.$term_title.'</a>';
					$output .= $percentage_tooltip;
					$output .= '</td>';
				}
				
			}

			$output .= '<td>';
			$output .= 'Average';
			$output .= '</td>';

			$output .= '</tr>';

			if($user_type == 1){
				$students = $main_model->get_enrolled_students_by_section($offer_id);
			}else if($user_type == 3){
				$students = $main_model->get_enrolled_students_by_section($offer_id, $student_user_id);
			}

			

			foreach($students as $student_info){
				$user_id = $student_info->user_id;
				$fullname = $student_info->lname . ', ' . $student_info->mname . ' ' . $student_info->lname;

				$output .= '<tr>';

				$output .= '<td>';
				$output .= $fullname;
				$output .= '</td>';

				$final_total = 0;

				for($term=1;$term<=4;$term++){

					$term_grade = $this->get_student_final_subject_term_grade($user_id, $subj_offerid, $term);

					$output .= "<td>";
					$output .= $term_grade;
					$output .= "</td>";

					$final_total = $final_total + $term_grade;
				}

				$final_grade = $final_total/4;
				$final_grade = number_format($final_grade, 2);

				$output .= "<td>";
				$output .= $final_grade;
				$output .= "</td>";

				$output .= '</tr>';
			}

			$output .= "</table>";

			echo $output;

		}
	}

	public function display_student_grades($offer_id){

		$main_model = $this->main_model;

		$user_type = $this->user_type;
		$student_user_id = $this->user_id;

		$section_info = $main_model->get_section_info($offer_id);
		$section_name = $section_info->section;
		$grade_level = $section_info->grade_level;
		$sy_start = $section_info->sy_start;
		$sy_end = $section_info->sy_end;

		
		$output = '<h3>SY ' . $sy_start . ' - ' . $sy_end . '</h3>';
		$output .= '<h3> Grade ' . $grade_level . ' - ' . $section_name . '</h3>';
		
		

		$output .= '<table class="table table-bordered table-hover">';

		$output .= '<tr>';

		$output .= "<td>";
		$output .= "Student Name";
		$output .= "</td>";

		$subjects = $main_model->get_subjects_offered($offer_id);
		$subject_count = 0;

		foreach($subjects as $subject){

			$subject_offerid = $subject->subj_offerid;

			$output .= "<td>";
			$output .= '<a class="view-section-subject-record" href="#" data-subject="'.$subject_offerid.'" data-section="'.$offer_id.'">'.$subject->subj_code.'</a>';
			$output .= "</td>";

			$subject_count++;
		}

		$output .= '<td>';
		$output .= 'Average';
		$output .= '</td>';

		$output .= '</tr>';

		if($user_type == 1){
			$students = $main_model->get_enrolled_students_by_section($offer_id);
		}else if($user_type == 3){
			$students = $main_model->get_enrolled_students_by_section($offer_id, $student_user_id);
		}
		

		foreach($students as $student_info){
			$user_id = $student_info->user_id;
			$fullname = $student_info->lname . ', ' . $student_info->mname . ' ' . $student_info->lname;

			$output .= '<tr>';

			$output .= '<td>';
			$output .= $fullname;
			$output .= '</td>';

			$final_total = 0;

			foreach($subjects as $subject){

				$subj_offerid = $subject->subj_offerid;

				$subject_grade = $this->get_student_final_subject_grade($user_id, $subj_offerid);

				$output .= "<td>";
				$output .= $subject_grade;
				$output .= "</td>";

				$final_total = $final_total + $subject_grade;
			}

			if($subject_count == 0){
				$final_grade = "Not yet computed.";
			}else{
				$final_grade = $final_total/$subject_count;
			}
			

			$output .= "<td>";
			$output .= $final_grade;
			$output .= "</td>";

			$output .= '</tr>';
		}

		$output .= "</table>";

		echo $output;
	}

	public function view_all_sections_per_grade_level(){

		$data = $this->input->get();

		$user_type = $this->user_type;
		$student_user_id = $this->user_id;

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$school_year = explode('-', $school_year);

			$sy_start = $school_year[0];
			$sy_end = $school_year[1];

			if($user_type == 1){
				$grade_levels = $main_model->get_available_year_level_by_school_year($sy_start, $sy_end);
			}else if($user_type == 3){
				$grade_levels = $main_model->get_available_year_level_by_school_year($sy_start, $sy_end, $student_user_id);
			}
			

			if($user_type == 1){
				$output = "<h3> Class Offerings SY: " . $sy_start . ' - ' . $sy_end . "</h3>";
			}else if($user_type == 3){
				$output = "<h3> SY: " . $sy_start . ' - ' . $sy_end . "</h3>";
			}
			
			if(empty($grade_levels)){
				$output .= '<h3> You are not enrolled in this school year </h3>';
			}else{
				foreach($grade_levels as $grade_level){

					$grade_level_tag = $grade_level->grade_level;
					$grade_level_id = $grade_level->gl_id;

					$output .= "<h3> Year Leve: " . $grade_level_tag . "</h3>";

					if($user_type == 1){
						$sections = $main_model->get_sections_by_grade_level($grade_level_id);
					}else if($user_type == 3){	
						$sections = $main_model->get_sections_by_grade_level($grade_level_id, $student_user_id);
					}
					

					$output .= '<table class="table table-bordered table-hover">';

					$output .= '<tr>';
					$output .= '<td>Section</td>';
					$output .= '<td>Action</td>';
					$output .= '</tr>';

					if(empty($sections)){
							$output .= '<tr><td colspan="2">No Sections Allocated</td></tr>';
					}else{
						foreach($sections as $section){

							$offer_id = $section->offer_id;
							$section_name = $section->section;

							$output .= '<tr>';
							$output .= '<td>'.$section_name.'</td>';
							$output .= '<td><a class="view-section-record" href="#" data-id="'.$offer_id.'">View</a></td>';
							$output .= '</tr>';

							

						}
					}



					$output .= '</table>';
				}
			}
				

			echo $output;
		}
	}

	public function display_assigned_subjects_per_year_level(){

		$data = $this->input->get();

		$user_type = $this->user_type;
		$user_id = $this->user_id;

		if($data){

			$output = "";

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$school_year = explode('-', $school_year);

			$sy_start = $school_year[0];
			$sy_end = $school_year[1];
			

			if($user_type == 2){
				$output .= "<h3> Subjects Assigned for SY: " . $sy_start . ' - ' . $sy_end . "</h3>";
			}


			for($year_level = 1; $year_level <= 4; $year_level++){

				$output .= "<h3> Year Level: " . $year_level . "</h3>";

				$assigned_subjects = $main_model->get_subjects_assigned_by_teacher_and_year($user_id, $sy_start, $sy_end, $year_level);
				
				/*echo $this->db->last_query();
				echo '<br>';*/

				$output .= '<table class="table table-bordered table-hover">';

				

				if(empty($assigned_subjects)){
					$output .= '<tr><td colspan="2">You are not assigned in this year level.</td></tr>';
				}else{

					$output .= '<tr>';
					$output .= '<td>Subject Code</td>';
					$output .= '<td>Section</td>';
					$output .= '<td>Description</td>';
					$output .= '<td>Action</td>';
					$output .= '</tr>';

					foreach($assigned_subjects as $subject){

						//var_dump($subject);

						$subj_offerid = $subject->subj_offerid;
						$offer_id = $subject->offer_id;
						$subj_id = $subject->subj_id;
						$subj_code = $subject->subj_code;
						$subj_desc = $subject->subj_desc;
						$section_name = $subject->section;

						$output .= '<tr>';
						$output .= '<td>'.$subj_code.'</td>';
						$output .= '<td>'.$section_name.'</td>';
						$output .= '<td>'.$subj_desc.'</td>';
						$output .= '<td><a class="view-subject-grade-system" href="#" data-id="'.$subj_offerid.'" data-code="'.$subj_code.'">View</a></td>';
						$output .= '</tr>';



						
					}
				}//end if else

				$output .= '</table>';
			}
			
			
				

			echo $output;
		}
	}

	public function display_grading_system_tabs(){

		$data = $this->input->get();

		$user_type = $this->user_type;
		$user_id = $this->user_id;

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$model_data = array();
			$model_data['subj_offerid'] = $subj_offerid;
			$model_data['subj_code'] = $subj_code;

			$output = $this->load->view('curiculum/grade-tabs', $model_data, true);

			echo $output;

		}
	}

	public function display_grading_system($action = "view"){

		$data = $this->input->get();

		$user_type = $this->user_type;
		$user_id = $this->user_id;

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			//term
			//subj_offerid

			//assignment
			$assignment_weight = $main_model->get_assignment_weight($subj_offerid, $term);
			$assignment_column = $main_model->get_assignment_column($subj_offerid, $term);

			//quiz
			$quiz_weight = $main_model->get_quiz_weight($subj_offerid, $term);
			$quiz_column = $main_model->get_quiz_column($subj_offerid, $term);

			//recitation
			$recitation_weight = $main_model->get_recitation_weight($subj_offerid, $term);
			$recitation_column = $main_model->get_recitation_column($subj_offerid, $term);

			//project
			$project_weight = $main_model->get_project_weight($subj_offerid, $term);
			$project_column = $main_model->get_project_column($subj_offerid, $term);

			//exam
			$exam_weight = $main_model->get_exam_weight($subj_offerid, $term);
			$exam_column = 1;
			//$exam_column = $main_model->get_exam_column($subj_offerid, $term);

			$total_columns = $assignment_column+$quiz_column+$recitation_column+$project_column+$exam_column;
			$total_weight = $assignment_weight+$quiz_weight+$recitation_weight+$project_weight+$exam_weight;

			$model_data = array(
				'subj_offerid' => $subj_offerid,
				'term' => $term,
				'assignment_weight' => $assignment_weight,
				'assignment_column' => $assignment_column,
				'quiz_weight' => $quiz_weight,
				'quiz_column' => $quiz_column,
				'recitation_weight' => $recitation_weight,
				'recitation_column' => $recitation_column,
				'project_weight' => $project_weight,
				'project_column' => $project_column,
				'exam_weight' => $exam_weight,
				'exam_column' => $exam_column,
				'total_columns' => $total_columns,
				'total_weight' => $total_weight
			);

			if($action == "view"){
				$output = $this->load->view('curiculum/grade-system-view', $model_data, true);
			}else if($action == "edit"){
				$output = $this->load->view('curiculum/grade-system-edit', $model_data, true);
			}
			

			echo $output;

		}
	}

	public function display_sections_by_grade_level(){

		$data = $this->input->get();

		if($data){

			$output = "";

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			if($school_year == "" || $school_year == null){
				$sy_start = date('Y');
				$sy_end = date('Y') + 1;
			}else{
				$school_year = explode('-', $school_year);
				$sy_start = $school_year[0];
				$sy_end = $school_year[1];
			}
			

			for($term=1;$term<=4;$term++){

				$output .= '<h3> Year Level: '. $term .'</h3>';

				$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $term);
				$sections = $main_model->get_sections_by_grade_level($grade_level_id);

				$output .= '<table class="table table-bordered">';
				$output .= '<tr>';
				$output .= '<th style="width:100px;">ID</th>';
				$output .= '<th>Name</th>';
				$output .= '</tr>';

				foreach($sections as $section){
					$offer_id = $section->offer_id;
					$section_name = $section->section;

					$output .= '<tr>';
					$output .= '<td>'.$offer_id.'</td>';
					$output .= '<td>'.$section_name.'</td>';
					$output .= '</tr>';

				}

				$output .= '</table>';
			}

			echo $output;		

			
		}
	}

	public function display_offered_subjects_by_section_and_school_year(){

		$data = $this->input->get();

		if($data){

			$output = "";

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			if($school_year == "" || $school_year == null){
				$sy_start = date('Y');
				$sy_end = date('Y') + 1;
			}else{
				$school_year = explode('-', $school_year);
				$sy_start = $school_year[0];
				$sy_end = $school_year[1];
			}
			

			for($term=1;$term<=4;$term++){

				$output .= '<h3> Year Level: '. $term .'</h3>';

				$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $term);
				$sections = $main_model->get_sections_by_grade_level($grade_level_id);

				$output .= '<table class="table table-bordered">';
				$output .= '<tr>';
				$output .= '<th style="width:100px;">ID</th>';
				$output .= '<th style="width:200px;">Name</th>';
				$output .= '<th>Offered Subjects</th>';
				$output .= '</tr>';

				foreach($sections as $section){
					$offer_id = $section->offer_id;
					$section_name = $section->section;

					$output .= '<tr>';
					$output .= '<td>'.$offer_id.'</td>';
					$output .= '<td>'.$section_name.'</td>';
					$output .= '<td>';

					$subjects = $main_model->get_offered_subjects_by_section($offer_id);

					

					if(empty($subjects)){

						$output .= '<p>No offered subjects for this section.</p>';

					}else{

						$output .= '<ul>';

						foreach($subjects as $subject){

							$subj_offerid = $subject->subj_offerid;
							$subj_code = $subject->subj_code;
							$subj_desc = $subject->subj_desc;

							$teacher_info = $main_model->get_teacher_by_offered_subject($subj_offerid);

							if(empty($teacher_info)){
								$teacher_fullname = "Subject not yet assigned.";
							}else{
								$teacher_fullname = "assigned to: " . $teacher_info->lname . ', ' . $teacher_info->fname . ' ' . $teacher_info->mname;
							}
							

							$output .= '<li>'.$subj_code.' - ' . $teacher_fullname . '</li>';
						}

						$output .= '</ul>';

					}
					

					$output .= '</td>';
					$output .= '</tr>';

				}

				$output .= '</table>';
			}

			echo $output;		

			
		}
	}

	public function check_grading_system_columns(){

		$data = $this->input->post();

		if($data){
			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			$column_pass = true;

			$message = "<p>Columns to be removed may contain score.</p>";
			$message .= "<p>Are you sure to remove last column for the following?</p>";
			$message .= "<ul>";

			if($quiz_column < $old_quiz_column){
				$column_pass = false;
				$message .= "<li>Quiz</li>";
			}

			if($project_column < $old_project_column){
				$column_pass = false;
				$message .= "<li>Project</li>";
			}

			if($assignment_column < $old_assignment_column){
				$column_pass = false;
				$message .= "<li>Assignment</li>";
			}

			if($recitation_column < $old_recitation_column){
				$column_pass = false;
				$message .= "<li>Recitation</li>";
			}

			$message .= "</ul>";

			if($column_pass){
				$message = "";
			}

			$json_result = array(
				'result' => $column_pass,
				'message' => $message
			);

			echo json_encode($json_result);

		}

	}

	public function update_grading_system(){

		$data = $this->input->post();

		if($data){
			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			$new_total_weight = $quiz_weight+$project_weight+$assignment_weight+$recitation_weight+$exam_weight;

			if($new_total_weight === 100){

			//switch($activity_type){

			//case "quiz":
				$main_model->update_quiz_weight($quiz_weight, $subj_offerid, $term);
				$column_count = $main_model->get_quiz_column($subj_offerid, $term);
				$last_query = $this->update_column_rows($column_count, $quiz_column, $subj_offerid, $term, 'quiz');
				$main_model->update_quiz_column($quiz_column, $subj_offerid, $term);
				//break;
			//case "project":
				$main_model->update_project_weight($project_weight, $subj_offerid, $term);
				$column_count = $main_model->get_project_column($subj_offerid, $term);
				$last_query = $this->update_column_rows($column_count, $project_column, $subj_offerid, $term, 'project');
				$main_model->update_project_column($project_column, $subj_offerid, $term);
				//break;
			//case "assignment":
				$main_model->update_assignment_weight($assignment_weight, $subj_offerid, $term);
				$column_count = $main_model->get_assignment_column($subj_offerid, $term);
				$last_query = $this->update_column_rows($column_count, $assignment_column, $subj_offerid, $term, 'assignment');
				$main_model->update_assignment_column($assignment_column, $subj_offerid, $term);
				//break;
			//case "recitation":
				$main_model->update_recitation_weight($recitation_weight, $subj_offerid, $term);
				$column_count = $main_model->get_recitation_column($subj_offerid, $term);
				$last_query = $this->update_column_rows($column_count, $recitation_column, $subj_offerid, $term, 'recitation');
				$main_model->update_recitation_column($recitation_column, $subj_offerid, $term);
				//break;
			//case "exam":
				$main_model->update_exam_weight($exam_weight, $subj_offerid, $term);
				//only 4 columns
				//$last_query = '';
				//break;
			//}
				$json_result = array(
					'result' => 'success',
					'last_query' => $last_query,
					'message' => 'Grading percentage successfully saved.',
					'message_class' => 'success-message'
				);

			}else{

				$json_result = array(
					'result' => 'failed',
					'last_query' => '',
					'message' => 'Please make sure that total percentage is equal to 100.',
					'message_class' => 'error-message',
					'total_weight' => $total_weight
				);

			}

			

			echo json_encode($json_result);
		}
	}

	public function student_checkboxes_by_info(){

		$data = $this->input->post();

		if($data){

			$output = "";

			extract( $data, EXTR_SKIP );
			$main_model = $this->main_model;

			$school_year = explode('-', $school_year);
			$sy_start = $school_year[0];
			$sy_end = $school_year[1];

			$unenrolled_students = $main_model->get_unenrolled_students($sy_start, $sy_end, $grade_level);

			if(empty($unenrolled_students)){
				$output .= '<div class="checkbox">';
				$output .= "No unenrolled students for this shool year and year level.";
				$output .= '</div>';
			}else{
				foreach($unenrolled_students as $enrolled){
				
					$student_user_id = $enrolled->user_id;
					$student_fullname = $enrolled->lname . ', ' .$enrolled->fname . ' ' . $enrolled->mname;

					$output .= '<div class="checkbox">';
					$output .= "<label>";
					$output .= '<input type="checkbox" value="'.$student_user_id.'" name="enrolled_students[]"> '.$student_fullname;
					$output .= "</label>";
					$output .= '</div>';
				}
			}
			

			$json_result = array(
				'success' => true,
				'html' => $output
			);

			echo json_encode($json_result);

		}
	}

	public function display_grade_lock(){

		$data = $this->input->get();

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			$school_year = explode('-', $filter_school_year);
			$sy_start = $school_year[0];
			$sy_end = $school_year[1];

			$subjects = $main_model->get_subjects_offered_by_school_year($sy_start, $sy_end, $filter_year_level);
			$grade_level_id = $main_model->get_grade_level_id_by_detail($sy_start, $sy_end, $filter_year_level);

			$output = "";
			$output .= '<table class="table table-bordered">';
			$output .= '<tr>';
			$output .= '<th>Subject</th>';
			$output .= '<td>
			<a id="lock-all-subjects" href="#" class="btn btn-danger" data-gl="'.$grade_level_id.'"><i class="fa fa-lock"></i> Lock all Subjects</a>
			<a id="unlock-all-subjects" href="#" class="btn btn-primary" data-gl="'.$grade_level_id.'"><i class="fa fa-unlock"></i> Unlock all Subjects</a>
			</td>';
			$output .= '</tr>';

			foreach($subjects as $subject){

				$subj_id = $subject->subj_id;
				$gl_id = $subject->gl_id;
				$subj_code = $subject->subj_code;
				$lock_status = $subject->lock_status;

				$output .= '<tr>';
				$output .= '<td>'.$subj_code.'</td>';
				$output .= '<td>';

				if($lock_status){
					$output .= '<a href="#" class="btn btn-danger lock-status unlock-subject" data-id="'.$subj_id.'" data-gl="'.$gl_id.'"><i class="fa fa-lock"></i> <span class="lock-status-text">Unlock Grades</span></a>';
				}else{
					$output .= '<a href="#" class="btn btn-primary lock-status lock-subject" data-id="'.$subj_id.'" data-gl="'.$gl_id.'"><i class="fa fa-unlock"></i> <span class="lock-status-text">Lock Grades</span></a>';
				}

				$output .= '</td>';
				$output .= '</tr>';

			}

			$output .= '</table>';

			$json_result = array(
				'html' => $output,
				'last_query' => $this->db->last_query()
			);

			echo json_encode($json_result);
		}
	}

	public function change_lock_status(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$main_model = $this->main_model;

			if(isset($subj_id)){
				$main_model->update_grade_subj($gl_id, $lock_status);
			}else{
				$main_model->update_grade_subj($gl_id, $lock_status);
			}
			

			$json_result = array(
				'result' => true,
				'last_query' => $this->db->last_query()
			);

			echo json_encode($json_result);
		}


	}



}

/* End of file curiculum.php */
/* Location: ./application/controllers/curiculum.php */