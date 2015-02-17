<?php $this->load->view('layout/login-header', $data); ?>

    <body class="body-sign-in">

        <nav id="navbar" class="site-navbar navbar navbar-static-top affix-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars fa-2x"></i>
            </button>
            <img class="navbar-brand" style="margin-top: 5px; width: 160px;" src="<?php echo base_url('theme/assets/img/enkelt-logo.png'); ?>" class="img-responsive" >
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul id="social-icons" class="nav navbar-nav navbar-right">
            <li><a class="fb-blue" href="https://www.facebook.com/pages/Enkelt/273503656187881"><i class="fa fa-facebook fa-2x"></i></a></li>
            <li><a class="bg twitter-blue" href="https://twitter.com/AWilsonEnkel"><i class="fa fa-twitter fa-2x"></i></a></li>
            <li><a href="https://www.linkedin.com/company/iso14224-com"><i class="fa fa-linkedin fa-2x"></i></a></li>
        </ul>
    </div>
</div>
</nav>

<div class="container">
    <div id="loginbox">                    
        <div class="panel panel-info form-container" >
            <div class="panel-heading">
                <div class="panel-title strong text-center">Forgot Password</div>
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
              <button type="submit" id="btn-login" class="btn btn-success btn-block"> <span class="glyphicon glyphicon-ok"></span> Submit  </button>

          </div>
      </div>
      <p align="center">
        <a href="<?php echo base_url('user/contact-us'); ?>"> Contact Us
        </a> | 
        <a href="<?php echo base_url('user/login'); ?>"> Sign In
        </a>
    </p>
    <?php echo form_close(); ?>
</div>               
</div>  
</div>
</div>

<?php $this->load->view('layout/login-footer', $data); ?>