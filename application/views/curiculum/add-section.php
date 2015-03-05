<div class="row">
	<div class="col-xs-12">

		<!-- start panel -->
		<div class="panel panel-default">
			
		  <div class="panel-heading">
		    <h3 class="panel-title">Add Section</h3>
		    <div class="panel-options">
		    	
		    </div>
		  </div>
		  <?php echo form_open('curiculum/submit_add_section', array('id'=>'add-user-form')); ?>
		  <div class="panel-body">
		  	<div class="form-horizontal">
			  	<div class="row">
			  		<div class="form-group">
                      <label for="school_year" class="control-label col-sm-2 col-xs-12">School Year</label>
                      <div class="col-sm-2 col-xs-12">
                        <select name="school_year" id="" class="form-control" required>
                        	<option value="">Select</option>
                          <?php echo $school_year_dropdown; ?>
                        </select>
                      </div>

         
                    </div>

                    <div class="form-group">
                    	<label for="school_year" class="control-label col-sm-2 col-xs-12">Year Level</label>
	                      <div class="col-sm-2 col-xs-12">
	                        <select name="grade_level" id="" class="form-control" required>
	                        	<option value="">Select</option>
	                          <?php echo $grade_level_dropdown; ?>
	                        </select>
	                      </div>
                    </div>

                    <div class="form-group">
                    	<label for="school_year" class="control-label col-sm-2 col-xs-12">Section Name</label>
	                      <div class="col-sm-2 col-xs-12">
	                        <input type="text" name="section" value="" class="form-control" required>
	                      </div>
                    </div>
			  		
			  	</div>
		  	</div>
		  </div>
		  <div class="panel-footer">
		  	<div class="row">
		  		<div class="col-sm-10">

					<?php if(isset($result)): ?>
			  			<?php if($result): ?>
			  				<span class="success-message"><?php echo $message; ?></span>
				  		<?php else: ?>
							<span class="error-message"><?php echo $message; ?></span>
				  		<?php endif; ?>
				  	<?php endif; ?>
		  			
		  		</div>
		  		<div class="col-sm-2">
		  			<input type="submit" class="pull-right btn btn-success submit-form" value="Add">
		  		</div>
		  	</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
		<!-- end panel -->


		<!-- start panel -->
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Search List</h3>
		    <div class="panel-options">
		    	
		    </div>
		  </div>
		  <div id="search-section" class="panel-body">
		    <div class="form-horizontal">
		    	<div class="row">
		    		
		    			<div class="form-group">
	                      <label for="school_year" class="control-label col-sm-2 col-xs-12">Filter by School Year</label>
	                      <div class="col-sm-2 col-xs-12">
	                        <select name="school_year" id="" class="form-control" required>
	                          <?php echo $school_year_dropdown; ?>
	                        </select>
	                      </div>
	                      
	                      
	                      <!-- <div class="col-sm-1">
	                      				  			<input type="submit" class="pull-right btn btn-success submit-form" value="Search">
	                      				  		</div> -->

         
                    </div>
		    	</div>
		    </div>
		    <br>
		    <div class="row">
		    	<div class="col-xs-12">
		    		<span class="loading hidden">
						<i class="fa fa-spin fa-refresh"></i> Loading...
		    		</span>
		    		<div class="search-results">

		    		</div>
		    	</div>
		    </div>
		  </div>
		</div>
		<!-- end panel -->
	</div>
</div>