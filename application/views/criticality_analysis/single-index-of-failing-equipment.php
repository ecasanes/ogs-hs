<?php

  if($asset_role == 'user'){
    $asset_filter_disabled = 'disabled';
    $asset_filter_default = '<option>'.$user_asset_value.'</option>';
  }else{
    $asset_filter_disabled = '';
    $asset_filter_default = '';
  }

?>

<section id="main-content">
    <div class="container">
        <div class="row custom-tooltip-container step-tooltip">
            <div class="custom-tooltip">
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                  <div class="row">
                    <div class="col-sm-6">
                      <h2 class="step-title align-title">Single Index of Failing Equipment</h2>
                    </div>
                    <div class="col-sm-6">
                     
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
                                              <p class="strong">Status:</p>
                                            </div>
                                            <div class="col-xs-8">
                                              <div class="row">
                                                <div class="col-xs-2">

                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" name="filter_status[]" value="505"> <p class="strong bg-green colored-label">OK</p>
                                                    </label>
                                                  </div>
                                                </div>
                                                <div class="col-xs-2">
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" name="filter_status[]" value="506"> <p class="strong bg-yellow colored-label">Alert</p>
                                                    </label>
                                                  </div>
                                                </div>
                                                <div class="col-xs-2">

                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" name="filter_status[]" value="507"> <p class="strong bg-orange colored-label">Warn</p>
                                                    </label>
                                                  </div>
                                                </div>
                                                <div class="col-xs-2">
                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" name="filter_status[]" value="508"> <p class="strong bg-red colored-label">Critical</p>
                                                    </label>
                                                  </div>
                                                </div>
                                                <div class="col-xs-2">

                                                  <div class="checkbox">
                                                    <label>
                                                      <input type="checkbox" name="filter_status[]" value="509"> <p class="strong bg-dark-red colored-label">Failed</p>
                                                    </label>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                            
                                          </div>
                                        </div>



                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="col-xs-2 column-label">
                                              <p class="strong">Category:</p>
                                            </div>
                                            <div class="col-xs-7">
                                              <div class="row">

                                                <?php 
                                                foreach($criticality_equipment_category as $item):
                                                ?>
                                                  <div class="col-xs-5">
                                                    <div class="checkbox">
                                                      <label>
                                                        <input type="checkbox" name="filter_category[]" value="<?php echo $item->menu_id; ?>"> <p class="strong"><?php echo $item->name; ?></p>
                                                      </label>
                                                    </div>
                                                  </div>
                                                <?php
                                                endforeach;
                                              ?>
                                                
                                              </div>
                                            </div>
                                            
                                            
                                          </div>
                                        </div>




                                        <div class="row">
                                          <div class="col-xs-12">
                                            <div class="col-xs-2 column-label">
                                              <p class="strong">Asset:</p>
                                            </div>
                                            <div class="col-xs-3">
                                              <select name="filter_asset" class="form-control" <?php echo $asset_filter_disabled; ?>>
                                                <?php echo $asset_filter_default; ?>
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
                                              <button id="export-single-index" type="button" class="export-csv btn btn-success btn-block btn-normal" data-toggle="tooltip" data-placement="top" title="export to CSV"><span class="glyphicon glyphicon-floppy-save"></span> CSV</button>
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
                                              <p class="strong">Owner:</p>
                                            </div>
                                            <div class="col-xs-3">
                                              <select name="filter_owner" class="form-control select2-dropdown">
                                                <?php echo $user_dropdown; ?>
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
                              <p>There are no Criticality Analysis created.</p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>There are no Criticality Analysis found. </p>
                            </div>

                            <div id="loading-criticality-analysis" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Criticality Analysis...
                            </div>
                            
                            

                            <div id="single-index-of-failing-equipment" class="row-table table-responsive sife">
                                <table  class="table table-bordered my-account sticky-thead">
                                  <thead>
                                    <tr>
                                      <th class="current-date text-center" colspan="16"><?php echo date('d-m-Y');?></th>
                                     </tr> 
                                    <tr>
                                      <th class="work-order">Asset</th>
                                      <th class="job-description">Tag No.</th>
                                      <th class="specialist-requirement">Description</th>
                                      <th class="code">Code</th>
                                      <th class="pce">PCE</th>
                                      <th class="sce">SCE</th>
                                      <th class="ece">ECE</th>
                                      <th class="sis">SIS</th>
                                      <th class="atex-m">MEX</th>
                                      <th class="atex-e">EEX</th>
                                      <th class="status">Status</th>
                                      <th class="criticality-value">CV</th>
                                      <th class="cas">CAS</th>
                                      <th class="owner">Owner <a class="mini-tooltip owner-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></i></a></th>
                                      <th class="defect-elimination">DECF <a class="mini-tooltip decf-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></i></a></th>
                                      <th class="project-plan">PP <a class="mini-tooltip pp-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></i></a></th>
                                      <th class="technical-bulletin">TB <a class="mini-tooltip tb-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></i></a></th>
                                      <th class="action">Action</th>
                                      <!-- <th class="status">Status</th> -->
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <!-- table body -->
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