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
  $data = json_decode(file_get_contents("php://input"));
  $item->name = $data->name;
  $item->email = $data->email;
  $item->age = $data->age;
  $item->designation = $data->designation;
  $item->created = date("Y-m-d H:i:s");

  if ($item->create()) {
    http_response_code(201);
    echo json_encode(array("message" => "Employee created."));
  } else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to create employee."));
  }
?>