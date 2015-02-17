<?php

	$id = $this->uri->segment(3);
	$edit_form = base_url('witness-statement/edit/'.$id);
	$cover_title = "Witness Statement";
	$edit_text = '<span class="glyphicon glyphicon-pencil"></span>';
	$edit_button_type = 'button';
	$edit_title = array('title' => 'Edit Witness Statement');
	$edit_url = $edit_form.'/0';

	$edit_ws_link = display_link($edit_url, $edit_text, $edit_button_type, $editable, $edit_title);

?>

<section id="main-content">
	<div class="container">

		<div class="row hidden-print">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-4">
							<h1 class="content-title">Witness Statement</h1>
						</div>
						<div class="col-xs-8 text-right">
							<p class="btn btn-print">Page 1 of 1</p>
							<?php echo $edit_ws_link; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- <h2 class="content-title">Equipment Profile</h2> -->
		<div class="row-table table-responsive">
		<h2 class="content-title hidden-print">Interview</h2>
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium">Installation/Location:</td>
						<td><?php echo $installation; ?></td>
						<td class="table-label label-medium">Time</td>
						<td><?php echo $time; ?></td>
						<td class="table-label label-medium">Date:</td>
						<td><?php echo $user_date; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Conducted By:</td>
						<td colspan="2"><?php echo $conducted_by; ?></td>
						<td class="table-label label-medium">Conducted Email:</td>
						<td colspan="2"><?php echo $conducted_email; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Recoreded By:</td>
						<td colspan="2"><?php echo $recorded_by; ?></td>
						<td class="table-label label-medium">Recoreded Email:</td>
						<td colspan="2"><?php echo $recorded_email; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>

		<div class="row-table table-responsive">
		<h2 class="content-title hidden-print">Witness Details</h2>
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium">Witness Name:</td>
						<td colspan="2"><?php echo $witness_name; ?></td>
						<td class="table-label label-medium">Witness Email</td>
						<td><?php echo $witness_email; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Accompanied By:</td>
						<td colspan="2"><?php echo $accompanied_by; ?></td>
						<td class="table-label label-medium">Accompanied Email:</td>
						<td colspan="2"><?php echo $accompanied_email; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Witness Position:</td>
						<td colspan="2"><?php echo $witness_position; ?></td>
						<td class="table-label label-medium">Employer:</td>
						<td colspan="2"><?php echo $employer; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Witness Nickname:</td>
						<td colspan="4"><?php echo $witness_nickname; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>

		<div class="row-table table-responsive">
		<h2 class="content-title hidden-print">Witness Address</h2>
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium">Street 1:</td>
						<td colspan="4"><?php echo $witness_street_1; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Street 2:</td>
						<td colspan="4"><?php echo $witness_street_2; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">City:</td>
						<td colspan="4"><?php echo $witness_city; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Country:</td>
						<td colspan="4"><?php echo $witness_country; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Postal/Zip Code:</td>
						<td colspan="4"><?php echo $witness_postal_code; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>

		<div class="row-table table-responsive">
		<h2 class="content-title hidden-print">Incident</h2>
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium">Title:</td>
						<td colspan="2"><?php echo $incident_title; ?></td>
						<td class="table-label label-medium">Number</td>
						<td colspan="2"><?php echo $incident_number; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Description:</td>
						<td colspan="4"><?php echo $incident_description; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>

		<div class="row-table table-responsive">
		<h2 class="content-title hidden-print">Statement</h2>
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td colspan="5"><?php echo $statement; ?></td>
					</tr>
					<tr>
						<td class="table-label label-medium">Signature:</td>
						<td colspan="4"><?php echo $signature; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>

		
	
</section>