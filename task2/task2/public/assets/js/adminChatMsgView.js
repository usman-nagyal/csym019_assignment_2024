
var xTimer;
var xhr;
$(document).ready(function(){
    chatPanelSelect('/admin_show_usersonline','');

    xTimer = setInterval(function() {

        if(xhr.readyState>0 && xhr.readyState<4)
                  return false;
    chatPanelSelect('/admin_show_usersonline','','');
    }, 3000);
});




function chatPanelSelect(tabID,dataValue='',options=''){
    //toggle menu highlight color
    // opt2:dataValue,
    menuSelectOpt=tabID;
   
xhr=$.ajax({
    url:tabID,
    type:'GET',
    data:{opt4:loadnum,opt5:startload},
    beforeSend: function(){
//   $('#loadercontent').html(spinner);
    },
    success: function(respData){
        // $('#loadercontent').html('');
  
  $('#users_online_content').html(respData);



  feather.replace();



    },
    error: function(XMLHttpRequest,textStatus,errorThrown){

        if(XMLHttpRequest.status==0){
            clearTimeout(xTimer);
        }

        $('#loadercontent').fadeOut(0);
        //XMLHttpRequest.responseText+" "+textStatus+
        $('#loadercontent').html("<span class='text-danger'>internet connection interrupted...</span><a class='text-primary' href='/adminhome'>reload page</a>");
        $('#loadercontent').fadeIn(5000);

        }
})


}

function updateUsername(uid,uname){
    $('#username'+uid).html(uname);
}

function requestUpdateLink(clientid){
    $.post("/linkadmin",{visitorid:clientid},function(){
     
        chatPanelSelect('/admin_show_usersonline','','');
        //launch chat window
          openUserChatWindow(clientid);
    })
}

function openUserChatWindow(userid){
   
    $.get("/adminchatwindow",{visitorid:userid},function(respData){
    
        $('#adminChatWindow').html(respData);

        var target=$("#content #msg-list"+userid);
        target.animate({scrollTop:target.get(0).scrollHeight},0);
    })
}