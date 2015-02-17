<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success pp-popover"></i></h4>
        <div class="panel-options">
            <span class="panel-code"><?php echo $document_header_name; ?></span>
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
                        <div class="col-sm-8 col-xs-12">
                            <h4 class="step-title">Administration </h4>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <?php $this->load->view('includes/casefile-upload', $data); ?>                                                    
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


        <div class="row">

            


            <label class="control-label col-xs-12 col-sm-2">Project Leader:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <div class="alternate-select-input input-group">
                        <input type="text" class="form-control alternate-input" name="author" placeholder="New Project Leader" value="<?php echo $author; ?>">
                        <select class="form-control alternate-select select2-dropdown" name="author">
                            <?php echo $project_leader_dropdown; ?>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-success alternate-button alt-select" type="button" title="add new">
                                <i class="fa fa-plus-circle fa-lg"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>


            <label class="control-label col-xs-12 col-sm-2 required-input">Date:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" id="date" name="date" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $date; ?>">
                </div>
            </div>

            

                

            <label class="control-label col-xs-12 col-sm-2">Project Sponsor:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="alternate-select-input input-group">
                    <input type="text" class="form-control alternate-input" name="person_in_charge" placeholder="New Project Sponsor" value="<?php echo $person_in_charge; ?>">
                    <select class="form-control alternate-select select2-dropdown" name="person_in_charge">
                        <?php echo $project_sponsor_dropdown; ?>
                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-success alternate-button alt-select" type="button" title="add new">
                            <i class="fa fa-plus-circle fa-lg"></i>
                        </button>
                    </span>
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2 required-input">Target Start Date :</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" id="estimated_start_date" name="estimated_start_date" class="form-control datepicker " placeholder="Select the Date" value="<?php echo $estimated_start_date; ?>" required>
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2 required-input">Project Name: </label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="name" value="<?php echo $name; ?>" id="name" class="form-control" required>    
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2 required-input">Project Duration:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <div class="input-group">
                        <input type="number" min="1" max="9999999" id="estimated_project_duration" name="estimated_project_duration_number" class="form-control" value="<?php echo $estimated_project_duration_number; ?>" required>
                        <span class="input-group-addon"> - </span>
                        <select name="estimated_project_duration_days" id="" class="form-control">
                            <option value="Days" <?php if($estimated_project_duration_days == 'Days'){ echo 'selected';} ?>> Day / s </option>
                            <option value="Weeks" <?php if($estimated_project_duration_days == 'Weeks'){ echo 'selected';} ?>> Week / s </option>
                            <option value="Months" <?php if($estimated_project_duration_days == 'Months'){ echo 'selected';} ?>> Month / s </option>
                        </select>
                    </div>
                </div>
            </div>
            

            

            

            <label class="control-label col-xs-12 col-sm-2">Project Condition:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="project_condition" id="project_condition">
                        <?php echo $project_condition_dropdown; ?>
                    </select>
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2">Costs:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" id="costs" name="costs" class="form-control" value="<?php echo $cost_breakdown_estimated_total; ?>" disabled>
                </div>
            </div>

            <label class="control-label col-xs-12 col-sm-2 required-input">Justification <br> for Change:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="justification" id="justification" required>
                        <?php echo $justification_dropdown; ?>
                    </select>
                </div>
            </div>

            

            
            

            

            <label class="control-label col-xs-12 col-sm-2">Work Party:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <select class="form-control" name="work_party" id="work_party">
                        <?php echo $work_party_dropdown; ?>
                    </select>
                </div>
            </div>
            
            
        </div>

	</div>

	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>