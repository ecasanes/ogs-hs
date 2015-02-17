<div class="row">
	<div class="col-xs-12">
		

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><?php echo $title; ?></h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<div id="no-project-tracker" class="hidden">
					<p>No Projects Found.</p>
                </div> 

                <div id="no-search-found" class="hidden">
                	<p>There are no Projects found. </p>
				</div>
                                  
                <div id="loading-project-tracker" class="hidden">
                	<i class="fa fa-refresh fa-spin"></i>  Loading Project Tracker...
               	</div>

				<div class="horizontal-overflow-scroll">
					<input type="hidden" name="document_id" value="<?php echo $document_id; ?>">
					<div class="gantt">
	               		
	               	</div>
				</div>
	               	

              
			</div>
			<div class="panel-footer">
				<div class="row hidden">
					<div class="col-sm-offset-10 col-sm-2 text-right">
                       	<button type="button" class="btn btn-info add-project-tracker-row btn-sm"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
				</div>
				
			</div>
		</div>
	</div>
</div>

