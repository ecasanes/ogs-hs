<?php 

  $attributes = array( 'class' => 'form-horizontal' );

  echo form_open('menu_admin/save', $attributes);

  //var_dump($results);

 ?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Edit Menu</h4>
</div>
<div class="modal-body">
  <?php foreach($results as $data){ ?>
  <div class="form-group">
      <input type="text" class="form-control hidden" name="menu_category_id" value="<?php echo $data->menu_category_id; ?>">
      <label class="col-sm-2 control-label">Menu Type</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="menu_type" value="<?php echo $data->menu_type; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Description</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="description" value="<?php echo $data->description; ?>">
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
</div>
<?php echo form_close(); ?>