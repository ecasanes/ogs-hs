<?php


  $id = $this->uri->segment(3);
  $edit_casefile = base_url('basic-decf/edit/'.$id);
  $cover_title = "Defect Elimination Case File";
  $edit_form = base_url('basic-decf/edit/'.$id);

  $edit_text = '<span class="glyphicon glyphicon-pencil"></span>';
  $edit_button_type = 'button';

  $edit_step_1_title = array('title' => 'Edit Case File');
  $edit_step_2_title = array('title' => 'Edit Equipment History');
  $edit_step_3_title = array('title' => 'Edit Defining the Problem');
  $edit_step_4_title = array('title' => 'Edit Root Cause Analysis');
  $edit_step_5_title = array('title' => 'Edit Possible Solution');
  $edit_step_6_title = array('title' => 'Edit Test Process');
  $edit_step_7_title = array('title' => 'Edit Results');
  $edit_step_8_title = array('title' => 'Edit Findings and Requirements');

  $edit_step_1_link = display_link($edit_form.'/1', $edit_text, $edit_button_type, $editable, $edit_step_1_title);
  $edit_step_2_link = display_link($edit_form.'/2', $edit_text, $edit_button_type, $editable, $edit_step_2_title);
  $edit_step_3_link = display_link($edit_form.'/3', $edit_text, $edit_button_type, $editable, $edit_step_3_title);
  $edit_step_4_link = display_link($edit_form.'/4', $edit_text, $edit_button_type, $editable, $edit_step_4_title);
  $edit_step_5_link = display_link($edit_form.'/5', $edit_text, $edit_button_type, $editable, $edit_step_5_title);
  $edit_step_6_link = display_link($edit_form.'/6', $edit_text, $edit_button_type, $editable, $edit_step_6_title);
  $edit_step_7_link = display_link($edit_form.'/7', $edit_text, $edit_button_type, $editable, $edit_step_7_title);
  $edit_step_8_link = display_link($edit_form.'/8', $edit_text, $edit_button_type, $editable, $edit_step_8_title);

