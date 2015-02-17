
<?php 

	foreach($results as $result){

	$menu_category_id = $result->menu_category_id;
	$menu_type = $result->menu_type;
	$description = $result->description;


 ?>


<tr id="data-row-<?php echo $menu_category_id; ?>">
	<td><?php echo $menu_category_id; ?></td>
	<td><?php echo $menu_type; ?></td>
	<td><?php echo $description; ?></td>
	<td>
		<a class="btn btn-primary btn-sm edit-menu-category" data-id="<?php echo $menu_category_id; ?>" title="Edit Menu Category"><span class="glyphicon glyphicon-pencil"></span></a>
		<a class="btn btn-danger btn-sm delete-form" title="Delete Menu Category" href="<?php echo base_url('menu-admin/delete/'.$menu_category_id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
	</td>
</tr>

<?php } ?>