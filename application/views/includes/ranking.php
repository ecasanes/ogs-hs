<?php

	$like_class = '';

	if($ranking_like){
		$like_class = 'btn-like';
		$like_icon_class = 'fa-thumbs-up';
	}else{
		$like_icon_class = 'fa-thumbs-o-up';
	}

	$form_attributes	=	array( 'role'=>'form' , 'id' => 'rank-document', 'class' => 'form', 'name' => 'ranking_id' );
	$form_submit_url = base_url('document-ranking/save');
	$user_login_link = base_url();
	$document_id = $this->uri->segment(3,null);

     
?>

<div class="container">
	<div class="row content">
		<div style="padding:30px;"></div>
	</div>
	<div class="row content">
		<div id="ranking-container" class="feedback">
			<div id="feedback_button">
				<div class="pull-left rank-title"><?php echo $ranking_title; ?></div>  
				<div class="pull-right rank-toggle">
					<span class="glyphicon glyphicon-chevron-up"></div>
				</div>
			<?php echo form_open_multipart($form_submit_url, $form_attributes); ?>
				<?php echo form_hidden('ranking_id', $ranking_id); ?>
				<?php echo form_hidden('ranking', $ranking); ?>
				<?php echo form_hidden('document_id',$document_id); ?>
				<?php if($ranking_user_id): ?>
					<textarea name="ranking_comment" class="form-control" rows="3" ><?php echo $ranking_comment; ?></textarea>
				<?php else: ?>
					<?php echo form_hidden('ranking_comment',''); ?>
					<div class="form-control div-textarea disabled" rows="3">
						<p>Please login if you want to submit a comment.</p>
						<p><a href="<?php echo $user_login_link; ?>">Click this link to login</a></p>
					</div>
				<?php endif; ?>
				
				<br/>
			 	<span class="button-checkbox">
		        	<button id="like-button" type="button" class="btn btn-primary <?php echo $like_class; ?> " >
		        		<i class="fa fa-lg <?php echo $like_icon_class; ?>"></i> Like</button>
		        	<span class="like-count">100 likes</span>
		        	<?php echo form_hidden('ranking_like', $ranking_like); ?>
		    	</span>
				<button type="submit" class="btn btn-primary pull-right" data-loading-text="Saving...">Submit</button>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
