<?php echo form_open('', array( 'class'=> 'edit-grading-system-form')); ?>
<?php echo form_hidden('subj_offerid', $subj_offerid); ?>
<?php echo form_hidden('term', $term); ?>
<?php echo form_hidden('old_assignment_column', $assignment_column); ?>
<?php echo form_hidden('old_quiz_column', $quiz_column); ?>
<?php echo form_hidden('old_recitation_column', $recitation_column); ?>
<?php echo form_hidden('old_project_column', $project_column); ?>
<?php echo form_hidden('old_exam_column', $exam_column); ?>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<td>Component</td>
			<td style="width:200px;"># of Column</td>
			<td style="width:200px;">Percentage</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Assignment</td>
			<td ><input class="form-control" type="number" name="assignment_column" value="<?php echo $assignment_column; ?>"></td>
			<td ><input class="form-control" type="number" name="assignment_weight" value="<?php echo $assignment_weight; ?>"></td>
		</tr>
		<tr>
			<td>Quizzes</td>
			<td ><input class="form-control" type="number" name="quiz_column" value="<?php echo $quiz_column; ?>"></td>
			<td ><input class="form-control" type="number" name="quiz_weight" value="<?php echo $quiz_weight; ?>"></td>
		</tr>
		<tr>
			<td>Recitation</td>
			<td ><input class="form-control" type="number" name="recitation_column" value="<?php echo $recitation_column; ?>"></td>
			<td ><input class="form-control" type="number" name="recitation_weight" value="<?php echo $recitation_weight; ?>"></td>
		</tr>
		<tr>
			<td>Project</td>
			<td ><input class="form-control" type="number" name="project_column" value="<?php echo $project_column; ?>"></td>
			<td ><input class="form-control" type="number" name="project_weight" value="<?php echo $project_weight; ?>"></td>
		</tr>
		<tr>
			<td>Exam</td>
			<td ><input class="form-control" type="number" name="exam_column" value="<?php echo $exam_column; ?>" disabled></td>
			<td ><input class="form-control" type="number" name="exam_weight" value="<?php echo $exam_weight; ?>"></td>
		</tr>
		<tr>
			<td>Total Percentage</td>
			<td ></td>
			<td class="quiz-cell">
				<input type="hidden" name="total_weight" value="<?php echo $total_weight; ?>">
				<?php echo $total_weight; ?>
			</td>
		</tr>
	</tbody>
</table>

<div class="row">
	<div class="col-xs-6">
		<span class="message"></span>
	</div>
	<div class="col-xs-6">
		<input class="pull-right btn btn-success" id="update-grading-system" type="submit" value="Update Grading Percentage">
	</div>
</div>

<?php echo form_close(); ?>


