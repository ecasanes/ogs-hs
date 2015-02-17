
	    <div class="container">    
        <div id="loginbox"  class="mainbox col-sm-5 col-sm-offset-3">                    
            <div class="panel panel-info form-container" >
                    <div class="panel-heading">
                        <div class="panel-title strong">Forgot Password</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <!--<form id="loginform" class="form-horizontal" role="form">-->
                        <?php
                            $password_key_sent = $this->session->flashdata('password_key_sent');
			                $attributes = array(
									'role' => 'form',
									'class' => 'form-horizontal',
									'id' => 'forgot-password'
								);
							echo form_open('user/password-change', $attributes);
						?>

                            <?php if($password_key_sent): ?>
                                <div class="alert alert-success fade in">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <strong></strong> <?php echo $password_key_sent; ?>
                                </div>
                            <?php endif; ?>
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls text-right">
                                      <button type="submit" id="btn-login" class="btn btn-success"> <span class="glyphicon glyphicon-ok"></span> Submit  </button>

                                    </div>
                                </div>


                                <div class="form-group" style="border-top:1px solid #e2e2e2;padding-top:20px;">
                                    <div class="col-sm-12 col-xs-12 control text-left">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url('user/contact-us'); ?>"> Contact Us
                                            </a> | 
                                            <a href="<?php echo base_url('user/login'); ?>"> Sign In
                                            </a>
                                        </div>
                                    </div>
                                </div>   
                            <?php echo form_close(); ?>



                        </div>                     
                    </div>  
        </div>
    </div>
    