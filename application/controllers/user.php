<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class User extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'User_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->form_primary = 'user_id';
		$this->user_type = 1;
		$this->user_title = "Admin";
	}

	public function index() {
		if ( $this->session->userdata( 'session' ) ) {
			redirect( 'user/profile' );
		}else {
			$this->login();
		}
	}



	public function profile() {

		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();

		$user_id = $this->session->userdata( 'session' );
		$user_type = $user_model->get_value( $user_id, 'user_type' );
		//$password_key = $user_model->get_value( $user_id, 'password_key', 'user' );

		$model_data = array();

		$model_data['user_type'] = $user_type;
		//$model_data['password_key'] = $password_key;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$footer_data = array();
		//$footer_data['modals'] = array('new-document-modal');
		$footer_data['listeners'] = array(
			'Module.Instructor.add_instructor()', 
			'Module.Instructor.search_instructor()',
			'Module.Instructor.refresh_instructor_list()'
		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'user/dashboard', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
	}

	public function login() {

		//TODO: top ranking documents
		$controller = $this->controller;
    	$method = $this->method;

		$logged_in = $this->session->userdata( 'is_logged_in' );
		$user = $this->session->userdata( 'session' );

		$not_activated = $this->session->flashdata('not_activated');
        $login_error = $this->session->flashdata('login_error');
        $password_reset_success = $this->session->flashdata('password_reset_success');

		$model_data = array(
			'base_url' => base_url(),
			'not_activated' => $not_activated,
			'login_error' => $login_error,
			'password_reset_success' => $password_reset_success,
			'controller' => $controller,
			'method' => $method
		);

		if ( !$logged_in ) {

			$redirect_link = $this->session->userdata( 'redirect_link' );

			if ( isset( $redirect_link ) ) {
				$model_data['redirect_link'] = $redirect_link;
			}else {
				$model_data['redirect_link'] = '';
			}


		}else {
			redirect( '' );
		}

		$header_data = array();

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;


		$this->load->view( 'user/login', $model_data );
	}

	public function validate_login() {

		$user_model = $this->main_model;

		$this->load->library( 'form_validation' );

		$this->form_validation->set_rules( 'username', 'Username', 'required|trim|xss_clean|callback_validate_credentials' );
		$this->form_validation->set_rules( 'password', 'Password', 'required|md5' );

		if ( $this->form_validation->run() ) {

			$username = $this->input->post( 'username' );
			$password = $this->input->post( 'password' );

			$id = $user_model->get_id_by_credentials( $username, $password );



			if ( $id == null ) {
				$this->session->set_flashdata( 'login_error', 'Incorrect Username/Password' );
				redirect();
				//'user/login'
			}else {
				//$status = $user_model->get_value( $id, 'status' );
				$status = 1;
			}

			if ( $status == 1 ) {

				$uploads_folder = $this->uploads_folder;

				$user_type = $user_model->get_value($id, 'user_type');
				$username = $user_model->get_value($id, 'username');

				if($user_type == 1)// admin
				{
					
					$role = 'admin';
				}
				else if($user_type == 2)// teacher
				{
					$user_type = $user_model->get_value($id, 'user_type');
					$username = $user_model->get_value($id, 'username');
					$role = 'teacher';
				}
				else if($user_type == 3)// student
				{
					$user_type = $user_model->get_value($id, 'user_type');
					$username = $user_model->get_value($id, 'username');
					$role = 'student';
					
				}

				


				$data = array(
					'is_logged_in' => '1',
					'session' => $id,
					'session_user' => $username,
					'session_full_name' => $full_name,
					//'user_photo' => image_exist($user_photo, 'circle', 'url'),
					'session_role' => $role,
					'user_type' => $user_type,
					'sidebar_state' => ''
				);



				$this->session->set_userdata( $data );

				$redirect_link = $this->input->post( 'redirect_link' );
				$this->session->set_userdata( 'redirect_link', '' );

				redirect( $redirect_link );

			}else {

				$this->session->set_flashdata( 'not_activated', true );

				redirect();

			}



		}else {


			$this->session->set_flashdata( 'login_error', 'Incorrect Username/Password' );
			redirect();

		}
	}


























	public function get_user(){


		$user_info = array(
			'table_data' => null,
		);

		$user_model = $this->user_model;

		$user_id = $this->session->userdata('session');

		$results = $user_model->get_user($user_id);

		$user_info['table_data'] = $results;

		echo json_encode($user_info);
	}

	public function password_change() {

		$this->load->library( 'form_validation' );

		$this->form_validation->set_rules( 'username', 'Username/Email', 'required|trim|xss_clean|callback_validate_username_email' );

		if ( $this->form_validation->run() ) {

			$this->load->model( 'User_Model' );
			$user_model = new User_Model();

			$username = $this->input->post( 'username' );

			$this->load->model( 'User_Model' );

			$email = $user_model->get_user_by_login( $username );
			$id = $user_model->get_user_by_login( $username, 'user_id' );


			$email_random_string = rand( 100, 9999 ).$id.rand( 100, 9999 );
			$password_key = sha1( $email_random_string.$username );


			$user_model->update_value( $id, 'password_key', $password_key );



			$to = $email;
			$subject = 'ISO 14224 - Reset your Password';
			$activation_link = base_url( 'user/reset-password/'.$password_key );


			$message = "Good Day,\n\nYou have requested to change your password.\n\nClick this activation link to change your password.\n".$activation_link."\n\nThanks,\n\nISO14224 Team";

			$this->send_mail( $to, $subject, $message );



			$this->session->set_flashdata( 'password_key_sent', 'Please check your email for the password change link.' );
			redirect( 'user/forgot-password' );


		}else {


			$this->session->set_flashdata( 'login_error', 'User does not exist' );
			redirect( 'user/forgot-password' );

		}
	}

	public function forgot_password() {

		$controller = $this->controller;
    	$method = $this->method;

		$logged_in = $this->session->userdata( 'is_logged_in' );
		$user = $this->session->userdata( 'session' );

		if ( !$logged_in ) {

		}else {
			redirect( '' );
		}

		$header_data = array(
			'hidden' => 'hidden'
		);

		$model_data = array(
			'base_url' => base_url(),
			'attributes' => array(
					'role' => 'form',
					'class' => 'form-horizontal',
					'id' => 'loginform'
				),
			'controller' => $controller,
			'method' => $method
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		//$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'user/forgot-password-new', $model_data );
		//$this->load->view( 'layout/footer' );
	}

	public function password_reset(){

		$data = $this->input->post();

		if ( $data ) {

			$user_model = $this->user_model;
			$user_id = $this->session->userdata( 'session' );

			extract( $data, EXTR_SKIP );

			if ( $password == $confirm_password && $password != '' ) {

				$new_password = md5( $password );

				$user_model->update_value( $user_id, 'password', $new_password );
				$user_model->update_value( $user_id, 'password_key', '' );

				echo 'success';

				/*$this->session->set_flashdata( 'password_reset_success', 'You can Sign in using your new password.' );

				redirect();*/

			}else {

				echo 'failed';

				//$this->session->set_flashdata( 'password_error', 'Password does not match.' );

			}
		}
	}

	public function contact_us() {

		$controller = $this->controller;
    	$method = $this->method;

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$this->load->library( 'form_validation' );
			$this->load->model( 'User_Model' );
			$user_model = new User_Model();

			$this->form_validation->set_rules( 'full_name', 'Full Name', 'trim|required' );
			$this->form_validation->set_rules( 'email', 'E-mail', 'trim|required|valid_email' );
			$this->form_validation->set_rules( 'subject', 'Subject', 'trim|required' );
			$this->form_validation->set_rules( 'message', 'Message', 'required' );

			if ( $this->form_validation->run() ) {

				$user_results = $user_model->get_user_by_role( 'admin' );

				$sent_value = 0;

				//var_dump($user_results);
				foreach ( $user_results as $user ) {

					$user_email = $user->email_address;

					$sent = $this->send_mail( $user_email, $subject, $message, $email, $full_name, null, null, 'html' );

					if($sent){
						$sent_value = 1;
					}

				}

				if ( $sent_value == 1 ) {
					$this->session->set_flashdata( 'message_sent', 'Your message is sent to iso14224.com admin.' );
					redirect(current_url());
				}else {
					$this->session->set_flashdata( 'message_failed', 'Sorry. We cannot send your message this time.' );
					redirect(current_url());
				}



			}

		}





		$header_data = array(
			'hidden' => 'hidden'
		);

		$model_data = array(
			'base_url' => base_url(),
			'attributes' => array(
					'role' => 'form',
					'class' => 'form-horizontal',
					'id' => 'loginform'
				),
			'controller' => $controller,
			'method' => $method
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		//$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'user/contact-us-new', $model_data );
		//$this->load->view( 'includes/footer' );
	}

	public function reset_password( $password_key = '' ) {

		$controller = $this->controller;
    	$method = $this->method;

		$data = $this->input->post();

		if ( $password_key == '' || $password_key == null ) {
			redirect( '' );
		}

		$this->load->model( 'User_Model' );
		$user_model = new User_Model();

		$confirm_password_key = $user_model->get_record_by_column_value( 'password_key', $password_key, 'password_key', 'user' );

		if ( $confirm_password_key == '' ) {
			redirect( '' );
		}

		if ( $confirm_password_key == $password_key ) {

			$user_details = $user_model->get_record_by_column_value( 'password_key', $password_key, '*', 'user' );

			
				$customer_id = $user_details->user_id;
				$username = $user_details->user_name;
			

			//var_dump($user_details);

			$data = $this->input->post();

			if ( $data ) {

				extract( $data, EXTR_SKIP );

				if ( $password == $confirm_password && $password != '' ) {

					$new_password = md5( $password );

					$user_model->update_value( $customer_id, 'password', $new_password );
					$user_model->update_value( $customer_id, 'password_key', '' );

					$this->session->set_flashdata( 'password_reset_success', 'You can Sign in using your new password.' );

					redirect();

				}else {

					//var_dump('test');

					$this->session->set_flashdata( 'password_error', 'Password does not match.' );
					redirect(current_url());

				}
			}

			$header_data = array(
			'hidden' => 'hidden'
			);

			$model_data = array(
				'base_url' => base_url(),
				'attributes' => array(
						'role' => 'form',
						'class' => 'form-horizontal',
						'id' => 'loginform'
					),
				'controller' => $controller,
				'method' => $method
			);

			$header_data['data'] = $header_data;
			$model_data['data'] = $model_data;

			//$this->load->view( 'includes/header-with-logout', $header_data );
			$this->load->view( 'user/reset-password-new', $model_data );
			//$this->load->view( 'includes/footer' );

		}
	}

	public function activate( $activation_key ) {

		if ( $activation_key == '' || $activation_key == null ) {
			redirect( '' );
		}

		$this->load->model( 'User_Model' );
		$user_model = new User_Model();

		$confirm_activation_key = $user_model->get_record_by_column_value( 'activation_key', $activation_key, 'activation_key', 'user' );

		if ( $confirm_activation_key == '' ) {
			redirect( '' );
		}

		if ( $confirm_activation_key == $activation_key ) {

			$user_details = $user_model->get_record_by_column_value( 'activation_key', $activation_key, '*', 'user' );

			foreach ( $user_details as $detail ) {
				$customer_id = $detail->user_id;
				$username = $detail->user_name;
			}

			//var_dump($user_details);

			$user_model->update_value( $customer_id, 'status', 1 );
			$user_model->update_value( $customer_id, 'activation_key', '' );

			$this->session->set_flashdata( 'activation_success', true );

			$login_data = array(
				'is_logged_in' => '1',
				'session' => $customer_id,
				'session_user' => $username,
				'case_file_step' => 0
			);

			$this->session->set_userdata( $login_data );

			redirect( 'user/my-account' );

		}
	}

	public function search_all() {

		$name = $this->input->post( 'id' ); //in this case a name

		$this->load->model( 'User_Model' );
		$user_model = new User_Model();

		$results = $user_model->search_by_name( $name );

		$option = '';

		foreach ( $results as $result ) {
			$fullname = $result['first_name'].' '.$result['last_name'];
			$id = $result['user_id'];
			$option .= "<li class='autosuggest-options' id='".$id."'>".$fullname."</li>";
		}

		echo $option;
	}

	public function get_user_data( $json = true ) {

		$this->is_logged_in();
		$data = $this->input->post();

		$user_model = $this->user_model;

		$model_data = array();

		$userdata = $user_model->get_all_records();

		$userdata_counter = 0;

		$json_array = array();


		foreach ( $userdata as $result ) {
			//var_dump($result);
			$asset_id = $result->asset;
			$user_id = $result->user_id;
			$first_name = $result->first_name;
			$last_name = $result->last_name;
			$user_name = $result->user_name;
			$role = $result->role;
			$database = $result->database;

			if ( empty( $database ) ) {
				$database = 'default';
			}

			$email_address = $result->email_address;
			$asset = $this->get_menu_detail_value( $asset_id, 'criticality_asset', 'menu', 'name' );
			$asset_role = $result->asset_role;

			$temp_array = array();
			$temp_array['asset_id'] = $asset_id;
			$temp_array['user_id'] = $user_id;
			$temp_array['first_name'] = $first_name;
			$temp_array['last_name'] = $last_name;
			$temp_array['user_name'] = $user_name;
			$temp_array['role'] = $role;
			$temp_array['database'] = $database;
			$temp_array['email_address'] = $email_address;
			$temp_array['asset'] = $asset;
			$temp_array['asset_role'] = $asset_role;
			$temp_array['asset_id'] = $asset_id;
			$json_array[] = $temp_array;

		}

		if ( $json ) {
			echo json_encode( $json_array );
		}else {
			return $json_array;
		}
	}

	public function create_user() {

		$databases = $this->databases;

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$user_model = $this->user_model;;
			$form_primary = $this->form_primary;

			foreach ( $databases as $database ) {

				if ( empty( $database ) || $database == '' ) {
					$database = 'default';
				}

				$password_key = 'first-time';

				$this->db = $this->load->database( $database, TRUE );

				$create_user_id = $user_model->create_user( $first_name, $last_name, $user_name, $role, $email_address, md5( $password ), $asset, $asset_role, $database_name, $password_key );

			}

			redirect( 'user/admin' );



		}
	}

	public function update_user() {

		$databases = $this->databases;

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$user_model = $this->user_model;;
			$form_primary = $this->form_primary;

			$new_password = md5( $new_password );

			foreach ( $databases as $database ) {

				if ( empty( $database ) || $database == '' ) {
					$database = 'default';
				}

				$this->db = $this->load->database( $database, TRUE );

				$update_user_id = $user_model->edit_user( $user_id, $first_name, $last_name, $user_name, $role, $email_address, $new_password, $asset, $asset_role, $database_name );

			}




			redirect( 'user/admin' );



		}
	}

	public function validate_sample_user() {

		$sample_users = array();
		$sample_users[] = array(
			'username' => 'sample',
			'password' => '5e8ff9bf55ba3508199d22e984129be6'
		);

		$validate = false;

		$username = $this->input->post( 'username' );
		$password = md5( $this->input->post( 'password' ) );

		foreach ( $sample_users as $user ) {
			$validate_username = $user['username'];
			$validate_password = $user['password'];

			if ( $username == $validate_username && $password == $validate_password ) {
				$validate = true;
				break;
			}else {
				$validate = false;
			}
		}

		return $validate;
	}

	public function validate_credentials() {
		$this->load->model( 'User_Model' );

		$username = $this->input->post( 'username' );
		$password = $this->input->post( 'password' );

		if ( $this->User_Model->can_login( $username, md5( $password ) ) ) {
			return true;
		} else {
			$this->session->set_flashdata( 'login_error', 'Incorrect Username/Password' );
			return false;
		}
	}

	public function validate_username_email() {

		$this->load->model( 'User_Model' );

		$username = $this->input->post( 'username' );

		if ( $this->User_Model->is_valid_user( $username ) ) {
			return true;
		} else {
			$this->session->set_flashdata( 'login_error', 'User does not exist' );
			return false;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect( '' );
	}

	public function check_user_password() {

		$result = array();
		$data = $this->input->post();

		if ( $data ) {

			$current_user_id = $this->input->post( 'current_user_id' );
			$old_password = $this->input->post( 'old_password' );

			$old_password = md5( $old_password );

			$user_model = $this->main_model;
			$user_password = $user_model->get_user_password( $current_user_id );

			//echo $user_password;

			if ( $user_password == $old_password ) {
				$result['verified_password'] = true;

			}else {
				$result['verified_password'] = false;
			}

			$result['password'] = $old_password;
			$result['old_password'] = $user_password;

			echo json_encode( $result );

		}
	}

	public function _unique_email( $str ) {

		$user_model = $this->main_model;

		$id = $this->uri->segment( 4 );
		$this->db->where( 'email', $this->input->post( 'email' ) );
		!$id || $this->db->where( 'id != ', $id );
		$user = $user_model->get_all_records();

		if ( count( $user ) ) {
			$this->form_validation->set_message( '_unique_email', '% should be unique' );
			return false;
		}

		return true;
	}

	public function _unique_slug( $str ) {

		$user_model = $this->main_model;

		$id = $this->uri->segment( 4 );
		$this->db->where( 'slug', $this->input->post( 'slug' ) );
		!$id || $this->db->where( 'id != ', $id );
		$user = $user_model->get_all_records();

		if ( count( $user ) ) {
			$this->form_validation->set_message( '_unique_slug', '% should be unique' );
			return false;
		}

		return true;
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
