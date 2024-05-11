<?php 
  class PremierLeague {

    private $conn;
    private $table = 'premier_league_table';
    public $id;
    public $season;
    public $position;
    public $team;
    public $played;
    public $won;
    public $drawn;
    public $lost;
    public $goals_for;
    public $goals_against;
    public $points;
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

    // Get Posts
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

  public function whereIn($column,$str) {
      
      $query = 'SELECT * FROM ' . $this->table.' where '.$column.' in ('.$str.')';
    
    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

    public function validate()
    {
      
      if(empty($this->position) || empty($this->team) ||empty($this->played) ||empty($this->won) || empty($this->drawn) || empty($this->lost) || empty($this->goals_for) || empty($this->goals_against) || empty($this->points) || empty($this->created_by)){
        printf("Some values are missing.\n");
        return false;
      }
      return true;
    }

    // Create Post
    public function create() {

      if(!$this-> validate())
        exit;

          $query = 'INSERT INTO ' . $this->table . ' SET season=:season,position =:position,team=:team, played=:played,won=:won,drawn=:drawn,lost=:lost,goals_for=:goals_for,goals_against=:goals_against,points=:points,created_by=:created_by,created_at=:created_at, updated_at=:updated_at';

          $stmt = $this->conn->prepare($query);

             // Bind data
          $stmt->bindParam(':season', $this->season);
          $stmt->bindParam(':position', $this->position);
          $stmt->bindParam(':team', $this->team);
          $stmt->bindParam(':played', $this->played);
          $stmt->bindParam(':won', $this->won);
          $stmt->bindParam(':drawn', $this->drawn);
          $stmt->bindParam(':lost', $this->lost);
          $stmt->bindParam(':goals_for', $this->goals_for);
          $stmt->bindParam(':goals_against', $this->goals_against);
          $stmt->bindParam(':points', $this->points);
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
                                SET season=:season,position =:position,team=:team, played=:played,won=:won,drawn=:drawn,lost=:lost,goals_for=:goals_for,goals_against=:goals_against,points=:points,created_by=:created_by,updated_at=:updated_at WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind data
          $stmt->bindParam(':season', $this->season);
          $stmt->bindParam(':position', $this->position);
          $stmt->bindParam(':team', $this->team);
          $stmt->bindParam(':played', $this->played);
          $stmt->bindParam(':won', $this->won);
          $stmt->bindParam(':drawn', $this->drawn);
          $stmt->bindParam(':lost', $this->lost);
          $stmt->bindParam(':goals_for', $this->goals_for);
          $stmt->bindParam(':goals_against', $this->goals_against);
          $stmt->bindParam(':points', $this->points);
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