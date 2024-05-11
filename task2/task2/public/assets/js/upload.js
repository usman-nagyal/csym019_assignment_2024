

$( "#tabs" ).tabs();

var spinnerSMALL="<div class='spinner-border spinner-border-sm text-dark' role='status'><span class='sr-only'></span></div>";

//submit forms
function submitForm(event,formID,optValue,respElemId){
  event.preventDefault();


  var form = $('#'+formID)[0];

  if(!form.checkValidity()){
    form.reportValidity();
    return false;
  }
  
  var data = new FormData(form);
  // If you want to add an extra field for the FormData
  data.append("opt",optValue);
  
  $.ajax({
  type: "POST",
  enctype: 'multipart/form-data',
  url: "./datasheets",
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
   // console.log("SUCCESS : ", data);
   inc_num=1;

  },
  error: function(XMLHttpRequest,textStatus,errorThrown){
    $("#"+respElemId).fadeOut(0);
    //XMLHttpRequest.responseText+" "+textStatus+
    $("#"+respElemId).html("<span class='text-warning'>internet connection interrupted...</span><a class='text-primary' href='./main_page'>reload page</a>");
    $("#"+respElemId).fadeIn(5000);
    }
  });
  
}

function populateAlbumList(cdata){
$.post("./datasheets",{opt:'album_datalist',searchVal:cdata},function(cresult){
    $('#list_albums').html(cresult);
})
}

function dataListSelect(){
    var input_select=$("#song_album").val();
    var option_length=$("#list_albums option").length;
    var option_id='';
    for(var i=0;i<option_length;i++){
      var option_value=$("#list_albums option").eq(i).attr('data-value');
      if(input_select==option_value){
        option_id=$("#list_albums option").eq(i).attr('data-id');
        $("#song_album").prop('title',option_value);
        album_id=option_id;
        $("#list_albums").empty();
         
        break;
      }
    }

  }

  function populateAssmtPeriodList(searchVal){
    $.post("./assmt_datalist",{opt:searchVal},function(aresult){
        $('#list_assmts').html(aresult);
    })
    }

    function dataListSelectAssmt(){
      var input_select=$("#cand_assmt").val();
      var option_length=$("#list_assmts option").length;
      var option_id='';
      for(var i=0;i<option_length;i++){
        var option_value=$("#list_assmts option").eq(i).attr('data-value');
        if(input_select==option_value){
          option_id=$("#list_assmts option").eq(i).attr('data-id');
          $("#cand_assmt").prop('title',option_value);
          ass_id=option_id;
          $("#list_assmts").empty();
          break;
        }
      }
  
    }

      
    function AddTrack(event){
      event.preventDefault();
      
      inc_num+=1;
      $('#addRowTable').append("<tr id='newRow"+inc_num+"'><th scope='row p-0'>"+inc_num+"</th><td class='p-1'><img id='pic"+inc_num+"' class='img-thumbnail rounded-3 border border-secondary bg-dark' src='./photos/albumART.png' width='50' height='50'><input type='hidden' style='display:none;' id='coverArt"+inc_num+"' name='imgArt[]'></td><td class='p-1'><input type='file' required onchange=\"getAudioTags(event,"+inc_num+")\" class='form-control bg-transparent border border-secondary text-light w-20' id='song_audio"+inc_num+"' accept='.ogg,.flac,.mp3,.m4a' placeholder='Audio'  name='file[]' ></td><td class='p-1'><textarea required class='form-control bg-transparent border border-secondary text-light'  id='song_lyrics'  name='song_lyrics[]' ></textarea></td><td class='p-1'><input type='text' required class='form-control bg-transparent border border-secondary text-light' id='song_name"+inc_num+"' placeholder='Song' name='song_name[]'></td><td class='p-1'><input type='text' required class='form-control bg-transparent border border-secondary text-light' id='artist_name"+inc_num+"' placeholder='Artist' name='artist_name[]'></td><td class='p-1'><input type='text' required class='form-control bg-transparent border border-secondary text-light' id='genre"+inc_num+"' placeholder='Genre' name='genre[]'></td><td class='p-1'><button onclick=\"DelTrack(event,'newRow"+inc_num+"')\" class='btn btn-danger'>Delete</button></td></tr>");

    }
    
    function DelTrack(event,rowID){
      event.preventDefault();
      $('#'+rowID).remove();
    }
   
      
      jQuery('#dialog').dialog({
      autoOpen: false,
      width: 400,
      buttons: [
        {
          text: 'Ok',
          click: function() {
          //alert(jQuery('#changemods').val());
          
              jQuery('#cand_modules').val(jQuery('#changemods').val())
              
            
            jQuery( this ).dialog('close');
          }
        },
        {
          text: 'Cancel',
          click: function() {
            jQuery( this ).dialog('close');
          }
        }
        ]
        });
    
      
    


    $( "#dialog" ).dialog({

      autoOpen: false,
      
      width: 400,
      
      buttons: [
      
        {
      
          text: "Ok",
      
          click: function() {
      
            $( this ).dialog( "close" );
      
          }
      
        },
      
        {
      
          text: "Cancel",
      
          click: function() {
      
            $( this ).dialog( "close" );
      
          }
      
        }
      ]
      
      });
      
      
      // Link to open the dialog
      
      $( "#dialog-link" ).click(function( event ) {
      
      $( "#dialog" ).dialog( "open" );
      
      event.preventDefault();
      
      });
      


