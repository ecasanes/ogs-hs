<?php

	$model = $this->uri->segment(1,null);
	$method = $this->uri->segment(2,null);

?>
	<div class="container" id="footer">
		<div class="row">
			<footer class="text-center">
				<?php
					if($model == null && $method == null):
				?>
					<!--<p>total knowledge transfer for design, operation, reliability and maintenance</p>-->
				<?php endif; ?>
			</footer>
		</div>
	</div>

	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->

	<script type="text/javascript">

		var base_url = "<?php echo base_url(''); ?>";
		var controller = "<?php echo $this->uri->segment(1, ''); ?>";
		var method = "<?php echo $this->uri->segment(2, ''); ?>";

	</script>
	
	<script src="<?php echo base_url('js/script.js'); ?>"></script>
	<script src="<?php echo base_url('js/custom.js'); ?>"></script>

	</div> <!-- #main-wrapper -->


	</body>
</html>