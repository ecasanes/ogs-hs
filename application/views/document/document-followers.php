
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Document ID</th>
            <th>Document Name</th>
            <th>Full Name</th>
            <th>Email Address</th>

        </tr>
    </thead>
    <tbody>
    <?php 
    if(empty($document_followers)): ?>
      <tr>
        <td colspan="3">No Followers</td>
      </tr>
        <?php
      else:
    foreach($document_followers as $follower): 
       	
        $document_id = $follower->document_id;
        $user_id = $follower->user_id;
       	$fullname = $follower->first_name . ' ' . $follower->last_name;
        $email_address = $follower->email_address;
        $document_name = $follower->document_name;

 	?>
        <tr>
            <td><?php echo $document_id; ?></td>
            <td><?php echo $document_name; ?></td>
            <td><?php echo $fullname; ?></td>
            <td><?php echo $email_address; ?></td>
        </tr>

	<?php endforeach; ?>
<?php endif; ?>
	</tbody>
</table>