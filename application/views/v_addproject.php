  <?php echo $header; ?>
  <div class="wrapper row-offcanvas row-offcanvas-left">
    <?php  echo $sidemenu; ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jquery-niftymodal/css/component.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-summernote/summernote.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-summernote/summernote-bs3.css">
    <link href="<?php echo base_url(); ?>assets/css/introjs.css" rel="stylesheet">
<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; height: auto; } 
.embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }

.md-modal {
  max-height: 582px;
  overflow-y : scroll;
}

</style>

<script type="text/javascript">
/*
tinymce.init({
    selector: "textarea"
 });
*/
</script>




<aside class="right-side">
      <!-- BEGIN CONTENT HEADER -->
      <section class="content-header">
        <i class="fa fa-folder-open"></i>
        <span>Projects</span>
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url('dashboard');  ?>">Dashboard</a></li>
          <li><a href="<?php echo site_url('dashboard/allprojects');  ?>">Projects</a></li>
          <li class="active">Add Project</li>
        </ol>
      </section>
      <!-- END CONTENT HEADER -->
      
      <!-- BEGIN MAIN CONTENT -->
      <section class="content">
        <div class="row">
          <!-- BEGIN BASIC FORM -->
          <div class="col-md-7">
            <div class="grid">
              <div class="grid-header">
                <i class="fa fa-folder-open"></i>
                <span class="grid-title" ><?php  if(isset($projectid) && $projectid)
                   { echo 'Edit Project';}else{echo 'Add Project'; } ?> &nbsp;&nbsp;&nbsp;<i class="fa fa-exclamation-circle" style="cursor:pointer;" onclick="javascript:helpStart();"></i></span>
                <div class="pull-right grid-tools">
                  <a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
                </div>
              </div>
              <div class="grid-body">
                <form method="post" action="<?php echo site_url('projects/saveproject/'.$projectid) ?>" onsubmit="return validateForm();">
                  <div class="form-group" data-step="1" id="titleholder" data-intro="Enter the tile of your project" data-position='right'>
                    <label>Title <span style="color:#FF0000">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" value="<?php if(isset($projecttitle)){ echo $projecttitle;} ?>" >
                  </div>
                  <div class="form-group" data-step="2" id="descholder" data-intro="Enter the description for your project" data-position='right'>
                    <label>Description</label>
                    <textarea class="form-control" name="description" id="description"><?php if(isset($description)){ echo $description;} ?></textarea>
                  </div>

                  <div class="form-group" data-step="3" id="hashtagholder" data-intro="You can enter the twitter #tag associated with the project here so that the tweets for this #tag will be shown in the dashboard" data-position='right'>
                    <label>Twitter #tag</label>
                    <input type="text" class="form-control" name="hashtag" id="hashtag" value="<?php if(isset($hashtag)){ echo $hashtag;} ?>">
                  </div>

                  <div class="form-group" data-step="4" id="urlholder" data-intro="Enter the source url for your project" data-position='right'>
                    <label>Source Url</label>
                    <input type="text" class="form-control" name="url" id="url" value="<?php if(isset($url)){ echo $url;} ?>">
                  </div>

                  

                  <div class="input-group" style="width:100% !important;">



                <?php /* if(isset($projectid) && $projectid)
                   { ?>
                  <div>
                    <p>Status: <span class="status">&hellip;</span></p>
                  </div>
                  <?php  }else{ ?>
                    
                  <?php  }*/ ?>

                  <div id="videoframe" class='embed-container' data-step="5" id="sourceholder" data-intro="The video of your url will be displayed here" data-position='right'></div>
                  <div id="statuscontainer" style="display:none;">Status : <span id="streamtime"></span></div>
                  <input type="hidden" name="vimeotime" id="vimeotime" value="0">
                  </div>
                   
                  <div class="btn-group" style="padding:5px 0 0 0;">
                    <button type="submit" class="btn btn-primary" data-step="6" id="submitbutton" data-intro="Clicking here will save your project and will enable the cards tab" data-position='right'>Submit</button>
                  </div>

                  <div class="btn-group" id="addcard" style="display:none;padding:5px 0 0 0;">
                  
                    <button type="button" class="btn btn-primary md-trigger" data-modal="modal-1" onclick="$('#summernote').destroy();clearfields();" ><i class="fa fa-plus">&nbsp;&nbsp;</i>Add New card here</button>

                  </div>
  
                    
                </form>
              </div>
            </div>
          </div>
          <!-- END BASIC FORM -->
          <?php  if(isset($projectid) && $projectid)
          { ?>
          <!-- BEGIN HORIZONTAL FORM -->
          <div class="col-md-5">
            <div class="grid">
              <div class="grid-header">
                <i class="fa fa-align-left"></i>
                <span class="grid-title">Cards</span>
                <div class="pull-right grid-tools">
                  <a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
                </div>
              </div>
              <div class="grid-body">
                
                  <div class="col-lg-6 btngroup">
                <button type="button" id="addnewcard" data-step="7" data-intro="Click Here to add a new Card" data-position='left' class="md-trigger btn btn-primary btn-lg btn-block" data-modal="modal-1" onclick="$('#summernote').destroy();clearfields();"><i class="fa fa-plus">&nbsp;&nbsp;</i>Add New Card</button>
                  </div> 
                <div class="col-lg-6 btngroup"> 

                    <?php if(empty($cards))
                    {
                        $dis='disabled="disabled"';
                    }
                    else
                    {
                        $dis='';
                        
                    }?>
                    <button type="button" id="download_cards" data-step="13" data-intro="You can download all markers as a zip" data-position='left' <?php echo $dis;?> class="btn btn-primary btn-lg btn-block" ><i class="fa fa-download">&nbsp;&nbsp;</i>Download Markers&nbsp;&nbsp;(zip)</</button>

                 
                  </div>
                <div class="md-modal md-effect-1" id="modal-1" >
                  <div class="md-content modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel19" >Add Card <i class="fa fa-times md-close" data-dismiss="modal" style="float:right;"></i></h4>

                    </div>
                    <div class="modal-body">
                      <div class="row">
                    <!-- BEGIN BASIC FORM -->
                    <div class="col-md-11">
                      <div class="grid">
                        <div class="grid-body">
                          <form method="post" action="<?php echo site_url('projects/saveproject/'.$projectid) ?>">
                            
                            <div class="alert alert-danger" style="display:none" id="error_message">
                              <strong>Oh snap! </strong>  There is already a Cue point with the same title or time for this video.
                            </div>

                            <div class="form-group">
                              <label>Card Title <span style="color:#FF0000">*</span></label>
                              <input type="text" class="form-control" name="cardtitle" id="cardtitle"  >
                            </div>

                            <div class="form-group">
                              <label>Start Time <span style="color:#FF0000">*</span></label>
                              <input type="text" class="form-control" name="stime" id="stime" placeholder="hh:mm:ss"   >&nbsp;<span id="add_error" style="color:red"></span>
                            </div>

                              
                            <div class="form-group">
                              <label>Content <span style="color:#FF0000">*</span></label>
                              
                              <div id="content"></div>
                       
                            </div>

                            </form>
                            </div>
                            </div>
                            </div>
                            </div>

                       </div>
                    <div class="modal-footer">
                      <div class="row">
                      <div class="col-lg-6">
                      <button type="button" class="btn btn-primary" style="float:left;" disabled="" id="downloadmarker">
                        <i class="fa fa-download"></i> Download Marker
                      </button>
                      </div>
                      <div class="col-lg-6">
                          
                        <button type="button" class="btn btn-primary save-pop-btn "  id="savebutton">Save</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>


               <div class="md-modal md-effect-1" id="modal-2" >
                  <div class="md-content modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel19" >Edit Card<i class="fa fa-times md-close" data-dismiss="modal" style="float:right;"></i></h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                    <!-- BEGIN BASIC FORM -->
                    <div class="col-md-11">
                      <div class="grid">
                        
                        <div class="grid-body">
                          <form method="post" action="<?php echo site_url('projects/saveproject/'.$projectid) ?>" id="edit-form">
                            <div class="form-group" >
                              <label>Card Title <span style="color:#FF0000">*</span></label>
                              <input type="text" class="form-control" name="cardtitle" id="ctitle"  >
                            </div>

                            <div class="form-group">
                              <label>Start Time <span style="color:#FF0000">*</span></label>
                              <input type="text" class="form-control" name="stime" id="stm" placeholder="hh:mm:ss"  >&nbsp;<span id="edit_error" style="color:red"></span>
                            </div>

                            <div class="form-group">
                              <label>Content <span style="color:#FF0000">*</span></label>
                              <div id="summernote"></div>
                            </div>

                            </form>
                            </div>
                            </div>
                            </div>
                            </div>

                       </div>
                    <div class="modal-footer">
                      <div class="row">
                      <div class="col-lg-4">
                      <button type="button" class="btn btn-primary" style="float:left;" id="downloadmarkeredit">
                        <i class="fa fa-download"></i> Download Marker
                      </button>
                      </div>
                      <div class="col-lg-8">
                      <button type="button" class="btn btn-info" onclick="showPreview();">Live Preview</button>                   
                        <button type="button" class="btn btn-primary save-pop-btn " id="updatebutton">Save changes</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>

                 <div class="md-modal md-effect-1 dlte" id="modal-4" style="overflow-y:auto;">
                  <div class="md-content modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel19">Confirm</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                    <!-- BEGIN BASIC FORM -->
                    <div class="col-md-11">
                  
                        
                    
                          <form method="post" action="<?php echo site_url('projects/saveproject/'.$projectid) ?>" id="edit-form">
                            <div class="form-group">
                              Are you sure?<br>
                              Once deleted, you would need to remove the associated marker file from the source material. Else, the user will receive a “Content not available” message
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
                <div style="max-height:735px;display:block;width:100%;overflow-y:scroll">
                <table class="table" id="cardslist" data-step="14" data-intro="Created Cards are listed here. You can edit, view, and remove cards from here" data-position='left'>
                  <thead>
                    <tr>
                      <th>Card Title</th>
                      <th>Time</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="cards" style="height:100px;">
                    <?php foreach ($cards as $key => $value) {
                      ?>
                        <tr>
                            <td><a href="javascript:void(0);" class="md-trigger" data-modal="modal-2" onclick="editCard(<?php echo $value->id; ?>)"><?php echo $value->cardtitle ?></a></td>
                            <td><?php echo $value->time ?></td>
                            <td>
                              <a href="javascript:void(0);" title="Preview Card" onclick="preview(<?php echo $value->id; ?>)"><i class="fa fa-external-link"></i></a>
                              <a href="javascript:void(0);" title="Delete Card" class="md-trigger" data-modal="modal-4" onclick="bindDelete(<?php echo $value->id; ?>)"><i class="fa fa-trash-o"></i></a>

                            <!-- Confirm pop up -->
                              <div class="modal fade" id="modalDanger2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel12" aria-hidden="true">
                                <div class="modal-wrapper">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header bg-red">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel12">Confirm</h4>
                                      </div>
                                      <div class="modal-body">
                                        <p>Are you sure?</p>
                                        <p>Once deleted, you would need to remove the associated marker file from the source material. Else, the user will receive a “Content not available” message</p>
                                      </div>
                                      <div class="modal-footer">
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-danger" >Confirm</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <!-- Confirm pop up -->

                            </td>

                        </tr>
                    <?php  } ?>
                  </tbody>
                </table>
                </div>

              </div>
            </div>
          </div>
          <!-- END HORIZONTAL FORM -->
          <?php }else{?>
        

            <!-- For intro js -->
            <div class="col-md-5" style="display:none;" id="cardsholder">
            <div class="grid">
              <div class="grid-header">
                <i class="fa fa-align-left"></i>
                <span class="grid-title">Cards</span>
                <div class="pull-right grid-tools">
                  <a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>

                  <a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
                </div>
              </div>
              <div class="grid-body">

                  <div class="col-lg-6">
                <button type="button" id="addnewcard" data-step="7" data-intro="Clicking here will enable the card adding form and you can create card and download the marker" data-position='left' class="md-trigger btn btn-primary btn-lg btn-block" data-modal="modal-1" onclick="$('#summernote').destroy();clearfields();"><i class="fa fa-plus">&nbsp;&nbsp;</i>Add New Card</button>
                  </div> 
                <div class="col-lg-6"> 

                    <button type="button" id="download_cards" class="btn btn-primary btn-lg btn-block" data-step="13" data-intro="You can download all markers as a zip" data-position='left' ><i class="fa fa-download">&nbsp;&nbsp;</i>Download Markers&nbsp;&nbsp;(zip)</</button>

                  </div>

                <div class="md-modal md-effect-1" id="modal-1"  >
                  <div class="md-content modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel19" >Add Card<i class="fa fa-times md-close" data-dismiss="modal" style="float:right;"></i></h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                    <!-- BEGIN BASIC FORM -->
                    <div class="col-md-11">
                      <div class="grid">
                        <div class="grid-body">
                          <form method="post" action="<?php echo site_url('projects/saveproject/'.$projectid) ?>" >
                            <div class="form-group" >
                              <label>Card Title <span style="color:#FF0000">*</span></label>
                              <input type="text" class="form-control" name="cardtitle" id="cardtitle"  >
                            </div>

                            <div class="form-group" >
                              <label>Start Time <span style="color:#FF0000">*</span></label>
                              <input type="text" class="form-control" name="stime" id="stime" placeholder="hh:mm:ss"  ></span>
                            </div>

                            <div class="form-group" >
                              <label>Content <span style="color:#FF0000">*</span></label>
                              
                              <div id="content"></div>
                       
                            </div>

                            </form>
                            </div>
                            </div>
                            </div>
                            </div>

                       </div>
                    <div class="modal-footer">
                      <div class="row">
                      <div class="col-lg-6">
                      <button type="button" class="btn btn-primary" style="float:left;" disabled="" id="downloadmarker">
                        <i class="fa fa-download"></i> Download Marker
                      </button>
                      </div>
                      <div class="col-lg-6">
                        <button type="button" class="btn btn-primary save-pop-btn "  id="savebutton">Save</button>
                      </div>
                      </div>
                    </div>
                  </div>
                </div>


                <table class="table" id="cardslist" data-step="14" data-intro="Created Cards are listed here. You can edit, view, and remove cards from here" data-position='left'>
                  <thead>
                    <tr>
                      <th>Card Title</th>
                      <th>Time</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody id="cards" >
                        <tr>
                            <td>Card 1</td>
                            <td>5</td>
                            <td><a href="javascript:void(0);" class="md-trigger" data-modal="modal-2" ><i class="fa fa-edit"></i></a>
                              <a href="javascript:void(0);" title="Preview Card" ><i class="fa fa-external-link"></i></a>
                              <a href="javascript:void(0);" title="Delete Card" class="md-trigger" data-modal="modal-4" ><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

      <!-- For intro js  -->
  
            <?php } ?>
        </div>

      </section>
      </aside>
    <!-- BEGIN MODAL OVERLAY -->
    <div class="md-overlay"></div>
    <!-- END MODAL OVERLAY -->
      <div class="addcard-demo" id="addcard_demo" data-step="9" data-intro="Clicking here will enable the card adding form and you can create card and download the marker" data-position='left' style="background: none repeat scroll 0 0 #ffffff;
    border: medium none;
    height: auto;
    left: 50%;
    margin-left: -220px;
    margin-top: -200px;
    max-width: 600px;
    position: absolute;
    top: 50%;
    width: 50%;
    display:none;">

         <div class="md-content modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel19" >Add Card<i class="fa fa-times md-close" data-dismiss="modal" style="float:right;"></i></h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                    <!-- BEGIN BASIC FORM -->
                    <div class="col-md-11">
                      <div class="grid">
                        <div class="grid-body">
                            <div class="form-group" >
                              <label>Card Title <span style="color:#FF0000">*</span></label>
                              <input type="text" class="form-control" name="cardtitle" id="cardtitle-demo" data-step="8" data-intro="Enter the card title here" data-position='left'  >
                            </div>

                            <div class="form-group" >
                              <label>Start Time <span style="color:#FF0000">*</span></label>
                              <input type="text" class="form-control" name="stime" id="time-demo" data-step="9" data-intro="Enter the time when the card is to be shown" data-position='left'  placeholder="hh:mm:ss"  >
                            </div>

                            <div class="form-group" data-step="10" data-intro="Enter the contents that is to be shown" data-position='left'  >
                              <label>Content <span style="color:#FF0000">*</span></label>
                              
                              <div id="content-demo"></div>
                       
                            </div>

                            </div>
                            </div>
                            </div>
                            </div>

                       </div>
                    <div class="modal-footer">
                      <div class="row">
                      <div class="col-lg-6">
                      <button type="button" class="btn btn-primary" style="float:left;" disabled="" data-step="12" data-intro="Click here to download the marker file" data-position='left'  id="downloadmarker-demo">
                        <i class="fa fa-download"></i> Download Marker
                      </button>
                      </div>
                      <div class="col-lg-6">
                        <button type="button" class="btn btn-primary save-pop-btn" id="savebutton-demo" data-step="11" data-intro="Click here to save the card, The download button will be active once the marker is generated." data-position='left' >Save</button>
                      </div>
                      </div>
                    </div>
                  </div>

    </div>
      </div>


 
  <?php echo $footer; ?>
 <script src="<?php echo base_url() ?>assets/plugins/bootstrap-summernote/summernote.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jquery-niftymodal/js/classie.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jquery-niftymodal/js/modalEffects.js"></script>
  <script src="//f.vimeocdn.com/js/froogaloop2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/intro.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/nicescroll.js"></script>

