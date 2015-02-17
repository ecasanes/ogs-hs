<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4><?php echo $step_title; ?></h4>
	</div>


	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>



    	<div class="row content">
									<div class="col-xs-12">
										<div class="page-header">
											<div class="row">
												<div class="col-xs-8">
												<!-- <h2 class="step-title"></h2> -->
												</div>
												<div class="col-xs-4">
													<?php $this->load->view('includes/casefile-upload', $data); ?>                                                    
												</div>
											</div>

										</div>
									</div>
								</div>





								<div class="row content">
									<div class="col-xs-12 status-report">

											<div class="col-xs-1"><p class="strong">From</p></div>

											<div class="row content col-xs-5">
												<div class="dynamic-row">
													<?php 
													//TO DO:
													/*$user_counter = 0;
													foreach($additional_users as $user){ 
														$first_name = $user['first_name'];
														$last_name = $user['last_name'];
														$full_name = $first_name . ' ' . $last_name;
														if($full_name == ' '){
															$full_name = '';
														}
														$user_id = $user['user_id'];
														$user_name = $user['user_name'];
														$email_address = $user['email_address'];

														if($user_counter == 0){
															$user_class = 'left';
															$user_counter++;
														}else if($user_counter == 1){
															$user_class = '';
															$user_counter = 0;
														}*/
														?>
														<div class="additional-user">
															<div class="form-group">
																<input type="text" class="form-control new-user" name="additional_user[]" placeholder="Firstname Lastname" value="<?php // echo $full_name; ?>" autocomplete="off">
															</div>
															<div class="autosuggest form-group">
																<ul class="user-suggest"></ul>
															</div>
														</div>
														<?php // } ?>
													</div>
												</div>
										</div>
									</div>
								</div>

								




								<div class="row content">
									<div class="col-xs-12 status-report">
											<div class="col-xs-1"><p class="strong required-input">To</p></div>
											<div class="col-xs-6 form-group">
												<select class="form-control" name="from_auto_pop" id="from_auto_pop" required>
													<?php // echo default_select($responsible_party_role); ?>
													<?php //echo $responsible_party_role_dropdown; ?>
												</select>
											</div>
											
											<div class="row content col-xs-5">
												<div class="dynamic-row">
													<?php 
													//TO DO:
													/*$user_counter = 0;
													foreach($additional_users as $user){ 
														$first_name = $user['first_name'];
														$last_name = $user['last_name'];
														$full_name = $first_name . ' ' . $last_name;
														if($full_name == ' '){
															$full_name = '';
														}
														$user_id = $user['user_id'];
														$user_name = $user['user_name'];
														$email_address = $user['email_address'];

														if($user_counter == 0){
															$user_class = 'left';
															$user_counter++;
														}else if($user_counter == 1){
															$user_class = '';
															$user_counter = 0;
														}*/
														?>
														<div class="additional-user">
															<div class="form-group">
																<input type="text" class="form-control new-user" name="additional_user[]" placeholder="Firstname Lastname" value="<?php //echo $full_name; ?>" autocomplete="off">
															</div>
															<div class="autosuggest form-group">
																<ul class="user-suggest"></ul>
															</div>
														</div>
														<?php // } ?>
													</div>
												</div>
										</div>
									</div>



									<div class="row content">
										<div class="col-xs-12 status-report">
												<div class="col-xs-1"><p class="strong">CC</p></div>
												<div class="col-xs-4 form-group" >
													<select class="form-control" name="start_date_dropdown[<?php //echo $question_id; ?>]" style="padding:2px;">
														<?php //echo default_select($question_start_date_dropdown); ?>
														<option value="n/a">- Select -</option>
														<option value="n/a">fixed</option>
														<option value="long term">interested</option>
														<option value="unknown">both</option>
													</select>
												</div>
												<div class="col-xs-2"><p class="strong required-input">Current Status</p></div>
												<div class="col-xs-5">
													<div class="form-group">
														<select class="form-control" name="status-cat" id="status_cat" required>
															<?php //echo default_select($status_report_status); ?>
															<?php //echo $status_report_status_dropdown; ?>
														</select>
													</div>
												</div>
										</div>
									</div>


									<div class="row content">
										<div class="col-xs-12 status-report">
											<div class="row">
												<div class="col-xs-12"><p class="strong"></p></div>
											</div>
										</div>
									</div>

									<div class="row content">
										<div class="col-xs-12 status-report">
												<div class="col-xs-12">
													<div class="form-group form-group-required">
														<textarea class="form-control textarea-editor medium" name="message_board_summary" cols="30" rows="5" required><?php echo $message_board_summary; ?></textarea>
													</div>
												</div>
										</div>	

										</div>


	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>