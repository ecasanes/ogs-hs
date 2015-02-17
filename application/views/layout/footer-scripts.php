<?php

	$base_url = base_url('');
	$controller = $this->uri->segment(1, '');
	$method = $this->uri->segment(2, '');
	$session_id = $this->session->userdata('session');

?>

	<script type="text/javascript">

		var base_url = "<?php echo $base_url; ?>";
		var controller = "<?php echo $controller;  ?>";
		var method = "<?php echo $method;  ?>";

	</script>


    
    <script src="<?php echo $base_url.'theme/assets/bs3/js/bootstrap.min.js'; ?>"></script>

    <script src="<?php echo $base_url.'theme/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'; ?>"></script>
    <script src="<?php echo $base_url.'theme/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js'; ?>"></script>

	<!--theme/assets/plugins/bootstrap-wysihtml5/js/wysihtml5-0.3.0.min.js-->
	<!--theme/assets/plugins/bootstrap-wysihtml5/js/bootstrap-wysihtml5.js-->

	<!-- validator here -->

	<script src="<?php echo $base_url.'theme/js/plugins/jquery.cookie.js'; ?>"></script>

    <!-- icheck and select2 here-->
	
	<!-- float, dynatable, jquery.form here -->
	
	<script src="<?php echo $base_url.'theme/js/plugins/jquery.scrollUp.min.js'; ?>"></script>
	<script src="<?php echo $base_url.'theme/js/plugins/lightbox/lightbox.min.js'; ?>"></script>

    <script src="<?php echo $base_url.'theme/js/custom3.js'; ?>"></script>

    

	