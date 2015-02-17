<?php 

  $attributes = array('class' => 'form-horizontal');

  echo form_open('menu_category_admin/update', $attributes);


 ?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Edit Menu Admin Category</h4>
</div>
<div class="modal-body">
<?php foreach($results as $data) { ?>
  <input type="text" class="form-control hidden" name="menu_id" value="<?php echo $data->menu_id; ?>">
  <div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" value="<?php echo $data->name; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Value</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="value" value="<?php echo $data->value; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="description" value="<?php echo $data->description; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Secondary Desription</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="secondary_description" value="<?php echo $data->secondary_description; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Color Class</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="color_class" value="<?php echo $data->color_class; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Code</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="code" value="<?php echo $data->code; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Order</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="order" value="<?php echo $data->order; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Level</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="level" value="<?php echo $data->level; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Menu Category</label>
    <div class="col-sm-10">
      <select class="form-control" name="menu_category_id">
      <?php
        foreach($categories as $category){
          $cat_id = $category->menu_category_id;
        $type = $category->menu_type;
        ?>
        <option value="<?php echo $cat_id ?>" 
          ><?php echo $type ?></option>
      <?php } ?>
    </select>
    </div>
  </div>
</div>
<?php } ?>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save Changes</button>
</div>
<?php echo form_close(); ?>