<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success step4-basic-popover"></i></h4>
    <div class="panel-options">
      <span class="panel-code"><?php echo $document_header_name; ?></span>
    </div>
	</div>


	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>


    	<!--  <div class="row content">
                  <div class="col-xs-12">
                      <div class="page-header">
                          <div class="row">
                              <div class="col-xs-12">
                                  <h4 class="step-title">Identify and define the next steps </h4>
                              </div>
                          </div>
                          
                      </div>
                  </div>
              </div> -->



         <!--  <div class="row content hidden-xs">
           <div class="col-sm-4">
             <label for="">Type of Improvement</label>
           </div>
           <div class="col-sm-8">
             <label for="">Description</label>
           </div>
         </div>
         
                           
                 <div id="type-of-improvement-table">
         <?php
           foreach($type_of_improvements as $improvement){
             $type_of_improvement = $improvement['type_of_improvement'];
             $type_of_improvement_description = $improvement['type_of_improvement_description'];
         ?>
         <div class="row content">
           <div class="col-sm-4">
             <div class="form-group">
                 <label for="" class="control-label visible-xs">Type of Improvement</label>
                 <select class="form-control type-of-improvement" name="type_of_improvement[]">
                     <?php echo $type_of_improvement; ?>
                 </select>
             </div>
           </div>
           <div class="col-sm-8">
             <div class="form-group">
               <label for="" class="control-label visible-xs">Description</label>
               <textarea disabled="disabled" class="form-control no-resize type-of-improvement-description" name="type_of_improvement_description[]" rows="3"><?php echo $type_of_improvement_description; ?></textarea>
             </div>
           </div>
         </div>
         <hr class="visible-xs">
         <?php } ?>
                 </div> -->
                          
                           
          <div class="row content custom-tooltip-container generic-tooltip">
          <div class="col-xs-12">
              <div class="page-header">
                  <h4 class="step-title">Improvement Summary <i class="fa fa-question-circle text-success improvement-basic-popover"></i></h4>
              </div>
          </div>
        </div>
                              
	      <div class="row content">
	        
	        <div class="col-xs-12">
	                  <div class="form-group">
	                        <textarea class="form-control textarea-editor medium" name="summary" id="summary" cols="30" rows="10"><?php echo $summary; ?></textarea>
	                  </div>
	        </div>
	      </div>


<div class="row">
  <div class="col-xs-12">
                      <div class="page-header">
                        <div class="row">
                          <div class="col-xs-8">
                            <h4 class="step-title"> Action Tracker <!--<span class="tooltip-toggle help-icon">--></h4>
                          </div>
                          
                        </div>
                          
                      </div>
                  </div>
                </div>
              



                    <div class="row hidden-xs">
                      
                    
                                <div class="col-xs-1"><p class="strong">Ref</p></div>
                                <div class="col-xs-4"><p class="strong">Action/Process Step</p></div>
                                <div class="col-xs-1"><p class="strong">Status</p></div>
                                <div class="col-xs-2"><p class="strong">Owner</p></div>
                                <div class="col-xs-2"><p class="strong">Due Date</p></div>
                                <div class="col-xs-2"><p class="strong">Comments</p></div>
