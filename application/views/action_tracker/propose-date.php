<div class="row">
	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-info">
			<?php echo form_open('action-tracker/submit-date-proposal'); ?>
			<?php echo form_hidden('action_tracker_id', $action_tracker_id); ?>
			<?php echo form_hidden('subaction', $subaction); ?>
				<div class="panel-heading">
					<h4 class="panel-title">Prupose a Date</h4>
				</div>
				<div class="panel-body">
					
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="propose_date">Date:</label>
									<input type="text" name="propose_date" value="" class="datepicker form-control" required>
								</div>
							</div>
							<!-- <div class="col-xs-12 col-sm-9">
								<div class="form-group">
									<label for="propose_date">Comments:</label>
									<textarea name="comment" class="form-control" required></textarea>
								</div>
							</div> -->
						</div>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-sm-offset-6 text-right">
							<button type="submit" class="btn btn-primary form-control">Submit Proposal</button>
						</div>
					</div>
					
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
