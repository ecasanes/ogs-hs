<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('includes/header-scripts-pdf'); ?>
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
						<?php elseif($controller == 'project-plan' && $method == 'edit'): ?>
							<h1 class="defect-elimination-title">
								Project Planning
							</h1>
						<?php else: ?>
							<h1 class="main-title">
								<a class="logo" href="<?php echo base_url(); ?>">&nbsp;</a>
							</h1>
						<?php endif; ?>
                    
                       <?php if(($controller == 'case-file' || $controller == 'ofi' || $controller == 'project-plan' ) && $method == 'edit'): ?>
							
                        <?php elseif($controller == null): ?>
                        	<!--<h2 class="secondary-subtitle">iso14224.com by <span>Enkelt</span></h2>-->
                        <?php else: ?>
                        	<h2 class="main-subtitle">
                        		<a href="<?php echo base_url(''); ?>">Enkelt</a> 
                        		<span class="slogan">
                        			<!-- Maintenance &amp; Integrity Management -->
                        			Lessons Learned Super Highway
                        		</span>
                        	</h2>
                        <?php endif; ?>
                       
                    </div>
                    <div class="col-xs-12 col-sm-4 col-sm-offset-1 <?php echo $hidden; ?> text-right <?php if(($session && ($controller == 'user' && $method != 'my-account')) || (!$session && $controller == null)){ echo 'logout'; } ?>">
					
						<?php if($session && ($controller == 'user' && $method != 'my-account')): ?>
							<a id="header-rule-link" href="<?php echo base_url('page/golden-rule'); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="Highway Code">?</a>
	                        <a id="header-logout-link" href="<?php echo base_url('user/logout'); ?>">logout</a>
	                    <?php else: ?>
						
	                    	<?php if($controller == 'login'): ?>

	                    	<?php endif; ?>

	                    	<?php if($controller == null && $method == null): ?>
								<!--<a id="header-login-link" href="<?php echo base_url('user/login'); ?>">login</a>-->
								<!--<a id="header-login-button" href="<?php echo base_url('user'); ?>" class="btn btn-default"></span></a>-->
	                    	<?php endif; ?>
								
	                    <?php endif; ?>
						
						<?php if($controller == 'case-file' || $controller == 'ofi' || $controller == 'project-plan' || ($controller == 'user' && $method == 'my-account') || $controller == 'page'): ?>
							<?php 
								$search_attributes = array('class' => 'navbar-form', 'id' => 'header-search', 'role' => 'search');
								echo form_open('case-file/search', $search_attributes);
							?>
							
								<?php if($method == "edit" || $method == 'view' || $method == 'my-account'): ?>
									<?php if($method == 'edit'){ $print_tooltip = 'Only prints this step'; } ?>
									<?php if($method == 'view'){ $print_tooltip = 'Prints all steps'; } ?>
									<?php if($method == 'my-account'){ $print_tooltip = 'Print this Page'; } ?>
									<a id="header-print-button" href="window.print();" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="<?php echo $print_tooltip; ?>"></a>
								<?php else: ?>
									<?php $print_tooltip = 'Print this Page'; ?>
									<a id="header-print-button" href="window.print();" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="<?php echo $print_tooltip; ?>"></a>
								<?php endif; ?>
								<a id="header-search-button" href="<?php echo base_url('case-file/search'); ?>" class="btn btn-default"></a>
								<a id="header-home-button" href="<?php echo base_url('user'); ?>" class="btn btn-default"></a>
								
							<?php echo form_close(); ?>
						<?php endif; ?>
                    </div>
                    
                </div>


                <div class="row">
                	<?php if($controller == null && $method == null): ?>
						
                	<?php else: ?>
	                	<div class="top_line"></div>
	                <?php endif; ?>
                </div>
				
            </div>            
        </header>
	

	<section id="header">
		
	</section>