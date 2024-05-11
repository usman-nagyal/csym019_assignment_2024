<?php

class Route{

public static $validRoutes = array();


    public static function get($page,$function){

        self::$validRoutes['get'][]=$page;

    if($_GET['url']==$page){
        $function->__invoke();
    }

    if(isset($_POST['choose'])){

        $function->__invoke();
    }

    }

    public static function post($page,$function){

        self::$validRoutes['post'][]=$page;
        $url=explode('/',$_SERVER['REQUEST_URI']);
        $requested_route=$url[count($url)-1];

    if($requested_route==$page){
        $function->__invoke();
    }

    if(isset($_POST['choose'])){

        $function->__invoke();
    }

    }

       

}

?> 