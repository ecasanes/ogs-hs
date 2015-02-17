<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success pp-step4-popover"></i></h4>
    <div class="panel-options">
        <span class="panel-code"><?php echo $document_header_name; ?></span>
    </div>
	</div>


	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>


    	<div id="failure-mode-tooltip" class="row content custom-tooltip-container">
        <p class="pp-estimated-start-date hidden"><?php echo $estimated_start_date; ?></p>
        <p class="pp-end-date hidden"><?php echo $estimated_end_date; ?></p>
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title"> Deliverables <i class="fa fa-question-circle text-success pp-deliverables-popover"></i></h4>
                                          </div>
                                          <div class="col-xs-4">
                                          </div>
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>
                                

                                <div class="row content text-left hidden-xs">
                                  <div class="col-xs-3"><label for="" class="control-label">Detailed Description of Deliverables, Events & Activities</label></div>
                                  <div class="col-xs-2"><label for="" class="control-label">Location</label></div>
                                  <div class="col-xs-3"><label for="" class="control-label">Owner</label></div>
                                  <!-- <div class="col-xs-3"><label for="" class="control-label">Duration</label></div> -->
                                  <div class="col-xs-4"><label for="" class="control-label">Date Range</label></div>
                                </div>
                                
                                
                                <div id="deliverable-table" class="dynamic-row">
                                <?php foreach($deliverables as $deliverable){ ?>
                                <?php
                                  $deliverables_description = $deliverable['description'];
                                  $start_date = $deliverable['start_date'];
                                  $due_date = $deliverable['due_date'];
                                  $deliverable_duration_number = $deliverable['deliverable_duration_number'];
                                  $deliverable_duration_days = $deliverable['deliverable_duration_days'];
                                  $location = $deliverable['location'];
                                  $responsible = $deliverable['responsible'];
                                  $responsible_dropdown = $deliverable['responsible_dropdown'];

                                ?>
                                  <div class="row content">
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Detailed Description of Deliverables</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <textarea class="form-control" name="deliverables_description[]" id="" cols="20" rows="1"><?php echo $deliverables_description; ?></textarea>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Location</label></div>
                                    <div class="col-sm-2 col-xs-12">
                                      <input class="form-control" type="text" name="location[]" value="<?php echo $location; ?>">
                                    </div>

                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Owner</label></div>
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
                                    
                                    <!-- <div class="col-xs-12 visible-xs"><label for="" class="control-label">Duration</label></div>
                                    <div class="col-xs-12 col-sm-3">
                                        <div class="input-group">
                                            <input type="text" size="9" id="deliverable_duration" name="deliverable_duration_number[]" class="form-control number-only" value="<?php echo $deliverable_duration_number; ?>">
                                            <span class="input-group-addon"> - </span>
                                            <select name="deliverable_duration_days[]" id="" class="form-control">
                                                <option value="Days" <?php if($deliverable_duration_days == 'Days'){ echo 'selected';} ?>> Day / s </option>
                                                <option value="Weeks" <?php if($deliverable_duration_days == 'Weeks'){ echo 'selected';} ?>> Week / s </option>
                                                <option value="Months" <?php if($deliverable_duration_days == 'Months'){ echo 'selected';} ?>> Month / s </option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Date Range</label></div>
                                    <div class="col-sm-4 col-xs-12">
                                      <div class="input-group">
                                        <input id="" type="text" class="deliverable_start_date_range form-control" name="start_date_deliverable[]" placeholder="start date" value="<?php echo $start_date; ?>">
                                        <span class="input-group-addon">to</span>
                                        <input id="" type="text" class="deliverable_end_date_range form-control" name="end_date_deliverable[]" placeholder="end date" value="<?php echo $due_date; ?>">
                                      </div>
                                    </div>
                                    <div class="row visible-xs">
                                      <div class="col-xs-12"><hr></div>
                                    </div>
                                  </div>
                                <?php } ?>
                                </div>



                                <!-- QUALITY CONTROL -->
                                <!-- <div class="row content custom-tooltip-container generic-tooltip generic-large">
                                  <div class="custom-tooltip">
                                    
                                    <p>Think about what measures need to be taken, do not leave quality issues to chance, ensure any risks relating to quality of workmanship are dealt with</p>

                                  </div>
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-8">
                                            <h4 class="step-title">Summary<span class="tooltip-toggle help-icon"></span></h4>
                                          </div>
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div> -->


                            <!-- <div class="row content custom-tooltip-container generic-tooltip generic-medium">
                              <div class="custom-tooltip">
                                <p>explain what a pass or failure would look like, is a partial improvement acceptable? </p>
                              </div>
                              <div class="col-xs-12">
                                  <div class="page-header">
                                      <h4 class="step-title">Summary <span class="tooltip-toggle help-icon"></span> </h4>
                                  </div>
                              </div>
                            </div> -->
                          
                              
                              <!-- <div class="row content">
                                <div class="col-xs-12">
                                          <div class="form-group form-group-required">
                                                <textarea class="form-control textarea-editor medium" name="summary" id="summary" cols="30" rows="25"><?php echo $summary; ?></textarea>
                                          </div>
                                </div>
                              </div> -->


                        <!-- EXPECTATION TITLES -->
                        <!-- <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title"> Expectation <i class="fa fa-question-circle text-success pp-expectation-popover"></i></h4>
                                          </div>
                                          
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>
                        
                        
                        
                              <div class="row content text-left hidden-xs">
                                <div class="col-xs-2"><label for="" class="control-label">Supplier</label></div>
                                <div class="col-xs-2"><label for="" class="control-label">Input</label></div>
                                <div class="col-xs-4 no-padding"><label for="" class="control-label">Process/Deliverable</label></div>
                                <div class="col-xs-2 no-padding"><label for="" class="control-label">Output</label></div>
                                <div class="col-xs-2 no-padding"><label for="" class="control-label">Receiver</label></div>
                              </div> -->

                              <!-- Expectation-->
                              <!-- <div id="expectation-table" class="dynamic-row with-padding">
                                <?php foreach($expectations as $expectation){ ?>
                                <?php
                                  $supplier = $expectation->supplier;
                                  $input = $expectation->input;
                                  $process_deliverable = $expectation->process_deliverable;
                                  $output = $expectation->output;
                                  $receiver = $expectation->receiver;
                                ?>
                                  <div class="row content">
                                    <div class="col-xs-12 no-padding padding-of-2px visible-xs"><label for="" class="control-label">Supplier</label></div>
                                    <div class="col-sm-2 no-padding padding-of-2px">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="supplier[]" value="<?php echo $supplier; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 no-padding padding-of-2px visible-xs"><label for="" class="control-label">Input</label></div>
                                    <div class="col-sm-2 no-padding padding-of-2px col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="input[]" value="<?php echo $input; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 no-padding padding-of-2px visible-xs"><label for="" class="control-label">Process/Deliverable</label></div>
                                    <div class="col-sm-4 no-padding padding-of-2px col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="process_deliverable[]" value="<?php echo $process_deliverable; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 no-padding padding-of-2px visible-xs"><label for="" class="control-label">Output</label></div>
                                    <div class="col-sm-2 no-padding padding-of-2px col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="output[]" value="<?php echo $output; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 no-padding padding-of-2px visible-xs"><label for="" class="control-label">Receiver</label></div>
                                    <div class="col-sm-2 no-padding padding-of-2px col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="receiver[]" value="<?php echo $receiver; ?>">
                                      </div>
                                    </div>
                                    <div class="row visible-xs">
                                      <div class="col-xs-12 no-padding"><hr></div>
                                    </div>
                                  </div>
                                  
                                <?php } ?>
                              </div> -->


                      

      
                        <!-- PROCESS STEPS-->
                        <!-- <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                  <div class="custom-tooltip">
                                    <p>
                                      
                                    </p>
                                  </div>
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-8">
                                            <h4 class="step-title"> Process Steps <span class="tooltip-toggle help-icon"></span></h4>
                                          </div>
                                          
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>



                            <div class="row content">
                                <div class="col-sm-7">
                                  <label for="">Event</label>
                                </div>
                                <div class="col-sm-5">
                                  <label for="">Responsible</label>
                                </div>
                            </div>

                            
                            <div id="process-step-table" class="dynamic-row">
                              <?php
                                foreach($process_step as $step){
                                  $event = $step->event;
                                  $responsible = $step->responsible;
                              ?>
                              <div class="row content">
                                <div class="col-sm-7">
                                  <div class="form-group form-group-required">
                                        <textarea class="form-control textarea-editor small" name="process_event[]" cols="30" rows="25"><?php echo $event; ?></textarea>
                                  </div>
                                </div>
                                <div class="col-sm-5">
                                  <div class="form-group form-group-required">
                                        <textarea class="form-control textarea-editor small" name="process_responsible[]" cols="30" rows="25"><?php echo $responsible; ?></textarea>
                                  </div>
                                </div>
                              </div>
                              <?php } ?>
                            </div> -->



                             <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                  <div class="custom-tooltip">
                                    <p>
                                      
                                    </p>
                                  </div>
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title"> Associated Activities <!--<span class="tooltip-toggle help-icon">--></span></h4>
                                          </div>
                                         
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>

                              

                              <div class="row content text-left">
                                <div class="col-sm-5 hidden-xs"><label for="" class="control-label">Operational Requirements</label></div>
                                <div class="col-sm-3 hidden-xs"><label for="" class="control-label">Owner</label></div>
                                <div class="col-sm-2 hidden-xs"><label for="" class="control-label">Due Date</label></div>
                                <div class="col-sm-2 hidden-xs"><label for="" class="control-label">Status</label></div>
                              </div>


                              <div id="action-log-table" class="dynamic-row">
                                <?php foreach($action_logs as $action_log){ ?>
                                <?php
                                  $action_description = $action_log['action'];
                                  $action_party = $action_log['action_party'];
                                  $due_date = $action_log['due_date'];
                                  $status = $action_log['status'];
                                ?>
                                  <div class="row">
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Operational Requirements</label></div>
                                    <div class="col-sm-5 col-xs-12">
                                      <div class="form-group">
                                        <select  class="form-control" name="action_description[]">
                                            <?php echo $action_description; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Owner</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="action_party[]" value="<?php echo $action_party; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Due Date</label></div>
                                    <div class="col-sm-2 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control start-date-dependent" name="action_log_due_date[]" placeholder="<?php if ($estimated_start_date == null || $estimated_start_date == ''){ echo '(No Start Date yet!)'; }else{ echo 'Select the Date'; } ?>" value="<?php echo $due_date; ?>" <?php if ($estimated_start_date == null || $estimated_start_date == ''){ echo 'disabled'; } ?> >
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Status</label></div>
                                    <div class="col-sm-2 col-xs-12">
                                      <div class="form-group">
                                        <select  class="form-control" name="status[]">
                                            <?php echo $status; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row visible-xs">
                                      <div class="col-xs-12"><hr></div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </div>

                            
	</div>



	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>