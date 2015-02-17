<!-- START - CRITICAL EQUIPMENT MODAL -->
<div class="modal fade" id="tag_num" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Critical Equipment</h4>
			</div>
			<div class="modal-body">
				<!-- <form class="form-inline">
					<div class="form-group input-group-sm">
						<label for="exampleInputEmail2">Filter: </label>
						<input type="email" class="form-control input-group-sm" id="exampleInputEmail2" placeholder="">
					</div>
					<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span> </button>
				</form> -->
				<div style="margin-top: 10px; max-height: 300px; overflow-y: auto;">
				<div id="criticality-table-content">
					
				</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END - CRITICAL EQUIPMENT MODAL -->

<!-- START - CE-MODAL REDUNDANCY LIST - 2ND POPUP -->
<div class="modal fade" id="ce-modal-redundancy-list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Critical Equipment</h4>
			</div>
			<div class="modal-body" style="background: #eee;">
				<div id="redundancy-list-body">
					<?php echo form_open('', array('class'=>'ce-redundancy-second-modal')); ?>
						<!-- Tab Panel -->
						<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home2" id="home-tab" role="tab" data-toggle="tab" aria-controls="home2" aria-expanded="true">Redundancy</a></li>
								<li role="presentation">
									<a id="all-equipment-redundancy-list" href="#profile2" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile2">All Equipment</a></li>
							</ul>
							<div id="myTabContent" style="height: 300px; overflow-y: auto;" class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="home2" aria-labelledBy="home-tab">
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
										<tbody id="redundant-items2"></tbody>
									</table>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="profile2" aria-labelledBy="profile-tab">
									<div id="second-loading" class="row">
										<div class="col-xs-4 text-right">
											<i class="fa fa-cog fa-spin fa-3x"></i>
										</div>
										<div class="col-xs-8">
											<h4>Loading Critical Equipments...</h4>
										</div>
									</div>
									<table id="code-items-table" class="table table-condensed table-bordered"x>
										<thead>
											<tr>
												<th>Asset</th>
												<th>Tag No</th>
												<th>Description</th>
												<th>Code</th>
												<th></th>
											</tr>
										</thead>
										<tbody id="code-items"></tbody>
									</table>
								</div>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="submit-final-redundancy" type="button" class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
			</div>
		</div>
	</div>
</div>
<!-- END - CE-MODAL REDUNDANCY LIST - 2ND POPUP -->



<!-- START - AVAILABLE REDUNDANCY - 1ST POPUP -->
<div class="modal fade" id="available_redundancy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Critical Equipment</h4>
			</div>
			<div class="modal-body" style="background: #eee;">
				<div id="critical-loading" class="row">
					<div class="col-xs-4 text-right">
						<i class="fa fa-cog fa-spin fa-3x"></i>
					</div>
					<div class="col-xs-8">
						<h4>Loading Critical Equipments...</h4>
					</div>
				</div>
				<div class="ce-by-group">
					
				</div>
			
				<!-- <form class="form-inline">
					<div class="form-group input-group-sm">
						<label for="exampleInputEmail2">Filter: </label>
						<input type="email" class="form-control input-group-sm" id="exampleInputEmail2" placeholder="">
					</div>
					<button type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span> </button>
				</form> -->
			</div>
				
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="submit-available-redundancy" type="button" class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
			</div>
		</div>
	</div>
</div>
<!-- END - AVAILABLE REDUNDANCY - 1ST POPUP -->

<!-- START - LOADING - CALCULATE_SCORING -->
<div class="modal fade" id="calculate-score-loading" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-4 text-right">
						<i class="fa fa-cog fa-spin fa-3x"></i>
					</div>
					<div class="col-xs-8">
						<h4>Calculating Score...</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END - LOADING CALCULATE_SCORING -->


<?php if (isset($alert_status) && $alert_status == true): ?>
	<div class="alert <?php print($alert_class) ?>" alert-dismissible role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php print($alert_message) ?>
	</div>
<?php endif ?>

