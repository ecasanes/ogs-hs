<!-- Create Modal -->
<div class="modal fade" id="create-menu-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="add-menu-admin-category">
      
    </div>
  </div>
</div>
<!-- End of Create Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="edit-menu-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="edit-menu-admin-category">
      
    </div>
  </div>
</div>
<!-- End of Edit Modal -->

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Menu Category Admin</h3>
	</div>
	<div class="panel-body">
	<?php //var_dump($results); ?>

	<!-- Loading Icon -->
	<div class="loading-menu-table">
		<i class="fa fa-5x fa-cog fa-spin"></i> Loading Menu Category...
	</div>

	<button style="margin-bottom: 15px;" class="btn btn-info create-category"><span class="glyphicon glyphicon-plus"></span> Create Menu Category</button>
		<table class="table table-bordered table-condensed table-hover">
			<thead>
				<tr>
					<th class="id" width="5%">ID</th>
		            <th class="case-file" width="20%">Name</th>
		            <th class="code" width="5%">Value</th>
		            <th class="code" width="30%">Description</th>
		            <!-- <th class="code">Secondary Description</th>
		            <th class="code">Color Class</th>
		            <th class="id">Code</th>
		            <th class="id">Order</th>
		            <th class="id">Level</th> -->
		            <th class="case-file" width="30%">Menu Category</th>
		            <th class="code" width="10%">Action</th>
				</tr>
			</thead>
			<tbody id="menu-admin-category">
				
			</tbody>
		</table>
	</div>
</div>
