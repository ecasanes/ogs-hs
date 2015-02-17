<?php
  $attributes = array( 'role'=>'form' , 'id' => 'filter-criticality-analysis-form', 'class' => 'form-horizontal' );
  echo form_open('', $attributes);
  echo form_hidden('current_user_id', $current_user_id);
?>
<div class="panel panel-info collapsed">

  <div class="panel-heading">
    <h4 class="panel-title">Filter Criticality Spares Analysis</h4>
    <div class="panel-options">
      <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
    </div>
  </div>
  <div class="panel-body" style="display:none;">
    <!-- START PANEL -->
    <div class="row">
      <div class="col-sm-12">
        <div class="form-group">
          <div class="col-sm-2 col-xs-12 column-label">
            <label for="" class="control-label">Asset:</label>
          </div>
          <div class="col-sm-3 col-xs-12">
            <select name="filter_asset" class="form-control">
              <?php echo $criticality_asset; ?>
            </select>
          </div>
          <div class="row visible-xs">
            <div class="col-xs-12"><br></div>
          </div>
          <div class="col-sm-2 col-xs-12 column-label">
            <label for="" class="control-label">Equipment Code:</label>
          </div>
          <div class="col-sm-3 col-xs-12">
            <input type="text" class="form-control" name="filter_code">
          </div>
          <div class="col-sm-2 col-xs-12">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="form-group">
          <div class="col-sm-2 col-xs-12 column-label">
            <label for="" class="control-label">Last Review Date:</label>
          </div>
          <div class="col-sm-3 col-xs-12">
            <select name="filter_last_review_date" class="form-control">
              <?php echo $criticality_last_review_date; ?>
            </select>
          </div>
          <div class="row visible-xs">
            <div class="col-xs-12"><br></div>
          </div>
          <div class="col-sm-2 col-xs-12 column-label">
            <label for="" class="control-label">Category:</label>
          </div>
          <div class="col-sm-3 col-xs-12">
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
          </div>
        </div>
      </div>
      
    </div>

    <!-- END PANEL -->
  </div>
  <div class="panel-footer bg-panel-grey" style="display:none;">
    <div class="row">

      <div class="col-xs-12 col-sm-2 pull-right">
        <button type="submit" class="btn btn-primary btn-block btn-normal"><span class="glyphicon glyphicon-search"></span> Filter</button>
      </div>
      <div class="row visible-xs">
        <div class="col-xs-12"><br></div>
      </div>
      <div class="col-xs-12 col-sm-2 pull-right">
        <button id="export-single-index" type="button" class="export-csv btn btn-success btn-block btn-normal" data-toggle="tooltip" data-placement="top" title="export to CSV"><span class="glyphicon glyphicon-floppy-save"></span> CSV</button>
      </div>
      
    </div>
  </div>
  
</div>
<?php echo form_close(); ?>

<div class="panel panel-default">
  <div class="panel-heading">
    Criticality Spares Analysis
    <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
    </div>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-12">
        <div id="no-criticality-analysis" class="hidden">
                              <p>There are no Criticality Analysis created. <a class="create-criticality-analysis" href="#">  Create One</a></p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>There are no Criticality Analysis found. </p>
                            </div>

                            <div id="loading-criticality-analysis" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Criticality Analysis...
                            </div>
                            
                            

                            <div id="my-criticality-analysis" class="row-table table-responsive horizontal-overflow-scroll">


                              
                                <table  class="table table-bordered my-account sticky-thead">
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
                                      <th class="pce">Recommended Stock Level</th>
                                      <th class="sce">Value of Recommended Inventory</th>
                                      <th class="ece">Value of Potential Production Loss</th>
                                      <th class="sis">Action</th>
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