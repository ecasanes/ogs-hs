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
                    <input type="text" class="form-control" name="cont_location" placeholder="" value="<?php echo $cont_location; ?>" >
                </div>
            </div>
            <label class="col-sm-2 col-xs-12 mcdr-label"> Date: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="cont_date" placeholder="" value="<?php echo $cont_date; ?>" >
                </div>
            </div>

            <label class="col-sm-2 col-xs-12 mcdr-label"> CAN Job No: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_job_no" placeholder="" value="<?php echo $cont_job_no; ?>" >
                </div>
            </div>
            <label class="col-sm-2 col-xs-12 mcdr-label"> Report No: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_report_no" placeholder="" value="<?php echo $cont_report_no; ?>" >
                </div>
            </div>

            <label class="col-sm-2 col-xs-12 mcdr-label"> Client Order No: </label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_client_no" placeholder="" value="<?php echo $cont_client_no; ?>" >
                </div>
            </div>
            <label class="col-sm-1 col-xs-12 mcdr-label"> Sheet: </label>
            <div class="col-sm-2 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_sheet" placeholder="" value="<?php echo $cont_sheet; ?>" >
                </div>
            </div>

            <label class="col-sm-1 col-xs-12 mcdr-label"> Of: </label>
            <div class="col-sm-2 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_sheet_of" placeholder="" value="<?php echo $cont_sheet_of; ?>" >
                </div>
            </div>
        </div>

        <div class="row">
            <label class="col-sm-12 col-xs-12 mcdr-label"> Component/Description/Drawing No.</label>
        </div>

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="cont_component_description"><?php echo $cont_component_description; ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group form-group-required">
                    <?php 
                        //$data['single_upload'] = true;
                        //$data['file_value'] = $image_1_filename;
                        //$data['upload_name'] = 'image_1';
                        $this->load->view('includes/casefile-upload', $data);
                    ?>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <label class="col-sm-12 col-xs-12 mcdr-label"> Image Caption:  </label>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <textarea class="form-control" name="cont_image_caption" rows="3"><?php echo $cont_image_caption; ?></textarea>
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
                    <input type="text" class="form-control" name="cont_inspector_sign" placeholder="" value="<?php echo $cont_inspector_sign; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Name</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_inspector_name" placeholder="" value="<?php echo $cont_inspector_name; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Quals</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_inspector_quals" placeholder="" value="<?php echo $cont_inspector_quals; ?>" >
                </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">
                <label class="col-sm-3 col-xs-12 mcdr-label">Sign</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_issuing_authority_sign" placeholder="" value="<?php echo $cont_issuing_authority_sign; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Name</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_issuing_authority_name" placeholder="" value="<?php echo $cont_issuing_authority_name; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Date</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="cont_issuing_authority_date" placeholder="" value="<?php echo $cont_issuing_authority_date; ?>" >
                </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4">
                <label class="col-sm-3 col-xs-12 mcdr-label">Sign</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_client_sign" placeholder="" value="<?php echo $cont_client_sign; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Name</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="cont_client_name" placeholder="" value="<?php echo $cont_client_name; ?>" >
                </div>
                </div>
                <label class="col-sm-3 col-xs-12 mcdr-label">Date</label>
                <div class="col-sm-9 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="cont_client_date" placeholder="" value="<?php echo $cont_client_date; ?>" >
                </div>
                </div>
            </div>
             
        </div>

	</div>
	<?php $this->load->view('includes/casefile-footer'); ?>
	<?php echo form_close(); ?>
</div>