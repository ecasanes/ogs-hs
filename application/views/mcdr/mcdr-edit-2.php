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
			<label class="col-sm-12 col-xs-12 mcdr-label"> OIE / Integrity Co-ordinator Recommendation (mandatory comment) : </label>
		</div>

		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="oie_integrity_coordinator_recommendation"><?php echo $oie_integrity_coordinator_recommendation; ?></textarea>
                </div>
			</div>
		</div>

		<div class="row">
			<label class="col-sm-3 col-xs-12 mcdr-label"> OIE / Integrity Co-ordinator </label>
			<div class="col-sm-5 col-xs-12">
				<div class="form-group">
                    <input type="text" class="form-control" name="oie_integrity_coordinator" placeholder="" value="<?php echo $oie_integrity_coordinator; ?>" >
                </div>
			</div>
			<label class="col-sm-1 col-xs-12 mcdr-label"> Date: </label>
			<div class="col-sm-3 col-xs-12">
				<div class="form-group">
                    <input type="text" class="form-control datepicker" name="oie_integrity_date" placeholder="" value="<?php echo $oie_integrity_date; ?>" >
                </div>
			</div>
		</div>


		<div class="row">
			<label class="col-sm-12 col-xs-12 mcdr-label"> Technical Authority Recommendation (comment mandatory if Temporary Repair -  include Risk Assessment, FFP &amp; Life of Repair)  : </label>
		</div>

		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="technical_authority_recommendation"><?php echo $technical_authority_recommendation; ?></textarea>
                </div>
			</div>
		</div>

		<div class="row">
			<label class="col-sm-3 col-xs-12 mcdr-label"> Technical Authority </label>
			<div class="col-sm-5 col-xs-12">
				<div class="form-group">
                    <input type="text" class="form-control" name="technical_authority" placeholder="" value="<?php echo $technical_authority; ?>" >
                </div>
			</div>
			<label class="col-sm-1 col-xs-12 mcdr-label"> Date: </label>
			<div class="col-sm-3 col-xs-12">
				<div class="form-group">
                    <input type="text" class="form-control datepicker" name="technical_authority_date" placeholder="" value="<?php echo $technical_authority_date; ?>" >
                </div>
			</div>
		</div>


		<div class="row">
			<label class="col-sm-12 col-xs-12 mcdr-label"> Closed Out (mandatory comment &amp; details)  :  </label>
		</div>

		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="closed_out"><?php echo $closed_out; ?></textarea>
                </div>
			</div>
		</div>

		<div class="row">
			<label class="col-sm-3 col-xs-12 mcdr-label"> OIE / Integrity Co-ordinator </label>
			<div class="col-sm-5 col-xs-12">
				<div class="form-group">
                    <input type="text" class="form-control" name="closed_out_coordinator" placeholder="" value="<?php echo $closed_out_coordinator; ?>" >
                </div>
			</div>
			<label class="col-sm-1 col-xs-12 mcdr-label"> Date: </label>
			<div class="col-sm-3 col-xs-12">
				<div class="form-group">
                    <input type="text" class="form-control datepicker" name="closed_out_date" placeholder="" value="<?php echo $closed_out_date; ?>" >
                </div>
			</div>
		</div>

	</div>
	<?php $this->load->view('includes/casefile-footer'); ?>
	<?php echo form_close(); ?>
</div>