<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title">Create Technical Query</h4>

        <div class="panel-options">
            <span class="panel-code"><?php echo $code; ?></span>
        </div>
	</div>
	<div class="panel-body">
		<?php $this->load->view('includes/completion-status', $data); ?>
        <?php $this->load->view('includes/document-status-snippet', $data); ?>

         <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="page-header">
                                            <h4 class="step-title">Technical Query</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content">
                                    <label class="col-sm-2 col-xs-12 control-label required-input" for="author">Query Title</label>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="doc_title" placeholder="" value="<?php echo $doc_title; ?>" required>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-xs-12 control-label" for="author">TQ Number</label>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="tq_number" placeholder="" value="<?php echo $code; ?>" disabled>
                                        </div>
                                    </div>
                                </div>


                                <div class="row content">
                                    <label class="col-sm-2 col-xs-12 control-label" for="author">Author</label>
                                    <div class="col-sm-4 col-xs-12 ajax-autocomplete">
                                        <div class="form-group">
                                            <input type="text" class="form-control new-user" name="author" placeholder="Firstname Lastname" value="<?php echo $author;?>" autocomplete="off" disabled>
                                            <input type="hidden" class="new-user-id" name="author_id" value="<?php echo $current_user_id; ?>">
                                        </div>
                                        <div class="autosuggest form-group">
                                            <ul class="user-suggest">

                                            </ul>
                                        </div>
                                    </div>

                                    <label class="col-sm-2 col-xs-12 control-label" for="date">Date</label>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="doc_date" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $doc_date; ?>">
                                        </div>
                                    </div>
                                </div>



                                


                                





                                <!-- Manufacturer Details -->
                                <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="page-header">
                                            <h4 class="step-title">Profile <i class="fa fa-question-circle text-success equipment_profile-popover"></i></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content">
                                    <label class="col-sm-2 col-xs-12 control-label required-input" for="system">System </label>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control" name="system" id="system" required>
                                                
                                                <?php echo $system_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content">
                                    <label class="col-sm-2 col-xs-12 control-label required-input" for="system_subcategory">System Subcategory </label>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control" name="system_subcategory" id="system_subcategory" required>
                                                <?php echo $system_subcategory_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content">
                                    <label class="col-sm-2 col-xs-12 control-label required-input" for="system">Category </label>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group equipment-category">
                                            <select class="form-control" name="equipment_category" id="equipment-category" required>
                                                
                                                <?php echo $equipment_category_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content">
                                    <label class="col-sm-2 col-xs-12 control-label required-input" for="system">Class </label>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control " name="equipment_class" id="equipment-class" required>
                                                <?php echo $equipment_class_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>     
                                <div class="row content">
                                    <label class="col-sm-2 col-xs-12 control-label required-input" for="system">Description </label>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <select class="form-control " name="equipment_description" id="equipment-description">
                                                
                                                <?php echo $equipment_description_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content">
                                    <label class="col-sm-2 col-xs-12 control-label required-input" for="system">Code </label>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <input id="equipment-code" class="form-control" type="text" value="<?php echo $equipment_code_value; ?>" disabled="disabled" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row content custom-tooltip-container generic-tooltip generic-medium">
                                    <div class="custom-tooltip">
                                        <p></p>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="page-header">
                                            <h4 class="step-title">Question <!-- <span class="tooltip-toggle help-icon"></span> --> </h4>
                                        </div>
                                    </div>
                                </div>


                                <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="form-group form-group-required">
                                            <textarea class="form-control textarea-editor medium" name="question"><?php echo $question; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                


                               


                                <div class="row content">

                                    <!-- IMAGE 1 -->
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php 
                                                    $data['single_upload'] = true;
                                                    $data['file_value'] = $image_1_filename;
                                                    $data['upload_name'] = 'image_1';
                                                    $this->load->view('includes/casefile-upload', $data);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="" class="control-label">Image 1 Caption</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="image_1_caption" rows="5"><?php echo $image_1_caption; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END IMAGE 1 -->

                                    <!-- IMAGE 2 -->
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php 
                                                    $data['single_upload'] = true;
                                                    $data['file_value'] = $image_2_filename;
                                                    $data['upload_name'] = 'image_2';
                                                    $this->load->view('includes/casefile-upload', $data);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="" class="control-label">Image 2 Caption</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="image_2_caption" rows="5"><?php echo $image_2_caption; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END IMAGE 2 -->


                                    <!-- IMAGE 3 -->
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php 
                                                    $data['single_upload'] = true;
                                                    $data['file_value'] = $image_3_filename;
                                                    $data['upload_name'] = 'image_3';
                                                    $this->load->view('includes/casefile-upload', $data);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="" class="control-label">Image 3 Caption</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="image_3_caption" rows="5"><?php echo $image_3_caption; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END IMAGE 3 -->
                                    
                                </div>
	</div>
	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>