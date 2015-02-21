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


  public function user_dropdown(){

    $user_model = $this->user_model;
    $user_type = $this->user_type;

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

  public function get_dropdown( $table_name, $column_name, $default_value, $key_value = true, $step = 0 ) {

    $this->load->model( 'CaseFile_Model' );
    $main_model = new CaseFile_Model();

    $result = array();

    $result = $main_model->get_key_value( $table_name, $column_name, $key_value );

    $options = get_key_value_dropdown( $result, $default_value, $key_value );

    return $options;
  }

  public function get_dropdown_menu_async( $menu_type, $default_value = null, $menu_level = "menu", $no_default = false, $default_select_value = '- Select -', $visibility_level = null ) {

    echo $this->get_dropdown_menu( $default_value, $menu_type, $menu_level, true, $no_default, $default_select_value, $visibility_level );
  }

  public function get_simple_dropdown_menu( $menu_type, $default_select_value = null, $default_value = null ) {

    return $this->get_dropdown_menu( $default_value, $menu_type, 'menu', true, false, $default_select_value, null );
  }

  public function get_dropdown_menu( $default_value, $menu_type, $menu_level = "menu", $key_value = true, $no_default = false, $default_select_value = '- Select -', $visibility_level = null ) {

    $this->load->model( 'Casefile_Model' );
    $main_model = new Casefile_Model();

    $result = array();

    $result = $main_model->get_main_menu( $menu_type, $menu_level, $visibility_level );

    $menu_key_result = menu_key_value( $result, $menu_level, $key_value );

    $options = get_key_value_dropdown_properties( $menu_key_result, $default_value, $key_value, $no_default, $default_select_value );



    return $options;
  }

  public function get_all_subcategories_dropdown($default_value, $menu_type, $key_value = true, $no_default = false, $default_select_value = '- Select -'){

    $this->load->model( 'Casefile_Model' );
    $main_model = new Casefile_Model();

    $result = array();

    $result = $main_model->get_all_subcategories( $menu_type );

    $menu_key_result = menu_key_value( $result, 'subcategory', $key_value );

    $options = get_key_value_dropdown_properties( $menu_key_result, $default_value, $key_value, $no_default, $default_select_value );

    return $options;

  }

  public function get_user_dropdown( $default_select = '&nbsp;', $action_tracker = false, $default_select_id = null ) {

    $this->load->model( 'User_Model' );
    $user_model = new User_Model();

    $results = $user_model->get_all_records();

    if ( !empty( $default_select_id ) ) {
      $option = '<option value="'.$default_select_id.'">'.$default_select.'</option>';
    }else {
      $option = '<option value="">'.$default_select.'</option>';
    }


    if ( $action_tracker != false ) {
      foreach ( $results as $result ) {
        $first_name = $result->first_name;
        $fname = explode( " ", $first_name );
        $short_name = '';

        foreach ( $fname as $name ) {
          $short_name .= substr( $name, 0, 1 ) .'. ';
        }

        $fullname = $short_name . $result->last_name;
        $id = $result->user_id;
        $option .= '<option value="'.$id.'">'.$fullname.'</option>';
      }
    }
    else {

      foreach ( $results as $result ) {
        $fullname = $result->first_name.' '.$result->last_name;
        $id = $result->user_id;
        $option .= '<option value="'.$id.'">'.$fullname.'</option>';
      }
    }

    return $option;
  }

  public function get_dropdown_subcategory( $menu_id, $menu_type, $menu_subcategory_id = '', $visibility_level = null, $select_value = '- Select -' ) {

    $this->load->model( 'CaseFile_Model' );
    $main_model = new CaseFile_Model();

    $result = array();

    if ( $menu_id == 0 || $menu_id == null ) {

      $options = '<option value="" class="bg-white">- Select from Main Category -</option>';

    }else {

      //$options = '<option value="">- Select -</option>';
      $options = '';

      $result = $main_model->get_menu_subcategory( $menu_id, $menu_type, $visibility_level );

      $key_value_result = menu_key_value( $result, 'subcategory' );

      $options .= get_key_value_dropdown_properties( $key_value_result, $menu_subcategory_id, true, false, $select_value );

    }

    return $options;
  }

  public function get_dropdown_deep_subcategory( $menu_subcategory_id, $menu_type, $menu_deep_subcategory_id = '', $visibility_level = null ) {

    $this->load->model( 'CaseFile_Model' );
    $main_model = new CaseFile_Model();

    $result = array();

    if ( $menu_subcategory_id == 0 || $menu_subcategory_id == null ) {

      $options = '<option value="" class="bg-white">- Select from Main Category -</option>';

    }else {

      //$options = '<option value="">- Select -</option>';
      $options = '';

      $result = $main_model->get_menu_deep_subcategory( $menu_subcategory_id, $menu_type, $visibility_level );

      $key_value_result = menu_key_value( $result, 'deep_subcategory' );

      $options .= get_key_value_dropdown_properties( $key_value_result, $menu_deep_subcategory_id );

    }

    return $options;
  }

  public function get_menu_detail_value( $id, $menu_type, $menu_level, $menu_detail ) {

    $this->load->model( 'CaseFile_Model' );
    $main_model = new CaseFile_Model();

    $result = array();

    if ( $id == 0 || $id == null ) {

      $value = '';

    }else {

      $value = $main_model->get_menu_value( $id, $menu_type, $menu_level, $menu_detail );

    }

    if ( empty( $value ) ) {
      return '';
    }else {
      return $value;
    }
  }

  public function _validate_upload_error( $error, $upload_error_name, $redirect_link ) {

    $update_flag = false;
    $error_flag = false;


    if ( $error == 'You did not select a file to upload.' ) {
      $update_flag = true;
    }else if ( $error == 'The filetype you are attempting to upload is not allowed.You did not select a file to upload.' ) {
        $error = 'The filetype you are attempting to upload is not allowed';
        $error_flag = false;
      }else if ( $error == 'The filetype you are attempting to upload is not allowed.' ) {
        $error = 'The filetype you are attempting to upload is not allowed';
        $error_flag = true;
      }

    echo $error;


    if ( $error_flag ) {
      $this->session->set_flashdata( $upload_error_name, $error );
      redirect( $redirect_link );
    }



    return $update_flag;
  }

  public function complete_form_message( $form_name, $code, $name, $controller = null, $id = null, $notify_follower = false, $follower_name = "" ) {


    if ( $notify_follower ) {
      $message =  "Hi,\n\n";
      $message .= "Please find attached ".$form_name." from iso14224.com regarding [".$code."]-[".$name."] that may be of interest to you. \n\n";
      $message .= "You can view and rate this here: ". base_url( $controller.'/view/'.$id.'/rank' );
      $message .= "\n\n";
      $message .= "Thanks for your time.";
    }else {
      $message =  "Hi,\n\n";
      $message .= "You have just uploaded your completed ".$form_name." with a code and name of [".$code."]-[".$name."] and now the ISO14224 community can also benefit from your work.\n\n";
      $message .= "Many thanks for taking the time to share your knowledge and experience. Somebody, somewhere is going to have an easier day today because of you. \n\n";

      $message .= "Fair play to you.\n\n";

      $message .= "Thanks,\n\n";
      $message .= "ISO14224 Team";
    }



    return $message;
  }

  public function document_status_message( $form_name, $code, $user_full_name, $author_full_name, $document_status_value, $controller = null, $id = null ) {

    if ( $document_status_value == 'ready for review' ) {
      $status_message = "reviewed";
    }else if ( $document_status_value == 'reviewed' ) {
        $status_message = "approved or published";
      }else if ( stripos( $document_status_value, 'approved' ) !== false ) {
        $status_message = "published";
      }else if ( $document_status_value == 'published' ) {
        $status_message = "published";
      }else{
        $status_message = $document_status_value;
      }


    if ( !empty( $form_name ) || $form_name != '' ) {

    }else {
      $form_name = "document";
    }




    $message =  "Hi ".$user_full_name.",\n\n";

    if ( $document_status_value == 'published' ) {
      $message .= "We are pleased to inform you that ".$author_full_name." has published ".$form_name." with code ".$code." \n\n";
    }else {
      $message .= "We are pleased to inform you that ".$author_full_name." has completed ".$form_name." with code ".$code." and request that you review this and if you are happy with the contents change the status to ".$status_message.". \n\n";
    }

    $message .= "You will find the form here: ". base_url( $controller.'/edit/'.$id );
    $message .= "\n\n";
    $message .= "Kind Regards, \n";
    $message .= "iso14224 team";

    return $message;
  }

  public function message_salutation( $greeting = 'Good Day', $name = '' ) {

    $message =  $greeting . " " . $name . ",\n\n";

    return $message;
  }

  public function message_closing( $greeting = 'Regards', $name = "ISO14224 Team" ) {

    $message .= $greeting . ",\n\n";
    $message .= $name;

    return $message;
  }

  public function get_subcategory() {

    $id = $this->input->post( 'id' );
    $menu_type = $this->input->post( 'menu_type' );

    if ( $id ) {

      $options = $this->get_dropdown_subcategory( $id, $menu_type );

      echo $options;

    }
  }

  public function get_deep_subcategory() {

    $id = $this->input->post( 'id' );
    $menu_type = $this->input->post( 'menu_type' );

    if ( $id ) {

      $options = $this->get_dropdown_deep_subcategory( $id, $menu_type );

      echo $options;

    }
  }

  public function get_menu_details() {

    $id = $this->input->post( 'id' );
    $menu_type = $this->input->post( 'menu_type' );
    $menu_level = $this->input->post( 'menu_level' );
    $menu_detail = $this->input->post( 'menu_detail' );

    if ( $id ) {

      $options = $this->get_menu_detail_value( $id, $menu_type, $menu_level, $menu_detail );

      echo $options;

    }
  }

  public function unlink_file( $destroy = true ) {

    $uploads_folder = $this->uploads_folder;

    $absolute_path = FCPATH.$uploads_folder."\\";

    $id = $this->input->post( 'id' );
    $table_name = $this->input->post( 'table' );
    $file_name = $this->input->post( 'file_name' );

    unlink( $absolute_path.$file_name );

    $this->load->model( 'Document_Model' );
    $main_model = new Document_Model();

    if ( $destroy ) {
      $main_model->delete_value( $id, $table_name, 'file_id' );
    }else {
      //$main_model->update_value($id, 'filename', '', $table_name);
      //$main_model->update_value($id, 'file_path', '', $table_name);
    }
  }

  public function multiple_unlink_file( $destroy = true, $id, $action_tracker_id = false, $subaction_tracker_id = false ) {

    $uploads_folder = $this->uploads_folder;

    $absolute_path = FCPATH.$uploads_folder."\\";
    unlink( $absolute_path.$file_name );

    $this->load->model( 'Document_Model' );
    $main_model = new Document_Model();

    if ( $action_tracker_id == true ) {
      $files = $main_model->get_files_master_action_tracker( $id, null );
      $main_model->delete_value( $id, 'file', 'action_tracker_id' );
    }
    elseif ( $subaction_tracker_id == true ) {
      $files = $main_model->get_files_master_action_tracker( null, $id );
      $main_model->delete_value( $id, 'file', 'subaction_tracker_id' );
    }

    foreach ( $files as $file ) {
      unlink( $absolute_path.$file->filename );
    }
  }

  public function get_dynamic_row() {

    $form_id = $this->input->post( 'form_id' );
    $model_id = $this->input->post( 'model_id' );
    $current_step = $this->input->post( 'current_step' );
    $table_name = $this->input->post( 'table_name' );
    $view_name = $this->input->post( 'view_name' );
    $controller_name = $this->input->post( 'controller_name' );

    if ( $model_id ) {



      $main_model = $this->main_model;

      $code = $main_model->get_value( $form_id, 'code' );

      $main_details = $main_model->get_record_subcategory( $model_id, $table_name, 'step_id', '*', true, $code, $current_step, false, true );

      $data = array(
        'main_details' => $main_details
      );


      $this->$controller_name( $view_name, $data );





    }
  }

  public function add_row() {

    $id = $this->input->post( 'id' );
    $step_no = $this->input->post( 'current_step' );
    $step_id = $this->input->post( 'model_id' );
    $db_table = $this->input->post( 'table_name' );
    $count = $this->input->post( 'row_count' );
    $db_primary = $this->input->post( 'db_primary' );

    if ( $id ) {

      $main_model = $this->main_model;

      if ( $step_no === null || $step_no == 'null' || $step_no == null ) {
        $last_insert_id = $main_model->create_empty_sub_table( $id, $db_table, $count, $db_primary );
      }else {
        $last_insert_id = $main_model->create_empty_sub_table_step( $id, $db_table, $count, $db_primary, $step_no );
      }

      echo $last_insert_id;

    }
  }

  public function remove_row() {

    $id = $this->input->post( 'id' );
    $step_no = $this->input->post( 'current_step' );
    $step_id = $this->input->post( 'model_id' );
    $db_table = $this->input->post( 'table_name' );
    $count = $this->input->post( 'row_count' );
    $db_primary = $this->input->post( 'db_primary' );

    $last_row = true;

    if ( $id ) {

      $main_model = $this->main_model;

      if ( $step_no === null || $step_no == 'null' || $step_no == null ) {
        $main_model->delete_sub_table( $id, $db_table, $count, $db_primary, $last_row );
      }else {
        $main_model->delete_sub_table_step( $id, $db_table, $count, $db_primary, $step_no );
      }


    }
  }

  public function hash( $string ) {
    return hash( 'sha512', $string . config_item( 'encryption_key' ) );
  }

  public function rank_document( $id ) {

    $this->load->model( 'DocumentRanking_Model' );
    $document_ranking_model = new DocumentRanking_Model();

    $current_user_id = $this->session->userdata( 'session' );

    if ( $current_user_id ) {

      $documents = $document_ranking_model->get_document_ranking( $id, $current_user_id );

      //var_dump($documents);

      if ( empty( $documents ) ) {
        $document_rank_id = $document_ranking_model->create_document_ranking( $id, $current_user_id );
        $documents = $document_ranking_model->get_record_by_column_value( 'document_ranking_id', $document_rank_id, '*', 'document_ranking' );
      }

    }else {
      $document_rank_id = $document_ranking_model->create_document_ranking( $id, null );
      $documents = $document_ranking_model->get_record_by_column_value( 'document_ranking_id', $document_rank_id, '*', 'document_ranking' );
    }

    return $documents;
  }

  public function get_recent_documents() {

    $this->load->model( 'Document_Model' );

    $document_model = new Document_Model();

    $this->load->model( 'CaseFile_Model' );
    $this->load->model( 'TB_Model' );
    $this->load->model( 'ERP_Model' );
    $this->load->model( 'OFI_Model' );
    $this->load->model( 'PP_Model' );
    $this->load->model( 'WitnessStatement_Model' );

    $casefile_model = new CaseFile_Model();
    $technicalbulletin_model = new TB_Model();
    $erp_model = new ERP_Model();
    $ofi_model = new OFI_Model();
    $pp_model = new PP_Model();
    $witness_statement_model = new WitnessStatement_Model();

    $current_user_id = $this->session->userdata( 'session' );

    $results = $document_model->get_recent_documents( $current_user_id, 6 );

    $recent_documents = array();

    foreach ( $results as $result ) {

      $document_id = $result->document_id;
      $code = $result->code;
      $document_type = $result->document_code;
      $name = $result->name;

      $document = array(
        'id' => $document_id,
        'code' => $code,
        'document_type' => $document_type,
        'name' => truncate( $name, 25 )
      );

      $recent_documents[] = $document;


    }

    return $recent_documents;
  }

  public function _generate() {

    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $document_model->generate();
  }

  public function get_consequence_description() {

    $area_impact = $this->input->post( 'area_impact' );
    $priority_value = $this->input->post( 'priority_value' );

    if ( $area_impact ) {
      $this->load->model( 'Casefile_Model' );
      $main_model = new Casefile_Model();

      $result = $main_model->get_value_multiple_var( 'area_of_impact_id', 'consequence_id', $area_impact, $priority_value, 'description', 'area_of_impact_consequence' );


      echo $result;
    }
  }

  public function save_document_redirect( $form_id, $model_id, $no_of_steps, $current_step, $link_to ) {

    $main_model = $this->main_model;

    $main_model->update_value( $form_id, 'step_'.$current_step.'_completed', '1' );
    $main_model->get_form_status( $form_id, $model_id, $no_of_steps );

    # Log -----------------------------------------------------------------------------
    $this->load->model('Document_Tracker_Model');
    $document_tracker_model = new Document_Tracker_Model();

    $user_id = $this->session->userdata('session');
    $action = '<span class="text-info">Modified</span> Document';
    $document_name = $document_tracker_model->get_name_by_id($model_id);

    $document_tracker_model->add_action_track($user_id, $action.' '.$document_name);
    # end of Log -----------------------------------------------------------------------

    $this->redirect_form( $model_id, $current_step, $link_to );
  }

  public function update_document_status() {

    $data = $this->input->post();

    if ( $data ) {

      $extracted_data = extract( $data, EXTR_SKIP );

      /*echo '<pre>';
      var_dump($data);
      echo '</pre>';*/

      $this->load->model( 'Document_Model' );
      $document_model = new Document_Model();

      $current_date = convert_string_to_date();

      if ( !isset( $from_status_window ) ) {
        $from_status_window = false;
      }

      if ( $from_status_window ) {
        $document_status = $update_document_status;
        $reviewed_by = $current_user_id;
        $approved_by = $current_user_id;
        $published_by = $current_user_id;
        $reviewed_date = null;
        $approved_date = null;
        $published_date = null;
        $model_id = $update_document_id;
      }

      $document_status_value_raw = $document_status_value;

      $document_status_value = strtolower( $document_status_value );

      switch ( $document_status_value ) {

        //strtolower
      case 'reviewed':
        $reviewed_date = convert_string_to_date( $reviewed_date );
        $document_model->update_review_status( $model_id, $document_status, $reviewed_by, $reviewed_date );
        $document_model->new_document_status( $model_id, $document_status, $reviewed_by, $reviewed_date );
        break;
      case 'approved':
      case 'approved by asset management stage gate 1 (approach)':
      case 'approved by phase team Stage gate 2 (design)':
      case 'approved by offshore liaison stage gate 3 (specification)':
      case 'approved by maintenance superintendent stage gate 4 (engineering change)':
      case 'approved by asset management stage gate 5 (construct)':
        $approved_date = convert_string_to_date( $approved_date );
        $document_model->update_approve_status( $model_id, $document_status, $approved_by, $approved_date );
        $document_model->new_document_status( $model_id, $document_status, $approved_by, $approved_date );
        break;
      case 'published':
        $published_date = convert_string_to_date( $published_date );
        $document_model->update_publish_status( $model_id, $document_status, $published_by, $published_date );
        $document_model->new_document_status( $model_id, $document_status, $published_by, $published_date );
        break;
      default:
        $document_model->update_document_status( $model_id, $document_status );
        $document_model->new_document_status( $model_id, $document_status, $current_user_id, $current_date );
        break;

      }



      $this->notify_owner_review_documents( $model_id, $current_user_id, $document_status_value );
      $followers = $document_model->get_document_followers($model_id);

      $document_owner_id = $document_model->get_document_owner_id($model_id, $current_user_id);

      $title = "Document Status Change";
      $description = $document_status_value_raw;

      $this->new_document_update($model_id, $document_owner_id, $title, $description);
      $this->notify_document_followers($followers, $title, $description);

    }
  }

  public function notify_document_followers($followers, $title, $description){

    foreach($followers as $follower){

      $document_follower_id = $follower->document_follower_id;
      $document_id = $follower->document_id;
      $user_id = $follower->user_id;
      $first_name = $follower->first_name;
      $last_name = $follower->last_name;
      $email_address = $follower->email_address;
      $document_name = $follower->name;
      $code = $follower->code;
      $document_type = $follower->document_code;

      $user_full_name = $first_name .' '. $last_name;

      if($document_name != null && $document_name != ''){
        $document_name_message = "named " . $document_name . " ";
      }else{
        $document_name_message = " ";
      }

      $subject = "Document ".$code." Update";

      $message =  "Hi ".$user_full_name.",\n\n";

      $message .= "We would like to inform you that the document " . $document_name_message . "with code of " . $code . " ";
      $message .= "has been updated.\n\n";
      $message .= $title ."\n";
      $message .= $description ."\n\n";
      $message .= "You can view updates page by going to this link: " . base_url($document_type.'/updates/'.$document_id);
      
      $this->send_mail( $email_address, $subject, $message );

    }
  }

  public function update_document(){

    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $user_id = $this->session->userdata('session');

    $document_id = $this->input->post('document_id');
    $title = $this->input->post('title');
    $description = $this->input->post('description');

    $document_owner_id = $document_model->get_document_owner_id($document_id, $user_id);

    $this->new_document_update($document_id, $document_owner_id, $title, $description);

    $followers = $document_model->get_document_followers($document_id);

    $this->notify_document_followers($followers, $title, $description);
  }

  public function new_document_update($document_id, $document_owner_id, $title, $description){

    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $document_model->update_document($document_id, $document_owner_id, $title, $description);
  }

  public function compensate_equipment_history_answer( $question_id ) {

    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $documents = $document_model->get_all_records();

    foreach ( $documents as $document ) {
      $document_id = $document->document_id;
      $document_model->create_specific_equipment_history_answer( $document_id, $question_id );
    }
  }

  //site_url/user/compensate_equipment_history_answer/38

  public function compensate_equipment_history_category_answer() {

    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $documents = $document_model->get_all_documents_empty_equipment_history();

    foreach ( $documents as $document ) {
      $document_id = $document->document_id;
      $document_model->create_empty_equipment_history_answer( $document_id );
    }
  }

  public function compensate_table( $table_name, $id_name = 'document_id' ) {
    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $number_of_documents = $document_model->check_doc_with_no_subtable( $table_name, $id_name );

    foreach ( $number_of_documents as $item ) {
      $document_id = $item->document_id;
      $document_model->create_empty_sub_table( $document_id, $table_name );
    }
  }

  public function document_status_to_in_progress() {
    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $number_of_documents = $document_model->check_doc_with_null_status();

    foreach ( $number_of_documents as $item ) {
      $document_id = $item->document_id;
      $document_model->add_document_status( $document_id );
    }
    $message = 'Finished updating document status with null values';

    echo $message;
  }

  public function notify_owner_review_documents( $document_id, $current_user_id, $document_status_value ) {

    $this->load->model( 'Document_Model' );
    $this->load->model( 'User_Model' );

    $document_model = new Document_Model();
    $user_model = new User_Model();

    $owners = $document_model->get_document_owners( $document_id, 'all_not_empty' );
    $document_details = $document_model->get_document( $document_id );

    $current_user_full_name = $user_model->get_full_name( $current_user_id );

    var_dump($document_details);

    $controller = $document_details->document_code;
    $document_id = $document_details->document_id;
    $form_name = $document_details->name;
    $code = $document_details->code;

    $subject = "Document Status Update";

    //var_dump($owners);


    foreach ( $owners as $owner ) {

      $owner_id = $owner->user_id;
      $owner_first_name = $owner->first_name;
      $owner_last_name = $owner->last_name;
      $owner_full_name = $owner_first_name.' '.$owner_last_name;
      $owner_email_address = $owner->email_address;

      $message = $this->document_status_message( $form_name, $code, $owner_full_name, $current_user_full_name, $document_status_value, $controller, $document_id );



      //if($owner_id != $current_user_id){
      $this->send_mail( $owner_email_address, $subject, $message );
      //}

    }
  }

  public function get_user_form() {

    $data = $this->input->post();
    $json_array = array();

    if ( $data ) {

      $cust_id = $this->session->userdata('session');
      $table_document_code = $this->input->post( 'table_document_code' );

      if ( $table_document_code == '' ) {
        $table_document_code = null;
      }

      $this->load->model( 'DocumentRanking_Model' );
      $document_ranking_model = new DocumentRanking_Model();
      $main_model = $this->main_model;


      $results = $main_model->get_user_form( $cust_id, $table_document_code );

      



      foreach ( $results as $result ) {
        $temp_array = array();

        $document_type = $result->document_code;
        $document_completed = $result->document_completed;
        $document_id = $result->document_id;

        $no_of_likes = $document_ranking_model->get_likes( $document_id );

        $document_name = $result->document_name;
        $document_status = $result->document_status;

        $document_status_dropdown = $this->get_dropdown_menu( $document_status, 'document_status' );



        $view_link = base_url( $document_type.'/view/'.$document_id );
        $edit_link = base_url( $document_type.'/edit/'.$document_id );
        $delete_link = base_url( $document_type.'/delete/'.$document_id );
        $duplicate_link = base_url( $document_type.'/duplicate/'.$document_id );
        $view_comments = base_url( '/user/view-comments/'.$document_id );

        if ( $document_completed == '1' ) {
          $viewable = 'Yes';
        }else {
          $viewable = 'No';

        }

        if ( $document_name == '' ) {
          $document_name = ' ';
        }

        $temp_array['document_id'] = $document_id;

        $temp_array['document_code'] = $result->code;

        //level 1 and level 2 description
        if ( strlen( $result->code ) > 5 ) {
          if ( substr( $result->code, 0, 5 ) == 'DECF' ) {
            $temp_array['document_name'] = 'Level 1 : '.$document_name;
          }
          elseif ( substr( $result->code, 0, 5 ) == 'F-DECF-' ) {
            $temp_array['document_name'] = 'Level 2 : '.$document_name;
          }
          else {
            $temp_array['document_name'] = $document_name;
          }
        }
        else {
          $temp_array['document_name'] = $document_name;
        }

        $temp_array['document_name'] = truncate( $temp_array['document_name'], 30 );

        $temp_array['document_status_value'] = $result->name;
        $temp_array['update_status'] = '<select class="form-control" name="document_status" required>
                       '.$document_status_dropdown.'
                    </select>';

        $temp_array['document_completed'] = $document_completed;
        $temp_array['viewable'] = $viewable;
        $temp_array['action'] = '<a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Review or Print Report" href="'.$view_link.'"><span class="glyphicon glyphicon-list"></span></a>
                  <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.$edit_link.'"><span class="glyphicon glyphicon-pencil"></span></a>
                  <a class="btn btn-danger delete-form" data-toggle="tooltip" data-placement="top" title="Delete" href="'.$delete_link.'"><span class="glyphicon glyphicon-trash"></span></a>
                  <a class="btn btn-primary duplicate-btn" data-toggle="tooltip" data-placement="top" title="Duplicate" href="'.$duplicate_link.'"><i class="fa fa-copy"></i></a>
                  <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Comments" href="'.$view_comments.'"><span class="glyphicon glyphicon-comment"></span></a>';

        //$temp_array['update'] = '<button id="update-document-status-window" type="submit" name="update_status" class="btn btn-info btn-block"><span class="glyphicon glyphicon-flag"></span> Update Status</button>';
        $temp_array['update'] = '<button id="update-document-status-window" type="submit" name="update_status" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Update Status"><span class="glyphicon glyphicon-flag"></span></button>
        <a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Review or Print Report" href="'.$view_link.'"><span class="glyphicon glyphicon-list"></span></a>
                  <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="'.$edit_link.'"><span class="glyphicon glyphicon-pencil"></span></a>';
        $temp_array['view'] = $view_link;
        $temp_array['edit'] = $edit_link;
        $temp_array['delete'] = $delete_link;
        $temp_array['duplicate'] = $duplicate_link;
        $temp_array['view-comments'] = $view_comments;
        $temp_array['no_of_likes'] = $no_of_likes;

        $json_array[] = $temp_array;
      }

      echo json_encode( $json_array );


    }
  }

  public function update_costbreakdown_fields() {

    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $data = $this->input->post();

    if ( $data ) {

      extract( $data, EXTR_SKIP );

      $update = $document_model->update_costbreakdown_fields( $model_id );

      echo json_encode( $update );

    }
  }

  public function get_menu_id_by_value() {
    $this->load->model( 'CaseFile_Model' );
    $main_model = new CaseFile_Model();

    $data = $this->input->post();

    if ( $data ) {

      extract( $data, EXTR_SKIP );

      $result = $this->get_menu_id_by_value( $value, $menu_type, $menu_level );

      echo json_encode( $result );

    }
  }


  public function get_menu_id_by_code($code, $menu_type, $menu_level = "menu"){

    $this->load->model( 'CaseFile_Model' );
    $main_model = new CaseFile_Model();

    $id = $main_model->get_menu_id_by_code($code, $menu_type, $menu_level);

    return $id;

  }


  /*public function get_menu_id_by_code($code, $menu_type, $menu_level = 'menu') {
    $this->load->model( 'CaseFile_Model' );
    $main_model = new CaseFile_Model();

    $data = $this->input->post();

    if ( $data ) {

      extract( $data, EXTR_SKIP );

      $result = $this->get_menu_id_by_code( $code, $menu_type, $menu_level );

      echo json_encode( $result );

    }
  }*/

  public function notify_owner_action_tracker( $action_tracker_id, $previous_owner, $action_type = 'action' ) {

    if($action_type == 'action'){
      $subaction_type = 0;
    }else{
      $subaction_type = 1; 
    }

    $notify = false;

    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $user_model = $this->user_model;
    $current_user_id = $this->session->userdata( 'session' );

    $sent_owners = array();

    $subject = 'ISO14224 - Action Allocated';

    $notification_sent = $document_model->get_value( $action_tracker_id, 'notification_status', 'action_tracker', 'action_tracker_id' );

    if($action_type == 'subaction'){
      $owner_id = $document_model->get_value( $action_tracker_id, 'subaction_owner', 'subaction_tracker', 'subaction_tracker_id' );
    }else{
      $owner_id = $document_model->get_value( $action_tracker_id, 'owner', 'action_tracker', 'action_tracker_id' );
    }
    

    $previous_data = array(
      'notification_sent' => $notification_sent,
      'owner_id' => $previous_owner,
      'previous_owner' => $owner_id
    );


    if($notification_sent != 1){
      $notify = true;
      $previous_data['notification_not_one'] = $notify;
    }

    if($owner_id != null && $owner_id != ''){
      if($owner_id != $previous_owner){
        $notify = true;
        $previous_data['owner_not_equal'] = $notify;
      }
    }
    


    if($notify){

      $author = $user_model->get_full_name($current_user_id);

      if($action_type == 'subaction'){
        $action_tracker_details = $document_model->get_record_by_column_value('subaction_tracker_id', $action_tracker_id, "*", 'subaction_tracker');
        $due_date = convert_date_to_string($action_tracker_details->subaction_due_date, true);
        //$author_id = $action_tracker_details->subaction_owner;
        //$author = $user_model->get_full_name($author_id);
        $action = $action_tracker_details->subaction_process_step;
      }else{
        $action_tracker_details = $document_model->get_record_by_column_value('action_tracker_id', $action_tracker_id, "*", 'action_tracker');
        $due_date = convert_date_to_string($action_tracker_details->due_date, true);
        //$author_id = $action_tracker_details->owner;
        //$author = $user_model->get_full_name($author_id);
        $action = $action_tracker_details->action_process_step;
      }

      $email_address = $user_model->get_value($owner_id, 'email_address');
      $first_name = $user_model->get_value($owner_id, 'first_name');
      $last_name = $user_model->get_value($owner_id, 'last_name');

      $message =  "Hi ".$first_name.",";
      $message .= "<br><br>";
      $message .= "You have been allocated an action with ID of {$action_tracker_id}.";
      $message .= "<br><br>";
      $message .= "Action: " . $action;
      $message .= "<br>";
      $message .= "Author: " . $author;
      $message .= "<br>";
      $message .= "Due Date: " . $due_date;
      $message .= "<br><br>";



      $message .= '<a href="'.base_url('action-tracker/accept/'.$action_tracker_id.'/'.$subaction_type).'">Accept</a>';
      $message .= "<br>";
      $message .= '<a href="'.base_url('action-tracker/reject/'.$action_tracker_id.'/'.$subaction_type).'">Reject</a>';
      $message .= "<br>";
      $message .= '<a href="'.base_url('action-tracker/propose-date/'.$action_tracker_id.'/'.$subaction_type).'">Propose a new date</a>';

      //echo $message;

      $this->basic_send_mail($email_address, $subject, $message, 'html');

      if($action_type == 'subaction'){
        $document_model->update_value($action_tracker_id, 'notification_status', 1, 'subaction_tracker', 'subaction_tracker_id');
      }else{
        $document_model->update_value($action_tracker_id, 'notification_status', 1, 'action_tracker', 'action_tracker_id');
      }
      

    }

    $action_tracker_values = array(
      'action_tracker_id' => $action_tracker_id,
      'owner_id' => $owner_id,
      'notification_sent' => $notification_sent,
      'previous_owner' => $previous_owner,
      'notify' => $notify
    );

    return $action_tracker_values;

    //echo json_encode($previous_data);
  }

  public function notify_single_action_tracker_owner( $document_id, $action_tracker_id, $owner_id ) {

    $notify = false;

    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $user_model = $this->user_model;

    $sent_owners = array();

    $document_details = $document_model->get_document( $document_id );

    $document_name = $document_details->name;
    $document_code = $document_details->code;
    $document_ref_id = $document_details->ref_id;
    $document_type = $document_details->document_code;

    if ( $document_name == '' || $document_name == null ) {
      $document_name = "this document with code: ".$document_code;
    }

    



    $notification_sent = $document_model->get_value( $action_tracker_id, 'notification_status', 'action_tracker', 'action_tracker_id' );
    $previous_owner = $document_model->get_value( $action_tracker_id, 'owner', 'action_tracker', 'action_tracker_id' );
    $previous_document = $document_model->get_value( $action_tracker_id, 'document_id', 'action_tracker', 'action_tracker_id' );

    $previous_data = array(
      'notification_sent' => $notification_sent,
      'owner_id' => $owner_id,
      'previous_owner' => $previous_owner,
      'document_id' => $document_id,
      'previous_document' => $previous_document,

    );

    if($notification_sent != 1){
      $notify = true;
      $previous_data['notification_not_one'] = $notify;
    }

    if($owner_id != $previous_owner){
      $notify = true;
      $previous_data['owner_not_equal'] = $notify;
    }

    if($previous_document != $document_id){
      $notify = true;
      $previous_data['document_not_equal'] = $notify;
    }


    if($notify){

      $email_address = $user_model->get_value($owner_id, 'email_address');
      $first_name = $user_model->get_value($owner_id, 'first_name');
      $last_name = $user_model->get_value($owner_id, 'last_name');

      /*$message =  "Hi ".$first_name.",";
      $message .= "<br><br>";
      $message .= "You have been allocated an action relating to “".$document_name."” please click on the link below to view.";
      $message .= "<br><br>";
      $message .= base_url($document_type.'/view/'.$document_id)."#schedule-of-activities";
      $message .= "<br><br>";*/


      //ACTION TRACKER GET

      $modified_action_trackers = array();
      $new_action_trackers = array();
      $new_and_modified_action_trackers = array();

      $action_tracker = $document_model->get_sub_table( $document_id, 'action_tracker' );
      $action_tracker_array = array();

      $modified_action_trackers = array();
      $new_action_trackers = array();
      $new_and_modified_action_trackers = array();
      $closed_action_trackers = array();

      $action_tracker_counter = 0;
      foreach ( $action_tracker as $item ) {

        $reference = $item->reference;
        $action_process_step = $item->action_process_step;
        $status = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'name' );
        $status_color = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'color_class' );
        $owner = $item->owner;
        $full_name = $user_model->get_full_name( $item->owner );
        $due_date = convert_date_to_string($item->due_date, true);
        $duration = $item->duration;
        $comments = $item->comments;
        $change_status = $item->change_status;
        

        $action_tracker_array[] = array();
        $modified_action_trackers[] = array();
        $new_action_trackers[] = array();
        $new_and_modified_action_trackers[] = array();
        $closed_action_trackers[] = array();

        if($change_status == 'new' || $change_status == 'modified' || $change_status == ''){
          $new_and_modified_action_trackers[$action_tracker_counter]['reference'] = $reference;
          $new_and_modified_action_trackers[$action_tracker_counter]['action_process_step'] = $action_process_step;
          $new_and_modified_action_trackers[$action_tracker_counter]['status'] = $status;
          $new_and_modified_action_trackers[$action_tracker_counter]['status_color'] = $status_color;
          $new_and_modified_action_trackers[$action_tracker_counter]['owner'] = $owner;
          $new_and_modified_action_trackers[$action_tracker_counter]['full_name'] = $full_name;
          $new_and_modified_action_trackers[$action_tracker_counter]['due_date'] = $due_date;
          $new_and_modified_action_trackers[$action_tracker_counter]['duration'] = $duration;
          $new_and_modified_action_trackers[$action_tracker_counter]['comments'] = $comments;
        }else if($change_status == 'closed'){
          $closed_action_trackers[$action_tracker_counter]['reference'] = $reference;
          $closed_action_trackers[$action_tracker_counter]['action_process_step'] = $action_process_step;
          $closed_action_trackers[$action_tracker_counter]['status'] = $status;
          $closed_action_trackers[$action_tracker_counter]['status_color'] = $status_color;
          $closed_action_trackers[$action_tracker_counter]['owner'] = $owner;
          $closed_action_trackers[$action_tracker_counter]['full_name'] = $full_name;
          $closed_action_trackers[$action_tracker_counter]['due_date'] = $due_date;
          $closed_action_trackers[$action_tracker_counter]['duration'] = $duration;
          $closed_action_trackers[$action_tracker_counter]['comments'] = $comments;
        }else{
          $action_tracker_array[$action_tracker_counter]['reference'] = $reference;
          $action_tracker_array[$action_tracker_counter]['action_process_step'] = $action_process_step;
          $action_tracker_array[$action_tracker_counter]['status'] = $status;
          $action_tracker_array[$action_tracker_counter]['status_color'] = $status_color;
          $action_tracker_array[$action_tracker_counter]['owner'] = $owner;
          $action_tracker_array[$action_tracker_counter]['full_name'] = $full_name;
          $action_tracker_array[$action_tracker_counter]['due_date'] = $due_date;
          $action_tracker_array[$action_tracker_counter]['duration'] = $duration;
          $action_tracker_array[$action_tracker_counter]['comments'] = $comments;
        }        

        $action_tracker_counter++;
      }

      $new_and_modified_action_trackers = array_values(array_filter($new_and_modified_action_trackers));
      $closed_action_trackers = array_values(array_filter($closed_action_trackers));
      $action_tracker_array = array_values(array_filter($action_tracker_array));

      $count_new_and_modified = count($new_and_modified_action_trackers);
      $count_closed = count($closed_action_trackers);
      $count_old = count($action_tracker_array);


      $message =  "Hi ".$first_name.",";
      $message .= "<br><br>";

      if($count_new_and_modified > 0 && $count_closed > 0){
        $subject = 'ISO14224 - Action Allocated and Closed';
        $message .= "You have been allocated and closed existing action relating to “".$document_name."” please click on the link below to view.";
      }else if($count_new_and_modified > 0 && $count_closed == 0){
        $subject = 'ISO14224 - Action Allocated';
        $message .= "You have been allocated an action relating to “".$document_name."” please click on the link below to view.";
      }else if($count_new_and_modified == 0 && $count_closed > 0){
        $subject = 'ISO14224 - Action Closed';
        $message .= "You have been closed an action relating to “".$document_name."” please click on the link below to view.";
      }

      
      $message .= "<br><br>";
      $message .= base_url($document_type.'/view/'.$document_id);
      $message .= "<br><br>";


      //END ACTION TRACKER GET

      //START - NEW AND MODIFIED ACTION TRACKERS
      if($count_closed > 0){
        $message .= "<h4>Closed actions relating to ". $document_name . "</h4>";

        $message .= '<table style="border:1px solid #ccc;border-collapse:collapse;">';
          $message .= '<tbody>';
            $message .= '<tr style="border:1px solid #ccc;">';
              $message .= '<td style="border:1px solid #ccc;">Reference</td>';
              $message .= '<td style="border:1px solid #ccc;">Action/Process Step</td>';
              $message .= '<td style="border:1px solid #ccc;">Status</td>';
              $message .= '<td style="border:1px solid #ccc;">Owner</td>';
              $message .= '<td style="border:1px solid #ccc;">Due Date</td>';
              $message .= '<td style="border:1px solid #ccc;">Comments</td>';
            $message .= '</tr>';

            foreach($closed_action_trackers as $result){

              $reference = $result['reference'];
              $action_process_step = $result['action_process_step'];
              $status_color = $result['status_color'];
              $owner = $result['full_name'];
              $due_date = $result['due_date'];
              $duration = $result['duration'];
              $comments = $result['comments'];

              $message .= '<tr style="border:1px solid #ccc;font-weight:bold;">';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$reference.'</td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$action_process_step.'</td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;" class="'.$status_color.'"></td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$owner.'</td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$due_date.'</td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$comments.'</td>';
            $message .= '</tr>';

                       } 
          $message .= '</tbody>';
        $message .= '</table>';
      }
      //END - NEW AND MODIFIED ACTION TRACKERS

      //START - NEW AND MODIFIED ACTION TRACKERS
      if($count_new_and_modified > 0){
        $message .= "<h4>New and modified actions relating to ". $document_name . "</h4>";

        $message .= '<table style="border:1px solid #ccc;border-collapse:collapse;">';
          $message .= '<tbody>';
            $message .= '<tr style="border:1px solid #ccc;">';
              $message .= '<td style="border:1px solid #ccc;">Reference</td>';
              $message .= '<td style="border:1px solid #ccc;">Action/Process Step</td>';
              $message .= '<td style="border:1px solid #ccc;">Status</td>';
              $message .= '<td style="border:1px solid #ccc;">Owner</td>';
              $message .= '<td style="border:1px solid #ccc;">Due Date</td>';
              $message .= '<td style="border:1px solid #ccc;">Comments</td>';
            $message .= '</tr>';

            foreach($new_and_modified_action_trackers as $result){

              $reference = $result['reference'];
              $action_process_step = $result['action_process_step'];
              $status_color = $result['status_color'];
              $owner = $result['full_name'];
              $due_date = $result['due_date'];
              $duration = $result['duration'];
              $comments = $result['comments'];

              $message .= '<tr style="border:1px solid #ccc;font-weight:bold;">';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$reference.'</td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$action_process_step.'</td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;" class="'.$status_color.'"></td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$owner.'</td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$due_date.'</td>';
              $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$comments.'</td>';
            $message .= '</tr>';

                       } 
          $message .= '</tbody>';
        $message .= '</table>';
      }
      //END - NEW AND MODIFIED ACTION TRACKERS

      $message .= "<br>";

      //START - OLD ACTION TRACKERS
      if($count_old > 0){
        $message .= "<h4>All your actions relating to ". $document_name . "</h4>";

        $message .= '<table style="border:1px solid #ccc;border-collapse:collapse;">';
          $message .= '<tbody>';
            $message .= '<tr style="border:1px solid #ccc;">';
              $message .= '<td style="border:1px solid #ccc;">Reference</td>';
              $message .= '<td style="border:1px solid #ccc;">Action/Process Step</td>';
              $message .= '<td style="border:1px solid #ccc;">Status</td>';
              $message .= '<td style="border:1px solid #ccc;">Owner</td>';
              $message .= '<td style="border:1px solid #ccc;">Due Date</td>';
              $message .= '<td style="border:1px solid #ccc;">Comments</td>';
            $message .= '</tr>';

            foreach($action_tracker_array as $result){ 

              $reference = $result['reference'];
              $action_process_step = $result['action_process_step'];
              $status_color = $result['status_color'];
              $owner = $result['full_name'];
              $due_date = $result['due_date'];
              $duration = $result['duration'];
              $comments = $result['comments'];


                      

                      $message .= '<tr style="border:1px solid #ccc;">';
              $message .= '<td style="border:1px solid #ccc;">'.$reference.'</td>';
              $message .= '<td style="border:1px solid #ccc;">'.$action_process_step.'</td>';
              $message .= '<td style="border:1px solid #ccc;" class="'.$status_color.'"></td>';
              $message .= '<td style="border:1px solid #ccc;">'.$owner.'</td>';
              $message .= '<td style="border:1px solid #ccc;">'.$due_date.'</td>';
              $message .= '<td style="border:1px solid #ccc;">'.$comments.'</td>';
            $message .= '</tr>';

                       } 
          $message .= '</tbody>';
        $message .= '</table>';
      }
      //END - OLD ACTION TRACKERS

       //echo $message;
        //echo '<br>';
        //echo '<br>';

        //START - COMMENTED
        $this->basic_send_mail($email_address, $subject, $message, 'html');

        $document_model->update_value($action_tracker_id, 'notification_status', 1, 'action_tracker', 'action_tracker_id');
        //END - COMMENTED


    }

    echo json_encode($previous_data);
  }

  public function notify_action_tracker_owner( $document_id, $reference_ids, $owners ) {

    $notify = false;

    $this->load->model( 'Document_Model' );
    $document_model = new Document_Model();

    $user_model = $this->user_model;

    $sent_owners = array();

    $document_details = $document_model->get_document( $document_id );

    $document_name = $document_details->name;
    $document_code = $document_details->code;
    $document_ref_id = $document_details->ref_id;
    $document_type = $document_details->document_code;

    if ( $document_name == '' || $document_name == null ) {
      $document_name = "this document with code: ".$document_code;
    }

    $subject = 'ISO14224 - Action Allocated';

    $count = 0;


    foreach($reference_ids as $reference_id){

      $reference = explode('-',$reference_id);
      $reference_length = count($reference);

      $action_tracker_id = $reference[$reference_length-1];

      $notification_sent = $document_model->get_value($action_tracker_id, 'notification_status', 'action_tracker', 'action_tracker_id');
      $previous_owner = $document_model->get_value($action_tracker_id, 'owner', 'action_tracker', 'action_tracker_id');
      $previous_document = $document_model->get_value($action_tracker_id, 'document_id', 'action_tracker', 'action_tracker_id');


      if($notification_sent != 1){
        $notify = true;
      }

      if($owners[$count] != $previous_owner){
        $notify = true;
      }

      if($previous_document != $document_id){
        $notify = true;
      }


      if($notify){

        $email_address = $user_model->get_value($owners[$count], 'email_address');
        $first_name = $user_model->get_value($owners[$count], 'first_name');
        $last_name = $user_model->get_value($owners[$count], 'last_name');

        //ACTION TRACKER GET
        $action_tracker = $document_model->get_sub_table( $document_id, 'action_tracker' );
        $action_tracker_array = array();

        $modified_action_trackers = array();
        $new_action_trackers = array();
        $new_and_modified_action_trackers = array();
        $closed_action_trackers = array();

        $action_tracker_counter = 0;
        foreach ( $action_tracker as $item ) {

          $reference = $item->reference;
          $action_process_step = $item->action_process_step;
          $status = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'name' );
          $status_color = $this->get_menu_detail_value( $item->status, 'action_tracker_status', 'menu', 'color_class' );
          $owner = $item->owner;
          $full_name = $user_model->get_full_name( $item->owner );
          $due_date = convert_date_to_string($item->due_date, true);
          $duration = $item->duration;
          $comments = $item->comments;
          $change_status = $item->change_status;
          

          $action_tracker_array[] = array();
          $modified_action_trackers[] = array();
          $new_action_trackers[] = array();
          $new_and_modified_action_trackers[] = array();
          $closed_action_trackers[] = array();

          if($change_status == 'new' || $change_status == 'modified' || $change_status == ''){
            $new_and_modified_action_trackers[$action_tracker_counter]['reference'] = $reference;
            $new_and_modified_action_trackers[$action_tracker_counter]['action_process_step'] = $action_process_step;
            $new_and_modified_action_trackers[$action_tracker_counter]['status'] = $status;
            $new_and_modified_action_trackers[$action_tracker_counter]['status_color'] = $status_color;
            $new_and_modified_action_trackers[$action_tracker_counter]['owner'] = $owner;
            $new_and_modified_action_trackers[$action_tracker_counter]['full_name'] = $full_name;
            $new_and_modified_action_trackers[$action_tracker_counter]['due_date'] = $due_date;
            $new_and_modified_action_trackers[$action_tracker_counter]['duration'] = $duration;
            $new_and_modified_action_trackers[$action_tracker_counter]['comments'] = $comments;
          }else if($change_status == 'closed'){
            $closed_action_trackers[$action_tracker_counter]['reference'] = $reference;
            $closed_action_trackers[$action_tracker_counter]['action_process_step'] = $action_process_step;
            $closed_action_trackers[$action_tracker_counter]['status'] = $status;
            $closed_action_trackers[$action_tracker_counter]['status_color'] = $status_color;
            $closed_action_trackers[$action_tracker_counter]['owner'] = $owner;
            $closed_action_trackers[$action_tracker_counter]['full_name'] = $full_name;
            $closed_action_trackers[$action_tracker_counter]['due_date'] = $due_date;
            $closed_action_trackers[$action_tracker_counter]['duration'] = $duration;
            $closed_action_trackers[$action_tracker_counter]['comments'] = $comments;
          }else{
            $action_tracker_array[$action_tracker_counter]['reference'] = $reference;
            $action_tracker_array[$action_tracker_counter]['action_process_step'] = $action_process_step;
            $action_tracker_array[$action_tracker_counter]['status'] = $status;
            $action_tracker_array[$action_tracker_counter]['status_color'] = $status_color;
            $action_tracker_array[$action_tracker_counter]['owner'] = $owner;
            $action_tracker_array[$action_tracker_counter]['full_name'] = $full_name;
            $action_tracker_array[$action_tracker_counter]['due_date'] = $due_date;
            $action_tracker_array[$action_tracker_counter]['duration'] = $duration;
            $action_tracker_array[$action_tracker_counter]['comments'] = $comments;
          }        

          $action_tracker_counter++;
        }

        $new_and_modified_action_trackers = array_values(array_filter($new_and_modified_action_trackers));
        $closed_action_trackers = array_values(array_filter($closed_action_trackers));
        $action_tracker_array = array_values(array_filter($action_tracker_array));

        $count_new_and_modified = count($new_and_modified_action_trackers);
        $count_closed = count($closed_action_trackers);
        $count_old = count($action_tracker_array);


        $message =  "Hi ".$first_name.",";
        $message .= "<br><br>";

        if($count_new_and_modified > 0 && $count_closed > 0){
          $subject = 'ISO14224 - Action Allocated and Closed';
          $message .= "You have been allocated and closed existing action relating to “".$document_name."” please click on the link below to view.";
        }else if($count_new_and_modified > 0 && $count_closed == 0){
          $subject = 'ISO14224 - Action Allocated';
          $message .= "You have been allocated an action relating to “".$document_name."” please click on the link below to view.";
        }else if($count_new_and_modified == 0 && $count_closed > 0){
          $subject = 'ISO14224 - Action Closed';
          $message .= "You have been closed an action relating to “".$document_name."” please click on the link below to view.";
        }

        
        $message .= "<br><br>";
        $message .= base_url($document_type.'/view/'.$document_id);
        $message .= "<br><br>";


        //END ACTION TRACKER GET

        //START - NEW AND MODIFIED ACTION TRACKERS
        if($count_closed > 0){
          $message .= "<h4>Cloased actions relating to ". $document_name . "</h4>";

          $message .= '<table style="border:1px solid #ccc;border-collapse:collapse;">';
            $message .= '<tbody>';
              $message .= '<tr style="border:1px solid #ccc;">';
                $message .= '<td style="border:1px solid #ccc;">Reference</td>';
                $message .= '<td style="border:1px solid #ccc;">Action/Process Step</td>';
                $message .= '<td style="border:1px solid #ccc;">Status</td>';
                $message .= '<td style="border:1px solid #ccc;">Owner</td>';
                $message .= '<td style="border:1px solid #ccc;">Due Date</td>';
                $message .= '<td style="border:1px solid #ccc;">Comments</td>';
              $message .= '</tr>';

              foreach($closed_action_trackers as $result){

                $reference = $result['reference'];
                $action_process_step = $result['action_process_step'];
                $status_color = $result['status_color'];
                $owner = $result['full_name'];
                $due_date = $result['due_date'];
                $duration = $result['duration'];
                $comments = $result['comments'];

                $message .= '<tr style="border:1px solid #ccc;font-weight:bold;">';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$reference.'</td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$action_process_step.'</td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;" class="'.$status_color.'"></td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$owner.'</td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$due_date.'</td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$comments.'</td>';
              $message .= '</tr>';

                         } 
            $message .= '</tbody>';
          $message .= '</table>';
        }
        //END - NEW AND MODIFIED ACTION TRACKERS

        //START - NEW AND MODIFIED ACTION TRACKERS
        if($count_new_and_modified > 0){
          $message .= "<h4>New and modified actions relating to ". $document_name . "</h4>";

          $message .= '<table style="border:1px solid #ccc;border-collapse:collapse;">';
            $message .= '<tbody>';
              $message .= '<tr style="border:1px solid #ccc;">';
                $message .= '<td style="border:1px solid #ccc;">Reference</td>';
                $message .= '<td style="border:1px solid #ccc;">Action/Process Step</td>';
                $message .= '<td style="border:1px solid #ccc;">Status</td>';
                $message .= '<td style="border:1px solid #ccc;">Owner</td>';
                $message .= '<td style="border:1px solid #ccc;">Due Date</td>';
                $message .= '<td style="border:1px solid #ccc;">Comments</td>';
              $message .= '</tr>';

              foreach($new_and_modified_action_trackers as $result){

                $reference = $result['reference'];
                $action_process_step = $result['action_process_step'];
                $status_color = $result['status_color'];
                $owner = $result['full_name'];
                $due_date = $result['due_date'];
                $duration = $result['duration'];
                $comments = $result['comments'];

                $message .= '<tr style="border:1px solid #ccc;font-weight:bold;">';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$reference.'</td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$action_process_step.'</td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;" class="'.$status_color.'"></td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$owner.'</td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$due_date.'</td>';
                $message .= '<td style="border:1px solid #ccc;font-weight:bold;">'.$comments.'</td>';
              $message .= '</tr>';

                         } 
            $message .= '</tbody>';
          $message .= '</table>';
        }
        //END - NEW AND MODIFIED ACTION TRACKERS

        $message .= "<br>";

        //START - OLD ACTION TRACKERS
        if($count_old > 0){
          $message .= "<h4>All your actions relating to ". $document_name . "</h4>";

          $message .= '<table style="border:1px solid #ccc;border-collapse:collapse;">';
            $message .= '<tbody>';
              $message .= '<tr style="border:1px solid #ccc;">';
                $message .= '<td style="border:1px solid #ccc;">Reference</td>';
                $message .= '<td style="border:1px solid #ccc;">Action/Process Step</td>';
                $message .= '<td style="border:1px solid #ccc;">Status</td>';
                $message .= '<td style="border:1px solid #ccc;">Owner</td>';
                $message .= '<td style="border:1px solid #ccc;">Due Date</td>';
                $message .= '<td style="border:1px solid #ccc;">Comments</td>';
              $message .= '</tr>';

              foreach($action_tracker_array as $result){ 

                $reference = $result['reference'];
                $action_process_step = $result['action_process_step'];
                $status_color = $result['status_color'];
                $owner = $result['full_name'];
                $due_date = $result['due_date'];
                $duration = $result['duration'];
                $comments = $result['comments'];


                        

                        $message .= '<tr style="border:1px solid #ccc;">';
                $message .= '<td style="border:1px solid #ccc;">'.$reference.'</td>';
                $message .= '<td style="border:1px solid #ccc;">'.$action_process_step.'</td>';
                $message .= '<td style="border:1px solid #ccc;" class="'.$status_color.'"></td>';
                $message .= '<td style="border:1px solid #ccc;">'.$owner.'</td>';
                $message .= '<td style="border:1px solid #ccc;">'.$due_date.'</td>';
                $message .= '<td style="border:1px solid #ccc;">'.$comments.'</td>';
              $message .= '</tr>';

                         } 
            $message .= '</tbody>';
          $message .= '</table>';
        }
        //END - OLD ACTION TRACKERS


        //echo $message;
        //echo '<br>';
        //echo '<br>';

        //START - COMMENTED
        $this->basic_send_mail($email_address, $subject, $message, 'html');

        $document_model->update_value($action_tracker_id, 'notification_status', 1, 'action_tracker', 'action_tracker_id');
        //END - COMMENTED

        $notify = false;

      }

      
      $count++;
      

    }
  }

  public function remove_equipment_history_answer() {

    $answer_id = $this->input->post( 'answer_id' );

    $document_model = $this->main_model;

    $document_model->delete_value( $answer_id, 'equipment_history_answer', 'equipment_history_answer_id' );
  }

  public function add_equipment_history_answer() {

    $document_id = $this->input->post( 'document_id' );
    $category_id = $this->input->post( 'category_id' );

    $document_model = $this->main_model;

    $last_insert_id = $document_model->create_specific_equipment_history_category_answer( $document_id, $category_id );

    echo $last_insert_id;
  }

  public function get_view() {

    $this->load->model( 'Document_Model' );
    $main_model = new Document_Model();

    $data = $this->input->post();

    $json_view_name = $this->input->post( 'json_view_name' );

    if ( $data ) {

      $result = $main_model->get_view( $json_view_name );

      echo $result;

    }
  }

  public function update_view() {

    $this->load->model( 'Document_Model' );
    $main_model = new Document_Model();

    $data = $this->input->post();

    $json_view_name = $this->input->post( 'json_view_name' );
    $json_view_data = $this->input->post( 'json_view_data' );

    if ( $data ) {

      $main_model->update_view( $json_view_name, $json_view_data );

    }
  }

  //automated update current day values ver1
  public function update_daily_equipment_status_version1() {

    $this->load->model( 'Criticality_Analysis_Model' );

    $main_model = new Criticality_Analysis_Model();

    $yesterday_values = $main_model->get_previous_day_criticality_analysis_values();

    foreach ( $yesterday_values as $value ) {

      $current = date( 'd-m-Y' );
      $current_date = explode( "-", $current );
      $day = $current_date[0];
      $month = $current_date[1];
      $year = $current_date[2];

      $criticality_analysis_id = $value->criticality_analysis_id;
      $day_spf = $value->day_spf;
      $day_status = $value->day_status;
      $day_availability = $value->day_availability;
      $hours = 0; //$value->hours;
      $day_obs = $value->day_obs;

      //update next day values
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
    }

    echo "success - ".date( 'd-m-Y H:i:s e' )."\n";
  }

  //automated update current day values ver2
  //will not update columns with existing values
  public function update_daily_equipment_status_version2() {

    $this->load->model( 'Criticality_Analysis_Model' );
    $main_model = new Criticality_Analysis_Model();

    $yesterday_values = $main_model->get_previous_day_criticality_analysis_values();

    $current = date( 'd-m-Y' );
    $current_date = explode( "-", $current );
    $day = $current_date[0];
    $month = $current_date[1];
    $year = $current_date[2];


    //var_dump($yesterday_values);

    foreach ( $yesterday_values as $value ) {

      $criticality_analysis_id = $value->criticality_analysis_id;
      $day_spf = $value->day_spf;
      $day_status = $value->day_status;
      $day_availability = $value->day_availability;
      $hours = 0; //$value->hours;
      $day_obs = $value->day_obs;

      //update next day values
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



        //get values of existing
        $spf = $main_model->get_value( $row_exist, 'day_spf', 'criticality_analysis_history', 'criticality_analysis_history_id' );
        $availability = $main_model->get_value( $row_exist, 'day_availability', 'criticality_analysis_history', 'criticality_analysis_history_id' );
        $status = $main_model->get_value( $row_exist, 'day_status', 'criticality_analysis_history', 'criticality_analysis_history_id' );
        $day_hours = $main_model->get_value( $row_exist, 'hours', 'criticality_analysis_history', 'criticality_analysis_history_id' );
        $obs = $main_model->get_value( $row_exist, 'day_obs', 'criticality_analysis_history', 'criticality_analysis_history_id' );


        //check if null or zero
        if ( $spf != 0 || $spf != null ) {
          $day_spf = $spf;
        }

        if ( $availability != 0 && $availability != null ) {
          $day_availability = $availability;
        }

        if ( $status != 0 && $status != null ) {
          $day_status = $status;
        }

        if ( $day_hours != 0 && $day_hours != null ) {
          $hours = $day_hours;
        }

        if ( $obs != 0 && $obs != null ) {
          $day_obs = $obs;
        }
        //end check

        $cas_id = $main_model->get_value( $criticality_analysis_id, 'cas' );
        $cas_value = $this->get_menu_detail_value( $cas_id, 'criticality_score', 'menu', 'value' );
        $spf_value = $this->get_menu_detail_value( $day_spf, 'criticality_spf', 'menu', 'value' );
        $status_value = $this->get_menu_detail_value( $day_status, 'criticality_status', 'menu', 'value' );
        $cv_value = $this->solve_criticality_value( $cas_value, $status_value, $spf_value );

        //var_dump($availability);
        //var_dump($day_hours);
        //var_dump($status);
        //var_dump($obs);
        //var_dump($spf);


        $main_model->update_single_criticality_analysis_history_row( $row_exist, $day_spf, $day_availability, $day_status, $hours, $day_obs, $cv_value );


      }
    }

    echo "success - ".date( 'd-m-Y H:i:s e' )."\n";
  }

  public function solve_criticality_value( $cas = 0, $status_value = 0, $spf_value = 0 ) {

    if ( $spf_value == '' || $spf_value == null ) {
      $spf_value = 0;
    }

    if ( $status_value == '' || $status_value == null ) {
      $status_value = 0;
    }

    if ( $cas == '' || $cas == null ) {
      $cas = 0;
    }

    $cas = floatval( $cas );
    $status_value = floatval( $status_value );
    $spf_value = floatval( $spf_value );

    $algorithm = ( $cas * $status_value ) * $spf_value;

    return $algorithm;
  }

  public function generate_breadcrumbs( $parent_name = '', $parent_link = '', $current_name = '', $is_home = false ) {

    $home_icon = '<i class="fa fa-home"></i>';
    $home_url = '/';

    if($is_home || ($parent_name == '' && $parent_link == '' && $current_name == '')){
      $this->breadcrumbs->unshift($home_icon, $home_url);
    }else if($parent_name != '' && $parent_link != '' && $current_name == ''){
      $this->breadcrumbs->unshift($home_icon, $home_url);
      $this->breadcrumbs->push($parent_name, $parent_link);
    }else{
      $this->breadcrumbs->unshift($home_icon, $home_url);
      $this->breadcrumbs->push($parent_name, $parent_link);
      $this->breadcrumbs->push($current_name, '/');
      //var_dump('hello');
    }

    return $this->breadcrumbs->show();
  }

  public function generate_field_dropdown($field_code, $default_value = ''){

    $main_model = $this->user_model;

    $field_items = $main_model->get_field_storage($field_code);

    $field_storage_id = $main_model->get_value($field_code, 'field_storage_id', 'field_storage', 'code' );
    $count = $main_model->check_field_storage_duplicate($field_storage_id, strtolower($default_value));

    if($count == 0){
      $default_value = '';
    }

    return get_dynamic_key_value_dropdown($field_items, $default_value, false, 'value', 'value', '- Select -', '');
  }

  public function add_field_storage_item($field_code, $value){

    $main_model = $this->user_model;

    //echo $field_code;

    $field_storage_id = $main_model->get_value($field_code, 'field_storage_id', 'field_storage', 'code' );

    //echo $field_storage_id;

    $count = $main_model->check_field_storage_duplicate($field_storage_id, strtolower($value));

    if($count == 0){
      $main_model->add_field_storage_item($field_storage_id, $value);
    }

    //
    //echo $field_storage_id;
  }

  public function get_file_type($filename){

    $file = explode('.', $filename);

    $extension = strtolower($file[1]);

    $main_model = $this->user_model;

    $file_type_id = $main_model->get_file_type($extension);

    return $file_type_id;
  }

  public function check_allowed_extension($file_extension){

    $file_config = $this->file_config;
    $allowed_types = $file_config['allowed_types'];

    $allowed = strpos($allowed_types, $file_extension);

    if($allowed !== false){
      echo 'true';
    }else{
      echo 'false';
    }
  }

}

?>