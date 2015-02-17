<!-- Create Action Tracker Modal -->
<div class="modal fade" id="create-action-tracker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'create-action-tracker-form', 'class' => '' );
            echo form_open('action-tracker/create', $attributes); 
            echo form_hidden('ref_id_code', '');
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create Action Tracker</h4>
      </div>
      
      <div class="modal-body">
        
          
          <div class="row">
            
            <div class="col-xs-12">
              <p class="strong">Document Name</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <select id="document-id-ref" name="document_id" class="form-control select2-dropdown"> 
                <?php echo $existing_document_name_dropdown ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Action/Process Step</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" class="form-control " name="action_process" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Status</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Owner</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <select class="form-control color-select " name="action_tracker_status">
                 <?php echo $status_dropdown; ?>
              </select>
            </div>
            <div class="col-xs-8">
              <select name="owner" class="form-control new-user select2-dropdown">
                  <?php echo $user_option ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Due Date</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Comments</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input type="text" class="form-control datepicker" name="due_date" value="">
            </div>
            <div class="col-xs-8">
              <input type="text" class="form-control " name="comments" value="">
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
<div class="modal fade" id="action-tracker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'edit-action-tracker-form', 'class' => '' );
            echo form_open('action-tracker/update', $attributes);
            echo form_hidden('action_tracker_id', '');
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Action Tracker</h4>
      </div>
      
      <div class="modal-body">
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Ref</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Action/Process Step</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input type="text" class="form-control small-font reference" name="reference" value="" readonly>
            </div>
            <div class="col-xs-8">
              <input type="text" class="form-control action-process" name="action_process" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Status</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Owner</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <select class="form-control color-select action-tracker-status" name="action_tracker_status">
                <?php echo $status_dropdown; ?>
              </select>
            </div>
            <div class="col-xs-8">
              <select name="owner" class="form-control owner select2-dropdown">
                  <?php echo $user_option ?>
              </select>
            </div>
          </div>
          <brx>
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Due Date</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Comments</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <input type="text" class="form-control datepicker due-date" name="due_date" value="">
            </div>
            <div class="col-xs-8">
              <input type="text" class="form-control comments" name="comments" value="">
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
                    <div class="col-sm-4">
                      <h2 class="step-title align-title">Action Tracker </h2>
                    </div>
                    <div class="col-sm-8">
                      <a class="btn btn-primary pull-right create-action"><span class="glyphicon glyphicon-plus"></span> Series Link</a>
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
                                $attributes = array( 'role'=>'form' , 'id' => 'filter-master-action-tracker-form', 'class' => '' );
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
                                            <p class="strong">Owner:</p>
                                          </div>
                                          <div class="col-xs-3 filter-action-tracker-owner-dropdown">
                                                                        <select name="owner" class="form-control select2-dropdown pull-left">
                                                                       <option value="none">N/A</option>
                                              <?php  echo $user_option ?>
                                                                        </select>
                                          </div>
                                          <div class="col-xs-1 column-label">
                                            <p class="strong">Status:</p>
                                          </div>
                                          <div class="col-xs-1 filter-action-tracker-status-dropdown">
                                                                        <select name="status" id="" class="form-control color-select bg-white">
                                                                          <option value="none" class="bg-white">N/A</option>
                                                                          <?php  echo $status_dropdown; ?>
                                                                        </select>
                                          </div>
                                          <!-- <div class="col-xs-1 column-label">
                                            <p class="strong">Reference:</p>
                                          </div>
                                          <div class="col-sm-3">
                                            <input type="text" class="form-control" name="reference">
                                          </div> -->
                                          <div class="col-sm-2">
                                            <button type="submit" class="btn btn-primary btn-block btn-normal">Filter</button>
                                          </div>
                                                            
                                        </div>
                                      </div>
                                  </div>
                                </div>
                            
                              <?php echo form_close(); ?>
                            
                            
                              <div id="no-action-tracker" class="hidden">
                                    <p>There are no Action Trackers created. <a id="action-tracker-create" class="create-action" href="#">  Create One</a></p>
                                  </div> 

                                  <div id="no-search-found" class="hidden">
                                    <p>There are no Action Trackers found. </p>
                                  </div>
                                  
                                  <div id="loading-action-tracker" class="hidden">
                                    <i class="fa fa-refresh fa-spin"></i>  Loading Action Trackers...
                                  </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                           
                            
                                <!-- new action tracker
                                                            
                                action tracker ajax -->
                                <div class="row-table table-responsive text-center" id="action-tracker-container">
                                <table id="action-tracker-ajax" class="table table-bordered sticky-thead">
                                  <thead> </thead>
                                  <tbody> </tbody>

                                  
                                  
                                </table>
                                </div>

                                <div id="action-tracker-ajax-old" class="table table-bordered" >
                                </div>
                            
                                <div class="row">
                                  <div class="col-sm-offset-10 col-sm-2">
                                    <div class="pull-right" style="padding-right: 9px;">
                                      <!-- <button type="button" class="btn btn-danger remove-action-tracker-row"><span class="glyphicon glyphicon-minus"></span></button> -->
                                      <button type="button" class="btn btn-primary add-action-tracker-row btn-sm"><span class="glyphicon glyphicon-plus"></span></button>
                                    </div>
                                  </div>
                                  &nbsp;
                                </div>
                            
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>


    <!-- delete modal -->
    <div class="modal fade" id="confirm-delete-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div id="completion-check-modal" class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">You are about to delete this action</h4>
          </div>
          <div class="modal-body">
            <p>Do you still want to continue?</p> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> No</button>
            <button type="button" class="btn btn-danger go-yes"> Yes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- upload modal -->
    <?php $attributes = array( 'id' => 'upload-action-tracker');
    echo form_open_multipart('action_tracker/upload', $attributes);?>
    <div class="modal fade" id="upload-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div id="completion-check-modal" class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Upload a File</h4>
          </div>
          <div class="modal-body">
            <div class="upload-errors">
            </div>
            <div class="uploading-progress text-center hidden">
              <span>Uploading ...</span><br>
              <i class="fa fa-cog fa-spin" style="font-size: 30px !important"></i>
            </div>
            <div class="attach-files-container">
              <div class="attach-files">
                <div class="row">
                  <div class="col-sm-offset-1 col-sm-8">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                      <div class="form-control action-tracker-upload" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                      <span class="input-group-addon btn btn-default btn-file"><span class="glyphicon glyphicon-paperclip"></span><input type="file" name="userfile[]" ></span>
                      <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span></a>


                    </div>
                  </div>
                  
                </div>
              </div>
              <div class="hidden-item"></div>
              <div class="clone-attach-files-row">
                <div class="row">
                  <div class="col-sm-offset-1 col-sm-8">
                    <button type="button" class="btn btn-primary clone-attach-files btn-sm" data-original-title="" title="">Add another file</button>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> No</button>
            <button type="submit" value="upload" class="btn btn-danger go-yes"> Upload</button>
          </div>
        </div>
      </div>
    </div>
    </form>

</section>