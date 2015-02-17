	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
	<script src="<?php echo base_url('theme/js/custom2.js'); ?>"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// Use php array loop.
			<?php foreach($listeners as $listener): ?>
				<?php print('Module.module1.'.$listener.'();'); ?>
			<?php endforeach ?>
		});	
	</script>
</html>