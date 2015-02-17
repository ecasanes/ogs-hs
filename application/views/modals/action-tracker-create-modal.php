<div class="modal fade" id="create-action-tracker">
  <div id="aciton-tracker-modal" class="modal-dialog modal-md">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'create-action-tracker-form', 'class' => '' );
            echo form_open('action-tracker/create', $attributes); 
            echo form_hidden('ref_id_code', '');
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create Action</h4>
      </div>
      
      <div class="modal-body">
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Document Name</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <select id="document-id-ref" name="document_id" class="form-control select2-dropdown" required> 
                <?php echo $existing_document_name_dropdown ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Action/Process Step</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" class="form-control " name="action_process" value="" required>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Status</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Owner</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <select class="form-control color-select bg-green" name="action_tracker_status" required>
                 <?php echo $status_dropdown; ?>
              </select>
            </div>
            <div class="col-xs-8">
              <select name="owner" class="form-control new-user select2-dropdown" required>
                  <?php echo $user_option ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Due Date</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Comments</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input type="text" class="form-control datepicker" name="due_date" value="" required>
            </div>
            <div class="col-xs-8">
              <input type="text" class="form-control " name="comments" value="">
            </div>
          </div>            
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
         <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
      <?php echo form_close(); ?> 
    </div>
  </div>
</div>