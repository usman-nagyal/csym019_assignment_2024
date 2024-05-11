

 $(document).ready(function(){
    //*******************WEBSOCKECT CODE******************************//
    conn = new WebSocket(websocket_url);

   conn.onopen = function (e) {
   console.log("Connection established");
  //  alert("Connection established ");

   insertUpdateFrontDeskInfo();

   };



    // Log messages from the server
    conn.onmessage = function (e) {
      var msgObj=JSON.parse(e.data);

      var date=new Date();
      var currenttime=formatAMPM(date);

          if(msgObj.type=='user_chating'){

        var target=$("#content #msg-list"+msgObj.userid);
        target.animate({scrollTop:target.get(0).scrollHeight},1000);

        target.append("<div class='d-flex text-end align-items-block mb-1'><div><div class='rounded-circle avator '><img src='/photos/user_avatar.png' class='img-fluid rounded-circle' style='padding:1px;' alt='Avatar'></div></div><div class='pe-2 ms-1'><div><div class='text-light text-end fw-bold' style='font-size:12px;'>"+msgObj.username+"</div><div class='card card-user-chat d-inline-block m-1' style='float:right; clear:both;'>"+msgObj.msg+"</div></div><div><div class='small text-secondary' style='float:right; clear:both;'>"+currenttime+"</div></div></div></div>");

          }else if(msgObj.type=='server_response'){
      
            var target=$("#content #msg-list"+msgObj.userid);
            target.animate({scrollTop:target.get(0).scrollHeight},1000);

            target.append("<div class='d-flex text-start align-items-block mb-1'><div class='pe-2 ms-1 bg-transparent'><div><div class='card card-admin-chat d-inline-block'>"+msgObj.msg+"</div></div></div></div>");
            
         }
       
       };

   
   // Log errors
   conn.onerror = function (error) {
   console.log('WebSocket Error ' + error);
  //  alert("WebSocket Error "+error);
   };
       
    
conn.onclose=function () {
    console.log('connection closed ');
    };

 //*******************WEBSOCKECT CODE******************************//
 })



 //submit forms
 function submitChatForm(event,formID,clientid){
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
      msg:data.get('message'),
      frontdeskid:$('#content #setchatname').val(),
      img:data.get('apic'),
      userid:clientid,
      type:'admin_chating'
    }
 var adminnames=$('#content #adminName').text();
//send data to server
conn.send(JSON.stringify(message));

   var target=$("#content #msg-list"+clientid);
   target.animate({scrollTop:target.get(0).scrollHeight},1000);

      target.append("<div class='d-flex  align-items-block text-start justify-content-end mb-1'><div class='pe-2 ms-1  bg-transparent'><div><div class='text-light text-start fw-bold' style='font-size:12px;'>"+adminnames+"</div><div class='card card-admin-chat d-inline-block m-0 p-1 ' style='float:left; clear:both;'>"+message.msg+"</div></div><div><div class='small text-secondary' style='float:left; clear:both;'>"+currenttime+"</div></div></div><div><div class='rounded-circle avator'><img src='/"+data.get('apic')+"' class='img-fluid rounded-circle' style='padding:1px;' alt='Avatar'></div></div></div>");

      //clear input field
      $('#message').val('');
    
  }

  
  function insertUpdateFrontDeskInfo(){
   var message={
      frontdeskid:$('#content #setchatname').val(),
       type:'frontdesk_info'
     }
  
     conn.send(JSON.stringify(message)); 
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