<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4><?php echo $step_title; ?></h4>
	</div>


	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>



    	<div class="row content">
									<div class="col-xs-12 col-sm-12">
										<div class="page-header">
											<div class="row">
												<div class="col-xs-8">
													<h2></h2>
												</div>
												<div class="col-xs-4">
													<?php $this->load->view('includes/casefile-upload', $data); ?> 
												</div>
											</div>
										</div>
									</div>
								</div>

								
							<div id="report-status-table" class="dynamic-row">

								<?php 
								//TO DO:
								/*foreach($status_reports as $report){ 

									$asset = $report['asset'];
									$status = $report['status'];
									$mode = $report['mode'];
									$last_location = $report['last_location'];
									$next_location = $report['next_location'];
									$repair_vendor = $report['repair_vendor'];
									$due_date = $report['due_date'];
									$receiving_party = $report['receiving_party'];*/


								?>

								<div class="report-status-row">

									<div class="row content">
										<div class="col-xs-12 status-report">
											<div class="row">
												<div class="col-xs-6"><p class="strong">Asset</p></div>
												<div class="col-xs-3"><p class="strong required-input">Status</p></div>
												<div class="col-xs-3"><p class="strong required-input">Mode</p></div>
												<!-- <div class="col-xs-4"><p class="strong">Repair Vendor</p></div> -->
												
											</div>
										</div>
									</div>



									<div class="row content">
										<div class="col-xs-12 status-report">
											<div class="row">
												
												<div class="col-xs-6 form-group">
													<textarea class="form-control textarea-editor medium" name="asset[]" cols="30" rows="5" required><?php //echo $asset; ?></textarea>
												</div>

												<div class="col-xs-6">
													<div class="row">
														<div class="col-xs-6 form-group">
															<select class="form-control" name="status[]" required>
																<?php //echo $status; ?>
															</select>
														</div>

														<div class="col-xs-6 form-group">
															<select class="form-control" name="mode[]" required>
																<?php// echo $mode; ?>
															</select>
														</div>
													</div>

													
													<div class="row">
														<div class="col-xs-6">
															<p class="strong required-input">Last Location</p>
														</div>
														<div class="col-xs-6">
															<p class="strong required-input">Next Location</p>
														</div>
													</div>


													<div class="row">
														<div class="col-xs-6 form-group">
															<select class="form-control" name="last_location[]" required>
																<?php //echo $last_location; ?>
															</select>
														</div>

														<div class="col-xs-6 form-group">
															<select class="form-control" name="next_location[]" required>
																<?php// echo $next_location; ?>
															</select>
														</div>
													</div>
												</div>

												

												<!-- <div class="col-xs-4 form-group">
													<select class="form-control" name="repair_vendor_cat" id="repair-vendor-cat" required>
														<?php //echo default_select($status_report_repair_vendor); ?>
														<?php //echo $status_report_repair_vendor_dropdown; ?>
													</select>
												</div> -->
											</div>
										</div>
									</div>

									<div class="row content">
										<div class="col-xs-12 status-report">
											<div class="row">
												<div class="col-xs-6"><p class="strong required-input">Repair Vendor</p></div>
												<div class="col-xs-2"><p class="strong">Due Date</p></div>
												<div class="col-xs-4"><p class="strong required-input">Receiving Party</p></div>
											</div>
										</div>
									</div>

									<div class="row content">
										<div class="col-xs-12 status-report">
											<div class="row">
												<div class="col-xs-6 form-group">
													<select class="form-control" name="repair_vendor[]" required>
														<?php// echo $repair_vendor; ?>
													</select>
												</div>

												<div class="col-xs-2 form-group">
													<input type="text" class="form-control datepicker" name="due_date[]" placeholder="Select the Date" value="<?php //echo $due_date; ; ?>">
												</div>

												<div class="col-xs-4 form-group">
													<select class="form-control" name="receiving_party[]" required>
														<?php //echo $receiving_party; ?>
													</select>
												</div>
											</div>
										</div>
									</div>

									<div class="row page-header"></div>

								</div> <!-- end report-status-row -->

								

								<?php //} ?>

							</div> <!-- end report-status-table -->




								<div class="row content">
									<div class="col-xs-12 status-report">
										<div class="row">
											<div class="col-xs-12"><p class="strong">Notes</p></div>
										</div>
									</div>
								</div>

								<div class="row content">
									<div class="col-xs-12 status-report">
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group form-group-required">
													<textarea class="form-control textarea-editor medium" name="free_notes" cols="30" rows="5" required><?php echo $free_notes; ?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
	</div>


	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>