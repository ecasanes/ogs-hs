<table class="table table-striped">
  <thead>
    <tr>
      <th class="file_manager_filename">Filename</th>
      <th>Extension</th>
      <th>Type</th>
      <th></th>
    </tr>
  </thead>
  <tbody class="table-hover">
    <?php foreach($files as $file): ?>
    <?php
      $filepath = base_url( 'uploads/'.$file->filename );
      $file_item_id = $file->file_item_id;
      $image_exist_path = image_exist($filepath, 'normal', 'url');
    ?>
    <tr class="file-row">
      <td>
        <i class="fa fa-file-image-o"></i> 
        <span class="filename"><?php echo $file->filename; ?></span>
        <span class="filepath hidden"><?php echo $image_exist_path; ?></span>
        <span class="file-item-id hidden"><?php echo $file_item_id; ?></span>
      </td>
      <td class="extension">
        <?php echo $file->extension; ?>
      </td>
      <td class="file-type">
        <?php echo $file->file_type_name; ?>
      </td>
      <td>
        <a href="<?php echo $image_exist_path;  ?>" class="btn btn-sm btn-success img-lightbox" data-lightbox="file-set" data-toggle="tooltip" data-placement="top" title="View"><span class="glyphicon glyphicon-list"></span></a>
        <a href="#" class="btn btn-sm btn-primary rename-file" data-toggle="modal"  data-placement="top" title="Rename"><span class="glyphicon glyphicon-pencil"></span></a> <!-- data-target="#edit-filename-modal" -->
        <a href="#" class="btn btn-sm btn-danger remove-file-from-list" data-toggle="tooltip" data-placement="top" title="Delete"><span class="glyphicon glyphicon-trash"></span></a>
        <a href="#" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Download File"><i class="fa fa-cloud-download"></i></a>
        <a href="#" class="btn btn-sm btn-success insert-to-field" data-dismiss="modal" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Add to textfield"><i class="fa fa-plus"></i></a>
      </td>
      
    </tr>
  <?php endforeach; ?>
  </tbody>
  
</table>
