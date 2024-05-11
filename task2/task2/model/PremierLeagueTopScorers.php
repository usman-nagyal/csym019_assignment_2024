<?php 
  class PremierLeagueTopScorers {

    private $conn;
    private $table = 'premier_league_top_scorers';
    public $id;
    public $season;
    public $rank;
    public $player_name;
    public $team;
    public $goals;
    public $created_by;
    public $created_at;
    public $updated_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    public function getUserInputs()
    {
     
        $query = 'SELECT * FROM ' . $this->table . ' WHERE created_by='.$this->created_by;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    public function read() {
      
      $query = 'SELECT * FROM ' . $this->table;
    
    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  public function orderBy($column,$desc='asc') {
      
      $query = 'SELECT * FROM ' . $this->table.' order by season asc, '.$column.' '.$desc;
      
    
    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

    public function validate()
    {
      
      if(empty($this->rank) || empty($this->season) ||empty($this->player_name) ||empty($this->team) || empty($this->goals) || empty($this->created_by)){
        printf("Some values are missing.\n");
        return false;
      }
      return true;
    }

    // Create Post
    public function create() {

      if(!$this->validate())
        exit;

          $query = 'INSERT INTO ' . $this->table . ' SET season=:season,`rank`=:rank,player_name=:player_name,team=:team,goals=:goals,created_by=:created_by,created_at=:created_at, updated_at=:updated_at';

          $stmt = $this->conn->prepare($query);
       
             // Bind data
          $stmt->bindParam(':season', $this->season);
          $stmt->bindParam(':rank', $this->rank);
          $stmt->bindParam(':player_name', $this->player_name);
          $stmt->bindParam(':team', $this->team);
          $stmt->bindParam(':goals', $this->goals);
          $stmt->bindParam(':created_by', $this->created_by);
          $stmt->bindParam(':created_at', date('Y-m-d H:i:s',time()));
          $stmt->bindParam(':updated_at', date('Y-m-d H:i:s',time()));
  
    
          if($stmt->execute()) {
            return true;
      }

     
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET season=:season,`rank` =:rank,player_name=:player_name, team=:team,goals=:goals,created_by=:created_by,updated_at=:updated_at WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind data
          $stmt->bindParam(':season', $this->season);
          $stmt->bindParam(':rank', $this->rank);
          $stmt->bindParam(':player_name', $this->player_name);
          $stmt->bindParam(':team', $this->team);
          $stmt->bindParam(':goals', $this->goals);
          $stmt->bindParam(':created_by', $this->created_by);
          $stmt->bindParam(':updated_at', date('Y-m-d H:i:s',time()));
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
         
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          
          $stmt = $this->conn->prepare($query);

          $this->id = htmlspecialchars($this->id);

          $stmt->bindParam(':id', $this->id);

       
          if($stmt->execute()) {
            return true;
          }

        
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }