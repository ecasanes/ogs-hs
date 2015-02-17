<?php

	$document_status_controller = $this->uri->segment(1);

	$status_user_id = $this->session->userdata('session');
	$current_user_name = $user_model->get_full_name($status_user_id);

	//document status
	$reviewed_by = $document_details->reviewed_by;
	$approved_by = $document_details->approved_by;
	$published_by = $document_details->published_by;

	$reviewed_by_name = $user_model->get_full_name($reviewed_by);
	$approved_by_name = $user_model->get_full_name($approved_by);
	$published_by_name = $user_model->get_full_name($published_by);

	$reviewed_date = convert_date_to_string($document_details->reviewed_date);
	$approved_date = convert_date_to_string($document_details->approved_date);
	$published_date = convert_date_to_string($document_details->published_date);

	$document_status = $document_details->document_status;
	$document_status_value = strtolower($this->get_menu_detail_value($document_status, 'document_status', 'menu', 'name'));

	if($document_status_value == 'reviewed'){

		$reviewed_state = '';
		$approved_state = 'hidden';

		$approved_by = $status_user_id;
		$approved_by_name = $current_user_name;
		$published_by = $status_user_id;
		$published_by_name = $current_user_name;

	}else if(stripos($document_status_value, 'approved') !== false){

		$reviewed_state = 'hidden';
		$approved_state = '';

		$reviewed_by = $status_user_id;
		$reviewed_by_name = $current_user_name;
		$published_by = $status_user_id;
		$published_by_name = $current_user_name;

	}else{

		$reviewed_state = 'hidden';
		$approved_state = 'hidden';

		$reviewed_by = $status_user_id;
		$reviewed_by_name = $current_user_name;
		$approved_by = $status_user_id;
		$approved_by_name = $current_user_name;
		$published_by = $status_user_id;
		$published_by_name = $current_user_name;
	}

	//document status
	$model_data['reviewed_by'] = $reviewed_by;
	$model_data['approved_by'] = $approved_by;
	$model_data['published_by'] = $published_by;

	$model_data['reviewed_by_name'] = $reviewed_by_name;
	$model_data['approved_by_name'] = $approved_by_name;
	$model_data['published_by_name'] = $published_by_name;

	$model_data['reviewed_date'] = $reviewed_date;
	$model_data['approved_date'] = $approved_date;
	$model_data['published_date'] = $published_date;

	if($document_status_controller == 'project-plan'){
		$model_data['document_status'] = $this->get_dropdown_menu($document_status, 'document_status', 'menu', true, false, '- Select -', '2');
	}else{
		$model_data['document_status'] = $this->get_dropdown_menu($document_status, 'document_status', 'menu', true, false, '- Select -', '1');
	}
	
	$model_data['document_status_value'] = $document_status_value;

	$model_data['reviewed_state'] = $reviewed_state;
	$model_data['approved_state'] = $approved_state;

	$model_data['current_user_id'] = $status_user_id;
	$model_data['current_user_name'] = $current_user_name;

?>