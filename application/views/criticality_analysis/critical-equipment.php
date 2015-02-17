<?php if ($alert_status == true): ?>
	<div class="alert <?php print($alert_class) ?> alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <?php print($alert_message) ?>
	</div>
<?php endif ?>

<!-- For Updates
 --><div id="update-alert"></div>

<!-- Start of Create Critical Equipment Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 800px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Create Critical Equipment</h4>
			</div>
			<div class="modal-body">

				<?php 

				$attributes = array('class' => 'form-horizontal');

				echo form_open('', $attributes);


				?>
				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Asset</label>
					<div class="col-sm-2">
						<select name="asset_id" class="form-control" id="asset_id">
							<?php echo $asset_ce_dropdown; ?>
						</select>
					</div>
					<label for="inputEmail3" class="col-sm-3 control-label">Parent SCE</label>
					<div class="col-sm-5">
						<select name="ce_parent_sce_id" class="form-control" id="parent_sce_options">
							<?php foreach ($dropdown_values as $key => $value) { ?>
							<option data-ref="<?php echo $value->ref; ?>" value="<?php echo $value->ce_parent_sce_id; ?>"><?php echo $value->name; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Group</label>
					<div class="col-sm-6">
						<select name="ce_group_id" class="form-control" id="ce_group_id">
							<?php foreach ($groups as $data): ?>
								<option value="<?php print($data['ce_group_id']) ?>"><?php print($data['name']) ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Ref</label>
					<div class="col-sm-2">
						<input type="text" name="ref" class="form-control input-group-sm" id="ref" disabled="">
					</div>
					<label for="inputEmail3" class="col-sm-3 control-label">Tag Number</label>
					<div class="col-sm-5">
						<input type="text" name="tag_number" class="form-control input-group-sm" id="tag_number" >
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Subsystem/ Component</label>
					<div class="col-sm-10">
						<input type="text" name="subsystem_component" class="form-control input-group-sm" id="inputEmail3" >
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Code</label>
					<div class="col-sm-4">
						<input type="text" name="code" class="form-control input-group-sm" id="inputEmail3" >
					</div>
					<label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
					<div class="col-sm-4">
						<input type="text" name="quantity" class="form-control input-group-sm" id="inputEmail3" >
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Conflict</label>
					<div class="col-sm-4">
						<input type="text" name="conflict" class="form-control input-group-sm" id="inputEmail3" >
					</div>
					<label for="inputEmail3" class="col-sm-2 control-label">Availability</label>
					<div class="col-sm-4">
						<input type="text" name="availability" class="form-control input-group-sm" id="inputEmail3" >
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Source of Info</label>
					<div class="col-sm-4">
						<input type="text" name="source_of_information" class="form-control input-group-sm" id="inputEmail3" >
					</div>
					<label for="inputEmail3" class="col-sm-2 control-label">Rule Set</label>
					<div class="col-sm-4">
						<input type="text" name="rule_set" class="form-control input-group-sm" id="inputEmail3" >
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
			</div>
			<?php echo form_close(); ?><!-- End of Form -->
		</div>
	</div>
</div>
<!-- End of Create Critical Equipment Modal -->



<!-- Start of Edit Critical Equipment Modal -->
<!-- <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div id="edit-modal-content" class="modal-content">
			
		

		</div>
	</div>
</div> -->
<!-- End of Edit Critical Equipment Modal -->

<!-- Start of Edit Critical Equipment Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 800px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Create Critical Equipment</h4>
			</div>
			<div class="modal-body">

				<?php 
					$attributes = array('class' => 'form-horizontal', 'id' => 'critical-equipment-edit');
					echo form_open('', $attributes);

				?>
				<input type="hidden" name="critical_equipment_id" id="critical_equipment_id" value="">
				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Asset</label>
					<div class="col-sm-2">
						<select name="asset_id" class="form-control" id="asset_id">
							<?php echo $asset_ce_dropdown; ?>
						</select>
					</div>
					<label for="inputEmail3" class="col-sm-3 control-label">Parent SCE</label>
					<div class="col-sm-5">
						<select name="ce_parent_sce_id" class="form-control" id="parent_sce_options">
							<?php foreach ($dropdown_values as $key => $value) { ?>
							<option data-ref="<?php echo $value->ref; ?>" value="<?php echo $value->ce_parent_sce_id; ?>"><?php echo $value->name; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Group</label>
					<div class="col-sm-2">
						<select name="ce_group_id" class="form-control" id="ce_group_id">
							<?php foreach ($groups as $data): ?>
								<option value="<?php print($data['ce_group_id']) ?>"><?php print($data['name']) ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Ref</label>
					<div class="col-sm-2">
						<input type="text" name="ref" class="form-control input-group-sm" id="ref" disabled="">
					</div>
					<label for="inputEmail3" class="col-sm-3 control-label">Tag Number</label>
					<div class="col-sm-5">
						<input type="text" name="tag_number" class="form-control input-group-sm" id="tag_number" >
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Subsystem/ Component</label>
					<div class="col-sm-10">
						<input type="text" name="subsystem_component" class="form-control input-group-sm" id="subsystem_component" >
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Code</label>
					<div class="col-sm-4">
						<input type="text" name="code" class="form-control input-group-sm" id="code" >
					</div>
					<label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
					<div class="col-sm-4">
						<input type="text" name="quantity" class="form-control input-group-sm" id="quantity" >
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Conflict</label>
					<div class="col-sm-4">
						<input type="text" name="conflict" class="form-control input-group-sm" id="conflict" >
					</div>
					<label for="inputEmail3" class="col-sm-2 control-label">Availability</label>
					<div class="col-sm-4">
						<input type="text" name="availability" class="form-control input-group-sm" id="availability" >
					</div>
				</div>

				<div class="form-group input-group-sm">
					<label for="inputEmail3" class="col-sm-2 control-label">Source of Info</label>
					<div class="col-sm-4">
						<input type="text" name="source_of_information" class="form-control input-group-sm" id="source_of_information" >
					</div>
					<label for="inputEmail3" class="col-sm-2 control-label">Rule Set</label>
					<div class="col-sm-4">
						<input type="text" name="rule_set" class="form-control input-group-sm" id="rule_set" >
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
				<button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
			</div>
			<?php echo form_close(); ?><!-- End of Form -->
		</div>
	</div>
</div>
<!-- End of Edit Critical Equipment Modal -->

<?php //var_dump($dropdown_values); ?>

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Critical Equipment </h3> 
		<div class="panel-options">
			<a class="btn btn-info btn-sm" href="#" role="button" data-toggle="modal" data-target="#create">Create One</a>
		</div>
	</div>

	<div id="" class="panel-body">
		<span id="refresh-equipment">
			<i class="fa fa-refresh fa-spin"></i> Loading Critical Equipment...
		</span>
		<div id="critical-equipment-table">

		</div>
	</div>
</div>