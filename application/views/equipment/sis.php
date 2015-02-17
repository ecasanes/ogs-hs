<!-- Create Criticality Analysis Modal -->
<div class="modal fade" id="safety-instrumented-system" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'add-sis-form', 'class' => '' );
            echo form_open('sis/create', $attributes); 
            echo form_hidden('current_user_id', $current_user_id);
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Safety Instrumented System</h4>
      </div>
      
      <div class="modal-body">
        
          
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Tag Number</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Code</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control " name="tag_number" value="" placeholder="tag number">
            </div>
            <div class="col-xs-6">
              <input type="text" class="form-control " name="code" value="" placeholder="code">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">SIS Description:</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input class="form-control" type="text" name="description" value="" placeholder="Description">
            </div>
          </div>
          <br>        
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

<section id="main-content">
    <div class="container">
        <div class="row custom-tooltip-container step-tooltip">
            <div class="custom-tooltip">
                                   
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                  <div class="row">
                    <div class="col-sm-7">
                      <h2 class="step-title align-title">Safety Instrumented System</h2>
                    </div>
                    <div class="col-sm-5">
                      <a class="btn btn-primary pull-right add-sis"><span class="glyphicon glyphicon-plus"></span> Add Safety Instrumented System</a>
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

                            <div id="no-sis" class="hidden">
                              <p>There are no existing SIS Equipment. <a class="create-criticality-analysis" href="#">  Create One</a></p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>There are no SIS Equipment found. </p>
                            </div>

                            <div id="loading-sis" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading SIS...
                            </div>
                            
                            

                            <div id="sis-list" class="row-table table-responsive">


                              
                                <table  class="table table-bordered my-account sticky-thead">
                                  <thead>
                                    <tr>
                                      <th class="job-description">Tag No.</th>
                                      <th class="specialist-requirement">SIS Description</th>
                                      <th class="status">Code</th>
                                      <th class="code text-center">Action</th>
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