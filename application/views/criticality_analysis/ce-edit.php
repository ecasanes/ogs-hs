<?php 

$attributes = array('class' => 'form-horizontal');

echo form_open('criticality_analysis/edit_critical_equipment/'.$critical_equipment_id, $attributes);


?>

<!-- Modal Content -->
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="myModalLabel">Edit Critical Equipment</h4>
</div>

<div class="modal-body">

	<input type="text" value="<?php echo $critical_equipment_id; ?>" class="form-control hidden" id="inputEmail3" >
	<div class="form-group input-group-sm">
		<label for="inputEmail3" class="col-sm-2 control-label">Asset</label>
		<div class="col-sm-4">
			<select name="asset_id" class="form-control">
				<option value=""><?php echo $asset_id; ?></option>
			</select>
		</div>
		<label for="inputEmail3" class="col-sm-3 control-label">Parent SCE</label>
		<div class="col-sm-3">
			<select name="ce_parent_sce_id" class="form-control">
				<option value=""><?php echo $ce_parent_sce_id; ?></option>
			</select>
		</div>
	</div>


	<div class="form-group input-group-sm">
		<label for="inputEmail3" class="col-sm-2 control-label">Ref</label>
		<div class="col-sm-4">
			<input type="text" name="ref" class="form-control input-group-sm" id="inputEmail3" value="<?php echo $ref; ?>" disabled="">
		</div>
		<label for="inputEmail3" class="col-sm-3 control-label">Tag Number</label>
		<div class="col-sm-3">
			<input type="text" name="tag_number" value="<?php echo $tag_number; ?>" class="form-control input-group-sm" id="inputEmail3" >
		</div>
	</div>

	<div class="form-group input-group-sm">
		<label for="inputEmail3" class="col-sm-2 control-label">Subsystem/ Component</label>
		<div class="col-sm-10">
			<input type="text" name="subsystem_component" value="<?php echo $subsystem_component; ?>" class="form-control input-group-sm" id="inputEmail3" >
		</div>
	</div>

	<div class="form-group input-group-sm">
		<label for="inputEmail3" class="col-sm-2 control-label">Code</label>
		<div class="col-sm-4">
			<input type="text" name="code" value="<?php echo $code; ?>" class="form-control input-group-sm" id="inputEmail3" >
		</div>
		<label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
		<div class="col-sm-4">
			<input type="text" name="quantity" value="<?php echo $quantity; ?>" class="form-control input-group-sm" id="inputEmail3" >
		</div>
	</div>

	<div class="form-group input-group-sm">
		<label for="inputEmail3" class="col-sm-2 control-label">Conflict</label>
		<div class="col-sm-4">
			<input type="text" name="conflict" value="<?php echo $conflict; ?>" class="form-control input-group-sm" id="inputEmail3" >
		</div>
		<label for="inputEmail3" class="col-sm-2 control-label">Availability</label>
		<div class="col-sm-4">
			<input type="text" name="availability" value="<?php echo $availability; ?>" class="form-control input-group-sm" id="inputEmail3" >
		</div>
	</div>

	<div class="form-group input-group-sm">
		<label for="inputEmail3" class="col-sm-2 control-label">Source of Info</label>
		<div class="col-sm-4">
			<input type="text" name="source_of_information" value="<?php echo $source_of_information; ?>" class="form-control input-group-sm" id="inputEmail3" >
		</div>
		<label for="inputEmail3" class="col-sm-2 control-label">Rule Set</label>
		<div class="col-sm-4">
			<input type="text" name="rule_set" value="<?php echo $rule_set; ?>" class="form-control input-group-sm" id="inputEmail3" >
		</div>
	</div>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
	<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
</div>
<?php echo form_close(); ?><!-- End of Form -->


