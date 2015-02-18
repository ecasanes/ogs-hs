<table class="table table-bordered">
	<thead>
		<tr>
			<td>Instructor ID</td>
			<td>Name</td>
			<td>Profile</td>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach($results as $result): 
			$id = $result->teacher_id;
			$firstname = $result->teacher_fname;
			$middlename = $result->teacher_mname;
			$lastname = $result->teacher_lname;
			$fullname = $firstname . ' ' . $middlename . ' ' . $lastname;
			$link = '';
		?>
			<tr>
				<td><?php echo $id; ?></td>
				<td><?php echo $fullname; ?></td>
				<td><?php echo $link; ?></td>
			</tr>
		<?php endforeach; ?>
		
	</tbody>
</table>