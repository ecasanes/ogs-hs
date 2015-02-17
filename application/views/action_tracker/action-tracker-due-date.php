
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="50%">Action Tracker</th>
            <th width="30%">Owner</th>
            <th width="20%">Due Date</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    foreach($action_trackers as $action_tracker): 
       	
       	$action = $action_tracker->action_process_step;
       	$owner = $action_tracker->first_name . ' ' . $action_tracker->last_name;
       	$due_date = convert_date_to_string($action_tracker->due_date);

 	?>
        <tr>
            <td><?php echo $action; ?></td>
            <td><?php echo $owner; ?></td>
            <td><?php echo $due_date; ?></td>
        </tr>

	<?php endforeach; ?>
	</tbody>
</table>