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
            <label class="col-sm-12 col-xs-12 mcdr-label"> P&amp;ID / ISO (show location of defect) :  </label>
        </div>

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="pid_iso"><?php echo $pid_iso; ?></textarea>
                </div>
            </div>
        </div>

	</div>
	<?php $this->load->view('includes/casefile-footer'); ?>
	<?php echo form_close(); ?>
</div>