<?php 
  class Database {
    // DB Params
    private $host = 'localhost';
    private $db_name = 'soccer_assignment';
    private $username = 'root';
    private $password = '';
    private $db_port=3306;
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 

        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name. ';port='. $this->db_port, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }