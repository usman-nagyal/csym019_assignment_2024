<?php 
  class Users {

    private $conn;
    private $table = 'users';
    public $id;
    public $name;
    public $sex;
    public $photo;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    public function authenticate():bool
    {
      
        $query = "SELECT * FROM " . $this->table . " WHERE email='".$this->email."' AND password='".sha1($this->password)."'";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        if($stmt->rowCount()>0){
          $_SESSION['id']=$stmt->fetch(PDO::FETCH_OBJ)->id;
          return true;
        }
        

        return false;
    }

    public function auth()
    {
      
        $user=$this->find($_SESSION['id']);

        return $user;
    }

    public function find($id)
    {
            $query = "SELECT * FROM " . $this->table . " WHERE id='".$id."'";
        
       
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function checkIfemailExists($email):bool
    {
        $query = "SELECT * FROM " . $this->table . " WHERE email='".$this->email."'";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
         
        return $stmt->rowCount()>0?true:false;
    }
    // Get Posts
    // public function read(?int $userid) {
      
    //     if(is_null($userid)){

    //         $query = 'SELECT u.id, u.name, u.email,u.api_key, u.email, u.position FROM ' . $this->table . ' u LEFT JOIN project_team pt on u.id=pt.user_id LEFT JOIN milestones m on u.id=m.user_id';
    //     }else{

    //         $query = 'SELECT u.id, u.name, u.email,u.api_key, u.email, u.position FROM ' . $this->table . ' u LEFT JOIN project_team pt on u.id=pt.user_id LEFT JOIN milestones m on u.id=m.user_id WHERE u.id='.$userid;
    //     }
      
      
      
    //   $stmt = $this->conn->prepare($query);

    //   // Execute query
    //   $stmt->execute();

    //   return $stmt;
    // }

    // public function validate()
    // {
      
    //   if(empty($this->name) || empty($this->email) ||empty($this->password) ||empty($this->email) ||empty($this->position)){
    //     printf("Some values are missing.\n");
    //     return false;
    //   }
    //   return true;
    // }

    // Create Post
    // public function create() {
    //     //  if(!$this-> validate())
    //     //       exit;

    //     $checks=$this->checkIfemailExists($this->email);
    //     if($checks){
    //         printf("User: %s already exists.\n", $this->email);
    //         return false;
    //     }
        
    //       $query = 'INSERT INTO ' . $this->table . ' SET name=:name,email=:email, password=:password,api_key=:api_key,email=:email,position=:position,token=:token, created_at=:created_at,updated_at=:updated_at';

    //       $stmt = $this->conn->prepare($query);

    //       $this->name = htmlspecialchars($this->name);
    //       $this->email = htmlspecialchars($this->email);
    //       $this->password = sha1($this->password);
    //       $this->email = htmlspecialchars($this->email);
    //       $this->position = htmlspecialchars($this->position);
    //       $this->token = $this->token??'';
    //       $this->created_at = htmlspecialchars($this->created_at);
    //       $this->updated_at = htmlspecialchars($this->updated_at);

    //       // Bind data
    //       $stmt->bindParam(':name', $this->name);
    //       $stmt->bindParam(':email', $this->email);
    //       $stmt->bindParam(':password', $this->password);
    //       $stmt->bindParam(':api_key', $this->api_key);
    //       $stmt->bindParam(':email', $this->email);
    //       $stmt->bindParam(':position', $this->position);
    //       $stmt->bindParam(':token', $this->token);
    //       $stmt->bindParam(':created_at', $this->created_at);
    //       $stmt->bindParam(':updated_at', $this->updated_at);

    
    //       if($stmt->execute()) {
    //         return true;
    //   }

     
    //   printf("Error: %s.\n", $stmt->error);

    //   return false;
    // }

    // Update Post
    // public function update() {
    //       // Create query
    //       $query = 'UPDATE ' . $this->table . '
    //                    SET name=:name,email=:email, password=:password,api_key=:api_key,email=:email,position=:position,token=:token,updated_at=:updated_at WHERE id = :id';

    //       // Prepare statement
    //       $stmt = $this->conn->prepare($query);

    //       $this->name = htmlspecialchars($this->name);
    //       $this->email = htmlspecialchars($this->email);
    //       $this->password = sha1($this->password);
    //       $this->email = htmlspecialchars($this->email);
    //       $this->position = htmlspecialchars($this->position);
    //       $this->token = htmlspecialchars($this->token);
    //       $this->updated_at = htmlspecialchars($this->updated_at);
    //       $this->id = htmlspecialchars($this->id);

    //       // Bind data
    //       $stmt->bindParam(':name', $this->name);
    //       $stmt->bindParam(':email', $this->email);
    //       $stmt->bindParam(':password', $this->password);
    //       $stmt->bindParam(':api_key', $this->api_key);
    //       $stmt->bindParam(':email', $this->email);
    //       $stmt->bindParam(':position', $this->position);
    //       $stmt->bindParam(':token', $this->token);
    //       $stmt->bindParam(':updated_at', $this->updated_at);
    //       $stmt->bindParam(':id', $this->id);

    //       // Execute query
    //       if($stmt->execute()) {
    //         return true;
    //       }

    //       // Print error if something goes wrong
    //       printf("Error: %s.\n", $stmt->error);

    //       return false;
    // }

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