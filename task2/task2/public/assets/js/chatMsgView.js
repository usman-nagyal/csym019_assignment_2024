
var xTimer;
var xhr;
$(document).ready(function(){
    
   
    // chatWindow('welcome','');
    
    // chatPanelSelect('frontdesks_online','');

    // xTimer = setInterval(function() {

    //     if(xhr.readyState>0 && xhr.readyState<4)
    //               return false;
    //     chatPanelSelect('frontdesks_online','');
    // }, 3000);
});




function chatPanelSelect(tabID,dataValue=''){
    //toggle menu highlight color
    // opt2:dataValue,
    menuSelectOpt=tabID;
   
xhr=$.ajax({
    url:'/'+tabID,
    type:'GET',
    data:{opt4:loadnum,opt5:startload},
    beforeSend: function(){
//   $('#loadercontent').html(spinner);
    },
    success: function(respData){
        // $('#loadercontent').html('');
  
  $('#frontdesk_content').html(respData);

  feather.replace();


    },
    error: function(XMLHttpRequest,textStatus,errorThrown){
        
        if(XMLHttpRequest.status==0){
            clearTimeout(xTimer);
        }
        $('#loadercontent').fadeOut(0);
        // console.log(XMLHttpRequest.responseText+" "+textStatus+" "+XMLHttpRequest.status);
        $('#loadercontent').html("<span class='text-danger'>internet connection interrupted...</span><a class='text-primary' href='/'>reload page</a>");
        $('#loadercontent').fadeIn(5000);


        }
})
}


function chatWindow(tabID,dataValue=''){
    //toggle menu highlight color
    // opt2:dataValue,
    menuSelectOpt=tabID;
  
xhr=$.ajax({
    url:'/'+tabID,
    type:'GET',
    data:{opt4:loadnum,opt5:startload},
    beforeSend: function(){
//   $('#loadercontent').html(spinner);
    },
    success: function(respData){
        // $('#loadercontent').html('');
  
  $('#userChatWindow').html(respData);

  feather.replace();



    },
    error: function(XMLHttpRequest,textStatus,errorThrown){
        
        $('#loadercontent').fadeOut(0);
        //XMLHttpRequest.responseText+" "+textStatus+
        $('#loadercontent').html("<span class='text-danger'>internet connection interrupted...</span><a class='text-primary' href='/'>reload page</a>");
        $('#loadercontent').fadeIn(5000);

        }
})
}


function updateAdminname(aid,aname){
    $('#adminname'+aid).html(aname);
}


function requestUpdateLink(frontdeskid){
   
    $.post("/linkuser",{adminid:frontdeskid},function(){
  
        chatPanelSelect('frontdesks_online','');
        openUserChatWindow(frontdeskid);
    })
}


function openUserChatWindow(frontdeskid){
    $.get("/userchatwindow",{adminid:frontdeskid},function(respData){
     
        $('#userChatWindow').html(respData);

        var target=$("#content #msg-list"+frontdeskid);
        target.animate({scrollTop:target.get(0).scrollHeight},0);

    })
}