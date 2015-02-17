<?php


	$id = $this->uri->segment(3);
	$edit_erp = base_url('erp/edit/'.$id);
	$cover_title = "Equipment Repair";
	$edit_form = base_url('erp/edit/'.$id);

	$edit_text = '<span class="glyphicon glyphicon-pencil"></span>';
	$edit_button_type = 'button';

	$edit_step_1_title = array('title' => 'Edit ERP');
	$edit_step_2_title = array('title' => 'Edit ERP Status');
	$edit_step_3_title = array('title' => 'Edit Message Board');
	$edit_step_4_title = array('title' => 'Edit Repair Report');
	$edit_step_5_title = array('title' => 'Edit Observations and Recommendations');

	$edit_step_1_link = display_link($edit_form.'/1', $edit_text, $edit_button_type, $editable, $edit_step_1_title);
	$edit_step_2_link = display_link($edit_form.'/2', $edit_text, $edit_button_type, $editable, $edit_step_2_title);
	$edit_step_3_link = display_link($edit_form.'/3', $edit_text, $edit_button_type, $editable, $edit_step_3_title);
	$edit_step_4_link = display_link($edit_form.'/4', $edit_text, $edit_button_type, $editable, $edit_step_4_title);
	$edit_step_5_link = display_link($edit_form.'/5', $edit_text, $edit_button_type, $editable, $edit_step_5_title);
	/*$edit_step_5_link = display_link($edit_form.'/5', $edit_text, $edit_button_type, $editable, $edit_step_5_title);
	$edit_step_6_link = display_link($edit_form.'/6', $edit_text, $edit_button_type, $editable, $edit_step_6_title);
	$edit_step_7_link = display_link($edit_form.'/7', $edit_text, $edit_button_type, $editable, $edit_step_7_title);*/

?>


