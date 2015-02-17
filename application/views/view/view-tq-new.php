<?php

	$id = $this->uri->segment(3);
	$edit_form = base_url('technical-query/edit/'.$id);
	$cover_title = "Technical Query";
	$edit_text = '<span class="glyphicon glyphicon-pencil"></span>';
	$edit_button_type = 'button';
	$edit_title = array('title' => 'Edit Technical Query');
	$edit_url = $edit_form.'/1';
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

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Technical Query</h4>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 text-right">
              <?php echo $edit_tb_link; ?>
            </div>
		</div>
		<br>
		<div class="row-table table-responsive">
			<table class="table table-bordered view-casefile">
				<tbody>
					<tr>
						<td colspan="1" class="table-label label-medium border-none bg-grey-primary"><span class="title">Technical Query</span></td>
						<td colspan="4" class="table-label"><span class="title"><?php echo $doc_title; ?></span></td>
					</tr>
					<tr>	
						<td class="table-label label-large bg-grey-primary">TQ Number:</td>
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

			<h4 class="content-title ">Question</h4>
			<div class="text-justify">
				<?php echo $question; ?>
			</div>
			




		</div>
	</div>

			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-xs-4">
							<div  class="pull-left tb-lower-left-image">

								<?php echo image_exist($image_1_properties, 'hidden'); ?>

								<div class="text-justify caption-text">
									<?php echo $image_1_caption; ?>
								</div>
							</div>
						</div>
						<div class="col-xs-4">
							<div class="tb-lower-center-image">
							
							<?php echo image_exist($image_2_properties, 'hidden'); ?>

							<div class="text-justify caption-text">
								<?php echo $image_2_caption; ?>
							</div>
						</div>
						</div>
						<div class="col-xs-4">
							<div class="pull-right tb-lower-right-image">
						
								<?php echo image_exist($image_3_properties, 'hidden'); ?>

								<div class="text-justify caption-text">
									<?php echo $image_3_caption; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

	</div>
</div>