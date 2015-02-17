<?php
            $attributes = array( 'role'=>'form' , 'id' => 'filter-master-action-tracker-form', 'class' => 'form-horizontal' );
            echo form_open('', $attributes);
            echo form_hidden('current_user_id', $current_user_id);
        ?>
        <div class="panel panel-info collapsed">
            <div class="panel-heading">
                <h4 class="panel-title">Filter Action Tracker</h4>
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                </div>
            </div>
            <div class="panel-body" style="display:none;">
                <div class="form-group">
                    <label for="" class="col-sm-1 col-xs-12 control-label">Filter:</label>
                    <div class="col-sm-3 col-xs-12">
                        <select name="main_filter" class="form-control" id="main_filter">
                            <option value="all">All Actions</option>
                            <option value="basic-decf">Defect Elimination Case File</option>
                            <option value="ofi">Opportunity for Improvement</option>
                            <option value="project-plan">Project Work Pack</option>
                            <option value="critical equipment">Critical Equipment</option>
                            <option value="incident">Incident</option>
                            <option value="verification anomaly">Verification Anomaly</option>
                        </select>
                    </div>
                    <div class="col-sm-2 col-xs-12">
                        <select name="sub_filter" id="sub_filter" class="form-control">
                            <option value="">N/A</option>
                        </select>
                        <span class="sub-filter-spin hidden">
                            <i class="fa fa-refresh fa-spin filter-spinner"> </i> Loading filter...
                        </span>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <select name="optional_filter" id="optional_filter" class="form-control hidden" disabled>
                            <option value="">N/A</option>
                        </select>
                        <span class="optional-filter-spin hidden filter-spinner">
                            <i class="fa fa-refresh fa-spin filter-spinner"> </i> Loading filter...
                        </span>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <select name="optional_subfilter" id="optional_subfilter" class="form-control hidden" disabled>
                            <option value="">N/A</option>
                        </select>
                        <span class="optional-subfilter-spin hidden">
                            <i class="fa fa-refresh fa-spin filter-spinner"> </i> Loading filter...
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    
                </div>
                <!--<div class="form-group">
                    <label for="" class="col-sm-4 col-xs-12 control-label">Owner</label>
                    <div class="col-sm-4 col-xs-12">
                        <select name="owner" class="form-control select2-dropdown">
                            <option value="none">N/A</option>
                            <?php  echo $user_option ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-4 col-xs-12 control-label">Status</label>
                    <div class="col-sm-4 col-xs-12">
                        <select name="status" id="" class="form-control color-select bg-white">
                            <option value="none" class="bg-white">N/A</option>
                                <?php  echo $status_dropdown; ?>
                        </select>
                    </div>
                </div>-->
            </div>
            <div class="panel-footer bg-panel-grey" style="display:none;">
                <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-2 text-right">
                        <button  class="btn btn-info btn-block" type="submit"><span class="glyphicon glyphicon-search"></span> Filter</button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>

<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">Action Tracker</h4>
			
            <div class="panel-options">
				<button id="hub-action-tracker-add-top" type="button" class="btn btn-info add-action-tracker-row btn-sm" data-container="body"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
		</div>
			
            <div class="panel-body" id="action-tracker-data">

                <p>Records found: <span class="text-danger"><?php print($count) ?></span></p>

                <?php if ( ! empty($results) ): ?>
                    <table id="" class="table">
                        <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Type</th>
                                <th>Action/Process Steps</th>
                                <th class="text-center">Action Status</th>
                                <th>Owner</th>
                                <th>Due Date</th>
                                <th>Comments/Description</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($results as $data): ?>
                                <tr>
                                    <td><?php print($data['reference']) ?></td>
                                    <td><?php print($data['document_name']) ?></td>
                                    <td><?php print($data['action_process_step']) ?></td>
                                    <td class="text-center"><span class="status-btn bg-green"><?php print($data['name']) ?></span></td>
                                    <td><?php print($data['full_name']) ?></td>
                                    <td><?php print($data['due_date']) ?></td>
                                    <td><?php print($data['comments']) ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                    <div class="text-center" id="paginated-links">
                        <ul class="pagination pagination-centered">
                            <?php 
                                // Pagination Bootstrap Links.
                                $pagination->display_paginated_links();
                            ?>
                        </ul>
                    </div> 
                <?php else: ?>
                    <div class="alert alert-danger" role="alert">There are no results found.</div>
                <?php endif ?>
            
            </div>
			
            <div class="panel-footer">
				<div class="row">
					<div class="col-sm-offset-10 col-sm-2 text-right">
                       	<button type="button" class="btn btn-info add-action-tracker-row btn-sm"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Hub Table -->

<script type="text/javascript">
    var base_url = '<?php print( base_url() ) ?>';
</script>