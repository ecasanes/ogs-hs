

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






















    <?php
if(empty($controller) && empty($model)){
  $bg_1 = "theme/assets/img/oilrig1.jpg";
  $bg_2 = "theme/assets/img/oilrig2.jpg";
  $bg_3 = "theme/assets/img/oilrig3.jpg";
}else{
  $bg_1 = "../theme/assets/img/oilrig1.jpg";
  $bg_2 = "../theme/assets/img/oilrig2.jpg";
  $bg_3 = "../theme/assets/img/oilrig3.jpg";
}
?>

<nav id="login-footer" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
  <div class="container">
  </div>
</nav>



<script src="<?php echo $base_url.'theme/assets/libs/jquery/jquery.min.js'; ?>"></script>
<script src="<?php echo $base_url.'theme/assets/bs3/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo $base_url.'theme/js/plugins/jquery.backstretch.js'; ?>"></script>
<script>

var image = 

$.backstretch([
  "<?php echo $bg_1; ?>",
  "<?php echo $bg_2; ?>",
  "<?php echo $bg_3; ?>"
  ], {
    fade: 750,
    duration: 4000
  });
</script>
</body>


</html>