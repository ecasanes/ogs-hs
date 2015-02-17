<div class="container">    
        
        <div id="loginbox" class="mainbox col-md-5 col-md-offset-3 col-sm-7 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                        </div>  
                        <div class="panel-body" >
                            <!-- <form id="signupform" class="form-horizontal" role="form"> -->
                            <?php
                                $attributes = array(
                                        'role' => 'form',
                                        'class' => 'form-horizontal',
                                        'id' => 'signupform'
                                    );
                                echo form_open('user/signup', $attributes);
                            ?>
                                
                                    <?php 

                                        $error_prefix = '<div id="signupalert" class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                                        $error_suffix = '</div>';
                                        echo validation_errors($error_prefix, $error_suffix);

                                    ?>

                                    <?php if($signup_success): ?>
                                        <div class="alert alert-success fade in">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <strong>Registration was Successful</strong> <br/>Check your email for the activation link. 
                                        </div>
                                    <?php endif; ?>
                                
                                    
                                

                                <div class="form-group">
                                    <label for="firstname" class="col-md-4 control-label">First Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="firstname" placeholder="First Name" value="<?php echo $firstname; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-4 control-label">Last Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="lastname" placeholder="Last Name" value="<?php echo $lastname; ?>">
                                    </div>
                                </div>
                                  
                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">Email</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="email_address" placeholder="Email Address" value="<?php echo $email_address; ?>">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="email" class="col-md-4 control-label">Username</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $username; ?>">
                                    </div>
                                </div>
                                    
                                
                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Password</label>
                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="password" class="col-md-4 control-label">Confirm Password</label>
                                    <div class="col-md-8">
                                        <input id="confirm-password" type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-4 col-md-8 text-right">
                                        <button id="btn-signup" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> &nbsp Sign Up</button>
                                    </div>
                                </div>

                                <div class="form-group" style="border-top:1px solid #e2e2e2;padding-top:20px;">
                                    <div class="col-sm-12 col-xs-12 control text-left">
                                        <div class="btn-group">
                                            <a href="user/contact-us"> Contact Us
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
    