
$('#url').keyup(function(){
	var inputUrl = $('#url').val();
	$('#sourceframe').attr('src',inputUrl);

});


function getallcards(pid)
{
alert(pid)
    $.ajax({
    url:baseurl+"projects/getallcards",
    type:'POST',
    data:'projectid='+pid,
    success:function(result){
      $('#cards').html(result);
    }
  });

}



$('#savebutton').click(function(pid){

  
  var cardtitle = $('#cardtitle').val();
  var stime = $('#stime').val();
  var content = $('#content').val();
  if(!cardtitle || !stime || !content)
  {
      return false;
  }
  $.ajax({
    url:baseurl+"projects/addcards",
    type:'POST',
    data:'cardtitle='+cardtitle+"&stime="+stime+'&content='+content+'&projectid='+pid,
    success:function(result){
      getallcards(pid);
      $('#downloadmarker').removeAttr('disabled');


      $("#downloadmarker").bind("click",function(){
          downloadmarker(result);
      });

    }
  });

});

function downloadmarker(filename)
{
   window.location = baseurl+'projects/downloadmarker/'+filename+'.wav';
}







function clearfields()
{
  $('#cardtitle').val('');
  $('#stime').val('');
  $('#content').val('');
}

function editCard()
{
  
}