<script type="text/javascript">

//$('.md-modal').niceScroll();

function validateForm()
{
   $('#title').css('border','1px solid #ccc');
   $('#hashtag').css('border','1px solid #ccc');
   var title = $('#title').val();
   var hashtag = $('#hashtag').val();
   if(!title)
   {
      $('#title').css('border','2px solid #FF0000');
      return false;
   }

   if(hashtag.indexOf('@') > -1)
   {
      $('#hashtag').css('border','2px solid #FF0000');
      return false;
   }

}

 /* SUMMERNOTE WYSIWYG */

/*   summer note for adding cards  */
            $('#content').summernote({
              height: 150,
              width : 475
            });

             $('#content-demo').summernote({
              height: 150,
              width : 475
            });


var baseurl = "<?php echo base_url(); ?>";

$('#url').keyup(function(){


  //  renderIframe();
showIframe()


});

function showIframe()
{


  var domain = "";
  var videoid = "";
  var inputUrl = $('#url').val(); 
  if(inputUrl.indexOf('http://') == -1 && inputUrl.indexOf('https://') == -1)
  { 
      inputUrl = 'http://'+inputUrl;
  }

  if(inputUrl.indexOf('youtu') >-1 )
  {
      domain = 'youtube';
      videoid = linkifyYouTubeURLs(inputUrl);
  }
  else if(inputUrl.indexOf('youtube') >-1 )
  {
      domain = 'youtube';
      videoid = linkifyYouTubeURLs(inputUrl);
  }
  else if(inputUrl.indexOf('vimeo') >-1 )
  {
      domain = 'vimeo';
      var match = /vimeo.*\/(\d+)/i.exec( inputUrl );
      videoid = match[1];
  }

  if(domain == 'vimeo')
  {
      videoframe = '<iframe src="http://player.vimeo.com/video/'+videoid+'" id="player1" style="width:100%;"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
  }
  else if(domain == 'youtube')
  {
      videoframe = '<iframe src="http://www.youtube.com/embed/'+videoid+'" id="player1" style="width:100%;" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
      
  }

  $('#statuscontainer').hide();
  $('#addcard').hide();
  $('#videoframe').html(videoframe);


}


