<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';

  $sql1 = "SELECT * FROM book 
  ORDER by bookCat ASC";
  $result = $conn->query($sql1);
    
  if ($result->num_rows > 0) {
    $response = array();
    while($row = $result->fetch_assoc()) {
      $response[] = $row;
    }
  } else {
    $response['data'] = 'no_data';
  }
  echo json_encode($response);
  
  mysqli_close($conn);
?>