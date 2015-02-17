







<!-- Modal -->
<div class="modal fade" id="submit-check-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="completion-check-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">You are going to another page</h4>
      </div>
      <div class="modal-body">
        <p>You must complete the minimum requirements before saving or lose your work! </p>
        <p>Do you still want to move?</p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary go-link" data-dismiss="modal"> No</button>
        <button type="button" class="btn btn-danger submit"> Yes</button>
      </div>
    </div>
  </div>
</div>



<div class="row content">
    <div class="col-xs-12">
        <?php if($upload_error): ?>
            <div class="alert alert-danger fade in">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <strong>Error Uploading File</strong> <?php echo $upload_error; ?>
            </div>
        <?php endif; ?>
        
    </div>
</div>


