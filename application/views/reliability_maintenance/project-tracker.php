<div class="row">
	<div class="col-xs-12">
		<?php
			$attributes = array( 'role'=>'form' , 'id' => 'filter-project-tracker-form', 'class' => 'form-horizontal' );
			echo form_open('', $attributes);
			echo form_hidden('current_user_id', $current_user_id);
		?>
		<div class="panel panel-info collapsed">
			<div class="panel-heading">
				<h4 class="panel-title">Filter Project Tracker</h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
				</div>
			</div>
			<div class="panel-body" style="display:none;">
				<div class="form-group">
                    <label for="" class="col-sm-4 col-xs-12 control-label">Project Name</label>
					<div class="col-sm-4 col-xs-12">
                    	<input type="text" name="project_name_input" class="form-control">
					</div>
				</div>
				<div class="form-group">
                	<label for="" class="col-sm-4 col-xs-12 control-label">Project Number</label>
					<div class="col-sm-4 col-xs-12">
                    	<input type="text" name="project_number_input" class="form-control">
					</div>
				</div>
				<div class="form-group">
                	<label for="" class="col-sm-4 col-xs-12 control-label">Author</label>
					<div class="col-sm-4 col-xs-12">
                    	<input type="text" name="author_input" class="form-control">
					</div>
				</div>
				<div class="form-group">
                	<label for="" class="col-sm-4 col-xs-12 control-label">Target Start Date</label>
					<div class="col-sm-4 col-xs-12">
                    	<input type="text" name="start_date_input" class="form-control datepicker">
					</div>
				</div>
				<div class="form-group">
                	<label for="" class="col-sm-4 col-xs-12 control-label">Project Condition</label>
					<div class="col-sm-4 col-xs-12">
                    	<select name="project_condition" class="form-control">
                    		<?php echo $project_condition_dropdown; ?>
                    	</select>
					</div>
				</div>
				<div class="form-group">
                	<label for="" class="col-sm-4 col-xs-12 control-label">Work Party</label>
					<div class="col-sm-4 col-xs-12">
                    	<select name="work_party" class="form-control">
                    		<?php echo $work_party_dropdown; ?>
                    	</select>
					</div>
				</div>
			</div>
			<div class="panel-footer bg-panel-grey" style="display:none;">
				<div class="form-group">
					<div class="col-sm-offset-10 col-sm-2 text-right">
						<button  class="btn btn-info btn-block" type="submit"><span class="glyphicon glyphicon-search"></span> Filter</button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Project Tracker</h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<div id="no-project-tracker" class="hidden">
					<p>No Projects Found.</p>
                </div> 

                <div id="no-search-found" class="hidden">
                	<p>There are no Projects found. </p>
				</div>
                                  
                <div id="loading-project-tracker" class="hidden">
                	<i class="fa fa-refresh fa-spin"></i>  Loading Project Tracker...
               	</div>

               	<div class="text-center horizontal-overflow-scroll" id="project-tracker-container">
					<table id="project-tracker-ajax" class="table table-bordered table-condensed">
						<thead> </thead>
                        <tbody> </tbody>
					</table>
                </div>

              
			</div>
			<div class="panel-footer">
				<div class="row hidden">
					<div class="col-sm-offset-10 col-sm-2 text-right">
                       	<button type="button" class="btn btn-info add-project-tracker-row btn-sm"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
				</div>
				
			</div>
		</div>
	</div>
</div>