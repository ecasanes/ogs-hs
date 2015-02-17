<div class="modal fade" id="confirm-delete-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="completion-check-modal" class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">You are about to delete a form</h4>
			</div>
			<div class="modal-body">
				<p>Do you still want to continue?</p> 
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary go-no" data-dismiss="modal"> No</button>
				<button type="button" class="btn btn-danger go-yes"> Yes</button>
			</div>
		</div>
	</div>
</div>

<?php 
$attributes=array( 'role'=>'form', 'id' => 'my-account-form' ); 
echo form_open_multipart('user/save', $attributes);
echo form_hidden('form_id', $user_id);
?>

<section id="main-content">
	<div class="container">

		<div class="row">
			<div class="col-xs-12">
				<div id="casefile-view-header" class="page-header">
					<div class="row">
						<div class="col-sm-3">
							<h1>Equipment Repairs</h1>
						</div>
						<div class="col-sm-9 text-right">
							<a href="<?php echo base_url('page/tech-help'); ?>" class="btn btn-success btn-larger" data-toggle="tooltip" data-placement="left" title="Tech Help"><span class="glyphicon glyphicon-question-sign"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<p><a class="btn btn-primary pull-right" href="<?php echo base_url('erp/create'); ?>"><span class="glyphicon glyphicon-plus"></span> Create New ERP</a></p>
			<br>
		</div>


		<div class="row">
			<div class="col-sm-12">
				<div id="my-account-panel" class="panel panel-primary">
					
					<?php echo form_close(); ?>
					
					<?php if(empty($erp_results)): ?>
					<p>There are no Equipment Repairs created. <a href="<?php echo base_url('erp/create'); ?>">Create One</a></p>
				<?php else: ?>
				<div class="row-table table-responsive">
					<table class="table table-bordered my-account" id="erp-json">
						<thead>
							<th class="id" data-dynatable-column="document_id">ID</th>
							<th class="code" data-dynatable-column="document_code">Code</th>
							<th class="case-file" data-dynatable-column="document_name">Case File Name</th>
							<th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
							<th class="document-status" data-dynatable-column="document_status_value"><span class="glyphicon glyphicon-flag"></span> Status</th>
							<th class="likes" data-dynatable-column="no_of_likes"><span class="glyphicon glyphicon-thumbs-up"></span> likes </th>
							<th class="action duplicate" data-dynatable-column="action"><span class="glyphicon glyphicon-cog"></span> Actions</th>

						</thead>
						<tbody>
							<!-- Javascript is working here with ajax data table generated -->
						</tbody>
					</table>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
</div>



</div>

<!-- modal-->
<div class="modal fade bs-example-modal-sm" id="loading-animation" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm spin-modal">
		<div class="modal-content text-center">
			<br />
			<span class="icon-spin-size-25px">Duplicating </span> <br />

			<i class="fa fa-cog fa-spin icon-spin-size-40px"></i>
			<i class="fa fa-cog fa-spin icon-spin-size-20px icon-spin-reverse"></i>

			<br />
			<br />
		</div>
	</div>
</div>
</section>