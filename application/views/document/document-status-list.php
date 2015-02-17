<table id="document-status-history" class="table table-bordered my-account">
	<thead>
		<tr>
			<th>User</th>
			<th>Status</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($document_status as $status): ?>
			<tr>
				<td><?php echo $status['fullname']; ?></td>
				<td><?php echo $status['status']; ?></td>
				<td><?php echo $status['date']; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="row">
    <div class="col-xs-12">
        <a id="more-comments" href="#" class="btn btn-primary btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
    </div>
</div>