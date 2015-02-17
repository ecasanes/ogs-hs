<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success forensic-popover"></i></h4>

        <div class="panel-options">
            <span class="panel-code"><?php echo $code; ?></span>
        </div>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>
    	<?php $this->load->view('includes/document-status-snippet', $data); ?>

    	<div class="row content">
            <div class="col-xs-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8">
                            <h4 class="step-title">User Profile </h4>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <?php $this->load->view('includes/casefile-upload', $data); ?>                                                    
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


        <div class="row">
            <label class="control-label col-xs-12 col-sm-2">Username:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="user_name" id="user-name" placeholder="" disabled="disabled" value="<?php echo $user_name; ?>">
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2">Date:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" id="user-date" name="user_date" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $user_date; ?>">
                </div>
            </div>


       
            <label class="control-label col-xs-12 col-sm-2 required-input">CaseFile Name:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="name" value="<?php echo $name; ?>" id="case-file-name" class="form-control" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-2 control-label">
                <label for="code">Number:</label>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input disabled="disabled" type="text" name="code" id="code" class="form-control" value="<?php echo $code; ?>">
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2">Brief Summary:</label>
            <div class="col-xs-12 col-sm-8">
                <div class="form-group">
                    <textarea class="form-control textarea-editor medium" name="case_summary" id="case-summary" cols="30" rows="6" required><?php echo $case_summary; ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Add Additional:</label>
            <div class="col-xs-12 col-sm-10">
                <div class="row">
                    <div id="additional-user" class="dynamic-row">
                        <?php 
                            $user_counter = 0;
                            foreach($additional_users as $user){ 
                                $first_name = $user->first_name;
                                $last_name = $user->last_name;
                                $full_name = $first_name . '&nbsp; ' . $last_name;
                                if($full_name == ' '){
                                    $full_name = '';
                                }
                                $user_id = $user->user_id;
                                $user_name = $user->user_name;
                                $email_address = $user->email_address;

                                if($user_counter == 0){
                                    $user_class = 'left';
                                    $user_counter++;
                                }else if($user_counter == 1){
                                    $user_class = '';
                                    $user_counter = 0;
                                }
                        ?>
                        <div class="col-row col-xs-12 col-sm-6">
                            <div class="form-group">
                                <select name="additional_user_id[]" id="document_name" class="form-control new-user select2-dropdown">
                                    <option value=" <?php echo $user_id; ?>"><?php echo $full_name; ?></option> 
                                  <?php echo $user_option ?>
                                </select>
                            </div>
                            <div class="autosuggest form-group">
                                                    <ul class="user-suggest">

                                                    </ul>
                                                </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>                        
                                

        <div class="row content">
            <div class="col-xs-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-xs-8">
                            <h4 class="step-title">Asset Profile </h4>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-xs-12 col-sm-2 required-input">Asset Type:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="asset_type" id="asset-type" required>
                        <?php echo $asset_type_dropdown; ?>
                    </select>
                </div>
            </div>
        </div> 

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12 required-input">Justification:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="justification" id="justification" required>
                        <?php echo $justification_dropdown; ?>
                    </select>
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2 required-input">Date of Issue:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" id="date-of-issue" name="date_of_issue" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $date_of_issue; ?>">
                </div>
            </div>
        </div>                      

        <div class="row content">
            <div class="col-xs-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-xs-8">
                            <h4 class="step-title">Equipment Profile <i class="fa fa-question-circle text-success equipment_profile-popover"></i></h4>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="row content">
            <label class="control-label col-xs-12 col-sm-2 required-input">System:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="system" id="system" required>
                        <?php echo $system_dropdown; ?>
                    </select>
                </div>
            </div>

            <label class="control-label col-sm-2 col-xs-12">Power Output:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="equipment_power_output" id="equipment-power-output" placeholder="" value="<?php echo $equipment_power_output; ?>">
                </div>
            </div>
        </div>
        <div class="row content">
            <label class="control-label col-xs-12 col-sm-2 required-input">System Subcategory:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="system_subcategory" id="system_subcategory" required>
                        <?php echo $system_subcategory_dropdown; ?>
                    </select>
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2">Tag Number:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="equipment_tag_number" id="equipment-tag-number" placeholder="" value="<?php echo $equipment_tag_number; ?>">
                </div>
            </div>
        </div>
        <div class="row content">
            <label class="control-label col-sm-2 col-xs-12 required-input">Equipment Category:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="equipment_category" id="equipment-category" required>              
                        <?php echo $equipment_category_dropdown; ?>
                    </select>
                </div>
            </div>

            <label class="control-label col-sm-2 col-xs-12">Unique ID:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" id="equipment-unique-id" name="equipment_unique_id" class="form-control" placeholder="" value="<?php echo $equipment_unique_id; ?>">
                </div>
            </div>
        </div>
        <div class="row content">
            <label class="control-label col-xs-12 col-sm-2 required-input">Equipment Class:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="equipment_class" id="equipment-class" required>
                        <?php echo $equipment_class_dropdown; ?>
                    </select>
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2">Manufacturer:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="equipment_manufacturer" id="equipment-manufacturer" placeholder="" value="<?php echo $equipment_manufacturer; ?>">
                </div>
            </div>
        </div>
        <div class="row content">
            <label class="control-label col-sm-2 col-xs-12">Equipment Description:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="equipment_description" id="equipment-description">                       <?php echo $equipment_description_dropdown; ?>
                    </select>
                </div>
            </div>

            <label class="control-label col-sm-2 col-xs-12">Model:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" id="equipment-model" name="equipment_model" class="form-control" placeholder="" value="<?php echo $equipment_model; ?>">
                </div>
            </div>
        </div>
        <div class="row content">
            <label class="control-label col-xs-12 col-sm-2">Code:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input id="equipment-code" class="form-control" type="text" value="<?php echo $equipment_code; ?>" disabled="disabled" />
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2">Failed Component:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" id="equipment-failed-component" name="equipment_failed_component" class="form-control" placeholder="" value="<?php echo $equipment_failed_component; ?>">
                </div>
            </div>
        </div>                    
                                                  
	</div>
	<?php $this->load->view('includes/casefile-footer'); ?>
	<?php echo form_close(); ?>
</div>