<section id="main-content">
	<div class="container">

		<div class="row hidden-print">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-3">
							<h1 class="hidden-print content-title">Equipment Repair</h1>
							<!--<h1 class="visible-print content-title">Case Profile</h1>-->
						</div>
						<div class="col-xs-9 text-right">
							<?php echo $edit_step_1_link; ?>
						</div>
					</div>
				</div>
			</div>
		</div>


		
		<?php $this->load->view('includes/view-cover-page', $data); ?>



		<div class="row">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-3">
							<h1 class="visible-print content-title">Profile</h1>
						</div>
						<div class="col-xs-9 text-right">
							<p class="btn btn-print">Page 1 of 7</p>
							<?php echo $edit_step_1_link; ?>
						</div>
					</div>
				</div>
			</div>
		</div>


		<br>
		<h2 class="content-title hidden-print">User Profile</h2>
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<!-- <tr>
						<td class="table-label label-medium">Username:</td>
						<td><?php echo $user_name; ?></td>
						<td class="table-label label-medium">Date:</td>
						<td><?php echo $user_date; ?></td>
					</tr> -->
					<tr>
						<td class="table-label label-medium">Name:</td>
						<td colspan="3"><?php echo $name; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Work Order Number:</td>
						<td><?php echo $work_order_number; ?></td>
						<td class="table-label label-medium">Number:</td>
						<td><?php echo $code; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Repair Criticality:</td>
						<td><?php echo $repair_criticality_value; ?></td>
						<td class="table-label label-medium">Date of Raised:</td>
						<td><?php echo $date_of_raised; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Criticality Justification:</td>
						<td><?php echo $criticality_justification_value; ?></td>
						<td class="table-label label-medium">Date Reqd on-board:</td>
						<td><?php echo $date_reqd_on_board; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Equipment Repair History:</td>
						<td colspan="3"><?php echo $equipment_repair_history; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		



		<h2 class="content-title">Responsible Parties</h2>
		<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium">Role</td>
							<td class="table-label label-medium">Name</td>
						</tr>

						<?php

						foreach($responsible_party_roles as $party){ 

                            $role = $party['role'];
                            $first_name = $party['firstname'];
                            $last_name = $party['lastname'];
                            $full_name = $first_name . ' ' . $last_name;
                            if($full_name == ' '){
                                $full_name = '';
                            }


                        ?>

                        <tr>
							<td><?php echo $role; ?></td>
							<td><?php echo $full_name; ?></td>
						</tr>

                        <?php } ?>
					</tbody>
				</table>
			</div>



		<h2 class="content-title">Interested Parties</h2>
		<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium">Role</td>
							<td class="table-label label-medium">Name</td>
						</tr>

						<?php

						foreach($interested_party_roles as $party){ 

                            $role = $party['role'];
                            $first_name = $party['firstname'];
                            $last_name = $party['lastname'];
                            $full_name = $first_name . ' ' . $last_name;
                            if($full_name == ' '){
                                $full_name = '';
                            }


                        ?>

                        <tr>
							<td><?php echo $role; ?></td>
							<td><?php echo $full_name; ?></td>
						</tr>

                        <?php } ?>
					</tbody>
				</table>
			</div>

		<h2 class="content-title">Asset Profile</h2>
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium">Asset Type:</td>
						<td><?php echo $asset_type_value; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Justification:</td>
						<td><?php echo $justification_value; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Date Issue:</td>
						<td><?php echo $date_of_issue; ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<h2 class="content-title">Equipment Profile</h2>
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large">System:</td>
						<td colspan="3"><?php echo $system_value; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">System Subcategory:</td>
						<td colspan="3"><?php echo $system_subcategory_value; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Equipment Category:</td>
						<td><?php echo $equipment_category_value; ?></td>
						<td class="table-label label-medium">Class:</td>
						<td><?php echo $equipment_class_value; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Description:</td>
						<td><?php echo $equipment_description_value; ?></td>
						<td class="table-label label-medium">Code:</td>
						<td><?php echo $equipment_code_value; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Tag Number:</td>
						<td><?php echo $equipment_tag_number; ?></td>
						<td class="table-label label-medium">Unique ID:</td>
						<td><?php echo $equipment_unique_id; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Manufacturer:</td>
						<td><?php echo $equipment_manufacturer; ?></td>
						<td class="table-label label-medium">Model:</td>
						<td><?php echo $equipment_model; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Power Output:</td>
						<td><?php echo $equipment_power_output; ?></td>
						<td class="table-label label-medium">Failed Component:</td>
						<td><?php echo $equipment_failed_component; ?></td>
					</tr>
				</tbody>
			</table>
		</div>


		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-5">
							<h1 class="content-title">Step 2 - Status</h1>
						</div>
						<div class="col-xs-7 text-right">
							<p class="btn btn-print">Page 2 of 7</p>
							<?php echo $edit_step_2_link; ?>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large">Asset:</td>
						<td colspan="3"><?php// echo $asset; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Status:</td>
						<td><?php //echo $status; ?></td>
						<td class="table-label label-medium">Mode:</td>
						<td><?php //echo $mode; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Last Location:</td>
						<td><?php //echo $last_location; ?></td>
						<td class="table-label label-medium">Next Location:</td>
						<td><?php //echo $next_location; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Repair Vendor:</td>
						<td colspan="3"><?php// echo $repair_vendor; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Due Date:</td>
						<td colspan="3"><?php// echo $due_date; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Notes:</td>
						<td colspan="3"><?php echo $notes; ?></td>
					</tr>
				<tbody>
			</table>
		</div>		

			




			<div class="row print-break">
				<div class="col-xs-12">
					<div class="page-header">
					<div class="row">
						<div class="col-xs-5">
							<h1 class="content-title">Step 3 - Message Board</h1>
						</div>
						<div class="col-xs-7 text-right">
							<p class="btn btn-print">Page 3 of 7</p>
							<?php echo $edit_step_3_link; ?>
						</div>
					</div>
				</div>
				</div>
			</div>






		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large">From:</td>
						<td colspan="3"><?php// echo $from; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">To:</td>
						<td><?php //echo $to; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">CC:</td>
						<td><?php //echo $cc; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Status:</td>
						<td colspan="3"><?php// echo $status; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large">Message:</td>
						<td colspan="3"><?php echo $message_board_summary; ?></td>
					</tr>
				<tbody>
			</table>
		</div>		







			





			<div class="row print-break">
				<div class="col-xs-12">
					<div class="page-header">
					<div class="row">
						<div class="col-xs-6">
							<h1 class="content-title">Step 4 - Repair Report</h1>
						</div>
						<div class="col-xs-6 text-right">
							<p class="btn btn-print">Page 4 of 7</p>
							<?php echo $edit_step_4_link; ?>
						</div>
					</div>
				</div>
				</div>
			</div>


			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium">Scope:</td>
							<td><?php echo $scope; ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			




			<h2 class="content-title">Deliverables</h2>
			          
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-xl">Detailed Description of Deliverables</td>
						<td class="table-label label-xs">Due Date</td>
					</tr>

					<?php

					foreach($deliverables as $deliverable){ 

                        $deliverable_description = $deliverable->description;
						$due_date = convert_date_to_string($deliverable->due_date);


                    ?>

                    <tr>
						<td><?php echo $deliverable_description; ?></td>
						<td><?php echo $due_date; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>



			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium">Summary:</td>
							<td><?php //echo $definitive_statement; ?></td>
						</tr>
					</tbody>
				</table>
			</div>


			<h2 class="content-title">Responsible Party</h2>

			<?php 
				foreach($responsible_parties as $party){ 
					$event = $party->event;
					$responsible = $party->responsible;
			?>
				<div class="row-table table-responsive">
					<table class="table view-casefile">
						<tbody>
							<tr>
								<td class="table-label label-medium">Event:</td>
								<td><?php echo $event; ?></td>
							</tr>
							<tr>
								<td class="table-label label-medium">Responsible:</td>
								<td><?php echo $responsible; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php } ?>


			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium">Pass or Fail</td>
							<td><?php echo $pass_fail; ?></td>
						</tr>
						
					</tbody>
				</table>
			</div>





			<h2 class="content-title">History</h2>
			<?php 

            $question_categories = array();
            $categories_counter = 0;

            foreach($equipment_history_questions as $question){ 


                $question_id = $question->equipment_history_answer_id;
                $question_category = $question->name;
                $question_detail = $question->question;
                $question_select_type = $question->dropdown_type;
                $question_answer = $question->answer;
                $question_comment = $question->comment;

                if($question_answer == 'n/a'){
                	$question_answer = strtoupper($question_answer);
                }else{
                	$question_answer = ucfirst($question_answer);
                }

                $question_categories[$categories_counter] = $question_category;

                $current_question = $question_categories[$categories_counter];

                if(isset($question_categories[$categories_counter - 1])){
                    $previous_question = $question_categories[$categories_counter - 1];
                }else{
                    $previous_question = '';
                }

                if($current_question != $previous_question){
                    ?>

                    	<?php if($current_question == 'Maintenance'): ?>
							<div class="row print-break">
                        		<div class="col-xs-5">
                        			<h2 class="content-title"><?php echo $current_question; ?></h2>
                        		</div>
                        		<div class="col-xs-7 text-right">
                        			<p class="btn btn-print btn-inside-history">Page 5 of 7</p>
                        		</div>
                        	</div>
                        <?php elseif($current_question == 'Installation'): ?>
                        	<!--<div class="row print-break"> -->
                        		<div class="col-xs-5">
                        			<h2 class="content-title"><?php echo $current_question; ?></h2>
                        		</div>
                        	<!--	<div class="col-xs-7 text-right">
                        			<p class="btn btn-print btn-inside-history">Page 4 of 13</p>
                        		</div>
                        	</div> -->
                    	<?php elseif($current_question == 'Reliability'): ?>
                        	<!--<div class="row print-break"> -->
                        		<div class="col-xs-5">
                        			<h2 class="content-title"><?php echo $current_question; ?></h2>
                        		</div>
                        	<!--	<div class="col-xs-7 text-right">
                        			<p class="btn btn-print btn-inside-history">Page 4 of 13</p>
                        		</div>
                        	</div> -->

                    	<?php else: ?>
							<h2 class="content-title"><?php echo $current_question; ?></h2>
                    	<?php endif; ?>
                    <?php
                }




                ?>

				<div class="row-table table-responsive combined">
					<table class="table view-casefile">
						<tbody>
							<tr>
								<td class="table-label label-xl"><?php echo $question_detail; ?></td>
								<td>

									<?php echo $question_answer ?>
									<?php 
										if($question_comment != ''){
											echo ', '.ucfirst($question_comment);
										}
									?>
								</td>
								
							</tr>
						</tbody>
					</table>
				</div>




                <?php





                $categories_counter++;



            ?>

        

            <?php } //endfor ?>

			


			<div class="row print-break">
				<div class="col-xs-12">
					<div class="page-header">
					<div class="row">
						<div class="col-xs-7">
							<h1 class="content-title">Step 5 - Observations and Recommendations</h1>
						</div>
						<div class="col-xs-5 text-right">
							<p class="btn btn-print">Page 7 of 7</p>
							<?php echo $edit_step_5_link; ?>
						</div>
					</div>
				</div>
				</div>
			</div>

			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-xs">Findings</td>
							<td><?php echo $findings; ?></td>
						</tr>
						<tr>
							<td class="table-label label-xs">Summary</td>
							<td><?php echo $summary; ?></td>
						</tr>
						<tr>
							<td class="table-label label-xs">Recommendations</td>
							<td><?php echo $recommendations; ?></td>
						</tr>
					</tbody>
				</table>
			</div>




		<h2 class="content-title ">File Gallery</h2>


		<?php
			$attributes = array('class' => 'email', 'id' => 'myform');
			echo form_open('case-file/remove-file', $attributes);
		?>
	
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<?php for($i=0;$i<$no_of_steps;$i++): ?>
						<?php foreach(${"files_" . $i} as $file){ ?>
							<?php $data['file'] = $file; ?>
							<?php $this->load->view('includes/file-gallery-snippet', $data); ?>
						<?php } ?>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>


		<?php echo form_close(); ?>

		


			


	</div>

</section>