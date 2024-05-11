<?php 
  if(!isset($_SESSION['auth'])){
    $_SESSION['errors'][]="First Login";
    header('location:./login');
    exit;
  }
?>

<!doctype  html>

<html lang="en">

  <head>
   <!--for ads--> 
     <meta name="propeller" content="938097d7edbe03cd2365d37020d9d423">
     <!--for ads-->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">

    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">

    <meta name="generator" content="Jekyll v4.0.1">

    <link rel="icon" href="images/safia_title_icon.png" type="image/png" sizes="16x16" />

    <title>Live Premier League Table With JSON and AJAX</title>

    <!-- Bootstrap core CSS -->

<link  href="./public/assets/css/bootstrap/bootstrap.min.css"  type="text/css" rel="stylesheet">
<link  href="./public/assets/css/bootstrap/dataTables.bootstrap5.min.css"  type="text/css" rel="stylesheet">

<link href="./public/assets/css/styles.css" rel="stylesheet" />
<link  href="./public/assets/css/common.css"  type="text/css" rel="stylesheet">
<link  href="./public/assets/css/main.css"  type="text/css" rel="stylesheet">
<link  href="./public/assets/css/fontawesome/css/all.min.css"  type="text/css" rel="stylesheet">

<script src='./public/assets/js/jquery.js'></script>
<script src='./public/assets/js/jquery.cookie.js'></script>
<script>
 var loadnum='';
    var startload=0;
    var defaultNum=9;//change this value to populate desired rows
    var timezone_offset_minutes='';
</script>

  </head>

  <body id='html_body' class="bckground">


  <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end border-dark"  id="sidebar-wrapper" >
                <div class="sidebar-heading border-bottom bg-dark text-light p-1 ">
                   Assignment
                </div>
                <div id='menu' class="list-group list-group-flush">
  

                <ul id='ultabs' class="list-group list-group-item-dark">
                        
                        <li  class="list-group-item-dark">
                            <a id='./scores_fixtures' class="list-group-item list-group-item-dark list-group-item-action border border-0" href="#">Football Scores & Fixtures</a>
                        </li>
                        
                        <li  class="list-group-item-dark">
                            <a id='./league_table' class="list-group-item list-group-item-dark list-group-item-action border border-0" href="#">Premier League Table</a>
                        </li>

                        <li  class="list-group-item-dark">
                            <a id='./top_scorers' class="list-group-item list-group-item-dark list-group-item-action border border-0" href="#">Premier League Top Scorers</a>
                        </li>
                      
                        <li class="list-group-item-dark bg-secondary text-light">
                            <span>Settings</span>
                            <ul style='list-style:none;'>
                                <li class="qatar">
                                    <a class="list-group-item list-group-item-dark list-group-item-action qatar" href="./logout">
                                       logout
                                    </a>
                                </li>
                            </ul>
                            
                        </li>
                        
                        
                  </ul>

         
                   
                </div>
            </div>



              <!-- Page content wrapper-->
              <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand navbar-light bg-dark p-0 mb-1">
                    <div class="container-fluid">
                        <!--drawer button-->
                        <button class="btn btn-secondary p-0" id="sidebarToggle">
                            <span class='text-dark' data-feather="list"></span>
                        </button>
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse " id="navbarSupportedContent">
                           
                           <ul id='menu2' class="navbar-nav ms-1">

                                <li  class="nav-item" >
                                    <a class="nav-link text-light" href="#">
                                    Task 1 - Create a Live Premier League Table With JSON and AJAX:
                                    </a>
                                </li>
                               
                        </ul>
                        
                        
                    </div>
                </nav>
                <!-- Page content-->

    <div class='container-fluid  mycontainer p-0' >

    
       <div class='row' style="margin-left:5px;margin-right:5px;">

            <div id='loadercontent' class='col-md-12'></div>

            <div id='content' class='col-md-12'>
              <h2>Task 1 - Create a Live Premier League Table With JSON and AJAX:</h2>

            </div>
            
       </div>

       <div class="row">
          <div class="col-12">
               <audio id='audioElem' style="visibility:hidden; display:none;" class='bg-primary'  controls controlsList="nodownload" >
                  <source id='audioSourceElem'  src="/assets/audio/message-13716.mp3" type="audio/mp3">
                  Your browser does not support the audio element.
              </audio>
          </div>
       </div>

     </div>

<!--Starts row4 bottom-->

     <!--Ends row4 Bottom-->
<script src="./public/assets/js/popper.min.js"></script>
    <script src="./public/assets/js/feather.min.js"></script>
    <!-- <script src="./public/assets/js/bootstrap/bootstrap.js"></script> -->
    <script src="./public/assets/js/bootstrap/bootstrap.bundle.min.js"></script>

     <!-- Core theme JS-->
     <script src="./public/assets/js/scripts.js"></script>
    <script src='./public/assets/js/jquery.dataTables.min.js'></script>
    <script src='./public/assets/js/bootstrap/dataTables.bootstrap5.min.js'></script>

    <!-- Charts JS -->
    <!-- <script src="./public/assets/js/chatjs/chart.js/chart.umd.js"></script>  -->
    <script src="./public/assets/vendor/chart.js/chart.umd.js"></script>
    
    
    
     <script>
       var spinnerSMALL="<div class='spinner-border spinner-border-sm text-dark' role='status'><span class='sr-only'></span></div>";

       $('#ultabs a').click(function(){
        var tabID=$(this).attr('id');
            
        $.ajax({
            url:tabID,
            type:'GET',
            // data:{opt4:loadnum,opt5:startload},
            beforeSend: function(){
        $('#loadercontent').html(spinnerSMALL);
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
        });


    });


    function sendData(url,data){
        
      $.ajax({
            url:url,
            enctype: 'multipart/form-data',
            type:'POST',
            data:data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            beforeSend: function(){
        $('#loadercontent').html(spinnerSMALL);
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
        });
    }

    function sendData2(url,data){
      $.ajax({
            url:url,
            type:'POST',
            data:data,
            beforeSend: function(){
        $('#loadercontent').html(spinnerSMALL);
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
        });
    }

    </script>

</body>

</html>


