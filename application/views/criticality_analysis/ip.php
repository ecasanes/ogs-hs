<div class="panel panel-info">
	
	<div class="panel-heading">
		<h3 class="panel-title">Inspection Frequency</h3>
	</div>

	<div class="panel-body">

		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th colspan="2">Items of Equipment to be Inspected</th>
					<th><span id="no-of-analysed-items"><?php echo $ce_count; ?></span></th>
					<th colspan="4"></th>
				</tr>
				<tr>
					<th>IP</th>
					<th>Periodicity of Inspection</th>
					<th>Shifts</th>
					<th>Estimated % of Equipment</th>
					<th>CAS</th>
					<th>Items per inspection Period ©</th>
					<th>Average items per 12hr shift</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($results as $result): ?>
					<tr>
						<td class="text-danger"><?php echo $result->ip_letter; ?></td>
						<td>
							<div class="input-group-sm">
								<input type="text" class="form-control" id="" placeholder="" value="<?php echo $result->pi_value; ?>">
							</div>					
						</td>
						<td>
							<div class="input-group-sm">
								<input type="text" class="form-control" id="" placeholder="" value="<?php echo $result->shifts; ?>">
							</div>					
						</td>
						<td>
							<div class="input-group-sm">
								<input type="text" class="form-control" id="" placeholder="" value="<?php echo $result->estimated_equipment_percentage; ?>">
							</div>					
						</td>
						<td class="text-success"><strong><?php echo $result->cas_range_low; ?> - <?php echo $result->cas_range_high; ?></strong></td>
						<td><?php echo $result->items_per_inspection_period; ?></td>
						<td><?php echo $result->average_item_per_twelve_hr_shift; ?></td>
					</tr>
				<?php endforeach; ?>
				<tr>
					<td class="bg-grey" colspan="6">
						Average Total of Items per shift over cycle (12hrs)
					</td>
					<td id="average_total_items"></td>
				</tr>
			</tbody>
		</table>

	</div>
	<div class="panel-footer">
		
		<div class="text-right">
			<button class="btn btn-success" type="submit"><i class="fa fa-clipboard"></i> Save &amp; Calculate</button>
		</div>

	</div>



</div>