function renderIframe()
{
  $('#statuscontainer').show();
  var inputUrl = $('#url').val(); 
  var domain = "";
  var videoid = "";
  var src = "";

  if(inputUrl.indexOf('http://') == -1 && inputUrl.indexOf('https://') == -1)
  { 
      inputUrl = 'http://'+inputUrl;
  }

  if(inputUrl.indexOf('youtu') >-1 )
  {
      domain = 'youtube';
      videoid = linkifyYouTubeURLs(inputUrl);
  }
  else if(inputUrl.indexOf('youtube') >-1 )
  {
      domain = 'youtube';
      videoid = linkifyYouTubeURLs(inputUrl);
  }
  else if(inputUrl.indexOf('vimeo') >-1 )
  {
      domain = 'vimeo';
      var match = /vimeo.*\/(\d+)/i.exec( inputUrl );
      videoid = match[1];
  }



  if(domain == 'youtube')
  {
    src = 'http://www.youtube.com/embed/'+videoid+'&autoplay=0';
    videoframe = '<div id="player1"></div>';

    $('#videoframe').html(videoframe);
    setTimeout(function(){ youtubeSteam(videoid); }, 1000);   
  }
  else if(domain == 'vimeo')
  {
      src = 'http://player.vimeo.com/video/'+videoid+'?api=1&player_id=player1';
      videoframe = '<iframe src="'+src+'" id="player1"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
      $('#videoframe').html(videoframe);
      vimeoSteam();
  }


  //$('#player1').attr('src',src);

}


