
<div class="panel panel-default">
  <?php $this->load->view('includes/initialize-form', $data); ?>
    <div class="panel-heading">
      <h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success evaluate-results-popover"></i></h4>
      <div class="panel-options">
        <span class="panel-code"><?php echo $document_header_name; ?></span>
      </div>
    </div>

    <div class="panel-body">
      <?php $this->load->view('includes/steps', $data); ?>
      <?php $this->load->view('includes/completion-status', $data); ?>
      <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="page-header">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <h4 class="step-title">Summary of Results </h4>
                                                </div>
                                                <div class="col-xs-4">
                                                    
                                                </div>
                                            </div>
                                            
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

                              <div class="row content">
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                          <div class="row">
                                              <div class="col-xs-8">
                                                  <h4 class="step-title">Rate the Success of your solution to fix the problem </h4>
                                              </div>
                                              <div class="col-xs-4">
                                              </div>
                                          </div>
                                          
                                      </div>
                                  </div>
                              </div>
                              

                            <div id="rate-of-success-table" class="dynamic-row">
                              <?php 
                                foreach($rate_of_success as $success){
                                  $area_of_impact = $success['area_of_impact'];
                                  $result = $success['result'];
                              ?>
                              <div class="row content">
                                  <label for="" class="col-xs-12 col-sm-2 control-label">Area of Impact </label>
                                <div class="col-xs-12 col-sm-4">
                                  <div class="form-group">
                                    <select class="form-control area-of-impact-item" name="area_of_impact[]">
                                      <?php echo $area_of_impact; ?>
                                    </select>
                                  </div>
                                </div>
                                  <label class="col-xs-12 col-sm-2 control-label required-input">Result </label>
                                <div class="col-xs-12 col-sm-4">
                                  <div class="form-group">
                                    <select  class="form-control colored-select <?php //echo get_color_class($result); ?> result" name="result[]" required>
                                      <?php echo $result; ?>
                                    </select>
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
