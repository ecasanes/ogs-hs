<div class="row">
	<div class="col-xs-12">
		<?php 
            $attributes=array( 'role'=>'form', 'class'=>'form-horizontal form-bordered' ); 
            echo form_open('document/get_results', $attributes);
        ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Search</h4>

				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12"><p>Please complete one or more search fields to locate and filter what you are looking for</p></div>
				</div>
				
				<br>
				<div class="row">
                    <div class="col-xs-12">
                        <?php $search_need_input = $this->session->flashdata('search_need_input'); ?>

                        <?php if($search_need_input): ?>
                            <div class="alert alert-danger fade in">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <strong></strong> <?php echo $search_need_input; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

				<fieldset>
					<legend class="form-legend">
						<span><h3 class="step-title">User Profile </h3></span>
					</legend>
					<div class="form-group">
                        <div class="col-sm-3 col-xs-12">
		            		<label for="" class="control-label">Username</label>
						</div>
                        <div class="col-sm-4 col-xs-12">
                            <input type="text" class="form-control" name="user_name" id="user-name" placeholder=""  value="">      		
                        </div>
                        <div class="col-sm-1 col-xs-12">
                            <label for="" class="control-label">Date</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                        	<input type="text" id="user-date" name="user_date" class="form-control datepicker" placeholder="Select the Date" value="">         		
                        </div>
                        <div class="col-sm-12 hidden-xs">&nbsp;</div> 
                        <div class="col-sm-3 col-xs-12">
                            <label for="" class="control-label">Case File Name</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <input type="text" name="name" value="" id="case-file-name" class="form-control">                    
                        </div>
                        <div class="col-sm-1 col-xs-12">
                            <label for="" class="control-label">Number</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <input type="text" name="code" id="code" class="form-control" value="">                    
                        </div>
                    </div>
				</fieldset>
				<fieldset>
					<legend class="form-legend">
						<span><h3 class="step-title">Asset Profile </h3></span>
					</legend>
					<div class="form-group">
                        <div class="col-sm-3 col-xs-12">
		            		<label for="" class="control-label">Asset Type</label>
						</div>
                        <div class="col-sm-9 col-xs-12">
                            <select class="form-control" name="asset_type" id="asset-type">
                                <?php echo $asset_type_dropdown; ?>
							</select>      		
                        </div>
                        <div class="col-sm-12 hidden-xs">&nbsp;</div> 
                        <div class="col-sm-3 col-xs-12">
                            <label for="" class="control-label">Justification</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                        	<select class="form-control" name="justification" id="justification">
           	                    <?php echo $justification_dropdown; ?>
                            </select>
                        </div>
                        <div class="col-sm-2 col-xs-12">
                            <label for="" class="control-label">Date of Issue</label>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <input type="text" id="date-of-issue" name="date_of_issue" class="form-control datepicker" placeholder="Select the Date" value="">                    
                        </div>                        
                    </div>
				</fieldset>
				<fieldset>
					<legend class="form-legend">
						<span><h3 class="step-title">Equipment Profile</h3></span>
					</legend>
					<div class="form-group">
						<div class="col-sm-3 col-xs-12">
							<label for="" class="control-label">System</label>
						</div>
						<div class="col-sm-9 col-xs-12">
							<select class="form-control" name="system" id="system">
                                <?php echo $system_dropdown; ?>
                            </select>
						</div>
						<div class="col-sm-12 hidden-xs">&nbsp;</div> 
						<div class="col-sm-3 col-xs-12">
							<label for="" class="control-label">System Subcategory</label>
						</div>
						<div class="col-sm-9 col-xs-12">
							<select class="form-control" name="system_subcategory" id="system_subcategory">
                                <?php echo $system_subcategory_dropdown; ?>
                            </select>
						</div>
						<div class="col-sm-12 hidden-xs">&nbsp;</div> 
                        <div class="col-sm-3 col-xs-12">
                            <label for="" class="control-label">Equipment Category</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                        	<select class="form-control" name="equipment_category" id="equipment-category">
                                <?php echo $equipment_category_dropdown; ?>
                            </select>
                        </div>
                        <div class="col-sm-2 col-xs-12">
                            <label for="" class="control-label">Class</label>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <select class="form-control" name="equipment_class" id="equipment-class">
                                <?php echo $equipment_class_dropdown; ?>
							</select>
                        </div>
                        <div class="col-sm-12 hidden-xs">&nbsp;</div> 
                        <div class="col-sm-3 col-xs-12">
                            <label for="" class="control-label">Description</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                        	<select class="form-control" name="equipment_description" id="equipment-description">
                                <?php echo $equipment_description_dropdown; ?>
                            </select>
                        </div>
                        <div class="col-sm-2 col-xs-12">
                            <label for="" class="control-label">Code</label>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <input id="equipment-code" name="equipment_code" class="form-control" type="text" value="" />
                        </div> 
                        <div class="col-sm-12 hidden-xs">&nbsp;</div> 
                        <div class="col-sm-3 col-xs-12">
                            <label for="" class="control-label">Tag Number</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                        	<input type="text" class="form-control" name="equipment_tag_number" id="equipment-tag-number" placeholder="" value="">
                        </div>
                        <div class="col-sm-2 col-xs-12">
                            <label for="" class="control-label">Unique ID</label>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <input type="text" id="equipment-unique-id" name="equipment_unique_id" class="form-control" placeholder="" value="">
                        </div>
                        <div class="col-sm-12 hidden-xs">&nbsp;</div> 
                        <div class="col-sm-3 col-xs-12">
                            <label for="" class="control-label">Manufacturer</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                        	<input type="text" class="form-control" name="equipment_manufacturer" id="equipment-manufacturer" placeholder="" value="">
                        </div>
                        <div class="col-sm-2 col-xs-12">
                            <label for="" class="control-label">Model</label>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <input type="text" id="equipment-model" name="equipment_model" class="form-control" placeholder="" value="">
                        </div>
                        <div class="col-sm-12 hidden-xs">&nbsp;</div> 
                        <div class="col-sm-3 col-xs-12">
                            <label for="" class="control-label">Power Output</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                        	<input type="text" class="form-control" name="equipment_power_output" id="equipment-power-output" placeholder="" value="">
                        </div>
                        <div class="col-sm-2 col-xs-12">
                            <label for="" class="control-label">Failed Component</label>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <input type="text" id="equipment-failed-component" name="equipment_failed_component" class="form-control" placeholder="" value="">
                        </div> 
					</div>
				</fieldset>
			</div>
			<div class="panel-footer text-right">
                <button  class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>