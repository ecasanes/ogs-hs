<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success cf-step5-popover"></i></h4>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>


    	<div class="row content">
          <div class="col-xs-12">
              <div class="page-header">
                  <div class="row">
                      <div class="col-xs-12 col-sm-8">
                          <h4 class="step-title"><!-- Summary <span class="text-required">*</span> --></h4>
                      </div>
                      <div class="col-xs-12 col-sm-4">
                          <?php $this->load->view('includes/casefile-upload', $data); ?>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>


      <div class="row content">
      <div class="col-xs-12">
        <div class="page-header">
          <div class="row">
            <div class="col-xs-7">
              <h4 class="step-title">Test Process</h4>
            </div>

          </div>

        </div>
      </div>
    </div>



    <div class="row content hidden-xs">
      <div class="col-sm-6">
        <label for="" class="control-label">Event</label>
      </div>
      <div class="col-sm-6">
        <label for="" class="control-label">Responsible</label>
      </div>
    </div>


    <div id="responsible-party-table" class="dynamic-row">
      <?php
      foreach($responsible_parties as $party){
        $event = $party->event;
        $responsible = $party->responsible;
        ?>
        <div class="row content">
          <div class="col-sm-6 tinymce-textarea">
            <div class="form-group form-group-required">
              <label for="" class="control-label visible-xs">Event</label>
              <textarea class="form-control textarea-editor medium" name="event[]" cols="30" rows="20"><?php echo $event; ?></textarea>
            </div>
          </div>
          <div class="col-sm-6 tinymce-textarea">
            <div class="form-group form-group-required">
              <label for="" class="control-label visible-xs">Responsible</label>
              <textarea class="form-control textarea-editor medium" name="responsible[]" cols="30" rows="20"><?php echo $responsible; ?></textarea>
            </div>
          </div>
        </div>
        <hr class="visible-xs">
        <?php } ?>
      </div>


      <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h4 class="step-title">Pass or Fail <span class="tooltip-toggle help-icon"></span> </h4>
          </div>
        </div>
      </div>





      <div class="row content">
        <div class="col-xs-12">
          <div class="form-group form-group-required">
            <textarea class="form-control textarea-editor medium" name="pass_or_fail" id="pass_or_fail" cols="30" rows="25"><?php echo $pass_or_fail; ?></textarea>
          </div>
        </div>
      </div>


                        
	</div>



	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>