<?php
  
  if($session_site_role != 'siteadmin'){
    $create_display = 'hidden';
  }else{
    $create_display = '';
  }

?>


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
        <h4 class="modal-title" id="myModalLabel">Criticality Analysis</h4>
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
              <div class="row">

                <div class="col-sm-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="pce" value="1"> <p class="strong">PCE</p>
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="sce" value="1"> <p class="strong">SCE</p>
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ece" value="1"> <p class="strong">ECE</p>
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="sis" value="1"> <p class="strong">SiS</p>
                    </label>
                  </div>
                </div>

              </div>
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
              <input type="text" class="form-control" name="tag_number" value="" required>
            </div>
            <div class="col-xs-6">
              <input type="text" class="form-control" name="description" value="" required>
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Equipment Code</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Group</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control" name="equipment_code" value="">
            </div>
            <div class="col-xs-6">
              <select name="group" id="group" class="form-control" required>
                <?php echo $group_dropdown; ?>
                <option value="other">Other</option>
              </select>
              <div id="freetext" class="input-group hidden">
                <input name="new_group" type="text" class="form-control" required>
                <span id="backtoselect" class="input-group-addon btn" data-toggle="tooltip" data-placement="top" title="Back to Select">X</span>
              </div>
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
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                  <div class="row">
                    <div class="col-sm-4">
                      <h2 class="step-title align-title">Criticality Analysis </h2>
                    </div>
                    <div class="col-sm-8">
                      <a class="btn btn-primary pull-right create-criticality-analysis <?php echo $create_display; ?>"><span class="glyphicon glyphicon-plus"></span> Criticality Analysis</a>
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
                            
                            

                            <div id="my-criticality-analysis" class="row-table table-responsive">


                              
                                <table  class="table table-bordered my-account sticky-thead">
                                  <thead>
                                    <tr>
                                      <th class="work-order">Asset</th>
                                      <th class="job-description">Tag No.</th>
                                      <th class="specialist-requirement">Description</th>
                                      <th class="date">Red'cy</th>
                                      <th class="status">Safety</th>
                                      <th class="status">Enviro</th>
                                      <th class="status">Oper</th>
                                      <th class="status">Reinst</th>
                                      <th class="status">CAS</th>
                                      <th class="status">Insp.Freq.</th>
                                      <th class="pce">PCE</th>
                                      <th class="sce">SCE</th>
                                      <th class="ece">ECE</th>
                                      <th class="sis">SIS</th>
                                      <th class="sis">MEX</th>
                                      <th class="sis">EEX</th>
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