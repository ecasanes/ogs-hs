<?php

/*echo '<pre>';
    var_dump($files);
    echo '</pre>';*/

if(isset($single_upload) && $single_upload == true){

  if(empty($upload_name)){
    $upload_name = 'userfile';
  }

  if(empty($upload_required)){
    $upload_required = '';
  }
  
  $filepath = image_exist(base_url('uploads/'.$file_value), 'normal', 'url');
  ?>
    <div class="form-group file-row">
      <div class="fileupload fileinput input-group form-file-input" data-provides="fileinput"><input type="hidden" value="" name="" data-bv-field="">

        <a class="btn btn-bordered input-group-addon image-btn btn-primary img-lightbox" href="<?php echo $filepath; ?>" data-title="<?php //echo $filename; ?>" data-lightbox="upload-set" data-toggle="tooltip" data-original-title="View Image" data-container="body">
          <span class="glyphicon glyphicon-picture">
        </a>

        
        <input class="form-control form-control-file display-file-manager" type="text" name="<?php echo 'display_'.$upload_name; ?>" value="<?php echo $file_value; ?>">
        <input class="file-item-id form-control-file display-file-manager" type="hidden" name="<?php echo $upload_name; ?>" value="<?php echo $file_item_id; ?>">
        

      </div>
    </div>
  
  <?php
}else{
?>
<!-- <span id="upload-message">upload message here...</span> -->
<div id="file-table" class="custom-tooltip-container generic-tooltip generic-medium">

  <!-- <span id="upload-tooltip" class="tooltip-toggle help-icon"></span> -->
  <?php 

    foreach($files as $file => $file_object){ 
      $filename = $file_object->file_item_name;
      $file_id = $file_object->file_id;
      $filepath = image_exist(base_url('uploads/'.$filename), 'normal', 'url');
      $file_item_id = $file_object->file_item_id;

      //echo $filename;
      //echo '<img src="'.base_url('uploads/'.$filename).'" width="100" height="100" />';
  ?>

 
    <div id="file-row-<?php echo $file_id; ?>" class="form-group file-row">
      <div class="fileupload fileinput input-group form-file-input" data-provides="fileinput"><input type="hidden" value="" name="" data-bv-field="">

        <a class="btn btn-bordered input-group-addon image-btn btn-primary img-lightbox" href="<?php echo $filepath; ?>" data-title="<?php echo $filename; ?>" data-lightbox="upload-set" data-toggle="tooltip" data-original-title="View Image" data-container="body">
          <span class="glyphicon glyphicon-picture">
        </a>

        
        <input class="form-control form-control-file display-file-manager" type="text" name="file_item_name[]" value="<?php echo $filename; ?>">
        <input class="file-item-id" type="hidden" name="file_item_id[]" value="<?php echo $file_item_id; ?>">


        
        <span class="btn-delete-file input-group-addon btn btn-bordered btn-danger btn-file" data-toggle="tooltip" data-original-title="Remove Image" data-container="body">
          <span class="fileinput-exists glyphicon glyphicon-remove" ></span>
        </span>
        

      </div> 
  </div>


  <?php } ?>

</div>

<!-- <div id="test-upload">
</div> -->
<!-- display-file-manager -->
        <!--<div class="form-control form-control-file" data-trigger="fileinput" > 
          <i class="glyphicon glyphicon-file"></i>
          <span class="fileinput-filename"><?php echo $filename; ?></span>
        </div>-->

        <!--<span class="input-group-addon btn btn-bordered btn-success btn-file attach-btn" data-toggle="tooltip" data-original-title="Attach Image" data-container="body">
          <span class="fileinput-exists glyphicon no-line-height pe-7s-upload fa-lg"></span>
          <input type="file" name="userfile[]" data-bv-field="userfile[]">
        </span>-->
        <!-- <div class="tooltip"></div> -->


        <!-- <div class="tooltip"></div> -->

        
        
        <!-- <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"></a> -->

<?php } ?>