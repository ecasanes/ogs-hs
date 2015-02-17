<!-- Create Criticality Analysis Modal -->
<div class="modal fade" id="create-criticality-analysis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'create-criticality-analysis-form', 'class' => '' );
            echo form_open('criticality-analysis/create', $attributes); 
            echo form_hidden('current_user_id', $current_user_id);
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Single Index of Failing Equipment</h4>
      </div>
      
      <div class="modal-body">
        
          
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Asset</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Category</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <select name="asset" id="" class="form-control">
                <?php echo $criticality_asset; ?>
              </select>
            </div>
            <div class="col-xs-8">
              <select name="category" id="" class="form-control">
                <?php echo $criticality_equipment_category; ?>
              </select>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Tag Number</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Description</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control" name="tag_number" value="">
            </div>
            <div class="col-xs-6">
              <input type="text" class="form-control" name="description" value="">
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Equipment Code</p>
            </div>
            <div class="col-xs-6">
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control" name="equipment_code" value="">
            </div>
            <div class="col-xs-6">
            </div>
          </div>
          <br>
          
          <!-- <br>
          
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Environmental Criticality</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Operational Criticality</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="environmental_criticality" id="" class="form-control">
                <?php echo $criticality_environment; ?>
              </select>
            </div>
            <div class="col-xs-6">
              <select name="operational_criticality" class="form-control">
                <?php echo $criticality_operation; ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Reinstatement</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="reinstatement" class="form-control">
                <?php echo $criticality_reinstatement; ?>
              </select>
            </div>
          </div>
          <br>    --> 
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
         <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
      <?php echo form_close(); ?> 
    </div>
  </div>
</div>
<!-- End Create Modal -->


<!-- Edit Criticality Analysis Modal -->
<div class="modal fade" id="edit-criticality-analysis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'edit-criticality-analysis-form', 'class' => '' );
            echo form_open('criticality-analysis/update', $attributes);
            echo form_hidden('criticality_analysis_id', '');
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Criticality Analysis</h4>
      </div>
      
       <div class="modal-body">
        
          
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Asset</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Tag Number</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="asset" id="" class="form-control">
                <?php echo $criticality_asset; ?>
              </select>
            </div>
            <div class="col-xs-6">
              <input type="text" class="form-control " name="tag_number" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Description:</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input class="form-control" type="text" name="description" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Reliability Redundancy</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Safety Health Criticality</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="reliability_redundancy" class="form-control">
                <?php echo $criticality_redundancy; ?>
              </select>
            </div>
            <div class="col-xs-6">
              <select name="safety_health_criticality" class="form-control">
                <?php echo $criticality_safety; ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Environmental Criticality</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Operational Criticality</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="environmental_criticality" id="" class="form-control">
                <?php echo $criticality_environment; ?>
              </select>
            </div>
            <div class="col-xs-6">
              <select name="operational_criticality" class="form-control">
                <?php echo $criticality_operation; ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Reinstatement</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="reinstatement" class="form-control">
                <?php echo $criticality_reinstatement; ?>
              </select>
            </div>
          </div>
          <br>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
         <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>


