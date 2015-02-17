<section id="main-content">
    <div class="container">
        <div class="row custom-tooltip-container step-tooltip">
            <div class="custom-tooltip">
                
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                    <h2 class="step-title align-title   ">Technical Bulletin <!-- <span class="tooltip-toggle help-icon"></span> --></h2>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">





        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
                    <?php $this->load->view('includes/initialize-form', $data); ?>
                    <div class="panel-body">
                        <div class="tab-content form-tabs">
                            <div class="tab-pane active" id="tab1">
    
                               
                                <?php $this->load->view('includes/completion-status', $data); ?>

                                <?php $this->load->view('includes/document-status-snippet', $data); ?>

                                

                                <!--    disable for now
                                <div class="row content">
                                                <div class="col-xs-4 col-xs-offset-8">
                                                    <?php 
                                                    //$single_upload = true;
                                                    //$file_value = $file_name;
                                                    //$upload_name = 'file_upload';
                                                    //$this->load->view('includes/casefile-upload', $data);
                                                ?>                                                  
                                                </div>
                                            </div> -->
                                <!-- TB INFO -->
                                <div class="row content">
                                    <div class="col-xs-3 column-label">
                                        <label for="author">TB Number</label>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="author" placeholder="" value="<?php echo $code; ?>" disabled>
                                        </div>
                                    </div>
                                </div>


                                <div class="row content">
                                    <div class="col-xs-3 column-label">
                                        <label for="author">Doc Title</label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="doc_title" placeholder="" value="<?php echo $doc_title; ?>" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="row content">
                                    <div class="col-xs-3 column-label">
                                        <label for="author">Author</label>
                                    </div>
                                    <div class="col-xs-4 ajax-autocomplete">
                                        <div class="form-group">
                                            <input type="text" class="form-control new-user" name="author" placeholder="Firstname Lastname" value="<?php echo $author; ?>" autocomplete="off" disabled>
                                            <input type="hidden" class="new-user-id" name="author_id" value="<?php echo $current_user_id; ?>">
                                        </div>
                                        <div class="autosuggest form-group">
                                            <ul class="user-suggest">

                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-xs-2 column-label">
                                        <label for="date">Date</label>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <input type="text" name="doc_date" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $doc_date; ?>">
                                        </div>
                                    </div>
                                </div>



                                


                                





                                <!-- Manufacturer Details -->
                                <div class="row content">
                                    <div class="col-xs-12">
                                        <div class="page-header">
                                            <h2 class="step-title">Profile</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content">
                                    <div class="col-xs-3 column-label">
                                        <label for="system">Category <span class="text-required">*</span></label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="form-group equipment-category">
                                            <select class="form-control" name="equipment_category" id="equipment-category" required>
                                                
                                                <?php echo $equipment_category_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content ">
                                    <div class="col-xs-3 column-label">
                                        <label for="system">Class <span class="text-required">*</span></label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="form-group">
                                            <select class="form-control " name="equipment_class" id="equipment-class" required>
                                                <?php echo $equipment_class_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content ">
                                    <div class="col-xs-3 column-label">
                                        <label for="system">Description <span class="text-required">*</span></label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="form-group">
                                            <select class="form-control " name="equipment_description" id="equipment-description">
                                                
                                                <?php echo $equipment_description_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content ">
                                    <div class="col-xs-3 column-label">
                                        <label for="system">Code <span class="text-required">*</span></label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <input id="equipment-code" class="form-control" type="text" value="<?php echo $equipment_code_value; ?>" disabled="disabled" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row content">
                                    <div class="col-xs-3 column-label">
                                        <label for="system">System <span class="text-required">*</span></label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="form-group">
                                            <select class="form-control" name="system" id="system" required>
                                                
                                                <?php echo $system_dropdown; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> 
                                <div class="row content">
                                    <div class="col-xs-3 column-label">
                                        <label for="system_subcategory">System Subcategory <span class="text-required">*</span></label>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="form-group">
                                            <select class="form-control" name="system_subcategory" id="system_subcategory" required>
                                                <?php echo $system_subcategory_dropdown; ?>
                                            </select>
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
                                            <h2 class="step-title">Purpose </h2>
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
                                            <h2 class="step-title">Relevance <!-- <span class="tooltip-toggle help-icon"></span> --> </h2>
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
                                    <div class="col-sm-8">

                                        

                                        <!-- <div class="row">
                                            <div class="col-xs-12">
                                                <h2 class="step-title">Relevance</h2>
                                            </div>
                                        </div> -->
                                        

                                        


                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h2 class="step-title">Summary of Events and Findings</h2>
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
                                                    <h2 class="step-title">Recommendations <!-- <span class="tooltip-toggle help-icon"></span> --> </h2>
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

                                    <div class="col-sm-4">

                                        <div class="row">
                                            <div class="col-xs-12">
                                                <h2 class="step-title">&nbsp;</h2>
                                            </div>
                                        </div>


                                        <!-- IMAGE 1 -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="strong">Image 1</p>
                                            </div>
                                        </div>

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
                                                <p class="strong">Image 1 Caption</p>
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



                                        <!-- IMAGE 2 -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="strong">Image 2</p>
                                            </div>
                                        </div>

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
                                                <p class="strong">Image 2 Caption</p>
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


                                        <!-- IMAGE 3 -->
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="strong">Image 3</p>
                                            </div>
                                        </div>

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
                                                <p class="strong">Image 3 Caption</p>
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
                                            <h2 class="step-title">Recommendations <span class="tooltip-toggle help-icon"></span> </h2>
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
                                            <h2 class="step-title">Next Steps <!-- <span class="tooltip-toggle help-icon"></span> --> </h2>
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
                                                <p class="strong">Image 4</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php 
                                                    $data['single_upload'] = true;
                                                    $data['file_value'] = $image_4_filename;
                                                    $data['upload_name'] = 'image_4';
                                                    $this->load->view('includes/casefile-upload', $data);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="strong">Image 4 Caption</p>
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

                                    <!-- IMAGE 5 -->
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="strong">Image 5</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php 
                                                    $data['single_upload'] = true;
                                                    $data['file_value'] = $image_5_filename;
                                                    $data['upload_name'] = 'image_5';
                                                    $this->load->view('includes/casefile-upload', $data);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="strong">Image 5 Caption</p>
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


                                    <!-- IMAGE 6 -->
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="strong">Image 6</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php 
                                                    $data['single_upload'] = true;
                                                    $data['file_value'] = $image_6_filename;
                                                    $data['upload_name'] = 'image_6';
                                                    $this->load->view('includes/casefile-upload', $data);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="strong">Image 6 Caption</p>
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




                               

                                

                                <?php $this->load->view('includes/casefile-footer', $data); ?>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>



    </div>
</section>