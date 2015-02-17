<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class User extends My_Controller {

	public function __construct() {

		parent::__construct();

		$main_model_str = 'User_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;
		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$this->form_primary = 'user_id';
	}

	public function index() {
		if ( $this->session->userdata( 'session' ) ) {
			redirect( 'user/dashboard' );
		}else {
			$this->login();
		}
	}

	public function dashboard() {

		$this->is_logged_in();

		$user_model = $this->user_model;

		$header_data = array();

		$user_id = $this->session->userdata( 'session' );
		$privilage = $user_model->get_value( $user_id, 'privilage', 'user' );
		//$password_key = $user_model->get_value( $user_id, 'password_key', 'user' );

		$model_data = array();

		$model_data['privilage'] = $privilage;
		//$model_data['password_key'] = $password_key;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$footer_data = array();
		//$footer_data['modals'] = array('new-document-modal');

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'user/dashboard', $model_data );
		$this->load->view( 'layout/footer' , $footer_data);
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

	public function php_info() {
		echo phpinfo();
	}

	public function get_current_followers(){

		$user_id = $this->session->userdata('session');

		$this->get_followers($user_id, "table");
	}

	public function get_followers( $user_id = false, $return_type = null ) {

		$data = $this->input->post();
		$user_model = $this->main_model;

		if($data){

			if ( empty( $user_id ) ) {
				$user_id = $this->session->userdata( 'session' );
			}else{
				$user_id = $this->input->post('user_id');
			}

			$count = $this->input->post('count');

			if($count == 'true'){
				$count = true;
			}

		}

		$users = $user_model->get_followers( $user_id );

		$model_data = array(
			'users' => $users
		);

		switch($return_type){
			

			case "json":

				echo json_encode($users);
				break;

			case "array":

				return $users;
				break;

			case "table":

				echo $this->load->view('user/user-followers', $model_data, true);
				break;

			case "count" || "true":

				$followers = count($users);

				if($followers > 1){
					echo $followers.' Followers';
				}else{
					echo $followers.' Follower';
				}

				break;

			default:
				return $users;
				break;
		}
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

	public function save() {

		$data = $this->input->post();

		$current_user_id = $this->session->userdata( 'session' );

		$upload_data_count = 0;

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$this->load->model( 'User_Model' );
			$user_model = new User_Model();

			$update_flag = true;

			if ( $update_flag ) {

				// Here.
				$user_model->update_photo($current_user_id, $user_image, $cover_image);

				# Reinitialize session.

				$uploads_folder = $this->uploads_folder;

				$id = $this->session->userdata('session');
				$user_photo_id = $user_model->get_value( $id, 'user_photo' );
				
				// Get user photo if there is.
				$user_photo_name = '';

				// Get photodetails.
				$user_photo_details = $user_model->get_file_item_name($user_photo_id);

				// Isolate index value if there is.
				if( isset($user_photo_details['filename']) ) { $user_photo_name = $user_photo_details['filename']; }

				// Build into exact location.
				$user_photo = base_url($uploads_folder.'/'.$user_photo_name);

				$this->session->set_userdata(array(
					'user_photo' => image_exist($user_photo, 'circle', 'url'),
				));
				# end of Reinitialization.

				redirect( 'user/my-account' );

			}
		}
	}

	public function save_information(){

		$data = $this->input->post();
		$result = array();

		if($data){

			extract( $data, EXTR_SKIP );

			$user_id = $this->session->userdata('session');

			$user_model = $this->user_model;
			$this->load->library( 'form_validation' );

			$this->form_validation->set_message( 'is_unique', '%s already exists' );

			/*if($password != ''){
				$this->form_validation->set_rules( 'password', 'Password', 'trim|matches[confirm_password]|required|md5' );
			}*/
			$this->form_validation->set_rules('confirm_email_address', 'Confirm Email Address');

			if($email_address != $original_email_address){
				$this->form_validation->set_rules( 'email_address', 'Email', 'valid_email|matches[confirm_email_address]|is_unique[user.email_address]' );
			}else{
				if($confirm_email_address != ''){
					$this->form_validation->set_rules( 'email_address', 'Email', 'valid_email|matches[confirm_email_address]' );
				}else{
					$this->form_validation->set_rules( 'email_address', 'Email', 'valid_email|matches[original_email_address]' );
				}
				
			}
			

			
			if ( $this->form_validation->run() ) {

				$user_model->update_information($user_id, $position, $discipline, $area_of_operation, $years_of_service, $highest_qualification, $email_address, $password, $asset_operation);

				$result['result'] = 'success';	
				echo json_encode($result);			

			}else{

				$result['result'] = 'fail';
				$result['error_text'] = validation_errors(' ','  ');

				echo json_encode($result);

			}

		}
	}

	public function navbar_toggle(){

		$data = $this->input->post();

		if($data){

			$sidebar_state = $this->input->post('sidebar_state');

			$this->session->set_userdata("sidebar_state", $sidebar_state);

		}
	}

	public function update_user_notification(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$user_id = $this->session->userdata('session');

			$user_model = $this->user_model;

			if($state == 'true'){
				$state = 'yes';
			}
			else{
				$state = 'no';
			}

			$user_model->update_value( $user_id, $column, $state, 'user', 'user_id' );

			echo $state;

		}
	}

	public function signup() {

		$logged_in = $this->session->userdata( 'is_logged_in' );

		$header_data = array();
		$model_data = array();

		$header_data['hidden'] = 'hidden';

		$model_data['error'] = '';
		$model_data['signup_success'] = false;

		if ( !$logged_in ) {

		}else {
			redirect( '' );
		}






		$this->load->library( 'form_validation' );
		$this->load->model( 'User_Model' );
		$user_model = new User_Model();

		$this->form_validation->set_message( 'is_unique', '%s already exists' );

		$this->form_validation->set_rules( 'username', 'Username', 'required|min_length[4]|is_unique[user.user_name]' );
		$this->form_validation->set_rules( 'password', 'Password', 'trim|required|matches[confirm_password]|md5' );
		$this->form_validation->set_rules( 'confirm_password', 'Password Confirmation', 'trim|required' );
		$this->form_validation->set_rules( 'email_address', 'Email', 'required|valid_email|is_unique[user.email_address]' );

		$data = $this->input->post();

		if ( $data ) {
			extract( $data, EXTR_SKIP );
		}


		if ( $this->form_validation->run() ) {
			$cust_ref_id = 0;
			$status = 0;

			$new_password = $this->input->post( 'password' );

			$customer_id = $user_model->create( $firstname, $lastname, $username, $email_address, $new_password, $status );

			//$equipment_categories = $user_model->get_main_menu( 'equipment_category' );

			$user_preference_category_name = 'equipment_category';
			$user_preference_category_id = $user_model->get_value( $user_preference_category_name, 'name', 'user_preference_category' );

			$user_model->create_empty_user_preference( $equipment_categories, $customer_id, 0, $user_preference_category_id );

			$cust_ref_id = rand( 100, 9999 ).$customer_id.rand( 100, 9999 );
			$activation_key = sha1( $cust_ref_id.$firstname.$lastname );

			//$user_model->update_value($customer_id, 'cust_ref_id', $cust_ref_id);
			$user_model->update_value( $customer_id, 'activation_key', $activation_key );

			$form_primary = $this->form_primary;
			$user_model->create_empty_sub_table( $customer_id, 'follow_user', 2, $form_primary );



			$to = $email_address;
			$subject = 'ISO 14224 - Activate your Account';
			$activation_link = base_url( 'user/activate/'.$activation_key );


			$message = "Good Day,\n\nThanks for signing up with us at iso14224.com\n\nClick this activation link to Sign-in to your account.\n".$activation_link."\n\nThanks,\n\nISO14224 Team";

			$this->send_mail( $to, $subject, $message );

			$model_data['signup_success'] = true;


			$signup_view = true;

		}
		else {

			$signup_view = true;



		}


		if ( $signup_view ) {

			if ( $data ) {
				$model_data['username'] = $username;
				$model_data['email_address'] = $email_address;
				$model_data['firstname'] = $firstname;
				$model_data['lastname'] = $lastname;
			}else {
				$model_data['username'] = '';
				$model_data['email_address'] = '';
				$model_data['firstname'] = '';
				$model_data['lastname'] = '';
			}

			$header_data['data'] = $header_data;
			$model_data['data'] = $model_data;

			$this->load->view( 'includes/header-with-logout', $header_data );
			$this->load->view( 'user/signup', $model_data );
			$this->load->view( 'includes/footer' );
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

	public function create() {

		$this->is_logged_in();

		$header_data = array(
			'hidden' => '' );

		$model_data = array(
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'user/user-create', $model_data );
		$this->load->view( 'includes/footer' );
	}

	public function create_report() {

		$this->is_logged_in();

		$header_data = array(
			'hidden' => '' );

		$model_data = array(
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'user/user-create-report', $model_data );
		$this->load->view( 'includes/footer' );
	}

	public function my_account() {

		// Login check
		$this->is_logged_in();

		// Get initial data in the USER table.

		# Models

		// Load model to edit corresponding documents.
		$this->load->model( 'Document_Model' );
		$document_model = new Document_Model();

		// Load user model.
		$user_model = $this->user_model;

		# end of Models

		# Config

		// Upload folder config.
		$uploads_folder = $this->uploads_folder;

		# end of config

		# Pre Data.
		
		// ID to get data.
		$user_id = $this->session->userdata('session');
		
		// Page Data.
		$user_result = $user_model->get_record( $user_id );
		$user_result = $user_result[0];

		// User Details.
		$fullname = $user_result->first_name.' '.$user_result->last_name;
		$discipline = $user_result->discipline;
		$position = $user_result->position;
		$years_of_service = $user_result->years_of_service;
		$area_of_operations = $user_result->area_of_operations;
		$highest_qualification = $user_result->highest_qualification;
		$last_worked_on = $user_result->last_worked_on;
		$forward_emails = $user_result->forward_emails;
		$notify_technical_bulletin = $user_result->notify_technical_bulletin;
		$notify_case_file = $user_result->notify_case_file;
		$user_photo = $user_result->user_photo;
		$cover_photo = $user_result->cover_photo;
		$asset_operation = $user_result->asset_operation;
		$email_address = $user_result->email_address;

		// For followers.
		$userdata = $user_model->get_all_records();

		// Image Query (cover and profile).
		$cover_photo_details = $user_model->get_account_cover_photo($user_id);
		$profile_photo_details = $user_model->get_account_profile_photo($user_id);
		
		$cover_photo_id = '';
		$profile_photo_id = '';
		$cover_photo = '';
		$profile_photo = '';

		if( ! empty($cover_photo_details) )
		{
			$cover_photo = $cover_photo_details->filename;
			$cover_photo_id = $cover_photo_details->file_item_id;
		}

		if( ! empty($profile_photo_details) )
		{
			$profile_photo = $profile_photo_details->filename;
			$profile_photo_id = $profile_photo_details->file_item_id;
		}

		# picture.
		/*$footer_data['profile_photo'] = $profile_photo;
		$footer_data['cover_photo'] = $cover_photo;*/

		$userdata_array = array();
		$userdata_counter = 0;
		$model_data = array();

		$model_data['user_option'] = '';
		$model_data['user_photo'] = ''; // Blank sah. XD
		$model_data['uploads_folder'] = $uploads_folder;

		$image = $user_model->get_image_name($user_photo);
		

		$model_data['user_photo_url'] = 'http://localhost/reliabilitysolutions/uploads/'.$image;
		$model_data['current_user_id'] = $user_id;

		$followed_users = $user_model->get_followed_user( $user_id );

		// Follower options.
		foreach ( $userdata as $result ) {
			$full_name = $result->first_name. ' ' .$result->last_name;
			$userdata_array[$userdata_counter] = array();

			$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';
		}
		

		$model_data['user_id'] = $user_id;
		$model_data['followed_users'] = $followed_users;

		$model_data['fullname'] = $fullname;

		$model_data['discipline'] = $discipline;
		$model_data['position'] = $position;
		$model_data['years_of_service'] = $years_of_service;
		$model_data['area_of_operation'] = $area_of_operations;
		$model_data['highest_qualification'] = $highest_qualification;
		$model_data['last_worked_on'] = $last_worked_on;

		$model_data['discipline_value'] = $this->get_menu_detail_value( $discipline, 'discipline', 'menu', 'name' );
		$model_data['position_value'] = $this->get_menu_detail_value( $position, 'position', 'menu', 'name' );
		$model_data['area_of_operation_value'] = $this->get_menu_detail_value( $area_of_operations, 'area_of_operation', 'menu', 'name' );
		$model_data['years_of_service_value'] = $this->get_menu_detail_value( $years_of_service, 'years_of_service', 'menu', 'name' );
		$model_data['asset_operation_value'] = $this->get_menu_detail_value($asset_operation, 'asset_type', 'menu', 'name' );
		$model_data['highest_qualification_value'] = $this->get_menu_detail_value( $highest_qualification, 'highest_qualification', 'menu', 'name' );

		$model_data['forward_emails'] = $forward_emails;
		$model_data['notify_technical_bulletin'] = $notify_technical_bulletin;
		$model_data['notify_case_file'] = $notify_case_file;

		// Pics.
		$model_data['upload_filename'] = $profile_photo;
		$model_data['cover_filename'] = $cover_photo;

		$model_data['email_address'] = $email_address;

		$user_photo = base_url( $uploads_folder.'/'.$profile_photo );
		$cover_photo = base_url( $uploads_folder.'/'.$cover_photo );
		$model_data['user_photo'] = $profile_photo;
		$model_data['cover_photo'] = $cover_photo;

		$model_data['upload_error'] = $this->session->flashdata( 'upload_error' );



		$user_photo = base_url( 'uploads/'.$profile_photo );


		$decf_results = $document_model->count_document_per_type( $user_id, 'decf', 'F-DECF' );
		$basic_decf_results = $document_model->count_document_per_type( $user_id, 'decf', 'DECF' );
		$ofi_results = $document_model->count_document_per_type( $user_id, 'ofi' );
		$pp_results = $document_model->count_document_per_type( $user_id, 'project_plan' );
		$tb_results = $document_model->count_document_per_type( $user_id, 'technical_bulletin' );
		$ws_results = $document_model->count_document_per_type( $user_id, 'witness_statement' );
		$tq_results = $document_model->count_document_per_type( $user_id, 'technical_query' );
		//mcdr
		$mcdr_results = $document_model->count_document_per_type( $user_id, 'mcdr' );

		$erp_results = $document_model->count_document_per_type( $user_id, 'erp' );

		$model_data['decf_results'] = $decf_results;
		$model_data['basic_decf_results'] = $basic_decf_results;
		$model_data['ofi_results'] = $ofi_results;
		$model_data['pp_results'] = $pp_results;
		$model_data['tb_results'] = $tb_results;
		$model_data['ws_results'] = $ws_results;
		$model_data['tq_results'] = $tq_results;

		$model_data['erp_results'] = $erp_results;
		$model_data['mcdr_results'] = $mcdr_results;


		$preferred_equipment_categories = array();


		$equipment_categories = $user_model->get_main_menu( 'equipment_category' );

		foreach ( $equipment_categories as $category ) {
			$equipment_category_id = $category->menu_id;
			$equipment_category_name = $category->name;

			$notify = $user_model->get_value_multiple_var( 'user_id', 'menu_id', $user_id, $equipment_category_id, 'notify', 'user_preference' );

			$preferred_equipment_categories[] = array(
				'id' => $equipment_category_id,
				'name' => $equipment_category_name,
				'notify' => $notify
			);
		}

		$model_data['preferred_equipment_categories'] = $preferred_equipment_categories;


		$model_data['discipline_dropdown'] = $this->get_dropdown_menu( $discipline, 'discipline' );
		$model_data['position_dropdown'] = $this->get_dropdown_menu( $position, 'position' );
		$model_data['years_of_service_dropdown'] = $this->get_dropdown_menu( $years_of_service, 'years_of_service' );
		$model_data['area_of_operation_dropdown'] = $this->get_dropdown_menu( $area_of_operations, 'area_of_operation' );
		$model_data['highest_qualification_dropdown'] = $this->get_dropdown_menu( $highest_qualification, 'highest_qualification' );
		$model_data['asset_operation_dropdown'] = $this->get_dropdown_menu( $asset_operation, 'asset_type' );


		include('includes/document-count-snippet.php');
		$model_data = array_merge($model_data, $document_count);

		$header_data['current_page_name'] = "My Account";
		$header_data['data'] = $header_data	;
		$model_data['data'] = $model_data;

		// FILE ITEM ID.
		$model_data['cover_photo_id'] = $cover_photo_id;
		$model_data['profile_photo_id'] = $profile_photo_id;
		$model_data['file_value'] = '';

		$footer_data['modals'] = array('my-account-upload-modal', 'confirm-delete-modal', 'file-manager-modal');




		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'user/my-account-new', $model_data );
		$this->load->view( 'layout/footer', $footer_data );
	}

	public function admin_dashboard() {

		$this->is_logged_in();
		$data = $this->input->post();

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );

		$header_data = array(
			'hidden' => ''
		);

		$model_data = array();

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'includes/header-with-logout', $header_data );
		$this->load->view( 'admin/admin-dashboard', $model_data );
		$this->load->view( 'includes/footer' );
	}

	public function admin() {

		$this->is_logged_in();
		$data = $this->input->post();

		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );

		$header_data = array(
			'hidden' => ''
		);

		$model_data = array();



		$userdata = $user_model->get_all_records();

		$userdata_counter = 0;
		foreach ( $userdata as $result ) {
			//var_dump($result);
			$user_id = $result->user_id;
			$first_name = $result->first_name;
			$last_name = $result->last_name;
			$user_name = $result->user_name;
			$role = $result->role;
			$email_address = $result->email_address;
			$asset = $result->asset;
			$asset_role = $result->asset_role;

		}

		$model_data['criticality_asset'] = $this->get_dropdown_menu( null, 'criticality_asset' );

		$model_data['user_id'] = $user_id;
		$model_data['first_name'] = $first_name;
		$model_data['last_name'] = $last_name;
		$model_data['user_name'] = $user_name;
		$model_data['role'] = $role;
		$model_data['email_address'] = $email_address;
		$model_data['asset'] = $asset;
		$model_data['asset_role'] = $asset_role;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'user/user-admin', $model_data );
		$this->load->view( 'includes/footer' );
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
			'attributes' => array(
					'role' => 'form',
					'class' => 'form-horizontal',
					'id' => 'loginform'
				),
			'not_activated' => $not_activated,
			'login_error' => $login_error,
			'password_reset_success' => $password_reset_success,
			'controller' => $controller,
			'method' => $method
		);

		if ( !$logged_in ) {



			$this->load->model( 'DocumentRanking_Model' );
			$this->load->model( 'TB_Model' );

			$document_ranking_model = new DocumentRanking_Model();
			$tehnical_bulletin_model = new TB_Model();

			$top_documents = $document_ranking_model->get_top_document( 'technical-bulletin', 4 );

			$documents = array();

			foreach ( $top_documents as $document ) {

				$document_id = $document->document_id;
				$code = $document->code;
				$name = $document->name;

				$document_info = array(
					'id' => $document_id,
					'code' => $code,
					'name' => truncate( $name, 20 ),
					'likes' => $document_ranking_model->get_likes( $document_id )
				);

				$documents[] = $document_info;
			}

			$redirect_link = $this->session->userdata( 'redirect_link' );

			if ( isset( $redirect_link ) ) {
				$model_data['redirect_link'] = $redirect_link;
			}else {
				$model_data['redirect_link'] = '';
			}

			$model_data['documents'] = $documents;


		}else {
			redirect( '' );
		}

		$header_data = array(
			'hidden' => ''
		);

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;


		$this->load->view( 'user/login-new', $model_data );
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
				$status = $user_model->get_value( $id, 'status' );
			}

			if ( $status == 1 ) {

				$uploads_folder = $this->uploads_folder;

				$database = $user_model->get_value( $id, 'database' );
				
				$user_photo_id = $user_model->get_value( $id, 'user_photo' );
				
				// Get user photo if there is.
				$user_photo_name = '';

				// Get photodetails.
				$user_photo_details = $user_model->get_file_item_name($user_photo_id);

				// Isolate index value if there is.
				if( isset($user_photo_details['filename']) ) { $user_photo_name = $user_photo_details['filename']; }

				// Build into exact location.
				$user_photo = base_url($uploads_folder.'/'.$user_photo_name);

				$full_name = $user_model->get_full_name($id);
				$role = $user_model->get_value( $id, 'role' );


				$data = array(
					'is_logged_in' => '1',
					'session' => $id,
					'session_user' => $username,
					'session_full_name' => $full_name,
					'case_file_step' => 0,
					'database' => $database,
					'user_photo' => image_exist($user_photo, 'circle', 'url'),
					'session_role' => $role,
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

	//temp function
	public function generate_empty_follow_user() {

		$user_model = $this->main_model;
		$form_primary = $this->form_primary;

		$users = $user_model->get_all_records();

		/*echo '<pre>';
		var_dump($users);
		echo '</pre>';*/

		foreach ( $users as $user ) {

			$user_id = $user->user_id;

			$user_model->create_empty_sub_table( $user_id, 'follow_user', 2, $form_primary );
		}
	}

	public function view_comments( $document_id ) {

		$this->is_logged_in();
		$data = $this->input->post();

		$this->load->model( 'Document_Model' );
		$document_model = new Document_Model();
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );

		$document_details = $document_model->get_document( $document_id );

		$document_name = $document_details->name;
		$document_type = $document_details->document_code;
		$document_code = $document_details->code;
		$date_created = convert_date_to_string($document_details->date_created);
		$document_status = $this->get_menu_detail_value( $document_details->document_status, 'document_status', 'menu', 'name' );


		$header_data = array(
			'hidden' => '',
			'document_type' => $document_type
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['document_id'] = $document_id;

		$model_data['document_name'] = $document_name;
		$model_data['document_type'] = $document_details->document_type;
		$model_data['document_code'] = $document_code;
		$model_data['date_created'] = $date_created;
		$model_data['document_status'] = $document_status;

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'view/view-comments-new', $model_data );
		$this->load->view( 'layout/footer' );
	}

	//NEW DASHBOARD THEME
	

	public function update_single_user_preference(){

		$this->is_logged_in();
		$user_id = $this->session->userdata( 'session' );

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$this->load->model( 'User_Model' );

			$user_model = new User_Model();

			$id = $user_model->check_if_preference_exist($user_id, $menu_id);

			if(count($id) == 0){
				$user_model->create_user_preference( $user_id, $menu_id, $notify, null);
				echo 'empty';
			}
			else{
				$user_preference_id = $id->user_preference_id;
				$user_model->update_single_preference($user_id, $menu_id, $notify, $user_preference_id);
				echo $user_preference_id;
			}
		}
	}

	public function update_single_follow_user(){

		$this->is_logged_in();
		$user_id = $this->session->userdata( 'session' );

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$this->load->model( 'User_Model' );

			$user_model = new User_Model();

			$id = $user_model->check_if_already_follow_row_exist($follow_user_id);

			if(count($id) == 0){
				$created_id = $user_model->create_follow_user($user_id, $followed_id);
				echo $created_id;
			}
			else{
				$user_model->update_single_follow_user($user_id, $followed_id, $follow_user_id);
				echo $follow_user_id;
			}

		}
	}

	public function delete_single_follow_user(){
		$this->is_logged_in();
		$user_id = $this->session->userdata( 'session' );

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$this->load->model( 'User_Model' );

			$user_model = new User_Model();

			$user_model->delete_value( $follow_user_id, 'follow_user', 'follow_user_id' );
		}
	}

	public function follow_document_test(){

		$this->load->model('Document_Model');
		$document_model = new Document_Model();

		$document_id = 121;


		//if($document_id){

			$follow = "false";

			$user_id = $this->session->userdata('session');

			$document_follower_id = $document_model->get_document_follower_id($document_id, $user_id);

			if($follow == "true"){
				if($document_follower_id == null){
					$document_model->follow_document($document_id, $user_id);
				}
				echo 'follow success';
			}else{
				if($document_follower_id != null){
					$document_model->unfollow_document($document_id, $user_id);
				}
				echo 'unfollow success';
			}

			//echo $document_follower_id;

		//}
	}

	public function follow_document(){

		$this->load->model('Document_Model');
		$document_model = new Document_Model();

		$document_id = $this->input->post('document_id');

		if($document_id){

			$follow = $this->input->post('follow');

			$user_id = $this->session->userdata('session');

			$document_follower_id = $document_model->get_document_follower_id($document_id, $user_id);

			if($follow == "true"){
				if($document_follower_id == null){
					$document_model->follow_document($document_id, $user_id);
				}
				echo 'follow success';
			}else{
				if($document_follower_id != null){
					$document_model->unfollow_document($document_id, $user_id);
				}
				echo 'unfollow success';
			}

			//echo $document_follower_id;

		}
	}

	public function notifications(){

		$this->load->view('layout/header');
		$this->load->view('user/notifications');
		$this->load->view('layout/footer');
	}

	public function settings(){

		$this->is_logged_in();

		$uploads_folder = $this->uploads_folder;

		$session_photo = $this->session->userdata('user_photo');
		$user_photo_url = $session_photo;
		//var_dump($user_photo_url);

		$this->load->model( 'Document_Model' );
		$document_model = new Document_Model();

		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );
		$username = $this->session->userdata( 'session_user' );
		$case_file_step = $this->session->userdata( 'case_file_step' );


		$user_result = $user_model->get_record( $user_id );

		/*echo '<pre>';
		var_dump($user_result);
		echo '</pre>';*/

		$followed_users = $user_model->get_followed_user( $user_id );

		$header_data = array(
			'hidden' => ''
		);

		$model_data = array();
		$model_data['user_option'] = '';
		$model_data['user_photo'] = $session_photo;
		$model_data['uploads_folder'] = $uploads_folder;
		$model_data['user_photo_url'] = $user_photo_url;
		$model_data['current_user_id'] = $user_id;

		$userdata = $user_model->get_all_records();

		$userdata_array = array();
		$userdata_counter = 0;
		foreach ( $userdata as $result ) {

			$full_name = $result->first_name. ' ' .$result->last_name;

			$userdata_array[$userdata_counter] = array();

			$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';
		}

		foreach ( $user_result as $result ) {




			$fullname = $result->first_name.' '.$result->last_name;
			$discipline = $result->discipline;
			$position = $result->position;
			$years_of_service = $result->years_of_service;
			$area_of_operations = $result->area_of_operations;
			$highest_qualification = $result->highest_qualification;
			$last_worked_on = $result->last_worked_on;
			$forward_emails = $result->forward_emails;
			$notify_technical_bulletin = $result->notify_technical_bulletin;
			$notify_case_file = $result->notify_case_file;
			$user_photo = $result->user_photo;
			$cover_photo = $result->cover_photo;
			$asset_operation = $result->asset_operation;

			$email_address = $result->email_address;

		}




		$model_data['user_id'] = $user_id;
		$model_data['followed_users'] = $followed_users;

		$model_data['fullname'] = $fullname;

		$model_data['discipline'] = $discipline;
		$model_data['position'] = $position;
		$model_data['years_of_service'] = $years_of_service;
		$model_data['area_of_operation'] = $area_of_operations;
		$model_data['highest_qualification'] = $highest_qualification;
		$model_data['last_worked_on'] = $last_worked_on;

		$model_data['discipline_value'] = $this->get_menu_detail_value( $discipline, 'discipline', 'menu', 'name' );
		$model_data['position_value'] = $this->get_menu_detail_value( $position, 'position', 'menu', 'name' );
		$model_data['area_of_operation_value'] = $this->get_menu_detail_value( $area_of_operations, 'area_of_operation', 'menu', 'name' );
		$model_data['years_of_service_value'] = $this->get_menu_detail_value( $years_of_service, 'years_of_service', 'menu', 'name' );
		$model_data['asset_operation_value'] = $this->get_menu_detail_value($asset_operation, 'asset_type', 'menu', 'name' );
		$model_data['highest_qualification_value'] = $this->get_menu_detail_value( $highest_qualification, 'highest_qualification', 'menu', 'name' );

		$model_data['forward_emails'] = $forward_emails;
		$model_data['notify_technical_bulletin'] = $notify_technical_bulletin;
		$model_data['notify_case_file'] = $notify_case_file;
		$model_data['upload_filename'] = $user_photo;
		$model_data['cover_filename'] = $cover_photo;
		$model_data['email_address'] = $email_address;

		$user_photo = base_url( $uploads_folder.'/'.$user_photo );
		$cover_photo = base_url( $uploads_folder.'/'.$cover_photo );
		$model_data['user_photo'] = $user_photo;
		$model_data['cover_photo'] = $cover_photo;

		$model_data['upload_error'] = $this->session->flashdata( 'upload_error' );



		$user_photo = base_url( 'uploads/'.$user_photo );


		$decf_results = $document_model->count_document_per_type( $user_id, 'decf', 'F-DECF' );
		$basic_decf_results = $document_model->count_document_per_type( $user_id, 'decf', 'DECF' );
		$ofi_results = $document_model->count_document_per_type( $user_id, 'ofi' );
		$pp_results = $document_model->count_document_per_type( $user_id, 'project_plan' );
		$tb_results = $document_model->count_document_per_type( $user_id, 'technical_bulletin' );
		$ws_results = $document_model->count_document_per_type( $user_id, 'witness_statement' );
		$tq_results = $document_model->count_document_per_type( $user_id, 'technical_query' );
		//mcdr
		$mcdr_results = $document_model->count_document_per_type( $user_id, 'mcdr' );

		$erp_results = $document_model->count_document_per_type( $user_id, 'erp' );

		$model_data['decf_results'] = $decf_results;
		$model_data['basic_decf_results'] = $basic_decf_results;
		$model_data['ofi_results'] = $ofi_results;
		$model_data['pp_results'] = $pp_results;
		$model_data['tb_results'] = $tb_results;
		$model_data['ws_results'] = $ws_results;
		$model_data['tq_results'] = $tq_results;

		$model_data['erp_results'] = $erp_results;
		$model_data['mcdr_results'] = $mcdr_results;


		$preferred_equipment_categories = array();


		$equipment_categories = $user_model->get_main_menu( 'equipment_category' );

		foreach ( $equipment_categories as $category ) {
			$equipment_category_id = $category->menu_id;
			$equipment_category_name = $category->name;

			$notify = $user_model->get_value_multiple_var( 'user_id', 'menu_id', $user_id, $equipment_category_id, 'notify', 'user_preference' );

			$preferred_equipment_categories[] = array(
				'id' => $equipment_category_id,
				'name' => $equipment_category_name,
				'notify' => $notify
			);
		}

		$model_data['preferred_equipment_categories'] = $preferred_equipment_categories;


		$model_data['discipline_dropdown'] = $this->get_dropdown_menu( $discipline, 'discipline' );
		$model_data['position_dropdown'] = $this->get_dropdown_menu( $position, 'position' );
		$model_data['years_of_service_dropdown'] = $this->get_dropdown_menu( $years_of_service, 'years_of_service' );
		$model_data['area_of_operation_dropdown'] = $this->get_dropdown_menu( $area_of_operations, 'area_of_operation' );
		$model_data['highest_qualification_dropdown'] = $this->get_dropdown_menu( $highest_qualification, 'highest_qualification' );
		$model_data['asset_operation_dropdown'] = $this->get_dropdown_menu( $asset_operation, 'asset_type' );


		include('includes/document-count-snippet.php');
		$model_data = array_merge($model_data, $document_count);

		$header_data['current_page_name'] = "Settings";
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;
		$footer_data['modals'] = array('my-account-upload-modal', 'confirm-delete-modal', 'file-manager-modal');

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'user/settings', $model_data );
		$this->load->view( 'layout/footer', $footer_data );
	}

	public function file_list(){

		$data = $this->input->post();

		if($data){

			extract( $data, EXTR_SKIP );

			$this->is_logged_in();

			//var_dump($data);

			$user_model = $this->user_model;

			$user_id = $this->session->userdata( 'session' );
			$username = $this->session->userdata( 'session_user' );

			$files = $user_model->get_file_list($filename, $type, $order);

			$model_data['files'] = $files;

			$this->load->view('user/file-list',$model_data);
		}
	}

	public function upload() {

		$upload_config = $this->file_config;
		$this->load->library( 'upload', $upload_config );

		$data = $this->input->post();

		//var_dump($data);

		if ( $data ) {

			$user_model = $this->user_model;

			$user_id = $this->session->userdata( 'session' );

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

					$file_name_array = explode('.',$upload_data['file_name']);
					$name_with_no_extension = $file_name_array[0];
					$extension = strtolower($file_name_array[1]);
					$type = $this->get_file_type($upload_data['file_name']);

					$filenames[$i]['file_name'] = $upload_data['file_name'];
					$filenames[$i]['name'] = $name_with_no_extension;
					$filenames[$i]['extension'] = $extension;
					$filenames[$i]['type'] = $type;
					$check_file[$i]['checked'] = 1;
				}

			}

			//var_dump($filenames);


			foreach($filenames as $filename){
				$user_model->insert_file_item( $filename['file_name'], $filename['name'], $filename['extension'], $filename['type'], $user_id);
			}

			

			
			//$files = $document_model->get_files_master_action_tracker( $action_tracker_id, $subaction_tracker_id );

			//errors
			$error_message = '';
			if ( count( $errors )>0 ) {

				foreach ( $errors as $error ) {
					if ( $error['filename'] ) {
						$error_message = '<p>'.$error_message.' &nbsp; '.$error['filename'].' - '.$error['error'].'</p>';
					}
				}

			}

			

			$main_array = array(
				'errors' => $error_message,
				'file_check' => $check_file
			);

			echo json_encode( $main_array );
			//var_dump($data);
		}
	}

	public function remove_file(){

		$data = $this->input->post();

		if($data){

			$user_model = $this->user_model;

			$user_id = $this->session->userdata( 'session' );

			extract( $data, EXTR_SKIP );

			//delete from directory
			$uploads_folder = $this->uploads_folder;
    		$absolute_path = FCPATH.$uploads_folder."\\";
    		unlink( $absolute_path.$file_name );

    		//delete from database
			$user_model->delete_file_item($file_id);

		}
	}

	public function edit_file_name(){

		$data = $this->input->post();

		if($data){

			extract($data, EXTR_SKIP);

			$user_model = $this->user_model;

			$name_array = explode('.',$file_name);
			$new_save_name = $new_file_name.'.'.$name_array[1];

			if($file_name != $new_save_name){
				$user_model->update_file_item_name( $file_id, $new_file_name, $name_array[1] );
				rename(FCPATH.'uploads/'.$file_name, FCPATH.'uploads/'.$new_save_name);

				echo 'success';
			}else{
				echo 'failed to rename';
			}
		}

		

		//echo FCPATH.'uploads/1';
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
