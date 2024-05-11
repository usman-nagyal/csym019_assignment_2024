<?php

require_once 'functions/function.php';
$data=array();
// $option_URL=isset($_POST['choose'])?trim($_POST['choose']):$_GET['url'];

Route::get('login',function(){

    LoginPage::index();
});

Route::post('login-exec',function(){
 
    LoginPage::authenticate();
});

Route::get('scores_fixtures',function(){
    ScoresFixtures::show();
});

Route::post('scores_fixtures_create',function(){
    ScoresFixtures::create();
});


Route::get('league_table',function(){
    LeagueTable::show();
});

Route::post('league_table_report',function(){
    LeagueTable::report();
});

Route::post('league_table_create',function(){
    LeagueTable::create();
});

Route::get('top_scorers',function(){
    TopScorers::show();
});

Route::get('top_scorers_create',function(){
    TopScorers::create();
});

Route::get('logout',function(){
    unset($_SESSION['auth']);
    header('location:./login');
        $_SESSION['logout']="You have successfully loggedout";
        exit;
});

Route::get('dashboard',function(){
    include 'views/layouts/app-layout.php';
});

