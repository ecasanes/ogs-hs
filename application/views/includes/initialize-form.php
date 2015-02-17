<?php
	
    $additional_form_class = isset($additional_form_class)?$additional_form_class:' ';

    $form_step_id = $controller.'-'.$current_form_step.'-form';
	$form_class = 'check-submit check-completed form-document';
    //$form_class .= $form_class.' '.$additional_form_class;
	

	$attributes	=	array( 'role'=>'form' , 'id' => $form_step_id, 'class' => $form_class );

    echo form_open_multipart($save_method.'/'.$form_id.'/'.$update_method.'/'.$current_form_step, $attributes); 
    echo form_hidden('current_step', $current_form_step);
    echo form_hidden('link_to', '');
    echo form_hidden('model_id', $model_id);
    echo form_hidden('form_id', $form_id);
    echo form_hidden('next_link', base_url($edit_method.'/'.$form_id.'/'.$next_form_step));
    echo form_hidden('page', $controller);
?>