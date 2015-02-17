<?php

	$uploads_folder = $this->uploads_folder;

	$absolute_path = FCPATH.$uploads_folder."\\";

	$filenames = array();
	$errors = array();

	/*$files = $_FILES;
    $cpt = count($_FILES['userfile']['name']);
    for($i=0; $i<$cpt; $i++)
    {

    	$single_name = $files['userfile']['name'][$i];

    	$single_filename = get_filename($single_name);
    	$single_filename = generate_slug($single_filename);
    	$single_extension = get_filename_extension($single_name);

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

    	$this->upload->initialize($upload_config);
    	

    	if ( ! $this->upload->do_upload())
		{
			if($single_name != ''){
				$errors[] = array(
					'filename' => $single_new_name,
					'error' => $this->upload->display_errors('','')
				);
			}
			
			$filenames[$i] = '';
		}else{
			$upload_data = $this->upload->data();
			$filenames[$i] = $upload_data['file_name'];
		}

	}


	$update_flag = true;	
	
	$document_model->update_file($id, $current_step, $filenames);

	if(count($errors)>0){
		$error_message = '';
		foreach($errors as $error){
			if($error['filename']){
				$error_message = '<p>'.$error_message.' &nbsp; '.$error['filename'].' - '.$error['error'].'</p>';
			}
		}
	$this->session->set_flashdata('upload_error',$error_message);
	}*/


	//SAVE FILE WITH FILE MANAGER

	$update_flag = true;

	$document_model->update_file_item($id, $current_step, $file_item_id);

?>