
var xTimer;
var xhr=null;
$(document).ready(function(){

    groupPanelSelect('showteamschat','','subgroup_content','loadercontent');
    groupPanelSelect('welcome','','userChatWindow3','loadercontent');

    if(xTimer)
    clearTimeout(xTimer);

    xTimer = setInterval(function() {

        if(xhr.readyState>0 && xhr.readyState<4)
                  return false;
        groupPanelSelect('showteamschat','','subgroup_content','');
    }, 3000);
});




function groupPanelSelect(tabID,dataValue='',respElemId,noticeMsg=''){
    //toggle menu highlight color
    // opt2:dataValue,
    menuSelectOpt=tabID;
   
xhr=$.ajax({
    url:'/'+tabID,
    type:'GET',
    data:{opt4:loadnum,opt5:startload},
    beforeSend: function(){
        if(noticeMsg!='')
  $('#'+noticeMsg).html(spinner);
    },
    success: function(respData){
        if(noticeMsg!='')
        $('#'+noticeMsg).html('');
  
  $('#'+respElemId).html(respData);

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




function updateAdminname(aid,aname){
    $('#adminname'+aid).html(aname);
}



function openUserGroupChatWindow(subgroupteamsid){
    $('#loadercontent').html(spinner);

    $.get("/usergroupchatwindow",{teamsid:subgroupteamsid,uname:$.cookie('chat_name')},function(respData){
     $('#loadercontent').html('');
        $('#userChatWindow3').html(respData);

        var target=$("#content #teams_msg-list"+subgroupteamsid);
        target.animate({scrollTop:target.get(0).scrollHeight},0);

    })
}