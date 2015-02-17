<?php
	

	$attributes	=	array( 'role'=>'form' , 'id' => '', 'class' => '' );

    echo form_open_multipart('', $attributes); 
    echo form_hidden('link_to', '');
    echo form_hidden('page', $controller);
?>