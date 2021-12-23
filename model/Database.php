<?php 
  class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "student_database";

    public function connect() {
      try {
        $db = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
        return $db;
      } catch (PDOException $e) {
        echo "Connection failed: {$e->getMessage()}";
      }
      return null;
    }
  }
?>