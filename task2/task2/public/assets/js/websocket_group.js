var conn;
// var chatName='';
var keepalive="off";

 $(document).ready(function(){
   $("#content #setname_section #username").html(chatName);
    //*******************WEBSOCKECT CODE******************************//
    if(!conn)
    conn = new WebSocket(websocket_url);

   conn.onopen = function (e) {
   console.log("group Connection established");
   keepalive="on";
   // alert("Connection established ");

  /*assign username*/
  chatName=$.cookie('chat_name');

  if(!chatName){
   var stamp=(new Date()).getTime();
   chatName='Anonymous'+stamp;
   $.cookie('chat_name',chatName);
   }
   $("#content #setname_section #username").html(chatName);
  
   insertUpdateClientInfo();

   };

   setInterval(function(){
    var message={
      username:chatName,
       sessionid:$.cookie('PHPSESSID'),
       type:'alive_heart_beat'
     }
  
     conn.send(JSON.stringify(message));
     console.log('sent');
   },20000);


    // Log messages from the server
    conn.onmessage = function (e) {
   
      var msgObj=JSON.parse(e.data);

      var date=new Date();
      var currenttime=formatAMPM(date);    

      var target=$("#content #teams_msg-list"+msgObj.subgroupid);
         target.animate({scrollTop:target.get(0).scrollHeight},1000);
   
      if(msgObj.type=='group_user_chating'){

         target.append("<div class='d-flex text-end align-items-block mb-1'><div><div class='rounded-circle avator '><img src='/photos/user_avatar.png' class='img-fluid rounded-circle' style='padding:1px;' alt='Avatar'></div></div><div class='pe-2 ms-1  bg-transparent'><div><div class='text-light text-start fw-bold' style='font-size:12px;'>"+msgObj.username+"</div><div class='card card-admin-chat d-inline-block m-0 p-1' style='float:left; clear:both;'>"+msgObj.msg+"</div></div><div><div class='small text-secondary' style='float:left; clear:both;'>"+currenttime+"</div></div></div></div>");

        

      }else if(msgObj.type=='server_response'){
        
         // $('#loadercontent').html(msgObj.msg);

         target.append("<div class='d-flex text-end align-items-block mb-1'><div class='pe-2 ms-1 bg-transparent'><div><div class='card card-admin-chat d-inline-block'>"+msgObj.msg+"</div></div></div></div>");
         
      }

      playAudio();

      };
      

   


   
   // Log errors
   conn.onerror = function (error) {
   console.log('group WebSocket Error ' + error);
   //  alert("WebSocket Error "+error);
   };
       
    
conn.onclose=function () {
    console.log('group connection closed ');  
    keepalive="off";

    if(keepalive=="off")
       return $('#card-nortice').html("Disconnected, <a href='/'>reload page to reconnect</a>");

    };

 //*******************WEBSOCKECT CODE******************************//
 })

 function setUsername(uName){
   if(uName!=''){
      chatName=uName;
      $.cookie('chat_name',chatName);
      //clear inputfield
      $('#content #setchatname').val('');

      insertUpdateClientInfo();
    }
    $('#content #username').text(chatName); 
 }


 function insertUpdateClientInfo(){
   var message={
      username:chatName,
       sessionid:$.cookie('PHPSESSID'),
       type:'client_info'
     }

     conn.send(JSON.stringify(message)); 
 }


 //submit forms
 function submitGroupChatForm(event,formID,uid,groupid,gsub_teamsid){
    event.preventDefault();

    if(keepalive=="off")
       return $('#card-nortice').html("Disconnected, <a href='/'>reload page to reconnect</a>");;
   
    var date=new Date();
    var currenttime=formatAMPM(date);

    var form = $('#'+formID)[0];
    
    if(!form.checkValidity()){
      form.reportValidity();
      return false;
    }

 

    var data = new FormData(form);

    var message={
      userid:uid,
      uname:$.cookie('chat_name'),
      gid:groupid,
      subgroup_id:gsub_teamsid,
       msg:data.get('message'),
       sessionid:$.cookie('PHPSESSID'),
       type:'group_user_chating'
     }
  
//send data to server

 conn.send(JSON.stringify(message));

 var target=$("#content #teams_msg-list"+gsub_teamsid);
   target.animate({scrollTop:target.get(0).scrollHeight},1000);


   target.append("<div class='d-flex text-start align-items-block justify-content-end mb-1'><div class='pe-2 ms-1'><div><div class='text-light text-end fw-bold' style='font-size:12px;'>"+$.cookie('chat_name')+"</div><div class='card card-user-chat d-inline-block p-1 m-0' style='float:right; clear:both;'>"+message.msg+"</div></div><div><div class='small text-secondary' style='float:right; clear:both;'>"+currenttime+"</div></div></div><div><div class='rounded-circle avator'><img src='/photos/user_avatar2.png' class='img-fluid rounded-circle' style='padding:1px;' alt='Avatar'></div></div></div>");
    
   //clear input field
   $('#message').val('');
  
   playAudio();

  }
 

  function formatAMPM(date) {
   var hours = date.getHours();
   var minutes = date.getMinutes();
   var ampm = hours >= 12 ? 'pm' : 'am';
   hours = hours % 12;
   hours = hours ? hours : 12; // the hour '0' should be '12'
   minutes = minutes < 10 ? '0'+minutes : minutes;
   var strTime = hours + ':' + minutes + ' ' + ampm;
   return strTime;
 }