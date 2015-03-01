<div class="modal fade" id="delete-subject-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modify <span class="tag"></span></h4>
      </div>
      <?php echo form_open('', array('id' => 'delete-subject-form')); ?>
      <?php echo form_hidden('id', ''); ?>
      <div class="modal-body">

        <p>Delete Subject?</p>
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> Cancel</button>
        <button type="submit" class="btn btn-danger go-delete"> Confirm</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>