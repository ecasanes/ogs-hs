<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success step3-popover"></i></h4>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>


    	<div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                             
        <div class="col-xs-12">
            <div class="page-header">
              <div class="row">
                <div class="col-xs-12 col-sm-8">
                  <h4 class="step-title"></h4>
                </div>
                <div class="col-xs-12 col-sm-4">
                  <?php $this->load->view('includes/casefile-upload', $data); ?>
                </div>
              </div>
                
            </div>
        </div>
      </div>

      <div class="row">
      <div class="col-xs-12">
        <div class="page-header">
          <h4 class="step-title">Failure Mechanism <i class="fa fa-question-circle text-success mechanism-basic-popover"></i></span></h4>
        </div>
      </div>
    </div>


    <div class="row content">
     <label for="failure_mechanism" class="col-xs-12 col-sm-2 control-label">Failure Mechanism </label>

     <div class="col-xs-12 col-sm-4">
       <div class="form-group">
         <select class="form-control" name="failure_mechanism" id="failure_mechanism">
          <?php echo $failure_mechanism; ?>
        </select>
      </div>
    </div>

  </div>

  <div class="row content">
   <label for="failure_mechanism_subdivision" class="col-xs-12 col-sm-2 control-label">Sub Division </label>

   <div class="col-xs-12 col-sm-4">
     <div class="form-group">
       <select class="form-control" name="failure_mechanism_subdivision" id="failure_mechanism_subdivision">
        <?php echo $failure_mechanism_subdivision; ?>
      </select>
    </div>
  </div>

</div>


<?php form_hidden('summary',''); ?>




<?php if(count($equipment_history_categories) > 0): ?>

  <div class="row">
    <div class="col-xs-12">
      <div class="page-header">
        <div class="row">
          <div class="col-xs-8">
            <h4 class="step-title">Contributory Factor <i class="fa fa-question-circle text-success factor-basic-popover"></i></h4>
          </div>
        </div>

      </div>
    </div>
  </div>

<?php endif; ?>



<div id="five-why" class="">




  <?php 

  $question_categories = array();
  $categories_counter = 0;

  foreach($equipment_history_categories as $category){

    $category_name = $category->category_name;
    $category_id = $category->category_id;

    $answer_details = $answers[$category_id];

    ?>

    <div class="panel panel-info">
      <div class="panel-heading"><?php echo $category_name; ?></div>
      <div class="panel-body border-grey">


    <?php foreach($answer_details as $answer_detail): ?>
    <?php

    $answer_id = $answer_detail->equipment_history_answer_id;
    $five_why_question = $answer_detail->five_why_text;
    $six_why_question = $answer_detail->six_why_text;
    $five_why_answer = $answer_detail->five_why_answer;
    $six_why_answer = $answer_detail->six_why_answer;

    $why_1 = $answer_detail->why_1;
    $why_2 = $answer_detail->why_2;
    $why_3 = $answer_detail->why_3;
    $why_4 = $answer_detail->why_4;
    $why_5 = $answer_detail->why_5;

    $six_why_1 = $answer_detail->six_why_1;
    $six_why_2 = $answer_detail->six_why_2;
    $six_why_3 = $answer_detail->six_why_3;
    $six_why_4 = $answer_detail->six_why_4;
    $six_why_5 = $answer_detail->six_why_5;
    $six_why_6 = $answer_detail->six_why_6;

    if($why_1 != '' && $why_2 != '' && $why_3 != '' && $why_4 != '' && $why_5 != ''){
      $six_why_question_display = '';
    }else{
      $six_why_question_display = '';
    }

    if($five_why_answer != 'yes'){
      $five_why_display = 'hidden';
    }else{
      $five_why_display = '';
    }

    if($six_why_answer != 'yes'){
      $six_why_display = 'hidden';
    }else{
      $six_why_display = '';
    }

    ?>

    <div class="panel panel-default border-blue">
      <div class="panel-body">

        <!-- five-why-row-->
        <div class="row content five-why-row">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-10">
                <p class="strong">
                  <?php echo $five_why_question; ?>
                </p>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <?php echo form_hidden('equipment_history_answer_id[]', $answer_id); ?>
                  <select name="five_why_answer[<?php echo $answer_id; ?>]" id="" class="why-question form-control border-red">
                    <?php echo default_select($five_why_answer); ?>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- five why questions -->
            <div class="row content">
              <div class="five-why-questions col-sm-12 <?php echo $five_why_display; ?>">


                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-12  column-label">
                        <p class="strong">1st Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control five-why-textarea" name="why_1[<?php echo $answer_id; ?>]" rows="2"><?php echo $why_1; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12  column-label">
                        <p class="strong">2nd Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control five-why-textarea" name="why_2[<?php echo $answer_id; ?>]" rows="2"><?php echo $why_2; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12  column-label">
                        <p class="strong">3rd Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control five-why-textarea" name="why_3[<?php echo $answer_id; ?>]" rows="2"><?php echo $why_3; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12  column-label">
                        <p class="strong">4th Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control five-why-textarea" name="why_4[<?php echo $answer_id; ?>]" rows="2"><?php echo $why_4; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12  column-label">
                        <p class="strong">5th Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control five-why-textarea" name="why_5[<?php echo $answer_id; ?>]" rows="2"><?php echo $why_5; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
            <!-- five-why-questions-->

          </div>
        </div>
        <!-- end five-why-row -->

        <!-- six-why-row-->
        <div class="row content six-why-row <?php echo $six_why_question_display; ?>">
          <div class="col-sm-12">
            <div class="row">
              <div class="col-sm-10">
                <p class="strong">
                  Are there any other issues relating to <?php echo $six_why_question; ?> to be discussed?
                </p>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <select name="six_why_answer[<?php echo $answer_id; ?>]" id="" class="why-question form-control border-red">
                    <?php echo default_select($six_why_answer); ?>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- six why questions -->
            <div class="row content">
              <div class="six-why-questions col-sm-12 <?php echo $six_why_display; ?>">


                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-12  column-label">
                        <p class="strong">1st Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control" name="six_why_1[<?php echo $answer_id; ?>]" rows="2"><?php echo $six_why_1; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12  column-label">
                        <p class="strong">2nd Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control" name="six_why_2[<?php echo $answer_id; ?>]" rows="2"><?php echo $six_why_2; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12  column-label">
                        <p class="strong">3rd Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control" name="six_why_3[<?php echo $answer_id; ?>]" rows="2"><?php echo $six_why_3; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12  column-label">
                        <p class="strong">4th Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control" name="six_why_4[<?php echo $answer_id; ?>]" rows="2"><?php echo $six_why_4; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12  column-label">
                        <p class="strong">5th Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control" name="six_why_5[<?php echo $answer_id; ?>]" rows="2"><?php echo $six_why_5; ?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12  column-label">
                        <p class="strong">6th Why, can you describe why the event above happened</p>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <textarea class="form-control" name="six_why_6[<?php echo $answer_id; ?>]" rows="2"><?php echo $six_why_6; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
            <!-- six-why-questions-->

          </div>
        </div>
        <!-- end six-why-row -->


        <!-- blue border -->
      </div>
    </div>
    <!-- end blue border -->

  <?php endforeach; ?>





  <?php


  $categories_counter++;

  ?>
  </div>
</div>
  <?php

}

