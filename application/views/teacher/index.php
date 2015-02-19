<div class="row">
	<div class="col-xs-12">

		<!-- start panel -->
		<div class="panel panel-default">
			
		  <div class="panel-heading">
		    <h3 class="panel-title">Add Instructor</h3>
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
		    <h3 class="panel-title">Search Instructor</h3>
		    <div class="panel-options">
		    	
		    </div>
		  </div>
		  <div id="search-user" class="panel-body">
		    <div class="form-horizontal">
		    	<div class="row">
		    		
		    			<div class="col-sm-4 col-xs-12">
		    				<input id="search-user-input" type="text" class="form-control" placeholder="Find Instructor by typing First/ Last Name" name="search">
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