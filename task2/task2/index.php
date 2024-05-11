<?php
session_start();
    
require_once 'autoload.php';


if(!isset($_GET['url']) || $_GET['url']=='home' || $_GET['url']=='')
$url=$_GET['url']='login';


require_once 'config.php';

require_once 'routes.php';

