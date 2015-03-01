<div class="modal fade" id="edit-subject-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Subject <span class="tag"></span></h4>
      </div>
      <?php echo form_open('', array('id' => 'edit-subject-form')); ?>
      <?php echo form_hidden('id', ''); ?>
      <div class="modal-body">

        <div class="form-group">
          <label for="">Subject Code</label>
          <input type="text" class="form-control" name="subj_code" value="">
        </div>

        <div class="form-group">
          <label for="">Subject Description</label>
          <input type="text" class="form-control" name="subj_desc" value="">
        </div>

        <div class="form-group">
          <label for="">Subject Unit</label>
          <input type="number" class="form-control" name="subj_unit" value="">
        </div>
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> Cancel</button>
        <button type="submit" class="btn btn-success go-edit"> Update</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>