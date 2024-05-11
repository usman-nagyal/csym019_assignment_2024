var loaderImg="<div class='spinner-grow bg-primary' style='margin-left:41%; margin-top:13%; width:200px; height:200px;' role='status'><span class='sr-only'></span></div>";

var spinner="<div class='spinner-border spinner-border-sm text-dark' role='status'><span class='sr-only'></span></div>";

var spinnerSMALL="<div class='spinner-border spinner-border-sm text-dark' role='status'><span class='sr-only'></span></div>";

      $(document).ready(function(){

        if (window.matchMedia("(max-width: 767px)").matches) 
          {              
             $('#sidebarToggle').click();
             setTimeout(()=>$('#sidebarToggle').click(),1000);
          }
  
        loadnum=defaultNum;
        startload=0;
        
        

        feather.replace();

        //for timeezones
        timezone_offset_minutes= new Date().getTimezoneOffset();
timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

// panelSelect("/breakingnews",'','content','loadercontent');

      })


      

$('#ultabs li a').click(function(){
    var clicked=$(this).attr('id');
      $('#ultabs li a:not(.qatar)').each(function(){

        if($(this).attr('id')==clicked){
          $(this).attr('class','nav-link text-secondary  active');
        }else{
          $(this).attr('class','nav-link text-dark');
        }
          
      })
      
  })


  $('#ultabs li').click(function(){
    var tabID=$(this).attr('id');
  
    if(!tabID)
        return false;
        
        loadnum=defaultNum;
        startload=0;

        if(tabID=='/soccerimages'){
          hideMobileDrawer();
          return $('#content').html("<div class='holds-the-iframe'><iframe src='/soccerimages?layout=1&opt4=12&opt5=0' style='width:100%; height:calc(100vh - 65px);' title='Iframe Example'></iframe></div>");
        }

   
    $.ajax({
		url:tabID,
		type:'GET',
		data:{opt4:loadnum,opt5:startload,tz:timezone_offset_minutes},
		beforeSend: function(){
      $('#loadercontent').html(spinner);

      //hide drawer panel onclick on small devices
      hideMobileDrawer();

		},
		success: function(respData){
        $('#loadercontent').html(''); 
			
        $('#content').html(respData);

      feather.replace();

      


		},
        error: function(XMLHttpRequest,textStatus,errorThrown){
            
            $('#loadercontent').fadeOut(0);
            //XMLHttpRequest.responseText+" "+textStatus+
            $('#loadercontent').html("<span class='text-warning'>internet connection interrupted...</span><a class='text-primary' href='/'>reload page</a>");
            $('#loadercontent').fadeIn(5000);

            }
	})


  })


  function hideMobileDrawer(){
     //hide drawer panel onclick on small devices
     if (window.matchMedia("(max-width: 767px)").matches) 
             {              
               setTimeout(()=>$('#sidebarToggle').click(),0);
             }
  }

  
  function panelSelect(tabID,dataValue='',respElemId,noticeMsg){
    //toggle menu highlight color
    // opt2:dataValue,

   
$.ajax({
    url:tabID,
    type:'GET',
    data:{opt:dataValue,opt4:loadnum,opt5:startload,tz:timezone_offset_minutes,opt6:'inpage'},
    beforeSend: function(){
  $('#'+noticeMsg).html(spinner);
    },
    success: function(respData){
        $('#'+noticeMsg).html('');
        var url=tabID+'?opt='+dataValue+'&opt4='+loadnum+'&opt5='+startload+'&tz='+timezone_offset_minutes;
        window.history.pushState({},"", url);
      
  
  $('#'+respElemId).html(respData);

  feather.replace();



    },
    error: function(XMLHttpRequest,textStatus,errorThrown){
        
        $('#'+noticeMsg).fadeOut(0);
        //XMLHttpRequest.responseText+" "+textStatus+
        $('#'+noticeMsg).html("<span class='text-warning'>internet connection interrupted...</span><a class='text-primary' href='/'>reload page</a>");
        $('#'+noticeMsg).fadeIn(5000);

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
function submitForm(event,formID,optValue,respElemId,noticeMsg){
  event.preventDefault();


  var form = $('#'+formID)[0];

  if(!form.checkValidity()){
    form.reportValidity();
    return false;
  }
 
  var data = new FormData(form);


  // If you want to add an extra field for the FormData
  data.append("formdata",1);
  
  $.ajax({
  type: "POST",
  enctype: 'multipart/form-data',
  url: "/"+optValue,
  data: data,
  processData: false,
  contentType: false,
  cache: false,
  beforeSend: function(){
    $("#"+noticeMsg).html(spinnerSMALL);
  },
  success: function (data) {
    
    $("#"+noticeMsg).html('');
    $("#"+respElemId).hide();
    $("#"+respElemId).html(data);
    feather.replace();
    $("#"+respElemId).slideDown(1000);
   // console.log("SUCCESS : ", data);


  },
  error: function(XMLHttpRequest,textStatus,errorThrown){
    $("#"+respElemId).fadeOut(0);
    //XMLHttpRequest.responseText+" "+textStatus+
    $("#"+respElemId).html("<span class='text-warning'>internet connection interrupted...</span><a class='text-primary' href='./main_page'>reload page</a>");
    $("#"+respElemId).fadeIn(5000);
    }
  });
  
}


