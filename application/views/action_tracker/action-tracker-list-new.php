<p class="flash-action-id hidden"><?php echo $flash_action_id; ?></p> 
<p class="flash-subaction-id hidden"><?php echo $flash_subaction_id; ?></p>

<!-- Document Type Modal -->
<div class="modal fade" id="document">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel"><p><span class="text-danger">Document Type:</span> <span class="document-type"></span></p></h4>
        <h4 class="loading-modal"><i class="fa fa-lg-2 fa-refresh fa-spin"></i> Loading Action Tracker Details... </h4>

      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-xs-6">
        		<strong>Document Code:</strong>
        		<span class="document-code"></span>
                <select name="" id="" class="form-control hidden"></select>
        	</div>
        	<div class="col-xs-6">
                <div class="row">
                    <div class="col-xs-12 modal-row">
                        <strong>Entry Date:</strong>
                        <span class="entry-date"></span>
                    </div>
                </div>
        		<div class="row">
                    <div class="col-xs-12">
                        <strong>Last Update:</strong>
                        <span class="last-update"></span>
                    </div>
                </div>
        	</div>
        </div>
        <hr>
        <h4>Action Details</h4>
        <hr>
        <div class="row modal-row">
            <div class="col-xs-6">
                <strong>Owner:</strong>
                <span class="owner"></span>
                <select class="form-control hidden"></select>
            </div>
            <div class="col-xs-6">
                <strong>Due Date:</strong>
                <span class="due-date"></span>
                <input type="text" class="form-control hidden">
            </div>
        </div>
        <div class="row modal-row">
            <div class="col-xs-12 modal-row">
                <strong>Action/Process Steps:</strong>
                <p class="action-process-step"></p>
                <input type="text" class="form-control hidden">
            </div>
            <div class="col-xs-12">
                <strong>Comments:</strong>
                <p class="comments"></p>
                <textarea name="" id="" cols="30" rows="3" class="form-control hidden"></textarea>
            </div>
        </div>
        <div class="row modal-row">
            <div class="col-xs-6">
                <strong>Status:</strong>
                <span class="status status-btn"></span>
                <select name="" id="" class="form-control hidden"></select>
            </div>
        </div>
        <hr>
        <h4>Document Details</h4>
        <hr>
        <div id="document-details">

        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        <button type="button" class="btn btn-success edit-document" data-id=""><span class="glyphicon glyphicon-edit"></span> Edit</button>
        <button type="button" class="btn btn-danger" data-id=""><span class="glyphicon glyphicon-trash"></span> Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Document Type Modal -->

<!-- Critical Equipment Item Modal -->
<div class="modal fade" id="equipment">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><p><span class="text-danger">Critical Equipment Item:</span> Booster Pump A</p></h4>
      </div>
      <div class="modal-body">
        <div class="row modal-row">
        	<div class="col-xs-6">
        		<strong>Equipment Code Code:</strong>
        		HB-001-A
        	</div>
        	<div class="col-xs-6">
        		<strong>Entry Date:</strong>
        		15/01/15
        	</div>
        </div>
        <div class="row modal-row">
        	<div class="col-xs-6">
        		<strong>Asset:</strong>
        		Value
        	</div>
        	<div class="col-xs-6">
        		<strong>Last Update:</strong>
        		15/01/15
        	</div>
        </div>
        <div class="row modal-row">
        	<div class="col-xs-6">
        		<strong>Tag Number:</strong>
        		00FF123
        	</div>
        </div>
        <hr>
        <h4>Action Details</h4>
        <div class="row modal-row">
        	<div class="col-xs-6">
        		<strong>Owner:</strong>
        		Demby Abella
        	</div>
        	<div class="col-xs-6">
        		<strong>Due Date:</strong>
        		Status
        	</div>
        </div>
        <div class="row modal-row">
        	<div class="col-xs-12 modal-row">
        		<strong>Action/Process Steps:</strong>
        		<p>
        			Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh 
	        		euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim 
	        		ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl 
	        		ut aliquip ex ea commodo consequat. 
        		</p>
        	</div>
        	<div class="col-xs-12">
        		<strong>Comments:</strong>
        		<p>
        			Duis autem vel eum iriure dolor in hendrerit 
	        		in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla 
	        		facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent 
	        		luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber 
	        		tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod 
	        		mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus 
	        		legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores 
	        		legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui 
	        		sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, 
	        		quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula 
	        		quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, 
	        		fiant sollemnes in futurum.
        		</p>
        	</div>
        </div>
        <div class="row modal-row">
        	<div class="col-xs-6">
        		<strong>Status:</strong>
        		Open
        	</div>
        </div>
        <hr>
        <h4>Equipment Profile</h4>
        <div class="row modal-row">
        	<div class="col-xs-6">
        		<strong>PCE:</strong>
        		
        	</div>
        	<div class="col-xs-6">
        		<strong>SCE:</strong>
        		
        	</div>
        </div>
        <div class="row modal-row">
        	<div class="col-xs-6">
        		<strong>ECE:</strong>
        		
        	</div>
        	<div class="col-xs-6">
        		<strong>SIS:</strong>
        		
        	</div>
        </div>
       
      </div><!-- End of Modal Body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
        <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Edit</button>
        <button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Critical Equipment Item Modal -->

