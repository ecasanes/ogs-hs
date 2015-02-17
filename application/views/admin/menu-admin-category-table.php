<?php

//var_dump($results);

	foreach($results as $result){

		$menu_id = $result->menu_id;
		$name = $result->name;
		$value = $result->value;
		$description = $result->description;
		$sec_desc = $result->secondary_description;
		$color_class = $result->color_class;
		$code = $result->code;
		$order = $result->order;
		$menu_type = $result->menu_type;
		$menu_category_id = $result->menu_category_id;
		$level = $result->level;
?>
<tr id="data-row-<?php echo $menu_id; ?>">
	<td><?php echo $menu_id; ?></td>
	<td><?php echo $name; ?></td>
	<td><?php echo $value; ?></td>
	<td><?php echo $description; ?></td>
	<!-- <td><?php echo $sec_desc; ?></td>
	<td><?php echo $color_class; ?></td>
	<td><?php echo $code; ?></td>
	<td><?php echo $order; ?></td>
	<td><?php echo $level; ?></td> -->
	<td><?php echo $menu_type; ?></td>
	<td>
		<button data-id="<?php echo $menu_id; ?>" class="btn btn-sm btn-primary edit-menu-catgeory-admin"><span class="glyphicon glyphicon-edit"></span></button>
		<!-- <button class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span></button> -->
	</td>
</tr>
<?php } ?>