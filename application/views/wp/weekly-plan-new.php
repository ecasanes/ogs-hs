<!-- Create Weekly Plan Modal -->
<div class="modal fade" id="create-weekly-plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'create-weekly-plan-form', 'class' => '' );
            echo form_open('weekly-plan/create', $attributes); 
            echo form_hidden('ref_id_code', '');
            echo form_hidden('current_user_id', $current_user_id);
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create Weekly Plan</h4>
      </div>
      
      <div class="modal-body">
        
          
          <div class="row">
            
            <div class="col-xs-12">
              <p class="strong">Work Order</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" class="form-control " name="work_order" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Job Description</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" class="form-control " name="job_description" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-8">
              <p class="strong">Specialist Requirement</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Date</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <select name="specialist_requirement" id="" class="form-control">
                <?php echo $specialist_requirement_dropdown; ?>
              </select>
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control datepicker" name="date" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-8">
              <p class="strong">Comments</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Status</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <input type="text" class="form-control" name="comments" value="">
            </div>
            <div class="col-xs-4">
              <select name="status" class="form-control" required>
                <?php echo $status_dropdown; ?>
              </select>
            </div>
          </div>            
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
         <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
      <?php echo form_close(); ?> 
    </div>
  </div>
</div>
<!-- End Create Modal -->

<!-- Edit Weekly Plan Modal -->
<div class="modal fade" id="edit-weekly-plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'edit-weekly-plan-form', 'class' => '' );
            echo form_open('weekly-plan/update', $attributes);
            echo form_hidden('weekly_plan_id', '');
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Weekly Plan</h4>
      </div>
      
       <div class="modal-body">
        
          
          <div class="row">
            
            <div class="col-xs-12">
              <p class="strong">Work Order</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" class="form-control " name="work_order" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Job Description</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" class="form-control " name="job_description" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-8">
              <p class="strong">Specialist Requirement</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Date</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <select name="specialist_requirement" id="" class="form-control">
                <?php echo $specialist_requirement_dropdown; ?>
              </select>
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control datepicker" name="date" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-8">
              <p class="strong">Comments</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Status</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <input type="text" class="form-control" name="comments" value="">
            </div>
            <div class="col-xs-4">
              <select name="status" class="form-control" required>
                <?php echo $status_dropdown; ?>
              </select>
            </div>
          </div>            
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
         <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<div class="panel panel-info">


    <div class="panel-heading">
    	Weekly Plan
    </div>
	
	<div class="panel-body">
		 <?php
                                $attributes = array( 'role'=>'form' , 'id' => 'filter-weekly-plan-form', 'class' => 'hidden' );
                                echo form_open('', $attributes);
                                echo form_hidden('current_user_id', $current_user_id);
                              ?>

                                <div id="failure-mode-tooltip" class="row content custom-tooltip-container">
                                  <div class="custom-tooltip">
                                    <p>
                                      
                                    </p>
                                  </div>
                                  <div class="col-xs-12">
                                      <div class="page-header">
                                        <div class="row">
                                          
                                          <div class="col-xs-1 column-label">
                                          	<p class="strong">Name:</p>
                                          </div>
                                          <div class="col-xs-3">
                      											<select name="document_id" class="form-control select2-dropdown"> 
                                              <?php echo $document_name_dropdown ?>
                      											</select>
                                          </div>
                                          <div class="col-xs-1 column-label">
                                          	<p class="strong">Status:</p>
                                          </div>
                                          <div class="col-xs-1">
                      											<select name="status" id="" class="form-control color-select bg-white">
                      												<?php echo $status_dropdown; ?>
                      											</select>
                                          </div>
                                          <div class="col-xs-1 column-label">
                                          	<p class="strong">Reference:</p>
                                          </div>
                                          <div class="col-sm-3">
                                          	<input type="text" class="form-control" name="reference">
                                          </div>
                                          <div class="col-sm-2">
                                          	<button type="submit" class="btn btn-primary btn-block btn-normal">Filter</button>
                                          </div>

                                        </div>
                                      </div>
                                  </div>
                                </div>

                              <?php echo form_close(); ?>






                            <div id="no-weekly-plan" class="hidden">
                              <p>There are no Weekly Plans created. <a class="create-weekly-plan" href="#">  Create One</a></p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>There are no Weekly Plans found. </p>
                            </div>

                            <div id="loading-weekly-plan" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Weekly Plans...
                            </div>
                            
                            

                            <div id="my-weekly-plan" class="row-table table-responsive">


                              
                                <table  class="table table-bordered my-account sticky-thead">
                                  <thead>
                                    <tr>
                                      <th class="work-order">Work Order</th>
                                      <th class="job-description">Job Description</th>
                                      <th class="specialist-requirement">Specialist Requirement</th>
                                      <th class="category">Group</th>
                                      <th class="date">Date</th>
                                      <th class="comment">Comment</th>
                                      <th class="status"> Status</th>
                                      <th class="text-center action"> Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                                </table>


                                <div class="row content text-right row-options-container">
                                <div class="col-sm-4 col-sm-offset-8 button-container">
                                  <button type="button" class="btn btn-danger text-right remove-row">
                                    <span class="glyphicon glyphicon-minus"></span>
                                  </button> 
                                  <button type="button" class="btn btn-primary text-right add-row">
                                    <span class="glyphicon glyphicon-plus"></span>
                                  </button>
                                </div>
                              </div>




                              </div>

	</div>


	<?php echo form_close(); ?>
</div>