</div>

                            <div id="action-tracker-table" class="dynamic-row">
                               <?php foreach($action_tracker as $result){ ?>
                                <?php
                                  //var_dump($result);
                                  $reference = $result['reference'];
                                  $action_process_step = $result['action_process_step'];
                                  $status = $result['status'];
                                  $status_color = $result['status_color'];
                                  $owner = $result['owner'];
                                  $full_name = $result['full_name'];
                                  $due_date = convert_date_to_string($result['due_date']);
                                  $duration = $result['duration'];
                                  $comments = $result['comments'];
                                ?>
                                  <div class="row content">
                                    <div class="col-xs-12 col-sm-12">
                                    	<div class="col-sm-1 no-padding padding-of-2px">
                                      <div class="form-group">
                                        <label for="" class="control-label visible-xs">Ref</label>
                                        <input type="text" class="form-control small-font" name="reference[]" value="<?php echo $reference; ?>" readonly>

                                      </div>
                                    </div>
                                    <div class="col-sm-4 no-padding padding-of-2px">
                                      <div class="form-group">
                                        <label for="" class="control-label visible-xs">Action/Process Step</label>
                                        <input type="text" class="form-control " name="action_process_step[]" value="<?php echo $action_process_step; ?>">
                                      </div>
                                    </div>
                                    <div class="col-sm-1 no-padding padding-of-2px">
                                      <div class="form-group">
                                        <label for="" class="control-label visible-xs">Status</label>
                                        <select class="form-control color-select <?php echo $status_color ?>" name="action_tracker_status[]">
                                          <?php echo $status; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-2 no-padding padding-of-2px">
                                      <div class="form-group">
                                        <label for="" class="control-label visible-xs">Owner</label>
                                        <select name="owner[]" id="document_name" class="form-control select2-dropdown"> 
                                          <option value=" <?php echo $owner; ?>"><?php echo $full_name; ?></option> 
                                          <?php echo $user_option ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-sm-2 no-padding padding-of-2px">
                                      <div class="form-group">
                                        <label for="" class="control-label visible-xs">Due Date</label>
                                        <input type="text" class="form-control datepicker" name="due_date[]" value="<?php echo $due_date; ?>">
                                      </div>
                                    </div>
                                    <div class="col-sm-2 no-padding padding-of-2px">
                                      <div class="form-group">
                                        <label for="" class="control-label visible-xs">Comments</label>
                                        <input type="text" class="form-control " name="comments[]" value="<?php echo $comments; ?>">
                                      </div>
                                    </div>
                                    <div class="col-sm-2 no-padding padding-of-2px">
                                      <div class="form-group">
                                        <input type="hidden" class="form-control no-padding ref-code" name="ref_code[]" value="<?php echo $ref_code; ?>">
                                      </div>
                                    </div>
                                    </div>
                                  </div>
                                  <hr class="visible-xs">
                                  <?php } ?>
                              </div>



                            
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="page-header">
                                      <h4 class="step-title">Maintenance Activity </h4>
                                  </div>
                              </div>
                              </div>
                              

                          

                          <div id="maintenance-activity-table" class="dynamic-row">
                            <?php 

                            foreach($maintenance_activities as $activity){

                              $maintenance_activity_dropdown = $activity['maintenance_activity'];
                              $maintenance_activity_description = $activity['maintenance_activity_description'];

                            ?>

                            <div class="row-activity row">
                                  <label for="maintenance_activity" class="col-xs-12 col-sm-2 control-label">Maintenance Activity </label>
                                


                                 <div class="col-xs-12 col-sm-4">
                                   <div class="form-group">
                                     <select class="form-control maintenance-activity-item" name="maintenance_activity[]">
                                          <?php echo $maintenance_activity_dropdown; ?>
                                      </select>
                                   </div>
                                 </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <textarea class="form-control maintenance-activity-description" name="maintenance_activity_description[]" cols="30" rows="3" disabled="disabled"><?php echo $maintenance_activity_description; ?></textarea>
                                  </div>
                                </div>
                            </div>
                            <hr class="visible-xs">
                            <?php } ?>

                          </div>
                          <br>






                <div class="row content">
      <div class="col-xs-12">
        <div class="page-header">
          <div class="row">
            <div class="col-xs-7">
              <h4 class="step-title">Test Process</h4>
            </div>

          </div>

        </div>
      </div>
    </div>



    <div class="row content hidden-xs">
      <div class="col-sm-6">
        <label for="" class="control-label">Event</label>
      </div>
      <div class="col-sm-6">
        <label for="" class="control-label">Owner</label>
      </div>
    </div>


    <div id="responsible-party-table" class="dynamic-row">
      <?php
      foreach($responsible_parties as $party){
        $event = $party['event'];
        $responsible = $party['responsible'];
        $responsible_dropdown = $party['responsible_dropdown'];
        ?>
        <div class="row content">
          <div class="col-sm-6 col-xs-12 tinymce-textarea">
            <div class="form-group form-group-required">
              <label for="" class="control-label visible-xs">Event</label>
              <textarea class="form-control textarea-editor xs" name="event[]" rows="3"><?php echo $event; ?></textarea>
            </div>
          </div>
          <div class="col-sm-6 col-xs-12 tinymce-textarea">
            <div class="form-group form-group-required">
              <label for="" class="control-label visible-xs">Owner</label>
              <div class="alternate-select-input input-group">
                  <input type="text" class="form-control alternate-input" name="responsible[]" placeholder="Owner" value="<?php echo $responsible; ?>">
                  <select class="form-control alternate-select select2-dropdown" name="responsible[]">
                      <?php echo $responsible_dropdown; ?>
                  </select>
                  <span class="input-group-btn">
                      <button class="btn btn-success alternate-button alt-select" type="button" title="add new">
                          <i class="fa fa-plus-circle fa-lg"></i>
                      </button>
                  </span>
              </div>
            </div>
          </div>
        </div>
        <hr class="visible-xs">
        <?php } ?>
      </div>


                        </div>










  <?php $this->load->view('includes/casefile-footer', $data); ?>

	<?php echo form_close(); ?>
</div>