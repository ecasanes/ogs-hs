<?php

	$id = $this->uri->segment(3);
	$edit_ofi = base_url('ofi/edit/'.$id);
	$cover_title = "Oppurtunity for Improvement";
	$edit_form = base_url('ofi/edit/'.$id);

	$edit_text = '<span class="glyphicon glyphicon-pencil"></span>';
	$edit_button_type = 'button';

	$edit_step_0_title = array('title' => 'Edit OFI');
	$edit_step_1_title = array('title' => 'Edit Defining the Opportunity');
	$edit_step_2_title = array('title' => 'Edit Risks or Threats');
	$edit_step_3_title = array('title' => 'Edit  Next Steps');

	$edit_step_0_link = display_link($edit_form.'/0', $edit_text, $edit_button_type, $editable, $edit_step_0_title);
	$edit_step_1_link = display_link($edit_form.'/1', $edit_text, $edit_button_type, $editable, $edit_step_1_title);
	$edit_step_2_link = display_link($edit_form.'/2', $edit_text, $edit_button_type, $editable, $edit_step_2_title);
	$edit_step_3_link = display_link($edit_form.'/3', $edit_text, $edit_button_type, $editable, $edit_step_3_title);
?>

<section id="main-content">
	<div class="container">

		<div class="row hidden-print">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-5">
							<h1 class="content-title">Opportunity for Improvement</h1>
						</div>
						<div class="col-xs-7 text-right">
							<p class="btn btn-print">Page 1 of 5</p>
							<?php echo $edit_step_0_link; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view('includes/view-cover-page', $data); ?>


		<!-- <div class="row">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-3">
							<h1 class="content-title">Profile</h1>
						</div>
						<div class="col-xs-9 text-right">
							<p class="btn btn-print">Page 1 of 5</p>
							<?php //echo $edit_step_0_link; ?>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		

		<h2 class="content-title">User Profile</h2>
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium">Username:</td>
						<td><?php echo $user_name; ?></td>
						<td class="table-label label-medium">Date:</td>
						<td><?php echo $user_date; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Name:</td>
						<td><?php echo $name; ?></td>
						<td class="table-label label-medium">Number:</td>
						<td><?php echo $code; ?></td>
					</tr>
					<!-- <tr>
						<td class="table-label label-medium">Summary:</td>
						<td colspan="3"><?php //echo $case_summary; ?></td>
					</tr> -->
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
						<td class="table-label label-medium">Area of Focus:</td>
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
				</tbody>
			</table>
		</div>			




		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-4">
						<h1 class="content-title">Step 1 - Defining the Opportunity</h1>
					</div>
					<div class="col-xs-8 text-right">
						<p class="btn btn-print">Page 2 of 5</p>
						<?php echo $edit_step_1_link; ?>
					</div>
				</div>
			</div>
			</div>
		</div>



		<?php 
				foreach($type_of_improvements as $improvement){ 
					$type_of_improvement_value = $improvement['type_of_improvement_value'];
					$type_of_improvement_description = $improvement['type_of_improvement_description'];
			?>
				<div class="row-table table-responsive">
					<table class="table view-casefile">
						<tbody>
							<tr>
								<td class="table-label label-large">Type of Improvement:</td>
								<td><?php echo $type_of_improvement_value; ?></td>
							</tr>
							<tr>
								<td class="table-label label-large">Description:</td>
								<td><?php echo $type_of_improvement_description; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			<?php } ?>



			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-large">Improvement Summary:</td>
							<td><?php echo $possible_solution_summary; ?></td>
						</tr>
					</tbody>
				</table>
			</div>


		<h2 class="content-title">Benefits Breakdown</h2>
			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-small">Item</td>
							<td class="table-label label-large">Description</td>
						</tr>

						<?php

						foreach($benefit_breakdown_items as $item){ 

								$item_description = $item['item_description_value'];
                                $item_description_text = $item['item_description_text'];

                        ?>

                        <tr>
							<td><?php echo $item_description; ?></td>
							<td><?php echo $item_description_text; ?></td>
						</tr>

                        <?php } ?>
					</tbody>
				</table>
			</div>

		<h2 class="content-title">Cost Breakdown</h2>
		
		<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-small">Item</td>
							<td class="table-label label-large">Description</td>
						</tr>

						<?php

						foreach($cost_breakdown_items as $item){ 

								$item_description = $item['item_description_value'];
                                $item_description_text = $item['item_description_text'];

                        ?>

                        <tr>
							<td><?php echo $item_description; ?></td>
							<td><?php echo $item_description_text; ?></td>
						</tr>

                        <?php } ?>
					</tbody>
				</table>
			</div>

		<h2 class="content-title">Enablers</h2>


			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>

						<tr>
							<td class="table-label" colspan="2">Prerequisites</td>
						</tr>

						<?php $counter = 1; ?>
						<?php foreach($enablers_prerequisite as $prerequisite){
                          $prerequisite = $prerequisite->description;
                        ?>

                            <tr>
								<td><?php echo $prerequisite; ?></td>
							</tr>

                        <?php $counter++; } ?>
					</tbody>
				</table>
			</div>



			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>

						<tr>
							<td class="table-label" colspan="2">Dependencies</td>
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
			</div>



		<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-small">Specialist Requirement</td>
							<td class="table-label label-large">Description</td>
						</tr>

						<?php

						foreach($enablers as $enabler){ 

                            $specialist_requirement = $enabler['special_requirement_value'];
							$commitment_description = $enabler['description'];

                        ?>

                        <tr>
							<td><?php echo $specialist_requirement; ?></td>
							<td><?php echo $commitment_description; ?></td>
						</tr>

                        <?php } ?>
					</tbody>
				</table>
			</div>


		

		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-4">
						<h1 class="content-title">Step 2 - Risks and Threats</h1>
					</div>
					<div class="col-xs-8 text-right">
						<p class="btn btn-print">Page 3 of 5</p>
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
						<td><?php echo $risks; ?></td>
					</tr>
				</tbody>
			</table>
		</div>


		<h2 class="content-title">Constraints</h2>
			          
			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium">Constraints</td>
							<td class="table-label label-medium">Mitigating Action</td>
							<td class="table-label label-medium">Action Party</td>
						</tr>

						<?php

						foreach($constraints as $item){ 

                            $constraint = $item->constraints;
                            $mitigating_action = $item->mitigating_action;
                            $action_party = $item->action_party;


                        ?>

                        <tr>
							<td><?php echo $constraint; ?></td>
							<td><?php echo $mitigating_action; ?></td>
							<td><?php echo $action_party; ?></td>
						</tr>

                        <?php } ?>
					</tbody>
				</table>
			</div>


		


		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-4">
						<h1 class="content-title">Step 3 - Next Steps</h1>
					</div>
					<div class="col-xs-8 text-right">
						<p class="btn btn-print">Page 4 of 5</p>
						<?php echo $edit_step_3_link; ?>
					</div>
				</div>
			</div>
			</div>
		</div>

		<h2 class="content-title">Action Tracker</h2>
			          
			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-xs">Reference</td>
							<td class="table-label label-medium">Action/Process Step</td>
							<td class="table-label label-xs">Status</td>
							<td class="table-label label-xs">Owner</td>
							<td class="table-label label-xs">Due Date</td>
							<td class="table-label label-xs">Comments</td>
						</tr>

						<?php

						foreach($action_tracker as $result){ 

	                        $reference = $result['reference'];
							$action_process_step = $result['action_process_step'];
							$status_color = $result['status_color'];
							$owner = $result['owner'];
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


		<!-- <h2 class="content-title">Next Steps</h2>
			
			<div class="row-table table-responsive">
				<table class="table view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-large">Process Steps</td>
							<td class="table-label label-medium">Responsible</td>
						</tr>

						<?php

						foreach($next_steps as $process_step){ 


                        ?>

                        <tr>
							<td><?php echo $process_step->process_step; ?></td>
							<td><?php echo $process_step->responsible; ?></td>
						</tr>

                        <?php } ?>
					</tbody>
				</table>
			</div>	 -->		

			<h2 class="content-title ">File Gallery</h2>


		<?php
			$attributes = array('class' => 'email', 'id' => 'myform');
			echo form_open('ofi/remove-file', $attributes);
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