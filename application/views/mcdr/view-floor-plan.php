

<div class="panel panel-default">
	<div class="panel-body" id="floor-plan-container">
		
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">Floor Plan</h4>
		<div class="panel-options">
            <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
        </div>
	</div>
	<div class="panel-body">

		<?php $attributes = array( 'id' => 'upload-floor-plan');
    	echo form_open_multipart('mcdr/upload_floor_plan', $attributes);?>
		
			<div class="row">
				<div class="col-sm-offset-9 col-sm-3 col-xs-12">
					<div class="upload-errors">
			        </div>
			        <div class="attach-files-container">
			            <div class="attach-files">
			                <div class="row">
			                  	<div class="col-sm-12">
			                    	<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			                      		<div class="form-control action-tracker-upload" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			                      		<span class="input-group-addon btn btn-default btn-file"><span class="glyphicon glyphicon-paperclip"></span><input type="file" name="userfile" ></span>
			                      		<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span></a>

									</div>
			                  	</div>
			                </div>
			                <div class="row">
			                	<div class="col-sm-offset-7 col-sm-5 ">
			                  		<button value="upload" class="btn btn-danger go-yes pull-right upload-button"> Upload</button>
			                  	</div>
			                </div>
			            </div>
						<div class="hidden-item">
							<input type="hidden" name="floor_plan_id" value="<?php echo $floor_plan_id; ?>">
						</div>
			       	</div>
				</div>
			</div>

		<?php echo form_close(); ?>

			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<br>
					<br>
					<h4 class="step-title">Plot Points</h4>
					<div id="floor-plan-points">
						<div id="no-plot-points" class="hidden">
				            <p>There are no Plot points yet. </p>
				        </div>
						<table class="table table-bordered plot-table">
							<thead>
								<tr>
									<th>Plot Number</th>
									<th>Plot Note</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						
					</div>
				</div>
				<div class="col-sm-6 col-xs-12">
					<br>
					<br>
					<?php $attributes = array( 'id' => 'sample');
    				echo form_open('mcdr/update_floor_plan_description', $attributes);?>
    				<div class="form-group">
    					<h4 class="step-title">Description</h4>
    					<textarea class="form-control textarea-editor medium" name="description"><?php echo $description; ?></textarea>
    					<input type="hidden" name="floorplan_id" value="<?php echo $floor_plan_id; ?>">
    				</div>
					<button type="submit" value="description_floor_pln" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
					<?php echo form_close(); ?>
				</div>
			</div>
		        
	</div>
</div>