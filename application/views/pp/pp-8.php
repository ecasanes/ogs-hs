<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success pp-step7-popover"></i></h4>
    <div class="panel-options">
        <span class="panel-code"><?php echo $document_header_name; ?></span>
    </div>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>

      <!-- QUALITY CONTROL STEPS-->
                            <div class="row content">
                              <p class="pp-estimated-start-date hidden"><?php echo $estimated_start_date; ?></p>
                              <p class="pp-end-date hidden"><?php echo $estimated_end_date; ?></p>
                                    <div class="col-xs-12">
                                        <div class="page-header">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h4 class="step-title">Quality Control Steps <i class="fa fa-question-circle text-success pp-quality-control-steps-popover"></i></h4>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>



                            <div class="row content hidden-xs">
                                <div class="col-sm-6">
                                  <label class="control-label" for="">Event</label>
                                </div>
                                <div class="col-sm-6">
                                  <label class="control-label" for="">Owner</label>
                                </div>
                            </div>

                            
                            <div id="quality-control-step-table" class="dynamic-row">
                              <?php
                                foreach($quality_control_step as $step){
                                  $event = $step['event'];
                                  $responsible = $step['responsible'];
                                  $responsible_dropdown = $step['responsible_dropdown'];
                              ?>
                              <div class="row content">

                                <div class="col-xs-12 visible-xs"><label class="control-label" for="">Event</label></div>
                                <div class="col-sm-6 col-xs-12 tinymce-textarea">
                                  <div class="form-group form-group-required">
                                        <!-- <textarea class="form-control textarea-editor medium" name="quality_event[]" cols="30" rows="25"><?php echo $event; ?></textarea> -->
                                        <select name="quality_event[]" id="" class="form-control">
                                          <?php echo $event; ?>
                                        </select>
                                  </div>
                                </div>

                                <div class="col-xs-12 visible-xs"><label class="control-label" for="">Owner</label></div>
                                <div class="col-sm-6 col-xs-12 tinymce-textarea">
                                  <div class="alternate-select-input input-group">
                                          <input type="text" class="form-control alternate-input" name="quality_responsible[]" placeholder="New Owner" value="<?php echo $responsible; ?>">
                                          <select class="form-control alternate-select select2-dropdown" name="quality_responsible[]">
                                              <?php echo $responsible_dropdown; ?>
                                          </select>
                                          <span class="input-group-btn">
                                              <button class="btn btn-success alternate-button alt-select" type="button" title="add new">
                                                  <i class="fa fa-plus-circle fa-lg"></i>
                                              </button>
                                          </span>
                                      </div>
                                </div>
                                <div class="row visible-xs">
                                  <div class="col-xs-12"><hr></div>
                                </div>
                              </div>
                              <?php } ?>
                            </div>


    	 <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                  <div class="custom-tooltip">
                                    <p>
                                      
                                    </p>
                                  </div>
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-8">
                                            <h4 class="step-title"> Milestones <!--<span class="tooltip-toggle help-icon">--></span></h4>
                                          </div>
                                         
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>



                              <div class="row content text-left hidden-xs">
                                <div class="col-sm-8"><label for="" class="control-label">Event</label></div>
                                <div class="col-sm-2"><label for="" class="control-label">Due Date</label></div>
                                <div class="col-sm-2"><label for="" class="control-label">Status</label></div>
                              </div>


                              <div id="milestone-table" class="dynamic-row">
                                <?php foreach($milestones as $milestone){ ?>
                                <?php
                                  $event = $milestone['event'];
                                  $milestone_date = $milestone['milestone_date'];
                                  $milestone_status = $milestone['milestone_status'];
                                ?>
                                  <div class="row content">
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Event</label></div>
                                    <div class="col-sm-8 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="event[]" value="<?php echo $event; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Due Date</label></div>
                                    <div class="col-sm-2 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control start-date-dependent" name="milestone_date[]" placeholder="<?php if ($estimated_start_date == null || $estimated_start_date == ''){ echo '(No Start Date yet!)'; }else{ echo 'Select the Date'; } ?>" value="<?php echo $milestone_date ?>" <?php if ($estimated_start_date == null || $estimated_start_date == ''){ echo 'disabled'; } ?> >
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Status</label></div>
                                    <div class="col-sm-2 col-xs-12">
                                      <div class="form-group">
                                        <select  class="form-control" name="milestone_status[]">
                                            <?php echo $milestone_status; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row visible-xs">
                                      <div class="col-xs-12"><hr></div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </div>
                                
                                <!-- Change Management-->
                                <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                  <div class="custom-tooltip">
                                    <p>
                                      
                                    </p>
                                  </div>
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <h4 class="step-title"> Change Management <!--<span class="tooltip-toggle help-icon">--></span></h4>
                                          </div>
                                         
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>

                              

                              <div class="row content text-left">
                                <div class="col-sm-4 hidden-xs"><label for="" class="control-label">Event</label></div>
                                <div class="col-sm-3 hidden-xs"><label for="" class="control-label">Owner</label></div>
                                <div class="col-sm-2 hidden-xs"><label for="" class="control-label">Due Date</label></div>
                                <div class="col-sm-3 hidden-xs"><label for="" class="control-label">Area of Authority</label></div>
                              </div>


                              <div id="change-management-table" class="dynamic-row">
                                <?php foreach($change_management as $change){ 
                                
                                  $event = $change['event'];
                                  $responsible = $change['responsible'];
                                  $responsible_dropdown = $change['responsible_dropdown'];
                                  $due_date = $change['change_date'];
                                  $area_of_authority = $change['area_of_authority'];
                                ?>
                                  <div class="row content">
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Event</label></div>
                                    <div class="col-sm-4 col-xs-12">
                                      <div class="form-group">
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="change_event[]" value="<?php echo $event; ?>">
                                        </div>
                                      </div>
                                    </div>
                                    <!-- <div class="col-xs-12 visible-xs"><label for="" class="control-label">Owner</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="change_party[]" value="<?php echo $responsible_party; ?>">
                                      </div>
                                    </div> -->
                                    <div class="col-xs-12 visible-xs"><label class="control-label" for="">Owner</label></div>
                                    <div class="col-sm-3 col-xs-12 tinymce-textarea">
                                      <div class="alternate-select-input input-group">
                                              <input type="text" class="form-control alternate-input" name="change_party[]" placeholder="New Owner" value="<?php echo $responsible; ?>">
                                              <select class="form-control alternate-select select2-dropdown" name="change_party[]">
                                                  <?php echo $responsible_dropdown; ?>
                                              </select>
                                              <span class="input-group-btn">
                                                  <button class="btn btn-success alternate-button alt-select" type="button" title="add new">
                                                      <i class="fa fa-plus-circle fa-lg"></i>
                                                  </button>
                                              </span>
                                          </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Due Date</label></div>
                                    <div class="col-sm-2 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control start-date-dependent" name="change_due_date[]" placeholder="<?php if ($estimated_start_date == null || $estimated_start_date == ''){ echo '(No Start Date yet!)'; }else{ echo 'Select the Date'; } ?>" value="<?php echo $due_date ?>" <?php if ($estimated_start_date == null || $estimated_start_date == ''){ echo 'disabled'; } ?> >
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Area of Authority</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <select  class="form-control" name="change_area_of_authority[]">
                                            <?php echo $area_of_authority; ?>
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

                              <div class="page-header">
                                  <div class="row">
                                    <div class="col-xs-12">
                                        
                                    
                                  </div>
                                    
                                </div>

                              <!--Evaluation -->
                              <div class="panel panel-inverse collapsed">
                                <div class="panel-heading">
                                  <h4 class="panel-title">Evaluation</h4>
                                  <div class="panel-options">
                                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                                  </div>
                                </div>
                                <div class="panel-body" style="display:none;">

                                  <div class="row content text-left">
                                    <div class="col-sm-5 col-xs-12"><label for="" class="control-label">Lessons Learned</label></div>
                                  </div>
                                  <div class="row content">
                                    <div class="col-xs-12">
                                      <div class="form-group form-group-required">
                                        <textarea class="form-control textarea-editor medium" name="lesson_learned" cols="30" rows="25"><?php echo $lesson_learned; ?></textarea>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row content">
                                    <div class="col-xs-12 col-sm-4">
                                      <h4 class="step-title"><p class="">Cost Breakdown</p></h4>
                                    </div>
                                    <div class="col-sm-2 short-question"></div>
                                    <div class="col-xs-12 col-sm-5 text-left"></div>
                                    <div class="col-sm-1"></div>
                                  </div>

                                  <div id="cost_breakdown_collapse" class="category-body collapse in">
                                                         
                                    <div class="cost-breakdown-table-class">
                                      <div class="row content ">
                                        <div class="col-sm-4 hidden-xs">
                                          <label for="" class="control-label">Description</label>
                                        </div>
                                        <div class="col-sm-4 hidden-xs">
                                          <div class="row">
                                            <div class="col-sm-8 hidden-xs">
                                              <label for="" class="control-label">Estimated Cost & Volume</label>
                                            </div>
                                            <div class="col-sm-4 hidden-xs">
                                              <label for="" class="control-label">Sub Total</label>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-sm-4 hidden-xs">
                                          <div class="row">
                                            <div class="col-sm-8 hidden-xs">
                                              <label for="" class="control-label">Actual Cost & Volume</label>
                                            </div>
                                            <div class="col-sm-4 hidden-xs">
                                              <label for="" class="control-label">Sub Total</label>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                      
                                      <div id="cost-breakdown-table" class="hide-plus-minus-buttons"> <!-- class="dynamic_row"-->

                                        <?php foreach($cost_breakdown_items as $item){ 

                                          $desc = $item['text'];
                                          $actual_unit_cost = $item['actual_unit_cost'];
                                          $actual_volume = $item['actual_volume'];
                                          $actual_subtotal = $item['actual_subtotal'];
                                          $status = $item['status'];
                                          $item_description = $item['item_description'];
                                          $color_value = $item['color_value'];
                                          $estimated_unit_cost = $item['estimated_unit_cost'];
                                          $estimated_volume = $item['estimated_volume'];
                                          $estimated_subtotal = $item['estimated_subtotal'];

                                        ?>

                                          <div class="cost-breakdown-row row content">
                                            <div class="col-xs-12 visible-xs"><label for="" class="control-label">Description</label></div>
                                            <div class="col-sm-4 col-xs-12">
                                              <textarea class="form-control" name="cost_description[]" id="" cols="30" rows="1"><?php echo $desc; ?></textarea>
                                            </div>
                                            <div class="col-sm-4 col-xs-12">
                                              <div class="row">
                                                <div class="col-xs-12 visible-xs"><label for="" class="control-label">Estimated Cost</label></div>
                                                <div class="col-sm-4 col-xs-12 padding-right-of-2px">
                                                    <input name="c_estimated_unit_cost[]" type="text" class="form-control decimal-only estimated-unit-cost auto-calc-estimate" value="<?php echo $estimated_unit_cost; ?>" readonly>
                                                </div>
                                                <div class="col-xs-12 visible-xs"><label for="" class="control-label">Estimated Volume</label></div>
                                                <div class="col-sm-4 col-xs-12 padding-left-and-right-8px">
                                                    <input name="c_estimated_volume[]" type="text" class="form-control decimal-only estimated-volume auto-calc-estimate" value="<?php echo $estimated_volume; ?>" readonly>
                                                </div>
                                                <div class="col-xs-12 visible-xs"><label for="" class="control-label">Estimated subtotal</label></div>
                                                <div class="col-sm-4 col-xs-12 padding-left-of-2px">
                                                    <input readonly name="c_estimated_subtotal[]" type="text" class="form-control decimal-only estimated-subtotal disabled" value="<?php echo $estimated_subtotal; ?>" readonly>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- actual  -->
                                            <div class="col-sm-4 col-xs-12">
                                              <div class="row">
                                                <div class="col-xs-12 visible-xs"><label for="" class="control-label">Actual Cost</label></div>
                                                <div class="col-sm-4 col-xs-12 padding-right-of-2px">
                                                    <input name="c_actual_unit_cost[]" type="text" class="form-control decimal-only unit-cost auto-calc" value="<?php echo $actual_unit_cost; ?>">
                                                </div>
                                                <div class="col-xs-12 visible-xs"><label for="" class="control-label">Actual Volume</label></div>
                                                <div class="col-sm-4 col-xs-12 padding-left-and-right-8px">
                                                    <input name="c_actual_volume[]" type="text" class="form-control decimal-only volume auto-calc" value="<?php echo $actual_volume; ?>">
                                                </div>
                                                <div class="col-xs-12 visible-xs"><label for="" class="control-label">Actual subtotal</label></div>
                                                <div class="col-sm-4 col-xs-12 padding-left-of-2px">
                                                    <input readonly name="c_actual_subtotal[]" type="text" class="form-control decimal-only subtotal disabled" value="<?php echo $actual_subtotal; ?>">
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row visible-xs">
                                              <div class="col-xs-12 no-padding"><hr></div>
                                            </div>
                                          </div>
                                          <span class="hidden-xs">&nbsp;</span>
                                        <?php } ?>
                                      </div>

                                      <br>
                                      <div class="cost-breakdown-row row content">
                                        <div class="col-sm-4 col-xs-12">
                                          <div class="row">
                                          </div>   
                                        </div>
                                        <div class="col-sm-4 col-xs-12">
                                          <div class="row">
                                            <div class="col-sm-8 col-xs-6 padding-right-of-2px text-middle">
                                              <label for="" class="control-label">Estimated Total</label>
                                            </div>
                                            <div class="col-sm-4 col-xs-6 padding-left-of-2px">
                                              <div class="form-group">
                                                <input readonly class="form-control decimal-only disabled total" type="text" id="estimated_cost_breakdown_total" name="c_estimated_total" value="<?php echo $cost_breakdown_estimated_total; ?>">
                                              </div>
                                            </div>
                                          </div>   
                                        </div>
                                        <div class="col-sm-4 col-xs-12">
                                          <div class="row">
                                            <div class="col-sm-8 col-xs-6 padding-right-of-2px text-middle">
                                              <label for="" class="control-label">Actual Total</label>
                                            </div>
                                            <div class="col-sm-4 col-xs-6 padding-left-of-2px">
                                              <div class="form-group">
                                                <input readonly class="form-control decimal-only disabled total" type="text" id="actual_cost_breakdown_total" name="c_actual_total" value="<?php echo $cost_breakdown_actual_total; ?>">
                                              </div>
                                            </div>
                                          </div>   
                                        </div>
                                        <div class="col-sm-4 col-xs-12">
                                          <div class="row">
                                          </div>   
                                        </div>
                                      </div>    
                                  
                                      <!-- variation-->
                                      <div class="cost-breakdown-row row content">
                                        <div class="col-sm-offset-8 col-sm-4 col-xs-12">
                                          <div class="row">
                                            <div class="col-sm-8 col-xs-6 padding-right-of-2px text-middle">
                                              <label for="" class="control-label">Variation</label>
                                            </div>
                                            <div class="col-sm-4 col-xs-6 padding-left-of-2px">
                                              <div class="form-group">
                                                <input readonly class="form-control decimal-only disabled total" type="text" id="cost_breakdown_variation" name="c_variation" value="<?php echo $cost_breakdown_variation; ?>">
                                              </div>
                                            </div>
                                          </div>   
                                        </div>
                                        <div class="col-sm-4 col-xs-12">
                                          <div class="row">
                                          </div>   
                                        </div>
                                      </div>
                                    </div>

                                  </div>

                                </div>
                              </div>

                              </div>
	</div>


	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>