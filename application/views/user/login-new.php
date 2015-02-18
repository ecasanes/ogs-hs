<?php $this->load->view('layout/login-header', $data); ?>

    <body id="login-body">

        <nav id="navbar" class="site-navbar navbar navbar-static-top affix-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars fa-2x"></i>
            </button>
            <!-- <img class="navbar-brand" style="margin-top: 5px; width: 160px;" src="<?php echo base_url('theme/assets/img/enkelt-logo.png'); ?>" class="img-responsive" > -->
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
    <div class="row">
        <div class="col-sm-12">
            <div class="col-xs-12 col-sm-4 col-sm-offset-4">
               <div id="login-panel" class="panel panel-default form-container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">

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

        <?php echo form_open('user/validate_login', array('id' => 'loginform', 'class' => 'form-horizontal')); ?>
        <?php echo form_hidden('redirect_link', $redirect_link); ?>

        <p>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" name="username" class="form-control" id="exampleInputText1" placeholder="Username">
            </div>
        </p>
        <p>
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
        </p>



        <button type="submit" class="btn btn-danger btn-block" style="margin-bottom: 25px;">Login</button>

        <?php echo form_close(); ?>

        <!-- <p align="center">
            <a href="<?php echo base_url("user/forgot-password"); ?>">Forgot Password</a> | 
            <a href="<?php echo base_url("user/contact-us"); ?>">Contact Us</a>
        </p> -->

    </div>
</div>
</div> 
</div>
</div>
</div>
</div>

<?php $this->load->view('layout/login-footer', $data); ?>