<?php 

	$attributes = array( 'class' => 'form-horizontal');
	echo form_open('menu_subcategory_admin/create', $attributes);

 ?>


<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Create Menu Subcategory</h4>
</div>
<div class="modal-body">
	<div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="description" placeholder="Description">
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
      <input type="text" class="form-control" name="code" placeholder="Code">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Menu Category</label>
    <div class="col-sm-10">
      <select class="form-control" name="menu_id">
       	<?php
       		foreach($menu_records as $menu_record){
      			$cat_id = $menu_record->menu_id;
     			$type = $menu_record->name;
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
	<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Create</button>
</div>

<?php echo form_close(); ?>