<?php 
     // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: GET');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');


  include_once '../../config/Database.php';
  include_once '../../model/Users.php';

  $api_key=trim($_GET['api_key']??'nokey');
  $response=array();
  $database=new Database;
  $db=$database->connect();

  $user=new Users($db);
  $user_obj=$user->find($api_key);

  if($user_obj->rowCount()>0){
   
    $user_data=$user_obj->fetch(PDO::FETCH_OBJ);
    $response=[
            'status' => 'Succesfull',
            'data'=>[
                'id'=>$user_data->id, 
                'name'=>$user_data->name, 
                'username'=>$user_data->username, 
                'email'=>$user_data->email, 
                'position'=>$user_data->position, 
                'token'=>$user_data->token, 
                'created_at'=>$user_data->created_at, 
                'updated_at'=>$user_data->updated_at
            ]
        ];
  }else{
    $response=[
            'status' => 'Failed',
            'message' => 'User does not exist'
        ];
  }

  echo json_encode($response,JSON_PRETTY_PRINT);
?>