function linkifyYouTubeURLs(text) {
    var re = /https?:\/\/(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube(?:-nocookie)?\.com\S*[^\w\s-])([\w-]{11})(?=[^\w-]|$)(?![?=&+%\w.-]*(?:['"][^<>]*>|<\/a>))[?=&+%\w.-]*/ig;
    return text.replace(re,
        '$1');
}

function bindDelete(cid)
{
    $("#confirmbtn").unbind();
    //$('#modal-4').show();
    $("#confirmbtn").bind("click",function(){
        deleteCard(cid)
    });


   
}


function getallcards()
{

  var pid = "<?php echo $projectid; ?>";
    $.ajax({
    url:baseurl+"projects/getallcards",
    type:'POST',
    data:'projectid='+pid,
    success:function(result){       
      $('#cards').html(result);
      
    }
  });
}

$('#savebutton').click(function(){

  $('#error_message').hide();
  $('#stime').css('border','1px solid #ccc');
  $("#downloadmarker").unbind();

  var pid = "<?php echo $projectid; ?>";
  var projectname = $('#title').val();
  var cardtitle = $('#cardtitle').val();
  var stime = $('#stime').val();
  var content = $('#content').code();

  if(!cardtitle || !stime || !content)
  {
      return false;
  }
  
  var grid = $('#modal-1');
  blockUI(grid);

  $.ajax({
    url:baseurl+"projects/addcards",
    type:'POST',
    data:'cardtitle='+cardtitle+"&stime="+stime+'&content='+encodeURIComponent(content)+'&projectid='+pid,
    success:function(result){
      if(result == 'exists')
      {
          $('#error_message').show();
          unblockUI(grid);
          return false;
      }


      getallcards();
      $('#downloadmarker').removeAttr('disabled');
      $('#download_cards').removeAttr('disabled');

      $("#downloadmarker").bind("click",function(){
          downloadmarker(result,projectname,cardtitle,stime);
      });

      setTimeout(function(){popupafterEdit();}, 1000);
      unblockUI(grid);

    }
  });

});

function updatechanges(cardid){

  var datastring = $("#edit-form").serialize();
  var grid = $('#modal-2');
  blockUI(grid);
  var cardtitle = $('#ctitle').val();
  console.log(cardtitle)
  var stime = $('#stm').val();
  var content = $('#summernote').code();
  content = encodeURIComponent(content);
  if(!cardtitle || !stime || !content)
  {
      return false;
  }

  $.ajax({
    url:baseurl+"projects/updatecards",
    type:'POST',
    data:'cardtitle='+encodeURIComponent(cardtitle)+"&stime="+stime+'&content='+content+'&cardid='+cardid,
    success:function(result){
      getallcards();

      setTimeout(function(){popupafterEdit();}, 1000);
      unblockUI(grid);
        
    }
  });

};

  function blockUI(grid) {
    $(grid).block({
      message: '<div class="loading"></div>',
      css: {
        border: 'none',
        padding: '2px',
        backgroundColor: 'none'
      },
      overlayCSS: {
        backgroundColor: '#fff',
        opacity: 0.5,
        cursor: 'wait'
      }
    });
  }


  function unblockUI(grid) {
    $(grid).unblock();
  }

function downloadmarker(filename,projectname,cardname,time)
{
  projectname = encodeURI(projectname);
  $.ajax({
      url:baseurl+"projects/isfileexists",
      type:'POST',
      data:'filename='+filename,
      success:function(result){
        if(result == "failed")
        {
           return false;
        }
        else
        {
            window.location = baseurl+'projects/downloadmarker/'+projectname+'/'+cardname+'/'+time+'/'+filename;
        }
      }
    });

}

$( "#download_cards" ).click(function() {
    var pid = "<?php echo $projectid; ?>";
    var projectTitle = $('#title').val();
    var pTitle = projectTitle.replace(/[^a-zA-Z ]/g, "");
    window.location = baseurl+'projects/downloadcards/'+pid+'/'+pTitle;
});



$( document ).ready(function() {
  var pid = "<?php echo $projectid; ?>";
  if(pid)
  {
    renderIframe();
  }
  //getallcards();
  
  
  
  var count="<?php echo count($this->uri->segment_array());?>";
  if(count==4)
  {
   var cardid=<?php echo $this->uri->segment(4, 0); ?>;

    $("#downloadmarkeredit").unbind();
    $("#updatebutton").unbind();
    $('#summernote').destroy();
    var projectTitle = $('#title').val();
    
    $.ajax({
      url:baseurl+"projects/getcarddetails",
      type:'POST',
      data:'cardid='+cardid,
      success:function(result){
                 
        var details = JSON.parse(result);
        if(details.length==0)
        {
            return false;
        }
        else
        {
            $('#ctitle').val(details.cardtitle);
            $('#stm').val(details.time);
            $('#summernote').html(details.content);
             /*   summer note for editing cards  */
             $('#summernote').summernote({
               height: 150,
               width : 475
             });

            $("#downloadmarkeredit").bind("click",function(){
               downloadmarker(details.id,projectTitle,details.cardtitle,details.time);
            });

            $("#updatebutton").bind("click",function(){
               updatechanges(details.id);
            });
            
            $('.md-overlay').addClass('show');
            $('#modal-2').addClass('md-modal md-effect-1 md-show');
                
       }
    }
    
    });
   
  }
  
  
  
    //called when key is pressed in textbox
  $("#stime").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 58)) {
        //display error message
        $("#add_error").html("Digits Only").show().fadeOut("slow");
               return false;
    }
   });
   
   $("#stm").keypress(function (e) {
      
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 58)) {
        //display error message
        $("#edit_error").html("Digits Only").show().fadeOut("slow");
               return false;
        }
   });
  
});


