<?php 
	
	if(empty($container_class)){
		$container_class = '';
	}

	if(empty($container_size)){
		$container_size = '';
	}

?>


	<!-- header scripts -->
	<script data-pace-options='{ "ajax": false }' src="<?php echo base_url('js/pace.min.js'); ?>"></script>
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
	<script src="<?php echo base_url('js/tinymce/tinymce.min.js'); ?>"></script>
	<!--<script src="//vjs.zencdn.net/4.7/video.js"></script>-->

	<!-- Bootstrap -->

	<link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('css/font-awesome.min.css'); ?>" rel="stylesheet">
	
	<link href="<?php echo base_url('css/bootstrap-timepicker.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('css/bootstrapValidator.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('css/jasny-bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('css/select2.css'); ?>" rel="stylesheet">

	<link href="<?php echo base_url('css/required-styles.css'); ?>" rel="stylesheet">

	<!-- <link href="//vjs.zencdn.net/4.7/video-js.css" rel="stylesheet"> -->

	<!-- Google Fonts -->

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet' type='text/css'>


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!--[if IE]>
		<link href="<?php echo base_url('css/ie.css'); ?>" rel="stylesheet">
	<![endif]-->

	<!-- Custom Style -->
	<link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet">



<?php if($container_class == 'fixed'): ?>
	<style>
		<?php if($container_size == 'lg'): ?>
			.container{
				width:100% !important;
			}
		<?php elseif($container_size == 'md'): ?>
			.container{
				width:1350px !important;
			}
		<?php elseif($container_size == 'sm'): ?>
			.container{
				width:1200px !important;
			}
		<?php elseif($container_size == 'xs'): ?>
			.container{
				width:1080px !important;
			}
		<?php endif; ?>
	</style>
<?php endif; ?>


<?php if($container_class == 'wide'): ?>
	<style>

		header{
		    position: absolute;
			top:0px;
			width:100% !important;
		}

		header .container{
			width:100% !important;
		}
		
		<?php if($container_size == 'lg'): ?>
			.container{
				width:2025px !important;
			}
		<?php elseif($container_size == 'xl'): ?>
			.container{
				width:2425px !important;
			}
		<?php elseif($container_size == 'md'): ?>
			.container{
				width:1600px !important;
			}
		<?php endif; ?>
		

		

		#main-content{
			margin-top:130px !important;
		}
	</style>
<?php endif; ?>