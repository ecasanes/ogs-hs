<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">History of Availability</h4>
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

                <div id="history-of-availability-table" class="row-table table-responsive horizontal-overflow-scroll">
                    <table  class="table table-bordered table-condensed my-account sticky-thead">
                        <thead>
                            <tr>
                                <th>Asset</th>
                                <th>Tag Number</th>
                                <th>Description</th>
                                <th>ARN?</th>
                                <th>Alert</th>
                                <th colspan="2">Jan</th>
                                <th colspan="2">Feb</th>
                                <th colspan="2">Mar</th>
                                <th colspan="2">Apr</th>
                                <th colspan="2">May</th>
                                <th colspan="2">Jun</th>
                                <th colspan="2">Jul</th>
                                <th colspan="2">Aug</th>
                                <th colspan="2">Sep</th>
                                <th colspan="2">Oct</th>
                                <th colspan="2">Nov</th>
                                <th colspan="2">Dec</th>
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

<div class="row">
	<?php
        $attributes = array( 'role'=>'form' , 'id' => 'filter-criticality-analysis-history-form', 'class' => 'form-horizontal form-group');
        echo form_open('', $attributes);
        echo form_hidden('current_user_id', $current_user_id);
        echo form_close(); ?>	
</div>