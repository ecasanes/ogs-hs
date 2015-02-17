<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4><?php echo $step_title; ?> <i class="fa fa-question-circle text-success erp-popover"></i></h4>
	</div>


	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>
    	<?php $this->load->view('includes/document-status-snippet', $data); ?>


    	<div class="row content">
                                        <div class="col-xs-12">
                                            <div class="page-header">
                                                <div class="row">
                                                    <div class="col-xs-8">
                                                        <h4 class="step-title">Profile </h4>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <?php $this->load->view('includes/casefile-upload', $data); ?>                                                    
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <div class="row content">
                                        <div class="col-xs-3 column-label">
                                            <label for="equipment_description">Equipment Description</label>
                                        </div>
                                        <div class="col-xs-9">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="erp_equipment_description" placeholder="" value="<?php echo $erp_equipment_description; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row content form-group">
                                        <div class="col-sm-3 column-label"></div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="">Role</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>





                                    <div class="row content custom-tooltip-container generic-tooltip generic-medium">
                                        <div class="col-sm-3 column-label">
                                            <p class="strong">Responsible Parties
                                                <span class="tooltip-toggle help-icon"></span>
                                            </p>
                                        </div>


                                        <div class="col-sm-9">
                                            <div id="responsible-party-role-table" class="dynamic-row">
                                                <?php 
                                                foreach($responsible_party_roles as $user){ 

                                                    $role_dropdown = $user['role'];

                                                    $first_name = $user['firstname'];
                                                    $last_name = $user['lastname'];
                                                    $full_name = $first_name . ' ' . $last_name;
                                                    if($full_name == ' '){
                                                        $full_name = '';
                                                    }
                                                    $user_id = $user['user_id'];
                                                    ?>
                                                    <div class="row col-row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <select class="form-control" name="responsible_party_role[]" id="responsible_party_role">
                                                                    <?php echo $role_dropdown; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 additional-user ajax-autocomplete">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control new-user" name="additional_user[]" placeholder="Firstname Lastname" value="<?php echo $full_name; ?>" autocomplete="off">
                                                                <input type="hidden" class="new-user-id" name="responsible_party_role_user_id[]" value="<?php echo $user_id; ?>">
                                                            </div>
                                                            <div class="autosuggest form-group">
                                                                <ul class="user-suggest">

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="row content custom-tooltip-container generic-tooltip generic-medium">
                                        <div class="col-sm-3 column-label">
                                            <p class="strong">Interested Parties
                                                <!--<span class="tooltip-toggle help-icon"></span>-->
                                            </p>
                                        </div>


                                        <div class="col-sm-9">
                                            <div id="interested-party-role-table" class="dynamic-row">
                                                <?php 
                                                foreach($interested_party_roles as $user){ 

                                                    $role_dropdown = $user['role'];

                                                    $first_name = $user['firstname'];
                                                    $last_name = $user['lastname'];
                                                    $full_name = $first_name . ' ' . $last_name;
                                                    if($full_name == ' '){
                                                        $full_name = '';
                                                    }
                                                    $user_id = $user['user_id'];
                                                    ?>
                                                    <div class="row col-row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <select class="form-control" name="interested_party_role[]" id="responsible_party_role">
                                                                    <?php echo $role_dropdown; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 additional-user ajax-autocomplete">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control new-user" name="additional_user[]" placeholder="Firstname Lastname" value="<?php echo $full_name; ?>" autocomplete="off">
                                                                <input type="hidden" class="new-user-id" name="interested_party_role_user_id[]" value="<?php echo $user_id; ?>">
                                                            </div>
                                                            <div class="autosuggest form-group">
                                                                <ul class="user-suggest">

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>







                                            <div class="row content">
                                                <div class="col-xs-3 column-label">
                                                    <p class="strong">Repair Criticality</p>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <select class="form-control" name="repair_criticality" id="repair_criticality">
                                                            <?php echo $repair_criticality_dropdown; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xs-2 column-label">
                                                    <label for="date_of_raised">Date of Raised</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <input type="text" id="date-of-raised" name="date_of_raised" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $date_of_raised; ?>">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row content">
                                                <div class="col-xs-3 column-label required-input">
                                                    <p class="strong">Criticality Justification</p>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <select class="form-control" name="criticality_justification" id="criticality_justification" required>
                                                            <?php echo $criticality_justification_dropdown; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-2 column-label">
                                                    <label for="date_reqd_on_board">Date Reqd <br>on-board</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <input type="text" id="date-reqd-on-board" name="date_reqd_on_board" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $date_reqd_on_board; ?>">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row content">
                                                <div class="col-xs-3 column-label">
                                                    <label for="equipment_tag_number">Work Order Number</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="work_order_number" id="equipment-tag-number" placeholder="" value="<?php echo $work_order_number; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-xs-2 column-label">
                                                    <label for="equipment_unique_id">Case Number</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <input disabled="disabled" type="text" name="code" id="code" class="form-control" value="<?php echo $code; ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row content">
                                                <div class="col-xs-3 column-label">
                                                    <label for="equipment_repair_history required-input">Equipment Repair History </label>
                                                </div>
                                                <div class="col-xs-9">
                                                    <div class="form-group form-group-required">
                                                        <textarea class="form-control" name="equipment_repair_history" id="case-summary" cols="30" rows="5" required><?php echo $equipment_repair_history; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="row content">
                                                <div class="col-xs-12">
                                                    <div class="page-header">
                                                        <h4 class="step-title">Asset Profile</h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row content">
                                                <div class="col-xs-3 column-label required-input">
                                                    <label for="asset_type">Asset Type </label>
                                                </div>
                                                <div class="col-xs-9">
                                                    <div class="form-group">
                                                        <select class="form-control" name="asset_type" id="asset-type" required>
                                                            <?php echo $asset_type_dropdown; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row content">
                                                <div class="col-xs-3 column-label required-input">
                                                    <label for="justification">Justification </label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <select class="form-control" name="justification" id="justification" required>
                                                            <?php echo $justification_dropdown; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-xs-2 column-label required-input">
                                                    <label for="date_of_issue">Date of Issue</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <input type="text" id="date-of-issue" name="date_of_issue" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $date_of_issue; ?>">
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="row content">
                                                <div class="col-xs-12">
                                                    <div class="page-header">
                                                        <h4 class="step-title">Equipment Profile</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row content">
                                                <div class="col-xs-3 column-label required-input">
                                                    <label for="system">System </label>
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
                                                <div class="col-xs-3 column-label required-input">
                                                    <label for="system_subcategory">System Subcategory </label>
                                                </div>
                                                <div class="col-xs-9">
                                                    <div class="form-group">
                                                        <select class="form-control" name="system_subcategory" id="system_subcategory" required>
                                                            <?php echo $system_subcategory_dropdown; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row content">
                                                <div class="col-xs-3 column-label required-input">
                                                    <label for="equipment_category">Equipment Category </label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <select class="form-control" name="equipment_category" id="equipment-category" required>
                                                            <?php echo $equipment_category_dropdown; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-2 column-label required-input">
                                                    <label for="equipment_class">Class </label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <select class="form-control" name="equipment_class" id="equipment-class" required>
                                                            <?php echo $equipment_class_dropdown; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row content">
                                                <div class="col-xs-3 column-label">
                                                    <label for="equipment_description">Description</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <select class="form-control" name="equipment_description" id="equipment-description">
                                                            <?php echo $equipment_description_dropdown; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-2 column-label">
                                                    <label for="equipment_code">Code</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <input id="equipment-code" class="form-control" type="text" value="<?php echo $equipment_code; ?>" disabled="disabled" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row content">
                                                <div class="col-xs-3 column-label">
                                                    <label for="equipment_tag_number">Tag Number</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="equipment_tag_number" id="equipment-tag-number" placeholder="" value="<?php echo $equipment_tag_number; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-xs-2 column-label">
                                                    <label for="equipment_unique_id">Unique ID</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <input type="text" id="equipment-unique-id" name="equipment_unique_id" class="form-control" placeholder="" value="<?php echo $equipment_unique_id; ?>">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row content">
                                                <div class="col-xs-3 column-label">
                                                    <label for="equipment_manufacturer">Manufacturer</label>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="equipment_manufacturer" id="equipment-manufacturer" placeholder="" value="<?php echo $equipment_manufacturer; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-xs-2 column-label">
                                                    <label for="equipment_model">Model</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <input type="text" id="equipment-model" name="equipment_model" class="form-control" placeholder="" value="<?php echo $equipment_model; ?>">
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row content">
                                                <div class="col-xs-3 column-label">
                                                    <label for="equipment_power_output">Power Output</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="equipment_power_output" id="equipment-power-output" placeholder="" value="<?php echo $equipment_power_output; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-xs-3 column-label">
                                                    <label for="equipment_failed_component">Failed Component</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <input type="text" id="equipment-failed-component" name="equipment_failed_component" class="form-control" placeholder="" value="<?php echo $equipment_failed_component; ?>">
                                                    </div>
                                                </div>
                                            </div>
	</div>

	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>