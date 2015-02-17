  <style type="text/css">
      /*
   *  Usage:
   *
   *    <div class="sk-spinner sk-spinner-wave">
   *      <div class="sk-rect1"></div>
   *      <div class="sk-rect2"></div>
   *      <div class="sk-rect3"></div>
   *      <div class="sk-rect4"></div>
   *      <div class="sk-rect5"></div>
   *    </div>
   *
   */
  .sk-spinner-wave.sk-spinner {
    margin: 0 auto;
    width: 60px;
    height: 40px;
    text-align: center;
    font-size: 10px; }
  .sk-spinner-wave div {
    background-color: #333;
    height: 100%;
    width: 6px;
    display: inline-block;
    -webkit-animation: sk-waveStretchDelay 1.2s infinite ease-in-out;
            animation: sk-waveStretchDelay 1.2s infinite ease-in-out; }
  .sk-spinner-wave .sk-rect2 {
    -webkit-animation-delay: -1.1s;
            animation-delay: -1.1s; }
  .sk-spinner-wave .sk-rect3 {
    -webkit-animation-delay: -1s;
            animation-delay: -1s; }
  .sk-spinner-wave .sk-rect4 {
    -webkit-animation-delay: -0.9s;
            animation-delay: -0.9s; }
  .sk-spinner-wave .sk-rect5 {
    -webkit-animation-delay: -0.8s;
            animation-delay: -0.8s; }

  @-webkit-keyframes sk-waveStretchDelay {
    0%, 40%, 100% {
      -webkit-transform: scaleY(0.4);
              transform: scaleY(0.4); }

    20% {
      -webkit-transform: scaleY(1);
              transform: scaleY(1); } }

  @keyframes sk-waveStretchDelay {
    0%, 40%, 100% {
      -webkit-transform: scaleY(0.4);
              transform: scaleY(0.4); }

    20% {
      -webkit-transform: scaleY(1);
              transform: scaleY(1); } }

</style>

<!-- Start of CAS Modal -->
<div class="modal fade" id="cas-details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div  class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Criticality Analysis Scoring Details</h4>
      </div>
      <div id="loading-ca-details" class="modal-body">
          <i class="fa fa-refresh fa-spin"></i> Loading Details...
        </div>
      <div id="ca-details-content" class="modal-body-container">

      </div>
      
    </div>
  </div>
</div>


<!-- Panel for Filter -->

<div class="panel panel-info">

  <?php echo form_open('', array('id' => 'filter-ca-stage-form')); ?>

  <div class="panel-heading">
    <h3 class="panel-title">Filter List</h3>
  </div>
  <div class="panel-body">
    <div class="form-group form-horizontal"> 
    <div class="col-xs-1">
      <label class="control-label">Filter: </label>
    </div>
    <div class="col-xs-4">
      <select name="main_filter" id="main-filter" class="form-control">
          <option value="awaiting_analysis" data-value="Unanalyzed">Awaiting Analysis</option>
          <option value="analysed" data-value="Analyzed">Analyzed</option>
        </select>
    </div>
    </div>
  </div>

  <div class="panel-footer" style="height: 50px;">
    <div class="col-xs-12">
      <div class="pull-right" role="group" aria-label="...">
        <?php
          if($method == 'stage-new'){
            $view_link = base_url('criticality-analysis/stage');
            $view_title = "Default View";
          }else{
            $view_link = base_url('criticality-analysis/stage-new');
            $view_title = "Sortable View";
          }
        ?>
        <a class="btn btn-primary" href="<?php echo $view_link; ?>"><span class="glyphicon glyphicon-list"></span> <?php echo $view_title; ?></a>
        <button type="text" class="btn btn-warning" id="csv-generate"><span class="glyphicon glyphicon-list-alt"></span> Generate CSV</button>
        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span> Filter</button>
      </div>
    </div>
  </div>

  <?php echo form_close(); ?>

</div>
<!-- End of Panel Filter -->

<!-- START - LOADING - CALCULATE_SCORING -->
<div class="modal fade" id="csv-export-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-xs-4 text-right" id="loading-animation">

            <div id="loading-spinner">
              <div class="sk-spinner sk-spinner-wave">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
              </div>
            </div>
            

            <div id="loading-gear">
              <i class="fa fa-cog fa-spin fa-3x"></i>
            </div>
          
          </div>
          <div class="col-xs-8">
            <h4>Generating CSV Report</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END - LOADING CALCULATE_SCORING -->


<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Criticality Analysis Stage - ONE</h3>
	</div>

	<div class="panel-body">
    <div id="loading-cas-list" class="hidden">
      <i class="fa fa-refresh fa-spin"></i> Loading List...
    </div>
    <div id="cas-list">
      
    </div>
	</div>

</div>