<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Technical_Bulletin extends MY_Controller {

	public function __construct(){

	     parent::__construct();

	    $this->document_code = 'TB';
	    $this->document_primary = 'document_id';
	    $this->form_primary = 'technical_bulletin_id';

	    $main_model_str = 'TB_Model';
	    $this->load->model($main_model_str);
	    $this->main_model = new $main_model_str;

	    $this->load->model('Document_Model');
	    $this->document_model = new Document_Model();

	    $this->no_of_steps = 1;

    	$this->parent_name = 'Technical Bulletin';
    	$this->parent_uri = '/technical-bulletin';

    	$step_titles = array(
			'Create Technical Bulletin'
		);

		$this->step_titles = $step_titles;
	}

	public function index(){
		redirect('user/my-account');
	}


	public function test(){
		//this data will be passed on to the view
		$data['the_content']='mPDF and CodeIgniter are cool!';

		//load the view, pass the variable and do not show it but "save" the output into $html variable
		//$html=$this->load->view('tb/pdf-test', $data, true); 
		$html = $this->load->view( 'layout/header-pdf', $header_data, true );
		$html .= $this->load->view( 'view/view-tb-new', $model_data, true );

		//this the the PDF filename that user will get to download
		$pdfFilePath = "the_pdf_output.pdf";

		//load mPDF library
		$this->load->library('m_pdf');
		//actually, you can pass mPDF parameter on this load() function
		$pdf = $this->m_pdf->load();
		//generate the PDF!
		$pdf->WriteHTML($html);
		//offer it to user via browser download! (The PDF won't be saved on your server HDD)
		$pdf->Output($pdfFilePath, "D");
	}



	public function view($id, $action = ''){

		$this->_is_not_id($id);

		# Log -----------------------------------------------------------------------------
	    $this->load->model('Document_Tracker_Model');
	    $document_tracker_model = new Document_Tracker_Model();

	    $user_id = $this->session->userdata('session');
	    $action = '<span class="text-success">Viewed</span> Document';
	    $document_name = $document_tracker_model->get_name_by_id($id);

	    $document_tracker_model->add_action_track($user_id, $action.' '.$document_name);
	    # end of Log -----------------------------------------------------------------------

		$form_redirect = false;
		$editable = $this->_form_check($id,$form_redirect);

		$uploads_folder = $this->uploads_folder;

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$uploads_folder = $this->uploads_folder;

		$controller_uri = $this->controller_uri;

		$header_data = array(
			'title' => 'View Technical Bulletin',
			'hidden' => ''
        );
		
		$model_data = array(

		);

		$current_user_id = $this->session->userdata('session');
		//$main_details = $form_model->get_record($id);

		$model_data['model_id'] = $id;

		$purpose = "<p>Sharing our lessons learned with colleagues and other assets is the greatest tool we have in the challenge against the cumulative demands of operations in the harshest of environments and at the forefront of technology.</p><p>Assume if there has been a failure on one asset, then it’s going to happen somewhere else, providing the early warning signs may prevent reoccurrence elsewhere. It keeps us safe, it costs nothing and the value is priceless.</p>";


		$document_details = $main_model->get_document($id);

		//var_dump($document_details);
		$document_id = $document_details->document_id;

		$document_owners = $document_model->get_document_owners($document_id, 'owner');
		$author_first_name = $document_owners[0]->first_name;
		$author_last_name = $document_owners[0]->last_name;
		$author = $author_first_name.' '.$author_last_name;

		if(count($document_details) <1){
			redirect('user/my-account');
		}

		$code = $document_details->code;
		$ref_id = $document_details->ref_id;

		$doc_title = $document_details->name;
		//$author = $document_details->author;
		$date = convert_date_to_string($document_details->date);
		//$purpose = $document_details->purpose;
		$relevance = $document_details->relevance;
		$summary = $document_details->summary_of_events;
		$recommendation = $document_details->recommendations;
		$no_of_steps = $this->no_of_steps;
		$next_step = $document_details->next_steps;

		$system = $this->get_menu_detail_value($document_details->system_id, 'system', 'menu', 'name');
		$system_subcategory = $this->get_menu_detail_value($document_details->system_subcategory_id, 'system', 'subcategory', 'name');

		$equipment_category = $this->get_menu_detail_value($document_details->equipment_category_id, 'equipment_category', 'menu','name');
		$equipment_class = $this->get_menu_detail_value($document_details->equipment_class_id, 'equipment_category', 'subcategory','name');
		$equipment_description = $this->get_menu_detail_value($document_details->equipment_description_id, 'equipment_category', 'deep_subcategory','name');
		$equipment_code = $this->get_menu_detail_value($document_details->equipment_description_id, 'equipment_category', 'deep_subcategory', 'code');
		$equipment_tag_number = $document_details->tag_number;
		$equipment_unique_id = $document_details->unique_id;
		$equipment_manufacturer = $document_details->manufacturer;
		$equipment_model = $document_details->model;
		$equipment_power_output = $document_details->power_output;
		$equipment_failed_component = $document_details->failed_component;

		//images
		$image_1_filename = $document_details->upload_1_filename;
		$image_2_filename = $document_details->upload_2_filename;
		$image_3_filename = $document_details->upload_3_filename;
		$image_4_filename = $document_details->upload_4_filename;
		$image_5_filename = $document_details->upload_5_filename;
		$image_6_filename = $document_details->upload_6_filename;

		$image_1_filename = $main_model->get_filename($image_1_filename);
		$image_2_filename = $main_model->get_filename($image_2_filename);
		$image_3_filename = $main_model->get_filename($image_3_filename);
		$image_4_filename = $main_model->get_filename($image_4_filename);
		$image_5_filename = $main_model->get_filename($image_5_filename);
		$image_6_filename = $main_model->get_filename($image_6_filename);

		$image_1_caption = $document_details->upload_1_caption;
		$image_2_caption = $document_details->upload_2_caption;
		$image_3_caption = $document_details->upload_3_caption;
		$image_4_caption = $document_details->upload_4_caption;
		$image_5_caption = $document_details->upload_5_caption;
		$image_6_caption = $document_details->upload_6_caption;



		$model_data['code'] = $code;
		$model_data['doc_title'] = $doc_title;
		$model_data['system_value'] = $system;
		$model_data['system_subcategory_value'] = $system_subcategory;
		$model_data['system'] = $system;
		$model_data['system_subcategory'] = $system_subcategory;
		$model_data['equipment_category_value'] = $equipment_category;
		$model_data['equipment_class_value'] = $equipment_class;
		$model_data['equipment_description_value'] = $equipment_description;
		$model_data['equipment_code_value'] = $equipment_code;
		$model_data['author'] = $author;
		$model_data['doc_date'] = $date;
		$model_data['purpose'] = $purpose;
		$model_data['relevance'] = $relevance;
		$model_data['summary'] = $summary;
		$model_data['recommendation'] = $recommendation;
		$model_data['next_step'] = $next_step;



		$model_data['ranking_title'] = 'Rate this Technical Bulletin';
		include('includes/ranking-snippet.php');
		$model_data['editable'] = $editable;

		

		if($image_1_filename == '' || $image_1_filename == null){
			$image_1_filename = null;
		}else{
			$image_1_filename = base_url($uploads_folder.'/'.$image_1_filename);
		}

		if($image_2_filename == '' || $image_2_filename == null){
			$image_2_filename = null;
		}else{
			$image_2_filename = base_url($uploads_folder.'/'.$image_2_filename);
		}

		if($image_3_filename == '' || $image_3_filename == null){
			$image_3_filename = null;
		}else{
			$image_3_filename = base_url($uploads_folder.'/'.$image_3_filename);
		}

		if($image_4_filename == '' || $image_4_filename == null){
			$image_4_filename = null;
		}else{
			$image_4_filename = base_url($uploads_folder.'/'.$image_4_filename);
		}

		if($image_5_filename == '' || $image_5_filename == null){
			$image_5_filename = null;
		}else{
			$image_5_filename = base_url($uploads_folder.'/'.$image_5_filename);
		}

		if($image_6_filename == '' || $image_6_filename == null){
			$image_6_filename = null;
		}else{
			$image_6_filename = base_url($uploads_folder.'/'.$image_6_filename);
		}

		
		$model_data['image_1_filename'] = $image_1_filename;
		$model_data['image_2_filename'] = $image_2_filename;
		$model_data['image_3_filename'] = $image_3_filename;
		$model_data['image_4_filename'] = $image_4_filename;
		$model_data['image_5_filename'] = $image_5_filename;
		$model_data['image_6_filename'] = $image_6_filename;

		$model_data['image_1_caption'] = $image_1_caption;
		$model_data['image_2_caption'] = $image_2_caption;
		$model_data['image_3_caption'] = $image_3_caption;
		$model_data['image_4_caption'] = $image_4_caption;
		$model_data['image_5_caption'] = $image_5_caption;
		$model_data['image_6_caption'] = $image_6_caption;

		$model_data['no_of_steps'] = $no_of_steps;
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;
		

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		

		$pdf_status = $this->uri->segment(4, null);

		if($pdf_status == "pdf"){

			//$this->load->view( 'layout/header-pdf', $header_data );
			//$this->load->view( 'view/view-basic-decf-new', $model_data );

			$html_pdf = $this->load->view( 'layout/header-pdf', $header_data, true );
			$html_pdf .= $this->load->view( 'view/view-tb-new', $model_data, true );

			$pdf_file_path = strtolower($code).".pdf";

			include('includes/pdf-printing-snippet.php');

		}else{

			$this->load->view( 'layout/header', $header_data );
			$this->load->view( 'view/view-tb-new', $model_data );
			if ( $action == 'rank' ) {
				$this->load->view( 'includes/ranking', $model_data );
			}
			$this->load->view( 'layout/footer' );

		}
	}

	
	
	/* CRUD */
	public function create(){

		$this->create_document();
	}

	public function edit($id, $step = 1){

		
		$this->_form_check($id);

		if(!is_numeric($step)){
			redirect('user/my-account');
		}

		switch($step){
			case 1:
				$this->_edit_tb_main($id, $step);
				break;
			default:
				redirect('user/my-account');
		}
	}

	public function save($id = false, $action = 'update', $save_step = 1){

		$this->_form_check($id);

		if(!is_numeric($save_step)){
			redirect('user/my-account');
		}

		switch($save_step){
			case 1:
				$this->_save_tb_main($id, $action);
				break;
			default:
				redirect('user/my-account');
		}
	}

	public function delete($id){

		if($this->input->post()){
			$id = $this->input->post('id');
			$this->delete_document($id);
		}else{
			$redirect = true;
			$this->delete_document($id,$redirect);
		}
	}

	public function duplicate($id){

		$this->duplicate_document($id);

	}
	/* END CRUD */

	/* SAVE */
	public function _save_tb_main($id, $action){

		include('includes/document-save-init.php');
		
		if($action == 'update'){

			$uploads_folder = $this->uploads_folder;

			include 'includes/upload-snippet.php';


			$update_flag = true;

			if($update_flag){

				$doc_date = convert_string_to_date($doc_date);

				$main_model->update_step_0($form_id, $author, $doc_date, $purpose, $relevance, $summary, $recommendation, $next_step, $image_1, $image_2, $image_3, $image_4, $image_5, $image_6, $image_1_caption, $image_2_caption, $image_3_caption, $image_4_caption, $image_5_caption, $image_6_caption);

				$document_model->update($model_id, $doc_title);

				$document_model->update_equipment_profile($model_id, $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, "", "", "", "", "", "");

				$this->save_document_redirect($form_id, $model_id, $no_of_steps, $current_step, $link_to);
						
			}
			
		}
	}

	/* END SAVE */

	/* EDIT */
	public function _edit_tb_main($id, $step = 1){

		$purpose = "<p>Sharing our lessons learned with colleagues and other assets is the greatest tool we have in the challenge against the cumulative demands of operations in the harshest of environments and at the forefront of technology.</p><p>Assume if there has been a failure on one asset, then it’s going to happen somewhere else, providing the early warning signs may prevent reoccurrence elsewhere. It keeps us safe, it costs nothing and the value is priceless.</p>";


		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$header_data = array(
			'title' => 'Edit Case File',
			'hidden' => ''
        );
		
		$model_data = array(
			'upload_error' => $this->session->flashdata('upload_error')
		);


		$user_id = $this->session->userdata('session');
		$username = $user_model->get_value($user_id, 'user_name');

		$document_details = $main_model->get_document($id);

		$document_id = $document_details->document_id;

		$document_owners = $document_model->get_document_owners($document_id, 'owner');
		$author_first_name = $document_owners[0]->first_name;
		$author_last_name = $document_owners[0]->last_name;
		$author = $author_first_name.' '.$author_last_name;
		$author_id = $document_owners[0]->user_id;


		$name = $document_details->name;
		$code = $document_details->code;
		$ref_id = $document_details->ref_id;
		$doc_title = $document_details->name;
		//$author = $document_details->author;
		$doc_date = convert_date_to_string($document_details->date);
		//$purpose = $document_details->purpose;
		$relevance = $document_details->relevance;
		$summary = $document_details->summary_of_events;
		$recommendation = $document_details->recommendations;
		$next_step = $document_details->next_steps;

		$system = $document_details->system_id;
		$system_subcategory = $document_details->system_subcategory_id;
		$equipment_category = $document_details->equipment_category_id;
		$equipment_class = $document_details->equipment_class_id;
		$equipment_description = $document_details->equipment_description_id;


		include('includes/document-status-snippet.php');

		$file = $user_model->get_value($id, 'filename', 'file', 'document_id');
		$files = $main_model->get_files_by_document_step($document_id, $step);
		//image 1
		$image_1_id = $document_details->upload_1_filename;
		$image_1_details = $user_model->get_tb_files_by_column($document_id, 'upload_1_filename');
		$image_1_name = $image_1_details->file_item_name;

		//image 2
		$image_2_id = $document_details->upload_2_filename;
		$image_2_details = $user_model->get_tb_files_by_column($document_id, 'upload_2_filename');
		$image_2_name = $image_2_details->file_item_name;

		//image 3
		$image_3_id = $document_details->upload_3_filename;
		$image_3_details = $user_model->get_tb_files_by_column($document_id, 'upload_3_filename');
		$image_3_name = $image_3_details->file_item_name;

		//image 4
		$image_4_id = $document_details->upload_4_filename;
		$image_4_details = $user_model->get_tb_files_by_column($document_id, 'upload_4_filename');
		$image_4_name = $image_4_details->file_item_name;

		//image 5
		$image_5_id = $document_details->upload_5_filename;
		$image_5_details = $user_model->get_tb_files_by_column($document_id, 'upload_5_filename');
		$image_5_name = $image_5_details->file_item_name;

		//image 6
		$image_6_id = $document_details->upload_6_filename;
		$image_6_details = $user_model->get_tb_files_by_column($document_id, 'upload_6_filename');
		$image_6_name = $image_6_details->file_item_name;

		$image_1_caption = $document_details->upload_1_caption;
		$image_2_caption = $document_details->upload_2_caption;
		$image_3_caption = $document_details->upload_3_caption;
		$image_4_caption = $document_details->upload_4_caption;
		$image_5_caption = $document_details->upload_5_caption;
		$image_6_caption = $document_details->upload_6_caption;

		$model_data['id'] = $document_id;
		$model_data['model_id'] = $document_id;
		$model_data['ref_id'] = $ref_id;
		$model_data['code'] = $code;
		$model_data['user_id'] = $user_id;

		$model_data['doc_title'] = $doc_title;
		$model_data['author'] = $author;
		$model_data['author_id'] = $author_id;
		$model_data['doc_date'] = $doc_date;
		$model_data['purpose'] = $purpose;
		$model_data['relevance'] = $relevance;
		$model_data['summary'] = $summary;
		$model_data['recommendation'] = $recommendation;
		$model_data['next_step'] = $next_step;

		$model_data['system_dropdown'] = $this->get_dropdown_menu($system, 'system');
		$model_data['system_subcategory_dropdown'] = $this->get_dropdown_subcategory($system, 'system', $system_subcategory);
		$model_data['equipment_category_dropdown'] = $this->get_dropdown_menu($equipment_category, 'equipment_category');
		$model_data['equipment_class_dropdown'] = $this->get_dropdown_subcategory($equipment_category, 'equipment_category', $equipment_class);
		$model_data['equipment_description_dropdown'] = $this->get_dropdown_deep_subcategory($equipment_class, 'equipment_category', $equipment_description);
		$model_data['equipment_code_value'] = $this->get_menu_detail_value($equipment_description, 'equipment_category', 'deep_subcategory', 'code');
		
		$model_data['files'] = $files;
		$model_data['file_name'] = $file;

		//image 1
		$model_data['image_1_filename'] = $image_1_name;
		$model_data['image_1_id'] = $image_1_id;

		//image 2
		$model_data['image_2_filename'] = $image_2_name;
		$model_data['image_2_id'] = $image_2_id;

		//image 3
		$model_data['image_3_filename'] = $image_3_name;
		$model_data['image_3_id'] = $image_3_id;

		//image 4
		$model_data['image_4_filename'] = $image_4_name;
		$model_data['image_4_id'] = $image_4_id;

		//image 5
		$model_data['image_5_filename'] = $image_5_name;
		$model_data['image_5_id'] = $image_5_id;

		//image 6
		$model_data['image_6_filename'] = $image_6_name;
		$model_data['image_6_id'] = $image_6_id;

		$model_data['image_1_caption'] = $image_1_caption;
		$model_data['image_2_caption'] = $image_2_caption;
		$model_data['image_3_caption'] = $image_3_caption;
		$model_data['image_4_caption'] = $image_4_caption;
		$model_data['image_5_caption'] = $image_5_caption;
		$model_data['image_6_caption'] = $image_6_caption;
		$model_data['single_upload'] = false;



		$footer_data['modals'] = array( 'confirm-delete-modal', 'file-manager-modal', 'edit-filename-modal');


		include('includes/document-variables.php');
		$header_data['current_page_name'] = 'Technical Bulletin';

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;
	
		$this->load->view('layout/header', $header_data);
		$this->load->view('tb/tb-1', $model_data);
		$this->load->view('layout/footer', $footer_data);
	}
	/* END EDIT */

}

/* End of file technical_bulletin.php */
/* Location: ./application/controllers/technical_bulletin.php */