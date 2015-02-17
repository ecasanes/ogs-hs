<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success cf-step7-popover"></i></h4>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>


    	<div class="row content">
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
                        	
                              
                              <!-- <div class="row content custom-tooltip-container generic-tooltip">
                              <div class="custom-tooltip">
                                <p>Describe what you found, these are fact based and should include failure, root cause and solution</p>
                              </div>
                              <div class="col-xs-12">
                                  <div class="page-header">
                                      <h4 class="step-title">Findings <span class="text-required">*</span> <span class="tooltip-toggle help-icon"></span></h4>
                                  </div>
                              </div>
                            </div>




                            <div class="row content">
                                <div class="col-xs-12">
                                          <div class="form-group form-group-required">
                                                <textarea class="form-control textarea-editor medium" name="findings" id="findings" cols="30" rows="25"><?php echo $findings; ?></textarea>
                                          </div>
                                </div>
                            </div> -->
                            <input name="findings" type="hidden" ><?php echo $findings; ?></input>
                            <input name="summary" type="hidden" value="<?php echo $summary; ?>">
                            <!-- <div class="row content custom-tooltip-container generic-tooltip">
                              <div class="custom-tooltip">
                                <p>Describe what you found, these are fact based and should include failure, root cause and solution and Describe the approach you took to the investigation (shore based or offshore, thorough investigation or restricted due to lack of access or operational issues.) Also describe the implementation of the solution and test.</p>
                              </div>
                              <div class="col-xs-12">
                                  <div class="page-header">
                                      <h4 class="step-title">Summary of Findings <span class="text-required">*</span><span class="tooltip-toggle help-icon"></span></h4>
                                  </div>
                              </div>
                            </div>

                            <div class="row content">
                                <div class="col-xs-12">
                                          <div class="form-group form-group-required">
                                                <textarea class="form-control textarea-editor medium" name="summary" id="summary" cols="30" rows="25"><?php echo $summary; ?></textarea>
                                          </div>
                                </div>
                            </div> -->



                            <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                              <div class="col-xs-12">
                                  <div class="page-header">
                                    <div class="row">   
                                      <div class="col-xs-8">
                                        <h4 class="step-title">Detection <i class="fa fa-question-circle text-success cf-detection-popover"></i></h4>
                                      </div>
                                    </div>
                                      
                                  </div>
                              </div>
                            </div>



                              <div class="row content">
                                <div class="col-xs-12">
                                          <div class="form-group">
                                                <textarea class="form-control textarea-editor medium" name="detection" id="detection" cols="30" rows="5"><?php echo $detection; ?></textarea>
                                          </div>
                                </div>
                              </div>




                              <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                              <div class="col-xs-12">
                                  <div class="page-header">
                                    <div class="row">
                                      <div class="col-xs-8">
                                        <h4 class="step-title">Prevention <i class="fa fa-question-circle text-success cf-prevention-popover"></i></h4>
                                      </div>
                                    </div>
                                      
                                  </div>
                              </div>
                            </div>



                              <div class="row content">
                                <div class="col-xs-12">
                                          <div class="form-group">
                                                <textarea class="form-control textarea-editor small" name="prevention" id="prevention" cols="30" rows="5"><?php echo $prevention; ?></textarea>
                                          </div>
                                </div>
                              </div>





                            <div class="row content custom-tooltip-container generic-tooltip">
                              <div class="col-xs-12">
                                  <div class="page-header">
                                      <h4 class="step-title">Recommendations <i class="fa fa-question-circle text-success cf-recommendations-popover"></i></span></h4>
                                  </div>
                              </div>
                            </div>

                            <div class="row content">
                                <div class="col-xs-12">
                                          <div class="form-group form-group-required">
                                                <textarea class="form-control textarea-editor medium" name="recommendations" id="recommendations" cols="30" rows="25"><?php echo $recommendations; ?></textarea>
                                          </div>
                                </div>
                            </div>
	</div>



	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>