<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Filmsync &ndash; Dashboard</title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
	<link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->



	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
	<!-- END CSS FRAMEWORK -->
	
	<!-- BEGIN CSS PLUGIN -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/pace/pace-theme-minimal.css">
	<!-- END CSS PLUGIN -->
	
	<!-- BEGIN CSS TEMPLATE -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/filmsync.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins.css">
      
	<!-- END CSS TEMPLATE -->
</head>

<body class="skin-dark">
	<!-- BEGIN HEADER -->
	<header class="header">
		<!-- BEGIN LOGO -->
		<a href="<?php echo base_url(); ?>home" class="logo">
			<img src="<?php echo base_url(); ?>assets/img/logo.png" alt="FilmSync">
		</a>
		<!-- END LOGO -->
		<!-- BEGIN NAVBAR -->
		<nav class="navbar navbar-static-top" role="navigation">
			<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="fa fa-bars fa-lg"></span>
			</a>
			
<?php  $session =  $this->session->userdata('user_data'); ?>
                                                                                 
			<div class="navbar-right">
				<ul class="nav navbar-nav">
					
					<li class="dropdown profile-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

                                                        <?php if(isset($session['profile_pic']) && $session['profile_pic']) {?>
                                                        <img src="<?php echo site_url(); ?>images/profilepic/<?php echo $session['profile_pic'];?>" width=45 height=45 class="img-circle" alt="User Image">
                                                        <?php } else {?>

                                                        <img src="<?php echo site_url(); ?>assets/img/default_profilepic.jpeg" width=45 height=45 class="img-circle" alt="User Image">
                                                        <?php } ?>
							
                                                   
     
                                                        
                                                        <span class="username" ><?php if(isset($session['username'])){echo $session['username'];} ?></span>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu box profile">
							<li><div class="up-arrow"></div></li>
							<li class="border-top">
								<a href="<?php echo base_url();?>dashboard/accountsettings"><i class="fa fa-user"></i>My Account</a>
							</li>

							<li>
								<a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i>Log Out</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<!-- END NAVBAR -->
	</header>
	<!-- END HEADER -->
