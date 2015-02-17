<?php 

  $required_at_least = 'data-bv-message="at least 1 is required"';

  $controller = $this->uri->segment(1,0);
  $method = $this->uri->segment(2,0);
  $form_id = $this->uri->segment(3,0); //main

  //echo $model_id.'t';
  //echo $form_id.'s';

  $edit_method = $controller.'/edit';
  $delete_method = $controller.'/delete';
  $save_method = $controller.'/save';

 

  $update_method = 'update';
?>