?>
<div class="panel panel-default">
    <div class="row">
      <div class="col-xs-12 col-sm-12">
          <h2 class="text-center">Defect Elimination Report <?php echo $code; ?></h2>
          <h1 class="text-center"><?php echo $name; ?></h1>
      </div> 
    </div>
    <div class="panel-body">
    <!-- PANEL-BODY START -->
 
    
  <div class="row">
    <div class="col-xs-12">
        <div class="page-header">
          <div class="row">
            <div class="col-xs-10">
              <h4 class="content-title">1. Case File</h4>
            </div>
            <div class="col-xs-2 text-right">
              <?php echo $edit_step_1_link; ?>
            </div>
          </div>
        </div>
      </div>
  </div>  


   <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Justification for Defect Elimination:</td>
            <td><?php echo $justification_value; ?></td>
          </tr>
        </tbody>
      </table>
    </div>


  <div class="row">
    <div class="col-xs-12">
      <h4 class="content-title">User Profile</h4>
    </div>
  </div> 

  <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Username:</td>
            <td><?php echo $owner_username; ?></td>
            <td class="table-label label-large bg-grey-primary">Date:</td>
            <td><?php echo $user_date; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Case File Name:</td>
            <td><?php echo $name; ?></td>
            <td class="table-label label-large bg-grey-primary">Case File Number:</td>
            <td><?php echo $code; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary" >Brief Summary:</td>
            <td colspan="3"><?php echo $case_summary; ?></td>
          </tr>
        </tbody>
      </table>
    </div>


    <div class="row">
    <div class="col-xs-12">
      <h4 class="content-title">Asset Profile</h4>
    </div>
  </div> 

  <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Asset Type:</td>
            <td class="table-label label-large"><?php echo $asset_type_value; ?></td>
            <td class="table-label label-large bg-grey-primary">Date of Issue:</td>
            <td><?php echo $date_of_issue; ?></td>
          </tr>
          
        </tbody>
      </table>
    </div>

   
    <div class="row">
      <div class="col-xs-12">
        <div class="page-header">
          <div class="row">
            <div class="col-xs-10">
              <p class="visible-print content-title" style="size: 20px;">
              </p>
              <h4 class="content-title">Equipment Profile</h4>
            </div>
            <div class="col-xs-2 text-right">
              <?php echo $edit_step_1_link; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">System:</td>
            <td ><?php echo $system_value; ?></td>
            <td class="table-label label-large bg-grey-primary">Power Output:</td>
            <td><?php echo $equipment_power_output; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">System Subcategory:</td>
            <td><?php echo $system_subcategory_value; ?></td>
            <td class="table-label label-large bg-grey-primary">Tag Number:</td>
            <td><?php echo $equipment_tag_number; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Equipment Category:</td>
            <td><?php echo $equipment_category_value; ?></td>
            <td class="table-label label-medium bg-grey-primary">Unique ID:</td>
            <td><?php echo $equipment_unique_id; ?></td>
            
          </tr>
          <tr>
            <td class="table-label label-medium bg-grey-primary">Class:</td>
            <td><?php echo $equipment_class_value; ?></td>
            <td class="table-label label-large bg-grey-primary">Manufacturer:</td>
            <td><?php echo $equipment_manufacturer; ?></td>
            
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Description:</td>
            <td><?php echo $equipment_description_value; ?></td>
            <td class="table-label label-medium bg-grey-primary">Model:</td>
            <td><?php echo $equipment_model; ?></td>
            
            
          </tr>
          <tr>
            <td class="table-label label-medium bg-grey-primary">Code:</td>
            <td><?php echo $equipment_code_value; ?></td>
            <td class="table-label label-medium bg-grey-primary">Failed Component:</td>
            <td><?php echo $equipment_failed_component; ?></td>
          </tr>
        </tbody>
      </table>
    </div>


    
      <div class="row print-break">
        <div class="col-xs-12">
        <div class="page-header">
          <div class="row">
            <div class="col-xs-10">
              <p class="visible-print content-title" style="size: 20px;">
              </p>
              <h4 class="content-title">2. Build Equipment History (1)</h4>
            </div>
            <div class="col-xs-2 text-right">
              <?php echo $edit_step_2_link; ?>
            </div>
          </div>
        </div>
      </div>
      </div>


      <h4 class="content-title">Timeline leading to Failure</h4>


      
    <div class="row-table table-responsive">
      <table class="table table-bordered view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Event:</td>
            <td class="table-label label-large bg-grey-primary">Date:</td>
            <td class="table-label label-large bg-grey-primary">Status:</td>
          </tr>
          <?php 
            foreach($timelines as $timeline){ 
              $event = $timeline['event'];
                      //$time = $timeline['time'];
                      $date = $timeline['date'];
                      $status = $timeline['status'];
          ?>
          <tr>
            <td><?php echo $event; ?></td>
            <td><?php echo $date; ?></td>
            <td><?php echo $status; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>



    <h4 class="content-title">Failure Impact</h4>


      
    <div class="row-table table-responsive">
      <table class="table table-bordered view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-medium bg-grey-primary">Area of Impact:</td>
            <td class="table-label label-small bg-grey-primary">Consequence:</td>
            <td class="table-label label-large bg-grey-primary">Description:</td>
          </tr>
          <?php 
            foreach($failure_impacts as $impact){ 
              $area_of_impact = $impact['area_of_impact_value'];
                      $consequence = $impact['consequence_value'];
                      $description = $impact['area_of_impact_description'];
          ?>
          <tr>
            <td><?php echo $area_of_impact; ?></td>
            <td><?php echo $consequence; ?></td>
            <td><?php echo $description; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


    <h4 class="content-title">Method of Detection</h4>


     <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Notification:</td>
            <td><?php echo $detection_notification_value; ?></td>
            <td class="table-label label-large bg-grey-primary">Date:</td>
            <td><?php echo $detection_date; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Description:</td>
            <td colspan="3"><?php echo $detection_description; ?></td>
          </tr>
        </tbody>
      </table>
    </div>


    <h4 class="content-title">Failure Mode</h4>


     <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Notification:</td>
            <td colspan="3"><?php echo $failure_notification_value; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Description:</td>
            <td><?php echo $failure_description_value; ?></td>
            <td class="table-label label-large bg-grey-primary">Code:</td>
            <td><?php echo $failure_code; ?></td>
          </tr>
          
        </tbody>
      </table>
    </div>





    <!-- <div class="row-table table-responsive">
        <table class="table table-bordered view-casefile">
          <tbody>
            <tr>
              <td class="table-label label-large bg-grey-primary">Issue:</td>
              <td><?php echo $define_problem_summary; ?></td>
              
            </tr>
          </tbody>
        </table>
      </div> -->
    
    
    

      




      <div class="row print-break">
        <div class="col-xs-12">
          <div class="page-header">
          <div class="row">
            <div class="col-xs-5">
              <p class="visible-print content-title" style="size: 20px;">
              <h4 class="content-title">3. Build Equipment History (2)</h4>
            </div>
            <div class="col-xs-7 text-right">
              <?php echo $edit_step_3_link; ?>
            </div>
          </div>
        </div>
        </div>
      </div>

      
            
            
      <div class="row-table table-responsive">
        <table class="table table-bordered view-casefile">
        
       
          <?php 

                    $question_categories = array();
                    $categories_counter = 0;

                    foreach($equipment_history_categories as $category){

                        $category_name = $category->category_name;
                        $category_id = $category->category_id;
                ?>
            <tr>
              <td class="table-label label-large bg-grey-primary" colspan="2"><?php echo $category_name; ?></td>
              <td class="table-label label-small bg-grey-primary text-center">Yes/No</td>
            </tr>
            
            <?php

                        $question_counter = 1;
                        foreach($equipment_history_questions[$categories_counter] as $question){

                            $question_detail = $question->question;
                            $question_id = $question->equipment_history_question_id;
                            $answer_id = $equipment_history_answer_array[$question_id];

                     ?>
                     <tr>
              <td class="table-label label-xxs bg-grey-primary text-center"><?php echo $question_counter; ?></td>
              <td class="table-label label-full-width text-left"><?php echo $question_detail; ?></td>
              <td class="table-label label-xxxs text-center"><?php echo default_select($equipment_history_question_array[$question_id], '', 'N/A'); ?></td>
            </tr>
          <?php $question_counter++; } ?>
          <?php $categories_counter++; } ?>
       
          
        </table>
      </div>

      



      <div class="row print-break">
        <div class="col-xs-12">
          <div class="page-header">
          <div class="row">
            <div class="col-xs-6">
              <p class="visible-print content-title" style="size: 20px;">
              </p>
              <h4 class="content-title">4. Establishing Root Cause</h4>
            </div>
            <div class="col-xs-6 text-right">
              <?php echo $edit_step_7_link; ?>
            </div>
          </div>
        </div>
        </div>
      </div>


      <!-- START CONTRIBUTORY FACTOR -->

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

    <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary"><?php echo $category_name; ?></td>
          </tr>          
        </tbody>
      </table>
    </div>

    <?php $answer_counter = 1; ?>
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

    <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-xs text-center bg-grey-primary"><?php echo $answer_counter; ?></td>
            <td class="table-label label-full-width text-left">
              When asked about <?php echo $six_why_question; ?>, you stated there was an issue. Do you think the issue is significant enough to justify a “5 why” analysis?
            </td>
            <td class="table-label label-xxxs text-center"><?php echo $five_why_answer; ?></td>
          </tr>
        </tbody>
      </table>
    </div>


            

            <!-- five why questions -->
            <div class="row content no-top-margin">
              <div class="five-why-questions col-sm-12 <?php echo $five_why_display; ?>">


                <div class="row">
                  <div class="col-sm-12">
                    <div class="row-table table-responsive">
                      <table class="table table-bordered table view-casefile">
                        <tbody>
                          <tr>
                            <td class="table-label label-large text-left">
                              1st Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $why_1; ?></td>
                          </tr>
                          <tr>
                            <td class="table-label label-large text-left">
                              2nd Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $why_2; ?></td>
                          </tr>
                          <tr>
                            <td class="table-label label-large text-left">
                              3rd Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $why_3; ?></td>
                          </tr>
                          <tr>
                            <td class="table-label label-large text-left">
                              4th Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $why_4; ?></td>
                          </tr>
                          <tr>
                            <td class="table-label label-large text-left">
                              5th Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $why_5; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="row-table table-responsive no-top-margin">
                      <table class="table table-bordered table view-casefile">
                        <tbody>
                          <tr>
                            <td class="table-label label-full-width text-left">
                              Are there any other issues relating to <?php echo $six_why_question; ?> to be discussed?
                            </td>
                            <td class="table-label label-xxxs text-center"><?php echo $six_why_answer; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="row-table table-responsive <?php echo $six_why_display; ?> no-top-margin">
                      <table class="table table-bordered table view-casefile">
                        <tbody>
                          <tr>
                            <td class="table-label label-large text-left">
                              1st Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $six_why_1; ?></td>
                          </tr>
                          <tr>
                            <td class="table-label label-large text-left">
                              2nd Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $six_why_2; ?></td>
                          </tr>
                          <tr>
                            <td class="table-label label-large text-left">
                              3rd Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $six_why_3; ?></td>
                          </tr>
                          <tr>
                            <td class="table-label label-large text-left">
                              4th Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $six_why_4; ?></td>
                          </tr>
                          <tr>
                            <td class="table-label label-large text-left">
                              5th Why, can you describe why the event above happened
                            </td>
                            <td><?php echo $six_why_5; ?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- five-why-questions-->

        <!-- six-why-row-->


                

        <!-- end six-why-row -->
  <?php $answer_counter++; ?>

  <?php endforeach; ?>





  <?php


  $categories_counter++;

  ?>
  <?php

}

?>

</div>

      <!-- END CONTRIBUTORY FACTOR -->





      <h4 class="content-title">Failure Mechanism</h4>


     <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Failure Mechanism:</td>
            <td><?php echo $failure_mechanism_value; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Sub Division:</td>
            <td><?php echo $failure_mechanism_subdivision_value; ?></td>
          </tr>
          
        </tbody>
      </table>
    </div>



    <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
            <td class="table-label label-large bg-grey-primary">Conclusion:</td>
            <td><?php echo $definitive_statement; ?></td>
          </tr>
          
        </tbody>
      </table>
    </div>


    <h4 class="content-title">Failure Cause</h4>


      
    <div class="row-table table-responsive">
      <table class="table table-bordered view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-small bg-grey-primary">Failure Cause:</td>
            <td class="table-label label-small bg-grey-primary">Sub Division:</td>
            <td class="table-label label-large bg-grey-primary">Description:</td>
          </tr>
          <?php 
            foreach($failure_causes as $impact){ 
              $failure_cause_value = $impact['failure_cause_value'];
                      $sub_division_value = $impact['sub_division_value'];
                      $failure_cause_description = $impact['failure_cause_description'];
          ?>
          <tr>
            <td><?php echo $failure_cause_value; ?></td>
            <td><?php echo $sub_division_value; ?></td>
            <td><?php echo $failure_cause_description; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

      


      

    <div class="row print-break">
        <div class="col-xs-12">
          <div class="page-header">
          <div class="row">
            <div class="col-xs-6">
              <p class="visible-print content-title" style="size: 20px;">
              </p>
              <h4 class="content-title">5. The Solution</h4>
            </div>
            <div class="col-xs-6 text-right">
              <?php echo $edit_step_6_link; ?>
            </div>
          </div>
        </div>
        </div>
      </div>





      <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
            <td class="table-label label-large bg-grey-primary">Improvement Summary:</td>
            <td><?php echo $possible_solution_summary; ?></td>
          </tr>
          
        </tbody>
      </table>
    </div>







      <h4 class="content-title">Action Tracker</h4>


      
    <div class="row-table table-responsive">
        <table class="table table-bordered view-casefile">
          <tbody>
            <tr>
              <td class="table-label label-xs bg-grey-primary">Reference</td>
              <td class="table-label label-medium bg-grey-primary">Action/Process Step</td>
              <td class="table-label label-xs bg-grey-primary">Status</td>
              <td class="table-label label-xs bg-grey-primary">Owner</td>
              <td class="table-label label-xs bg-grey-primary">Due Date</td>
              <td class="table-label label-xs bg-grey-primary">Comments</td>
            </tr>

            <?php

            foreach($action_tracker as $result){ 

                          $reference = $result['reference'];
              $action_process_step = $result['action_process_step'];
              $description = $result['description'];
              $owner = $result['owner'];
              $due_date = $result['due_date'];
              $duration = $result['duration'];
              $comments = $result['comments'];


                      ?>

                      <tr>
              <td><?php echo $reference; ?></td>
              <td><?php echo $action_process_step; ?></td>
              <td><?php echo $description; ?></td>
              <td><?php echo $owner; ?></td>
              <td><?php echo $due_date; ?></td>
              <td><?php echo $comments; ?></td>
            </tr>

                      <?php } ?>
          </tbody>
        </table>
      </div>





      <h4 class="content-title">Maintenance Activity</h4>


      
    <div class="row-table table-responsive">
      <table class="table table-bordered view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-small bg-grey-primary">Maintenance Activity:</td>
            <td class="table-label label-large bg-grey-primary">Description:</td>
          </tr>
          <?php 
            foreach($maintenance_activities as $impact){ 
              $activity = $impact['maintenance_activity_value'];
                      $description = $impact['maintenance_activity_description'];
          ?>
          <tr>
            <td><?php echo $activity; ?></td>
            <td><?php echo $description; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


    <h4 class="content-title">Test Process</h4>


      
    <div class="row-table table-responsive">
      <table class="table table-bordered view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-small bg-grey-primary">Event:</td>
            <td class="table-label label-large bg-grey-primary">Owner:</td>
          </tr>
          <?php 
              foreach($responsible_parties as $party){ 
                $event = $party->event;
                $responsible = $party->responsible;
            ?>
          <tr>
            <td><?php echo $event; ?></td>
            <td><?php echo $responsible; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
















    <div class="row">
      <div class="col-xs-12">
          <div class="page-header">
          <div class="row">
            <div class="col-xs-6">
              <p class="visible-print content-title" style="size: 20px;">
              </p>
              <h4 class="content-title">6. Evaluate the Results</h4>
            </div>
            <div class="col-xs-6 text-right">
              <?php echo $edit_step_5_link; ?>
            </div>
          </div>
        </div>
        </div>
    </div>

    <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
            <td class="table-label label-large bg-grey-primary">Summary of Results:</td>
            <td><?php echo $possible_solution_summary; ?></td>
          </tr>
          
        </tbody>
      </table>
    </div>

    <h4 class="content-title">Rate of Success</h4>


    <div class="row-table table-responsive">
      <table class="table table-bordered view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Area of Impact</td>
            <td class="table-label label-large bg-grey-primary">Result</td>
          </tr>
          <?php 
              foreach($rate_of_success as $rate){ 
                $area_of_impact_value = $rate['area_of_impact_value'];
                $result_valuea = $rate['result_value'];
            ?>
          <tr>
            <td><?php echo $area_of_impact_value; ?></td>
            <td><?php echo $result_valuea; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
      

    <!-- PANEL-BODY END -->
    </div>
  
</div>