?>

</div>


<div class="row">
  <div class="col-xs-12">
    <h4 class="step-title">Conclusion <i class="fa fa-question-circle text-success conclusion-basic-popover"></i></span></h4>
  </div>
</div>



<div class="row">
  <div class="col-xs-12">
  <div class="form-group">
    <textarea class="form-control textarea-editor medium" name="definitive_statement" id="definitive_statement" cols="30" rows="5"><?php echo $definitive_statement; ?></textarea>
  </div>
</div>
</div>





<div class="row">
  <div class="col-xs-12">
  <div class="page-header">
    <h4 class="step-title">Failure Cause <i class="fa fa-question-circle text-success cause-basic-popover"></i></h4>
  </div>
</div>
</div>





<!-- FAILURE CAUSE 1 -->

<div id="failure-cause-table" class="dynamic-row">
  <?php 
  foreach($failure_causes as $cause){
    $failure_cause = $cause['failure_cause'];
    $failure_cause_subdivision = $cause['sub_division'];
    $failure_cause_description = $cause['failure_cause_description'];
    ?>
    <div class="failure-cause-row row">
    <label for="failure_cause_1" class="col-xs-12 col-sm-2 control-label">Failure Cause </label>
     <div class="col-xs-12 col-sm-4">
       <div class="form-group">
         <select class="form-control failure-cause" name="failure_cause[]" >
          <?php echo $failure_cause; ?>
        </select>
      </div>
    </div>
     <label for="failure_cause_1_subdivision" class="col-xs-12 col-sm-2 control-label">Sub Division </label>
   
   <div class="col-xs-12 col-sm-4">
    <div class="form-group">
     <select class="form-control failure-cause-subdivision" name="failure_cause_subdivision[]" >
      <?php echo $failure_cause_subdivision; ?>
    </select>
  </div>

</div>


  <label for="failure_cause_1_description" class="col-sm-2 col-xs-12 control-label">Description</label>
<div class="col-sm-10 col-xs-12">
  <div class="form-group">
    <textarea class="form-control failure-cause-description" name="failure_cause_description[]" cols="30" rows="3" disabled="disabled"><?php echo $failure_cause_description; ?></textarea>
  </div>
</div>
</div>
<hr>
<?php } ?>
</div>
<br>

                            
	</div>


	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>