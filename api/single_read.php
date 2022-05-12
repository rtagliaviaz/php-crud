<?php 
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  // include database and object files
  include_once '../config/database.php';
  include_once '../class/employees.php';

  // instantiate database and employee object
  $database = new Database();
  $db = $database->dbConnection();
  $item = new Employees($db);
  $item->id = isset($_GET['id']) ? $_GET['id'] : die();

  $item->getSingle($item->id);

  // echo json_encode($itemCount);

  if ($item != null) {
    // // employees array
    // $employees_arr = array();
    // $employees_arr["body"] = array();
    // $employees_arr["itemCount"] = $itemCount;


    $employee = array(
      "id" => $item->id,
      "name" => $item->name,
      "email" => $item->email,
      "age" => $item->age,
      "designation" => $item->designation,
      "created" => $item->created
    );
    
    http_response_code(200);
    echo json_encode($employee);
  }
  else {
    http_response_code(404);
    echo json_encode(array("message" => "No employees found."));
  }

?>