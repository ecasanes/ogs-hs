<?php unset($recent_document_actions['sql']) ?>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Recent Document</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">

		            <table class="table table-bordered">
		                <thead>
		                   <tr>
		                        <th>Action</th>
		                        <th>Date</th>
		                    </tr>
		                </thead>
		                <tbody id="recent-document-table">
		                <?php 
		                foreach($recent_document_actions as $document): ?>
				            <tr>
				                <td><?php print($document['action']) ?></td>
				                <td><?php print($document['action_date']) ?></td>
				            </tr>

		        		<?php endforeach; ?>
		    			</tbody>
					</table>

					<?php if( count($recent_document_actions) < $count ): ?>
					<a id="more-document-tracks" href="#" data-offset="<?php print( ! empty($recent_document_actions) ? count($recent_document_actions) : '' ) ?>" data-limit="5" data-id="1343" class="btn btn-primary btn-bordered btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
</div>