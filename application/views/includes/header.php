<?php

	if(!isset($document_type)){
		$document_type = 'case-file';
	}

	$controller = $this->uri->segment(1, null);
	$method = $this->uri->segment(2, null);
	$session = $this->session->userdata('session');
	if($session){
		$session_user = $this->session->userdata('session_user');
	}
	$id = $this->uri->segment(3, null);

	if(!isset($container_class)){
		$container_class = '';
	}

	if(!isset($hidden)){
		$hidden = '';
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url('images/favicon.ico') ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url('images/favicon.ico') ?>" type="image/x-icon">

		<?php if(empty($title) || $title == ''): ?>
			<title>ISO 14224</title>
		<?php else: ?>
			<title><?php echo $title; ?> | ISO 14224</title>
		<?php endif; ?>
		

		<?php $this->load->view('includes/header-scripts', $data); ?>

	</head>
	<body>

		<header>
            <div class="container">
                <div class="row disable-select">
                	
                    <!-- HEADER: LOGO AREA -->
                    <div class="col-xs-12 col-sm-6 logo">

						<?php if($controller == 'case-file' && $method == 'edit' || $controller == 'basic-decf' && $method == 'edit'): ?>
							<?php if($controller == 'case-file' && $method == 'edit'): ?>
							<h1 class="defect-elimination-title">
								Level 2 - Defect Elimination Process
							</h1>
							<?php elseif($controller == 'basic-decf' && $method == 'edit'): ?>
								<h1 class="defect-elimination-title">
								Level 1 - Defect Elimination Process
							</h1>
							<?php endif; ?>
						<?php elseif($controller == 'ofi' && $method == 'edit'): ?>
							<h1 class="defect-elimination-title">
								Opportunity for Improvement
							</h1>
						<?php elseif($controller == 'project-plan' && $method == 'edit'): ?>
							<h1 class="defect-elimination-title">
								Project Work Pack
							</h1>
						<?php elseif($controller == 'erp' && $method == 'edit'): ?>
							<h1 class="defect-elimination-title">
								Equipment Repair Profile
							</h1>
						<?php else: ?>
						<?php endif; ?>
                    
                       <?php if(($controller == 'case-file' || $controller == 'ofi' || $controller == 'project-plan' || $controller == 'erp' || $controller == 'basic-decf' ) && $method == 'edit'): ?>
							
                        <?php //elseif($controller == null): ?>
                        <?php else: ?>
                        	<h2 class="main-subtitle">
                        	<div class="col-sm-12" style="margin-top: 35px;">
                        		<?php if($controller == 'criticality-analysis' && ($method == 'history-availability' || $method == 'compliance-dashboard' || $method == 'data-input' || $method == 'single-index-of-failing-equipment')){ ?> 
                        		<div style="margin-left: -15px;">
                        		<h2 class="step-title align-title" style="color: #333;">Performance Dashboard </h2>
                        		</div>
                        		<?php }else{ ?>
                        		<a href="http://enkelt.co.uk"><img class="header-logo" src="<?php echo base_url('images/enkelt_logo.png'); ?>" /></a>
                        		<span class="slogan">
                        			Lessons Learned Super Highway
                        		</span>
                        		<?php } ?>
                        		<?php if($controller == 'iso14224' && $method == null): ?>
                        		<img class="header-logo oil-gas-logo" src="<?php echo base_url('images/oil_and_gas_logo.jpg'); ?>" />
                        		<?php endif; ?>
                        	</div>

                        	<!-- <div class="col-sm-2">
                        	<?php if($controller == 'iso14224' && $method == null): ?>
                        		<img class="header-logo oil-gas-logo" src="<?php echo base_url('images/oil_and_gas_logo.jpg'); ?>" />
                        	<?php endif; ?>	
                        	</div> -->
                        	</h2>
                        <?php endif; ?>
                       
                    </div>
                    <div class="col-xs-12 col-sm-6 <?php echo $hidden; ?> text-right">
					
						
							<?php 
								$search_attributes = array('class' => 'navbar-form', 'id' => 'header-search', 'role' => 'search');
								echo form_open('case-file/search', $search_attributes);
							?>

								<?php if($controller == '' && $method == ''): ?>
									<a href="https://www.facebook.com/pages/Enkelt/273503656187881" class="btn btn-default header-icon facebook-blue">
										<i class="fa fa-facebook fa-4x"></i>
									</a>
									<a href="https://twitter.com/AWilsonEnkel" class="btn btn-default header-icon twitter-blue">
										<i class="fa fa-twitter fa-4x"></i>
									</a>
									<a href="https://www.linkedin.com/company/iso14224-com?trk=top_nav_home" class="btn btn-default header-icon linkedin-blue">
										<i class="fa fa-linkedin fa-4x"></i>
									</a>
								<?php endif; ?>


								<?php if($controller == 'criticality-analysis' && ($method == 'history-availability' || $method == 'compliance-dashboard' || $method == 'data-input' || $method == 'single-index-of-failing-equipment' || $method == 'failure-rate')): ?>
									<a href="<?php echo base_url('criticality-analysis/current-availability'); ?>" class="btn btn-default header-button" data-toggle="tooltip" data-placement="top" title="Current Availability">
										<span class="glyphicon glyphicon-stats">
									</a>
									<a href="<?php echo base_url('criticality-analysis/history-availability'); ?>" class="btn btn-default header-button" data-toggle="tooltip" data-placement="top" title="History of Availability">
										<span class="glyphicon glyphicon-folder-close">
									</a>
									<a href="<?php echo base_url('criticality-analysis/compliance-dashboard'); ?>" class="btn btn-default header-button" data-toggle="tooltip" data-placement="top" title="Compliance">
										<span class="glyphicon glyphicon-filter">
									</a>
									<a href="<?php echo base_url('criticality-analysis/data-input'); ?>" class="btn btn-default header-button green" data-toggle="tooltip" data-placement="top" title="Equipment Status Update">
										<span class="glyphicon glyphicon-refresh"></span>
									</a>
									<a href="<?php echo base_url('criticality-analysis/single-index-of-failing-equipment'); ?>" class="btn btn-default header-button red" data-toggle="tooltip" data-placement="top" title="Single Index of Failing Equipment">
										<span class="glyphicon glyphicon-exclamation-sign">
									</a>
									<a id="failure-rate-button" href="<?php echo base_url('criticality-analysis/failure-rate'); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Failure Rate"></a>
								<?php endif; ?>

								<?php if($controller == 'user' && ($method == null || $method == 'start-activity')): ?>
									<a href="<?php echo base_url('page/golden-rule'); ?>" class="btn btn-default header-button green" data-toggle="tooltip" data-placement="top" title="Highway Code">
										<span class="glyphicon glyphicon-info-sign"></span>
									</a>
								<?php endif; ?>

								<?php if($method == "edit"): ?>
									<a href="<?php echo base_url($controller.'/view/'.$id); ?>" class="btn btn-success border-grey header-button" data-toggle="tooltip" data-placement="top" title="Review or print report"><span class="glyphicon glyphicon-list"></span></a>
								<?php endif; ?>

								<?php if($method == "edit" || $method == 'view' || $method == 'my-account'): ?>
									<?php if($method == 'edit'){ $print_tooltip = 'Only prints this step'; } ?>
									<?php if($method == 'view'){ $print_tooltip = 'Prints all steps'; } ?>
									<?php if($method == 'my-account'){ $print_tooltip = 'Print this Page'; } ?>
									<?php if($controller == 'user' || $controller == 'technical-bulletin' || $controller == 'technical-query' || $controller == 'ofi' || $controller == 'basic-decf' || $controller == 'case-file' || $controller == 'project-plan' || $controller == 'witness-statement' || $controller == 'erp'){ }else{?>
									<a href="<?php echo base_url('user/view-comments/'.$id); ?>" class="btn btn-default header-button" data-toggle="tooltip" data-placement="top" title="View Comments">
										<span class="glyphicon glyphicon-comment"></span>
									</a>
									<?php } ?>
									<a id="header-print-button" href="window.print();" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $print_tooltip; ?>"></a>
								<?php elseif(($session || (!$session && $method == 'view-tb-test')) && ($controller != 'user' && ($method != null || $method != 'start-activity')) && ($controller != 'iso14224' && $method == null)): ?>
									<?php $print_tooltip = 'Print this Page'; ?>
									<?php if($controller == 'erp' || $controller == 'action-tracker' && ($method == null)){ }else{?>
									<a id="header-print-button" href="window.print();" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="<?php echo $print_tooltip; ?>"></a>
									<?php } ?>
								<?php endif; ?>

								<?php if($controller == 'report' && $method == 'handover-report'){ ?>
								<a id="header-print-button" href="window.print();" class="btn btn-default" data-toggle="tooltip" data-placement="top" title=""></a>
								<?php } ?>

								<?php if($controller == 'user' && ($method == null || $method == 'start-activity')): ?>
									<a id="header-search-button" href="<?php echo base_url('document/search'); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Search Case File"></a>
								<?php endif; ?>

								<?php if(($method == null || $method == 'start-activity' || $method == 'edit') && $session): ?>
									<?php if($controller == 'erp'|| $controller == 'action-tracker' || $controller == 'iso14224' && ($method == null)){ }else{ ?>
									<a href="<?php echo base_url('user/my-account'); ?>" class="btn btn-default header-button" data-toggle="tooltip" data-placement="top" title="My Account">
										<span class="glyphicon glyphicon-user"></span>
									</a>
									<?php } ?>
								<?php endif; ?>

								<?php if($controller == 'iso14224'){ }else{ ?>
								<?php if(($controller != 'user' || ($controller == 'user' && $method == 'my-account') || ($controller == 'user' && $method == 'admin'))): ?>
									<?php if(($controller == 'user' || $controller == '') && ($method == '' || $method == 'login')): ?>
										
									<?php else: ?>
										<a id="header-home-button" href="<?php echo base_url('user'); ?>" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Home"></a>
									<?php endif; ?>
								<?php endif; ?>
								<?php } ?>
								
								<?php if($controller == 'user' && ($method == null || $method == 'start-activity')): ?>
									<a href="<?php echo base_url('user/logout'); ?>" class="btn btn-default header-button" data-toggle="tooltip" data-placement="top" title="Logout">
										<span class="glyphicon glyphicon-off"></span>
									</a>
								<?php endif; ?>

								<?php if($controller == 'user' &&($method == 'view-comments')): ?>
									<a href="<?php echo base_url($document_type.'/view/'.$id); ?>" class="btn btn-success pull-right create-criticality-analysis " data-original-title="" title="View Document"><span class="glyphicon glyphicon-list"></span></a>
								<?php endif; ?>
								
								
							<?php echo form_close(); ?>
                    </div>
                    
                </div>


                <div class="row">
                	<?php //if($controller == null && $method == null): ?>
						
                	<?php //else: ?>
	                	<div class="top_line"></div>
	                <?php //endif; ?>
                </div>
				
            </div>            
        </header>
	

	<section id="header">
		
	</section>