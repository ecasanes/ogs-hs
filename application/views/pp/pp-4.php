<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success pp-step3-popover"></i></h4>
    <div class="panel-options">
        <span class="panel-code"><?php echo $document_header_name; ?></span>
    </div>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>

    	<!-- <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                        <div class="col-xs-12">
                                            <div class="page-header">
                                              <div class="row">
                                                <div class="col-xs-12">
                                                  <h4 class="step-title"> Boundaries/Scope <i class="fa fa-question-circle text-success pp-boundaries-popover"></i></h4>
                                                </div>
                                                
                                              </div>
                                                
                                            </div>
                                        </div>
                                      </div>
      
      
                                      <div class="row content">
                                          <div class="col-xs-12">
                                              <div class="form-group">
                                                  <textarea name="plan_description" id="plan_description" cols="30" rows="24" class="form-control textarea-editor medium"><?php echo $plan_description; ?></textarea>
                                              </div>
                                          </div>
                                      </div> -->
								
								
								
								
								
								
								
								
								<!-- ENABLERS -->

                            <!-- <div class="row content custom-tooltip-container generic-tooltip">
                              <div class="col-xs-12">
                                  <div class="page-header">
                                      <h4 class="step-title">Enablers <i class="fa fa-question-circle text-success pp-enablers-popover"></i></h4>
                                  </div>
                              </div>
                            </div> -->


                          






                          <div class="row content custom-tooltip-container generic-tooltip generic-large">
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title">Risks and Threats associated with the Delivery <i class="fa fa-question-circle text-success pp-risks-popover"></i></h4>
                                          </div>
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>


                                <!-- Concerns -->
                                 <div class="row content text-left hidden-xs">
                                <div class="col-sm-3">
                                  <label class="control-label">Concerns</label>
                                </div>
                                <div class="col-sm-4 text-left">
                                  <label class="control-label">Mitigating Action</label>
                                </div>
                                <div class="col-sm-3 text-left">
                                  <label class="control-label">Owner</label>
                                </div>
                                <div class="col-sm-2 text-left">
                                  <label class="control-label">Due Date on Status</label>
                                </div>
                              </div>

                              <div id="constraints-table" class="dynamic-row">
                                <?php foreach($constraints as $item){

                                    $constraints_value = $item['constraints'];
                                    $mitigating_action = $item['mitigating_action'];
                                    $due_date_on_status = $item['due_date_on_status'];
                                    $responsible_dropdown = $item['responsible_dropdown'];
                                    $responsible = $item['responsible'];

                                  ?>
                                  <div class="row content text-left">
                                    <div class="col-xs-12 visible-xs"><label class="control-label">Concerns</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <textarea class="form-control" name="constraints[]" rows="2"><?php echo $constraints_value; ?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label class="control-label">Mitigating Action</label></div>
                                    <div class="col-sm-4 text-left col-xs-12">
                                      <div class="form-group">
                                        <textarea class="form-control" name="mitigating_actions[]" rows="2"><?php echo $mitigating_action; ?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs">
                                      <label for="" class="control-label">Owner</label>
                                    </div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="alternate-select-input input-group">
                                          <input type="text" class="form-control alternate-input" name="action_parties[]" placeholder="New Owner" value="<?php echo $responsible; ?>">
                                          <select class="form-control alternate-select select2-dropdown" name="action_parties[]">
                                              <?php echo $responsible_dropdown; ?>
                                          </select>
                                          <span class="input-group-btn">
                                              <button class="btn btn-success alternate-button alt-select" type="button" title="add new">
                                                  <i class="fa fa-plus-circle fa-lg"></i>
                                              </button>
                                          </span>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label class="control-label">Due Date on Status </label></div>
                                    <div class="col-sm-2 text-left col-xs-12">
                                      <div class="form-group">
                                        <input type="text" name="due_date_on_status[]" placeholder="<?php if ($estimated_start_date == null || $estimated_start_date == ''){ echo '(No Start Date yet!)'; }else{ echo 'Select the Date'; } ?>" class="form-control start-date-dependent" value="<?php echo $due_date_on_status; ?>" <?php if ($estimated_start_date == null || $estimated_start_date == ''){ echo 'disabled'; } ?> >
                                      </div>
                                    </div>
                                    <!-- <div class="col-xs-12 visible-xs"><label class="control-label">Owner</label></div>
                                    <div class="col-sm-4 text-left col-xs-12">
                                      <select name="action_parties[]" id="document_name" class="form-control select2-dropdown"> 
                                          <option value="<?php echo $action_party; ?>"><?php echo $full_name; ?></option>
                                          <?php echo $user_option ?>
                                        </select>
                                    </div> -->
                                    

                                    <div class="row visible-xs">
                                      <div class="col-xs-12"><hr></div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </div>


                          <div class="row content custom-tooltip-container generic-tooltip hidden-xs">
                              <div class="col-sm-3">
                                <label for="" class="control-label">Specialist Requirement <i class="fa fa-question-circle text-success pp-specialist-popover"></i></label>
                              </div>
                              <div class="col-sm-4 text-left">
                                <label for="" class="control-label">Description</label>
                              </div>
                              <div class="col-sm-3 text-left">
                                <label for="" class="control-label">Owner</label>
                              </div>
                              <div class="col-sm-2">
                                <label for="" class="control-label">Due Date <i class="fa fa-question-circle text-success pp-specialist-due-date-popover"></i></label>
                                <p class="pp-estimated-start-date hidden"><?php echo $estimated_start_date; ?></p>
                                <p class="pp-end-date hidden"><?php echo $estimated_end_date; ?></p>
                              </div>
                          </div>




                          <div id="enablers-table" class="dynamic-row">
                            <?php foreach($enablers as $enabler){ 
                              $specialist_requirement = $enabler['special_requirement'];
                              $commitment_description = $enabler['commitment_summary'];
                              $due_date = $enabler['due_date'];
                              $responsible = $enabler['responsible'];
                              $responsible_dropdown = $enabler['responsible_dropdown'];
                            ?>
                                  <div class="row content text-left">
                                    <div class="col-xs-12 visible-xs">
                                      <label for="" class="control-label">Specialist Requirement <i class="fa fa-question-circle text-success pp-specialist-popover"></i></label>
                                    </div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <select class="form-control" name="specialist_requirement[]">
                                         <?php echo $specialist_requirement; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Description</label></div>
                                    <div class="col-sm-4 col-xs-12 text-left">
                                      <div class="form-group">
                                        <textarea class="form-control" name="commitment_description[]" rows="1"><?php echo $commitment_description; ?></textarea>
                                      </div>
                                    </div>

                                    <div class="col-xs-12 visible-xs">
                                      <label for="" class="control-label">Owner</label>
                                    </div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="alternate-select-input input-group">
                                          <input type="text" class="form-control alternate-input" name="responsible[]" placeholder="New Owner" value="<?php echo $responsible; ?>">
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

                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Due Date <i class="fa fa-question-circle text-success pp-specialist-due-date-popover"></i></label></div>
                                    <div class="col-sm-2 col-xs-12 text-left">
                                      <div class="form-group">
                                        <input type="text" class="form-control specialist-due-date" name="specialist_due_date[]" value="<?php echo $due_date; ?>" <?php if ($estimated_start_date == null || $estimated_start_date == ''){ echo 'disabled'; } ?> />
                                      </div>
                                    </div>

                                    <div class="row visible-xs">
                                      <div class="col-xs-12"><hr></div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </div>




                                <!-- PURPOSE -->
                                <div class="row content custom-tooltip-container generic-tooltip generic-large">
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title">Assumptions <i class="fa fa-question-circle text-success pp-assumptions-popover"></i></h4>
                                          </div>
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>



                                <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <textarea name="assumptions" id="assumptions" cols="30" rows="12" class="form-control textarea-editor medium"><?php echo $assumptions; ?></textarea>
                                        </div>
                                    </div>
                                </div>
	</div>


	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>