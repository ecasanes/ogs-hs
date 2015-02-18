<div class="row">
	<div class="col-xs-12">
		<!-- start panel -->
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title">Profile</h3>
		    <div class="panel-options">
		    	
		    </div>
		  </div>
		  <div class="panel-body">
		    Profile Information Here...
		  </div>
		</div>
		<!-- end panel -->

		<!-- start panel -->
		<div class="panel panel-default">
			
		  <div class="panel-heading">
		    <h3 class="panel-title">Add Instructor</h3>
		    <div class="panel-options">
		    	
		    </div>
		  </div>
		  <?php echo form_open('', array('id'=>'add-instructor-form')); ?>
		  <div class="panel-body">
		  	<div class="form-horizontal">
			  	<div class="row">
			  		<div class="form-group">
			  			<label for="username" class="control-label col-sm-2 col-xs-12">Username</label>
				  		<div class="col-sm-3 col-xs-12">
				  			<input type="text" class="form-control" name="username" required>
				  		</div>
			  		</div>

			  		<div class="form-group">
			  			<label for="username" class="control-label col-sm-2 col-xs-12">Password</label>
				  		<div class="col-sm-3 col-xs-12">
				  			<input type="password" class="form-control" name="password" required>
				  		</div>
				  		<label for="username" class="control-label col-sm-2 col-xs-12">Confirm Password</label>
				  		<div class="col-sm-3 col-xs-12">
				  			<input type="password" class="form-control" name="confirm_password" required>
				  		</div>
			  		</div>

			  		<div class="form-group">
			  			<label for="username" class="control-label col-sm-2 col-xs-12">First Name</label>
				  		<div class="col-sm-3 col-xs-12">
				  			<input type="text" class="form-control" name="firstname" required>
				  		</div>
				  		<label for="username" class="control-label col-sm-2 col-xs-12">Last Name</label>
				  		<div class="col-sm-3 col-xs-12">
				  			<input type="text" class="form-control" name="lastname">
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
		  			<input type="submit" class="pull-right btn btn-success submit-form">
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
		  <div id="search-instructor" class="panel-body">
		    <div class="form-horizontal">
		    	<div class="row">
		    		
		    			<div class="col-sm-4 col-xs-12">
		    				<input id="search-instructor-input" type="text" class="form-control" placeholder="Find Instructor by typing First/ Last Name" name="search">
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