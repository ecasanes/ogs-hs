<?php
	$no_of_steps = $this->no_of_steps;
	$model_data['no_of_steps'] = $no_of_steps;
	$document_name = $document_details->name;
	$document_code = $document_details->code;
	if($document_name != ''){
		$document_name = ucfirst($document_name) . ' - Ref: ';
	}
	$model_data['document_header_name'] = $document_name.$document_code;
	$document_variables = $this->document_variables;
	$model_data = array_merge($model_data, $this->document_variables);
	$model_data['data'] = $model_data;

	$step_titles = $this->step_titles;
	//var_dump($step_titles);

	$model_data['step_titles'] = $step_titles;
	$model_data['step_title'] = @$step_titles[$step-1];


	//files
	$gallery_files = array();
	for ( $i=1;$i<=$no_of_steps;$i++ ) {
		$value = $main_model->get_sub_table_step( $document_id, 'file', $document_primary, $i );
		$model_data['files_'.$i] = array();
		foreach ($value as $data) {
			$item = $data->file_item_id;
			$result = $main_model->get_filename($item);
			$gallery_files[] = $result;
		}
	}

	$model_data['gallery_files'] = $gallery_files;


	//var_dump($this->document_variables);
?>