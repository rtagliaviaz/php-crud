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
  echo json_encode($data);
  $item->id = $data->id;

  if ($item->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Employee deleted."));
  } else {
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete employee."));
  }
?>