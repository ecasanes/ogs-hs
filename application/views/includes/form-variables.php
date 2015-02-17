<?php 

  $required_at_least = 'data-bv-message="at least 1 is required"';

  $controller = $this->uri->segment(1,0);
  $method = $this->uri->segment(2,0);
  $form_id = $this->uri->segment(3,0);
  $current_form_step = $this->uri->segment(4,0);
  $next_form_step = $current_form_step+1;

  $model_id = $form_id;

  $edit_method = $controller.'/edit';
  $delete_method = $controller.'/delete';
  $save_method = $controller.'/save';

  if($controller == 'case-file' && $current_form_step == 1){
    $additional_form_class = 'build history';
  }

  $update_method = 'update';

?>