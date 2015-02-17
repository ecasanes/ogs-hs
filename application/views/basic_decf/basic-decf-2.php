<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success step1-basic-popover"></i></h4>
    <div class="panel-options">
      <span class="panel-code"><?php echo $document_header_name; ?></span>
    </div>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
   <?php $this->load->view('includes/completion-status', $data); ?>

   <!-- <div class="row">
     <div class="col-xs-12">
      <div class="page-header">
        <h4 class="step-title">Summary of Events<span class="text-required"></span></h4>
      </div>
    </div>
     </div>
   
     <div class="row">
    <div class="col-xs-12">
      <div class="form-group">
        <textarea rows="6" class="form-control textarea-editor medium" name="summary" cols="30" rows="25"><?php echo $summary; ?></textarea>
      </div>
    </div>
     </div> -->
  

  <div class="row">
    <div class="col-xs-12">
      <div class="page-header">
        <h4 class="step-title">Timeline leading to Failure <i class="fa fa-question-circle text-success timeline-basic-popover"></i></span></h4>
      </div>
    </div>
  </div>





  <div class="row content hidden-xs">
    <div class="col-sm-7">
      <label class="control-label">Event</label>
    </div>
    <div class="col-sm-5">
      <div class="row">
        <div class="col-sm-8"><label class="control-label">Date</label></div>
        <div class="col-sm-4"><label class="control-label">Status</label></div>
      </div>
    </div>
  </div>


  <div id="timeline-table" class="dynamic-row">
    <?php
    foreach($timelines as $timeline){
      $timeline_date = $timeline['timeline_date'];
      $event = $timeline['event'];
      $timeline_status_dropdown = $timeline['timeline_status_dropdown'];
      ?>
      <div class="row content">
        <div class="col-sm-7">
          <div class="form-group form-group-required">
            <label class="visible-xs control-label">Event</label>
            <textarea class="form-control no-resize" name="event[]" cols="30" rows="3"><?php echo $event; ?></textarea>
          </div>
        </div>
        <div class="col-sm-5">
          <div class="row">
            <div class="col-sm-8">
              <label for="" class="visible-xs control-label">Date</label>
              <input type="text" id="detection_date" name="timeline_date[]" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $timeline_date; ?>">




            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label for="" class="visible-xs control-label">Status</label>
                <select name="status[]" class="form-control no-padding">
                  <?php echo $timeline_status_dropdown; ?>
                </select>
              </div>
              <input type="hidden" name="time[]" class="form-control no-padding" value="<?php echo date('g:i A'); ?>" />
            </div>
          </div>
        </div>


      </div>
      <br>
      <?php } ?>
    </div>


    <div class="row">
      <div class="col-xs-12">
        <div class="page-header">
          <h4>Failure Impact</h4>
        </div>
      </div>
    </div>
    

    <div class="row content text-left hidden-xs">
      <div class="col-sm-3">
        <label class="control-label required-input">Area of Impact </label>
      </div>
      <div class="col-sm-3 text-left">
        <label class="control-label required-input">Consequence </label>
      </div>
      <div class="col-sm-6 text-left">
        <label class="control-label">Description</label>
      </div>
    </div>

    <div id="consequence-table">
      <?php 
      foreach($failure_impacts as $impact){ 
        $area_of_impact = $impact['area_of_impact'];
        $consequence = $impact['consequence'];
        $consequence_description = $impact['area_of_impact_description'];
        $consequence_value = $impact['consequence_value'];
        ?>
        <div class="row content consequence">

          <div class="col-sm-3">
            <div class="form-group">
              <label for="" class="control-label visible-xs">Area of Impact</label>
              <select class="consequence-area-impact  form-control required-at-least" name="area_of_impact[]">
                <?php echo $area_of_impact; ?>
              </select>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="" class="control-label visible-xs">Consequence</label>
              <select  class="consequence-priority form-control color-select <?php echo $consequence_value; ?>" name="consequence[]">
                <?php echo $consequence; ?>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <label for="" class="control-label visible-xs">Description</label>
            <textarea disabled="disabled" class="div-textarea consequence-description form-control" name="area_of_impact_description[]">
              <?php echo $consequence_description; ?>
            </textarea>
            <br>
          </div>

        </div>
        <br>
        <?php } ?>
      </div>









      <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h4 class="step-title">Method of Detection <i class="fa fa-question-circle text-success method-basic-popover"></i></span></h4>
          </div>
        </div>
      </div>
      
      <div class="row">
        <label for="detection_notification" class="control-label col-xs-12 col-sm-2 required-input">Notification </label>
        <div class="col-xs-12 col-sm-4">
          <div class="form-group">
            <select class="form-control tooltipped" name="detection_notification" id="detection_notification" required>
              <?php echo $detection_notification_dropdown; ?>
            </select>
          </div>
        </div>


        <label for="detection_date" class="control-label col-xs-12 col-sm-2 required-input">Date</label>
        <div class="col-xs-12 col-sm-4">
          <div class="form-group">
            <input type="text" id="detection_date" name="detection_date" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $detection_date; ?>">
          </div>
        </div>
      </div>

      <div class="row">
        <label for="detection_description" class="control-label col-xs-12 col-sm-2">Description</label>
        <div class="col-xs-12 col-sm-10">
          <div class="form-group">
            <textarea disabled="disabled" class="form-control" name="detection_description" id="detection_description" cols="30" rows="4"><?php echo $detection_description; ?></textarea>
          </div>
        </div>
      </div>
      
      <input type="hidden" value="<?php echo $detection_details; ?>" name="detection_details">
        <!-- <div class="row content">
            <div class="col-lg-3 col-sm-3">
                
                    <label for="detection_details">Details <span class="text-required">*</span></label>
                
            </div>
            <div class="col-lg-9 col-sm-9">
                <div class="form-group">
                    <textarea class="form-control textarea-editor medium" name="detection_details" id="detection_details" cols="30" rows="5" required><?php echo $detection_details; ?></textarea>
                </div>
            </div>
          </div> -->



          <div class="row">
            <div class="col-xs-12">
              <div class="page-header">
                <h4 class="step-title">Failure Mode <i class="fa fa-question-circle text-success failure-basic-popover"></i></span></h4>
              </div>
            </div>
          </div>
          


          <div id="failure-mode-tooltip">

            <div class="row">
              <div class="form-group">
                <label for="failure_notification" class="col-xs-12 col-sm-2 control-label required-input">Notification </label>
                <div class="col-xs-12 col-sm-10">
                  <div class="form-group">
                    <select class="form-control" name="failure_notification" id="failure-notification" required>
                      <?php echo $failure_notification; ?>
                    </select>
                  </div>
                </div>
              </div>
              
            </div>
            


            <div class="row">
              <label for="failure_description" class="control-label col-xs-12 col-sm-2">Description </label>
              
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <select class="form-control" name="failure_description" id="failure_description">
                    <?php echo $failure_description_dropdown; ?>
                  </select>
                </div>
              </div>

              <label for="failure_code" class="control-label col-xs-12 col-sm-2">Code</label>
              <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                  <input disabled="disabled" class="form-control" type="text" name="failure_code" id="failure_code" value="<?php echo $failure_code; ?>">
                </div>
              </div>
            </div>
            



          </div>

        </div>
        <?php $this->load->view('includes/casefile-footer', $data); ?>
        <?php echo form_close(); ?>
      </div>