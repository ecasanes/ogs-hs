<?php
if(empty($results)):
?>
<p class="text-error">No Subjects found.</p>
<?php
else:
?>
<table class="table table-bordered view-table">
	<thead>
		<tr>
			<td>Subject Code</td>
			<td>Description</td>
			<td>Unit</td>
			<td class="action">Action</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach($results as $result): 
			$id = $result->subj_id;
			$code = $result->subj_code;
			$name = $result->subj_desc;
			$unit = $result->subj_unit;
			$link = '';
		?>
			<tr>
				<td><?php echo $code; ?></td>
				<td><?php echo $name; ?></td>
				<td><?php echo $unit; ?></td>
				<td>
					<a href="#" data-id="<?php echo $id; ?>" class="btn btn-primary btn-edit" title="Edit">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
					<a href="#" data-id="<?php echo $id; ?>" class="btn btn-danger btn-delete" title="Delete">
						<span class="glyphicon glyphicon-remove"></span>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>
</table>
<?php
endif;
?>