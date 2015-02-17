<?php if($file_name == ''){

	echo 'No Floorplan Image yet!';
}else{ ?>

	<img id="image" class="floorplan-image img-responsive" src="<?php echo base_url('uploads/'.$file_name); ?>"/>


<?php } ?>

