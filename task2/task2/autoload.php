<?php

spl_autoload_register(function($className) {
    if(file_exists('classes/'.$className.'.php')){
        require_once 'classes/'.$className.'.php';
    }else if(file_exists('database/'.$className.'.php')){
        require_once 'database/'.$className.'.php';
    }else if(file_exists('model/'.$className.'.php')){
        require_once 'model/'.$className.'.php';

    }else if(file_exists('Controller/'.$className.'.php')){
        require_once 'Controller/'.$className.'.php';
    }
    

});
