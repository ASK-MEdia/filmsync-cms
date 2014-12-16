<?php echo $header;  ?>

<div style="padding:40px 0 40px 0">
</div>
<div class="row">
  <div class="col-md-4">Left side Menu</div>
  <!-- center part -->
  <div class="col-md-4">
		<form method="post" action="<?php echo site_url('projects/saveproject/'.$projectid) ?>">
			<div class="input-group">
			<label>Project Title</label>
          	<input type="text" class="form-control" name="title" id="title" value="<?php if(isset($title)){ echo $title;} ?>" >
        	</div>

        	<div class="input-group">
			<label>Project Description</label>
          	<textarea class="form-control" name="description" id="description"><?php if(isset($description)){ echo $description;} ?></textarea>
        	</div>

        	<div class="input-group">
			<label>Source Url</label>
          	<input type="text" class="form-control" name="url" id="url" value="<?php if(isset($url)){ echo $url;} ?>">
        	</div>

        	<div class="input-group">
				<iframe src="<?php if(isset($url)){ echo $url; }  ?>" width="500" height="281" id="sourceframe" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        	</div>

        	<div class="input-group">
          	<button type="submit" class="btn btn-default">Submit</button>
        	</div>

		</form>
	
  </div>
  <!-- center part -->
  <div class="col-md-4">.col-md-4</div>
</div>

</div>


<script type="text/javascript">
	
$('#url').keyup(function(){
	var inputUrl = $('#url').val();
	$('#sourceframe').attr('src',inputUrl);

});


</script>


<?php echo $footer; ?>




