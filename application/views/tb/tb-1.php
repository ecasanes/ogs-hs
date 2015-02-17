    <div class="panel panel-default">
        <?php $this->load->view('includes/initialize-form', $data); ?>
        <div class="panel-heading">
            <h4 class="panel-title"><?php echo $step_title; ?></h4>

            <div class="panel-options">
                <span class="panel-code"><?php echo $code; ?></span>
            </div>
        </div>
        <div class="panel-body">
            <?php $this->load->view('includes/completion-status', $data); ?>
            <?php $this->load->view('includes/document-status-snippet', $data); ?>


            <div class="row content" style="margin-top: 30px;">
                <label for="author" class="col-sm-2 col-xs-12 control-label required-input">Doc Title</label>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="doc_title" placeholder="" value="<?php echo $doc_title; ?>" required>
                    </div>
                </div>

                <label for="author" class="col-sm-2 col-xs-12 control-label">TB Number</label>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="author" placeholder="" value="<?php echo $code; ?>" disabled>
                    </div>
                </div>
            </div>

            <div class="row content">
                <label for="author" class="col-sm-2 col-xs-12 control-label">Author</label>
                <div class="col-sm-4 col-xs-12 ajax-autocomplete">
                    <div class="form-group">
                        <input type="text" class="form-control new-user" name="author" placeholder="Firstname Lastname" value="<?php echo $author; ?>" autocomplete="off" disabled>
                        <input type="hidden" class="new-user-id" name="author_id" value="<?php echo $current_user_id; ?>">
                    </div>
                    <div class="autosuggest form-group">
                        <ul class="user-suggest">

                        </ul>
                    </div>
                </div>

                <label for="date" class="col-sm-2 col-xs-12 control-label">Date</label>
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
                <label class="col-sm-2 col-xs-12 control-label required-input" for="system">System: </label>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <select class="form-control" name="system" id="system" required>

                            <?php echo $system_dropdown; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row content">
                <label class="col-sm-2 col-xs-12 control-label required-input" for="system_subcategory">System Subcategory: </label>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <select class="form-control" name="system_subcategory" id="system_subcategory" required>
                            <?php echo $system_subcategory_dropdown; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row content">
                <label class="col-sm-2 col-xs-12 control-label required-input" for="system">Equipment Category: </label>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group equipment-category">
                        <select class="form-control" name="equipment_category" id="equipment-category" required>

                            <?php echo $equipment_category_dropdown; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row content">
                <label class="col-sm-2 col-xs-12 control-label required-input" for="system">Equipment Class: </label>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <select class="form-control" name="equipment_class" id="equipment-class" required>
                            <?php echo $equipment_class_dropdown; ?>
                        </select>
                    </div>
                </div>
            </div>     
            <div class="row content">
                <label class="col-sm-2 col-xs-12 control-label required-input" for="system">Description:</label>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <select class="form-control equipment-category-dependent" name="equipment_description" id="equipment-description" required>

                            <?php echo $equipment_description_dropdown; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row content">
                <label class="col-sm-2 col-xs-12 control-label required-input" for="system">Code: </label>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <div class="form-group">
                            <input id="equipment-code" class="form-control equipment-category-dependent equipment-class-dependent equipment-" type="text" value="<?php echo $equipment_code_value; ?>" disabled="disabled" required />
                        </div>
                    </div>
                </div>
            </div>                         


            <!-- PURPOSE -->
            <div class="row content custom-tooltip-container generic-tooltip generic-medium">
                <div class="custom-tooltip">
                    <p></p>
                </div>
                <div class="col-xs-12">
                    <div class="page-header">
                        <h4 class="step-title">Purpose </h4>
                    </div>
                </div>
            </div> 


            <div class="row content">
                <div class="col-xs-12">
                    <div class="form-group form-group-required">
                        <?php echo $purpose; ?>
                    </div>
                </div>
            </div>


            <div class="row content custom-tooltip-container generic-tooltip generic-medium">
                <div class="custom-tooltip">
                    <p></p>
                </div>
                <div class="col-xs-12">
                    <div class="page-header">
                        <h4 class="step-title">Relevance <!-- <span class="tooltip-toggle help-icon"></span> --> </h4>
                    </div>
                </div>
            </div>


            <div class="row content">
                <div class="col-xs-12">
                    <div class="form-group form-group-required">
                        <textarea class="form-control textarea-editor medium" name="relevance"><?php echo $relevance; ?></textarea>
                    </div>
                </div>
            </div>



            <div class="row content">
                <div class="col-sm-4 col-sm-offset-8">


                </div>
            </div>






            <!-- RELEVANCE -->

            <div class="row content">
                <div class="col-sm-8 col-xs-12">



            <!-- <div class="row">
                <div class="col-xs-12">
                    <h4 class="step-title">Relevance</h4>
                </div>
            </div> -->
            

            


            <div class="row">
                <div class="col-xs-12">
                    <h4 class="step-title">Summary of Events and Findings</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group form-group-required">
                        <textarea class="form-control textarea-editor medium" name="summary"><?php echo $summary; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h4 class="step-title">Recommendations <!-- <span class="tooltip-toggle help-icon"></span> --> </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <textarea class="form-control textarea-editor medium" name="recommendation"><?php echo $recommendation; ?></textarea>
                    </div>
                </div>
            </div>

            
        </div>

        <div class="col-sm-4 col-xs-12">

            <div class="row">
                <div class="col-xs-12">
                    <h4 class="step-title">&nbsp;</h4>
                </div>
            </div>


            <!-- IMAGE 1 -->
            <div class="row">
                <div class="col-sm-12">
                    <label for="" class="control-label">Image 1</label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?php 
                    $data['single_upload'] = true;
                    $data['file_value'] = $image_1_filename;
                    $data['file_item_id'] = $image_1_id;
                    $data['upload_name'] = 'image_1';
                    $this->load->view('includes/casefile-upload', $data);
                    ?>
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
                        <textarea class="form-control" name="image_1_caption" rows="3"><?php echo $image_1_caption; ?></textarea>
                    </div>
                </div>
            </div>
            <!-- END IMAGE 1 -->

            <div class="row visible-xs">
                <div class="col-xs-12 no-padding"><hr></div>
            </div>

            <!-- IMAGE 2 -->
            <div class="row">
                <div class="col-sm-12">
                    <label for="" class="control-label">Image 2</label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?php 
                    $data['single_upload'] = true;
                    $data['file_value'] = $image_2_filename;
                    $data['file_item_id'] = $image_2_id;
                    $data['upload_name'] = 'image_2';
                    $this->load->view('includes/casefile-upload', $data);
                    ?>
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
                        <textarea class="form-control" name="image_2_caption" rows="3"><?php echo $image_2_caption; ?></textarea>
                    </div>
                </div>
            </div>
            <!-- END IMAGE 2 -->

            <div class="row visible-xs">
                <div class="col-xs-12 no-padding"><hr></div>
            </div>

            <!-- IMAGE 3 -->
            <div class="row">
                <div class="col-sm-12">
                    <label for="" class="control-label">Image 3</label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <?php 
                    $data['single_upload'] = true;
                    $data['file_value'] = $image_3_filename;
                    $data['file_item_id'] = $image_3_id;
                    $data['upload_name'] = 'image_3';
                    $this->load->view('includes/casefile-upload', $data);
                    ?>
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
                        <textarea class="form-control" name="image_3_caption" rows="3"><?php echo $image_3_caption; ?></textarea>
                    </div>
                </div>
            </div>
            <!-- END IMAGE 3 -->
            
        </div>
    </div>

    <!-- OPERATION -->
        <!-- <div class="row content custom-tooltip-container generic-tooltip generic-medium">
            <div class="custom-tooltip">
                <p></p>
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                    <h4 class="step-title">Recommendations <span class="tooltip-toggle help-icon"></span> </h4>
                </div>
            </div>
        </div>
  
      
        <div class="row content">
            <div class="col-xs-12">
                <div class="form-group">
                    <textarea class="form-control textarea-editor medium" name="recommendation"><?php echo $recommendation; ?></textarea>
                </div>
            </div>
        </div> -->




        <!-- OPERATION -->
        <div class="row content custom-tooltip-container generic-tooltip generic-medium">
            <div class="custom-tooltip">
                <p></p>
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                    <h4 class="step-title">Next Steps <!-- <span class="tooltip-toggle help-icon"></span> --> </h4>
                </div>
            </div>
        </div>


        <div class="row content">
            <div class="col-xs-12">
                <div class="form-group">
                    <textarea class="form-control textarea-editor medium" name="next_step"><?php echo $next_step; ?></textarea>
                </div>
            </div>
        </div>

        <div class="row content">

            <!-- IMAGE 4 -->
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="" class="control-label">Image 4</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php 
                        $data['single_upload'] = true;
                        $data['file_value'] = $image_4_filename;
                        $data['file_item_id'] = $image_4_id;
                        $data['upload_name'] = 'image_4';
                        $this->load->view('includes/casefile-upload', $data);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="" class="control-label">Image 4 Caption</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea class="form-control" name="image_4_caption" rows="5"><?php echo $image_4_caption; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END IMAGE 4 -->

            <div class="row visible-xs">
                <div class="col-xs-12"><hr></div>
            </div>

            <!-- IMAGE 5 -->
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="" class="control-label">Image 5</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php 
                        $data['single_upload'] = true;
                        $data['file_value'] = $image_5_filename;
                        $data['file_item_id'] = $image_5_id;
                        $data['upload_name'] = 'image_5';
                        $this->load->view('includes/casefile-upload', $data);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="" class="control-label">Image 5 Caption</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea class="form-control" name="image_5_caption" rows="5"><?php echo $image_5_caption; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END IMAGE 5 -->

            <div class="row visible-xs">
                <div class="col-xs-12"><hr></div>
            </div>

            <!-- IMAGE 6 -->
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="" class="control-label">Image 6</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php 
                        $data['single_upload'] = true;
                        $data['file_value'] = $image_6_filename;
                        $data['file_item_id'] = $image_6_id;
                        $data['upload_name'] = 'image_6';
                        $this->load->view('includes/casefile-upload', $data);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label for="" class="control-label">Image 6 Caption</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea class="form-control" name="image_6_caption" rows="5"><?php echo $image_6_caption; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END IMAGE 6 -->
            
        </div>

        <!-- <div id="add_more_div" class="row content">
            <div class="col-xs-12">
                <button id="add_more_button" class="btn btn-primary btn-bordered btn-block"><span class="glyphicon glyphicon-plus"></span>Add More Files</button>
            </div>
        </div> -->
        <div class="row content custom-tooltip-container generic-tooltip generic-medium">
            <div class="custom-tooltip">
                <p></p>
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                    <h4 class="step-title">Addtional Files</h4>
                </div>
            </div>
        </div>
        <div id="add_more_files" class="row content">
            <div class="col-xs-12">

                <div class="col-xs-6">
                    <?php $data['single_upload'] = false;  ?>
                    <?php $this->load->view('includes/casefile-upload', $data); ?>
                </div>
            </div>
        </div>
        <!-- File Upload -->

    </div>
    <!-- End of Panel Body -->

    <!-- Panel Footer -->
    <?php $this->load->view('includes/casefile-footer', $data); ?>
    <?php echo form_close(); ?>
</div>
<!-- End of Panel Default -->
