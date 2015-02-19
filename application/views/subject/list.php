<?php
if(empty($results)):
?>
<p class="text-error">No Subjects found.</p>
<?php
else:
?>
<table class="table table-bordered">
	<thead>
		<tr>
			<td>Subject Code</td>
			<td>Description</td>
			<td>Unit</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach($results as $result): 
			//$id = $result->subj_id;
			$code = $result->subj_code;
			$name = $result->subj_desc;
			$unit = $result->subj_unit;
			$link = '';
		?>
			<tr>
				<td><?php echo $code; ?></td>
				<td><?php echo $name; ?></td>
				<td><?php echo $unit; ?></td>
				<td></td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>
</table>
<?php
endif;
?>