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
								<input name="pi_value[]" type="text" class="form-control" id="" placeholder="" value="<?php echo $result->pi_value; ?>">
							</div>					
						</td>
						<td>
							<div class="input-group-sm">
								<input name="shifts_value[]" type="text" class="form-control" id="" placeholder="" value="<?php echo $result->shifts; ?>">
							</div>					
						</td>
						<td><?php echo $result->estimated_percentage_of_equipment_final; ?></td>
						<td class="text-success"><strong><?php echo $result->cas_range_low; ?> - <?php echo $result->cas_range_high; ?></strong></td>
						<?php if($result->calculated_items_per_inspection_period == 'Negligible'): ?>
							<td><?php echo $result->calculated_items_per_inspection_period; ?></td>
							<td></td>
						<?php else: ?>
							<td><?php echo $result->calculated_items_per_inspection_period_final; ?></td>
							<td><?php echo $result->calculated_average_items_final; ?></td>
						<?php endif; ?>
						
					</tr>
				<?php endforeach; ?>
				<tr>
					<td class="bg-grey" colspan="6">
						Average Total of Items per shift over cycle (12hrs)
					</td>
					<td id="average_total_items"><?php echo $average_total; ?></td>
				</tr>
			</tbody>
		</table>