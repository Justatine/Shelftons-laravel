<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';

  $sql1 = "SELECT * FROM `borrowdetail`
  INNER JOIN book
  ON borrowdetail.ISBN = book.ISBN
  INNER JOIN user
  ON borrowdetail.userID = user.userID
  WHERE userID = 230409032422";
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