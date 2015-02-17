<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Technical_Query extends MY_Controller {

	public function __construct(){

	     parent::__construct();

	    $this->document_code = 'TQ';
	    $this->document_primary = 'document_id';
	    $this->form_primary = 'technical_query_id';

	    $main_model_str = 'TQ_Model';
	    $this->load->model($main_model_str);
	    $this->main_model = new $main_model_str;

	    $this->load->model('Document_Model');
	    $this->document_model = new Document_Model();

	    $this->no_of_steps = 1;

	    $step_titles = array(
			'Create Technical Query',
		);

		$this->step_titles = $step_titles;
	}

	public function index(){
		redirect('user/my-account');
	}



	public function view($id, $action = ''){

		$this->_is_not_id($id);

		$form_redirect = false;
		$editable = $this->_form_check($id,$form_redirect);

		$user_model = $this->user_model;
		$main_model = $this->main_model;
		$document_model = $this->document_model;
		$document_primary = $this->document_primary;

		$uploads_folder = $this->uploads_folder;

		$controller_uri = $this->controller_uri;

		$header_data = array(
			'title' => 'View Technical Query',
			'hidden' => ''
        );
		
		$model_data = array(

		);

		$current_user_id = $this->session->userdata('session');
		//$main_details = $form_model->get_record($id);

		$model_data['model_id'] = $id;

		$document_details = $main_model->get_document($id);

		//redirect if no document is found
		if(count($document_details) <1){
			redirect('user/my-account');
		}

		$code = $document_details->code;
		$ref_id = $document_details->ref_id;

		$doc_title = $document_details->name;
		//author
		$document_id = $document_details->document_id;

		$document_owners = $document_model->get_document_owners($document_id, 'owner');
		$author_first_name = $document_owners[0]->first_name;
		$author_last_name = $document_owners[0]->last_name;
		$author = $author_first_name.' '.$author_last_name;

		$date = convert_date_to_string($document_details->technical_query_date);
		//$purpose = $document_details->purpose;
		$question = $document_details->question;

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

		$image_1_caption = $document_details->upload_1_caption;
		$image_2_caption = $document_details->upload_2_caption;
		$image_3_caption = $document_details->upload_3_caption;

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
		$model_data['question'] = $question;

		$model_data['ranking_title'] = 'Rate this Technical Bulletin';
		include('includes/ranking-snippet.php');
		$model_data['editable'] = $editable;

		$uploads_folder = $this->uploads_folder;

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
		
		$model_data['image_1_filename'] = $image_1_filename;
		$model_data['image_2_filename'] = $image_2_filename;
		$model_data['image_3_filename'] = $image_3_filename;

		$model_data['image_1_caption'] = $image_1_caption;
		$model_data['image_2_caption'] = $image_2_caption;
		$model_data['image_3_caption'] = $image_3_caption;

		//files
		/*for($i=0;$i<=$no_of_steps;$i++){
			$model_data['files_'.$i] = $main_model->get_sub_table_step($id, 'file', $document_primary, $i);
		}
		*/
		$header_data['data'] = $header_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'view/view-tq-new', $model_data );
		if ( $action == 'rank' ) {
			$this->load->view( 'includes/ranking', $model_data );
		}
		$this->load->view( 'layout/footer' );
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
				$this->_edit_tq_main($id, $step);
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
				$this->_save_tq_main($id, $action);
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
	public function _save_tq_main($id, $action){

		include('includes/document-save-init.php');
		
		if($action == 'update'){
			//upload file
			/*if(! $this->upload->do_upload('file_upload')){
				$do_upload_file = false;	
			}else{
				$do_upload_file = true;
				$file_upload_data = $this->upload->do_upload->data('file_upload');
			}
			*/

		$uploads_folder = $this->uploads_folder;


			$image_1 = "image_1";
			//image 1 upload
			if ( ! $this->upload->do_upload($image_1))
			{
				$error = array('error' => $this->upload->display_errors());
				$do_upload_image_1 = false;
			}
			else
			{
				$image_1_data = array('upload_data' => $this->upload->data());
				$do_upload_image_1 = true;
			}


			
			//image 2 upload
			$image_2 = "image_2";
			//image 1 upload
			if ( ! $this->upload->do_upload($image_2))
			{
				$error = array('error' => $this->upload->display_errors());
				$do_upload_image_2 = false;
			}
			else
			{
				$image_2_data = array('upload_data' => $this->upload->data());
				$do_upload_image_2 = true;
			}


			//image 3 upload
			$image_3 = "image_3";
			if ( ! $this->upload->do_upload($image_3))
			{
				$error = array('error' => $this->upload->display_errors());
				$do_upload_image_3 = false;
			}
			else
			{
				$image_3_data = array('upload_data' => $this->upload->data());
				$do_upload_image_3 = true;
			}







			$redirect_link = $controller_uri.'/edit/'.$id.'/'.$current_step;
			//$redirect_link = 'user';

			//file upload
			/*if (!$do_upload_file){

				$error = $this->upload->display_errors('','');
				$update_flag = $this->_validate_upload_error($error, 'upload_error', $redirect_link);
				
			}*/

			//image 1 upload
			if (!$do_upload_image_1){

				$error = $this->upload->display_errors('','');
				$update_flag = $this->_validate_upload_error($error, 'upload_error', $redirect_link);
				
			}


			//image 2 upload
			if (!$do_upload_image_2){

				$error = $this->upload->display_errors('','');
				$update_flag = $this->_validate_upload_error($error, 'upload_error', $redirect_link);
				
			}


			//image 3 upload
			if (!$do_upload_image_3){

				$error = $this->upload->display_errors('','');
				$update_flag = $this->_validate_upload_error($error, 'upload_error', $redirect_link);
				
			}




			//upload file
			/*if($do_upload_file){

				$file_count = count($file_upload_data);

				if($file_count > 0){
					$filename = array($file_upload_data[0]['file_name']);
					$file_path = $file_upload_data[0]['file_path'];

					$document_model->update_file($model_id, $current_step, $filename);

				}
				
			}*/



			if($do_upload_image_1){

				$image_1_count = count($image_1_data);

				if($image_1_count > 0){

					$filename = $image_1_data['upload_data']['file_name'];
					$file_path = $image_1_data['upload_data']['file_path'];

					$main_model->update_value($form_id, 'upload_1_filename', $filename);

				}
				
			}



			if($do_upload_image_2){

				$image_2_count = count($image_2_data);

				if($image_2_count > 0){

					$cover_filename = $image_2_data['upload_data']['file_name'];
					$cover_file_path = $image_2_data['upload_data']['file_path'];									

					$main_model->update_value($form_id, 'upload_2_filename', $cover_filename);
					//$main_model->update_value($id, 'cover_file_path', $cover_file_path);

				}
			}


			if($do_upload_image_3){

				$image_3_count = count($image_3_data);

				if($image_3_count > 0){

					$cover_filename = $image_3_data['upload_data']['file_name'];
					$cover_file_path = $image_3_data['upload_data']['file_path'];									

					$main_model->update_value($form_id, 'upload_3_filename', $cover_filename);
					//$main_model->update_value($id, 'cover_file_path', $cover_file_path);

				}
			}


			$update_flag = true;

			if($update_flag){

				$doc_date = convert_string_to_date($doc_date);

				$main_model->update_step_0($form_id, $doc_date, $question, $image_1_caption, $image_2_caption, $image_3_caption);

				$document_model->update($model_id, $doc_title);

				$document_model->update_equipment_profile($model_id, $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, "", "", "", "", "", "");

				$this->save_document_redirect($form_id, $model_id, $no_of_steps, $current_step, $link_to);
						
			}
			
		}
	}

	/* END SAVE */

	/* EDIT */
	public function _edit_tq_main($id, $step = 1){

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
		$doc_date = convert_date_to_string($document_details->technical_query_date);
		$question = $document_details->question;

		$system = $document_details->system_id;
		$system_subcategory = $document_details->system_subcategory_id;
		$equipment_category = $document_details->equipment_category_id;
		$equipment_class = $document_details->equipment_class_id;
		$equipment_description = $document_details->equipment_description_id;


		include('includes/document-status-snippet.php');

		$file = $user_model->get_value($id, 'filename', 'file', 'document_id');

		$image_1_filename = $document_details->upload_1_filename;
		$image_2_filename = $document_details->upload_2_filename;
		$image_3_filename = $document_details->upload_3_filename;

		$image_1_caption = $document_details->upload_1_caption;
		$image_2_caption = $document_details->upload_2_caption;
		$image_3_caption = $document_details->upload_3_caption;

		$model_data['id'] = $document_id;
		$model_data['model_id'] = $document_id;
		$model_data['ref_id'] = $ref_id;
		$model_data['code'] = $code;
		$model_data['user_id'] = $user_id;

		$model_data['doc_title'] = $doc_title;
		$model_data['author'] = $author;
		$model_data['author_id'] = $author_id;
		$model_data['doc_date'] = $doc_date;

		$model_data['system_dropdown'] = $this->get_dropdown_menu($system, 'system');
		$model_data['system_subcategory_dropdown'] = $this->get_dropdown_subcategory($system, 'system', $system_subcategory);
		$model_data['equipment_category_dropdown'] = $this->get_dropdown_menu($equipment_category, 'equipment_category');
		$model_data['equipment_class_dropdown'] = $this->get_dropdown_subcategory($equipment_category, 'equipment_category', $equipment_class);
		$model_data['equipment_description_dropdown'] = $this->get_dropdown_deep_subcategory($equipment_class, 'equipment_category', $equipment_description);
		$model_data['equipment_code_value'] = $this->get_menu_detail_value($equipment_description, 'equipment_category', 'deep_subcategory', 'code');
		
		$model_data['question'] = $question;

		$model_data['file_name'] = $file;

		$model_data['image_1_filename'] = $image_1_filename;
		$model_data['image_2_filename'] = $image_2_filename;
		$model_data['image_3_filename'] = $image_3_filename;

		$model_data['image_1_caption'] = $image_1_caption;
		$model_data['image_2_caption'] = $image_2_caption;
		$model_data['image_3_caption'] = $image_3_caption;

		include('includes/document-variables.php');
		$header_data['data'] = $header_data;
		$header_data['current_page_name'] = 'Technical Query';
	
		$this->load->view('layout/header', $header_data);
		$this->load->view('tq/tq-0-new', $model_data);
		$this->load->view('layout/footer');
	}
	/* END EDIT */

}

/* End of file project_plan.php */
/* Location: ./application/controllers/technical_bulletin.php */