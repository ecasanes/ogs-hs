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
            <label class="col-sm-12 col-xs-12 mcdr-label">Floor Plans:</label>
        </div>


        <div id="no-floor-plan" class="hidden">
            <p>There are no Floor Plans created. <button type="button" class="btn btn-info new-floor-plan-row btn-sm">Create One.</button></p>
        </div> 

        <div id="no-search-found" class="hidden">
            <p>There are no Floor Plans found. </p>
        </div>
                                  
        <div id="loading-floor-plan" class="hidden">
            <i class="fa fa-refresh fa-spin"></i>  Loading Floor Plans...
        </div>

        <div class="text-center" id="floor-plan-table-container">
            <table id="floor-plan-ajax" class="table table-bordered table-condensed">
                <thead> </thead>
                <tbody> </tbody>
            </table>

            <div class="add-floor-plan-row hidden">
                <div class="row">
                    <div class="col-sm-offset-10 col-sm-2 text-right">
                        <button type="button" class="btn btn-info new-floor-plan-row btn-sm"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                &nbsp;
            </div>
        </div>
	
        <div class="row">
            <label class="col-sm-12 col-xs-12 mcdr-label"> MODULE PLOT PLAN (show location of defect) :  </label>
        </div>

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="module_plot_plan"><?php echo $module_plot_plan; ?></textarea>
                </div>
            </div>
        </div>

	</div>
	<?php $this->load->view('includes/casefile-footer'); ?>
	<?php echo form_close(); ?>
</div>