<div class="panel panel-info">
	<?php /*echo form_open('criticality_analysis/compute_cas');*/ ?>
	<?php echo form_open($form_submit_url, array('id'=>'calculate-score-form')); ?>
	<div class="panel-heading">
		<h3 class="panel-title">Criticality Analysis Scoring Template</h3>
	</div> <!-- end panel heading -->
	<div class="panel-body">
		
		<?php 

			//var_dump($cas);

			if($cas == '')
			{
				$cas = 'Not Available';
			} 

		?>

		<div class="sticky_column">
			<table class="table table-bordered table-condensed">
				<thead>
					<td class="bg-grey" width="10%">Asset</td>
					<td class="bg-grey" width="10%">Parent SCE</td>
					<td class="bg-grey" width="10%">Tag No.</td>
					<td class="bg-grey" width="20%">Sub System / Equipment Description</td>
					<td class="bg-grey" width="20%">Primary Role</td>
					<td class="bg-grey" width="10%">Code</td>
					<td class="bg-grey" width="10%">CAS</td>
				</thead>
				<tbody>
					<tr>
						<input type="hidden" id="criticality_analysis_id" name="criticality_analysis_id" value="<?php echo $criticality_analysis_id; ?>" >
						<input type="hidden" id="critical_equipment_id" name="critical_equipment_id" value="<?php echo $ce_id; ?>">
						<input type="hidden" id="ce_group_id" name="ce_group_id" value="<?php echo $ce_group_id; ?>">
						<input type="hidden" id="redundant_ids" data-first-modal="" data-second-modal="" name="redundant_ids" value="<?php echo $redundant_ids; ?>">
						<td>
							<div class="input-group-sm">
								<input type="text" class="form-control" name="asset_code" id="asset_code" placeholder="" value="<?php echo $asset_code; ?>" required disabled>
								<input type="hidden" class="form-control" name="ref" value="">
							</div>			
						</td>
						<td>
							<div class="input-group-sm">
								<input type="text" class="form-control" name="parent_sce" id="parent_sce" placeholder="" value="<?php echo $parent_sce; ?>" disabled>
							</div>			
						</td>
						<td>
							<div class="input-group-sm">
								<?php
								
								if($action == 'edit'){
									$tag_input_id_string = '';
									$tag_input_disabled = 'disabled';
									
								}else if($action == 'create'){
									$tag_input_id_string = 'id="tag_input"';
									$tag_input_disabled = '';
								}
								?>
								<input type="text" class="form-control" name="customer" <?php echo $tag_input_id_string; ?> placeholder="" value="<?php echo $tag_no; ?>" size="0" maxlength="0" <?php echo $tag_input_disabled; ?>>
							</div>			
						</td>
						<td>
							<div class="input-group-sm">
								<input type="text" class="form-control" name="sub_system" id="sub_system" placeholder="" value="<?php echo $subsystem; ?>" disabled>
							</div>			
						</td>
						<td>
							<div class="input-group-sm">

								<select class="form-control" name="ca_role_id" required>
									<?php echo $role_dropdown; ?>
								</select>
							</div>			
						</td>
						<td>
							<div class="input-group-sm">
								<input type="text" class="form-control" name="code" id="code" placeholder="" value="<?php echo $code; ?>" disabled>
							</div>			
						</td>
						<td>
							<div class="input-group-sm">
								<input type="text" class="form-control" id="code" placeholder="" value="<?php echo $cas; ?>" disabled>
							</div>			
						</td>
					</tr>
				</tbody>
			</table>

			<div class="row">
				<div class="col-xs-10">
					<table class="table table-bordered table-condensed" style="height: 215px;">
						<tr>
							<td colspan="3">
								Please apply one  of the values below to one or all of the potential consequences.  The same value must not be repeated in any one group
							</td>
						</tr>
						<tr>
							<td width="5%" class="bg-yellow text-center">1</td>
							<td class="bg-grey">Very Unlikely</td>
							<td class="bg-grey">A freak combination of factors would be required for this  to occur</td>
						</tr>
						<tr>
							<td class="bg-yellow text-center">2</td>
							<td class="bg-grey">Unlikely</td>
							<td class="bg-grey">A rare combination of factors would be required for this to occur</td>
						</tr>
						<tr>
							<td class="bg-yellow text-center">3</td>
							<td class="bg-grey">Possible</td>
							<td class="bg-grey">This could happen is a number of additional factors were present but otherwise unlikely to occur</td>
						</tr>
						<tr> 
							<td class="bg-yellow text-center">4</td>
							<td class="bg-grey">Likely</td>
							<td class="bg-grey">Not certain, but could occur with only one normally occurring additional factor</td>
						</tr>
						<tr>
							<td class="bg-yellow text-center">5</td>
							<td class="bg-grey">Very Likely</td>
							<td class="bg-grey">Almost inevitable that this would occur under the circumstances</td>
						</tr>
					</table>
				</div>
				<div class="col-xs-2">
					<table class="table table-bordered table-condensed" >
						<tr>
							<td> </td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td class="bg-grey">SCE</td>
							<td>
								<div class="input-group-sm">
									<select class="form-control" name="sce">
										<?php echo yes_no_default($sce, true, "- Select -", true); ?>
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td class="bg-grey">ECE</td>
							<td>
								<div class="input-group-sm">
									<select class="form-control" name="ece">
										<?php echo yes_no_default($ece, true, "- Select -", true); ?>
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td class="bg-grey">PCE</td>
							<td>
								<div class="input-group-sm">
									<select class="form-control" name="pce">
										<?php echo yes_no_default($pce, true, "- Select -", true); ?>
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td class="bg-grey">EX</td>
							<td>
								<div class="input-group-sm">
									<select class="form-control" name="ex">
										<?php echo yes_no_default($ex, true, "- Select -", true); ?>
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<td class="bg-grey">SIS</td>
							<td>
								<div class="input-group-sm">
									<select class="form-control" name="sis">
										<?php echo yes_no_default($sis, true, "- Select -", true); ?>
										<option value="0">No</option>
										<option value="1">Yes</option>
									</select>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>


		<div class="page-header">
			<h4>Available Redundancy</h4>
		</div>

		<div class="row">
			<div class="col-xs-9">
				<p>
					Many items of equipment may share the same Criticality Analysis and subsequent scoring if 
					function / location are identical and this can be verified in CMMS.
					Currently available records indicate there are <strong class="text-danger" style="font-size: 16px;"> &nbsp;(<?php echo $redundancy_count; ?>)&nbsp; </strong> 
					very similar items of equipment employed on this asset.
					From the following list, please mark which items, if any, 
					can share this Criticality Analysis Score. 
				</p>
			</div>
			<div class="col-xs-3">
				<br>
				<br>
				<a href="#" class="btn btn-primary available-redundancy" style="margin-top: -20px;"> <i class="fa fa-list-alt"></i> Business Critical Equipment List </a>
			</div>
		</div>

		<div class="row" style="margin-top: 20px; margin-bottom: 20px;">
			<div class="col-xs-8">
				Information Suggests there are <strong class="text-danger" style="font-size: 16px;"> &nbsp;(<span class="selected-redundancy-ce"><?php echo $spof_value; ?></span>)&nbsp; </strong></span> Items of equipment that can be considered as redundancy for this item?
			</div>
			<div class="col-xs-3">
				<select id="info-suggest" style="margin-top:-10px; margin-left: 85px; width: 225px;" class="form-control" name="spof_answer" required>
					<?php echo yes_no_default($spof_answer, true, "- Select -", true); ?>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select>
				<input type="hidden" name="spof_value" class="form-control" value="<?php echo $spof_value; ?>">
			</div>
		</div>

		<?php
		if($spof_answer == 1 || $spof_answer == null){
			$spof_display = "hidden";
		}else{
			$spof_display = "";
		}
		?>

		<div id="list-redundancy-equipment" class="row <?php echo $spof_display; ?> list-equipment" style="margin-top: 20px;">
			<div class="col-xs-9">
				<p>
					From the following list, please mark which items, if any, should be considered 
					as redundancy for this item of equipment. 
				</p>
			</div>
			<div class="col-xs-3">
				<br>
				<br>
				<a id="redundancy-list-button" href="#" class="btn btn-primary" style="margin-top: -82px;"> <i class="fa fa-list-alt"></i> Redundancy List </a>
			</div>
		</div>

		<p><b>Multi Functional</b></p>
		<div class="row-content main_container">
			<div class="row">
				<div class="col-xs-10">
					<p class="bg-grey bg-padding"> Does this item of equipment serve more that one role? </p>
				</div>
				<div class="col-xs-2">
					<div class="form-group input-group-sm">
						<select id="multi-functional-role" name="multi_answer" class="form-control select_value answer">
							<?php echo yes_no_default($multi_answer, true, "- Select - ", true); ?>
							<option value="1">Yes</option>
							<option value="0">No</option>
						</select>
					</div>
				</div>
			</div>

			<?php 

			if($multi_answer == 1){
				$multi_display = "";
			}else{
				$multi_display = "hidden";
			}

			?>

			<div class="<?php echo $multi_display; ?> inside_container">
				<p>Please list roles below:</p>
				<button style="margin-bottom: 15px;" class="btn btn-info" type="button" data-toggle="modal" data-target="#role-list"><span class="glyphicon glyphicon-list-alt"></span> Role List</button>

				<!-- <table class="table table-condensed no-border" style="width: 350px;">
					<tr class="role-row">
						<td>
							<select class="form-control" name="" required>
								<?php echo $role_dropdown; ?>
							</select>
						</td>
						<td class="text-center" style="width: 20px;">
							<a id="add-role" class="btn btn-info" href="#" role="button"><span class="glyphicon glyphicon-plus"></span></a>
						</td>
					</tr>
				</table> -->

				<!-- <table id="role-list" class="table table-condensed table-bordered" style="width: 350px;">
				
					<tbody>
						<tr class="hidden">
							<td>Role Name</td>
							<td class="text-center" style="width: 20px;">
								
							</td>
						</tr>
						<tr id="role-sample" class="role-row hidden">
							<td>
								<select class="form-control" name="ca_multi_role[]" required disabled>
									<?php echo $role_dropdown; ?>
								</select>
							</td>
							<td class="text-center" style="width: 20px;">
								<a class="btn btn-danger remove" href="#" role="button"><span class="glyphicon glyphicon-minus"></span></a>
							</td>
						</tr>
						<?php echo $role_output; ?>
					</tbody>
					
				</table> -->
			</div>

		</div>


		<?php echo $questions; ?>

		
		

		<p><b>Conclusion </b></p>
		<div class="row">
			<div class="col-xs-10">
				<p> <b>Based in the information submitted above and subject to the current Status Value, the Criticality Analysis Score for this item of equipment is:</b> </p>
			</div>
			<div class="col-xs-2">
				<div class="form-group input-group-sm">
					<input type="text" class="form-control" name="cas_val" id="" style="font-size: 15px;" placeholder="" value="<?php echo $cas; ?>" disabled>
				</div>
			</div>
		</div>


		<!-- <div class="row">
			<div class="col-xs-10">
				<p> <b>Based on the Criticality Analysis Score of (add CAS SCORE HERE) select the appropriate inspection frequency</b> </p>
			</div>
			<div class="col-xs-2">
				<div class="form-group input-group-sm">
					<select name="inspection_periodicity_hrs" class="form-control select_value">
						<?php echo $inspection_periodicity_hrs; ?>
						<option value="6">6</option>
						<option value="12">12</option>
						<option value="24">24</option>
						<option value="48">48</option>
						<option value="72">72</option>
						<option value="96">96</option>
						<option value="120">120</option>
						<option value="144">144</option>
						<option value="168">168</option>
						<option value="over">Over</option>
					</select>
				</div>
			</div>
		</div> -->
		<input type="hidden" name="inspection_periodicity_hrs" value="">
		

		<p><b>Attention </b></p>
		<div class="row">
			<div class="col-xs-12">
				<p> <b>This Stage One Criticality Analysis Scoring Template is 
					designed to provide a Criticality Score only. It is not intended 
					to replace any reliability and availability study . Information 
					gathered here will, however, be used in conjunction with the 
					Reliability and Availability Matrix (RAM). Some information 
					displayed above may have been sourced from the RAM and / or 
					CMMS and reflects results based on  information that is currently 
					available. Estimates are a calculation based on best available 
					information.
				</b> </p>
			</div>
		</div>

		<p><b>Notes</b></p>
		<div class="form-group">
			<textarea name="notes" class="form-control" rows="3"><?php echo $notes; ?></textarea>
		</div>
	</div><!-- End of Panel Body -->
	<div class="panel-footer">


		<div class="form-group text-right">
			<label class="cas-message control-label text-danger hidden"></label>&nbsp;

			<button class="btn btn-success cas-submit" type="submit"><i class="fa fa-clipboard"></i>  Calculate &amp; Submit</button>
			<a class="btn btn-info submit-score" href="<?php echo base_url('criticality-analysis/stage'); ?>"><i class="fa fa-arrow-right"></i>  Back to List</a>

		</div>
	</div>

	<!-- START - ROLE LIST MODAL -->
	<div class="modal fade" id="role-list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Select List Roles below</h4>
				</div>
				<div class="modal-body">
					<!-- <form class="form-inline form-group-sm">
					  <div class="form-group">
					    <label>Filter</label>
					    <input style="width: 300px;" type="text" class="form-control input-sm">
					  </div>
					  <button style="margin-top: -78px;margin-left: 304px;" type="submit" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-search"></span></button>
					</form> -->

					<table class="table table-bordered table-condensed" style="margin-bottom: -12px;">
							<thead>
								<tr>
									<th style="width: 486px;">Role</th>
								</tr>
							</thead>
						</table>
					
					<div style="margin-top: 10px; max-height: 300px; overflow-y: auto;">
						<?php echo $roles_checkbox; ?>	
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
				</div>
			</div>
		</div>
	</div>
	<!-- END - ROLE LIST MODAL -->
	<?php echo form_close(); ?>
</div> <!-- end panel -->
