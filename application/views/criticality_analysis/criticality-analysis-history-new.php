<?php

  if($asset_role == 'user'){
    $asset_filter_disabled = 'disabled';
    $asset_filter_default = '<option>'.$user_asset_value.'</option>';
  }else{
    $asset_filter_disabled = '';
    $asset_filter_default = '';
  }

?>

<div class="row">
	<div class="col-xs-12">
		<?php
			$attributes = array( 'role'=>'form' , 'id' => 'filter-criticality-analysis-history-form', 'class' => 'form-horizontal');
            echo form_open('', $attributes);
            echo form_hidden('current_user_id', $current_user_id);
        ?>
		<div class="panel panel-primary collapsed">
			<div class="panel-heading">
				<h4 class="panel-title">Filter Equipment Status</h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
				</div>
			</div>
			<div class="panel-body" style="display:none;">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="col-sm-2 col-xs-12">
			            		<label for="" class="control-label">Asset</label>
							</div>
	                        <div class="col-sm-4 col-xs-12">
	                            <select name="asset" id="" class="form-control" <?php echo $asset_filter_disabled; ?>>
                                    <?php echo $asset_filter_default; ?>
                                	<?php echo $criticality_asset; ?>
                                </select>
	                        </div>
	                        <div class="col-sm-2 col-xs-12">
		            			<label for="" class="control-label">Date Range</label>
							</div>
                       		<div class="col-sm-4 col-xs-12">
                            	<div class="input-group">
                                    <input id="start_date_range" type="text" class="form-control" name="start_date">
                                    <span class="input-group-addon">to</span>
                                	<input id="end_date_range" type="text" class="form-control" name="end_date">
                                </div>
                        	</div>
                        	<div class="col-sm-12 hidden-xs">&nbsp;</div>
                        	<div class="col-sm-2 col-xs-12">
		            			<label for="" class="control-label">Code</label>
							</div>
                       		<div class="col-sm-4 col-xs-12">
                            	<input type="text" class="form-control" name="equipment_code" value="">
                        	</div>
                        	<div class="col-sm-2 col-xs-12">
		            			<label for="" class="control-label">Last Review Date</label>
							</div>
                       		<div class="col-sm-4 col-xs-12">
                                <select name="filter_last_review_date" class="form-control">
	                            	<?php echo $criticality_last_review_date; ?>
								</select>
                        	</div>
                        	<div class="col-sm-12 hidden-xs">&nbsp;</div>
                        	<div class="col-sm-2 col-xs-12">
		            			<label for="" class="control-label">Category</label>
							</div>
							<div class="col-sm-10 col-xs-12">
								<div class="row">
								<?php foreach($criticality_equipment_category as $item): ?>
                                	<div class="col-sm-4 col-xs-12">
                                		<div class="checkbox">
                                        	<label>
                                            	<input type="checkbox" name="filter_category[]" value="<?php echo $item->menu_id; ?>"> <p class="strong"><?php echo $item->name; ?></p>
                                            </label>
                                        </div>
                                    </div>
                                                
                                <?php endforeach;?>
                            	</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer bg-panel-grey" style="display:none;">
				<div class="form-group">
					<div class="col-sm-offset-10 col-sm-2 text-right">
						<button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search"></span> Filter</button>
					</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
	</div>



	<div class="col-sm-8 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Equipment Status</h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<div id="no-criticality-analysis-history" class="hidden">
                	<p>There are no Data Inputs created. <a class="create-criticality-analysis-history" href="#">  Create One</a></p>
                </div>

                <div id="" class="hidden no-search-found-equipment-status">
                	<p>Your search returned no result. </p>
                </div>

                <div id="loading-criticality-analysis-history" class="hidden">
                	<i class="fa fa-refresh fa-spin"></i>  Loading Data Inputs...
                </div>

                <div id="my-criticality-analysis-history" class="text-center horizontal-overflow-scroll">
                	<table id="criticality-analysis-data-input"  class="table table-bordered pull-left fixed-td-height sticky-thead table-condensed">
                        <thead>
                        	<tr>
                            	<th id="data-input-title" colspan="15" class="text-center">Criticality Analysis</th>
							</tr>
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
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-xs-12">
		<div class="panel panel-default date-panel">
			<div class="panel-heading">
				<h4 class="panel-title">Date</h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<div id="loading-criticality-analysis-history_values" class="hidden">
					<i class="fa fa-refresh fa-spin text-center" id="data-input-values"></i>  Loading Data Values...
                </div>
                <div id="" class="hidden no-search-found-equipment-status">
                	<p>Your search returned no result. </p>
                </div>
                <div class="sample">
               		<div class="arrow-scroll hidden">
                    	<span class="pull-left">&nbsp; <a href="" class="glyphicon glyphicon-arrow-left"></a></span>
                        <span class="pull-right"><a href="" class="glyphicon glyphicon-arrow-right"></a>&nbsp; </span>
                    </div>
	                <div id="criticality-analysis-per-day" class="horizontal-overflow-scroll">
	                	<table class="table table-bordered fixed-td-height sticky-thead table-condensed" id="table-daily-values-fixed" style="border-collapse:collapse; table-layout:fixed">
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