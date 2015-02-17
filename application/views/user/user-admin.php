<!-- Create User Modal -->
<div class="modal fade" id="create-user-admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'create-user-form', 'class' => '' );
            echo form_open('user/create_user', $attributes);
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Create User</h4>
      </div>
      
      <div class="modal-body">
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">First Name</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Last Name</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control " name="first_name" value="">
            </div>
            <div class="col-xs-6">
              <input type="text" class="form-control " name="last_name" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Username</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Role</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control" name="user_name" value="" >
            </div>
            <div class="col-xs-6">

              <select class="form-control" name="role">
                <option value="">- Select -</option>
                <option value="siteadmin">Site Admin</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="guest">Guest</option>
                <option value="sample">Sample</option>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Email Address</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" class="form-control" name="email_address" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Password</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Confirm Password</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <input type="password" class="form-control" name="password" value="" >
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <input type="password" class="form-control" name="confirm_password" value="" >
              </div>
              
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Asset</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Asset Role</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="asset" id="" class="form-control">
                <?php echo $criticality_asset; ?>
              </select>
            </div>
            <div class="col-xs-6">
              <select class="form-control" name="asset_role" id="">
                <option value="user">user</option>
                <option value="superuser">superuser</option>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Database</p>
            </div>
            <div class="col-xs-6"></div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select class="form-control" name="database_name" id="">
                <option value="">default</option>
                <option value="sample">sample</option>
              </select>
            </div>
            <div class="col-xs-6">
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


<!-- Edit User Modal -->
<div class="modal fade" id="edit-user-admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'edit-user-admin-form', 'class' => '' );
            echo form_open('user/update_user', $attributes);
            echo form_hidden('user_id', $user_id);
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit User</h4>
      </div>
      
       <div class="modal-body">
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">First Name</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Last Name</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control " name="first_name" value="">
            </div>
            <div class="col-xs-6">
              <input type="text" class="form-control " name="last_name" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Username</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Role</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control" name="user_name" value="" >
            </div>
            <div class="col-xs-6">

              <select class="form-control" name="role">
                <option value="">- Select -</option>
                <option value="siteadmin">Site Admin</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
                <option value="guest">Guest</option>
                <option value="sample">Sample</option>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Email Address</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="text" class="form-control" name="email_address" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Old Password</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">New Password</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <input type="password" class="form-control" name="old_password" value="" >
              </div>
              
            </div>
            <div class="col-xs-6">
              <input type="password" class="form-control" name="new_password" value="" >
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6 col-xs-offset-6">
              <p class="strong">Confirm Password</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6 col-xs-offset-6">
              <input type="password" class="form-control" name="confirm_password" value="" >
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Asset</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Asset Role</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="asset" id="" class="form-control">
                <?php echo $criticality_asset; ?>
              </select>
            </div>
            <div class="col-xs-6">
              <select class="form-control" name="asset_role" id="">
                <option value="">- Select -</option>
                <option value="user">user</option>
                <option value="superuser">superuser</option>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Database</p>
            </div>
            <div class="col-xs-6"></div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select class="form-control" name="database_name" id="">
                <option value="">default</option>
                <option value="sample">sample</option>
              </select>
            </div>
            <div class="col-xs-6">
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
                      <h2 class="step-title align-title">User Admin</h2>
                    </div>
                    <div class="col-sm-8">
                      <a class="btn btn-primary pull-right create-user-admin"><span class="glyphicon glyphicon-plus"></span> Create New User</a>
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
              

                          


                            <div id="no-user" class="hidden">
                              <p>There are no Users created. <a class="create-user-admin" href="#">  Create One</a></p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>There are no Users found. </p>
                            </div>

                            <div id="loading-user-admin" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Users...
                            </div>
                            
                            

                            <div id="user-admin" class="row-table table-responsive" style="overflow: auto;">


                              
                                <table  class="table table-bordered my-account sticky-thead">
                                  <thead>
                                    <tr>
                                      <th class="first-name">First Name</th>
                                      <th class="last-name">Last Name</th>
                                      <th class="user-name">Username</th>
                                      <th class="role">Role</th>
                                      <th class="database">Database</th>
                                      <th class="asset">Asset</th>
                                      <th class="asset-role">Asset Role</th>

                                      <th class="text-center">Action</th>
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