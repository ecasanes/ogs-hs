<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ISO 14224</title>

		<?php $this->load->view('includes/header-scripts'); ?>

	</head>
	<body>

		<?php

			$controller = $this->uri->segment(1, null);
			$method = $this->uri->segment(2, null);
			$session = $this->session->userdata('session');

		?>

		<header>
            <div class="container">
                <div class="row">
                	
                    <!-- HEADER: LOGO AREA -->
                    <div class="col-xs-12 col-sm-7 logo">

						<?php if($controller == 'case-file' && $method == 'edit'): ?>
							<h1 class="defect-elimination-title">
								Defect Elimination Process
							</h1>
						<?php elseif($controller == 'ofi' && $method == 'edit'): ?>
							<h1 class="defect-elimination-title">
								Opportunity for Improvement
							</h1>
						<?php else: ?>
							<h1 class="main-title">
								<a class="logo" href="<?php echo base_url(); ?>">&nbsp;</a>
							</h1>
						<?php endif; ?>
                    
                       <?php if(($controller == 'case-file' || $controller == 'ofi' ) && $method == 'edit'): ?>
							
                        <?php elseif($controller == null): ?>
                        	<h2 class="secondary-subtitle">iso14224.com by <span>Enkelt</span></h2>
                        <?php else: ?>
                        	<h2 class="main-subtitle">Enkelt <span class="slogan">Maintenance &amp; Integrity Management</span></h2>
                        <?php endif; ?>
                       
                    </div>
                    <div class="col-xs-12 col-sm-4 col-sm-offset-1 <?php echo $hidden; ?> text-right <?php if($session && $controller == 'user'){ echo 'logout'; } ?>">
					
						<?php if($session && $controller == 'user'): ?>
	                        <a id="header-logout-link" href="<?php echo base_url('user/logout'); ?>">Logout</a>
	                    <?php else: ?>
						
	                    	<?php if($controller == 'login'): ?>

	                    	<?php endif; ?>

	                    	<?php if($controller == 'user' && $method == null): ?>
								<a id="header-logout-link" href="<?php echo base_url('user/login'); ?>">Login</a>
								<!--<a id="header-login-button" href="<?php echo base_url('user'); ?>" class="btn btn-default"></span></a>-->
	                    	<?php endif; ?>
								
	                    <?php endif; ?>
						
						<?php if($controller == 'case-file' || $controller == 'ofi'): ?>
							<?php 
								$search_attributes = array('class' => 'navbar-form', 'id' => 'header-search', 'role' => 'search');
								echo form_open('case-file/search', $search_attributes);
							?>
							
								<?php if($method == "edit"): ?>
									<a id="header-print-button" href="window.print();" class="btn btn-default"></a>
								<?php endif; ?>
								<a id="header-search-button" href="<?php echo base_url('case-file/search'); ?>" class="btn btn-default"></a>
								<a id="header-home-button" href="<?php echo base_url('user'); ?>" class="btn btn-default"></a>
								
							<?php echo form_close(); ?>
						<?php endif; ?>
                    </div>
                    
                </div>


                <div class="row">
                	<div class="top_line"></div>
                </div>
				
            </div>            
        </header>
	

	<section id="header">
		
	</section>