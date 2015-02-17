<div class="row">
	<div class="col-xs-12">
		<?php 
            $attributes=array( 'role'=>'form', 'class'=>'form-horizontal form-bordered' ); 
            echo form_open('document/get-results', $attributes);
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
                        <span><h3 class="step-title">Documents and Reports</h3></span>
                    </legend>
					<div class="form-group">
                        <div class="col-sm-3 col-xs-12">
		            		<label for="" class="control-label">Author</label>
						</div>
                        <div class="col-sm-4 col-xs-12">
                            <select name="author" id="" class="form-control select2-dropdown">
                                <?php echo $user_option; ?>
                            </select>
                        </div>
                        <div class="col-sm-1 col-xs-12">
                            <label for="" class="control-label">Name</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <input type="text" name="document_name" class="form-control" value="" placeholder="document name">
                        </div>
                        <div class="col-sm-12 hidden-xs">&nbsp;</div> 
                        <div class="col-sm-3 col-xs-12">
                            <label for="" class="control-label">Type</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                        	<select name="document_type" id="document-type-document-search" class="form-control">
                                <?php echo $document_type_option; ?>
                            </select>
                        </div>
                        
                        <div class="col-sm-1 col-xs-12">
                            <label for="" class="control-label">Status</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <select name="document_status" id="" class="form-control">
                                <?php echo $document_status_dropdown; ?>
                            </select>
                        </div>
                        <div class="col-sm-12 hidden-xs">&nbsp;</div>
                        <div class="col-sm-3 col-xs-12">
                            <label for="" class="control-label">Date Range</label>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="input-group">
                                    <input id="start_date_range" type="text" class="form-control" name="start_date" placeholder="Start Date">
                                    <span class="input-group-addon">to</span>
                                    <input id="end_date_range" type="text" class="form-control" name="end_date" placeholder="End Date">
                                </div>                    
                        </div>
                    </div>
				</fieldset>
                <div class="equipment-profile-document-search hidden">
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
                    
			</div>
			<div class="panel-footer text-right">
                <button  class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>
</div>