function clearfields()
{
  $('#cardtitle').val('');
  $('#error_message').hide();
  //$('#stime').val('');
  $('#content').code('');
  $('#downloadmarker').unbind();
  $('#downloadmarker').attr('disabled','disabled');
} 


function editCard(cardid)
{
    $("#downloadmarkeredit").unbind();
    $("#updatebutton").unbind();
    $('#summernote').destroy();
    var projectTitle = $('#title').val();
    var ptitle = projectTitle.replace(/[^a-zA-Z ]/g, "");
    $.ajax({
      url:baseurl+"projects/getcarddetails",
      type:'POST',
      data:'cardid='+cardid,
      success:function(result){
        var details = JSON.parse(result);
         $('#ctitle').val(details.cardtitle);
         $('#stm').val(details.time);
         $('#summernote').html(details.content);
          /*   summer note for editing cards  */
          $('#summernote').summernote({
            height: 150,
            width : 475
          });
           var cardTitle = details.cardtitle.replace(/[^a-zA-Z ]/g, "");

        $("#downloadmarkeredit").bind("click",function(){
            downloadmarker(details.id,ptitle,cardTitle,details.time);
        });

        $("#updatebutton").bind("click",function(){
            updatechanges(details.id);
        });
      
      }
    });
}

function preview(cardid)
{
  window.open(baseurl+'projects/preview/'+cardid)
}

