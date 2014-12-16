<!-- BEGIN SIDEBAR -->

		<aside class="left-side sidebar-offcanvas">
			<section class="sidebar">
				<div class="user-panel">
                                    <?php 
                                     $session=  $this->session->userdata('user_data');                  
                                   /*     ?>
					<div class="pull-left image">
						<img src="<?php echo site_url(); ?>assets/img/user/avatar01.png" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
                                            <p><strong><?php echo ucfirst($session['username']);?></strong></p>
						
					</div>

					<?php  */ ?>

				</div>
                            <form action="<?php echo site_url(); ?>search/index/" id="form_search" method="get" class="sidebar-form" onsubmit="return search_check();">
					<div class="input-group">
						<input type="text" name="main_search" id="main_search" class="form-control" placeholder="Search..." value="<?php if(isset($main_search)){ echo $main_search; } ?>">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat" ><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
				<ul class="sidebar-menu">
				<?php  /* ?>
					<li>
						<a href="<?php echo site_url('home') ?>">
							<i class="fa fa-home"></i><span>Home</span>
						</a>
					</li>
					<?php */ ?>
					<li>
						<a href="<?php echo site_url('dashboard/') ?>">
							<i class="fa fa-bar-chart-o"></i><span>Dashboard</span>
						</a>
					</li>
					<li class="menu">
						<a href="#">
							<i class="fa fa-folder-open"></i><span>Projects</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="sub-menu">
                                                        <li><a href="<?php echo site_url('dashboard/allprojects/') ?>">All Projects</a></li>	
							<li><a href="<?php echo site_url('projects/') ?>">Add Project</a></li>
													

						</ul>
					</li>
					
				</ul>
			</section>
		</aside>
		<!-- END SIDEBAR -->
		