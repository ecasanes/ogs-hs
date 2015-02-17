<?php

	$model = $this->uri->segment(1,null);
	$method = $this->uri->segment(2,null);

?>
	<div class="container">
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

</div> <!-- #main-wrapper -->


</body>
</html>