<!-- Modal -->
<div class="modal fade" id="document-upload-modal" tabindex="-1" role="dialog" aria-labelledby="documentUploadModal" aria-hidden="true">
  <div id="document-file-upload-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Upload Files</h4>
      </div>
      <div class="modal-body">

        <?php $this->load->view('includes/casefile-upload'); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary go-link" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger submit"><span class="glyphicon glyphicon-floppy-disk"></span> Upload</button>
      </div>
    </div>
  </div>
</div>

<a href="#" class="btn btn-primary btn-block btn-upload-modal"><span class="glyphicon glyphicon-picture"></span> Upload Files</a>