<div class="row">
	<div class="col-xs-12">

		<?php
			$attributes = array( 'role'=>'form' , 'id' => 'filter-remedial-action-register-form', 'class' => 'form-horizontal' );
			echo form_open('', $attributes);
			//echo form_hidden('current_user_id', $current_user_id);
		?>
		
		<div class="panel panel-info collapsed">
			<div class="panel-heading">
				<h4 class="panel-title">Filter Remedial Action Register</h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
				</div>
			</div>
			<div class="panel-body" style="display:none">
				<div class="form-group">
                    <label for="" class="col-sm-4 col-xs-12 control-label">Owner</label>
					<div class="col-sm-4 col-xs-12">
                    	<select name="owner" class="form-control select2-dropdown">
							<option value="none">N/A</option>
							<!-- <?php  //echo $user_option ?> to add options-->
						</select>
					</div>
				</div>
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
				<h4 class="panel-title">
					Remedial Action Register
				</h4>
			</div>
			<div class="panel-body">
					<div id="remedial-action-register" class="text-center">
						<table id="remedial-action-register-table" class="table table-bordered table-condensed">
							<thead>
								<tr>
									<th>Asset</th>
									<th>SCE Ref</th>
									<th>PS Ref</th>
									<th>RAR</th>
									<th>Topic</th>
									<th>Issue</th>
									<th>Recommendation</th>
									<th>Action</th>
									<th>Status</th>
									<th>Owner</th>
									<th>Due Date</th>
									<th>Comments</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-offset-10 col-sm-2 text-right">
                       	<button type="button" class="btn btn-info add-remedial-action-register-row btn-sm"><span class="glyphicon glyphicon-plus"></span></button>
                    </div>
				</div>
				
			</div>
		</div>
	</div>
</div>
		