<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo $step_title; ?> <i class="fa fa-question-circle text-success pp-step4-popover"></i></h4>
    <div class="panel-options">
        <span class="panel-code"><?php echo $document_header_name; ?></span>
    </div>
	</div>

	<div class="panel-body">
		<?php $this->load->view('includes/steps', $data); ?>
    	<?php $this->load->view('includes/completion-status', $data); ?>


    	<div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                  
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-8">
                                            <h4 class="step-title"> Organisation <!--<span class="tooltip-toggle help-icon">--></span></h4>
                                          </div>
                                          
                                        </div>
                                          
                                      </div>
                                  </div>
                                </div>



                              <div class="row content text-left hidden-xs">
                                <div class="col-xs-4"><label for="" class="control-label">Name</label></div>
                                <div class="col-xs-3"><label for="" class="control-label">Role</label></div>
                                <div class="col-xs-3"><label for="" class="control-label">Email</label></div>
                                <div class="col-xs-2"><label for="" class="control-label">Commitment</label></div>
                              </div>


                            <div id="organisation-table" class="dynamic-row">
                                <?php foreach($organisations as $organisation){ ?>
                                <?php
                                  //var_dump($organisations);
                                  $name = $organisation['name'];
                                  $role = $organisation['role'];
                                  $role_value = $organisation['role_value'];
                                  $email = $organisation['email'];
                                  $commitment = $organisation['commitment'];
                                  $other = $organisation['other'];
                                ?>
                                  <div class="row content">
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Name</label></div>
                                    <div class="col-sm-4 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="name[]" value="<?php echo $name; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Role</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="role-form-group form-group">
                                      <?php if($other != '') { ?>
                                        <select class="form-control role-select hidden" name="role[]">
                                          <?php echo $role; ?>
                                        </select>
                                        <div class="organisation-other input-group">
                                           <input type="text" class="form-control" name="organisation_role[]" value="<?php echo $other?>">
                                          <span class="backtoselect input-group-addon btn" data-toggle="tooltip" data-placement="top" title="Back to Select">X</span>
                                        </div>
                                        <?php } else { ?>
                                        <select class="form-control role-select" name="role[]">
                                          <?php echo $role; ?>
                                        </select>
                                        <div class="organisation-other input-group hidden">
                                           <input type="text" class="form-control" name="organisation_role[]" value="<?php echo $other?>">
                                          <span class="backtoselect input-group-addon btn" data-toggle="tooltip" data-placement="top" title="Back to Select">X</span>
                                        </div>
                                        <?php } ?>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Email</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="email[]" value="<?php echo $email; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Commitment</label></div>
                                    <div class="col-sm-2 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="commitment[]" value="<?php echo $commitment; ?>">
                                      </div>
                                    </div>

                                    <div class="row visible-xs">
                                      <div class="col-xs-12"><hr></div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </div>

                              <!-- REPORTING -->
                              <div class="row content custom-tooltip-container generic-tooltip generic-large">
                                <div class="col-xs-12">
                                    <div class="page-header">
                                        <h4 class="step-title">Reporting <i class="fa fa-question-circle text-success pp-reporting-popover"></i></h4>
                                    </div>
                                </div>
                              </div>



                              <div class="row content text-left hidden-xs">
                                <div class="col-xs-3"><label for="" class="control-label">Originator</label></div>
                                <div class="col-xs-3"><label for="" class="control-label">Receiver</label></div>
                                <div class="col-xs-3"><label for="" class="control-label">Frequency</label></div>
                                <div class="col-xs-3"><label for="" class="control-label">Format</label></div>
                              </div>


                              <div id="reporting-table" class="dynamic-row">
                                <?php foreach($reporting as $report){ ?>
                                <?php
                                  $originator = $report['originator'];
                                  $receiver = $report['receiver'];
                                  $frequency = $report['frequency'];
                                  $format = $report['format'];
                                ?>
                                  <div class="row content">
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Originator</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="originator[]" value="<?php echo $originator; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Receiver</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="receiver[]" value="<?php echo $receiver; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Frequency</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <select class="form-control" name="reporting_frequency[]">
                                          <?php echo $frequency; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Format</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <select class="form-control" name="format[]">
                                          <?php echo $format; ?>
                                        </select>
                                      </div>
                                    </div>

                                    <div class="row visible-xs">
                                      <div class="col-xs-12"><hr></div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </div>










                                <!-- MEETING -->
                              <div class="row content custom-tooltip-container generic-tooltip generic-large">
                                <div class="col-xs-12">
                                    <div class="page-header">
                                        <h4 class="step-title">Meetings <!--<span class="tooltip-toggle help-icon"></span>--></h4>
                                    </div>
                                </div>
                              </div>



                              <div class="row content text-left hidden-xs">
                                <div class="col-xs-3"><label for="" class="control-label">Attendees</label></div>
                                <div class="col-xs-3"><label for="" class="control-label">Agenda</label></div>
                                <div class="col-xs-3"><label for="" class="control-label">Frequency</label></div>
                                <div class="col-xs-3"><label for="" class="control-label">Location</label></div>
                              </div>


                            <div id="meeting-table" class="dynamic-row">
                                <?php foreach($meetings as $meeting){ ?>
                                <?php
                                  $attendees = $meeting['attendees'];
                                  $agenda = $meeting['agenda'];
                                  $frequency = $meeting['frequency'];
                                  $location = $meeting['location'];
                                ?>
                                  <div class="row content">
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Attendees</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="attendees[]" value="<?php echo $attendees; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Agenda</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="agenda[]" value="<?php echo $agenda; ?>">
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Frequency</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <select class="form-control" name="meeting_frequency[]">
                                          <?php echo $frequency; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 visible-xs"><label for="" class="control-label">Location</label></div>
                                    <div class="col-sm-3 col-xs-12">
                                      <div class="form-group">
                                        <input type="text" class="form-control" name="location[]" value="<?php echo $location; ?>">
                                      </div>
                                    </div>

                                    <div class="row visible-xs">
                                      <div class="col-xs-12"><hr></div>
                                    </div>
                                  </div>
                                <?php } ?>
                              </div>
	</div>




	<?php $this->load->view('includes/casefile-footer', $data); ?>
	<?php echo form_close(); ?>
</div>