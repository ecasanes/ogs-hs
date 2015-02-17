<?php

if($asset_role == 'user'){
  $asset_filter_disabled = 'disabled';
  $asset_filter_default = '<option>'.$user_asset_value.'</option>';
}else{
  $asset_filter_disabled = '';
  $asset_filter_default = '';
}

?>   

<?php
    $attributes = array( 'role'=>'form' , 'id' => 'filter-criticality-analysis-form', 'class' => 'form-horizontal' );
    echo form_open('', $attributes);
    echo form_hidden('current_user_id', $current_user_id);
    ?>
<div class="panel panel-info collapsed">

  <div class="panel-heading">
    <h4 class="panel-title">Filter Single Index of Failing Equipment</h4>
    <div class="panel-options">
      <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
    </div>
  </div>
  <div class="panel-body" style="display:none;">
    


    <div class="row">
      <div class="row form-group">
        <div class="col-xs-12">
        <div class="col-sm-2 col-xs-12 column-label">
          <label for="" class="control-label">Status:</label>
        </div>
        <div class="col-sm-8">
          <div class="row">
            <div class="col-sm-2 col-xs-12">

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="filter_status[]" value="505"> <p class="strong bg-green colored-label">OK</p>
                </label>
              </div>
            </div>
            <div class="col-sm-2 col-xs-12">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="filter_status[]" value="506"> <p class="strong bg-yellow colored-label">Alert</p>
                </label>
              </div>
            </div>
            <div class="col-sm-2 col-xs-12">

              <div class="checkbox">
                <label>
                  <input type="checkbox" name="filter_status[]" value="507"> <p class="strong bg-orange colored-label">Warn</p>
                </label>
              </div>
            </div>
            <div class="col-sm-2 col-xs-12">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="filter_status[]" value="508"> <p class="strong bg-red colored-label">Critical</p>
                </label>
              </div>
            </div>
            <div class="col-sm-2 col-xs-12">

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
      
    </div>



    <div class="row">
      <div class="row form-group">
        <div class="col-xs-12">
          <div class="col-sm-2 col-xs-12 column-label">
            <label for="" class="control-label">Category:</label>
          </div>
          <div class="col-sm-7 col-xs-12">
            <div class="row">

              <?php 
              foreach($criticality_equipment_category as $item):
                ?>
              <div class="col-sm-5 col-xs-12">
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
        
    </div>




    <div class="row">
      <div class="row form-group">
        <div class="col-xs-12">
          <div class="col-sm-2 col-xs-12 column-label">
            <label for="" class="control-label">Asset:</label>
          </div>
          <div class="col-sm-3 col-xs-12">
            <select name="filter_asset" class="form-control" <?php echo $asset_filter_disabled; ?>>
              <?php echo $asset_filter_default; ?>
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
      <div class="row form-group">
        <div class="col-xs-12">
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
            <label for="" class="control-label">Owner:</label>
          </div>
          <div class="col-sm-3 col-xs-12">
            <select name="filter_owner" class="form-control select2-dropdown">
              <?php echo $user_dropdown; ?>
            </select>
          </div>
          <div class="col-sm-2 col-xs-12">

          </div>
        </div>
      </div>
    </div>
      
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
    Single Index of Failing Equipment
    <div class="panel-options">
      <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
    </div>
  </div>
  <div class="panel-body">
    <!-- START PANEL -->
    <div id="no-criticality-analysis" class="hidden">
                              <p>There are no Criticality Analysis created.</p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>There are no Criticality Analysis found. </p>
                            </div>

                            <div id="loading-criticality-analysis" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Criticality Analysis...
                            </div>
                            
                            

                            <div id="single-index-of-failing-equipment" class="row-table table-responsive sife horizontal-overflow-scroll">
                                <table  class="table table-bordered my-account sticky-thead table-condensed">
                                  <thead>
                                    <tr>
                                      <th class="current-date text-center" colspan="18"><?php echo date('d-m-Y');?></th>
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
    <!-- END PANEL -->
  </div>
</div>