<div class="panel panel-default">
  <?php $this->load->view('includes/initialize-form', $data); ?>
  <div class="panel-heading">
    <h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success step1-basic-popover"></i></h4>
    <div class="panel-options">
      <span class="panel-code"><?php echo $document_header_name; ?></span>
    </div>
  </div>

  <div class="panel-body">
    <?php $this->load->view('includes/steps', $data); ?>
    <?php $this->load->view('includes/completion-status', $data); ?>



    <?php 

    $question_categories = array();
    $categories_counter = 0;

    /*echo '<pre>';
    var_dump($equipment_history_questions);
    echo '</pre>';*/

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

            $answer_details = $equipment_history_question_details_array[$question_id];
            $start_date = convert_date_to_string($answer_details['start_date'], true);
            $end_date = convert_date_to_string($answer_details['end_date'], true);
            if(isset($answer_details['duration'])){
              $duration = explode(' ',$answer_details['duration']);
              $duration_no = $duration[0];
              $duration_days = $duration[1];
            }else{
              $duration_no = '';
              $duration_days = '';
            }
            
            
            $field_type = $question->field_type;

            



            ?>
            <?php if($field_type == 'duration'): ?>
              <div class="row content question">
                <?php echo form_hidden('equipment_history_question_id['.$question_id.']', $question_id); ?>
                  <?php echo form_hidden('equipment_history_answer_id['.$question_id.']', $answer_id); ?>
                  <?php echo form_hidden('equipment_history_question['.$question_id.']', ''); ?>
                <div class="col-sm-6">
                  <?php echo $question_counter . '.  ' .$question_detail; ?>
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control number-only" name="duration_number[<?php echo $question_id; ?>]" value="<?php echo $duration_no; ?>">
                </div>
                <div class="col-sm-3">
                  <select name="duration_days[<?php echo $question_id; ?>]" id="" class="form-control">
                        <option value="Days" <?php if($duration_days == 'Days'){ echo 'selected';} ?>> Day / s </option>
                        <option value="Weeks" <?php if($duration_days == 'Weeks'){ echo 'selected';} ?>> Week / s </option>
                        <option value="Months" <?php if($duration_days == 'Months'){ echo 'selected';} ?>> Month / s </option>
                    </select>
                </div>
              </div>
            <?php elseif($field_type == 'start_and_end_date'): ?>
              <div class="row content question">
                <?php echo form_hidden('equipment_history_question_id['.$question_id.']', $question_id); ?>
                  <?php echo form_hidden('equipment_history_answer_id['.$question_id.']', $answer_id); ?>
                  <?php echo form_hidden('equipment_history_question['.$question_id.']', ''); ?>
                <div class="col-sm-6">
                  <?php echo $question_counter . '.  ' .$question_detail; ?>
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control datepicker" name="start_date[<?php echo $question_id; ?>]" value="<?php echo $start_date; ?>">
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control datepicker" name="end_date[<?php echo $question_id; ?>]" value="<?php echo $end_date; ?>">
                </div>
               
              </div>
            <?php else: ?>
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
            <?php endif; ?>
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
