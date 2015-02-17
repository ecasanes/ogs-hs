<?php
  
  if($session_site_role != 'siteadmin'){
    $create_display = 'hidden';
  }else{
    $create_display = '';
  }

?>


<section id="main-content">
    <div class="container">
        <div class="row custom-tooltip-container generic-tooltip">
            <div class="custom-tooltip">
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                  <div class="row">
                    <div class="col-sm-4">
                      <h2 class="step-title align-title">Failure Rate</span></h2>
                    </div>
                    <div class="col-sm-8"></div>
                  </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">




        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">


                    <div class="panel-body">
                        <div class="tab-content form-tabs">
                            <div class="tab-pane active" id="tab1">
              

                              <?php
                                $attributes = array( 'role'=>'form' , 'id' => 'filter-criticality-analysis-form', 'class' => '' );
                                echo form_open('', $attributes);
                                echo form_hidden('current_user_id', $current_user_id);
                              ?>

                                <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                  <div class="custom-tooltip">
                                    <p>
                                      
                                    </p>
                                  </div>
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="col-xs-2 column-label">
                                              <p class="strong">Asset:</p>
                                            </div>
                                            <div class="col-xs-3">
                                              <select name="filter_asset" class="form-control">
                                                <?php echo $criticality_asset; ?>
                                              </select>
                                            </div>
                                            <div class="col-xs-2 column-label">
                                              <p class="strong">Equipment Code:</p>
                                            </div>
                                            <div class="col-xs-3">
                                              <input type="text" class="form-control" name="filter_code">
                                            </div>
                                            <div class="col-xs-2">
                                              <button id="export-criticality-analysis" type="button" class="export-csv btn btn-success btn-block btn-normal" data-toggle="tooltip" data-placement="top" title="export to CSV"><span class="glyphicon glyphicon-floppy-save"></span> CSV</button>
                                            </div>
                                          </div>
                                          </div>
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="col-xs-2 column-label">
                                              <p class="strong">Last Review Date:</p>
                                            </div>
                                            <div class="col-sm-3">
                                              <select name="filter_last_review_date" class="form-control">
                                                <?php echo $criticality_last_review_date; ?>
                                              </select>
                                            </div>
                                            <div class="col-sm-2 column-label">
                                              <p class="strong">Category:</p>
                                            </div>
                                            <div class="col-xs-3">
                                              <?php 
                                                foreach($criticality_equipment_category as $item):
                                                ?>
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" name="filter_category[]" value="<?php echo $item->menu_id; ?>"> <p class="strong"><?php echo $item->name; ?></p>
                                                    </label>
                                                  </div>
                                                <?php
                                                endforeach;
                                              ?>
                                              
                                            </div>
                                            <div class="col-sm-2">
                                              <button type="submit" class="btn btn-primary btn-block btn-normal"><span class="glyphicon glyphicon-search"></span> Filter</button>
                                            </div>
                                          </div>
                                        </div>
                                  </div>
                                </div>

                              <?php echo form_close(); ?>






                            <div id="no-criticality-analysis" class="hidden">
                              <p>There are no Criticality Analysis created. <a class="create-criticality-analysis" href="#">  Create One</a></p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>There are no Criticality Analysis found. </p>
                            </div>

                            <div id="loading-criticality-analysis" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Criticality Analysis...
                            </div>
                            
                            

                            <div id="failure-rate" class="row-table table-responsive">


                              
                                <table  class="table table-bordered my-account sticky-thead table-condensed">
                                  <thead>
                                    <tr>
                                      <th class="work-order">Asset</th>
                                      <th class="job-description">Tag No.</th>
                                      <th class="specialist-requirement">Description</th>
                                      <th class="start-date">Start Date</th>
                                      <th class="failure-rate"><center><img src="../images/lambda.png" width="20" height="20"><a class="mini-tooltip lambda-failure-rate-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></a></center></th>
                                      <th class="mtbf">MTBF <a class="mini-tooltip mtbf-failure-rate-tooltip pull-right" data-toggle="popover"><i class="fa fa-question-circle"></a></th>
                                      <th class="mttr">MTTR <a class="mini-tooltip mttr-failure-rate-tooltip pull-right" data-toggle="popover"><i class="fa fa-question-circle"></a></th>
                                      <th class="fail-date">Fail Date</th>
                                      <th class="repair-date">Repair Date</th>
                                      <th class="estimated-repair-time">Est. Repair Time</th>
                                      <th class="actual-repair-time">Actual Repair Time</th>
                                      <th class="text-center action">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                                </table>
                              </div>                              

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</section>