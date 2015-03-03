<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<td>Component</td>
			<td># of Column</td>
			<td>Percentage</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Assignment</td>
			<td><?php echo $assignment_column; ?></td>
			<td><?php echo $assignment_weight; ?></td>
		</tr>
		<tr>
			<td>Quizzes</td>
			<td><?php echo $quiz_column; ?></td>
			<td><?php echo $quiz_weight; ?></td>
		</tr>
		<tr>
			<td>Recitation</td>
			<td><?php echo $recitation_column; ?></td>
			<td><?php echo $recitation_weight; ?></td>
		</tr>
		<tr>
			<td>Project</td>
			<td><?php echo $project_column; ?></td>
			<td><?php echo $project_weight; ?></td>
		</tr>
		<tr>
			<td>Exam</td>
			<td><?php echo $exam_column; ?></td>
			<td><?php echo $exam_weight; ?></td>
		</tr>
		<tr>
			<td>Total Percentage</td>
			<td><?php echo $total_columns; ?></td>
			<td><?php echo $total_weight; ?></td>
		</tr>
	</tbody>
</table>