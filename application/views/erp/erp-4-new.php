<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4><?php echo $step_title; ?> <i class="fa fa-question-circle text-success erp-step4-popover"></i></h4>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>


    	<div class="row content">
                                    <div class="col-xs-12">
                                        <div class="page-header">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <h4 class="step-title"></h4>
                                                </div>
                                                <div class="col-xs-4">
                                                    <?php $this->load->view('includes/casefile-upload', $data); ?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row content custom-tooltip-container generic-tooltip">
                                <div class="col-xs-12">
                                  <div class="page-header">
                                      <h4 class="step-title">Findings <i class="fa fa-question-circle text-success erp-findings-popover"></i></h4>
                                  </div>
                              </div>
                          </div>




                          <div class="row content">
                            <div class="col-xs-12">
                              <div class="form-group form-group-required">
                                <textarea class="form-control textarea-editor medium" name="findings" id="findings" cols="30" rows="25"><?php echo $findings; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row content custom-tooltip-container generic-tooltip">
                    <div class="col-xs-12">
                      <div class="page-header">
                          <h4 class="step-title">Summary <i class="fa fa-question-circle text-success erp-summary-popover"></i></h4>
                      </div>
                  </div>
              </div>

              <div class="row content">
                <div class="col-xs-12">
                  <div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="summary" id="summary" cols="30" rows="25"><?php echo $summary; ?></textarea>
                </div>
            </div>
        </div>


        <div class="row content custom-tooltip-container generic-tooltip">
        <div class="col-xs-12">
          <div class="page-header">
              <h4 class="step-title">Recommendations <i class="fa fa-question-circle text-success erp-recommendations-popover"></i></h4>
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