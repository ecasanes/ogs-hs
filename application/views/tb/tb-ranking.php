<?php

	$id = $this->uri->segment(3);
	$edit_form = base_url('technical-bulletin/edit/'.$id);
	$cover_title = "Technical Bulletin";

?>

<section id="main-content">
	<div class="container">

		<div class="row hidden-print">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-3">
							<h1 class="content-title">Technical Bulletin</h1>
						</div>
						<div class="col-xs-9 text-right">
							<p class="btn btn-print">Page 1 of 1</p>
							<a href="<?php echo $edit_form.'/0'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Technical Bulletin"><span class="glyphicon glyphicon-pencil"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="row">
			<div class="col-xs-12">
				<div class="page-header">
					<div class="row">
						<div class="col-xs-3">
							<h1 class="content-title visible-print">Technical Bulletin</h1>
						</div>
						<div class="col-xs-9 text-right">
							<p class="btn btn-print">Page 1 of 1</p>
							<a href="<?php echo $edit_form.'/0'; ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit Technical Bulletin"><span class="glyphicon glyphicon-pencil"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row-table table-responsive">
			<table class="table view-casefile">
				<tbody>
					<tr>
						<td class="table-label label-medium" colspan="4">Equipment Profile</td>
					</tr>
					<tr>
						<td class="table-label label-medium" colspan="2">1</td>
						<td class="table-label label-medium" colspan="2"></td>
					</tr>
					<tr>
						<td class="table-label label-medium" colspan="2">2</td>
						<td class="table-label label-medium" colspan="2"></td>
					</tr>
					<tr>
						<td class="table-label label-medium" colspan="2">3</td>
						<td class="table-label label-medium" colspan="2"></td>
					</tr>
					<tr>
						<td class="table-label label-medium" colspan="2">4</td>
						<td class="table-label label-medium" colspan="2"></td>
					</tr>
				
				</tbody>
			</table>
		</div>
		
		<!-- <form class="form-comment">
			<textarea class="form-control" rows="3"></textarea>
				</br>
				 <span class="button-checkbox">
			        <button type="button" class="btn" data-color="primary">Like</button>
			        <input type="checkbox" class="hidden" checked />
			    </span>
				<label class="btn btn-primary pull-right">Comment</label>		
		</form> -->
		<!-- <div class="container"> -->
		 <div id="tb-ranking" class="feedback">
			<a id="feedback_button">Rate This Techinical Bulletin <span id ="chevron" class="glyphicon glyphicon-chevron-up"></a>
			
			<div class="form">
			<textarea class="form-control" rows="3"></textarea>
				 <span class="button-checkbox">
			        <button id="like-button" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-thumbs-up"></span>Like</button>
			        <input	type="hidden" name="like" value="0"/>
			    </span>
				<label class="btn btn-primary pull-right">Comment</label>
			</div>
		</div>
		</div>
	<!-- </div> -->

	
		

</section>


