
<?php echo $header;?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck/skins/square/blue.css">
<body class="skin-dark">

	
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<?php echo $sidebar;?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-search"></i>
				<span>Search Result</span>
				<ol class="breadcrumb">
					<li><a href="<?php echo base_url(); ?>dashboard">Home</a></li>
					
					<li class="active">Search Result</li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
					<!-- BEGIN SEARCH RESULT -->
					<div class="col-md-12">
						<div class="grid search">
							<div class="grid-body">
								<div class="row">
									<!-- BEGIN FILTERS -->
									<div class="col-md-3">
										<h2 class="grid-title"><i class="fa fa-filter"></i> Filters</h2>
										<hr>
										
										<!-- BEGIN FILTER BY CATEGORY -->
										<h4>By category:</h4>
                                                                                
										<div class="checkbox">
                                                                                    <?php
                                                                                    if(isset($cards_checkbox)){
                                                                                        if($cards_checkbox==1)
                                                                                        {
                                                                                            $cards_chk="checked";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $cards_chk='';
                                                                                        }
                                                                                    }
                                                                                    if(isset($projects_checkbox)){
                                                                                        if($projects_checkbox==1)
                                                                                        {
                                                                                            $projects_chk="checked";
                                                                                        }
                                                                                        else
                                                                                        {
                                                                                            $projects_chk='';
                                                                                        }
                                                                                    }
                                                                                    
                                                                                    ?>
											<input type="checkbox" class="icheck" id="projects_checkbox" name="projects_checkbox" <?php echo $projects_chk;?>><label class="icheck-label" for="projects_checkbox"> Projects</label>
										</div>
										<div class="checkbox">
											<input type="checkbox" class="icheck" name="cards_checkbox" id="cards_checkbox" <?php echo $cards_chk;?>><label class="icheck-label" for="cards_checkbox"> Cards</label>
										</div>
										
										
										
										<!-- END FILTER BY CATEGORY -->
										
										<div class="padding"></div>
										
				
									</div>
									<!-- END FILTERS -->
									<!-- BEGIN RESULT -->
									<div class="col-md-9">
										<h2><i class="fa fa-file-o"></i> Result</h2>
										<hr>
										<!-- BEGIN SEARCH INPUT -->
                                                                                
									<div class="input-group">
									<input class="form-control" type="text" name="sub_search" id="sub_search" placeholder="Search ..." value="<?php if(isset($sub_search)){ echo $sub_search; } ?>" >
									<span class="input-group-btn">
									<div id="sub_search-btn" class="btn btn-primary"><i class="fa fa-search"></i></div>
									</span>
									</div> 
									
								
                                                                           
										<!-- END SEARCH INPUT -->
										
										
										<div class="padding"></div>
										
										
										
										<!-- BEGIN TABLE RESULT -->
										<div class="table-responsive">
											<table class="table table-hover">
                                                                                                <?php 

                                                                                                $page_links	= $this->pagination->create_links();
                                                                                               $count=count($this->uri->segment_array());
                                                                                               if($count==6){
                                                                                                    $i = $this->uri->segment(6)+1;
                                                                                               }
                                                                                            else {$i=1;}
                                                                                                ?>
                                                                                                
                                                                                            <?php echo (count($search_result) < 1)?'<tr><td style="text-align:center;" colspan="2">No Results</td></tr>':''?>
												
                                                                                            <?php if(isset($search_result))
                                                                                            { 
                                                                                                foreach ($search_result as $results):?>
                                                                                            <tr>
													<td class="number text-center"><?php echo $i++;?></td>
<!--													<td class="image"><img src="assets/img/gallery/thumb/1.jpg" alt=""></td>-->
													<td class="product"><strong><?php
                                                                                                            if(isset($results->protitle)){
                                                                                                        if($results->protitle!='')
                                                                                                        {
                                                                                                        $title= $results->protitle;
                                                                                                        $id=$results->proId;
                                                                                                        $card_id='';
                                                                                                        $type="Project";
                                                                                                        }
                                                                                                            }
                                                                                                            if(isset($results->cardtitle)){
                                                                                                        if($results->cardtitle!='')
                                                                                                        {
                                                                                                        $title= $results->cardtitle;
                                                                                                        $id=$results->proId;
                                                                                                        $card_id=$results->cardId;
                                                                                                        $type="Card";
                                                                                                        }
                                                                                                            }
                                                                                                            
                                                                                                            ?><a href="<?php echo base_url()."projects/index/".$id."/".$card_id;?>" ><?php echo $title?></a>
                                                                                                                <br> </br>
                                                                                                            
                                                                                                            </strong></td>
                                                    <?php  if($type == 'Project'){$class="project-icon";}else{$class="card-icon";}  ?>                                                           
													<td class="text-right"><span class="<?php echo $class; ?>"><?php echo strtolower($type);?></span></td>
												</tr></a>
                                                                                            
                                                                                            <?php  endforeach;?>
                                                                                         <?php }?>
                                                                                                <tr><td style="text-align:center;" colspan="3"><?php 
                                                                                   if($page_links != ''):?><?php echo $page_links;endif;?></td></tr>
											</table>
                                                                                    
										</div>
										<!-- END TABLE RESULT -->
										
										<!-- BEGIN PAGINATION -->
										
										<!-- END PAGINATION -->
									</div>
									<!-- END RESULT -->
								</div>
							</div>
						</div>
					</div>
					<!-- END SEARCH RESULT -->
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
	
	
	<!-- BEGIN JS PLUGIN -->
	

	<script src="<?php echo base_url(); ?>assets/plugins/icheck/icheck.min.js"></script>
	
	<script type="text/javascript">
		/* ICHECK */
		/*$('.icheck').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});*/
		
		
	</script>
	<script type="text/javascript">
   var baseurl = "<?php echo base_url(); ?>";
$( "#sub_search" ).change(function() {
      
     
var sub_search=$("#sub_search" ).val();


var formData = {sub_search:sub_search}; //Array
      // alert(sub_search); 
        console.log(formData);
        $.ajax({
            url : baseurl+'search/index',
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR)
            {
                $(".table-responsive").html(data);
                
                //data - response from server
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });

});


   $('#projects_checkbox').change(function() {
        if($(this).is(":checked")) 
        {
            var projects=1;
        }
        else
        {
            var projects=0;
        }
              
        var chk=  $('input:checkbox[name=cards_checkbox]').is(':checked');
        if(chk==true)
        {
             var cards=1;
        }
        else
        {
             var cards=0;
        }
              
var sub_search=$( "#sub_search" ).val();


          var formData = {sub_search:sub_search,projects:projects,cards:cards}; //Array
          console.log(formData);
          if(sub_search!=''){
          $.ajax({
            url : baseurl+'search/index',
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR)
            {
                $(".table-responsive").html(data);
                
                //data - response from server
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
          }
        
             
    });
    
   $('#cards_checkbox').change(function() {
        if($(this).is(":checked")) {
            var cards=1;
        }
        else
        {
            var cards=0;
        }
            
            var chk=  $('input:checkbox[name=projects_checkbox]').is(':checked');
        if(chk==true)
        {
             var projects=1;
        }
        else
        {
             var projects=0;
        }
          
        var sub_search=$( "#sub_search" ).val();
        if(sub_search!=''){

          var formData = {sub_search:sub_search,projects:projects,cards:cards}; 
          console.log(formData);
          $.ajax({
            url : baseurl+'search/index',
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR)
            {
              $(".table-responsive").html(data);
                
                //data - response from server
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
    }
        
             
    });
    
    
</script>
	