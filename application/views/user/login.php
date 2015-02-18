

<!doctype html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
<head>
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>ISO 14224</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <link rel="shortcut icon" href="/favicon.ico">
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="stylesheet" href="<?php echo $base_url.'theme/css/bootstrap-cosmo.css'; ?>">
  <link rel="stylesheet" href="<?php echo $base_url.'theme/assets/font-awesome/css/font-awesome.css'; ?>">

        <!--[if lt IE 9]>
        <script src="<?php echo $base_url.'theme/assets/libs/html5shiv/html5shiv.min.js'; ?>"></script>
        <script src="<?php echo $base_url.'theme/assets/libs/respond/respond.min.js'; ?>"></script>
        <![endif]-->

        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/custom.css'; ?>">

      </head>

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



<nav id="login-footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
  <div class="container">
    
  </div>
</nav>
</body>


</html>