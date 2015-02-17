<?php if(count($cost_breakdown) < 1 ){ ?>
<div class="text-center">
	No Cost Breakdown for this project.
</div>
<?php 
}
else{ ?>

<div class="horizontal-overflow-scroll">

	<?php
		$attributes = array( 'role'=>'form' , 'id' => 'update-cost-breakdown-row', 'class' => '' );
		echo form_open('', $attributes);
	?>
	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th colspan="12">
					<span class="pull-left project-name-data"></span>
					<span class="pull-right project-number-data"></span>
				</th>
			</tr>
			<tr>
				<th>Item</th>
				<th>Description</th>
				<th>Unit Cost</th>
				<th>Volume</th>
				<th>Total</th>
				<th>Supplier</th>
				<th>Due Date on Platform</th>
				<th>Status</th>
				<th>PO Number</th>
				<th>Component Location</th>
				<th>Action</th>
			</tr>
			<?php 
			if($user_id == $document_creator){
				foreach($cost_breakdown as $cost){ ?>
			<tr>
				<td><?php echo ($cost['item_name']); ?></td>
				<td><?php echo ($cost['item_description']); ?></td>
				<td><?php echo ($cost['e_unit_cost']); ?></td>
				<td><?php echo ($cost['e_volume']); ?></td>
				<td><?php echo ($cost['e_subtotal']); ?></td>
				<td class="input-fields">
					<input type="text" class="form-control input-sm" name="c_supplier" value="<?php echo ($cost['supplier']); ?>">
				</td>
				<td class="input-fields"><input type="text" class="form-control datepicker input-sm" name="c_due_date" value="<?php echo ($cost['platform_date']); ?>"></td>
				<td class="input-fields">
					<select name="c_status" id="" class="table-select">
						<?php echo $cost['waiting_status_dropdown']; ?>
					</select>
				</td>
				<td class="input-fields"><input type="text" class="form-control input-sm" name="c_po_number" value="<?php echo ($cost['po_number']); ?>"></td>
				<td class="input-fields">
					<input type="text" class="form-control input-sm" name="c_component_location" value="<?php echo ($cost['component_location']); ?>">
					<input type="hidden" name="c_id" value="<?php echo $cost['cost_breakdown_id']; ?>">
				</td>
				<td>
					<a href="#" class="btn btn-info edit-cost-breakdown-row btn-sm tooltip-view" data-placement="bottom" data-toggle="tooltip" data-original-title="Update"><span class="glyphicon glyphicon-floppy-disk"></span></a>
				</td>
			</tr>
			<?php 
				}
			}
			else{
				foreach($cost_breakdown as $cost){ ?>
			<tr>
				<td><?php echo ($cost['item_name']); ?></td>
				<td><?php echo ($cost['item_description']); ?></td>
				<td><?php echo ($cost['e_unit_cost']); ?></td>
				<td><?php echo ($cost['e_volume']); ?></td>
				<td><?php echo ($cost['e_subtotal']); ?></td>
				<td><?php echo $cost['supplier']; ?></td>
				<td><?php echo $cost['platform_date'] ?></td>
				<td><?php echo $cost['waiting_status'] ?></td>
				<td><?php echo $cost['po_number'] ?></td>
				<td><?php echo $cost['component_location'] ?></td>
				<td>
					<a href="#" class="btn btn-info edit-cost-breakdown-row btn-sm tooltip-view" data-placement="bottom" data-toggle="tooltip" data-original-title="Update" disabled><span class="glyphicon glyphicon-floppy-disk"></span></a>
				</td>
			</tr>
			<?php
				}
			} ?>
		</thead>
	</table>

	<?php echo form_close(); ?>
</div>

<?php } ?>



