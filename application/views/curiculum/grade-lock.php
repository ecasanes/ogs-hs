	<div class="row">
		<div class="col-xs-12">
			<?php echo form_open('', array('id' => 'search-grade-lock')); ?>
			<div class="form-horizontal">
		    	<div class="row">
		    		
		    			<div class="form-group">
	                      <label for="school_year" class="control-label col-sm-2 col-xs-12">Filter by School Year</label>
	                      <div class="col-sm-2 col-xs-12">
	                        <select name="filter_school_year" id="" class="form-control" required>
	                          <?php echo $school_year_dropdown; ?>
	                        </select>
	                        
	                      </div>
	                      <div class="col-sm-2 col-xs-12">
	                      	<select name="filter_year_level" id="" class="form-control" required>
	                      		<option value="">Select SY</option>
	                      		<option value="1">1st Year</option>
	                      		<option value="2">2nd Year</option>
	                      		<option value="3">3rd Year</option>
	                      		<option value="4">4th Year</option>
	                      	</select>
	                      </div>
	                      <div class="col-sm-1">
	                      	<input type="submit" class="pull-right btn btn-success submit-form" value="Search">
	                      </div>
                    	</div>
		    	</div>
		    </div>
		    <?php echo form_close(); ?>
		</div>
	</div>

<div class="row">
	<div class="col-xs-12">

		<!-- start panel -->
		<div class="panel panel-primary">
			
		  <div class="panel-heading">
		    <h3 class="panel-title">Lock/Unlock Grades</h3>
		    <div class="panel-options">
		    	
		    </div>
		  </div>
		  <div class="loading panel-body hidden">
			<i class="fa fa-spin fa-refresh"></i> Loading...
		  </div>
		  <?php echo form_open('curiculum/submit_grade_lock', array('id'=>'grade-lock-form')); ?>
		  <div class="panel-body">
		  	
		  </div>
		  <!-- <div class="panel-footer">
		  	<div class="row">
		  		<div class="col-sm-10">
		  			<span class="message"></span>
		  		</div>
		  		<div class="col-sm-2">
		  			<input type="submit" class="pull-right btn btn-success submit-form" value="Update Grade Lock">
		  		</div>
		  	</div>
		  </div> -->
		  <?php echo form_close(); ?>
		</div>
		<!-- end panel -->
	</div>
</div>