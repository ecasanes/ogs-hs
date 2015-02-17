
<div class="panel panel-default">
  <?php $this->load->view('includes/initialize-form', $data); ?>

  <div class="panel-heading">
      <h4 class="panel-title"><?php echo $step_title; ?></h4>
      <div class="panel-options">
            <span class="panel-code"><?php echo $document_header_name; ?></span>
        </div>
  </div>

  <!-- Panel Body -->
  <div class="panel-body">
     <?php $this->load->view('includes/steps', $data); ?>
     <?php $this->load->view('includes/completion-status', $data); ?>

     <div class="row">
        <div class="col-sm-8 col-xs-12">
        </div>
        <div class="col-sm-4 col-xs-12">
            <?php $this->load->view('includes/casefile-upload', $data); ?>
        </div>
    </div>


      <!-- OPPORTUNITY -->
      <!-- <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h4>Opportunity</h4>
          </div>
        </div>
      </div>
                          
      
      <div class="row content hidden-xs">
        <div class="col-sm-4">
          <label class="control-label" for="">Type of Improvement</label>
        </div>
        <div class="col-sm-8">
          <label class="control-label" for="">Description</label>
        </div>
      </div>
      
                            
      <div id="type-of-improvement-table">
        <?php
          foreach($type_of_improvements as $improvement){
            $type_of_improvement = $improvement['type_of_improvement'];
            $type_of_improvement_description = $improvement['type_of_improvement_description'];
        ?>
        <div class="row content">
          <div class="col-xs-12 visible-xs"><label for="" class="control-label">Type of Improvement</label></div>
          <div class="col-sm-4 col-xs-12">
            <div class="form-group">
                <select class="form-control type-of-improvement" name="type_of_improvement[]">
                    <?php echo $type_of_improvement; ?>
                </select>
            </div>
          </div>
          <div class="col-xs-12 visible-xs"><label for="" class="control-label">Description</label></div>
          <div class="col-sm-8 col-xs-12">
            <div class="form-group">
              <textarea disabled="disabled" class="form-control no-resize type-of-improvement-description" name="type_of_improvement_description[]" rows="3"><?php echo $type_of_improvement_description; ?></textarea>
            </div>
          </div>
          <div class="row visible-xs">
            <div class="col-xs-12"><hr></div>
          </div>
        </div>
        <?php } ?>
      </div> -->

     
      <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h4>Improvement Summary</h4>
          </div>
        </div>
      </div>
      
      <div class="row">
        
        <div class="col-xs-12">
                  <div class="form-group">
                        <textarea class="form-control textarea-editor medium" name="summary" id="summary" cols="30" rows="10"><?php echo $summary; ?></textarea>
                  </div>
        </div>
      </div>
                            <div class="cost-breakdown-table">
                               <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h4>Benefits Breakdown</h4>
          </div>
        </div>
      </div>
                          
                            
                               <div class="row content hidden-xs">
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
                                <label for="" class="control-label col-xs-12 visible-xs">Item</label>
                                <div class="col-sm-4 col-xs-12">
                                  <div class="form-group">
                                      <select class="form-control" name="benefit_item[]">
                                          <?php echo $item; ?>
                                      </select>
                                  </div>
                                </div>
                                <label for="" class="control-label col-xs-12 visible-xs">Description</label>
                                <div class="col-sm-8 col-xs-12">
                                  <div class="form-group">
                                    <textarea class="form-control" name="benefit_description[]" rows="1"><?php echo $desc; ?></textarea>
                                  </div>
                                </div>
                                <div class="row visible-xs">
                                  <div class="col-xs-12"><hr></div>
                                </div>
                              </div>
                              <?php } ?>
                            </div>










                            <div class="cost-breakdown-table">
                                <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h4>Cost Breakdown</h4>
          </div>
        </div>
      </div>
                          
                            
                            
                               <div class="row content hidden-xs">
                                <div class="col-sm-4">
                                  <label for="">Item</label>
                                </div>
                                <div class="col-sm-8">
                                  <label for="">Description</label>
                                </div>
                              </div>


                               <div id="cost-breakdown-table">
                              <?php
                                foreach($cost_breakdown_items as $item){
                                  $desc = $item['text'];
                                  $item = $item['item_description'];
                              ?>
                              <div class="row content">
                                <label for="" class="control-label col-xs-12 visible-xs">Item</label>
                                <div class="col-sm-4">
                                  <div class="form-group">
                                      <select class="form-control" name="cost_item[]">
                                          <?php echo $item; ?>
                                      </select>
                                  </div>
                                </div>
                                <label for="" class="control-label col-xs-12 visible-xs">Description</label>
                                <div class="col-sm-8">
                                  <div class="form-group">
                                    <textarea class="form-control" name="cost_description[]" rows="1"><?php echo $desc; ?></textarea>
                                  </div>
                                </div>
                                <div class="row visible-xs">
                                  <div class="col-xs-12"><hr></div>
                                </div>
                              </div>
                              <?php } ?>
                            </div>











                            <!-- ENABLERS -->

                            <!-- <div class="row content custom-tooltip-container generic-tooltip">
                              <div class="custom-tooltip">
                                
                            
                              </div>
                              <div class="col-xs-12">
                                  <div class="page-header">
                                      <h2 class="step-title">Enablers <span class="tooltip-toggle help-icon"></span></h2>
                                  </div>
                              </div>
                            </div> -->

                            <div class="row">
                              <div class="col-xs-12">
                                <div class="page-header">
                                  <h4>Enablers <i class="fa fa-question-circle text-success enablers-popover"></i></h4>
                                </div>
                              </div>
                            </div>



                            <!-- <div class="row content">
                              <div class="col-xs-12">
                                <label for="" class="control-label">Prerequisites</label>
                              </div>
                            </div>
                            
                            <div id="enablers-prerequisite-table" class="dynamic-row">
                            
                              <?php foreach($enablers_prerequisite as $prerequisite){
                                $prerequisite = $prerequisite->description;
                               ?>
                            
                              <div class="row content">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <textarea class="form-control" name="prerequisite[]" cols="30" rows="2"><?php echo $prerequisite; ?></textarea>
                                  </div>
                                </div>
                              </div>
                            
                              <?php } ?>
                            
                            </div> -->


                            <!-- <div class="row content">
                              <div class="col-xs-12">
                                <label for="" class="control-label">Dependencies</label>
                              </div>
                            </div>
                            <div id="enablers-dependencies-table" class="dynamic-row">
                            
                              <?php foreach($enablers_dependencies as $dependencies){
                                $dependencies = $dependencies->description;
                               ?>
                            
                              <div class="row content">
                                <div class="col-xs-12">
                                  <div class="form-group">
                                      <textarea class="form-control" name="dependencies[]" cols="30" rows="2"><?php echo $dependencies; ?></textarea>
                                  </div>
                                </div>
                              </div>
                            
                              <?php } ?>
                            
                            </div> -->

                             <div class="row content text-left hidden-xs">
                                    <div class="col-sm-4">
                                      <label for="" class="control-label">Specialist Requirement</label>
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
                                    <label for="" class="col-xs-12 visible-xs control-label">Specialist Requirement</label>
                                    <div class="col-sm-4 col-xs-12">
                                      <div class="form-group">
                                        <select class="form-control" name="specialist_requirement[]">
                                         <?php echo $specialist_requirement; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <label for="" class="control-label col-xs-12 visible-xs">Description</label>
                                    <div class="col-sm-8 text-left col-xs-12">
                                      <div class="form-group">
                                        <textarea class="form-control" name="commitment_description[]" rows="1"><?php echo $commitment_description; ?></textarea>
                                      </div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </div>


  </div>
  
</div>
</div>
<?php $this->load->view('includes/casefile-footer', $data); ?>
  <?php echo form_close(); ?>
  </div>

