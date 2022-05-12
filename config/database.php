<?php
  class Database {
    private $host = "localhost";
    private $db_name = "restapi";
    private $username = "root";
    private $password = "";
    public $conn;

    public function dbConnection() {
      $this->conn = null;
      try {
        $this->conn = new PDO("mysql:hosts=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        $this->conn->exec("set names utf8");
      } catch (PDOException $exception) {
        echo "Connection error: " . $exception->getMessage();
      }
      return $this->conn;
    }
  }
?>