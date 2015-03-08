<?php
if(empty($results)):
?>
<p class="text-error">No Students found.</p>
<?php
else:
?>
<table class="table table-bordered">

	<thead>
		<tr>
			<td>Student ID</td>
			<td>Name</td>
			<td>Year Level</td>
			<?php
				if(isset($action) && $action == true):
			?>
				<td></td>
			<?php
			endif;
			?>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach($results as $result): 
			$id = $result->user_id;
			$username = $result->username;
			$firstname = $result->fname;
			$middlename = $result->mname;
			$lastname = $result->lname;
			$fullname = $firstname . ' ' . $middlename . ' ' . $lastname;
			$year_level = $result->year_level;
			$year = $year_level;
			if($year_level == "" || $year_level == null || $year_level == 0){
				$year_level = "Not yet enrolled";
			}
			$link = '';
		?>
			<tr>
				<td><?php echo $id; ?></td>
				<td><?php echo $fullname; ?></td>
				<td><?php echo $year_level; ?></td>
				<?php
				if(isset($action) && $action == true):
				?>
					<td><a href="#" class="btn btn-primary btn-sm edit-student" data-toggle="tooltip" data-title="Edit" data-id="<?php echo $id; ?>" data-year="<?php echo $year; ?>" data-firstname="<?php echo $firstname; ?>" data-lastname="<?php echo $lastname; ?>" data-username="<?php echo $username; ?>"><i class="fa fa-edit"></i> </a></td>
				<?php
				endif;
				?>
			</tr>
		<?php endforeach; ?>
		
	</tbody>
</table>
<?php
endif;
?>