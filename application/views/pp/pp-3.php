<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success pp-step2-popover"></i></h4>
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
                                            <h4 class="step-title">Benefits Breakdown <i class="fa fa-question-circle text-success pp-benefits-popover"></i></h4>
                                          </div>
                                          
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>


                                <!-- <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="form-group form-group-required">
                                            <textarea name="benefits" id="benefits" cols="30" rows="12" class="form-control textarea-editor medium" required><?php echo $benefits; ?></textarea>
                                        </div>
                                    </div>
                                </div> -->
                             <div class="row content">
                                <div class="col-sm-4 hidden-xs">
                                  <label for="" class="control-label">Item</label>
                                </div>
                                <div class="col-sm-8 hidden-xs">
                                  <label for="" class="control-label">Description</label>
                                </div>
                              </div>

                            
                            <div id="benefit-breakdown-table">
                              <?php
                                foreach($benefit_breakdown_items as $item){
                                  $desc = $item['text'];
                                  $item = $item['item_description'];
                                  //$color_value = $item['color_value'];
                              ?>
                              <div class="row content">
                                <div class="col-xs-12 visible-xs">
                                  <label for="" class="control-label">Item</label>
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                  <div class="form-group">
                                      <select class="form-control" name="benefit_item[]">
                                          <?php echo $item; ?>
                                      </select>
                                  </div>
                                </div>
                                <div class="col-xs-12 visible-xs">
                                  <label for="" class="control-label">Description</label>
                                </div>
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

                                

                                <!-- RISKS -->
                                
                                <!-- <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="form-group form-group-required">
                                            <textarea name="risks" id="risks" cols="30" rows="12" class="form-control textarea-editor medium" required><?php echo $risks; ?></textarea>
                                        </div>
                                    </div>
                                </div> -->



                               <!-- COST BREAKDOWN -->
                              <div class="cost-breakdown-table-class">
                                <div class="row content custom-tooltip-container generic-tooltip generic-large">
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <?php echo form_hidden('currency', ''); ?>
                                            <h4 class="step-title">Cost Breakdown <i class="fa fa-question-circle text-success pp-costs-popover"></i></h4>
                                          </div>
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>



                                
                              <div class="row content hidden-xs">
                                <div class="col-xs-7 cost-description">
                                  <div class="row">
                                    <div class="col-xs-5">
                                      <label class="control-label">Item</label>
                                    </div>
                                    <div class="col-xs-7">
                                      <label class="control-label">Description</label>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-xs-1 cost-description-number"><label class="control-label">Unit Cost</label></div>
                                <div class="col-xs-1 cost-description-number"><label class="control-label">Volume</label></div>
                                <div class="col-xs-1 cost-description-number"><label class="control-label">Sub Total</label></div>
                                <div class="col-xs-2"><label class="control-label">Status</label></div>
                              </div>


                              <div id="cost-breakdown-table" class="dynamic-row">

                              <?php 

                              foreach($cost_breakdown_items as $item){ 

                                $desc = $item['text'];
                                $estimated_unit_cost = $item['estimated_unit_cost'];
                                $estimated_volume = $item['estimated_volume'];
                                $estimated_subtotal = $item['estimated_subtotal'];
                                $status = $item['status'];
                                $item_description = $item['item_description'];
                                $color_value = $item['color_value'];

                                ?>

                                <div class="cost-breakdown-row row content">
                                  <div class="col-sm-7 col-xs-12 cost-description">
                                    <div class="row">
                                      <div class="col-xs-12 visible-xs"><label class="control-label">Item</label></div>
                                      <div class="col-sm-5 col-xs-12">
                                        <div class="form-group">
                                          <select class="form-control" name="cost_item[]">
                                            <?php echo $item_description; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-xs-12 visible-xs"><label class="control-label">Description</label></div>
                                      <div class="col-sm-7 col-xs-12">
                                        <textarea class="form-control" name="cost_description[]" id="" cols="30" rows="1"><?php echo $desc; ?></textarea>
                                        <br>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-xs-6 visible-xs"><label class="control-label">Unit Cost</label></div>
                                  <div class="col-sm-1 col-xs-6 cost-description-number">
                                    <div class="form-group">
                                      <input name="c_estimated_unit_cost[]" type="text" class="form-control decimal-only estimated-unit-cost auto-calc-estimate" value="<?php echo $estimated_unit_cost; ?>">
                                    </div>
                                  </div>
                                  <div class="col-xs-6 visible-xs"><label class="control-label">Volume</label></div>
                                  <div class="col-sm-1 col-xs-6 cost-description-number">
                                    <div class="form-group">
                                      <input name="c_estimated_volume[]" type="text" class="form-control decimal-only estimated-volume auto-calc-estimate" value="<?php echo $estimated_volume; ?>">
                                    </div>
                                  </div>
                                  <div class="col-xs-6 visible-xs"><label class="control-label">Subtotal</label></div>
                                  <div class="col-sm-1 col-xs-6 cost-description-number">
                                    <div class="form-group">
                                      <input readonly name="c_estimated_subtotal[]" type="text" class="form-control decimal-only estimated-subtotal disabled" value="<?php echo $estimated_subtotal; ?>">
                                    </div>
                                  </div>
                                  <div class="col-xs-12 visible-xs"><label class="control-label">Status</label></div>
                                  <div class="col-sm-2 col-xs-12">
                                    <div class="form-group">
                                      <select  name="c_status[]" class="form-control color-select <?php echo $color_value; ?>">
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
                              <br>

                              <div class="row content">
                                <div class="col-sm-offset-10 col-sm-2">
                                  <label class="control-label">
                                    Total
                                  </label>
                                  <div class="form-group">
                                    <input readonly class="form-control decimal-only disabled total" type="text" id="estimated_cost_breakdown_total" name="c_estimated_total" value="<?php echo $estimated_total; ?>">
                                  </div>
                                </div>
                              </div>
                            </div>
	</div>


	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>