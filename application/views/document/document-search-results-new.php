<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title">Search Results</div>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
				</div>
			</div>
			<div class="panel-body">
			

		<?php if(!empty($results)): ?>
		<div class="row-table table-responsive">
	      <table class="table table-bordered">
	        <thead>
	          <tr>
	            <th>ID</th>
	            <th>Code</th>
	            <th>Case File Name</th>
	            <th>Status</th>
	            <th><span class="glyphicon glyphicon-flag"></span> Completed</th>
	            <th><span class="glyphicon glyphicon-cog"></span> Actions</th>
	          </tr>
	        </thead>
	        <tbody>
	        	<?php



	        		foreach($results as $result){
	        			$document_type = $result['document_type'];
						$id = $result['id'];
						$name = $result['name'];
						$code = $result['code'];
						$allowed = $result['form_completed'];
						$permitted = $result['permitted'];
						$status = $result['status'];
						if($allowed == 0){
							$allowed_class = 'text-danger';
							$allowed_label = '<span class="glyphicon glyphicon-remove"></span> No';
						}else{
							$allowed_class = 'text-success';
							$allowed_label = '<span class="glyphicon glyphicon-ok"></span> Yes';
						}

						if(!$permitted){
							$disabled = 'disabled';
						}else{
							$disabled = '';
						}


						
						?>

						<tr id="data-row-<?php echo $id; ?>">
				           <td><?php echo $id; ?></td>
				           <td><?php echo $code; ?></td>
				           <td><?php echo $name; ?></td>
				           <td><?php echo $status; ?></td>
				           <td class="text-center <?php echo $allowed_class; ?>"><?php echo $allowed_label; ?></td>
				           <td>
				           	<a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View" href="<?php echo base_url($document_type.'/view/'.$id); ?>"><span class="glyphicon glyphicon-list"></span></a>
				           	<a <?php echo $disabled; ?> class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="<?php echo base_url($document_type.'/edit/'.$id); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
				           	<a <?php echo $disabled; ?> class="btn btn-danger delete-form" data-toggle="tooltip" data-placement="top" title="Delete" href="<?php echo base_url($document_type.'/delete/'.$id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
				           </td>
				        </tr>

						<?php
					}

	        	?>
	          
	         
	        </tbody>
	      </table>
    	</div>
    <?php else: ?>
    	<div class="row">
    		<div class="col-xs-12">
    			<p>There are no records found that matched your query.</p>
    		</div>
    	</div>
    <?php endif; ?> 
			</div>
		</div>
	</div>
</div>