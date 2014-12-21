<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Filmsync</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
<link href="<?php echo base_url(); ?>assets/css/filmsync_singelpage.css" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url(); ?>assets/css/responsive.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>assets/plugins/jquery-2.1.0.min.js"></script>
</head>
<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; height: auto; } 
.embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
<body class="skin-dark">
<?php  
    $session=  $this->session->userdata('user_data');                   
  ?>
<!--Wrapper-->
<div class="wrapper">
	<!--header-->
    <div class="header">
    	<div class="header_conten">
        	<div class="logo"><img src="<?php echo base_url(); ?>assets/img/logo.png"></div>       
            <div class="riight_nav_holder">
				<?php
                if(isset($session['username']))
                { ?>
              <div class="user_holder" >

              <!-- 
              <div id="username">
                <div class="user_icon"><?php if(isset($session['profile_pic'])) {?> 
                    <img src="<?php echo site_url(); ?>images/profilepic/<?php echo $session['profile_pic'];?>" width=45 height=45 class="img-circle" alt="User Image">
                 <?php } ?></div>
                <div class="user_name" ><?php echo $session['username']; ?></div>
                </div>    
                <div class="clear"></div>
             <!--    <div class="user_dropdown" style="display:none;" id="dropdownmenu">
                    <ul>
                        <li><a href="<?php echo base_url();?>dashboard/accountsettings"><span class="li_icon"><img src="<?php echo base_url() ?>assets/img/my_acc_icon.png"></span>My Account</a></li>
                        <li><a href="<?php echo base_url();?>login/logout"><span class="li_icon"><img src="<?php echo base_url() ?>assets/img/logout_icon.png"></span>Log Out</a></li>
                    </ul>
                </div> -->
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




            </div>  
            <script type="text/javascript">

             $('body').click(function(){
                   // $('#dropdownmenu').hide();

                });

                $('#username').click(function(){
                    $('#dropdownmenu').toggle();

                });

            </script>


                <?php }else
                {?>
                 <a href="<?php echo site_url('login') ?>"><div class="menu_nav">Sign In</div></a>
                 <a href="<?php echo site_url('login/registration') ?>"><div class="menu_nav">Register</div></a>
               <?php }
                ?>
               
                <a href="<?php echo site_url('dashboard') ?>"><div class="menu_nav">Filmsync Tool</div></a>
                <a href="#"><div class="menu_nav">Documentation</div></a>
                
    


                <div class="clear"></div>
            </div>
        	<div class="clear"></div>
        </div>
    </div>
    <!--/header-->
	<!--slider holder-->
    <div class="banner_holder">
    	<div class="banner_content">
        	<div class="video_holder"><iframe src="//player.vimeo.com/video/93452136" width="100%" height="356" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
            <div class="text_holder">
            	<div class="text">
                An interactive second screen experience for film, video, news and presentations. <br>Download the FilmSync App to experience contextual content on your phone or tablet. 
                </div>
                <span><img src="<?php echo base_url(); ?>assets/img/itune_store.png"></span>
                <span><img src="<?php echo base_url(); ?>assets/img/android_store.png"></span>
            </div>
        </div>
    </div>
    <!--/ slider holder-->
    <!--App sync holder-->
    <div class="sync_holder">
    	<div class="sync_content">
        	<div class="sync_text_holder">
            	<div class="sync_text_holder_heading">Film Sync App.</div>
            	<div class="text">
                    FilmSync is a synchronized second screen app to be used during movies, documentary films, news video, live presentations and other linear experiences. FilmSync delivers an audience engagement experience in sync with the story allowing viewers to passively or actively consume additional, unique content as the story progresses, making movie-watching a more interactive experience. 
                    <br><br>
                    Viewers can engage with the content in many ways, including: interactive maps and timelines, enhanced graphics, data visualizations, satellite imagery, trivia and even interact with other audience members viewing the film.
    
                </div>
                <span><img src="<?php echo base_url(); ?>assets/img/itune_store.png"></span>
                <span><img src="<?php echo base_url(); ?>assets/img/android_store.png"></span>
            </div>
            <div class="screen_holder"><img src="<?php echo base_url(); ?>assets/img/mobile_screen.png"></div>
        </div>
    </div>
    <!--/ App sync holder-->
    <!--creat content holder-->
    <div class="cc_holder">
    	<div class="cc_top_text_holder">
        	<h2>Creating Second Screen Content</h2>
            <div class="text">
                Content producers and storytellers craft contextual content using the intuitive and easy admin tool for delivery in the FilmSync App or exsiting or custom App. Sign up for a free trial and create your first FilmSync project in just a few minutes. 
            </div>
        </div>
        
        <div class="cc_easytocreat_holder">
        	<div class="text">
            	<h3>Easy to create content</h3>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tristique dapibus lacus ac placerat. Aliquam lobortis auctor mauris ut consectetur. Vivamus porttitor, dui in porta efficitur, odio ipsum fringilla turpis,
                <div class="clear"></div>
                <?php
                if(!isset($session['username']))
                { ?>
                <a href="<?php echo site_url('login');  ?>"><div class="cc_button" style="float:right;">Sign Up</div></a>
                <?php } ?>
                <div class="clear"></div>
            </div>
            <div class="pic"><img src="<?php echo base_url(); ?>assets/img/cc_01.png"></div>
        </div>
        
        <div class="cc_iosandroid_holder">
        	<div class="pic"><img src="<?php echo base_url(); ?>assets/img/cc_02.png"></div>
            <div class="text">
            	<h3>IOS and Android SDK </h3>
                Using the iOS or Android FilmSync SDK producers can integrate the second-screen technology into a custom app or existing application. The well-documented SDK provides a custom integration while content can still be produced in the FilmSync Admin tool. Contact us for information about licensing the technology and using the SDK in your own app.
                <div class="clear"></div>
                <div class="cc_button" style="float:left;">Upgrade to Enterprise</div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <!--/ creat content holder-->
    <!--Pricing holder-->
    <div class="pricing_holder">
    	<div class="pricing_holder_top_text_holder">
        	<h2>Pricing</h2>
