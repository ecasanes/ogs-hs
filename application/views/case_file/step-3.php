<div class="panel panel-default">
  <?php $this->load->view('includes/initialize-form', $data); ?>
  <div class="panel-heading">
    <h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success step2-popover"></i></h4>
</div>

<div class="panel-body">
    <?php $this->load->view('includes/steps', $data); ?>
    <?php $this->load->view('includes/completion-status', $data); ?>

    <div class="row">
        <div class="col-xs-12 col-sm-8">

        </div>
        <div class="col-xs-12 col-sm-4">
            <?php $this->load->view('includes/casefile-upload', $data); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 page-header">
            <h4>Points to Consider</h4>
        </div>
    </div>



    <?php 

    $question_categories = array();
    $categories_counter = 0;

    foreach($equipment_history_categories as $category){

      $category_name = $category->category_name;
      $category_id = $category->category_id;
      ?>
      
      <div class="panel panel-info collapsed">
        <div class="panel-heading">
          <?php echo $category_name; ?>
          <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
        </div>
    </div>
    <div class="panel-body border-grey" style="display:none;">



      <?php

      $question_counter = 1;
      foreach($equipment_history_questions[$categories_counter] as $question){

        $question_detail = $question->question;
        $question_id = $question->equipment_history_question_id;
        $answer_id = $equipment_history_answer_array[$question_id];

        ?>
        <div class="row content question">
          <div class="col-sm-9">
            <?php echo $question_counter . '.  ' .$question_detail; ?>
        </div>
        <div class="col-sm-3">
            <?php echo form_hidden('equipment_history_question_id['.$question_id.']', $question_id); ?>
            <?php echo form_hidden('equipment_history_answer_id['.$question_id.']', $answer_id); ?>
            <select name="equipment_history_question[<?php echo $question_id; ?>]" class="form-control">
              <?php echo default_select($equipment_history_question_array[$question_id]); ?>
              <option value="yes">Yes</option>
              <option value="no">No</option>
          </select>
      </div>
  </div>
  <?php

  $question_counter++;

}



?>








</div>
</div>
<?php


$categories_counter++;
}



?>




</div>
<?php $this->load->view('includes/casefile-footer', $data); ?>
<?php echo form_close(); ?>
</div>
