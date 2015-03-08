<div class="row">
  <div class="col-xs-12">

    <!-- start panel -->
    <div class="panel panel-default">
      
      <div class="panel-heading">
        <h3 class="panel-title">Add Student</h3>
        <div class="panel-options">
          
        </div>
      </div>
      <?php echo form_open('', array('id'=>'add-user-form')); ?>
      <div class="panel-body">
        <div class="form-horizontal">
          <div class="row">
            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">Username</label>
              <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
              </div>
              <label for="username" class="control-label col-sm-2 col-xs-12">Year Level</label>
              <div class="col-sm-3 col-xs-12">
                <select name="year_level" id="" class="form-control" required>
                  <option value="">Select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">Password</label>
              <div class="col-sm-3 col-xs-12">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
              </div>
              <label for="username" class="control-label col-sm-2 col-xs-12">Confirm Password</label>
              <div class="col-sm-3 col-xs-12">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">First Name</label>
              <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control" name="firstname" placeholder="First Name" required>
              </div>
              <label for="username" class="control-label col-sm-2 col-xs-12">Last Name</label>
              <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" required>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">Age</label>
              <div class="col-sm-3 col-xs-12">
                <input type="number" class="form-control" name="age" placeholder="Age" required>
              </div>
              <label for="username" class="control-label col-sm-2 col-xs-12">Gender</label>
              <div class="col-sm-3 col-xs-12">
                <select name="gender" class="form-control" required>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">Contact Number</label>
              <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control" name="contact_number" placeholder="Contact Number" required>
              </div>
              <label for="username" class="control-label col-sm-2 col-xs-12">Address</label>
              <div class="col-sm-4 col-xs-12">
                <input type="text" class="form-control" name="address"  placeholder="Address" >
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-sm-10">
            <span class="error-message"></span>
            <span class="success-message"></span>
          </div>
          <div class="col-sm-2">
            <input type="submit" class="pull-right btn btn-success submit-form" value="Add">
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
    <!-- end panel -->


    <!-- start panel -->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Search Student</h3>
        <div class="panel-options">
          
        </div>
      </div>
      <div id="search-user" class="panel-body">
        <div class="form-horizontal">
          <div class="row">
            
              <div class="col-sm-3 col-xs-12">
                <select name="year_level" class="form-control">
                  <option value="">Select Year Level</option>
                  <option value="1">1st Year</option>
                  <option value="2">2nd Year</option>
                  <option value="3">3rd Year</option>
                  <option value="4">4th Year</option>
                </select>
              </div>
              <div class="col-sm-4 col-xs-12">

                <input id="search-user-input" type="text" class="form-control" placeholder="Find Student by typing First/ Last Name" name="search">
              </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-12">
            <span class="loading hidden">
            <i class="fa fa-spin fa-refresh"></i> Loading...
            </span>
            <div class="search-results">

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end panel -->
  </div>
</div>

<div class="modal fade" id="edit-student-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modify <span class="tag"></span></h4>
      </div>
      <?php echo form_open('', array('id' => 'edit-student-form')); ?>
      <?php echo form_hidden('user_id', ''); ?>
      <div class="modal-body">

        <div class="form-horizontal">
          <div class="row">
            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">Username</label>
              <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control" name="username" placeholder="Username" disabled>
              </div>
              <label for="username" class="control-label col-sm-2 col-xs-12">Year Level</label>
              <div class="col-sm-3 col-xs-12">
                <select name="year_level" id="" class="form-control" required>
                  <option value="">Select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">First Name</label>
              <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control" name="firstname" placeholder="First Name" disabled>
              </div>
              <label for="username" class="control-label col-sm-2 col-xs-12">Last Name</label>
              <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control" name="lastname" placeholder="Last Name" disabled>
              </div>
            </div>
            
          </div>
        </div>
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> Close</button>
        <button type="submit" class="btn btn-success go-yes"> Update</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>