<!--             <div class="text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tristique dapibus lacus ac placerat. Aliquam lobortis auctor mauris ut consectetur. Vivamus porttitor, dui in porta efficitur, odio ipsum fringilla turpis, vitae imperdiet dui augue eget urna. Fusce efficitur, turpis et sagittis congue, ex sapien sodales enim.</div>
 -->        </div>
    </div>
    <!--/ Pricing holder-->
    <!--pricing plans holder-->
    <div class="pricing_plans_holder">
    
    
    
    
    		<div class="plans_2_holder">
            <div class="pricing_plans_holder_li">
            	<div class="heading">FilmSync Trial</div>
                <div class="rate"><span class="small">$</span>0</div>
                <div class="details">
                	<div class="details_heading">Free</div>
                	<div class="details_li">- 1 Project </div>
                    <div class="details_li">- 12 cards  </div>
                    <div class="details_li">&nbsp;</div>
                    <div class="details_li">&nbsp;</div>
                    <div class="details_li">&nbsp;</div>
      
                    
                    <div class="details_heading" style="margin-top:20px;"><a href="<?php echo site_url('login/registration'); ?>"><button type="button" class="btn btn-primary btn-lg btn-block">Signup</button></a></div>
                </div>
    		</div>
            
            <!-- <div class="pricing_plans_holder_li">
            	<div class="heading">FilmSync Producer</div>
                <div class="rate"><span class="small">$</span>9.99/m</div>
                <div class="details">
                	<div class="details_heading">$9.99/Month or $99/Year</div>
                	<div class="details_li">- 4 Project </div>
                    <div class="details_li">- 100 cards  </div>
                    <div class="details_li">&nbsp;</div>
                    <div class="details_li">&nbsp;</div>
                    <div class="details_li">&nbsp;</div>
                    
                    <div class="details_heading" style="margin-top:20px;"><a href="<?php echo site_url('login/registration'); ?>"><button type="button" class="btn btn-primary btn-lg btn-block">Signup</button></a></div>
                </div>
    		</div> -->


            </div>
            
            
            
            
            
            <div class="plans_2_holder">
            	
                <!-- <div class="pricing_plans_holder_li">
            	<div class="heading">FilmSync Unlimited</div>
                <div class="rate"><span class="small">$</span>49.99/m</div>
                <div class="details">
                	<div class="details_heading">$49.99 Month or $499 year</div>
                	<div class="details_li">- Unlimited Projects </div>
                    <div class="details_li">- Unlimited cards</div>
                    <div class="details_li"> &nbsp;</div>
                    <div class="details_li"> &nbsp; </div>
                    <div class="details_li"> &nbsp;</div>
                    
                    
                    <div class="details_heading" style="margin-top:20px;"><a href="<?php echo site_url('login/registration'); ?>"><button type="button" class="btn btn-primary btn-lg btn-block">Signup</button></a></div>
                </div>
    		</div> -->
            
            <div class="pricing_plans_holder_li">
            	<div class="heading">Enterprise License</div>
                <div class="rate"><span class="small">$</span>--</div>
                <div class="details">
                	<div class="details_heading">Contact us to discuss licensing FilmSync for your personal app.
</div>
                	<div class="details_li">&nbsp;</div>
                    <!-- <div class="details_li">- Unlimited Cards  </div>
                    <div class="details_li">- Integration Support  </div> -->
                    <div class="details_li"> &nbsp;</div>
                    <div class="details_li"> &nbsp; </div>
                    
                    
                    
                    <div class="details_heading" style="margin-top:20px;"><button type="button" class="btn btn-primary btn-lg btn-block">Contact</button></div>
                </div>
    		</div>
            </div>
    		
            
    </div>
    <!--/ pricing plans holder-->
	<!--footer-->
    <div class="footer_holder">Documentation&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Support&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Press Inquery	</div>
    <!--/ footer-->
</div>
<!--/ Wrapper--> 
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.js"></script>
    

</body>
</html>
