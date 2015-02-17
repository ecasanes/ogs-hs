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
                      <h2 class="step-title align-title">Compliance Dashboard</h2>
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
                                              <p class="strong">Asset:</p>
                                            </div>
                                            <div class="col-xs-2">
                                              <select name="filter_asset" class="form-control">
                                                <?php echo $criticality_asset; ?>
                                              </select>
                                            </div>
                                            <div class="col-xs-2 column-label">
                                              <p class="strong">Equipment Code:</p>
                                            </div>
                                            <div class="col-xs-4">
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
                                            <div class="col-sm-2">
                                              <select name="filter_last_review_date" class="form-control">
                                                <?php echo $criticality_last_review_date; ?>
                                              </select>
                                            </div>
                                            <div class="col-sm-2 column-label">
                                              <p class="strong">Category:</p>
                                            </div>
                                            <div class="col-xs-4">
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

                            

                            <div id="no-search-found" class="hidden">
                              <p>There are no Criticality Analysis found. </p>
                            </div>

                            <div id="loading-criticality-analysis" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Criticality Analysiss...
                            </div>
                            
                            

                            <div id="compliance-dashboard" class="row-table table-responsive sife">
                                <table  class="table table-bordered my-account">
                                  <thead>
                                    <tr>
                                      <th class="current-date text-center" colspan="12"><?php echo date('d-m-Y');?></th>
                                    </tr>
                                    <tr>
                                      <th>Asset</th>
                                      <th>Tag No.</th>
                                      <th>Description</th>
                                      <th class="pce">PCE</th>
                                      <th class="sce">SCE</th>
                                      <th class="ece">ECE</th>
                                      <th class="sis">SIS</th>
                                      <th>Perf. Standard (%)</th>
                                      <th>Available</th>
                                      <th>Resultant</th>
                                      <th>Compliant</th>
                                      <th></th>
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