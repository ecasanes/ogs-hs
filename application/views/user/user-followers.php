
<table class="table table-bordered">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email Address</th>

        </tr>
    </thead>
    <tbody>
    <?php 
    if(empty($users)): ?>
      <tr>
        <td colspan="3">No Followers</td>
      </tr>
        <?php
      else:
    foreach($users as $user): 
       	
        $user_id = $user->user_id;
       	$fullname = $user->first_name . ' ' . $user->last_name;
        $email_address = $user->email_address;

 	?>
        <tr>
            <td><?php echo $user_id; ?></td>
            <td><?php echo $fullname; ?></td>
            <td><?php echo $email_address; ?></td>
        </tr>

	<?php endforeach; ?>
<?php endif; ?>
	</tbody>
</table>