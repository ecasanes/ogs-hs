<!-- Create Equipment Register Modal -->
<div class="modal fade" id="create-equipment-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'create-equipment-register-form', 'class' => '' );
            echo form_open('equipment-register/create', $attributes);
            echo form_hidden('current_user_id', $current_user_id); 
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create Hired Equipment Register</h4>
      </div>
      
      <div class="modal-body">
        
          
            
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">PO Number</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Equipment</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input type="text" class="form-control " name="po_number" value="">
            </div>
            <div class="col-xs-8">
              <input type="text" class="form-control " name="equipment" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-8">
              <p class="strong">On Hire To</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Duration</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <input type="text" class="form-control " name="on_hire_to" value="">
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control" name="duration" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Quantity</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Cost</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Total</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input type="text" class="form-control " name="quantity" value="">
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control " name="cost" value="">
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control " name="total" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Status</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Off Hire Due Date</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <select class="form-control color-select " name="equipment_register_status">
                 <?php echo $status_dropdown; ?>
              </select>
            </div>
            <div class="col-xs-8">
              <input type="text" class="form-control datepicker" name="off_hire_due_date" value="">
              
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Owner</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <select name="owner" class="form-control new-user select2-dropdown">
                  <?php echo $user_option ?>
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


<!-- Edit Aciton Tracker Modal -->
<div class="modal fade" id="hired-equipment-register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'edit-equipment-register-form', 'class' => '' );
            echo form_open('equipment-register/update', $attributes);
            echo form_hidden('hired_equipment_register_id', '');
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Hired Equipment Register</h4>
      </div>
      
      <div class="modal-body">
        
          
            
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">PO Number</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Equipment</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input type="text" class="form-control po-number" name="po_number" value="">
            </div>
            <div class="col-xs-8">
              <input type="text" class="form-control equipment" name="equipment" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-8">
              <p class="strong">On Hire To</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Duration</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <input type="text" class="form-control on-hire" name="on_hire_to" value="">
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control duration" name="duration" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Quantity</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Cost</p>
            </div>
            <div class="col-xs-4">
              <p class="strong">Total</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input type="text" class="form-control quantity" name="quantity" value="">
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control cost" name="cost" value="">
            </div>
            <div class="col-xs-4">
              <input type="text" class="form-control total" name="total" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Status</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Off Hire Due Date</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <select class="form-control color-select er-status" name="equipment_register_status">
                 <?php echo $status_dropdown; ?>
              </select>
            </div>
            <div class="col-xs-8">
              <input type="text" class="form-control datepicker due-date" name="due_date" value="">
              
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Owner</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <select name="owner" class="form-control new-user select2-dropdown owner">
                  <?php echo $user_option ?>
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


<section id="main-content">
    <div class="container">
        <div class="row custom-tooltip-container step-tooltip">
            <div class="custom-tooltip">
                                    <p>
                                      <strong>Status Colors:</strong>
                                    </p>
                                    <table>
                                      <tr>
                                        <td class="bg-green status-legend"></td>
                                        <td>&nbsp;-&nbsp;</td>
                                        <td>Open</td>
                                      </tr>
                                      <tr>
                                        <td class="bg-red status-legend"></td>
                                        <td>&nbsp;-&nbsp;</td>
                                        <td>Closed</td>
                                      </tr>
                                      <tr>
                                        <td class="bg-orange status-legend"></td>
                                        <td>&nbsp;-&nbsp;</td>
                                        <td>Due</td>
                                      </tr>

                                    </table>
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                  <div class="row">
                    <div class="col-sm-5">
                      <h2 class="step-title align-title">Hired Equipment Register <span class="tooltip-toggle help-icon"></span></h2>
                    </div>
                    <div class="col-sm-7">
                      <a class="btn btn-primary pull-right create-equipment-register"><span class="glyphicon glyphicon-plus"></span> Create New Hired Equipment Register</a>
                    </div>
                  </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">




        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">


                    <div class="panel-body">
                        <div class="tab-content form-tabs">
                            <div class="tab-pane active" id="tab1">
              

                              <?php
                                $attributes = array( 'role'=>'form' , 'id' => 'filter-action-tracker-form', 'class' => 'hidden' );
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
                                              <?php // echo $document_name_dropdown ?>
                      											</select>
                                          </div>
                                          <div class="col-xs-1 column-label">
                                          	<p class="strong">Status:</p>
                                          </div>
                                          <div class="col-xs-1">
                      											<select name="status" id="" class="form-control color-select bg-white">
                      												<?php //echo $status_dropdown; ?>
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

                              <?php  echo form_close(); ?>






    <div id="no-equipment-register" class="hidden">
      <p>There are no Hired Equipment Registers created. <a id="equipment-register-create" class="create-equipment-register" href="#">  Create One</a></p>
    </div>

    <div id="no-search-found" class="hidden">
      <p>There are no Hired Equipment Registers found. </p>
    </div>

    <div id="loading-equipment-register" class="hidden">
      <i class="fa fa-refresh fa-spin"></i>  Loading Hired Equipment Registers...
    </div>
    
    

    <div id="my-equipment-register" class="row-table table-responsive">


      
        <table  class="table table-bordered my-account sticky-thead">
          <thead>
            <tr>
              <th class="po-number">PO Number</th>
              <th class="equipment-register">Equipment</th>
              <th class="on-hire">On Hire To</th>
              <th class="due-date">Due Date</th>
              <th class="status">Status</th>
              <th class="text-center"><span class="glyphicon glyphicon-cog"></span> Action</th>
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
            </div>
        </div>



    </div>
</section>