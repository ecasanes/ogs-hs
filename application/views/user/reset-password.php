
	    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-sm-5 col-sm-offset-3">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Reset Password</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="<?php echo base_url('user/login'); ?>">Sign in</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <!--<form id="loginform" class="form-horizontal" role="form">-->
                        <?php
                            $password_error = $this->session->flashdata('password_error');
			                $attributes = array(
									'role' => 'form',
									'class' => 'form-horizontal',
									'id' => 'forgot-password'
								);
							echo form_open('', $attributes);
						?>

                            <?php if($password_error): ?>
                                <div class="alert alert-danger fade in">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <strong></strong> Password does not match.
                                </div>
                            <?php endif; ?>
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>

                                <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-confirm-password" type="password" class="form-control" name="confirm_password" placeholder="confirm password">
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls text-right">
                                      <button type="submit" id="btn-login" class="btn btn-success">Submit  </button>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="<?php echo base_url('user/signup'); ?>">Sign Up Here</a>
                                        </div>
                                    </div>
                                </div>    
                            <?php echo form_close(); ?>



                        </div>                     
                    </div>  
        </div>
    </div>
    