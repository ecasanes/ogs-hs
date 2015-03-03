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
		  <?php echo form_open('', array('id'=>'manage-grade-form')); ?>
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
	                      <div class="section col-sm-2 col-xs-12">
	                      	<div class="loading hidden"><i class="fa fa-loading fa-spin"></i> Loading Sections...</div>
	                      	<div class="not-found hidden">No Sections Found</div>
	                      	<div class="requirements">Please Select School Year and Year Level</div>
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

                    <div class="form-group">
                    	<label for="school_year" class="control-label col-sm-2 col-xs-12">Term</label>
	                      <div class="col-sm-2 col-xs-12">
	                        <select name="term" id="" class="form-control" required>
	                        	<option value="">Select</option>
	                          	<option value="1">1</option>
	                          	<option value="2">2</option>
	                          	<option value="3">3</option>
	                          	<option value="4">4</option>
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
                    <li class="active"><a href="#quizzes" data-toggle="tab" data-id="quiz" class="activity-tab">Quizzes</a></li>
                    <li><a href="#assignment" data-toggle="tab" data-id="assignment" class="activity-tab">Assignment</a></li>
                    <li><a href="#recitation" data-toggle="tab" data-id="recitation" class="activity-tab">Recitation</a></li>
                    <li><a href="#project" data-toggle="tab" data-id="project" class="activity-tab">Project</a></li>
                    <li><a href="#exam" data-toggle="tab" data-id="exam" class="activity-tab">Exam</a></li>
                </ul>
            </span>
		  </div>
		  <?php 
		  echo form_open('curiculum/submit_edit_grades', array('id'=>'activity-form')); 
		  echo form_hidden('school_year', '');
		  echo form_hidden('grade_level', '');
		  echo form_hidden('section', '');
		  echo form_hidden('subject', '');
		  echo form_hidden('term', '');
		  echo form_hidden('subj_offerid', '');
		  ?>
		  <div class="panel-body">
		  	<div class="tab-content">
		  		<div class="loading hidden">
					<i class="fa fa-spin fa-loading"></i> Loading...
		  		</div>
		  		<!-- <div id="edit-activity-settings-container">
		  							<div class="form-horizontal">
		  								<div class="form-group">
		  									<div class="row">
		  										<label class="control-label col-sm-2 col-xs-12">Weight</label>
		  										<div class="col-sm-2 col-xs-12">
		  											<input type="number" value="" class="form-control number-only" min="1" max="100" name="activity_weight">
		  										</div>
		  										
		  									</div>
		  								</div>
		  								<div class="form-group">
		  									<div class="row">
		  										<label class="control-label col-sm-2 col-xs-12">Columns</label>
		  										<div class="col-sm-2 col-xs-12">
		  											<select class="form-control" name="activity_column">
		  												<option value="">Select</option>
		  												<option value="1">1</option>
		  												<option value="2">2</option>
		  												<option value="3">3</option>
		  												<option value="4">4</option>
		  												<option value="5">5</option>
		  												<option value="6">6</option>
		  												<option value="7">7</option>
		  												<option value="8">8</option>
		  												<option value="9">9</option>
		  												<option value="10">10</option>
		  											</select>
		  										</div>
		  										
		  									</div>
		  								</div>
		  		
		  								<div class="form-group">
		  									<div class="row">
		  										<label class="control-label col-sm-2 col-xs-12"></label>
		  										<div class="col-sm-2 col-xs-12">
		  											<button id="submit-activity-settings" class="btn btn-primary btn-block">Submit</button>
		  										</div>
		  										
		  									</div>
		  								</div>
		  		
		  								<div class="form-group">
		  									<div class="row">
		  										<div class="col-xs-12 col-sm-2">
		  										</div>
		  										<div class="col-xs-12 col-sm-3">
		  											<div id="settings-success" class="success text-success"></div>
		  										</div>
		  									</div>
		  								</div>
		  								
		  							</div>
		  				      	</div> -->
		      	<br>
				<div class="tab-pane fade in active" id="quizzes" data-id="quiz">

				</div>
				<div class="tab-pane fade in" id="assignment" data-id="assignment">
					
				</div>
				<div class="tab-pane fade in" id="recitation" data-id="recitation">
					
				</div>
				<div class="tab-pane fade in" id="project" data-id="project">
					
				</div>
				<div class="tab-pane fade in" id="exam" data-id="exam">
					
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
		  		<!-- <div class="col-sm-2">
		  			<input type="submit" class="pull-right btn btn-success submit-form" value="Save Grades">
		  		</div> -->
		  	</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
		<!-- end panel -->








	</div>
</div>



<div class="modal fade" id="activity-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modify <span class="tag"></span></h4>
      </div>
      <?php echo form_open('', array('id' => 'edit-activity-form')); ?>
      <?php echo form_hidden('activity_id', ''); ?>
      <?php echo form_hidden('activity_type', ''); ?>
      <div class="modal-body">

      	

      	<div id="edit-activity-container">
      		
      	</div>
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> Close</button>
        <button type="submit" class="btn btn-success go-yes"> Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>