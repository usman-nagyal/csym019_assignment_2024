<?php  

class LeagueTable{

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
        $leagues=new PremierLeague(self::$db_conn);
        $get_data=$leagues->orderBy('points','desc');
        $premier_leagues=$get_data->fetchAll(PDO::FETCH_OBJ);
        include './views/partials/league-table-view.php';
    }

    public static function create()
    {
        self::initialise();
        $leagues=new PremierLeague(self::$db_conn);

        $leagues->season=trim($_POST['season']??'');
        $leagues->position=trim($_POST['position']??'');
        $leagues->team=trim($_POST['team']??'');
        $leagues->played=trim($_POST['played']??'');
        $leagues->won=trim($_POST['won']??'');
        $leagues->drawn=trim($_POST['drawn']??'');
        $leagues->lost=trim($_POST['lost']??'');
        $leagues->goals_for=trim($_POST['goals_for']??'');
        $leagues->goals_against=trim($_POST['goals_against']??'');
        $leagues->points=trim($_POST['points']??'');
        $leagues->created_by=$_SESSION['id'];

        $leagues->create();

        self::show();
    }

    public static function report()
    {
        if(empty($_POST['ids'])){
            $_SESSION['errors2'][]="empty rows selected";
            header('location:./league_table');
            exit;
        }
        self::initialise();
        $leagues=new PremierLeague(self::$db_conn);
        $get_data=$leagues->whereIn('id',trim($_POST['ids']??'')); 
        $premier_leagues=$get_data->fetchAll(PDO::FETCH_OBJ);
        $bargraph_data=self::getBarGraph($premier_leagues);
        include './views/partials/league-table-report-view.php';
    }

    public static function getBarGraph($premier_leagues)
    {
        $now = time();
        $points = [];
        $clubs=array_map(function($row_data)use (&$points){
            $points[]=$row_data->points;
            return "'$row_data->team'";
        },$premier_leagues);
        

        return [
            'clubs' => $clubs,
            'points' =>$points,
        ];


    }
}