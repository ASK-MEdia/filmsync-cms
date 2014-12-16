
<?php echo $header;?>

<body class="skin-dark">
		
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php echo $sidebar;?>
		<!-- BEGIN CONTENT -->

		<!-- BEGIN CONTENT -->
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-user"></i>
				<span>My Account</span>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url();?>dashboard">Home</a></li>
					<li class="active">My Account</li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			
			<!-- BEGIN MAIN CONTENT -->
                            <?php if(isset($messages)): ?>
                                                    <div class="alert alert-danger">

                                                    <?php echo $messages; ?>
                                                    </div>
                                                    <?php endif; ?>
			<section class="content">
				<div class="row">
					<!-- BEGIN USER PROFILE -->
					<div class="col-md-12">
						<div class="grid profile">
							<div class="grid-header">
								<div class="col-xs-2">
                                                                    <?php if( isset($userdetails[0]->profile_pic) && $userdetails[0]->profile_pic=='') {?>
                                                                    <img src="<?php echo base_url();?>assets/img/default_profilepic.jpeg" class="img-circle" alt="">
                                                                    <?php } else {?>
                                                                    
									<img src="<?php echo base_url();?>images/profilepic/<?php echo  $userdetails[0]->profile_pic;?>" class="img-circle" alt="">
                                                                    <?php } ?>
                                                                </div>
								<div class="col-xs-7">
									<h3><?php echo $userdetails[0]->username?></h3>
									
								</div>
								
							</div>
							<div class="grid-body">
								<ul class="nav nav-tabs">
									
									<li class="active"><a href="#timeline" data-toggle="tab">Account</a></li>
								</ul>
								<div class="tab-content">
									<!-- BEGIN PROFILE -->
									
									<div class="tab-pane active" id="timeline">
										<p class="lead">My Account</p>
										<hr>
										<div class="grid-body">
								
                                                                    <form class="form-horizontal" role="form" action="<?php echo base_url();?>dashboard/accountsettings" method="POST" enctype="multipart/form-data" >
									<div class="form-group">
										<label class="col-sm-2 control-label">Username</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="username" name="username" placeholder="username" value="<?php echo isset($userdetails[0]->username) ? $userdetails[0]->username : set_value("username") ?>">
										
                                                                                 <span style="color:red"> <?php echo form_error('username'); ?></span>
                                                                                </div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Email</label>
										<div class="col-sm-10">
                                                                                   <?php echo $userdetails[0]->email?>
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-sm-2 control-label">App Secretkey</label>
										<div class="col-sm-10">
                                                                                    <?php echo $userdetails[0]->appsecret?>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Organization</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="organization" name="organization"  placeholder="Organization" value="<?php echo isset($userdetails[0]->organization) ? $userdetails[0]->organization : set_value("organization") ?>">
										</div>
									</div>
                                                                        <div class="form-group">
										<label class="col-sm-2 control-label">Photo</label>
										<div class="col-sm-10">
											 <input type="file" name="profile_pic"  />
                                                                                       
										</div>
									</div>
                                                                        
                                                                        
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
                                                                                    <div class="btn-toolbar"
											<div class="btn-group">
                                                                                             <input type="submit" name="submit" value="Save" class="btn btn-primary" />
												
												 <a href="<?php echo site_url("dashboard/accountsettings"); ?>"><button style="margin-left: 10px;"type="button" class="btn  btn-warning">Cancel</button></a>
											</div>
                                                                                </div>
										</div>
									</div>
                                                                        
                                                                        
								</form>
							</div>
									</div>
									<!-- END PROFILE -->
									
								</div>
							</div>
						</div>
					</div>
					<!-- END USER PROFILE -->
				</div>
			</section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
		<!-- END CONTENT -->
		
		<!-- BEGIN SCROLL TO TOP -->
		<div class="scroll-to-top"></div>
		<!-- END SCROLL TO TOP -->
	</div>


<?php echo $footer;?>
