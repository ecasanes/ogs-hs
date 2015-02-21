<div class="row">
	<div class="col-xs-12">

		<!-- start panel -->
		<div class="panel panel-primary">
			
		  <div class="panel-heading">
		    <h3 class="panel-title">Manage Grades</h3>
		    <div class="panel-options">
                <a href="#" data-rel="collapse" data-target="#sample-panel"><i class="fa fa-fw fa-minus"></i></a>
            </div>
		  </div>
		  <?php echo form_open('curiculum/submit_manage_grades', array('id'=>'manage-grade-form')); ?>
		  <div id="sample-panel" class="panel-body">
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
                    	<label for="school_year" class="control-label col-sm-2 col-xs-12">Grade Level</label>
	                      <div class="col-sm-2 col-xs-12">
	                        <select name="grade_level" id="" class="form-control" required>
	                        	<option value="">Select</option>
	                          <?php echo $grade_level_dropdown; ?>
	                        </select>
	                      </div>
                    </div>

                    <div class="form-group">
                    	<label for="school_year" class="control-label col-sm-2 col-xs-12">Section Name</label>
	                      <div class="section col-sm-2 col-xs-12">
	                      	<div class="loading hidden"><i class="fa fa-loading fa-spin"></i> Loading Sections...</div>
	                      	<div class="not-found hidden">No Sections Found</div>
	                      	<div class="requirements">Please Select School Year and Grade Level</div>
	                      	<select name="section" class="form-control hidden" required>
	                      	</select>
	                      </div>
                    </div>

                    <div class="form-group">
                    	<label for="subject" class="control-label col-sm-2 col-xs-12">Subject Name</label>
	                      <div class="subject col-sm-2 col-xs-12">
	                      	<div class="loading hidden"><i class="fa fa-loading fa-spin"></i> Loading Subjects...</div>
	                      	<div class="not-found hidden">No Subjects Offered</div>
	                      	<div class="requirements">Please Select Section</div>
	                      	<select name="subject" class="form-control hidden" required>
	                      	</select>
	                      </div>
                    </div>

                    <!-- <div class="form-group">
                    	<label for="subject" class="control-label col-sm-2 col-xs-12">Instructor Name</label>
                    	                      <div class="user col-sm-2 col-xs-12">
                    	                      	<div class="loading hidden"><i class="fa fa-loading fa-spin"></i> Loading Instructors...</div>
                    	                      	<div class="not-found hidden">No Instructors Found</div>
                    	                      	<div class="requirements">Please Select Subject</div>
                    	                      	<select name="user" class="form-control hidden" required>
                    	                      	</select>
                    	                      </div>
                    </div> -->
			  		
			  	</div>
		  	</div>
		  </div>
		  <div class="panel-footer">
		  	<div class="row">
		  		<div class="col-sm-10">
		  			<?php if(isset($error)): ?>
		              <span class="error-message"><?php echo $error; ?></span>
		            <?php endif; ?>
		            <?php if(isset($success)): ?>
		              <span class="success-message"><?php echo $success; ?></span>
		            <?php endif; ?>
		  		</div>
		  		<div class="col-sm-2">
		  			<input type="submit" class="pull-right btn btn-success submit-form" value="View Grades">
		  		</div>
		  	</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
		<!-- end panel -->

		

		<!-- start panel -->
		<div class="panel panel-primary">
			
		  <div class="panel-heading">
		    <h3 class="panel-title">Modify Grades</h3>
		    <span class="pull-right">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class="active"><a href="#quizzes" data-toggle="tab">Quizzes</a></li>
                    <li><a href="#assignment" data-toggle="tab">Assignment</a></li>
                    <li><a href="#recitation" data-toggle="tab">Recitation</a></li>
                    <li><a href="#project" data-toggle="tab">Project</a></li>
                    <li><a href="#exam" data-toggle="tab">Exam</a></li>
                </ul>
            </span>
		  </div>
		  <?php echo form_open('curiculum/submit_edit_grades', array('id'=>'edit-grades-form')); ?>
		  <div class="panel-body">
		  	<div class="tab-content">
				<div class="tab-pane fade in active" id="quizzes">
					a
				</div>
				<div class="tab-pane fade in" id="assignment">
					b
				</div>
				<div class="tab-pane fade in" id="recitation">
					c
				</div>
				<div class="tab-pane fade in" id="project">
					d
				</div>
				<div class="tab-pane fade in" id="exam">
					e
				</div>
			</div>
		  </div>
		  <div class="panel-footer">
		  	<div class="row">
		  		<div class="col-sm-10">
		  			<?php if(isset($error)): ?>
		              <span class="error-message"><?php echo $error; ?></span>
		            <?php endif; ?>
		            <?php if(isset($success)): ?>
		              <span class="success-message"><?php echo $success; ?></span>
		            <?php endif; ?>                                                                                                                                                                         
		  		</div>
		  		<div class="col-sm-2">
		  			<input type="submit" class="pull-right btn btn-success submit-form" value="Save Grades">
		  		</div>
		  	</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
		<!-- end panel -->

















		<!-- start panel -->
		<!-- <div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">List of Assigned Instructors</h3>
		    <div class="panel-options">
		    	
		    </div>
		  </div>
		  <div id="search-user" class="panel-body">
		    <div class="form-horizontal">
		    	<div class="row">
		    		
		    			<div class="form-group">
			                      <label for="school_year" class="control-label col-sm-2 col-xs-12">Filter by School Year</label>
			                      <div class="col-sm-2 col-xs-12">
			                        <select name="school_year" id="" class="form-control" required>
			                          <?php echo $school_year_dropdown; ?>
			                        </select>
			                      </div>
			                      <div class="col-sm-1">
		  			<input type="submit" class="pull-right btn btn-success submit-form" value="Search">
		  		</div>
		
		         
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
		</div> -->
		<!-- end panel -->
	</div>
</div>