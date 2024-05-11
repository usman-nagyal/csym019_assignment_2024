var conn;
var chatName='';

 $(document).ready(function(){
   
    //*******************WEBSOCKECT CODE******************************//
    conn = new WebSocket(websocket_url);

   conn.onopen = function (e) {
   console.log("Connection established");
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



    // Log messages from the server
    conn.onmessage = function (e) {

      var msgObj=JSON.parse(e.data);

      var date=new Date();
      var currenttime=formatAMPM(date);    

      var target=$("#content #msg-list"+msgObj.adminid);
         target.animate({scrollTop:target.get(0).scrollHeight},1000);
   
      if(msgObj.type=='admin_chating'){


         target.append("<div class='d-flex text-end align-items-block mb-1'><div><div class='rounded-circle avator'><img src='/"+msgObj.image+"' class='img-fluid rounded-circle' style='padding:1px;' alt='Avatar'></div></div><div class='pe-2 ms-1  bg-transparent'><div><div class='text-light text-start fw-bold' style='font-size:12px;'>"+msgObj.names+"</div><div class='card card-admin-chat d-inline-block m-0 p-1' style='float:right; clear:both;'>"+msgObj.msg+"</div></div><div><div class='small text-secondary' style='float:right; clear:both;'>"+currenttime+"</div></div></div></div>");

        

      }else if(msgObj.type=='server_response'){
        
         // $('#loadercontent').html(msgObj.msg);

         target.append("<div class='d-flex text-end align-items-block mb-1'><div class='pe-2 ms-1 bg-transparent'><div><div class='card card-admin-chat d-inline-block'>"+msgObj.msg+"</div></div></div></div>");
         
      }

      };
      

   


   
   // Log errors
   conn.onerror = function (error) {
   console.log('WebSocket Error ' + error);
   // alert("WebSocket Error "+error);
   };
       
    
conn.onclose=function () {
    console.log('connection closed ');
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
 function submitChatForm(event,formID,aid){
    event.preventDefault();
    
    var date=new Date();
    var currenttime=formatAMPM(date);

    var form = $('#'+formID)[0];
    
    if(!form.checkValidity()){
      form.reportValidity();
      return false;
    }

 

    var data = new FormData(form);

    var message={
      frontdeskid:aid,
       msg:data.get('message'),
       uname:$.cookie('chat_name'),
       sessionid:$.cookie('PHPSESSID'),
       type:'user_chating'
     }
  
//send data to server

 conn.send(JSON.stringify(message));

 var target=$("#content #msg-list"+aid);
   target.animate({scrollTop:target.get(0).scrollHeight},1000);

   target.append("<div class='d-flex text-start align-items-block justify-content-end mb-1'><div class='pe-2 ms-1'><div><div class='text-light text-end fw-bold' style='font-size:12px;'>"+$.cookie('chat_name')+"</div><div class='card card-user-chat d-inline-block m-1' style='float:left; clear:both;'>"+message.msg+"</div></div><div><div class='small text-secondary' style='float:left; clear:both;'>"+currenttime+"</div></div></div><div><div class='rounded-circle avator '><img src='/photos/user_avatar.png' class='img-fluid rounded-circle' style='padding:1px;' alt='Avatar'></div></div></div>");
    
   //clear input field
   $('#message').val('');

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