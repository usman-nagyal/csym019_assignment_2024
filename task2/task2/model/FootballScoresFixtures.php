<?php 
  class FootballScoresFixtures {
   
    private $conn;
    private $table = 'football_scores_and_fixtures';
    public $id;
    public $home_team;
    public $away_team;
    public $home_score;
    public $away_score;
    public $created_by;
    public $created_at; 
    public $updated_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read(?int $m_id=null) {
      
        if(is_null($m_id)){

            $query = 'SELECT * FROM ' . $this->table;
        }else{

            $query = 'SELECT * FROM ' . $this->table.' WHERE id='.$m_id;
        }
      
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    public function validate()
    {
      
      if(empty($this->home_team) || empty($this->away_team) ||empty($this->home_score) ||empty($this->away_score)){
        printf("Some values are missing.\n");
        return false;
      }
      return true;
    }

    // Create Post
    public function create() 
    {
      if(!$this-> validate())
        exit;
        
          $query = 'INSERT INTO ' . $this->table . ' SET home_team=:home_team, away_team=:away_team, home_score=:home_score,away_score=:away_score,created_by=:created_by, created_at=:created_at, updated_at=:updated_at';

          $stmt = $this->conn->prepare($query);

        
          // Bind data
          $stmt->bindParam(':home_team', $this->home_team);
          $stmt->bindParam(':away_team', $this->away_team);
          $stmt->bindParam(':home_score', $this->home_score);
          $stmt->bindParam(':away_score', $this->away_score);
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
                                SET home_team=:home_team,away_team=:away_team,home_score=:home_score, away_score=:away_score,created_by=:created_by,updated_at=:updated_at WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);
         
          // Bind data
          $stmt->bindParam(':home_team', $this->home_team);
          $stmt->bindParam(':away_team', $this->away_team);
          $stmt->bindParam(':home_score', $this->home_score);
          $stmt->bindParam(':away_score', $this->away_score);
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

          $stmt->bindParam(':id', $this->id);

       
          if($stmt->execute()) {
            return true;
          }

        
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }