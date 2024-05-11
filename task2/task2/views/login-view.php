<?php 
  if(isset($_SESSION['auth'])){
    header('location:./dashboard');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link  href="./public/assets/css/bootstrap/bootstrap.min.css"  type="text/css" rel="stylesheet">
<link  href="./public/assets/css/bootstrap/dataTables.bootstrap5.min.css"  type="text/css" rel="stylesheet">

<link href="./public/assets/css/styles.css" rel="stylesheet" />
<link  href="./public/assets/css/common.css"  type="text/css" rel="stylesheet">
<link  href="./public/assets/css/main.css"  type="text/css" rel="stylesheet">
<link  href="./public/assets/css/fontawesome/css/all.min.css"  type="text/css" rel="stylesheet">

<script src='./public/assets/js/jquery.js'></script>
<script src='./public/assets/js/jquery.cookie.js'></script>
</head>
<body>
    <div class="d-flex justify-content-center align-items-lg-center w-75 fw-bold" style="margin:2% 5%;">
      <h3>Task 2 - Create a Premier League Report With PHP,<br/> JavaScript, HTML, SQL, and CSS:</h3>
      
    </div>

<div class="d-flex justify-content-center align-items-lg-center w-50 border  p-2" style="margin-left:20%;">
    
    <form method="POST" action="./login-exec"  >
    <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name='password' class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <?php 
              if($_SESSION['errors']){
                foreach($_SESSION['errors'] as $error){
                    echo "<div class='text-danger p-1'>".$error."</div>";
                }
                unset($_SESSION['errors']);
              }

              if($_SESSION['logout']){
                echo "<div class='text-info p-1'>".$_SESSION['logout']."</div>";
                session_destroy();
              }
            ?>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<script src="./public/assets/js/popper.min.js"></script>
    <script src="./public/assets/js/feather.min.js"></script>
    <!-- <script src="./public/assets/js/bootstrap/bootstrap.js"></script> -->
    <script src="./public/assets/js/bootstrap/bootstrap.bundle.min.js"></script>

     <!-- Core theme JS-->
     <script src="./public/assets/js/scripts.js"></script>
    <script src='./public/assets/js/jquery.dataTables.min.js'></script>
    <script src='./public/assets/js/bootstrap/dataTables.bootstrap5.min.js'></script>

    <script src='./public/assets/js/mainLayout.js'></script>
</body>
</html>