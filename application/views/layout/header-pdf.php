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
        'method' => $method
    );
    if($method == 'edit'){
        $edit_method = true;
    }else{
        $edit_method = false;
    }

    $document_type = $controller;
    $id = $this->uri->segment(3, '');
    $view_url = base_url($document_type.'/view/'.$id);


    $base_url = base_url();
?>

<html>

    <head>
        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/bootstrap.css'; ?>">
        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/iriy-admin.css'; ?>">

        <link rel="stylesheet" href="<?php echo $base_url.'theme/assets/font-awesome/css/font-awesome.css'; ?>">

        
        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/plugins/jasny-bootstrap.min.css'; ?>">

        <link rel="stylesheet" href="<?php echo $base_url.'theme/assets/plugins/bootstrap-wysihtml5/css/bootstrap-wysihtml5.css'; ?>">

        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/plugins/jquery-select2.min.css'; ?>">
        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/plugins/bootstrap-switch.min.css'; ?>">

        <link rel="stylesheet" href="<?php echo $base_url.'theme/assets/plugins/jquery-icheck/skins/all.css'; ?>">
        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/plugins/jquery-icheck.min.css'; ?>">

        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/pe-icon-7-stroke.css'; ?>">

        <!-- Optional - Adds useful class to manipulate icon font display -->
        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/helper.css'; ?>">

        <link rel="stylesheet" href="<?php echo $base_url.'theme/css/custom.css'; ?>">

        <style>
            body{
                background:#fff !important;
                font-family:Arial, "Arial Narrow", sans-serif !important;
                font-size:14px;
            }

            .table tr td{
                padding:10px 12px;
            }

            .panel{
                box-shadow:none !important;
            }



            .label-xxs{
                width:auto !important;
            }

            .label-small{
                width:auto !important;
            }

            .label-full-width{
                width:100% !important
            }

            
        </style>
    </head>

    <body>

                    
