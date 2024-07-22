<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once('connection.php');

$id = $_POST['id'];
$pwd = $_POST['passid'];

if (preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,}$/m', $pwd)) {
  $msg1 = "Password is valid.";
  echo json_encode(array('message' => $msg1, "messageType" => "success"));

} else {
  $msg = "Password is not valid.";
  echo json_encode(array('message' => $msg, "messageType" => "failed"));
}

mysqli_close($conn);
?>