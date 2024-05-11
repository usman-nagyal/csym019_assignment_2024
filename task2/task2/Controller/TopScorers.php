<?php  

class TopScorers{

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
        $top_scorers=new PremierLeagueTopScorers(self::$db_conn);
        $get_data=$top_scorers->orderBy('`rank`','asc');

        $data_top_scorers=$get_data->fetchAll(PDO::FETCH_OBJ);
        include './views/partials/top_scorers-view.php';
    }

    public static function create()
    {
        self::initialise();
        $top_scorers=new PremierLeagueTopScorers(self::$db_conn);
        // 'season' => string 'season 10' (length=9)
        // 'rank' => string '0' (length=1)
        // 'player_name' => string 'Roney' (length=5)
        // 'team' => string 'Manu u' (length=6)
        // 'goals' => string '44' (length=2)
        $top_scorers->season=trim($_POST['season']??'');
        $top_scorers->rank=trim($_POST['rank']??'');
        $top_scorers->player_name=trim($_POST['player_name']??'');
        $top_scorers->team=trim($_POST['team']??'');
        $top_scorers->goals=trim($_POST['goals']??'');
        $top_scorers->created_by=$_SESSION['id'];

        $top_scorers->create();

        self::show();
    }

}