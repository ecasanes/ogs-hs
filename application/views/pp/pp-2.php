<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success pp-step1-popover"></i></h4>
    <div class="panel-options">
        <span class="panel-code"><?php echo $document_header_name; ?></span>
    </div>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>

    	<div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title">Project Definition <i class="fa fa-question-circle text-success pp-ex-sum-popover"></i></h4>
                                          </div>
                                          
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>


                                <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="form-group form-group-required">
                                            <textarea name="summary" id="about-the-project" cols="30" rows="24" class="form-control textarea-editor medium" required><?php echo $summary; ?></textarea>
                                        </div>
                                    </div>
                                </div>




                                <!-- PURPOSE -->
                                <div class="row content custom-tooltip-container generic-tooltip generic-large">
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title">Purpose <i class="fa fa-question-circle text-success pp-purpose-popover"></i></h4>
                                          </div>
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>



                                <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="form-group form-group-required">
                                            <textarea name="purpose" id="purpose" cols="30" rows="12" class="form-control textarea-editor medium" required><?php echo $purpose; ?></textarea>
                                        </div>
                                    </div>
                                </div>





                                <!-- SUCCESS CRITERIA -->
                                <div class="row content custom-tooltip-container generic-tooltip generic-large">
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title">Success Criteria <i class="fa fa-question-circle text-success pp-success-popover"></i></h4>
                                          </div>
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>



                                <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <textarea name="success_criteria" id="success_criteria" cols="30" rows="12" class="form-control textarea-editor medium"><?php echo $success_criteria; ?></textarea>
                                        </div>
                                    </div>
                                </div>








                                <!-- LOCATIONS -->
                                <!-- <div class="row content custom-tooltip-container generic-tooltip generic-large">
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title">Locations <i class="fa fa-question-circle text-success pp-location-popover"></i></h4>
                                          </div>
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>
                                
                                
                                
                                <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <textarea name="locations" id="locations" cols="30" rows="6" class="form-control textarea-editor medium"><?php echo $locations; ?></textarea>
                                        </div>
                                    </div>
                                </div> -->


                                <div class="row">

                                  <!-- <label class="control-label col-xs-12 col-sm-2">Target Start Date:</label>
                                  <div class="col-xs-12 col-sm-4">
                                      <div class="form-group">
                                          <input type="text" id="estimated_start_date" name="estimated_start_date" class="form-control datepicker" placeholder="mm/dd/yyyy" value="<?php echo $estimated_start_date; ?>">
                                      </div>
                                  </div> -->

                                  <label class="control-label col-xs-12 col-sm-2">First Day Offshore:</label>
                                  <div class="col-xs-12 col-sm-4">
                                      <div class="form-group">
                                          <input type="text" id="start_date_range" name="first_day_offshore" class="form-control number-only" value="<?php echo $first_day_offshore; ?>">
                                      </div>
                                  </div>

                                  <label class="control-label col-xs-12 col-sm-2">Last Day Offshore:</label>
                                  <div class="col-xs-12 col-sm-4">
                                      <div class="form-group">
                                          <input type="text" id="end_date_range" name="last_day_offshore" class="form-control" value="<?php echo $last_day_offshore; ?>">
                                      </div>
                                  </div>
                                </div>

                                
	</div>

	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>