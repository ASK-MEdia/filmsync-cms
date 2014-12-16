
<?php echo $header;?>

<body class="skin-dark">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jquery-niftymodal/css/component.css">
<div class="wrapper row-offcanvas row-offcanvas-left">
<?php echo $sidebar;?>
		<!-- BEGIN CONTENT -->
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-home"></i>
				<span>All Projects</span>
				
			</section>
			<!-- END CONTENT HEADER -->
			
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row"></div>
				<div class="row">
					<!-- BEGIN WIDGET -->

					<div class="col-lg-12" >
					<div class="grid">
                                                <div class="row">
                                        <div class="col-lg-6">
                                        <div class="col">
                                            
                                           <div class="input-group">
                                                <input class="form-control" type="text" name="search" id="search" placeholder="Search Projects" value="<?php if(isset($search_item)){ echo $search_item; } ?>" >
                                                <span class="input-group-btn">
                                                        <div id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></div>
                                                </span>
                                          </div> 
                                             
                                                                                     
                                        </div>
                                        </div>
                                        <div class="col-lg-6"> 
                                           <div style="padding: 16px 34px; float:right"> 
                                               <a href="<?php echo base_url()."projects/index/";?>"><button class="btn btn-primary btn-radius" type="button"><i class="fa fa-plus"></i>&nbsp;Add new Project</button></a>
                                           </div>
                                        </div>        
                                                                                
                                        </div>     
                                            <div class="grid-header">
                                            <i class="fa fa-align-left"></i>
                                            <span class="grid-title">Projects</span>

                                    </div>
                                    <div class="grid-body">

                                    <?php 
                                    
                                    
                                    $page_links	= $this->pagination->create_links();

                                     if($page_links != ''):?>

                                     <?php endif;?>
                                     <?php echo (count($projects) < 1)?'<span>No Result</span>':''?>
                                        <div class="row">
                                         <?php  foreach ($projects as $latest_projects):?>
                                            
					                               <div class="col-lg-3 col-md-3 col-sm-4 prj-items">
                                           <div class="text-center">
                                           
                                           <span class="latest-projects-list-image"><a href="<?php echo base_url()."projects/index/".$latest_projects->id;?>"><img class="profile-img" width='200' height='150' src="<?php echo base_url()."images/thumbnail/".$latest_projects->image_name;?>" alt="">
                                           
                                           </a>
                                            <a href="javascript:void(0);" onclick="bindDelete(<?php echo $latest_projects->id; ?>)" class="md-trigger" data-modal="modal-4"><i class="fa fa-trash-o delete-class"></i></a>
                                           <span class="badge bg-blue latest-projects-list-badge">  <?php echo $latest_projects->card_count;?></span>

                                           </span>
                                           <span class="latest-projects-list-title"><?php echo $latest_projects->title;?></span>
                                           </div>
                                            
                                        </div>
					                              <?php endforeach;
                                         
                                          if($page_links != ''):?>
                                            <div class="col-sm-12">
                                            <div class="col">
                                                <?php echo $page_links;?>
                                            </div>
                                            </div>
                                                 <?php endif;?>
                                        
				        </div>
				   </div>
				</div>
				</div>
                                       
                                </div>  
                                    
    <div class="md-modal md-effect-1 dlte" id="modal-4" >
                  <div class="md-content modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel19">Confirm</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                    <!-- BEGIN BASIC FORM -->
                    <div class="col-md-11">
                  
                        
                    
                          <form method="post" action="" id="edit-form">
                            <div class="form-group">
                              Are you sure?<br>
                              Once deleted, The cards and markers related to this project will also be deleted.
                            </div>

                            </form>
                            </div>
                            </div>
                       
                 
                       </div>
                    <div class="modal-footer">
                      <div class="row">
                      <div class="col-lg-12">
                        <button type="button" class="btn btn-default md-close" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger save-pop-btn" id="confirmbtn">Confirm</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>                                
				
			</section>
			<!-- END MAIN CONTENT -->
		</aside>
		<!-- END CONTENT -->
		<div class="md-overlay"></div>
		<!-- BEGIN SCROLL TO TOP -->
		<div class="scroll-to-top"></div>
		<!-- END SCROLL TO TOP -->
	</div>


<?php echo $footer;?>

<script src="<?php echo base_url(); ?>assets/plugins/jquery-niftymodal/js/classie.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jquery-niftymodal/js/modalEffects.js"></script>

 <script type="text/javascript">
var baseurl = "<?php echo base_url(); ?>";
$( "#search" ).change(function() {
   
      
var keyword=$( "#search" ).val();
var formData = {keyword:keyword}; //Array
        
        console.log(formData);
        $.ajax({
            url : baseurl+'dashboard/allprojects',
            type: "POST",
            data : formData,
            success: function(data, textStatus, jqXHR)
            {
                $(".grid-body").html(data);
                
                //data - response from server
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });

});


function bindDelete(pid)
{
    $("#confirmbtn").unbind();

    $("#confirmbtn").bind("click",function(){
        deleteProject(pid)
    });


   
}



function deleteProject(projectid)
{

  $.ajax({
      url:baseurl+"projects/deleteproject",
      type:'POST',
      data:'projectid='+projectid,
      success:function(result){
        

        /*
        $("#confirmbtn").unbind();
        $('.modal-backdrop').remove();

        var modal = document.querySelector('#modal-4');
        var overlay = document.querySelector( '.md-overlay' );
         classie.remove( modal, 'md-show' );
          classie.remove( overlay, 'show' );
          */
        location.reload();

      }
    });
}

</script>