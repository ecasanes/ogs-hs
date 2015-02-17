<?php

	$id = $this->uri->segment(3);
	$edit_form = base_url('project-plan/edit/'.$id);
	$cover_title = "Project Plan";

?>


<div class="panel panel-default">
	
	<div class="row">
      <div class="col-xs-12 col-sm-12">
          <h2 class="text-center">Project Work Pack Report <?php echo $code; ?></h2>
          <h1 class="text-center"><?php echo $name; ?></h1>
      </div> 
    </div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-8">
							<h4 class="content-title">Step 1 - Develop Project Work Pack</h4>
						</div>
						<?php if($current_user_id == $document_creator){ ?>
						<div class="col-xs-4 text-right">
							<!-- <p class="btn btn-print pull-right">Page 1 of 9</p> -->
							<a href="<?php echo $edit_form.'/1'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Develop Project Work Pack"><span class="glyphicon glyphicon-pencil"></span></a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>	
		</div>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Author:</td>
						<td class="table-label label-large"><?php echo $author; ?></td>
						<td class="table-label label-small bg-grey-primary">Document Code:</td>
						<td><?php echo $number; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Project Leader:</td>
						<td class="table-label label-large"><?php echo $project_leader; ?></td>
						<td class="table-label label-small bg-grey-primary">Date:</td>
						<td><?php echo $date; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large bg-grey-primary">Project Sponsor:</td>
						<td><?php echo $project_sponsor; ?></td>
						<td class="table-label label-large bg-grey-primary">Target Start Date:</td>
						<td><?php echo $target_start_date; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Project Name:</td>
						<td><?php echo $project_name; ?></td>
						<td class="table-label label-medium bg-grey-primary">Project Duration:</td>
						<td><?php echo $project_duration; ?></td>
						
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Project Condition:</td>
						<td><?php echo $project_condition; ?></td>
						<td class="table-label label-medium bg-grey-primary">Costs:</td>
						<td><?php echo $costs; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Justification for Change:</td>
						<td><?php echo $justification_for_change; ?></td>
						<td class="table-label label-medium bg-grey-primary">Work Party:</td>
						<td><?php echo $work_party; ?></td>
					</tr>
					<!-- <tr>
						<td class="table-label label-medium">Associated Documents:</td>
						<td colspan="3"><?php  // echo $associated_documents; ?></td>
					</tr> -->
				</tbody>
			</table>
		</div>

		<!-- <h4 class="content-title">Equipment Profile</h4>
					<div class="row-table table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td class="table-label label-large bg-grey-primary">System:</td>
									<td colspan="3"><?php echo $system_value; ?></td>
								</tr>
								<tr>
									<td class="table-label label-large bg-grey-primary">System Subcategory:</td>
									<td colspan="3"><?php echo $system_subcategory_value; ?></td>
								</tr>
								<tr>
									<td class="table-label label-large bg-grey-primary">Equipment Category:</td>
									<td><?php echo $equipment_category_value; ?></td>
									<td class="table-label label-medium bg-grey-primary">Class:</td>
									<td><?php echo $equipment_class_value; ?></td>
								</tr>
								<tr>
									<td class="table-label label-large bg-grey-primary">Description:</td>
									<td><?php echo $equipment_description_value; ?></td>
									<td class="table-label label-medium bg-grey-primary">Code:</td>
									<td><?php echo $equipment_code_value; ?></td>
								</tr>
							</tbody>
						</table>
					</div> -->			




		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-8">
							<h4 class="content-title">Step 2 - Describe the Opportunity to Improve</h4>
						</div>
						<?php if($current_user_id == $document_creator){ ?>
						<div class="col-xs-4 text-right">
							<!-- <p class="btn btn-print pull-right">Page 2 of 9</p> -->
							<a href="<?php echo $edit_form.'/2'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Describe the Opportunity to Improve"><span class="glyphicon glyphicon-pencil"></span></a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>



		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large bg-grey-primary">Project Definition:</td>
						<td><?php echo $project_definition; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large bg-grey-primary">Purpose:</td>
						<td><?php echo $purpose; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large bg-grey-primary">Success Criteria:</td>
						<td><?php echo $success_criteria; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large bg-grey-primary">First Day Offshore:</td>
						<td><?php echo $first_day_offshore; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large bg-grey-primary">Last Day Offshore:</td>
						<td><?php echo $last_day_offshore; ?></td>
					</tr>
				</tbody>
			</table>
		</div>


		

		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-8">
						<h4 class="content-title">Step 3 - About the Solution</h4>
					</div>
					<?php if($current_user_id == $document_creator){ ?>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print pull-right">Page 3 of 9</p> -->
						<a href="<?php echo $edit_form.'/3'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit About the Solution"><span class="glyphicon glyphicon-pencil"></span></a>
					</div>
					<?php } ?>
				</div>
			</div>
			</div>
		</div>

		<!-- BENEFITS SUMMARY-->

		
					<!-- <div class="row">
						<div class="col-xs-3">
							<h4 class="content-title">Benefits</h4>
						</div>
					</div>
									
					
					
								<div class="row-table table-responsive">
									<table class="table table-bordered">
					<tbody>
						<tr>
							<td><?php // echo $benefits; ?></td>
						</tr>
					</tbody>
									</table>
								</div> -->


		<div class="row">
						<div class="col-xs-12">
							<h4 class="content-title">Benefits Breakdown</h4>
						</div>
					</div>
			<div class="row-table table-responsive">
				<table class="table table-bordered view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-small bg-grey-primary">Item</td>
							<td class="table-label label-large bg-grey-primary">Description</td>
						</tr>

						<?php

						foreach($benefit_breakdown_items as $item){ 

								$item_description = $item['item_description'];
                                $item_description_text = $item['text'];

                        ?>

                        <tr>
							<td><?php echo $item_description; ?></td>
							<td><?php echo $item_description_text; ?></td>
						</tr>

                        <?php } ?>
					</tbody>
				</table>
			</div>



		<!-- <div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
		
					<tr>
						<td class="table-label bg-grey-primary" colspan="2">Dependencies</td>
					</tr>
		
					<?php $counter = 1; ?>
					<?php foreach($enablers_dependencies as $dependencies){
		                        $dependencies = $dependencies->description;
		                    ?>
		
		                        <tr>
							<td><?php echo $dependencies; ?></td>
						</tr>
		
		                    <?php $counter++; } ?>
				</tbody>
			</table>
		</div> -->








			
					<div class="row">
						<div class="col-xs-12">
							<h4 class="content-title">Cost Breakdown</h4>
						</div>
					</div>
				


			
			<div class="row-table table-responsive">
				<table class="table table-bordered view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-small bg-grey-primary">Item</td>
							<td class="table-label label-small bg-grey-primary">Description</td>
							<td class="table-label label-small bg-grey-primary">Unit Cost</td>
							<td class="table-label label-small bg-grey-primary">Volume</td>
							<td class="table-label label-small bg-grey-primary">Sub Total</td>
							<td class="table-label label-small bg-grey-primary">Status</td>
						</tr>

						<?php

						foreach($cost_breakdown_items as $item){ 

								$item_description = $item['item_description'];
                                $item_description_text = $item['text'];
                                $e_unit_cost = $item['e_unit_cost'];
                                $e_volume = $item['e_volume'];
                                $e_subtotal = $item['e_subtotal'];
                                $status = $item['status'];


                        ?>

                        <tr>
							<td><?php echo $item_description; ?></td>
							<td><?php echo $item_description_text; ?></td>
							<td><?php echo $e_unit_cost; ?></td>
							<td><?php echo $e_volume; ?></td>
							<td><?php echo $e_subtotal; ?></td>
							<td><?php echo $status; ?></td>
						</tr>

                        <?php } ?>
                        <tr>
							<td colspan="4" class="table-label label-small bg-grey-primary">TOTAL</td>
							<td colspan="2"><?php echo $costs; ?></td>
						</tr>
					</tbody>
				</table>
			</div>







		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-8">
						<h4 class="content-title">Step 4 - Risk Management</h4>
					</div>
					<?php if($current_user_id == $document_creator){ ?>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print pull-right">Page 4 of 9</p> -->
						<a href="<?php echo $edit_form.'/4'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Risk Management"><span class="glyphicon glyphicon-pencil"></span></a>
					</div>
					<?php } ?>
				</div>
			</div>
			</div>
		</div>



		<!-- <div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large bg-grey-primary">Boundaries:</td>
						<td><?php echo $plan_description; ?></td>
					</tr>
				</tbody>
			</table>
		</div> -->


		<h4 class="content-title">Risks and Threats associated with the Delivery</h4>

		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Concerns</td>
						<td class="table-label label-large bg-grey-primary">Mitigating Action</td>
						<td class="table-label label-small bg-grey-primary">Owner</td>
						<td class="table-label label-small bg-grey-primary">Due Date on Status</td>
						
					</tr>

					<?php

					foreach($constraints as $item){ 

                        $constraint = $item['constraints'];
                        $mitigating_action = $item['mitigating_action'];
                        $action_party = $item['action_party'];
                        $due_date = $item['due_date_on_status'];


                    ?>

                    <tr>
						<td><?php echo $constraint; ?></td>
						<td><?php echo $mitigating_action; ?></td>
						<td><?php echo $action_party; ?></td>
						<td><?php echo $due_date; ?></td>
						

					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>

		



		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Specialist Requirement</td>
						<td class="table-label label-large bg-grey-primary">Description</td>
						<td class="table-label label-small bg-grey-primary">Owner</td>
						<td class="table-label label-small bg-grey-primary">Due Date</td>
					</tr>

					<?php

					foreach($enablers as $enabler){ 

                        $specialist_requirement = $enabler['special_requirement'];
						$commitment_description = $enabler['commitment_summary'];
						$responsible = $enabler['responsible'];
						$due_date = $enabler['due_date'];

                    ?>

                    <tr>
						<td><?php echo $specialist_requirement; ?></td>
						<td><?php echo $commitment_description; ?></td>
						<td><?php echo $responsible; ?></td>
						<td><?php echo $due_date; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>


		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large bg-grey-primary">Assumptions:</td>
						<td ><?php echo $assumptions; ?></td>
					</tr>
				</tbody>
			</table>
		</div>


		





		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-8">
						<h4 class="content-title">Step 5 - Phase Team & Reporting</h4>
					</div>
					<?php if($current_user_id == $document_creator){ ?>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print pull-right">Page 5 of 9</p> -->
						<a href="<?php echo $edit_form.'/5'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Phase Team & Reporting"><span class="glyphicon glyphicon-pencil"></span></a>
					</div>
					<?php } ?>
				</div>
			</div>
			</div>
		</div>


		<h4 class="content-title">Organisation</h4>
			          
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr> 
						<td class="table-label label-medium bg-grey-primary">Name</td>
						<td class="table-label label-medium bg-grey-primary">Role</td>
						<td class="table-label label-medium bg-grey-primary">Email</td>
						<td class="table-label label-medium bg-grey-primary">Commitment</td>
					</tr>

					<?php

					foreach($organisations as $organisation){ 

                        $name = $organisation['name'];
						$role = $organisation['role'];
						//$mobile = $organisation->mobile;
						$email = $organisation['email'];
						$commitment = $organisation['commitment'];
						$other = $organisation['other'];


                    ?>

                    <tr>
						<td><?php echo $name; ?></td>
						<td><?php if($role == 'Other'){
							echo $other;
						}else{
						echo $role; 
						}?></td>
						<td><?php echo $email; ?></td>
						<td><?php echo $commitment; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>


		



		<h4 class="content-title">Reporting</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Originator</td>
						<td class="table-label label-medium bg-grey-primary">Receiver</td>
						<td class="table-label label-medium bg-grey-primary">Frequency</td>
						<td class="table-label label-medium bg-grey-primary">Format</td>
					</tr>

					<?php

					foreach($reporting as $report){ 

                        $originator = $report['originator'];
						$receiver = $report['receiver'];
						$frequency = $report['frequency'];
						$format = $report['format'];

                    ?>

                    <tr>
						<td><?php echo $originator; ?></td>
						<td><?php echo $receiver; ?></td>
						<td><?php echo $frequency; ?></td>
						<td><?php echo $format; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>



		<h4 class="content-title">Meeting</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Attendees</td>
						<td class="table-label label-medium bg-grey-primary">Agenda</td>
						<td class="table-label label-medium bg-grey-primary">Frequency</td>
						<td class="table-label label-medium bg-grey-primary">Location</td>
					</tr>

					<?php

					foreach($meetings as $meeting){ 

                        $attendees = $meeting['attendees'];
						$agenda = $meeting['agenda'];
						$frequency = $meeting['frequency'];
						$location = $meeting['location'];

                    ?>

                    <tr>
						<td><?php echo $attendees; ?></td>
						<td><?php echo $agenda; ?></td>
						<td><?php echo $frequency; ?></td>
						<td><?php echo $location; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>












		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-8">
						<h4 class="content-title">Step 6 - Specify the Implementation</h4>
					</div>
					<?php if($current_user_id == $document_creator){ ?>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print pull-right">Page 6 of 9</p> -->
						<a href="<?php echo $edit_form.'/6'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Specify the Implementation"><span class="glyphicon glyphicon-pencil"></span></a>
					</div>
					<?php } ?>
				</div>
			</div>
			</div>
		</div>

		<h4 class="content-title">Deliverables</h4>
			          
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-xl bg-grey-primary">Detailed Description of Deliverables</td>
						<td class="table-label label-sm bg-grey-primary">Location</td>
						<td class="table-label label-sm bg-grey-primary">Owner</td>
						<td class="table-label label-sm bg-grey-primary">Start Date</td>
						<td class="table-label label-sm bg-grey-primary">Due Date</td>
					</tr>

					<?php

					foreach($deliverables as $deliverable){ 

                        $deliverable_description = $deliverable['description'];
						$due_date = $deliverable['due_date'];
						$start_date = $deliverable['start_date'];
						$duration = $deliverable['deliverable_duration'];
						$location = $deliverable['location'];
						$responsible = $deliverable['responsible'];


                    ?>

                    <tr>
						<td><?php echo $deliverable_description; ?></td>
						<td><?php echo $location; ?></td>
						<td><?php echo $responsible; ?></td>
						<td><?php echo $start_date; ?></td>
						<td><?php echo $due_date; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>

		<h4 class="content-title">Associated Activities</h4>
			          
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large bg-grey-primary">Operational Requirements</td>
						<td class="table-label label-medium bg-grey-primary">Owner</td>
						<td class="table-label label-xs bg-grey-primary">Due Date</td>
						<td class="table-label label-xs bg-grey-primary">Status</td>
					</tr>

					<?php

					foreach($action_logs as $action_log){ 

                        $action = $action_log['action'];
                        $action_party = $action_log['action_party'];
                        $due_date = $action_log['due_date'];
                        $status = $action_log['status'];


                    ?>

                    <tr>
						<td><?php echo $action; ?></td>
						<td><?php echo $action_party; ?></td>
						<td><?php echo $due_date; ?></td>
						<td><?php echo $status; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>


		










		<div id="schedule-of-activities" class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-8">
						<h4 class="content-title">Step 7 - Schedule of Activities</h4>
					</div>
					<?php if($current_user_id == $document_creator){ ?>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print pull-right">Page 7 of 9</p> -->
						<a href="<?php echo $edit_form.'/7'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Schedule of Activities"><span class="glyphicon glyphicon-pencil"></span></a>
					</div>
					<?php } ?>
				</div>
			</div>
			</div>
		</div>


		<h4 class="content-title">Action Tracker</h4>
			          
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-xs bg-grey-primary">Reference</td>
						<td class="table-label label-medium bg-grey-primary">Action/Process Step</td>
						<td class="table-label label-xs bg-grey-primary">Status</td>
						<td class="table-label label-xs bg-grey-primary">Owner</td>
						<td class="table-label label-xs bg-grey-primary">Due Date</td>
						<td class="table-label label-xs bg-grey-primary">Comments</td>
					</tr>

					<?php

					foreach($action_tracker as $result){ 

                        $reference = $result['reference'];
						$action_process_step = $result['action_process_step'];
						$status_color = $result['status_color'];
						$owner = $result['full_name'];
						$due_date = $result['due_date'];
						$duration = $result['duration'];
						$comments = $result['comments'];


                    ?>

                    <tr>
						<td><?php echo $reference; ?></td>
						<td><?php echo $action_process_step; ?></td>
						<td class="<?php echo $status_color; ?>"></td>
						<td><?php echo $owner; ?></td>
						<td><?php echo $due_date; ?></td>
						<td><?php echo $comments; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>




		


		<!-- <div class="row-table table-responsive">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td class="table-label label-medium">Summary:</td>
						<td><?php // echo $quality_control; ?></td>
					</tr>
				</tbody>
			</table>
		</div> -->


		<!-- <h4 class="content-title">Expectation</h4>
			          
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Supplier</td>
						<td class="table-label label-xs bg-grey-primary">Input</td>
						<td class="table-label label-xs bg-grey-primary">Process/Deliverable</td>
						<td class="table-label label-medium bg-grey-primary">Output</td>
						<td class="table-label label-xs bg-grey-primary">Receiver</td>
					</tr>
		
					<?php
		
					foreach($expectations as $expectation){ 
		
		                        $supplier = $expectation->supplier;
						$input = $expectation->input;
						$process_deliverable = $expectation->process_deliverable;
						$output = $expectation->output;
						$receiver = $expectation->receiver;
		
		
		                    ?>
		
		                    <tr>
						<td><?php echo $supplier; ?></td>
						<td><?php echo $input; ?></td>
						<td><?php echo $process_deliverable; ?></td>
						<td><?php echo $output; ?></td>
						<td><?php echo $receiver; ?></td>
					</tr>
		
		                    <?php } ?>
				</tbody>
			</table>
		</div> -->

		<!-- <h4 class="content-title">Process Steps</h4>
		
		<div class="row-table table-responsive">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td class="table-label label-medium">Event</td>
						<td class="table-label label-medium">Responsible</td>
					</tr>
					<?php
		
					foreach($process_steps as $step){ 
		
		                        $event = $step->event;
						$responsible = $step->responsible;
		
		
		                    ?>
					<tr>
						<td><?php //echo $event; ?></td>
						<td><?php //echo $responsible; ?></td>
					</tr>
		
					<?php } ?>
				</tbody>
			</table>
		</div> -->

		

		<!-- <div class="row-table table-responsive">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td class="table-label label-medium">Pass or Fail</td>
							<td><?php //echo $pass_fail; ?></td>
						</tr>
						
					</tbody>
				</table>
			</div> -->







		



		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-8">
						<h4 class="content-title">Step 8 - Quality Control</h4>
					</div>
					<?php if($current_user_id == $document_creator){ ?>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print pull-right">Page 8 of 9</p> -->
						<a href="<?php echo $edit_form.'/8'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Quality Control"><span class="glyphicon glyphicon-pencil"></span></a>
					</div>
					<?php } ?>
				</div>
			</div>
			</div>
		</div>

		<h4 class="content-title">Quality Control Steps</h4>

		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Event</td>
						<td class="table-label label-medium bg-grey-primary">Owner</td>
					</tr>
					<?php

					foreach($quality_control_steps as $step){ 

                        $event = $step['event'];
						$responsible = $step['responsible'];


                    ?>
					<tr>
						<td><?php echo $event; ?></td>
						<td><?php echo $responsible; ?></td>
					</tr>

					<?php } ?>
				</tbody>
			</table>
		</div>

		<h4 class="content-title">Milestone</h4>
			          
		<div class="row-table table-responsive"> 
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large bg-grey-primary">Event</td>
						<td class="table-label label-xs bg-grey-primary">Due Date</td>
						<td class="table-label label-xs bg-grey-primary">Status</td>
					</tr>

					<?php

					foreach($milestones as $milestone){ 

                        $event = $milestone['event'];
                        $milestone_date = $milestone['milestone_date'];
                        $milestone_status = $milestone['milestone_status'];


                    ?>

                    <tr>
						<td><?php echo $event; ?></td>
						<td><?php echo $milestone_date; ?></td>
						<td><?php echo $milestone_status; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>

		<h4 class="content-title">Change Management</h4>
			          
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large bg-grey-primary">Event</td>
						<td class="table-label label-large bg-grey-primary">Owner</td>
						<td class="table-label label-xs bg-grey-primary">Due Date</td>
						<td class="table-label label-xs bg-grey-primary">Area of Authority</td>
					</tr>

					<?php 
					foreach($change_management as $change){ 
                                
                    	$event = $change['event'];
                    	$responsible_party = $change['responsible_party'];
                    	$due_date = $change['change_date'];
                    	$area_of_authority = $change['area_of_authority'];


                    ?>

                    <tr>
						<td><?php echo $event; ?></td>
						<td><?php echo $responsible_party; ?></td>
						<td><?php echo $due_date; ?></td>
						<td><?php echo $area_of_authority; ?></td>
					</tr>

                    <?php } ?>
				</tbody>
			</table>
		</div>

		

		<!-- <h4 class="content-title">Summary</h4>
		
		
		<div class="row-table table-responsive">
			<table class="table table-bordered">
				<tbody>
					<tr>
						<td class="table-label label-medium">Lessons Learned:</td>
						<td><?php //echo $lesson_learned; ?></td>
					</tr>
				</tbody>
			</table>
		</div> -->
		<h4 class="content-title">Evaluation</h4>

		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Lessons Learned</td>
						<td><?php echo $lesson_learned; ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<h4 class="content-title">Cost Breakdown</h4>

		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td rowspan="2" class="table-label label-medium bg-grey-primary">Description</td>
						<td colspan="3" class="table-label label-medium bg-grey-primary">Estimated</td>
						<td colspan="3" class="table-label label-medium bg-grey-primary">Actual</td>
					</tr>
					<tr>
						<td class="table-label label-xs bg-grey-primary">Cost</td>
						<td class="table-label label-xs bg-grey-primary">Volume</td>
						<td class="table-label label-xs bg-grey-primary">Subtotal</td>
						<td class="table-label label-xs bg-grey-primary">Cost</td>
						<td class="table-label label-xs bg-grey-primary">Volume</td>
						<td class="table-label label-xs bg-grey-primary">Subtotal</td>
					</tr>
					<?php

						foreach($cost_breakdown_items as $item){ 

								$item_description = $item['item_description'];
                                $item_description_text = $item['text'];
                                $e_unit_cost = $item['e_unit_cost'];
                                $e_volume = $item['e_volume'];
                                $e_subtotal = $item['e_subtotal'];
                                $a_unit_cost = $item['a_unit_cost'];
                                $a_volume = $item['a_volume'];
                                $a_subtotal = $item['a_subtotal'];
                                $status = $item['status'];


                        ?>

                        <tr>
							<td><?php echo $item_description_text; ?></td>
							<td><?php echo $e_unit_cost; ?></td>
							<td><?php echo $e_volume; ?></td>
							<td><?php echo $e_subtotal; ?></td>
							<td><?php echo $a_unit_cost; ?></td>
							<td><?php echo $a_volume; ?></td>
							<td><?php echo $a_subtotal; ?></td>
						</tr>
						 <?php } ?>
						<tr>
							<td colspan="3" class="table-label label-small bg-grey-primary">TOTAL</td>
							<td><?php echo $costs; ?></td>
							<td colspan="2"></td>
							<td><?php echo $cost_breakdown_actual_total; ?></td>
						</tr>
						<tr>
							<td colspan="6" class="table-label label-small bg-grey-primary">VARIATION</td>
							<td><?php echo $cost_breakdown_variation; ?></td>
						</tr>
				</tbody>
			</table>
		</div>



		<?php

			$gallery_title = "Additional Files";
			$gallery_result = $gallery_files;

			$gallery_data = array(
					'gallery_title' => $gallery_title,
					'gallery_result' => $gallery_result
				);

			$this->load->view('includes/file-gallery-snippet', $gallery_data); 

		?>

	</div>

</div>