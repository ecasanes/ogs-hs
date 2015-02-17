<?php 
	$attributes=array( 'role'=>'form', 'id' => 'window-status-form' ); 
	echo form_open_multipart('', $attributes);
	echo form_hidden('model_id','');
	echo form_hidden('form_id', $current_user_id);
	echo form_hidden('document_status_submit', base_url('document/update-document-status'));
    echo form_hidden('document_status_value', $document_status_value);
    echo form_hidden('current_user_id', $current_user_id);
    echo form_hidden('current_user_name', $current_user_name);
?>

<div class="row">
	<div class="col-xs-12">
            <!-- <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Level 1 DECF
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="basic-decf-container" class="panel-body" style="display:none;">
            
                    <?php if(empty($basic_decf_results)): ?>
            						<p>There are no Basic DECF created. <a href="<?php echo base_url('basic-decf/create'); ?>">Create One</a></p>
            					<?php else: ?>
            						<div class="row-table table-responsive table-condensed">
            							<table class="table table-bordered my-account" id="basic-decf-json">
            							<thead>
            							    <th class="id" data-dynatable-column="document_id">ID</th>
            							    <th class="code" data-dynatable-column="document_code">Code</th>
            							    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
            							    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
            							    <th class="document-status" data-dynatable-column="update_status"><span class="glyphicon glyphicon-flag"></span> Status</th>
            							    <th class="action duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>
            							</thead>
            							<tbody>
            							</tbody>
            							</table>
            					    </div>
            			    	<?php endif; ?> 
                    
                </div>
            </div> -->

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        DECF
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="decf-container" class="panel-body" style="display:none;">
                    <?php if(empty($decf_results)): ?>
						<p>There are no DECF created. <a href="<?php echo base_url('case-file/create'); ?>">Create One</a></p>
					<?php else: ?>
						<div class="row-table table-responsive">
							<table class="table table-bordered my-account" id="decf-json">
							<thead>
							    <th class="id" data-dynatable-column="document_id">ID</th>
							    <th class="code" data-dynatable-column="document_code">Code</th>
							    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
							    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
							    <th class="document-status" data-dynatable-column="update_status"><span class="glyphicon glyphicon-flag"></span> Status</th>
							    <th class="action update-status duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

							</thead>
							<tbody>
								<!-- Javascript is working here with ajax data table generated -->
							</tbody>
							</table>
					    </div>
			    	<?php endif; ?> 
                </div>
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        OFI
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="ofi-container" class="panel-body" style="display:none;">
                    <?php if(empty($ofi_results)): ?>
						<p>There are no OFI created. <a href="<?php echo base_url('ofi/create'); ?>">Create One</a></p>
					<?php else: ?>
						<div class="row-table table-responsive">
							<table class="table table-bordered my-account" id="ofi-json">
							<thead>
							    <th class="id" data-dynatable-column="document_id">ID</th>
							    <th class="code" data-dynatable-column="document_code">Code</th>
							    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
							    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
							    <th class="document-status" data-dynatable-column="update_status"><span class="glyphicon glyphicon-flag"></span> Status</th>
							    <th class="action update-status duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

							</thead>
							<tbody>
								<!-- Javascript is working here with ajax data table generated -->
							</tbody>
							</table>
					    </div>
			    	<?php endif; ?> 
                </div>
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Project Plan
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="pp-container" class="panel-body" style="display:none;">
                    <?php if(empty($pp_results)): ?>
						<p>There are no Project Plan created. <a href="<?php echo base_url('project-plan/create'); ?>">Create One</a></p>
					<?php else: ?>
						<div class="row-table table-responsive">
							<table class="table table-bordered my-account" id="project-plan-json">
							<thead>
							    <th class="id" data-dynatable-column="document_id">ID</th>
							    <th class="code" data-dynatable-column="document_code">Code</th>
							    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
							    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
							    <th class="document-status" data-dynatable-column="update_status"><span class="glyphicon glyphicon-flag"></span> Status</th>
							    <th class="action update-status duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

							</thead>
							<tbody>
								<!-- Javascript is working here with ajax data table generated -->
							</tbody>
							</table>
					    </div>
			    	<?php endif; ?> 
                </div>
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Technical Bulletin
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="tb-container" class="panel-body" style="display:none;">
                    <?php if(empty($tb_results)): ?>
						<p>There are no Technical Bulletin created. <a href="<?php echo base_url('technical-bulletin/create'); ?>">Create One</a></p>
					<?php else: ?>
						<div class="row-table table-responsive">
							<table class="table table-bordered my-account" id="technical-bulletin-json">
							<thead>
							    <th class="id" data-dynatable-column="document_id">ID</th>
							    <th class="code" data-dynatable-column="document_code">Code</th>
							    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
							    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
							    <th class="document-status" data-dynatable-column="update_status"><span class="glyphicon glyphicon-flag"></span> Status</th>
							    <th class="action update-status duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

							</thead>
							<tbody>
								<!-- Javascript is working here with ajax data table generated -->
							</tbody>
							</table>
					    </div>
			    	<?php endif; ?>
                </div>
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Witness Statement
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="ws-container" class="panel-body" style="display:none;">
                    <?php if(empty($ws_results)): ?>
						<p>There are no Witness Statement created. <a href="<?php echo base_url('witness-statement/create'); ?>">Create One</a></p>
					<?php else: ?>
						<div class="row-table table-responsive">
							<table class="table table-bordered my-account" id="witness-statement-json">
							<thead>
							    <th class="id" data-dynatable-column="document_id">ID</th>
							    <th class="code" data-dynatable-column="document_code">Code</th>
							    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
							    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
							    <th class="document-status" data-dynatable-column="update_status"><span class="glyphicon glyphicon-flag"></span> Status</th>
							    <th class="action update-status duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

							</thead>
							<tbody>
								<!-- Javascript is working here with ajax data table generated -->
							</tbody>
							</table>
					    </div>
			    	<?php endif; ?>
                </div>
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Technical Query
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="tq-container" class="panel-body" style="display:none;">
                    <?php if(empty($tq_results)): ?>
						<p>There are no Technical Query created. <a href="<?php echo base_url('technical-query/create'); ?>">Create One</a></p>
					<?php else: ?>
						<div class="row-table table-responsive">
							<table class="table table-bordered my-account" id="technical-query-json">
							<thead>
							    <th class="id" data-dynatable-column="document_id">ID</th>
							    <th class="code" data-dynatable-column="document_code">Code</th>
							    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
							    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
							    <th class="document-status" data-dynatable-column="update_status"><span class="glyphicon glyphicon-flag"></span> Status</th>
							    <th class="action update-status duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

							</thead>
							<tbody>
								<!-- Javascript is working here with ajax data table generated -->
							</tbody>
							</table>
					    </div>
			    	<?php endif; ?>  
                </div>
            </div>
        </div>  
</div>

<?php echo form_close(); ?>