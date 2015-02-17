<?php

	$uploads_folder = $this->uploads_folder;

	$absolute_path = FCPATH.$uploads_folder."\\";

	echo '<pre>';
	var_dump($_FILES);
	echo '</pre>';

	if ( ! $this->upload->do_multi_upload('userfile')){

		$error = $this->upload->display_errors('','');

		$redirect_link = $controller_uri.'/edit/'.$id.'/'.$current_step;

		$update_flag = $this->_validate_upload_error($error, 'upload_error', $redirect_link);

		echo 'fail';
		
		
	}else{

		$upload_info = $this->upload->get_multi_upload_data('userfile');

		$filenames = array();
		$file_paths = array();

		foreach($upload_info as $upload_data){
			
			$filename = $upload_data['file_name'];
			$file_path = $upload_data['file_path'];
			//$orig_name = $upload_data['orig_name'];

			//unlink($absolute_path.$client_name);

			$filenames[] = $filename;
			$file_paths[] = $file_path;

			//echo $filename;
			echo 'not fail';
		}

		$update_flag = true;	

		/*echo $current_step;
		echo '<br>';
		echo $code;
		echo '<br>';*/
		

		$form_model->update_file($code, $current_step, $model_id, $filenames, $file_paths);

	}

?>