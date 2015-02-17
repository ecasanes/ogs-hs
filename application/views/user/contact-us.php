<div class="container">    
        
        <div class="mainbox col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Contact Us</div>
                        </div>  
                        <div class="panel-body" >
                            <!-- <form id="signupform" class="form-horizontal" role="form"> -->
                            <?php
                                $attributes = array(
                                        'role' => 'form',
                                        'class' => 'form-horizontal',
                                        'id' => 'signupform'
                                    );
                                echo form_open('user/contact-us', $attributes);
                            ?>
                                
                                    <?php 

                                        $error_prefix = '<div id="signupalert" class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                                        $error_suffix = '</div>';
                                        echo validation_errors($error_prefix, $error_suffix);

                                    ?>

                                    <?php if(isset($message_sent)): ?>
                                        <div class="alert alert-success fade in">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <?php echo $message_sent; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(isset($message_failed)): ?>
                                        <div class="alert alert-danger fade in">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <?php echo $message_failed; ?>
                                        </div>
                                    <?php endif; ?>
                                
                                    
                                

                                <div class="form-group">
                                    <label for="full_name" class="col-sm-3 control-label">Full Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-sm-3 control-label">E-mail</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="email" placeholder="email@domain.com" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="subject" class="col-sm-3 control-label">Subject</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject" value="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="message" class="col-sm-3 control-label">Message</label>
                                    <div class="col-sm-9">
                                        <textarea name="message" class="textarea-editor small form-control" rows="10"></textarea>
                                    </div>
                                </div>
                                
                                    
                                
                                

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-sm-9 col-sm-offset-3 text-right">
                                        <button id="btn-signup" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> &nbsp Send</button>
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
    