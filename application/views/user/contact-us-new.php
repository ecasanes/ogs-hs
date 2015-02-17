<?php $this->load->view('layout/login-header', $data); ?>

    <body>

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

    <div id="loginbox" class="col-sm-6 col-sm-offset-3 col-xs-12">

    <div class="panel panel-info form-container">
        <div class="panel-heading text-center">
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

            $message_sent = $this->session->flashdata('message_sent');
            $message_failed = $this->session->flashdata('message_failed');
            ?>

            <?php if($message_sent): ?>
            <div class="alert alert-success fade in">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <?php echo $message_sent; ?>
          </div>
      <?php endif; ?>

      <?php if($message_failed): ?>
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
    <div class="col-sm-3">
    </div>                                        
    <div class="col-sm-9 text-right">
        <a href="<?php echo base_url('user/login'); ?>">Sign In</a>&nbsp;
        <button id="btn-signup" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> &nbsp; Send</button>
    </div>
</div>



<?php echo form_close(); ?>
</div>
</div>
</div>
</div>

<?php $this->load->view('layout/login-footer', $data); ?>
