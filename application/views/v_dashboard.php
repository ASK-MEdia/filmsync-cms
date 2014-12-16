<?php echo $header;?>

<body class="skin-dark">
<div class="wrapper row-offcanvas row-offcanvas-left"> <?php echo $sidebar;?> 
	<!-- BEGIN CONTENT -->
	<aside class="right-side"> 
		<!-- BEGIN CONTENT HEADER -->
		<section class="content-header"> <i class="fa fa-home"></i> <span>Dashboard</span> </section>
		<!-- END CONTENT HEADER --> 
		
		<!-- BEGIN MAIN CONTENT -->
		<section class="content">
			<div class="row"> 
				<!-- BEGIN WIDGET -->
				<div class="col-sm-12">
					<div class="row">
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="grid widget bg-light-blue">
								<div class="grid-body"> <span class="title">Projects Count</span> <span class="value"><?php echo $projects_count;?></span> <span class="stat1 chart">&nbsp;</span> </div>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="grid widget bg-green">
								<div class="grid-body"> <span class="title">Cards Count</span> <span class="value"><?php echo $cards_count;?></span> <span class="stat2 chart">&nbsp;</span> </div>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="grid widget bg-purple">
								<div class="grid-body"> <span class="title">Cards Viewed</span> <span class="value"><?php if(isset($cards_viewed) && $cards_viewed){echo $cards_viewed;}else{echo 0;}  ?></span> <span class="stat3 chart">&nbsp;</span> </div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div>
							<a href="<?php echo base_url()."projects/index/";?>">
								<button class="btn btn-primary btn-radius" type="button"><i class="fa fa-plus"></i>&nbsp;Add new Project</button>
							</a>
							</div>
						</div>
					</div>
				</div>
				
				</div>
                <div class="row">
				
				<div class="col-lg-8" >
					<div class="grid">
						<div class="grid-header"> <i class="fa fa-align-left"></i> <span class="grid-title">Latest Projects</span> </div>
						<div class="grid-body">
							<div class="row">
								<?php foreach ($projects as $latest_projects):?>
								<div class="col-lg-4 col-md-4 col-sm-4 prj-items">
									<div class="text-center">
										
										<span class="latest-projects-list-image">
											<a href="<?php echo base_url()."projects/index/".$latest_projects->id;?>">
                                                                                            
                                                                                          
												<img class="profile-img" width='200' height='150' src="<?php echo base_url()."images/thumbnail/".$latest_projects->image_name;?>" alt="">
                                                                                         
											</a>
                                            <span class="badge bg-blue latest-projects-list-badge"><?php echo $latest_projects->card_count;?></span>
										</span>
                                        <p class="latest-projects-list-title"><?php echo $latest_projects->title;?></p>
                                        
									</div>
									
								</div>
								<?php endforeach;?>
							</div>
						</div>
					</div>
				</div>
                    					<div class="col-md-4">
						<div class="grid">
							<div class="grid-header">
								<i class="fa fa-twitter"></i>
								<span class="grid-title">Tweets</span>
								
							</div>
							<div class="grid-body">
                                               
                                                            <div id="content" style="overflow: scroll; height:330px">

                                                                 <?php   if(!empty($tweets)){?>
                                                                <ul >
                                                                <?php
                                                               
                                                                foreach ($tweets as $value) {
                                                                    ?>
                                                                    <div class="tweet-container">
                                                                 
                                                                        <img width="32" height="32" src="<?php echo $value[3];?> " />
                                                                 
                                                                        <p class="tweet-user-names" style="color:#428bca">
                                                                       
                                                                            <?php echo $value[2]; ?>
                                                                       
                                                                        
                                                                            @<?php echo $value[4]; ?>
                                                                       
                                                                    </p>
                                                                    <p class="tweet-time">
                                                                       
                                                                            <?php echo   $value[1]; ?>
                                                                      
                                                                    </p>
                                                                    <div class="tweet-text">
                                                                        <?php
                                                                            echo $value[0];
                                                                        ?>
                                                                    </div>
                                                               <div class="tweet-intents">
                                                                        <a class="intent-reply" title="Reply to this Tweet" href="https://twitter.com/intent/tweet?in_reply_to=<?php echo $value[5]; ?>">Reply</a>
                                                                        <a class="intent-retweet" title="Retweet this Tweet" href="https://twitter.com/intent/retweet?tweet_id=<?php echo $value[5]; ?>">Re-tweet</a>
                                                                        <a class="intent-favorite" title="Favourite this Tweet" href="https://twitter.com/intent/favorite?tweet_id=<?php echo $value[5]; ?>">Favourite</a>
                                                                    </div>
                                                                    </div>
                                                                    
                                                            
                                                                    
                                                                    
                                                            <?php
                                                                    }
                                                                ?>
                                                                    
                                                        
                                                                </ul>
                                                                 <?php }?>
                                                            <!-- End Twitter Feed Area  -->

                                                            </div>
                                                                
								
							</div>
						</div>
					</div>
			</div>
		</section>
		<!-- END MAIN CONTENT --> 
	</aside>
	<!-- END CONTENT --> 
	
	<!-- BEGIN SCROLL TO TOP -->
	<div class="scroll-to-top"></div>
	<!-- END SCROLL TO TOP --> 
</div>
    
<?php echo $footer;?>