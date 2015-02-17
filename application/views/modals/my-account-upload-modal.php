<?php 
  $attributes=array( 'role'=>'form', 'id' => 'my-account-form' ); 
  echo form_open_multipart('user/save', $attributes);
  echo form_hidden('form_id', $user_id);

?>
<div class="modal fade" id="change-photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="change-photo-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Change Photo</h4>
      </div>
      
      <div class="modal-body">
        <p class="strong">Cover Photo</p>
        <p class="col-xs-12">
          <?php 
            $data['file_item_id'] = $cover_photo_id;
            $data['single_upload'] = true;
            $data['file_value'] = $cover_filename;
            $data['upload_name'] = 'cover_image';
            $this->load->view('includes/casefile-upload', $data); 
          ?>
    </p>
    <p class="strong">Profile Photo</p>
    <p class="col-xs-12">
      <?php 
        $data['file_item_id'] = $profile_photo_id;
        $data['single_upload'] = true;
        $data['file_value'] = $upload_filename;
        $data['upload_name'] = 'user_image';
        $data['file_upload_id'] = 4;
        $this->load->view('includes/casefile-upload', $data);
      ?>
    </p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
         <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>