<div class="panel panel-default">
  <?php $this->load->view('includes/initialize-form', $data); ?>

  <div class="panel-heading">
      <h4 class="panel-title"><?php echo $step_title; ?></h4>
      <div class="panel-options">
            <span class="panel-code"><?php echo $document_header_name; ?></span>
        </div>
  </div>

  <div class="panel-body">
    <?php $this->load->view('includes/steps', $data); ?>
    <?php $this->load->view('includes/completion-status', $data); ?>


    <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h4>Action Tracker <i class="fa fa-question-circle text-success constraints-popover"></i></h4>
          </div>
        </div>
      </div>
  
                                      



      <div class="row content text-left hidden-xs">
        <div class="col-xs-1"><label for="" class="control-label">Ref</label></div>
        <div class="col-xs-4"><label for="" class="control-label">Action/Process Step</label></div>
        <div class="col-xs-1"><label for="" class="control-label">Status</label></div>
        <div class="col-xs-2"><label for="" class="control-label">Owner</label></div>
        <div class="col-xs-2"><label for="" class="control-label">Due Date</label></div>
        <div class="col-xs-2"><label for="" class="control-label">Comments</label></div>
      </div>


    <div id="action-tracker-table" class="dynamic-row with-padding">
       <?php foreach($action_tracker as $result){ ?>
        <?php
          //var_dump($result);
          $reference = $result['reference'];
          $action_process_step = $result['action_process_step'];
          $status = $result['status'];
          $status_color = $result['status_color'];
          $owner = $result['owner'];
          $full_name = $result['full_name'];
          $due_date = convert_date_to_string($result['due_date']);
          $duration = $result['duration'];
          $comments = $result['comments'];
        ?>
          <div class="row content">
            <label for="" class="control-label col-xs-12 visible-xs no-padding">Ref</label>
            <div class="col-sm-1 no-padding padding-of-2px col-xs-12">
              <div class="form-group">

                <input type="text" class="form-control small-font" name="reference[]" value="<?php echo $reference; ?>" readonly>

              </div>
            </div>
            <label for="" class="control-label col-xs-12 visible-xs no-padding">Action/Process Step</label>
            <div class="col-sm-4 no-padding padding-of-2px col-xs-12">
              <div class="form-group">
                <input type="text" class="form-control " name="action_process_step[]" value="<?php echo $action_process_step; ?>">
              </div>
            </div>
            <label for="" class="control-label col-xs-12 visible-xs no-padding">Status</label>
            <div class="col-sm-1 no-padding padding-of-2px col-xs-12">
              <div class="form-group">
                <select class="form-control color-select <?php echo $status_color ?>" name="action_tracker_status[]">
                  <?php echo $status; ?>
                </select>
              </div>
            </div>
            <label for="" class="control-label col-xs-12 visible-xs no-padding">Owner</label>
            <div class="col-sm-2 no-padding padding-of-2px col-xs-12">
              <div class="form-group">
                <select name="owner[]" id="document_name" class="form-control select2-dropdown"> 
                  <option value=" <?php echo $owner; ?>"><?php echo $full_name; ?></option> 
                  <?php echo $user_option ?>
                </select>
              </div>
            </div>
            <label for="" class="control-label col-xs-12 visible-xs no-padding">Due Date</label>
            <div class="col-sm-2 no-padding padding-of-2px col-xs-12">
              <div class="form-group">
                <input type="text" class="form-control datepicker" name="due_date[]" value="<?php echo $due_date; ?>">
              </div>
            </div>
            <label for="" class="control-label col-xs-12 visible-xs no-padding">Comments</label>
            <div class="col-sm-2 no-padding padding-of-2px col-xs-12">
              <div class="form-group">
                <input type="text" class="form-control " name="comments[]" value="<?php echo $comments; ?>">
              </div>
            </div>
            <div class="col-sm-2 no-padding padding-of-2px">
              <div class="form-group">
                <input type="hidden" class="form-control no-padding ref-code" name="ref_code[]" value="<?php echo $ref_code; ?>">
              </div>
            </div>
          </div>
          <?php } ?>
</div>
</div>
  <?php $this->load->view('includes/casefile-footer', $data); ?>
  <?php echo form_close(); ?>
</div>