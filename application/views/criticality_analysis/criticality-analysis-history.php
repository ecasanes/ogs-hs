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
<div class="containter">  
<div class="col-xs-12">
      <div class="page-header">
        <div class="row">
          <div class="col-sm-4">
            <h2 class="step-title align-title">Equipment Status </h2>
          </div>
  </div>
  </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">
<!-- <div class="progress">
  <div class="progress-bar"  id="data-input-values-progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 1%;">
    <span class="sr-only">60% Complete</span>
  </div>
</div> -->


                    <div class="panel-body">
                        <div class="tab-content form-tabs">
                            <div class="tab-pane active" id="tab1">
              

                              <?php
                                $attributes = array( 'role'=>'form' , 'id' => 'filter-criticality-analysis-history-form', 'class' => 'form-horizontal form-group');
                                echo form_open('', $attributes);
                                echo form_hidden('current_user_id', $current_user_id);
                              ?>

                            
                                  <div class="col-xs-12 table-filter">
                                    <div class="col-sm-8">


                                        <div class="row">
                                          <div class="col-sm-1 column-label">
                                            <p class="strong">Asset:</p>
                                          </div>
                                          <div class="col-sm-2">
                                            <select name="asset" id="" class="form-control" <?php echo $asset_filter_disabled; ?>>
                                              <?php echo $asset_filter_default; ?>
                                              <?php echo $criticality_asset; ?>
                                            </select>
                                          </div>
                                          <div class="col-sm-2 column-label">
                                            <p class="strong">Date Range:</p>
                                          </div>
                                          <div class="col-sm-3">
                                            <div class="input-group">
                                                <input id="start_date_range" type="text" class="form-control" name="start_date">
                                                <span class="input-group-addon">to</span>
                                                <input id="end_date_range" type="text" class="form-control" name="end_date">
                                              </div>
                                          </div>
                                        </div>



                                        <div class="row">
                                          <div class="col-sm-1 column-label">
                                            <p class="strong">Code:</p>
                                          </div>
                                          <div class="col-sm-2">
                                            <input type="text" class="form-control" name="equipment_code" value="">
                                          </div>
                                          <div class="col-sm-2 column-label">
                                            <p class="strong">Last Review Date:</p>
                                          </div>
                                          <div class="col-sm-3">
                                            <select name="filter_last_review_date" class="form-control">
                                                <?php echo $criticality_last_review_date; ?>
                                              </select>
                                          </div>
                                        </div>




                                        <div class="row">
                                           <div class="col-sm-1 column-label">
                                            <p class="strong">Category:</p>
                                          </div>
                                          <div class="col-sm-4">
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


                              <?php echo form_close(); ?>






                            <div id="no-criticality-analysis-history" class="hidden">
                              <p>There are no Data Inputs created. <a class="create-criticality-analysis-history" href="#">  Create One</a></p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>Your search returned no result. </p>
                            </div>

                            <div id="loading-criticality-analysis-history" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Data Inputs...
                            </div>
                            
                            
                            <div id="data-view"></div>
                            <div id="my-criticality-analysis-history" class="row-table table-responsive">

                            


                              
                                <table id="criticality-analysis-data-input"  class="table table-bordered pull-left fixed-td-height sticky-thead">
                                  <thead>
                                    <tr>
                                      <th id="data-input-title" colspan="15" class="text-center">
                                        Criticality Analysis
                                      </th>
                                    <tr>
                                      <th>Asset</th>
                                      <th>Tag Number</th>
                                      <th>Description</th>
                                      <th>PCE</th>
                                      <th>SCE</th>
                                      <th>ECE</th>
                                      <th>SIS</th>
                                      <th>MEX</th>
                                      <th>EEX</th>
                                      <th>Focus</th>
                                      <th>CV</th>
                                      <th>OBS</th>
                                      <th>CAS</th>
                                      <th>Hrs</th>
                                      <th>Avail%</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>


                                </div>

                                <div id="loading-criticality-analysis-history_values" class="hidden">
                                  <i class="fa fa-refresh fa-spin text-center" id="data-input-values"></i>  Loading Data Values...
                                </div>

                                


                                <div class="sample pull-left">
                                  <div class="arrow-scroll">
                                    <span class="pull-left">&nbsp; <a href="" class="glyphicon glyphicon-arrow-left hidden"></a></span>
                                    <span class="pull-right"><a href="" class="glyphicon glyphicon-arrow-right hidden"></a>&nbsp; </span>
                                  </div>
                                <div id="criticality-analysis-per-day" class="pull-left">
                                  

                                  
                                <table class="table table-bordered pull-left fixed-td-height sticky-thead" id="table-daily-values-fixed">
                                  <thead>
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
        </div>



    </div>
</section>