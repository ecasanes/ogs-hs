<?php 

  $attributes = array('class' => 'form-horizontal');

  echo form_open('menu_category_admin/create', $attributes);


 ?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title" id="myModalLabel">Create Menu Admin Category</h4>
</div>
<div class="modal-body">
  <div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Value</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="value" placeholder="Value">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="description" placeholder="Description">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Secondary Desription</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="secondary_description" placeholder="Secondary Description">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Color Class</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="color_class" placeholder="Color Class">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Code</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="code" placeholder="code">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Order</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="order" placeholder="order">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Level</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="level" placeholder="level">
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
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create Menu Category</button>
</div>
<?php echo form_close(); ?>