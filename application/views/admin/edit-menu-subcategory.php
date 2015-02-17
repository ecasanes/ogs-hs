<?php 

	$attributes = array( 'class' => 'form-horizontal');
	echo form_open('menu_subcategory_admin/save', $attributes);


  //var_dump($results);

 ?>


<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Edit Menu Subcategory</h4>
</div>
<div class="modal-body">
<?php foreach($results as $data) { ?>
  <input type="text" class="form-control hidden" name="menu_subcategory_id" value="<?php echo $data->menu_subcategory_id; ?>">
	<div class="form-group">
    <label class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" value="<?php echo $data->name; ?>">
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Description</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="description" value="<?php echo $data->description; ?>">
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
  <?php } ?>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save Changes</button>
</div>

<?php echo form_close(); ?>