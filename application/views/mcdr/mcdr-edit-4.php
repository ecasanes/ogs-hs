<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?></h4>

        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
        </div>
	</div>


	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>	
		<?php $this->load->view('includes/completion-status', $data); ?>
    	<?php //$this->load->view('includes/document-status-snippet', $data); ?>
	
		<div class="row">
            <label class="col-sm-2 col-xs-12 mcdr-label"> Location: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_location" placeholder="" value="<?php echo $can_location; ?>" >
                </div>
            </div>
            <label class="col-sm-2 col-xs-12 mcdr-label"> Date: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="can_date" placeholder="" value="<?php echo $can_date; ?>" >
                </div>
            </div>

            <label class="col-sm-2 col-xs-12 mcdr-label"> CAN Job No: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_job_no" placeholder="" value="<?php echo $can_job_no; ?>" >
                </div>
            </div>
            <label class="col-sm-2 col-xs-12 mcdr-label"> Report No: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_report_no" placeholder="" value="<?php echo $can_report_no; ?>" >
                </div>
            </div>

            <label class="col-sm-2 col-xs-12 mcdr-label"> Client Order No: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="client_order_no" placeholder="" value="<?php echo $client_order_no; ?>" >
                </div>
            </div>
            <label class="col-sm-1 col-xs-12 mcdr-label"> Sheet: </label>
            <div class="col-sm-2 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_sheet" placeholder="" value="<?php echo $can_sheet; ?>" >
                </div>
            </div>

            <label class="col-sm-1 col-xs-12 mcdr-label"> Of: </label>
            <div class="col-sm-2 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_sheet_of" placeholder="" value="<?php echo $can_sheet_of; ?>" >
                </div>
            </div>
        </div>

		<div class="row">
            <label class="col-sm-12 col-xs-12 mcdr-label"> Component/Description/Drawing No.</label>
        </div>

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="component_description_drawing"><?php echo $component_description_drawing; ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <label class="col-sm-2 col-xs-12 mcdr-label"> Material: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="material" placeholder="" value="<?php echo $material; ?>" >
                </div>
            </div>
            <label class="col-sm-2 col-xs-12 mcdr-label"> Surface Condition: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="surface_condition" placeholder="" value="<?php echo $surface_condition; ?>" >
                </div>
            </div>

            <label class="col-sm-2 col-xs-12 mcdr-label"> Procedure/Work Instruction/Technique: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="procedure_work_instruction" placeholder="" value="<?php echo $procedure_work_instruction; ?>" >
                </div>
            </div>
            <label class="col-sm-2 col-xs-12 mcdr-label"> Acceptance Standard: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="acceptance_standard" placeholder="" value="<?php echo $acceptance_standard; ?>" >
                </div>
            </div>

            <label class="col-sm-2 col-xs-12 mcdr-label"> Equipment Make &amp; Model: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="equipment_make_model" placeholder="" value="<?php echo $equipment_make_model; ?>" >
                </div>
            </div>
            <label class="col-sm-2 col-xs-12 mcdr-label"> Serial No: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="material_serial_no" placeholder="" value="<?php echo $material_serial_no; ?>" >
                </div>
            </div>

            <label class="col-sm-2 col-xs-12 mcdr-label"> Probe Type Frequency and Type: </label>
            <div class="col-sm-10 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="probe_type_frequency" placeholder="" value="<?php echo $probe_type_frequency; ?>" >
                </div>
            </div>

            <label class="col-sm-1 col-xs-12 mcdr-label"> Couplant: </label>
            <div class="col-sm-3 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="couplant" placeholder="" value="<?php echo $couplant; ?>" >
                </div>
            </div>

            <label class="col-sm-1 col-xs-12 mcdr-label"> Test Blocks: </label>
            <div class="col-sm-3 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="test_blocks" placeholder="" value="<?php echo $test_blocks; ?>" >
                </div>
            </div>

            <label class="col-sm-1 col-xs-12 mcdr-label"> Calibration Range(s): </label>
            <div class="col-sm-3 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="calibration_range" placeholder="" value="<?php echo $calibration_range; ?>" >
                </div>
            </div>
        </div>


        <div class="row">
            <label class="col-sm-12 col-xs-12 mcdr-label"> Result</label>
        </div>

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="can_results"><?php echo $can_results; ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <label class="col-sm-2 col-xs-12 mcdr-label"> Associative Reports: </label>
            <div class="col-sm-10 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="associative_reports" placeholder="" value="<?php echo $associative_reports; ?>" >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <label class="col-sm-12 col-xs-12 mcdr-label">Feature:</label>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_feature" placeholder="" value="<?php echo $can_feature; ?>" >
                </div>
            </div>
            </div>
            <div class="col-sm-2">
                <label class="col-sm-12 col-xs-12 mcdr-label">Type.</label>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_type" placeholder="" value="<?php echo $can_type; ?>" >
                </div>
            </div>
            </div>
            <div class="col-sm-2">
                <label class="col-sm-12 col-xs-12 mcdr-label">Scan</label>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_scan" placeholder="" value="<?php echo $can_scan; ?>" >
                </div>
            </div>
            </div>
            <div class="col-sm-2">
                <label class="col-sm-12 col-xs-12 mcdr-label">Min</label>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_min" placeholder="" value="<?php echo $can_min; ?>" >
                </div>
            </div>
            </div>
            <div class="col-sm-2">
                <label class="col-sm-12 col-xs-12 mcdr-label">Location</label>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_min_location" placeholder="" value="<?php echo $can_min_location; ?>" >
                </div>
            </div>
            </div>
            <div class="col-sm-2">
                <label class="col-sm-12 col-xs-12 mcdr-label">Line Number</label>
                <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_line_number" placeholder="" value="<?php echo $can_line_number; ?>" >
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <label class="col-sm-12 col-xs-12 mcdr-label">CAN Inspector</label>
            </div>
            <div class="col-xs-12 col-sm-4">
                <label class="col-sm-12 col-xs-12 mcdr-label">Issuing Authority</label>
            </div>
            <div class="col-xs-12 col-sm-4">
                <label class="col-sm-12 col-xs-12 mcdr-label">Client</label>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <label class="col-sm-3 col-xs-12 mcdr-label">Sign</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_inspector_sign" placeholder="" value="<?php echo $can_inspector_sign; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Name</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_inspector_name" placeholder="" value="<?php echo $can_inspector_name; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Quals</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="can_inspector_quals" placeholder="" value="<?php echo $can_inspector_quals; ?>" >
                </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">
                <label class="col-sm-3 col-xs-12 mcdr-label">Sign</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="issuing_authority_sign" placeholder="" value="<?php echo $issuing_authority_sign; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Name</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="issuing_authority_name" placeholder="" value="<?php echo $issuing_authority_name; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Date</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="issuing_authority_date" placeholder="" value="<?php echo $issuing_authority_date; ?>" >
                </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">
                <label class="col-sm-3 col-xs-12 mcdr-label">Sign</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="client_sign" placeholder="" value="<?php echo $client_sign; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Name</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="client_name" placeholder="" value="<?php echo $client_name; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Date</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="client_date" placeholder="" value="<?php echo $client_date; ?>" >
                </div>
                </div>
            </div>
             
        </div>

	</div>
	<?php $this->load->view('includes/casefile-footer'); ?>
	<?php echo form_close(); ?>
</div>