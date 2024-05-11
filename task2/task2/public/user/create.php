<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../Enum/UserPositionEnum.php';
  include_once '../../Enum/ProjectStatusEnum.php';
  include_once '../../model/Users.php';
  include_once '../../functions/function.php';

  // Instantiate DB & connect
  $data = json_decode(file_get_contents("php://input"));
  if(is_null($data)){
    print "Body is empty";
    exit;
  }
  if(empty($data->api_key))
  {
    print "Missing API key";
    exit;
  }

  $response=array();

  $database = new Database();
  $db = $database->connect();
  $user = new Users($db);

  //check if endpoint has right to create user
  $user_obj=$user->find($data->api_key);

  $user_data=$user_obj->fetch(PDO::FETCH_OBJ);

  if(in_array($user_data->position,[UserPositionEnum::ADMIN]))
  {
    if(!UserPositionEnum::checkValue($data->position)){
      print "Position value is not recognised";
      exit;
    }

    $user->name=$data->name; 
    $user->username=$data->username; 
    $user->password=$data->password; 
    $user->api_key=generateApiKey(); 
    $user->email=$data->email; 
    $user->position=$data->position; 
    $user->token=''; 
    $user->created_at=date("Y-m-d H:i:s"); 
    $user->updated_at= date("Y-m-d H:i:s");

    // Create Category
    if($user->create()) {

      $response=[
        'status' => 'Successfull',
        'message' => 'User Created Successfully',
     ];

    } else {
      $response=[
        'status' => 'Failed',
        'message' => 'Failed to Create User',
     ];
    }
    
  }else{
    $response=[
        'status' => 'Create User Failed',
        'message' => 'User does not have required privilages',
    ];
  }

  echo json_encode($response,JSON_PRETTY_PRINT);

 