<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?></h4>

        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
        </div>
	</div>


	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>	
		<?php $this->load->view('includes/completion-status', $data); ?>
    	<?php //$this->load->view('includes/document-status-snippet', $data); ?>
	
		<div class="row">
			<div class="col-sm-3">
				<label class="col-sm-12 col-xs-12 mcdr-label">Installation:</label>
				<div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="installation" placeholder="" value="<?php echo $installation; ?>" required>
                </div>
            </div>
			</div>
			<div class="col-sm-3">
				<label class="col-sm-12 col-xs-12 mcdr-label">I.d. Tag / Line No.</label>
				<div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="id_tag_line_no" placeholder="" value="<?php echo $id_tag_line_no; ?>" required>
                </div>
            </div>
			</div>
			<div class="col-sm-3">
				<label class="col-sm-12 col-xs-12 mcdr-label">Maximo WO No.</label>
				<div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="maximo_wo_no" placeholder="" value="<?php echo $maximo_wo_no; ?>" required>
                </div>
            </div>
			</div>
			<div class="col-sm-3">
				<label class="col-sm-12 col-xs-12 mcdr-label">Date Reported</label>
				<div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control datepicker" name="date_reported" placeholder="" value="<?php echo $date_reported; ?>" required>
                </div>
            </div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<label class="col-sm-3 col-xs-12 mcdr-label">Module</label>
					<div class="col-sm-9 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="module" placeholder="" value="<?php echo $module; ?>" >
	                </div>
            	</div>
			</div>
			<div class="col-sm-3">
				<label class="col-sm-4 col-xs-12 mcdr-label">From ACET</label>
				<label class="col-sm-4 col-xs-12 mcdr-label"> Design</label>
				<label class="col-sm-4 col-xs-12 mcdr-label">Operating</label>
			</div>
			<div class="col-sm-6">
				<label class="col-sm-4 col-xs-12 mcdr-label">MCDR raised by</label>
				<div class="col-sm-8 col-xs-12">
	                <div class="form-group">
	                    <select name="mcdr_raised_by" class="form-control">
	                    	<?php echo default_select($mcdr_raised_by); ?>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                        </select>
	                </div>
            	</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-3">
				<label class="col-sm-3 col-xs-12 mcdr-label">Location (next to)</label>
					<div class="col-sm-9 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="location" placeholder="" value="<?php echo $location; ?>" >
	                </div>
            	</div>
			</div>
			<div class="col-sm-3">
				<label class="col-sm-4 col-xs-12 mcdr-label">Pressure (barg)</label>
				<div class="col-sm-4 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="pressure_design" placeholder="" value="<?php echo $pressure_design; ?>" >
	                </div>
        		</div>
				<div class="col-sm-4 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="pressure_operating" placeholder="" value="<?php echo $pressure_operating; ?>" >
	                </div>
        		</div>
			</div>
			<div class="col-sm-6">
				<label class="col-sm-4 col-xs-12 mcdr-label">Date of last inspection</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control datepicker" name="date_of_last_inspection" placeholder="" value="<?php echo $date_of_last_inspection; ?>" >
	                </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<label class="col-sm-3 col-xs-12 mcdr-label">System</label>
					<div class="col-sm-9 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="system" placeholder="" value="<?php echo $system; ?>" >
	                </div>
            	</div>
			</div>
			<div class="col-sm-3">
				<label class="col-sm-4 col-xs-12 mcdr-label">Temp (&deg;C)</label>
				<div class="col-sm-4 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="temp_design" placeholder="" value="<?php echo $temp_design; ?>" >
	                </div>
        		</div>
				<div class="col-sm-4 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="temp_operating" placeholder="" value="<?php echo $temp_operating; ?>" >
	                </div>
        		</div>
			</div>
			<div class="col-sm-6">
				<label class="col-sm-4 col-xs-12 mcdr-label">Est. time in service (yrs)</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="estimated_time_of_service" placeholder="" value="<?php echo $estimated_time_of_service; ?>" >
	                </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<label class="col-sm-6 col-xs-12 mcdr-label">Safety Critical (Y/N)</label>
					<div class="col-sm-6 col-xs-12">
	                <div class="form-group">
	                    <select name="safety_critical" class="form-control">
	                    	<?php echo default_select($safety_critical); ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
	                </div>
            	</div>
			</div>
			<div class="col-sm-3">
				<label class="col-sm-4 col-xs-12 mcdr-label">Flow (m/s)</label>
				<div class="col-sm-4 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="flow_design" placeholder="" value="<?php echo $flow_design; ?>" >
	                </div>
        		</div>
				<div class="col-sm-4 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="flow_operating" placeholder="" value="<?php echo $flow_operating; ?>" >
	                </div>
        		</div>
			</div>
			<div class="col-sm-6">
				<label class="col-sm-4 col-xs-12 mcdr-label"> Other MCDR's</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="other_mcdr" placeholder="" value="<?php echo $other_mcdr; ?>" >
	                </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-3">
				<label class="col-sm-3 col-xs-12 mcdr-label">PS No.</label>
					<div class="col-sm-9 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="ps_no" placeholder="" value="<?php echo $ps_no; ?>" >
	                </div>
            	</div>
			</div>
			<div class="col-sm-3">
				<label class="col-sm-3 col-xs-12 mcdr-label"> Process</label>
				<div class="col-sm-9 col-xs-12">
	                <div class="form-group">
	                    <input type="text" class="form-control" name="process" placeholder="" value="<?php echo $process; ?>" >
	                </div>
            	</div>
			</div>
			<div class="col-sm-6">
				<label class="col-sm-4 col-xs-12 mcdr-label">Related Reports</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="related_reports" placeholder="" value="<?php echo $related_reports; ?>" >
	                </div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-bottom: 10px;">
			<div class="col-sm-4">
				<h4><center>Details of Anomaly Item (from ACET)</center></h4>
			</div>
			<div class="col-sm-4">
				<h4><center>Details of Failure</center></h4>
			</div>
			<div class="col-sm-4">
				<h4><center>Current Status</center></h4>
			</div>
			<br>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Material Type</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="material_type" placeholder="" value="<?php echo $material_type; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label"> Degradation Type</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="degradation_type" placeholder="" value="<?php echo $degradation_type; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-8 col-xs-12 mcdr-label"> Added to MCDR Register (Y/N)</label>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
	                    <select name="added_to_mcdr_register" class="form-control">
	                    	<?php echo default_select($added_to_mcdr_register); ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
	                </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Component Size (mm)</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="component_size" placeholder="" value="<?php echo $component_size; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Degradation Mechanism</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="degradation_mechanism" placeholder="" value="<?php echo $degradation_mechanism; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-8 col-xs-12 mcdr-label"> Temp Repair Applied (Y/N)</label>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
	                    <select name="temp_repair_applied" class="form-control">
	                    	<?php echo default_select($temp_repair_applied); ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
	                </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label"> Schedule</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="schedule" placeholder="" value="<?php echo $schedule; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Pitting Depth</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="pitting_depth" placeholder="" value="<?php echo $pitting_depth; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-8 col-xs-12 mcdr-label"> Type of Repair</label>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
	                    <select name="type_of_repair" class="form-control">
	                    	<?php echo default_select($type_of_repair); ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
	                </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label"> NWT (mm)</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="nwt" placeholder="" value="<?php echo $nwt; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Extent</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="extent" placeholder="" value="<?php echo $extent; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-8 col-xs-12 mcdr-label"> Leaking (Y/N)</label>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
	                    <select name="leaking" class="form-control">
	                    	<?php echo default_select($leaking); ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
	                </div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label"> DCA (mm)</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="dca" placeholder="" value="<?php echo $dca; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Area (mm&sup2;) </label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="area" placeholder="" value="<?php echo $area; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-8 col-xs-12 mcdr-label"> Temp. Repair Reg. No.</label>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
	                    <select name="temp_repair_reg_no" class="form-control">
	                    	<?php echo default_select($temp_repair_reg_no); ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
	                </div>
				</div>
			</div>
		</div>



		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">  PS MAWT (mm)</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="ps_mawt" placeholder="" value="<?php echo $ps_mawt; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">MRWT (mm) </label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="mrwt" placeholder="" value="<?php echo $mrwt; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-8 col-xs-12 mcdr-label">  Remedial Action Type</label>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
	                    <select name="remedial_action_type" class="form-control">
	                    	<?php echo default_select($remedial_action_type); ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
	                </div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label"> Equipment Type</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="equipment_type" placeholder="" value="<?php echo $equipment_type; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Corrosion Grading (A,B,C,D) </label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="corrosion_grading" placeholder="" value="<?php echo $corrosion_grading; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-8 col-xs-12 mcdr-label">  Fabric maint. priority (H,M,L)</label>
				<div class="col-sm-4 col-xs-12">
					<div class="form-group">
	                    <select name="fabric_maint_priority" class="form-control">
	                    	<?php echo default_select($fabric_maint_priority); ?>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
	                </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">  Component</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="component" placeholder="" value="<?php echo $component; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Other remarks </label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="other_remarks" placeholder="" value="<?php echo $other_remarks; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-6 col-xs-12 mcdr-label">  F Target Close-out Date (MMYY)</label>
				<div class="col-sm-6 col-xs-12">
					<div class="form-group">
                        <input type="text" class="form-control datepicker" name="target_close_out_date" placeholder="" value="<?php echo $target_close_out_date; ?>" >
	                </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">  Area on component</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="area_on_component" placeholder="" value="<?php echo $area_on_component; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<h4><center>Key Performance Indicators </center></h4>
			</div>
			<div class="col-sm-4">
				<h4><center>Drawings, P&amp;ID, etc</center></h4>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Coating System Details</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="coating_system_details" placeholder="" value="<?php echo $coating_system_details; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Leak </label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="leak" placeholder="" value="<?php echo $leak; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group">
                        <input type="text" class="form-control" name="drawings_pid_etc" placeholder="" value="<?php echo $drawings_pid_etc; ?>" >
	                </div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label">Insulated / Class</label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="insulated_class" placeholder="" value="<?php echo $insulated_class; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<label class="col-sm-4 col-xs-12 mcdr-label"> Deferment </label>
				<div class="col-sm-8 col-xs-12">
					<div class="form-group">
	                    <input type="text" class="form-control" name="deferment" placeholder="" value="<?php echo $deferment; ?>" >
	                </div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-12 col-xs-12">
					<div class="form-group">
                        <!-- <input type="text" class="form-control" name="doc_title" placeholder="" value="" > -->
	                </div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="mcdr_additional_info"><?php echo $mcdr_additional_info; ?></textarea>
                </div>
			</div>
		</div>

		<div class="row">
			<label class="col-sm-12 col-xs-12 mcdr-label"> Maint Superintendent (mandatory comment - clearly identify how repair can be completed - shutdown, local isolation, normal operations) : </label>
		</div>


		<div class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group form-group-required">
                    <textarea class="form-control textarea-editor medium" name="maint_superintendent"><?php echo $maint_superintendent; ?></textarea>
                </div>
			</div>
		</div>

	</div>
	<?php $this->load->view('includes/casefile-footer'); ?>
	<?php echo form_close(); ?>
</div>