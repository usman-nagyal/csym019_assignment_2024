<?php 

class ScoresFixtures{

    public static $db_conn;
    public static function initialise()
    {
        if(!self::$db_conn){
            $db=new Database;
            self::$db_conn=$db->connect();
        }
        
    }
    public static function show()
    {
        self::initialise();
        $scores_fixtures=new FootballScoresFixtures(self::$db_conn);
        $get_data=$scores_fixtures->read();
        $scores_fixtures=$get_data->fetchAll(PDO::FETCH_OBJ);
        
        include './views/partials/scores-fixtures-view.php';
    }

    public static function create()
    {
        self::initialise();
        $scores_fixtures=new FootballScoresFixtures(self::$db_conn);
        
        $scores_fixtures->home_team=trim($_POST['hometeam']??'');
        $scores_fixtures->away_team=trim($_POST['awayteam']??'');
        $scores_fixtures->home_score=trim($_POST['homescore']??'');
        $scores_fixtures->away_score=trim($_POST['awayscore']??'');
        $scores_fixtures->created_by=$_SESSION['id'];

        $scores_fixtures->create();

        self::show();
    }
}