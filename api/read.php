<?php 
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  // include database and object files
  include_once '../config/database.php';
  include_once '../class/employees.php';

  // instantiate database and employee object
  $database = new Database();
  $db = $database->dbConnection();
  $items = new Employees($db);
  $stmt = $items->getAll();
  $itemCount = $stmt->rowCount();

  echo json_encode($itemCount);
  if ($itemCount > 0) {
    // employees array
    $employees_arr = array();
    $employees_arr["body"] = array();
    $employees_arr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $employee_item = array(
        "id" => $id,
        "name" => $name,
        "email" => $email,
        "age" => $age,
        "designation" => $designation,
        "created" => $created
      );
      array_push($employees_arr["body"], $employee_item);
    }
    echo json_encode($employees_arr);
  }
  else {
    http_response_code(404);
    echo json_encode(array("message" => "No employees found."));
  }

?>