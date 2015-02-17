<?php


	$id = $this->uri->segment(3);
	$edit_casefile = base_url('case-file/edit/'.$id);
	$cover_title = "Defect Elimination Case File";
	$edit_form = base_url('case-file/edit/'.$id);

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
          <h2><center>Defect Elimination Report <?php echo $code; ?></center></h2>
          <h1><center><?php echo $name; ?></center></h1>
      </div> 
    </div>

	<div class="panel-body">
		
		<div class="col-xs-12">
        <div class="page-header">
          <div class="row">
            <div class="col-xs-10">
              <h4 class="content-title">Case Profile</h4>
            </div>
            <div class="col-xs-2 text-right">
              <?php echo $edit_step_1_link; ?>
            </div>
          </div>
        </div>
      </div>
   
    
            
    <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Case File Name:</td>
            <td><?php echo $name; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Case File Number:</td>
            <td><?php echo $code; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Summary:</td>
            <td><?php echo $case_summary; ?></td>
          </tr>
        </tbody>
      </table>
    </div>

   
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
    
    <div class="row-table table-responsive">
      <table class="table table-bordered table view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">System:</td>
            <td colspan="3"><?php echo $system_value; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">System Subcategory:</td>
            <td colspan="3"><?php echo $system_subcategory_value; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Equipment Category:</td>
            <td><?php echo $equipment_category_value; ?></td>
            <td class="table-label label-medium bg-grey-primary">Class:</td>
            <td><?php echo $equipment_class_value; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Description:</td>
            <td><?php echo $equipment_description_value; ?></td>
            <td class="table-label label-medium bg-grey-primary">Code:</td>
            <td><?php echo $equipment_code_value; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Tag Number:</td>
            <td><?php echo $equipment_tag_number; ?></td>
            <td class="table-label label-medium bg-grey-primary">Unique ID:</td>
            <td><?php echo $equipment_unique_id; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Manufacturer:</td>
            <td><?php echo $equipment_manufacturer; ?></td>
            <td class="table-label label-medium bg-grey-primary">Model:</td>
            <td><?php echo $equipment_model; ?></td>
          </tr>
          <tr>
            <td class="table-label label-large bg-grey-primary">Power Output:</td>
            <td><?php echo $equipment_power_output; ?></td>
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
              <h4 class="content-title">1. Summary of Events</h4>
            </div>
            <div class="col-xs-2 text-right">
              <?php echo $edit_step_2_link; ?>
            </div>
          </div>
        </div>
      </div>
      </div>
    <div class="row-table table-responsive">
        <table class="table table-bordered view-casefile">
          <tbody>
            <tr>
              <td class="table-label label-large bg-grey-primary">Issue:</td>
              <td><?php echo $define_problem_summary; ?></td>
              
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
              <h4 class="content-title">2. Equipment History</h4>
            </div>
            <div class="col-xs-2 text-right">
              <?php echo $edit_step_2_link; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <h4 class="content-title">Timeline</h4>


      
    <div class="row-table table-responsive">
      <table class="table table-bordered view-casefile">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary">Event:</td>
            <td class="table-label label-small bg-grey-primary">Date:</td>
            <td class="table-label label-small bg-grey-primary">Status:</td>
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
    

      




      <div class="row print-break">
        <div class="col-xs-12">
          <div class="page-header">
          <div class="row">
            <div class="col-xs-5">
              <p class="visible-print content-title" style="size: 20px;">
              <h4 class="content-title">3. Equipment History</h4>
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
        
          <tbody>
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
              <td class="table-label label-xxl text-left"><?php echo $question_detail; ?></td>
              <td class="table-label label-xxxs text-center"><?php echo default_select($equipment_history_question_array[$question_id],'','N/A'); ?></td>
            </tr>
          <?php $question_counter++; } ?>
          <?php $categories_counter++; } ?>
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
              <h4 class="content-title">4. Results from Root Cause Analysis</h4>
            </div>
            <div class="col-xs-6 text-right">
              <?php echo $edit_step_7_link; ?>
            </div>
          </div>
        </div>
        </div>
      </div>


      
      
      <div class="row-table table-responsive">
        <table class="table table-bordered view-casefile">
          <tbody>
            <tr>
              <td class="table-label bg-grey-primary">Findings and Summary</td>
            </tr>
            <tr>
              <td><?php echo $evaluate_results_summary; ?></td>
            </tr>
            <tr>
              <td class="table-label bg-grey-primary">Reccomendations to prevent recurrence and to detect earlier</td>
            </tr>
            <tr>
              <td><?php echo $recommendations; ?></td>
            </tr>
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
              <h4 class="content-title">5. Test Process</h4>
            </div>
            <div class="col-xs-6 text-right">
              <?php echo $edit_step_6_link; ?>
            </div>
          </div>
        </div>
        </div>
      </div>


    
      <div class="row-table table-responsive">
        <table class="table table-bordered view-casefile">
          <tbody>
            <?php 
              foreach($responsible_parties as $party){ 
                $event = $party->event;
                $responsible = $party->responsible;
            ?>
            <tr>
              <td class="table-label label-medium bg-grey-primary">Event</td>
              <td><?php echo $event; ?></td>
            </tr>
            <tr>
              <td class="table-label label-medium bg-grey-primary">Responsible</td>
              <td><?php echo $responsible; ?></td>
            </tr>
            <tr>
              <td class="table-label label-medium bg-grey-primary">Pass or Fail</td>
              <td><?php echo $pass_fail; ?></td>
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
              <h4 class="content-title">6. Next Steps</h4>
            </div>
            <div class="col-xs-6 text-right">
              <?php echo $edit_step_5_link; ?>
            </div>
          </div>
        </div>
        </div>
    </div>
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
		

    <div class="row print-break">
        <div class="col-xs-12">
          <div class="page-header">
          <div class="row">
            <div class="col-xs-6">
              <p class="visible-print content-title" style="size: 20px;">
              </p>
              <h4 class="content-title">7. Image Gallery</h4>
            </div>
            <div class="col-xs-6 text-right">
              <?php echo $edit_step_6_link; ?>
            </div>
          </div>
        </div>
        </div>
      </div>


		<?php
			$attributes = array('class' => 'email', 'id' => 'myform');
			echo form_open('case-file/remove-file', $attributes);
		?>
	
		<?php

      $gallery_title = "Additional Files";
      $gallery_result = $gallery_files;

      $gallery_data = array(
          'gallery_title' => $gallery_title,
          'gallery_result' => $gallery_result
        );

      $this->load->view('includes/file-gallery-snippet', $gallery_data); 

    ?>
					


		<?php echo form_close(); ?>

	</div>
</div>