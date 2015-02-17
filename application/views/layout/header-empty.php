<?php
    
    $controller = $this->uri->segment(1, null);
    $method = $this->uri->segment(2, null);
    $role = $this->session->userdata('session_role');
    $sidebar_state = $this->session->userdata('sidebar_state');
    $session_photo = $this->session->userdata('user_photo');
    $uploads_folder = 'uploads';
    $session_full_name = $this->session->userdata('session_full_name');
    $data = array(
        'session_photo' => $session_photo,
        'uploads_folder' => $uploads_folder, 
        'user_photo_url' => $session_photo,
        'full_name' => $session_full_name,
        'role' => $role,
        'controller' => $controller,
        'method' => $method,
    );
    if($method == 'edit'){
        $edit_method = true;
    }else{
        $edit_method = false;
    }

    $document_type = $controller;
    $id = $this->uri->segment(3, '');
    $view_url = base_url($document_type.'/view/'.$id);
?>


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

		<?php $this->load->view('layout/header-scripts'); ?>
    </head>


    <body class="<?php echo $sidebar_state; ?>">

    


                

                    
