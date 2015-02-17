<?php

	$id = $this->uri->segment(3);
	$edit_form = base_url('witness-statement/edit/'.$id);
	$cover_title = "Witness Statement";
	$edit_text = '<span class="glyphicon glyphicon-pencil"></span>';
	$edit_button_type = 'button';
	$edit_title = array('title' => 'Edit Witness Statement');
	$edit_url = $edit_form.'/1';

	$edit_ws_link = display_link($edit_url, $edit_text, $edit_button_type, $editable, $edit_title);

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Witness Statement</h4>
	</div>

	<div class="panel-body">
		<div class="row-table table-responsive">
		<h4 class="content-title hidden-print">Interview</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Installation/Location:</td>
						<td><?php echo $installation; ?></td>
						<td class="table-label label-small bg-grey-primary">Time</td>
						<td><?php echo $time; ?></td>
						<td class="table-label label-small bg-grey-primary">Date:</td>
						<td><?php echo $user_date; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Conducted By:</td>
						<td><?php echo $conducted_by; ?></td>
						<td class="table-label label-medium bg-grey-primary">Conducted Email:</td>
						<td colspan="3"><?php echo $conducted_email; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Recoreded By:</td>
						<td><?php echo $recorded_by; ?></td>
						<td class="table-label label-medium bg-grey-primary">Recoreded Email:</td>
						<td colspan="3"><?php echo $recorded_email; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>

		<div class="row-table table-responsive">
		<h4 class="content-title hidden-print">Witness Details</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Witness Name:</td>
						<td colspan="2"><?php echo $witness_name; ?></td>
						<td class="table-label label-medium bg-grey-primary">Witness Email</td>
						<td><?php echo $witness_email; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Accompanied By:</td>
						<td colspan="2"><?php echo $accompanied_by; ?></td>
						<td class="table-label label-medium bg-grey-primary">Accompanied Email:</td>
						<td colspan="2"><?php echo $accompanied_email; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Witness Position:</td>
						<td colspan="2"><?php echo $witness_position; ?></td>
						<td class="table-label label-medium bg-grey-primary">Employer:</td>
						<td colspan="2"><?php echo $employer; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Witness Nickname:</td>
						<td colspan="4"><?php echo $witness_nickname; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>

		<div class="row-table table-responsive">
		<h4 class="content-title hidden-print">Witness Address</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Street 1:</td>
						<td colspan="4"><?php echo $witness_street_1; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Street 2:</td>
						<td colspan="4"><?php echo $witness_street_2; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">City:</td>
						<td colspan="4"><?php echo $witness_city; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Country:</td>
						<td colspan="4"><?php echo $witness_country; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Postal/Zip Code:</td>
						<td colspan="4"><?php echo $witness_postal_code; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>

		<div class="row-table table-responsive">
		<h4 class="content-title hidden-print">Incident</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Title:</td>
						<td colspan="2"><?php echo $incident_title; ?></td>
						<td class="table-label label-medium bg-grey-primary">Number</td>
						<td colspan="2"><?php echo $incident_number; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Description:</td>
						<td colspan="4"><?php echo $incident_description; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>

		<div class="row-table table-responsive">
		<h4 class="content-title hidden-print">Statement</h4>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td colspan="5"><?php echo $statement; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium bg-grey-primary">Signature:</td>
						<td colspan="4"><?php echo $signature; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>