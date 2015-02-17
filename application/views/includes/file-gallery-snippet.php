<?php

	if(isset($gallery_result)){
		$results = $gallery_result;
		if(!isset($gallery_title)){
			$gallery_title = "File Gallery";
		}
	}else{
		die();
	}
	

?>

<div class="row print-break">
	<div class="col-xs-12">
		<div class="page-header">
			<div class="row">
				<div class="col-xs-10">
					<p class="visible-print content-title" style="size: 20px;">
					</p>
					<h4 class="content-title"><?php echo $gallery_title; ?></h4>
				</div>
				<div class="col-xs-2 text-right">
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row-content">
	<div class="col-xs-12">
		<table class="table table-bordered">
			<?php 
			
			$container = array();

			$data1 = array_shift($results);
			$data2 = array_shift($results);

			if($data1 != null) { array_push($container, $data1); };
			if($data2 != null) { array_push($container, $data2); };

			while( ! empty($container) )
			{

				?>
				<tr>
					<?php foreach($container as $data) { ?>
					<td>
						<img class="img-responsive" src="<?php echo base_url("uploads/". $data); ?>">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
							incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
							nostrud exercitation ullamco laboris
						</p>
					</td>
					<?php } ?>

				</tr>
				<?php 
							    // Remove the printed data.
				$container = array();

							    // Push again.
				$data1 = array_shift($results);
				$data2 = array_shift($results);

				if($data1 != null) { array_push($container, $data1); };
				if($data2 != null) { array_push($container, $data2); };
			}
			?>	
		</table>
	</div>
</div>