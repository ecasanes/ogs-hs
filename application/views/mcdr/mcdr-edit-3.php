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
			<label class="col-sm-12 col-xs-12 mcdr-label"> PHOTO Log & findings (supplement with additional written details if necessary) : </label>
		</div>

		<div class="row">
			<div class="col-sm-6 col-xs-12">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group form-group-required">
                    <?php 
                        //$data['single_upload'] = true;
                        //$data['file_value'] = $image_1_filename;
                        //$data['upload_name'] = 'image_1';
                        //$this->load->view('includes/casefile-upload', $data);
                    ?>
                </div>
				</div>
				<div class="col-sm-12 col-xs-12">
					<label class="col-sm-12 col-xs-12 mcdr-label"> Image 1 Caption:  </label>
                </div>
                <div class="col-sm-12 col-xs-12">
					<div class="form-group">
                        <textarea class="form-control" name="image_1_caption" rows="3"></textarea>
                    </div>
                </div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group form-group-required">
                    <?php 
                        //$data['single_upload'] = true;
                        //$data['file_value'] = $image_1_filename;
                        //$data['upload_name'] = 'image_1';
                        //$this->load->view('includes/casefile-upload', $data);
                    ?>
                </div>
				</div>
				<div class="col-sm-12 col-xs-12">
					<label class="col-sm-12 col-xs-12 mcdr-label"> Image 2 Caption:  </label>
                </div>
                <div class="col-sm-12 col-xs-12">
					<div class="form-group">
                        <textarea class="form-control" name="image_1_caption" rows="3"></textarea>
                    </div>
                </div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group form-group-required">
                    <?php 
                        //$data['single_upload'] = true;
                        //$data['file_value'] = $image_1_filename;
                        //$data['upload_name'] = 'image_1';
                        //$this->load->view('includes/casefile-upload', $data);
                    ?>
                </div>
				</div>
				<div class="col-sm-12 col-xs-12">
					<label class="col-sm-12 col-xs-12 mcdr-label"> Image 3 Caption:  </label>
                </div>
                <div class="col-sm-12 col-xs-12">
					<div class="form-group">
                        <textarea class="form-control" name="image_1_caption" rows="3"></textarea>
                    </div>
                </div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group form-group-required">
                    <?php 
                        //$data['single_upload'] = true;
                        //$data['file_value'] = $image_1_filename;
                        //$data['upload_name'] = 'image_1';
                        //$this->load->view('includes/casefile-upload', $data);
                    ?>
                </div>
				</div>
				<div class="col-sm-12 col-xs-12">
					<label class="col-sm-12 col-xs-12 mcdr-label"> Image 4 Caption:  </label>
                </div>
                <div class="col-sm-12 col-xs-12">
					<div class="form-group">
                        <textarea class="form-control" name="image_1_caption" rows="3"></textarea>
                    </div>
                </div>
			</div>

            <div class="col-sm-6 col-xs-12">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group form-group-required">
                    <?php 
                        //$data['single_upload'] = true;
                        //$data['file_value'] = $image_1_filename;
                        //$data['upload_name'] = 'image_1';
                        //$this->load->view('includes/casefile-upload', $data);
                    ?>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <label class="col-sm-12 col-xs-12 mcdr-label"> Image 5 Caption:  </label>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <textarea class="form-control" name="image_1_caption" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-xs-12">
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group form-group-required">
                    <?php 
                        //$data['single_upload'] = true;
                        //$data['file_value'] = $image_1_filename;
                        //$data['upload_name'] = 'image_1';
                        //$this->load->view('includes/casefile-upload', $data);
                    ?>
                </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <label class="col-sm-12 col-xs-12 mcdr-label"> Image 6 Caption:  </label>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                        <textarea class="form-control" name="image_1_caption" rows="3"></textarea>
                    </div>
                </div>
            </div>
			
		</div>

		

	</div>
	<?php $this->load->view('includes/casefile-footer'); ?>
	<?php echo form_close(); ?>
</div>