<div class="row">
    <div class="col-sm-6 col-xs-12">
        <!-- <div class="col-sm-8 col-xs-12"> -->
            <div id="change-password-form" class="panel panel-info">
                <?php echo form_open(); ?>
                <div class="panel-heading">
                    <h1 class="panel-title">Change Password</h1>
                    <div class="panel-options">
                    </div>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-xs-12 col-sm-7 col-sm-offset-2">
                            <div class="form-group">
                                <label for="password" class="control-label">New Password</label>
                                
                                <input class="form-control" type="password" name="password" value="" required />


                            </div>

                            <div class="form-group">    
                                <label for="confirm_password" class="control-label">Confirm Password</label>
                                <input class="form-control" type="password" name="confirm_password" value="" required />
                            </div>

                            <div id="alert-password" class="alert alert-danger alert-dismissible hidden" role="alert">
                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              Password does not match.
                            </div>

                            <div id="success-password" class="alert alert-success alert-dismissible hidden" role="alert">
                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              Update Successful.
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="panel-footer text-right">
                    <button id="first-time-change-password" type="submit" class="btn btn-primary go-yes"><i class="fa fa-save fa-lg"></i> Update Password</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        <!-- </div> -->
    </div>
</div>