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


<section id="main-content">
	<div class="container">

		<div class="row">
			<div class="col-xs-12">
				<div id="casefile-view-header" class="page-header">
					<div class="row">
						<div class="col-sm-3">
							<h1 class="align-title">Status Window</h1>
						</div>
						<div class="col-sm-9 text-right">
							<a href="<?php echo base_url('page/tech-help'); ?>" class="btn btn-success btn-larger" data-toggle="tooltip" data-placement="left" title="Tech Help"><span class="glyphicon glyphicon-question-sign"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-12">
				<div id="my-account-panel" class="panel panel-primary">


		<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#basic-decf-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Level 1 DECF </h2>
                </div>
                <div class="col-sm-1 pull-right">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="basic-decf-container" class="table-container collapse in">

			<?php if(empty($basic_decf_results)): ?>
				<p>There are no Basic DECF created. <a href="<?php echo base_url('basic-decf/create'); ?>">Create One</a></p>
			<?php else: ?>
				<div class="row-table table-responsive">
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
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
	    </div>




	    <div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#decf-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Level 2 Forensic DECF</h2>
                </div>
                <div class="col-sm-1 pull-right">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="decf-container" class="table-container collapse in">

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
					    <th class="action duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>




    	<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#ofi-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">OFI</h2>
                </div>
                <div class="col-sm-1 pull-right">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="ofi-container" class="table-container collapse in">

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
					    <th class="action duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>



    	<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#pp-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Project Plan</h2>
                </div>
                <div class="col-sm-1 pull-right">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="pp-container" class="table-container collapse in">

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
					    <th class="action duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>




    	<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#tb-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Technical Bulletin</h2>
                </div>
                <div class="col-sm-1 pull-right">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="tb-container" class="table-container collapse in">

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
					    <th class="action duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>

		<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#ws-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Witness Statement</h2>
                </div>
                <div class="col-sm-1 pull-right">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="ws-container" class="table-container collapse in">

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
					    <th class="action duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>

		<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#tq-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Technical Query</h2>
                </div>
                <div class="col-sm-1 pull-right">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="tq-container" class="table-container collapse in">

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
					    <th class="action duplicate" data-dynatable-column="update"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>


		






    	

    	<br>
    	<br>
				





		</div>
	</div>
</div>



	</div>
</section>