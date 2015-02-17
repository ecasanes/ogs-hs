<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4><?php echo $step_title; ?> <i class="fa fa-question-circle text-success erp-step3-popover"></i></h4>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>

    	 <div class="row content">
                                    <div class="col-xs-12 col-sm-12">
                                        <div class="page-header">
                                            <div class="row">
                                                <div class="col-xs-8">
                                                    <h4>Scope of Repair</h4>
                                                </div>
                                                <div class="col-xs-4">
                                                    <?php $this->load->view('includes/casefile-upload', $data); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="row custom-tooltip-container step-tooltip">
                                        <div class="col-xs-12">
                                            <div class="">
                                                <h4 class="step-title">Scope <i class="fa fa-question-circle text-success erp-scope-popover"></i></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>





                                <div class="row content">
                                    <div class="col-xs-12 repair-report">
                                        <div class="row">
                                            <div class="col-xs-12"><p class="strong">Comments</p></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row content">
                                    <div class="col-xs-12 repair-report">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="form-group form-group-required">
                                                    <textarea class="form-control textarea-editor medium" name="scope_comment" cols="30" rows="5" required><?php echo $scope_comment; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Deliverables from PP-Step5 -->


                                <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                              </div>
                              <div class="col-xs-12">
                                  <div class="page-header">
                                    <div class="row">
                                      <div class="col-xs-8">
                                        <h4 class="step-title"> Deliverables <i class="fa fa-question-circle text-success erp-deliverables-popover"></i></h4>
                                    </div>
                                    <div class="col-xs-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                        <div class="col-xs-9"><p class="strong">Detailed Description of Deliverables</p></div>
                        <div class="col-xs-3"><p class="strong">Due Date</p></div>


                    <div id="deliverable-table" class="dynamic-row col-row">
                        <?php foreach($deliverables as $deliverable){ ?>
                        <?php
                        $deliverables_description = $deliverable->description;
                        $due_date = convert_date_to_string($deliverable->due_date);
                        ?>
                        <div class="row content">
                            <div class="col-xs-9">
                              <div class="form-group">
                                <input type="text" class="form-control" name="deliverables_description[]" value="<?php echo $deliverables_description; ?>">
                            </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="form-group">
                            <input type="text" class="form-control datepicker" name="due_date[]" value="<?php echo $due_date; ?>">
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>


            <!-- Quality control from PP-Step 5 & DECF-Step 5 -->

					            <div class="row content custom-tooltip-container generic-tooltip generic-large">
					                <div class="col-xs-12">
					                  <div class="page-header">
					                    <div class="row">
					                      <div class="col-xs-8">
					                        <h4 class="step-title">Quality Control <i class="fa fa-question-circle text-success erp-quality-popover"></i></h4>
					                    </div>
					                </div>
					            </div>
					        </div>
					    </div>


					    <div class="row content custom-tooltip-container generic-tooltip generic-medium">
					    <div class="col-xs-12">
					      <div class="page-header">
					          <h4 class="step-title">Summary <!-- <span class="tooltip-toggle help-icon"></span> --> </h4>
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
					                <div class="col-xs-7">
					                    <h4 class="step-title">Responsible Party </h4>
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


					<div id="responsible-party-table" class="dynamic-row col-row">
					  <?php
					  foreach($responsible_parties as $party){
					      $event = $party->event;
					      $responsible = $party->responsible;
					      ?>
					      <div class="row content">
					        <div class="col-sm-7">
					          <div class="form-group form-group-required">
					            <textarea class="form-control textarea-editor medium" name="event[]" cols="30" rows="25"><?php echo $event; ?></textarea>
					        </div>
					    </div>
					    <div class="col-sm-5">
					      <div class="form-group form-group-required">
					        <textarea class="form-control textarea-editor medium" name="responsible[]" cols="30" rows="25"><?php echo $responsible; ?></textarea>
					    </div>
					</div>
					</div>
					<?php } ?>
					</div>


					<div class="row content custom-tooltip-container generic-tooltip generic-medium">
					<div class="col-xs-12">
					  <div class="page-header">
					      <h4 class="step-title">Pass or Fail <i class="fa fa-question-circle text-success erp-pass-popover"></i></h4>
					  </div>
					</div>
					</div>


					<div class="row content">
					    <div class="col-xs-12">
					      <div class="form-group form-group-required">
					        <textarea class="form-control textarea-editor medium" name="pass_fail" id="pass_fail" cols="30" rows="25"><?php echo $pass_fail; ?></textarea>
					    </div>
					</div>






					<div class="row content">
					    <div class="col-xs-12 col-sm-12">
					        <div class="page-header">
					                <div class="col-xs-8">
					                    <h2>History</h2>
					                </div>
					        </div>
					    </div>
					</div>



								<?php 

                                $question_categories = array();
                                $categories_counter = 0;

                                foreach($equipment_history_questions as $question){ 


                                    $question_id = $question->equipment_history_answer_id;
                                    $question_category = $question->name;
                                    $question_detail = $question->question;
                                    $question_select_type = $question->dropdown_type;
                                    $question_answer = $question->answer;
                                    $question_comment = $question->comment;
                                    $question_start_date = convert_date_to_string($question->start_date, true);
                                    $question_end_date = convert_date_to_string($question->end_date, true);
                                    $question_start_date_dropdown = $question->start_date_dropdown;
                                    $question_end_date_dropdown = $question->end_date_dropdown;
                                    $question_exclude_date = $question->exclude_date;
                                    $question_field_type = $question->field_type;

                                    $question_categories[$categories_counter] = $question_category;

                                    $current_question = $question_categories[$categories_counter];

                                    if(isset($question_categories[$categories_counter - 1])){
                                        $previous_question = $question_categories[$categories_counter - 1];
                                    }else{
                                        $previous_question = '';
                                    }

                                    if($current_question != $previous_question){

                                        //if($categories_counter > 0){
                                            echo '</div>';
                                        //}

                                        ?>


                                            
                                            <div class="page-header accordion <?php if($categories_counter == 0){ echo "low-top"; } ?>" data-toggle="collapse" data-target="#<?php echo generate_slug($current_question); ?>">

                                                <div class="row content">
                                                    <div class="col-xs-12 col-sm-4">
                                                        <h2 class="step-title"><?php echo $current_question; ?> </h2>
                                                    </div>
                                                    <div class="col-sm-2 short-question"></div>
                                                    <div class="col-xs-12 col-sm-5 text-left">
                                                        <h2 class="step-title secondary-title">Further Details</h2>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <span class="accordion-btn btn btn-primary"><span class="glyphicon glyphicon-chevron-down"></span></span>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div id="<?php echo generate_slug($current_question); ?>" class="category-body collapse in">
                                            
                                        <?php
                                    }




                                    ?>



                                    <div class="row content equipment-history-question">
                                        <div class="col-lg-4 col-xs-12 col-sm-12">
                                                <p class="text-left"><?php echo $question_detail; ?></p>
                                        </div>
                                        
                                        <div class="col-sm-2 short-question no-padding">
                                            <div class="form-group <?php echo $question_select_type; ?>">
                                            <?php if($question_select_type != 'none'): ?>
                                                <select name="select[<?php echo $question_id; ?>]" id="select-<?php echo $question_id; ?>" class="no-padding form-control colored-select <?php echo get_color_class($question_answer, $question_select_type); ?>">
                                                    <?php echo comment_question_dropdown($question_answer, $question_select_type); ?>
                                                </select>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <?php if($question_field_type == 'comment' || $question_field_type == 'comment_with_date'): ?>
                                            <div class="col-lg-6 col-xs-12 col-sm-6 long-comment">
                                                   <div class="col-xs-12">
                                                       <div class="form-group">
                                                            <textarea class="form-control <?php if($question_select_type == 'none'){ }else{ echo 'hidden'; } ?>" name="comment[<?php echo $question_id; ?>]" id="comment-<?php echo $question_comment; ?>" cols="30" rows="2"><?php echo $question_comment; ?></textarea>
                                                            
                                                        </div>
                                                   </div> 
                                                <div class="row equipment-history-date <?php if($question_field_type == 'comment_with_date'){ echo comment_question_value($question_select_type, $question_answer, '', $question_exclude_date); }else{ echo comment_question_value($question_select_type, $question_answer, 'hidden', $question_exclude_date); } ?>">
                                                    <div class="col-xs-1" style="margin-top:10px;">Start</div>
                                                    <div class="col-xs-2" style="width:100px;padding-right:0px;margin-left:-5px;">
                                                       <div class="form-group">
                                                            <input name="start_date[<?php echo $question_id; ?>]" value="<?php echo $question_start_date; ?>" type="text" class="datepicker form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2" style="padding:0;margin-top:1px;width:100px;">
                                                        <div class="form-group">
                                                            <select class="form-control" name="start_date_dropdown[<?php echo $question_id; ?>]" style="padding-left:2px;padding-right:2px;">
                                                                <?php echo default_select($question_start_date_dropdown); ?>
                                                                <option value="n/a">N/A</option>
                                                                <option value="long term">Long Term</option>
                                                                <option value="unknown">Unknown</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-1" style="margin-left:-5px;margin-top:10px;">End</div>
                                                    <div class="col-xs-2" style="width:100px;padding-right:0px;margin-left:-10px;">
                                                       <div class="form-group">
                                                            <input name="end_date[<?php echo $question_id; ?>]" value="<?php echo $question_end_date; ?>" type="text" class="datepicker form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2" style="padding:0;margin-top:1px;width:100px;">
                                                        <div class="form-group">
                                                            <select class="form-control" name="end_date_dropdown[<?php echo $question_id; ?>]" style="padding:2px;">
                                                                <?php echo default_select($question_end_date_dropdown); ?>
                                                                <option value="n/a">N/A</option>
                                                                <option value="ongoing">Ongoing</option>
                                                                <option value="unknown">Unknown</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12">
                                                        <div class="help-info"></div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                        <?php elseif($question_field_type == 'date' ): ?>
                                            <div class="col-lg-4 col-xs-12 col-sm-4">
                                                <div class="form-group">
                                                    <input class="form-control datepicker" type="text" name="comment[<?php echo $question_id; ?>]" id="comment-<?php echo $question_comment; ?>" value="<?php echo $question_comment; ?>">
                                                    <?php echo form_hidden('start_date['.$question_id.']', ''); ?>
                                                    <?php echo form_hidden('end_date['.$question_id.']', ''); ?>
                                                    <?php echo form_hidden('start_date_dropdown['.$question_id.']', ''); ?>
                                                    <?php echo form_hidden('end_date_dropdown['.$question_id.']', ''); ?>
                                                </div>
                                            </div>
                                        <?php elseif($question_field_type == 'start_end_date'): ?>
                                            <div class="col-lg-6 col-xs-12 col-sm-6" style="width:460px;">
                                                <div class="row">
                                                    <div class="col-xs-1" style="margin-top:10px;">Start</div>
                                                    <div class="col-xs-2" style="width:100px;padding-right:0px;margin-left:-5px;">
                                                       <div class="form-group">
                                                            <?php echo form_hidden('comment['.$question_id.']',''); ?>
                                                            <input name="start_date[<?php echo $question_id; ?>]" value="<?php echo $question_start_date; ?>" type="text" class="datepicker form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2" style="padding:0;margin-top:1px;width:100px;">
                                                        <div class="form-group">
                                                            <select class="form-control" name="start_date_dropdown[<?php echo $question_id; ?>]" style="padding-left:2px;padding-right:2px;">
                                                                <?php echo default_select($question_start_date_dropdown); ?>
                                                                <option value="n/a">N/A</option>
                                                                <option value="long term">Long Term</option>
                                                                <option value="unknown">Unknown</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-1" style="margin-left:-5px;margin-top:10px;">End</div>
                                                    <div class="col-xs-2" style="width:100px;padding-right:0px;margin-left:-10px;">
                                                       <div class="form-group">
                                                            <input name="end_date[<?php echo $question_id; ?>]" value="<?php echo $question_end_date; ?>" type="text" class="datepicker form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2" style="padding:0;margin-top:1px;width:100px;">
                                                        <div class="form-group">
                                                            <select class="form-control" name="end_date_dropdown[<?php echo $question_id; ?>]" style="padding:2px;">
                                                                <?php echo default_select($question_end_date_dropdown); ?>
                                                                <option value="n/a">N/A</option>
                                                                <option value="ongoing">Ongoing</option>
                                                                <option value="unknown">Unknown</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
                                        <?php elseif($question_field_type == 'text'): ?>
                                            <div class="col-lg-3 col-xs-12 col-sm-3" style="width:300px;">
                                                <div class="form-group">
                                                    <input style="width:186px;margin-left:33px;" class="form-control" type="text" name="comment[<?php echo $question_id; ?>]" id="comment-<?php echo $question_comment; ?>" value="<?php echo $question_comment; ?>">
                                                    <?php echo form_hidden('start_date['.$question_id.']', ''); ?>
                                                    <?php echo form_hidden('end_date['.$question_id.']', ''); ?>
                                                    <?php echo form_hidden('start_date_dropdown['.$question_id.']', ''); ?>
                                                    <?php echo form_hidden('end_date_dropdown['.$question_id.']', ''); ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        
                                    </div>




                                    <?php





                                    $categories_counter++;



                                ?>

                            

                                <?php } //endfor ?>



                            </div>
                                <br>
                                <br>
                                <br>





<!-- end of quality control -->









	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>