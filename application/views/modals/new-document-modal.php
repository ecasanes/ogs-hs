<div id="add-document-modal" class="modal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php echo form_open('document/create'); ?>
      <?php echo form_hidden('document_type', ''); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">New <span class="title"></span></h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <select name="document_creation" class="form-control">
                <option value="new" class="new-selection">New</option>
                <option value="duplicate">Create from Previous</option>
              </select>
            </div>
            <div class="form-group create-from-previous">
              <label for="document_id" class="document_id">Select from previous <span class="title"></span></label>
              <select name="document_id" class="form-control"></select>
            </div>
            <div class="form-group new">
              <label for="document_name" class="document-name"></label>
              <input class="form-control" type="text" value="" name="document_name" placeholder="">
              <small class="text-danger">* entry cannot be blank</small>
            </div>
            <div class="form-group project-workpack-date">
              <label for="start_date" class="start-date">Start Date</label>
              <input class="form-control datepicker" type="text" value="" name="start_date" placeholder="" disabled>
              <small class="text-danger">* entry cannot be blank</small>
            </div>
            <div class="form-group project-workpack-date">
              <label for="start_date" class="start-date">Duration</label>
              <div class="input-group">
                        <input type="number" min="1" max="9999999" name="duration_no" class="form-control number-only" value="" disabled>
                        <span class="input-group-addon"> - </span>
                        <select name="duration_days" class="form-control">
                            <option value="Days"> Day / s </option>
                            <option value="Weeks"> Week / s </option>
                            <option value="Months"> Month / s </option>
                        </select>
                    </div>
              <small class="text-danger">* entry cannot be blank</small>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary submit-button">Create New</button>
      </div>
      <?php echo form_close(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->