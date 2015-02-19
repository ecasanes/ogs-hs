<div class="row">
    <div class="col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Manage Curiculum</h3>
                    <span class="pull-right">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class="active"><a href="#add-school-year" data-toggle="tab">Add School Year</a></li>
                            <li><a href="#first-year" data-toggle="tab">First Year</a></li>
                            <li><a href="#second-year" data-toggle="tab">Second Year</a></li>
                            <li><a href="#third-year" data-toggle="tab">Third Year</a></li>
                            <li><a href="#fourth-year" data-toggle="tab">Fourth Year</a></li>
                        </ul>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="tab-content">

                
                        <div class="tab-pane fade in active" id="add-school-year">

                          <div class="alert alert-info alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <strong>Note.</strong> Click on the tab button to select a Subject for a Grade level in a School Year.
                          </div>

                          <div class="form-horizontal">
                              <div class="form-group">
                                <label for="username" class="control-label col-sm-2 col-xs-12">Grade Level</label>
                                <div class="col-sm-2 col-xs-12">
                                  <select name="grade_level" id="" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="username" class="control-label col-sm-2 col-xs-12">SY Start</label>
                                <div class="col-sm-2 col-xs-12">
                                  <select name="sy_start" class="form-control">
                                    <?php echo year_dropdown(); ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="username" class="control-label col-sm-2 col-xs-12">SY End</label>
                                <div class="col-sm-2 col-xs-12">
                                  <select name="sy_end" class="form-control">
                                    <?php echo year_dropdown(); ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="username" class="control-label col-sm-2 col-xs-12"></label>
                                <div class="col-sm-2 col-xs-12">
                                  <input type="submit" value="Add" class="btn btn-success">
                                </div>
                              </div>

                          </div>

                        </div>


                        <div class="tab-pane fade" id="first-year">
                          
                        </div>


                        <div class="tab-pane fade" id="second-year">
                          
                        </div>


                        <div class="tab-pane fade" id="third-year">
                          
                        </div>


                        <div class="tab-pane fade" id="fourth-year">
                          
                        </div>




                    </div>
                </div>
            </div>
        </div>
  </div>



