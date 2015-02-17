<?php

	$id = $this->uri->segment(3);
	$cover_title = "Menu Admin";

	//var_dump($results);

?>
<!-- Modal -->

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

<!-- End of Modal -->

<!-- Create Menu -->
<div class="modal fade" id="create-menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div id="menu-admin-create" class="modal-content">
      
    </div>
  </div>
</div>
<!-- End of Create -->

<!-- Edit Menu -->
<div class="modal fade" id="edit-menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div id="menu-admin-edit" class="modal-content">
      
    </div>
  </div>
</div>
<!-- End of Edit -->

<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Menu Admin</h3>
	</div>
	<div class="panel-body">
		<button class="btn btn-primary" id="add-menu-category" style="margin-bottom: 15px;"><span class="glyphicon glyphicon-plus"></span> Add Menu Category</button>
		<table class="table table-bordered table-condensed">
			<thead>
				<tr>
					<th>ID</th>
					<th>Menu Type</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="menu-admin">

			</tbody>
		</table>

	</div>


</div>