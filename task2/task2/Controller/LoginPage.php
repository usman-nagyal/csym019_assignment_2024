<?php  

class LoginPage{
    public static function index()
    {
        include './views/login-view.php';
    }

    public static function authenticate()
    {
        $db=new Database;
        $db_connect=$db->connect();
        $user=new Users($db_connect);
        $user->email=trim($_POST['email']??'');
        $user->password=trim($_POST['password']??'');
        $check_auth=$user->authenticate();

        if($check_auth){
            $_SESSION['auth']=$user->auth()->id;
            header('location:./dashboard');
            exit;
        }else{
            $_SESSION['errors'][]="Authetication failed";
            header('location:./login');
            exit;
        }
    }

}
