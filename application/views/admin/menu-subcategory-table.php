<?php 

	foreach($results as $result){

			$menu_subcategory_id = $result->menu_subcategory_id;
			$name = $result->name;
			$description = $result->description;
			$color_class = $result->color_class;
			$code = $result->code;
			$name = $result->name;
			$menu_id = $result->menu_id;
 ?>
<tr>
	<td><?php echo $menu_subcategory_id; ?></td>
	<td><?php echo $name; ?></td>
	<td><?php echo $description; ?></td>
	<td><?php echo $color_class; ?></td>
	<td><?php echo $code; ?></td>
	<td>
		<select class="form-control input-sm" name="menu_category_id">
   		<?php
   			foreach($menu_records as $menu_record){
   				$cat_id = $menu_record->menu_id;
   				$type = $menu_record->name;
   				?>
   			<option value="<?php echo $cat_id?>" 
   				<?php 
   					if($menu_id==$cat_id){
   						echo 'selected';
   					}
   				?>
   				><?php echo $type ?></option>
   			<?php }
   		?>
		</select>
	</td>
	<td>
		<button href="" data-id="<?php echo $menu_subcategory_id; ?>" class="btn btn-sm btn-primary edit-menu-subcategory"><span class="glyphicon glyphicon-edit"></span></button>
	</td>
</tr>

<?php } ?>