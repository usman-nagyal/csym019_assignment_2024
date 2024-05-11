var loaderImg="<div class='spinner-grow bg-primary' style='margin-left:41%; margin-top:13%; width:200px; height:200px;' role='status'><span class='sr-only'></span></div>";

var spinner="<div class='spinner-border spinner-border-sm text-dark' role='status'><span class='sr-only'></span></div>";

var spinnerSMALL="<div class='spinner-border spinner-border-sm text-dark' role='status'><span class='sr-only'></span></div>";

      $(document).ready(function(){
        
        loadnum=defaultNum;
        startload=0;
         panelSelect('admin_frontdeskchat','');
       
        feather.replace();

        

      })


  $('#menu a,#menu2 a').click(function(){
    var tabID=$(this).attr('id');
    
    loadnum=defaultNum;
        startload=0;
        
    $.ajax({
		url:tabID,
		type:'GET',
		data:{opt4:loadnum,opt5:startload},
		beforeSend: function(){
      $('#loadercontent').html(spinner);
		},
		success: function(respData){
			$('#loadercontent').html('');
      
      $('#content').html(respData);

      feather.replace();

		},
        error: function(XMLHttpRequest,textStatus,errorThrown){
            
            $('#loadercontent').fadeOut(0);
            //XMLHttpRequest.responseText+" "+textStatus+
            $('#loadercontent').html("<span class='text-warning'>internet connection interrupted...</span><a class='text-primary' href='/adminhome'>reload page</a>");
            $('#loadercontent').fadeIn(5000);

            }
	})


  })


  
  function panelSelect(tabID,dataValue=''){
    //toggle menu highlight color
    // opt2:dataValue,
    menuSelectOpt=tabID;
   
$.ajax({
    url:tabID,
    type:'GET',
    data:{opt4:loadnum,opt5:startload},
    beforeSend: function(){
  $('#loadercontent').html(spinner);
    },
    success: function(respData){
        $('#loadercontent').html('');
  
  $('#content').html(respData);

  feather.replace();



    },
    error: function(XMLHttpRequest,textStatus,errorThrown){
        
        $('#loadercontent').fadeOut(0);
        //XMLHttpRequest.responseText+" "+textStatus+
        $('#loadercontent').html("<span class='text-warning'>internet connection interrupted...</span><a class='text-primary' href='/adminhome'>reload page</a>");
        $('#loadercontent').fadeIn(5000);

        }
})


}





function deleteValue(refArray,item){
    var index = refArray.indexOf(item);
if (index !== -1) {
    refArray.splice(index, 1);
}
}




//submit forms
function submitForm(event,formID,route,respElemId,resetform=false){
  event.preventDefault();


  var form = $('#'+formID)[0];

  if(!form.checkValidity()){
    form.reportValidity();
    return false;
  }
 
  var data = new FormData(form);


  // If you want to add an extra field for the FormData
  // data.append("opt",route);
  
  $.ajax({
  type: "POST",
  enctype: 'multipart/form-data',
  url: "/"+route,
  data: data,
  processData: false,
  contentType: false,
  cache: false,
  beforeSend: function(){
    $("#"+respElemId).html(spinnerSMALL);
  },
  success: function (data) {
    
    $("#"+respElemId).html('');
    $("#"+respElemId).hide();
    $("#"+respElemId).html(data);
    feather.replace();
    $("#"+respElemId).fadeIn(1000);

   // reset form
   if(resetform)
     form.reset();


  },
  error: function(XMLHttpRequest,textStatus,errorThrown){
    $("#"+respElemId).fadeOut(0);
    //XMLHttpRequest.responseText+" "+textStatus+
    $("#"+respElemId).html("<span class='text-warning'>internet connection interrupted...</span><a class='text-primary' href='/adminhome'>reload page</a>");
    $("#"+respElemId).fadeIn(5000);
    }
  });
  
}