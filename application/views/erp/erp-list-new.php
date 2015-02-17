<div class="panel panel-default">
	<div class="panel-heading">
		Equipment Repairs
		<div class="panel-options">
			<a href="<?php echo base_url('erp/create'); ?>" data-toggle="tooltip" data-original-title="Create New ERP">
				<i class="fa fa-lg fa-plus-square-o"></i>
			</a>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12">
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