<!-- Start of Edit Document Type Modal -->
<div class="modal fade" id="edit-document">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><p><span class="text-danger">Document Type:</span> Defect Elimination</p></h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Document Code:</strong>
        		<div class="form-group">
        			<input type="text" class="form-control" value="">
        		</div>
        	</div>
        	<div class="col-xs-6">
        		<strong>Entry Date:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Asset:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        	<div class="col-xs-6">
        		<strong>Last Update:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Tag Number:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <hr>
        <h4>Action Details</h4>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Owner:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        	<div class="col-xs-6">
        		<strong>Due Date:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-12" style="margin-bottom: 10px;">
        		<strong>Action/Process Steps:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        	<div class="col-xs-12">
        		<strong>Comments:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Status:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Document Type Modal -->

<!-- Start of Edit Equiment Type Modal  -->
<div class="modal fade" id="edit-equipment">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><p><span class="text-danger">Document Type:</span> Defect Elimination</p></h4>
      </div>
      <div class="modal-body">
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Equipment Code Code:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        	<div class="col-xs-6">
        		<strong>Entry Date:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Asset:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        	<div class="col-xs-6">
        		<strong>Last Update:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Tag Number:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <hr>
        <h4>Action Details</h4>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Owner:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        	<div class="col-xs-6">
        		<strong>Due Date:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-12" style="margin-bottom: 10px;">
        		<strong>Action/Process Steps:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        	<div class="col-xs-12">
        		<strong>Comments:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>Status:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <hr>
        <h4>Equipment Profile</h4>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>PCE:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        	<div class="col-xs-6">
        		<strong>SCE:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
        	<div class="col-xs-6">
        		<strong>ECE:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        	<div class="col-xs-6">
        		<strong>SIS:</strong>
        		<input type="text" class="form-control" value="">
        	</div>
        </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Edit Equipment Type -->

<!-- Hub Table -->
<div class="row">
	<div class="col-xs-12">
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
                    	<select name="main_filter" class="form-control">
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
                        <select name="sub_filter" id="" class="form-control">
                            <option value="">N/A</option>
                        </select>
                        <span class="sub-filter-spin hidden">
                            <i class="fa fa-refresh fa-spin filter-spinner"> </i> Loading filter...
                        </span>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <select name="optional_filter" id="" class="form-control hidden" disabled>
                            <option value="">N/A</option>
                        </select>
                        <span class="optional-filter-spin hidden filter-spinner">
                            <i class="fa fa-refresh fa-spin filter-spinner"> </i> Loading filter...
                        </span>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <select name="optional_subfilter" id="" class="form-control hidden" disabled>
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
			<div class="panel-body">
			     <!-- Old Ajax Table -->
				<div id="no-action-tracker" class="hidden">
					<p>There are no Action Trackers found that matched the above filter. <a id="action-tracker-create" class="create-action" href="#">  Create One</a></p>
                </div> 

                <div id="no-search-found" class="hidden">
                	<p>There are no Action Trackers found. </p>
				</div>
                                  
                <div id="loading-action-tracker" class="hidden">
                	<i class="fa fa-refresh fa-spin"></i>  Loading Action Trackers...
               	</div>

				<table id="action-tracker-ajax" class="table">
					<thead> </thead>
                    <tbody> </tbody>
				</table>
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