<section id="main-content">
    <div class="container">
        <div class="row custom-tooltip-container step-tooltip">
            <div class="custom-tooltip">
                                    <p>
                                      <strong>Status Colors:</strong>
                                    </p>
                                    <table>
                                      <tr>
                                        <td class="bg-green status-legend"></td>
                                        <td>&nbsp;-&nbsp;</td>
                                        <td>Open</td>
                                      </tr>
                                      <tr>
                                        <td class="bg-red status-legend"></td>
                                        <td>&nbsp;-&nbsp;</td>
                                        <td>Closed</td>
                                      </tr>
                                      <tr>
                                        <td class="bg-orange status-legend"></td>
                                        <td>&nbsp;-&nbsp;</td>
                                        <td>Due</td>
                                      </tr>

                                    </table>
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                  <div class="row">
                    <div class="col-sm-6">
                      <h2 class="step-title align-title">Critical Spare Analysis</h2>
                    </div>
                    <div class="col-sm-6">
                      <a class="btn btn-primary pull-right create-criticality-analysis"><span class="glyphicon glyphicon-plus"></span> Criticality Analysis</a>
                    </div>
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
                                            <div class="col-xs-2">
                                              <select name="filter_asset" class="form-control">
                                                <?php echo $criticality_asset; ?>
                                              </select>
                                            </div>
                                            <div class="col-xs-2 column-label">
                                              <p class="strong">Description:</p>
                                            </div>
                                            <div class="col-xs-4">
                                              <select name="filter_category" id="" class="form-control">
                                                <?php echo $criticality_equipment_category; ?>
                                              </select>
                                            </div>
                                          </div>
                                          </div>
                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="col-xs-2 column-label">
                                              <p class="strong">Equipment Code:</p>
                                            </div>
                                            <div class="col-sm-2">
                                              <input type="text" class="form-control" name="filter_code">
                                            </div>
                                            <div class="col-sm-2 column-label">
                                              <p class="strong">Last Review Date:</p>
                                            </div>
                                            <div class="col-xs-4">
                                              <select name="filter_last_review_date" class="form-control">
                                                <?php echo $criticality_last_review_date; ?>
                                              </select>
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
                              <p>There are no Criticality Analysiss created. <a class="create-criticality-analysis" href="#">  Create One</a></p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>There are no Criticality Analysis found. </p>
                            </div>

                            <div id="loading-criticality-analysis" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Criticality Analysiss...
                            </div>
                            
                            

                            <div id="my-criticality-analysis" class="row-table table-responsive">


                              
                                <table  class="table table-bordered my-account">
                                  <thead>
                                    <tr>
                                      <th class="work-order">Asset</th>
                                      <th class="job-description">Tag No.</th>
                                      <th class="specialist-requirement">Description</th>
                                      <th class="date">T(Hrs/Yr)</th>
                                      <th class="status">Service Life</th>
                                      <th class="status">No. of Units Installed on Asset</th>
                                      <th class="status">Lead time on Spares(Months)</th>
                                      <th class="status">Price of Required spare parts</th>
                                      <th class="status">TDR per anum</th>
                                      <th class="status">Freq. of Use</th>
                                      <th class="status">Recommended Stock Level</th>
                                      <th class="status">Value of Recommended Inventory</th>
                                      <th class="status">Value of Potential Production Loss</th>
                                      <th class="text-center action">Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                                </table>
                              </div>

                              

                              <!-- Januray Data -->
                              <!-- <h2 class="title-align">January Data</h2>
                              <div class="row-table table-responsive scroll-table">
                              
                                <table class="table table-bordered">
                                  <tr>
                                    <td colspan="9"></td>
                                    <td colspan="3"><center>1st</center></td>
                                    <td colspan="3"><center>2nd</center></td>
                                    <td colspan="3"><center>3rd</center></td>
                                    <td colspan="3"><center>4th</center></td>
                                    <td colspan="3"><center>5th</center></td>
                                    <td colspan="3"><center>6th</center></td>
                                    <td colspan="3"><center>7th</center></td>
                                    <td colspan="3"><center>8th</center></td>
                                    <td colspan="3"><center>9th</center></td>
                                    <td colspan="3"><center>10th</center></td>                                  
                                  </tr>
                                  <tr>
                                    <td>Asset</td>
                                    <td>Tag No</td>
                                    <td>Description</td>
                                    <td>Alert</td>
                                    <td>Critical Value</td>
                                    <td>OBS</td>
                                    <td>CAS</td>
                                    <td>Hrs/Month</td>
                                    <td>Aval%</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                    <td>SPF</td>
                                    <td>Avail</td>
                                    <td>Status</td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                    <td>
                                      <select class="form-control">
                                        
                                      </select>
                                    </td>
                                  </tr>
                                </table>
                              </div> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</section>