<?php
	$controller_uri = $this->controller_uri;
	$upload_config = $this->file_config;

	$this->load->library('upload', $upload_config);
	$this->load->library('form_validation');

	$main_model = $this->main_model;
	$document_model = $this->document_model;

	$data = $this->input->post();

	$extracted_data = extract($data, EXTR_SKIP);

	$current_step = intval($current_step);
	$new_step = $current_step+1;

	$current_user_id = $this->session->userdata('session');

	$update_flag = false;
	$filename = '';

	$get_form_id = true;
	$no_of_steps = $this->no_of_steps;

	$form_id = $main_model->get_document($model_id, $get_form_id);
?>