function deleteCard(cardid)
{

  $.ajax({
      url:baseurl+"projects/deletecard",
      type:'POST',
      data:'cardid='+cardid,
      success:function(result){

        getallcards();
        
        $("#confirmbtn").unbind();
        $('.modal-backdrop').remove();
        setTimeout(function(){popupafterEdit();}, 1000);
        // $('#modal-4').fadeOut();
        var modal = document.querySelector('#modal-4');
        var overlay = document.querySelector( '.md-overlay' );
         classie.remove( modal, 'md-show' );
          classie.remove( overlay, 'show' );

      }
    });
}

   
function vimeoSteam()
{
  $(function() {
      var iframe = $('#player1')[0];
      var player = $f(iframe);
      var status = $('.status');

      // When the player is ready, add listeners for pause, finish, and playProgress
      player.addEvent('ready', function() {
          status.text('ready');
          
          player.addEvent('pause', onPause);
          player.addEvent('finish', onFinish);
          player.addEvent('playProgress', onPlayProgress);
      });

      // Call the API when a button is pressed
      $('button').bind('click', function() {
          player.api($(this).text().toLowerCase());
      });

      function onPause(data,id) {
       //   status.text('paused');
       var totalSec = $('#vimeotime').val();

      var hours = parseInt( totalSec / 3600 ) % 24;
      var minutes = parseInt( totalSec / 60 ) % 60;
      var seconds = totalSec % 60;
      var formatedSec = Math.round(seconds);
      var vimeotime = hours+':'+minutes+':'+formatedSec;

       $('#streamtime').html(vimeotime);
       $('#addcard').show();
       $('#stime').val(vimeotime);

      }

      function onFinish(id) {
          status.text('finished');
      }

      function onPlayProgress(data, id) {

          $('#streamtime').html('Playing..');
          $('#vimeotime').val(data.seconds);
          //status.text(data.seconds);
          $('#addcard').hide();
      }
  });
}

