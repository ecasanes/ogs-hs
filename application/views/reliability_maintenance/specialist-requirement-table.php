
<?php if(count($specialist_requirement) < 1 ){ ?>
<div class="text-center">
	No Specialist Requirement for this project.
</div>
<?php 
}
else{ ?>

<div class="horizontal-overflow-scroll">
	<table class="table table-bordered table-condensed">
		<thead>
			<tr>
				<th colspan="12">
					<span class="pull-left project-name-data"></span>
					<span class="pull-right project-number-data"></span>
				</th>
			</tr>
			<tr>
				<th>Specialist Requirement</th>
				<th>Description</th>
				<th>Due Date</th>
				<!-- <th>Action</th> -->
			</tr>
			<?php foreach($specialist_requirement as $special){ ?>
			<tr>
				<td><?php echo ($special['specialist_requirement']); ?></td>
				<td><?php echo ($special['description']); ?></td>
				<td><?php echo ($special['due_date']); ?></td>
				<!-- <td></td> -->
			</tr>
			<?php } ?>
		</thead>
	</table>
</div>

<?php } ?>


