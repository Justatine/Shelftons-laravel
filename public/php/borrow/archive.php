<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once 'connection.php';

$sql1 = "SELECT * FROM archive WHERE bookStatus = 'Returned' ";
  $result = $conn->query($sql1);
  
  if ($result->num_rows > 0) {
    $student = array();
    while($row = $result->fetch_assoc()) {
      $student[] = $row;
    }
  } else {
    $student['data'] = 'no_data';
  }
  echo json_encode($student);
  
  mysqli_close($conn);
?>