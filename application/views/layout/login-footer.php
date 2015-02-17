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