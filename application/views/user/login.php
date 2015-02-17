<?php

  $login_check_img = base_url('images/logincheck.png');
  $user_login_img = base_url('images/userlogin.png');

?>

<div class="container">
  <div id="iso-row" class="row">

    <div id="iso-text" class="col-sm-7">
       <p align="justify" ><a id="iso-link" href="http://iso14224.com/iso14224" target="_blank"><b>ISO14224.com</b></a>
       A new dimension to maintenance. Making Personal Development, Knowledge Transfer and Continuous Improvement the driving 
       forces for Asset Integrity and Process Safety. A global knowledge transfer site for everyone involved in oil & gas, 
       regardless of position or location our toolkit and database can make reliability everyone’s business.
      </p>
      <p>
        <img id="green-check" src="<?php echo $login_check_img; ?>" width="15" height="15">Share warnings and alerts with Technical Bulletins
      </p>
      <p>
        <img id="green-check" src="<?php echo $login_check_img; ?>" width="15" height="15">Improve diagnostics with Technical Posts
      </p>
      <p>
        <img id="green-check" src="<?php echo $login_check_img; ?>" width="15" height="15">Search our database for similar issues and solutions
      </p>

      <p align="justify">
        Manage performance and contribution with step by step guides, auto populated reports and customised 
        dashboards for;
      </p>
      <p>
        <img id="green-check" src="<?php echo $login_check_img; ?>" width="15" height="15"> Forensic Defect Elimination
      </p>
      <p>
        <img id="green-check" src="<?php echo $login_check_img; ?>" width="15" height="15">Continuous Improvement
      </p>
      <p>
        <img id="green-check" src="<?php echo $login_check_img; ?>" width="15" height="15">Projects
      </p>        
     
      
    </div>

    <div class="col-sm-5">
      <div id="panel-login" class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title strong">Sign In</div>
                    </div>     

                    <div id="panel-login-body" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <!--<form id="loginform" class="form-horizontal" role="form">-->
                        <?php
                            $not_activated = $this->session->flashdata('not_activated');
                            $login_error = $this->session->flashdata('login_error');
                            $password_reset_success = $this->session->flashdata('password_reset_success');
                      $attributes = array(
                  'role' => 'form',
                  'class' => 'form-horizontal',
                  'id' => 'loginform'
                );
              echo form_open('user/validate_login', $attributes);
              echo form_hidden('redirect_link', $redirect_link);
            ?>

                            <?php if($not_activated): ?>
                                <div class="alert alert-warning fade in">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <strong>Note:</strong> <br/> You must activate your account before logging in. <br/> Please check your email for activation link. 
                                </div>
                            <?php endif; ?>

                            <?php if($login_error):?>
                                <div class="alert alert-danger fade in">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <strong></strong> Incorrect Username/Password 
                                </div>
                            <?php endif; ?>

                            <?php if($password_reset_success): ?>
                                <div class="alert alert-success fade in">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                  <strong></strong> <?php echo $password_reset_success; ?>
                                </div>
                            <?php endif; ?>

                            <p align="center" ><img src="<?php echo $user_login_img; ?>"></p>
                                    
                            <div class="input-group" id="firstlogin">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                              <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
                            </div></p>
                                
                            <div class="input-group" id="second">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                              <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                            </div>
                            <div id="second">
                              <button type="submit" id="btn-login" class="btn btn-success col-xs-12"><span class="glyphicon glyphicon-log-in"></span> Login  </button>
                            </div>
                                    
                    
                                <p align="center" class="col-xs-12"><a href="<?php echo base_url('user/contact-us'); ?>"> Contact Us
                                </a> | 
                                <a href="<?php echo base_url('user/forgot-password'); ?>"> Forgot Password
                                </a></p>
                            <?php echo form_close(); ?>
                            </div>
                            </div>
  </div>
  <div  class="row">

        <div class="col-sm-7" id="carousel">

          <div id="login-carousel" class="carousel slide col-sm-12" data-ride="carousel" style="margin-top:3px;">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#login-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#login-carousel" data-slide-to="1"></li>
            <li data-target="#login-carousel" data-slide-to="2"></li>
            <li data-target="#login-carousel" data-slide-to="3"></li>
            <li data-target="#login-carousel" data-slide-to="4"></li>
            <li data-target="#login-carousel" data-slide-to="5"></li>
            <li data-target="#login-carousel" data-slide-to="6"></li>  
          </ol>
 
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <!-- <div class="item active">
              <img class="img-responsive" src="<?php echo base_url('images/logo-slide-main.png'); ?>" alt="...">
            </div> -->
            <div class="item active">
              <img class="img-responsive" src="<?php echo base_url('images/logo-slide-7.png'); ?>" alt="...">
            </div>
             <div class="item">
              <img class="img-responsive" src="<?php echo base_url('images/logo-slide-8.png'); ?>" alt="...">
            </div>
            <div class="item">
              <img class="img-responsive" src="<?php echo base_url('images/logo-slide-9.png'); ?>" alt="...">
            </div>
            <div class="item">
              <img class="img-responsive" src="<?php echo base_url('images/logo-slide-12.png'); ?>" alt="...">
            </div>
             <div class="item">
              <img class="img-responsive" src="<?php echo base_url('images/logo-slide-13.png'); ?>" alt="...">
            </div>
             <div class="item">
              <img class="img-responsive" src="<?php echo base_url('images/logo-slide-10.png'); ?>" alt="...">
            </div>
             <div class="item">
              <img class="img-responsive" src="<?php echo base_url('images/logo-slide-11.png'); ?>" alt="...">
            </div>

          </div>

          
        </div>
        </div>

        <div class="col-sm-5">                    
            <div id="top-rated-bulletin" class="panel panel-primary dashboard-menu">
              <h3 class="panel-heading-title">Top Rated Bulletin</h3>
                <div class="panel-body">
                    <div class="row"> 
                        <div class="col-sm-12">
                          <div class="table-responsive">
                               <table class="table table-bordered my-account">
                                <thead>
                                  <tr>
                                    
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Likes</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    foreach($documents as $document): 
                                      $id = $document['id'];
                                      $code = $document['code'];
                                      $name = $document['name'];
                                      $likes = $document['likes'];

                                      if(empty($name) || $name == ''){
                                        $name = '[unnamed]';
                                      }
                                      
                                      $document_link = base_url('technical-bulletin/view/'.$id);
                                  ?>
                                    <tr>
                                       
                                       <td><?php echo $code; ?></td>
                                       <td><?php echo $name; ?></td>
                                       <td><?php echo $likes; ?></td>
                                       <td class="text-center">
                                        <a class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="View" href="<?php echo $document_link; ?>"><span class="glyphicon glyphicon-list"></span></a>
                                        </td>
                                    </tr>
                                  <?php endforeach; ?>
                                  
                                      
                                </tbody>
                                </table>
                              </div>
                              </div>
                              </div>
                              </div>
                              </div>
        </div>
        
          
        </div>
        

        

        


      

      
    
    