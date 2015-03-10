<div class="row">
    <div class="col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Manage Curiculum</h3>
                    <span class="pull-right">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class="active"><a href="#add-school-year" data-toggle="tab">Add School Year</a></li>
                            <li><a href="#view-class-record" data-toggle="tab">View Class Record</a></li>
                        </ul>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="tab-content">

                
                        <div class="tab-pane fade in active" id="add-school-year">

                          <div class="alert alert-info alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Note.</strong> Click on the tab button to select a Subject for a Year Level in a School Year.
                          </div>

                          <?php echo form_open('', array('id'=>'add-grade-level-form')); ?>
                          <div class="form-horizontal">
                              <!-- <div class="form-group">
                                <label for="username" class="control-label col-sm-2 col-xs-12">Year Level</label>
                                <div class="col-sm-2 col-xs-12">
                                  <select name="grade_level" id="" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                  </select>
                                </div>
                              </div> -->

                              <div class="form-group">
                                <label for="username" class="control-label col-sm-2 col-xs-12">SY Start</label>
                                <div class="col-sm-2 col-xs-12">
                                  <select name="sy_start" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php echo year_dropdown($year_minus_a_year, 1); ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="username" class="control-label col-sm-2 col-xs-12">SY End</label>
                                <div class="col-sm-2 col-xs-12">
                                  <select name="sy_end" class="form-control" required>
                                    <option value="">Select</option>
                                    <?php echo year_dropdown(null, 0); ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="username" class="control-label col-sm-2 col-xs-12"></label>
                                <div class="col-sm-6 col-xs-12">
                                  <input type="submit" value="Add" class="btn btn-success">
                                  &nbsp;
                                  <span class="error-message"></span>
                                  <span class="success-message"></span>
                                </div>
                              </div>

                          </div>
                          <?php echo form_close(); ?>

                        </div>


                        <div class="tab-pane fade" id="view-class-record">

                          <!--
                          
                          School year
                          Year Level
                          section
                          class record
  
                          -->

                          <div class="form-horizontal">
                            <div class="form-group">
                              <label for="school_year" class="control-label col-sm-2 col-xs-12">School Year</label>
                              <div class="col-sm-2 col-xs-12">
                                <select name="school_year" id="" class="form-control" required>
                                  <?php echo $school_year_dropdown; ?>
                                </select>
                              </div>
                              
                              <div class="col-sm-1 col-xs-12">
                                <input id="search-class-record" type="submit" value="Search" class="btn btn-success">
                              </div>
                            </div>
                          </div>

                          <br>

                          <div class="loading hidden">
                            <i class="fa fa-spin fa-refresh"></i> Loading ...
                          </div>
                          <div id="class-record-container">

                          </div>

                          <!-- start panel -->
                          <div id="term-activity-grade" class="panel panel-primary hidden">
                            
                            <div class="panel-heading">
                              <h3 class="panel-title">View Grades <span class="term-title"></span></h3>
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
                            echo form_hidden('grade_level_id', '');
                            ?>
                            <div class="panel-body">
                              <div class="tab-content">
                                <div class="loading hidden">
                                <i class="fa fa-spin fa-loading"></i> Loading...
                                </div>
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
                </div>
            </div>
        </div>
  </div>



