<?php foreach($result as $equip): 

	$ce_id = $equip->critical_equipment_id;
	if(!empty($checked_ce)){
		if(in_array($ce_id, $checked_ce)){
			$checked_ce_display = "checked";
		}else{
			$checked_ce_display = "";
		}
	}else{
		$checked_ce_display = "";
	}

?>
	<tr>
		<td></td>
		<td><?php echo $equip->tag_number; ?></td>
		<td><?php echo $equip->subsystem_component; ?></td>
		<td><?php echo $equip->code; ?></td>
		<td class="text-center">
			<input  data-full='<?php print( json_encode($equip) ) ?>' name="add_equipment[<?php echo $ce_id; ?>]" value="<?php echo $ce_id; ?>" type="checkbox" <?php echo $checked_ce_display; ?>>
		</td>
	</tr>
<?php endforeach; ?>
