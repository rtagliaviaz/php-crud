<?php 
  class Employees {
    // database connection and table name
    private $conn;
    private $table_name = "employee";
    //column names
    public $id;
    public $name;
    public $email;
    public $age;
    public $designation;
    public $created;

    // db connection
    public function __construct($db) {
      $this->conn = $db;
    }

    // get all employees
    public function getAll() {
      $query = "SELECT * FROM " . $this->table_name . "";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      return $stmt;
    }

    // get single employee
    public function getSingle() {
      $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $this->id);
      $stmt->execute();
      $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
      
      $this->name = $dataRow['name'];
      $this->email = $dataRow['email'];
      $this->age = $dataRow['age'];
      $this->designation = $dataRow['designation'];
      $this->created = $dataRow['created'];
    }

    // create employee
    public function create() {
      $query = "INSERT INTO " . $this->table_name . " SET name = :name, email = :email, age = :age, designation = :designation, created = :created";
      $stmt = $this->conn->prepare($query);

      // sanitize
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->age = htmlspecialchars(strip_tags($this->age));
      $this->designation = htmlspecialchars(strip_tags($this->designation));
      $this->created = htmlspecialchars(strip_tags($this->created));

      // bind values
      $stmt->bindParam(":name", $this->name);
      $stmt->bindParam(":email", $this->email);
      $stmt->bindParam(":age", $this->age);
      $stmt->bindParam(":designation", $this->designation);
      $stmt->bindParam(":created", $this->created);

      if($stmt->execute()) {
        return true;
      }
      return false;
    }

    // update employee
    public function update() {
      $query = "UPDATE " . $this->table_name . " SET name = :name, email = :email, age = :age, designation = :designation, created = :created WHERE id = :id";
      $stmt = $this->conn->prepare($query);

      // sanitize
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->age = htmlspecialchars(strip_tags($this->age));
      $this->designation = htmlspecialchars(strip_tags($this->designation));
      $this->created = htmlspecialchars(strip_tags($this->created));
      $this->id = htmlspecialchars(strip_tags($this->id));

      // bind values
      $stmt->bindParam(":name", $this->name);
      $stmt->bindParam(":email", $this->email);
      $stmt->bindParam(":age", $this->age);
      $stmt->bindParam(":designation", $this->designation);
      $stmt->bindParam(":created", $this->created);
      $stmt->bindParam(":id", $this->id);

      if($stmt->execute()) {
        return true;
      }
        return false;
    }

    // delete employee
    public function delete() {
      $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(":id", $this->id);
      if($stmt->execute()) {
        return true;
      }
      return false;
      
    }
  }
