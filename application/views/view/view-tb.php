<?php

	$id = $this->uri->segment(3);
	$edit_form = base_url('technical-bulletin/edit/'.$id);
	$cover_title = "Technical Bulletin";
	$edit_text = '<span class="glyphicon glyphicon-pencil"></span>';
	$edit_button_type = 'button';
	$edit_title = array('title' => 'Edit Technical Bulletin');
	$edit_url = $edit_form.'/0';
	$width = '220px';
	$lower_images_width = '280px';
	$height = '280px';

	$edit_tb_link = display_link($edit_url, $edit_text, $edit_button_type, $editable, $edit_title);

	$image_1_properties = array(
			'src' => $image_1_filename,
			'width' => $width
		);

	$image_2_properties = array(
			'src' => $image_2_filename,
			'width' => $width
		);

	$image_3_properties = array(
			'src' => $image_3_filename,
			'width' => $width
		);

	$image_4_properties = array(
			'src' => $image_4_filename,
			'width' => $lower_images_width,
			'min-height' => $height
		);

	$image_5_properties = array(
			'src' => $image_5_filename,
			'width' => $lower_images_width,
			'height' => $height
		);

	$image_6_properties = array(
			'src' => $image_6_filename,
			'width' => $lower_images_width,
			'min-height' => $height
		);

?>

<section id="main-content" class="content-print">
	<div class="container">

		<div class="row hidden-print">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-4">
							<h1 class="content-title">Technical Bulletin</h1>
						</div>
						<div class="col-xs-8 text-right">
							<p class="btn btn-print">Page 1 of 1</p>
							<?php echo $edit_tb_link; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- <h2 class="content-title">Equipment Profile</h2> -->
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td colspan="1" class="table-label label-medium border-none bg-grey-primary"><span class="title">Technical Bulletin</span></td>
						<td colspan="4" class="table-label"><span class="title"><?php echo $doc_title; ?></span></td>
					</tr>
					<tr>	
						<td class="table-label label-large bg-grey-primary">TB Number:</td>
						<td colspan="3"><?php echo $code; ?></td>
					</tr>
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
					<tr>
						<td class="table-label label-large bg-grey-primary">Author:</td>
						<td><?php echo $author; ?></td>
						<td class="table-label label-medium bg-grey-primary">Date:</td>
						<td><?php echo $doc_date; ?></td>
					</tr>

					
				</tbody>
			</table>
		</div>

		
		
	<div class="row">
		<div class="col-xs-12">

			<h4 class="content-title "><?php echo text_exist('Purpose', $purpose); ?></h4>
			<div class="text-justify">
				<?php echo $purpose; ?>
			</div>
			

			<div class="pull-right tb-image">			

				<?php echo image_exist($image_1_properties, 'hidden'); ?>

				<div class="text-justify caption-text">
					<?php echo $image_1_caption; ?>
				</div>

				<br />

				<?php echo image_exist($image_2_properties, 'hidden'); ?>

				<div class="text-justify caption-text">
					<?php echo $image_2_caption; ?>
				</div>

				<br />

				<?php echo image_exist($image_3_properties, 'hidden'); ?>

				<div class="text-justify caption-text">
					<?php echo $image_3_caption; ?>
				</div>
				
			</div>

		<h4 class="content-title "><?php echo text_exist('Relevance', $relevance); ?></h4>
		<div class="text-justify">
			<?php echo $relevance; ?>
		</div>
		<h4 class="content-title "><?php echo text_exist('Summary of Events and Findings', $summary); ?></h4>
		<div class="text-justify">
			<?php echo $summary; ?>
		</div>
		<h4 class="content-title "><?php echo text_exist('Recommendations', $recommendation); ?></h4>
		<div class="text-justify">
			<?php echo $recommendation; ?>
		</div>
		<h4 class="content-title "><?php echo text_exist('Next Steps', $next_step); ?></h4>
		<div class="text-justify">
			<?php echo $next_step; ?>
		</div>


		</div>
	</div>

			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-xs-4">
							<div  class="pull-left tb-lower-left-image">

								<?php echo image_exist($image_4_properties, 'hidden'); ?>

								<div class="text-justify caption-text">
									<?php echo $image_4_caption; ?>
								</div>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="tb-lower-center-image">
							
							<?php echo image_exist($image_5_properties, 'hidden'); ?>

							<div class="text-justify caption-text">
								<?php echo $image_5_caption; ?>
							</div>
						</div>
						</div>
						<div class="col-xs-4">
							<div class="pull-right tb-lower-right-image">
						
								<?php echo image_exist($image_6_properties, 'hidden'); ?>

								<div class="text-justify caption-text">
									<?php echo $image_6_caption; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				

	</div>

</section>