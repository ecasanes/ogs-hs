<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Teacher extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'Teacher_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->form_primary = 'teacher_id';
		$this->privilege = 3;
	}

	public function insert(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );
			
			$main_model = $this->main_model;
			$user_model = $this->user_model;
			$privilege = $this->privilege;

			$this->load->library( 'form_validation' );

			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_message( 'is_unique', 'failed' );
			$this->form_validation->set_message( 'matches', 'failed' );

			//min_length[4]
			//required

			$this->form_validation->set_rules( 'username', 'Username', 'is_unique[user.username]' );
			$this->form_validation->set_rules( 'password', 'Password', 'trim|matches[confirm_password]' );
			//$this->form_validation->set_rules( 'confirm_password', 'Password Confirmation', 'trim|required' );
			//$this->form_validation->set_rules( 'email_address', 'Email', 'required|valid_email|is_unique[user.email_address]' );

			if ( $this->form_validation->run() ) {

				$user_id = $user_model->create_user($username, $password, $privilege);
				$teacher_id = $main_model->create_teacher($firstname, $lastname, $user_id);
				$success_message = "Instructor was added successfully. ";

				if($teacher_id){
					
					$json_result = array(
							'user_id' => $user_id,
							'teacher_id' => $teacher_id,
							'result' => 'success',
							'success_message' => $success_message
						);
				}else{
					$json_result = array(
						'result' => 'failed'
					);
				}

				$json_result['username'] = 'success';
				$json_result['confirm_password'] = 'success';				

			}else{
				$json_result = array(
						'username' => form_error('username'),
						'username_message' => 'Username already exist. ',
						'confirm_password' => form_error('password'),
						'password_message' => 'Password does not match. ',
						'result' => 'failed'
					);
			}

			echo json_encode($json_result);

			
			

		}
	}


	public function data_list(){

		$main_model = $this->main_model;

		$results = $main_model->get_all_records();

		$model_data = array(
				'results' => $results
			);

		$this->load->view('teacher/list', $model_data);

	}


	public function search_list(){

		$main_model = $this->main_model;

		$search_key = $this->input->get('search');

		$results = $main_model->search_list($search_key);

		$model_data = array(
				'results' => $results
			);

		$this->load->view('teacher/list', $model_data);
	}
}

/* End of file instructor.php */
/* Location: ./application/controllers/instructor.php */