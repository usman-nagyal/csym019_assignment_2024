<?php 
    if(!isset($_SERVER['PHP_AUTH_USER'])){
        header("WWW-Authenticate: Basic realm=\"Private\"");
        header("HTTP/1.0 401 Unathorized");
        print "Sorry, you need proper credentials";
        exit;
    }
  include_once '../../config/Database.php';
  include_once '../../model/Users.php';

  $response=array();
  $database=new Database;
  $db=$database->connect();

  $user=new Users($db);
  $user->username=$_SERVER['PHP_AUTH_USER'];
  $user->password=$_SERVER['PHP_AUTH_PW'];
  if($user->authenticate()){
    $user_obj=$user->find();
    $user_data=$user_obj->fetch(PDO::FETCH_OBJ);
    $response=[
            'status' => 'Succesfull',
            'api_key' =>$user_data->api_key,
            'role' => $user_data->position
        ];
  }else{
    $response=[
            'status' => 'Failed',
            'message' => 'Authentication Failed'
        ];
  }

  echo json_encode($response,JSON_PRETTY_PRINT);
?>