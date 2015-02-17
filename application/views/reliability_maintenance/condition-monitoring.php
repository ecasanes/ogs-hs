<div class="row">
	<div class="col-xs-12">
		
		<div class="panel panel-primary collapsed">
			<div class="panel-heading">
				<h4 class="panel-title">Filter Condition Monitoring</h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
				</div>
			</div>
			<div class="panel-body" style="display:none;">
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Condition Monitoring</h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<div id="no-criticality-analysis" class="hidden">
                    <p>There are no Criticality Analysis created.</p>
                </div>
                <div id="no-search-found" class="hidden">
                    <p>There are no Criticality Analysis found. </p>
                </div>
                <div id="loading-criticality-analysis" class="hidden">
                    <i class="fa fa-refresh fa-spin"></i>  Loading Criticality Analysis...
                </div>

                <div id="condition-monitoring-table" class="row-table table-responsive">
                    <table  class="table table-bordered table-condensed my-account sticky-thead">
                        <thead>
                            <tr>
                                <th>Equipment Type</th>
                                <th>Description</th>
                                <th>Tag</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Next Steps</th>
                                <th class="<?php echo $hidden_display; ?>">Action</th>
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