<?php 

  $attributes = array( 'class' => 'form-horizontal' );

  echo form_open('menu_admin/create', $attributes);

 ?>
<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Menu</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        <label class="col-sm-2 control-label">Menu Type</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="menu_type" placeholder="Menu Type">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="description" placeholder="Description">
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Menu</button>
      </div>
<?php echo form_close(); ?>