function youtubeSteam(videoId)
{
    (function() {
    var stopPlayAt = 10, // Stop play at time in seconds
        stopPlayTimer;   // Reference to settimeout call

    // This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement("script");
    tag.src = "//www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName("script")[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    // This function creates an <iframe> (and YouTube player)
    // after the API code downloads.
    var player;
    window.onYouTubeIframeAPIReady = function() {

      player = new YT.Player("player1", {
        "height": "315",
        "width": "560",
        "videoId": videoId,
        "events": {
          "onReady": onPlayerReady,
          "onStateChange": onPlayerStateChange
        }
      });
    }

    // The API will call this function when the video player is ready.
    // This automatically starts the video playback when the player is loaded.
    function onPlayerReady(event) {
      event.target.playVideo();

    }




    // The API calls this function when the player's state changes.
    function onPlayerStateChange(event) {
      var time, rate, remainingTime;
      clearTimeout(stopPlayTimer);
      
      $('#addcard').hide();
      time = player.getCurrentTime();

      if(event.data == 2)
      {
          var hours = parseInt( time / 3600 ) % 24;
          var minutes = parseInt( time / 60 ) % 60;
          var seconds = time % 60;
          var formatedSec = Math.round(seconds);
          var formatedTime = hours+':'+minutes+':'+formatedSec;

          $('#streamtime').html(formatedTime);
          $('#stime').val(formatedTime)
          $('#addcard').show();

      }
      else
      {
          $('#streamtime').html('Playing..');
      }

      
      if (event.data == YT.PlayerState.PLAYING) {
        
        // Add .4 of a second to the time in case it's close to the current time
        // (The API kept returning ~9.7 when hitting play after stopping at 10s)
        if (time + .4 < stopPlayAt) {
          rate = player.getPlaybackRate();
          remainingTime = (stopPlayAt - time) / rate;
          stopPlayTimer = setTimeout(pauseVideo, remainingTime * 1000);
        }
      }
    }

    function pauseVideo() {
      player.pauseVideo();
    }

  })();
}


