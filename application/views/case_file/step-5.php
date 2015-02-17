<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success cf-step4-popover"></i></h4>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>


    	<div class="row content">
          <div class="col-xs-12">
              <div class="page-header">
                  <div class="row">
                      <div class="col-xs-12 col-sm-8">
                          <h4 class="step-title">Identify and define the next steps </h4>
                      </div>
                      <div class="col-xs-12 col-sm-4">
                          <?php $this->load->view('includes/casefile-upload', $data); ?>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
                          
                           
          <div class="row content custom-tooltip-container generic-tooltip">
          <div class="col-xs-12">
              <div class="page-header">
                  <h4 class="step-title">Improvement Summary <i class="fa fa-question-circle text-success cf-improvement-popover"></i></h4>
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





          



          <div class="row content">
                <div class="col-xs-12">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-xs-7">
                                <h4 class="step-title">Benefits Breakdown </h4>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
      
         <div class="row content">
            <div class="col-sm-4">
              <label for="">Item</label>
            </div>
            <div class="col-sm-8">
              <label for="">Description</label>
            </div>
          </div>

        
        <div id="benefit-breakdown-table">
          <?php
            foreach($benefit_breakdown_items as $item){
              $desc = $item['text'];
              $item = $item['item_description'];
          ?>
          <div class="row content">
            <div class="col-sm-4">
              <div class="form-group">
                  <select class="form-control" name="benefit_item[]">
                      <?php echo $item; ?>
                  </select>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-group">
                <textarea class="form-control" name="benefit_description[]" rows="1"><?php echo $desc; ?></textarea>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>




        <div class="row content text-left">
                <div class="col-sm-4">
                  <p class="strong">Dependencies/Specialist Requirement</p>
                </div>
                <div class="col-sm-8 text-left">
                  <p class="strong">Description</p>
                </div>
              </div>



      <div id="enablers-table" class="dynamic-row">
        <?php foreach($enablers as $enabler){ 
					$specialist_requirement = $enabler['special_requirement'];
					$commitment_description = $enabler['commitment_summary'];
				?>
              <div class="row content text-left">
                <div class="col-sm-4">
                  <div class="form-group">
                    <select class="form-control" name="specialist_requirement[]">
	                   <?php echo $specialist_requirement; ?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-8 text-left">
                  <div class="form-group">
                    <textarea class="form-control" name="commitment_description[]" rows="1"><?php echo $commitment_description; ?></textarea>
                  </div>
                </div>
              </div>
            <?php } ?>
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


                              
                            
	</div>
	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>