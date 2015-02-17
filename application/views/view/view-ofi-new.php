<?php

	$id = $this->uri->segment(3);
	$edit_ofi = base_url('ofi/edit/'.$id);
	$cover_title = "Oppurtunity for Improvement";
	$edit_form = base_url('ofi/edit/'.$id);

	$edit_text = '<span class="glyphicon glyphicon-pencil"></span>';
	$edit_button_type = 'button';

	$edit_step_1_title = array('title' => 'Edit Create Opportunity for Improvement');
	$edit_step_2_title = array('title' => 'Edit Opportunity');
	$edit_step_3_title = array('title' => 'Edit Risks or Threats');
	$edit_step_4_title = array('title' => 'Edit Next Steps');

	$edit_step_1_link = display_link($edit_form.'/1', $edit_text, $edit_button_type, $editable, $edit_step_1_title);
	$edit_step_2_link = display_link($edit_form.'/2', $edit_text, $edit_button_type, $editable, $edit_step_2_title);
	$edit_step_3_link = display_link($edit_form.'/3', $edit_text, $edit_button_type, $editable, $edit_step_3_title);
	$edit_step_4_link = display_link($edit_form.'/4', $edit_text, $edit_button_type, $editable, $edit_step_4_title);
?>


<div class="panel panel-default">
	<div class="row">
      <div class="col-xs-12 col-sm-12">
          <h2 class="text-center">Opportunity for Imporvement Report <?php echo $code; ?></h2>
          <h1 class="text-center"><?php echo $name; ?></h1>
      </div> 
    </div>

	<div class="panel-body">
		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-8">
						<h4 class="content-title">Step 1 - Create Opportunity for Improvement</h4>
					</div>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print">Page 2 of 5</p> -->
						<?php echo $edit_step_1_link; ?>
					</div>
				</div>
				</div>
			</div>
		</div>
		<h4 class="content-title">User Profile</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large bg-grey-primary">Username:</td>
						<td><?php echo $user_name; ?></td>
						<td class="table-label label-large bg-grey-primary">Date:</td>
						<td><?php echo $user_date; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large bg-grey-primary">Name:</td>
						<td><?php echo $name; ?></td>
						<td class="table-label label-large bg-grey-primary">Number:</td>
						<td><?php echo $code; ?></td>
					</tr>
					<!-- <tr>
						<td class="table-label label-medium">Summary:</td>
						<td colspan="3"><?php //echo $case_summary; ?></td>
					</tr> -->
				</tbody>
			</table>
		</div>

		<h4 class="content-title">Asset Profile</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-large bg-grey-primary">Asset Type:</td>
						<td><?php echo $asset_type_value; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large bg-grey-primary">Area of Focus:</td>
						<td><?php echo $justification_value; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large bg-grey-primary">Date Issue:</td>
						<td><?php echo $date_of_issue; ?></td>
					</tr>
				</tbody>
			</table>
		</div>

		<h4 class="content-title">Equipment Profile</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
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
						<td class="table-label label-large bg-grey-primary">Class:</td>
						<td><?php echo $equipment_class_value; ?></td>
					</tr>
					<tr>
						<td class="table-label label-large bg-grey-primary">Description:</td>
						<td><?php echo $equipment_description_value; ?></td>
						<td class="table-label label-large bg-grey-primary">Code:</td>
						<td><?php echo $equipment_code_value; ?></td>
					</tr>
					<tr>
			            <td class="table-label label-large bg-grey-primary">Tag Number:</td>
			            <td><?php echo $equipment_tag_number; ?></td>
			            <td class="table-label label-medium bg-grey-primary">Unique ID:</td>
			            <td><?php echo $equipment_unique_id; ?></td>
			          </tr>
			          <tr>
			            <td class="table-label label-large bg-grey-primary">Manufacturer:</td>
			            <td><?php echo $equipment_manufacturer; ?></td>
			            <td class="table-label label-medium bg-grey-primary">Model:</td>
			            <td><?php echo $equipment_model; ?></td>
			          </tr>
			          <tr>
			            <td class="table-label label-large bg-grey-primary">Power Output:</td>
			            <td><?php echo $equipment_power_output; ?></td>
			            <td class="table-label label-medium bg-grey-primary">Failed Component:</td>
			            <td><?php echo $equipment_failed_component; ?></td>
			          </tr>
				</tbody>
			</table>
		</div>			




		<div class="row print-break">
			<div class="col-xs-12">
				<div class="page-header">
				<div class="row">
					<div class="col-xs-8">
						<h4 class="content-title">Step 2 - Opportunity</h4>
					</div>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print">Page 2 of 5</p> -->
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
							<td class="table-label label-large bg-grey-primary">Improvement Summary:</td>
							<td><?php echo $possible_solution_summary; ?></td>
						</tr>
					</tbody>
				</table>
			</div>


		<h4 class="content-title">Benefits Breakdown</h4>
			<div class="row-table table-responsive">
				<table class="table table-bordered view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium bg-grey-primary">Item</td>
							<td class="table-label label-large bg-grey-primary">Description</td>
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

		<h4 class="content-title">Cost Breakdown</h4>
		
		<div class="row-table table-responsive">
				<table class="table table-bordered view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium bg-grey-primary">Item</td>
							<td class="table-label label-large bg-grey-primary">Description</td>
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

		<h4 class="content-title">Enablers</h4>


			<!-- <div class="row-table table-responsive">
				<table class="table table-bordered view-casefile">
					<tbody>
			
						<tr>
							<td class="table-label bg-grey-primary" colspan="2">Prerequisites</td>
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



		<div class="row-table table-responsive">
				<table class="table table-bordered view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium bg-grey-primary">Specialist Requirement</td>
							<td class="table-label label-large bg-grey-primary">Description</td>
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
					<div class="col-xs-8">
						<h4 class="content-title">Step 3 - Risks and Threats</h4>
					</div>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print">Page 3 of 5</p> -->
						<?php echo $edit_step_3_link; ?>
					</div>
				</div>
			</div>
			</div>
		</div>



        <!-- <div class="row-table table-responsive">
        			<table class="table table-bordered view-casefile">
        				<tbody>
        					<tr>
        						<td class="table-label bg-grey-primary" colspan="2">Risks and Threats</td>
        					</tr>
        					<tr>
        						<td><?php echo $risks; ?></td>
        					</tr>
        				</tbody>
        			</table>
        		</div> -->


		<h4 class="content-title">Risks and Threats</h4>
			          
			<div class="row-table table-responsive">
				<table class="table table-bordered view-casefile">
					<tbody>
						<tr>
							<td class="table-label label-medium bg-grey-primary">Constraints</td>
							<td class="table-label label-medium bg-grey-primary">Mitigating Action</td>
							<td class="table-label label-medium bg-grey-primary">Owner</td>
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
					<div class="col-xs-8">
						<h4 class="content-title">Step 4 - Next Steps</h4>
					</div>
					<div class="col-xs-4 text-right">
						<!-- <p class="btn btn-print">Page 4 of 5</p> -->
						<?php echo $edit_step_4_link; ?>
					</div>
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


		<!-- <h4 class="content-title">Next Steps</h4>
			
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

			<h4 class="content-title ">File Gallery</h4>


		<?php
			$attributes = array('class' => 'email', 'id' => 'myform');
			echo form_open('ofi/remove-file', $attributes);
		?>
	
		<?php

			$gallery_title = "Additional Files";
			$gallery_result = $gallery_files;

			$gallery_data = array(
					'gallery_title' => $gallery_title,
					'gallery_result' => $gallery_result
				);

			$this->load->view('includes/file-gallery-snippet', $gallery_data); 

		?>


		<?php echo form_close(); ?>

	</div>
</div>