function showPreview()
{
   var content = $('#summernote').code();
  
   content += '<style>img{width:100% !important;}</style>';
   myWindow= window.open(baseurl+'projects/livepreview',"", "width=600, height=700,scrollbars=1");
   myWindow.document.write(content);
   
    /* $.ajax({
      url:baseurl+"projects/savepreviewdata",
      type:'POST',
      data:'content='+encodeURIComponent(content),
      success:function(result){
         window.open(baseurl+'projects/livepreview',"", "width=600, height=700");                
      }
    });*/

}

function helpStart()
{
    introJs().onchange(function(targetElement) {  
      console.log(targetElement.id)
    switch (targetElement.id) 
        { 
        case "urlholder": 
          var url = $('#url').val();
          if(!url)
          {
              setTimeout(function(){
              $('#url').val('//player.vimeo.com/video/93452136');
              showIframe();
              }, 300);
          }
          $('#addcard_demo').hide();  
        break; 
        case "submitbutton": 
            $('#cardsholder').show();
            $('#addcard_demo').hide();
        break;
        case "addnewcard" :

            setTimeout(function(){
                $('#addcard_demo').show();

          }, 300);

        break; 
        case "cardtitle-demo": 
            $('#cardsholder').show();
            $('#addcard_demo').show();
        break;
        case "time-demo": 
            $('#cardsholder').show();
            $('#addcard_demo').show();
        break;
        case "content-demo": 
            $('#cardsholder').show();
            $('#addcard_demo').show();
        break;
        case "savebutton-demo": 
            $('#cardsholder').show();
            $('#addcard_demo').show();
        break;
        case "downloadmarker-demo": 
            $('#cardsholder').show();
            $('#addcard_demo').show();
        break;
        case "titleholder": 
            $('#addcard_demo').hide();
        break;
        case "descholder": 
            $('#addcard_demo').hide();
        break;
        case "urlholder": 
            $('#addcard_demo').hide();
        break;
        case "videoframe": 
            $('#addcard_demo').hide();
        break;
        case "download_cards": 
            $('#addcard_demo').hide();
        break;
         case "hashtagholder": 
            $('#addcard_demo').hide();
        break;
  
            
        }
}).onexit(function() {
    $('#cardsholder').hide();
    $('#addcard_demo').hide();
}).oncomplete(function(){
    $('#cardsholder').hide();
    $('#addcard_demo').hide();
}).start();



}


$(document).ready(function(){
  $('#stm').bind("paste",function(e) {
      e.preventDefault();
  });
$('#stime').bind("paste",function(e) {
      e.preventDefault();
  });

});




</script>







