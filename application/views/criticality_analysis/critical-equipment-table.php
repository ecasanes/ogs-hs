<?php
	$equipments = $table_data;
?>

<table id="critical-equipment" class="table table-condensed">
	<thead>
		<tr>
			<th class="ref">Ref</th>
			<th class="parent-sce">Parent SCE</th>
			<th class="tag-no">Tag Number</th>
			<th class="component">Subsystem/Component</th>
			<th class="soi">Source of Information</th>
			<th class="code">Code</th>
			<th class="qty">Quantity</th>
			<th class="conflict">Conflict</th>
			<th class="availability">Availability</th>
			<th class="rule">Rule Set</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($equipments as $equipment){ ?>
			<tr>
				<td class="hidden"><?php echo $equipment->critical_equipment_id; ?></td>
				<td class="ref"><?php echo $equipment->ref; ?></td>
				<td class="parent-sce"><?php echo $equipment->ce_parent_sce_id; ?></td>
				<td class="tag-no"><a href="<?php echo base_url('criticality-analysis/scoring/create/'.$equipment->critical_equipment_id); ?>"><?php echo $equipment->tag_number; ?></a></td>
				<td class="component"><?php echo $equipment->subsystem_component; ?></td>
				<td class="soi"><?php echo $equipment->source_of_information; ?></td>
				<td class="code"><?php echo $equipment->code; ?></td>
				<td class="qty"><?php echo $equipment->quantity; ?></td>
				<td class="conflict"><?php echo $equipment->conflict; ?></td>
				<td class="availability"><?php echo $equipment->availability; ?></td>
				<td class="rule"><?php echo $equipment->rule_set; ?></td>
				<td>
					<a class="btn btn-info btn-sm edit-button" href="" data-id="<?php echo $equipment->critical_equipment_id; ?>" role="button" data-toggle="modal" data-target="#edit"><span class="glyphicon glyphicon-edit"></span></a>
					<a class="btn btn-danger btn-sm" href="<?php echo base_url('criticality_analysis/delete_critical_equipment/'.$equipment->critical_equipment_id); ?>" role="button"><span class="glyphicon glyphicon-trash"></a>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>