<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class MY_Controller extends CI_Controller {

  protected $general_validation_rules = "trim|xss_clean";
  protected $file_config = array();
  protected $controller_uri;
  protected $user_model;
  protected $main_model;
  protected $document_model;
  protected $uploads_folder = 'uploads';
  protected $document_code;
  protected $document_primary;
  protected $form_primary;
  protected $no_of_steps;
  protected $databases = array();
  protected $document_variables = array();
  protected $step_titles = array();

  protected $parent_name;
  protected $parent_uri;
  protected $current_name;
  protected $current_uri;

  protected $controller;
  protected $method;

  public function __construct() {

    parent::__construct();

    //ini_set('date.timezone', 'Europe/London');
    //echo ini_get('date.timezone');

    $this->controller_uri = generate_slug( $this->uri->segment( 1, 0 ) );
    $uploads_folder = $this->uploads_folder;

    $this->file_config = array(
      'upload_path' => './'.$uploads_folder.'/',
      'allowed_types' => 'gif|jpg|png|bmp|pdf|docx|doc|odt|mp4|flv|wmv|mvp|jpeg|txt|xls|xlsx',
      'max_size' => 100048
    );

    $this->load->model( 'User_Model' );
    $this->user_model = new User_Model();

    $controller = $this->uri->segment( 1, 0 );
    $method = $this->uri->segment( 2, 0 );

    $this->controller = $controller;
    $this->method = $method;

    
  }


  public function create_user(){

    $data = $this->input->post();

    if($data){

      extract( $data, EXTR_SKIP );
      
      $main_model = $this->main_model;
      $user_model = $this->user_model;
      $user_type = $this->user_type;
      $user_title = $this->user_title;

      $this->load->library( 'form_validation' );

      $this->form_validation->set_error_delimiters('','');
      $this->form_validation->set_message( 'is_unique', 'failed' );
      $this->form_validation->set_message( 'matches', 'failed' );

      //min_length[4]
      //required

      $this->form_validation->set_rules( 'username', 'Username', 'is_unique[tbl_user.username]' );
      $this->form_validation->set_rules( 'password', 'Password', 'trim|matches[confirm_password]' );
      //$this->form_validation->set_rules( 'confirm_password', 'Password Confirmation', 'trim|required' );
      //$this->form_validation->set_rules( 'email_address', 'Email', 'required|valid_email|is_unique[user.email_address]' );

      if ( $this->form_validation->run() ) {

        $user_id = $user_model->create_user($username, $password, $firstname, $lastname, $age, $gender, $address, $user_type);
        $success_message = $user_title." was added successfully. ";

        if($user_id){
          
          $json_result = array(
              'user_id' => $user_id,
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
    $user_model = $this->user_model;
    $user_type = $this->user_type;
    $controller = $this->controller;

    $results = $user_model->get_user_by_type($user_type);

    $model_data = array(
        'results' => $results
      );

    $this->load->view($controller.'/list', $model_data);
  }

  public function search_list(){

    $main_model = $this->main_model;
    $user_model = $this->user_model;
    $user_type = $this->user_type;
    $controller = $this->controller;

    $search_key = $this->input->get('search');

    $results = $user_model->search_list($search_key, $user_type);

    $model_data = array(
        'results' => $results
      );

    $this->load->view($controller.'/list', $model_data);
  }

  public function school_year_dropdown(){

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

  public function user_dropdown($new_user_type = null){

    $user_model = $this->user_model;

    if(isset($user_type) && $user_type != null){
      $user_type = $this->user_type;
    }else{
      $user_type = $new_user_type;
    }
    

    if(empty($user_type)){
      $user_type = 1;
    }

    $results = $user_model->get_users_by_type($user_type);

    $option = "";

    foreach($results as $result){

      $user_id = $result->user_id;
      $firstname = $result->fname;
      $middlename = $result->mname;
      $lastname = $result->lname;

      $fullname = $firstname .' '. $middlename .' '. $lastname;

      $option .= '<option value="'.$user_id.'">'.$fullname.'</option>';
    }

    return $option;
  }

  public function grade_level_dropdown($sy_start = null, $sy_end = null){

    $option = "";

    if($sy_start === null && $sy_end === null){

      for($i=1;$i<=4;$i++){
        $option .= '<option value="'.$i.'">'.$i.'</option>';
      }

    }else{

      $this->load->model('Curiculum_Model');
        $main_model = new Curiculum_Model;

        $results = $main_model->get_available_year_level_by_school_year($sy_start, $sy_end);

        foreach($results as $result){

          $grade_level_id = $result->gl_id;
          $grade_level = $result->grade_level;
          $sy_start = $result->sy_start;
          $sy_end = $result->sy_end;

          $option .= '<option value="'.$grade_level_id.'">'.$grade_level.'</option>';
        }

    }

      

      return $option;
  }

  public function is_logged_in($redirect = true) {

    $logged_in = $this->session->userdata( 'is_logged_in' );
    $user = $this->session->userdata( 'session' );

    if($redirect){
      if ( !$logged_in ) {
        redirect( 'user/login' );
      }
    }else{
      if( !$logged_in ){
        return false;
      }else{
        return true;
      }
    }
  }

  public function _is_not_id( $id, $redirect_link = 'user/my-account' ) {
    if ( !is_numeric( $id ) ) {
      redirect( $redirect_link );
    }
  }

  public function basic_send_mail( $to, $subject, $message, $mailtype = 'text'){
    $this->send_mail( $to, $subject, $message, 'no-reply@iso14224.com', 'ISO 14224 Administrator', null, null, $mailtype);
  }

  public function send_mail( $to, $subject, $message, $from = 'no-reply@iso14224.com', $from_name = 'ISO 14224 Administrator', $salutation = null, $closing = null, $mailtype = 'text' ) {

    $send_message = '';

    $this->load->library( 'email' );

    $config['mailtype'] = $mailtype;

    $this->email->initialize( $config );

    $this->email->from( $from, $from_name );
    $this->email->to( $to );

    $this->email->subject( $subject );

    if ( $salutation != null ) {
      $send_message = message_salutation();
    }

    $send_message .= $message;

    if ( $closing != null ) {
      $send_message .= message_closing();
    }

    $this->email->message( $send_message );

    $sent = $this->email->send();

    //echo $this->email->print_debugger();
    return $sent;
  }

}