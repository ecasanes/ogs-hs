<?php echo form_open('', array('class' => 'ce-redundancy-form')); ?>
<input type="hidden" name="code" value="<?php echo $code; ?>" >
<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
	<ul id="myTab" class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active">
			<a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Very Similar</a>
		</li>

		<li role="presentation">
			<a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">All Equipment</a>
		</li>
	</ul>
	<div id="myTabContent" style="height: 300px; overflow-y: auto;" class="tab-content">
		<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledBy="home-tab">
			<table class="table table-condensed table-bordered" id="equipment-redundancy" >
				<thead>
					<tr>
						<th>Asset</th>
						<th>Tag No</th>
						<th>Description</th>
						<th>Code</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					<?php foreach($equipments as $equip): 
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

				</tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledBy="profile-tab">
			<table class="table table-condensed table-bordered" id="equipment-all">
				<thead>
					<tr>
						<th>Asset</th>
						<th>Tag No</th>
						<th>Description</th>
						<th>Code</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					<?php foreach($excluded_equipments as $equip): 
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
								<input data-full='<?php print( json_encode($equip) ) ?>' name="add_equipment[<?php echo $ce_id; ?>]" value="<?php echo $ce_id; ?>" type="checkbox" <?php echo $checked_ce_display; ?>>
							</td>
						</tr>
					<?php endforeach; ?>

				</tbody>
			</table>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
