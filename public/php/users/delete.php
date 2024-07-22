<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once('connection.php');

  $id = $_POST['id'];

  $sql2 = "SELECT * FROM user WHERE userID = $id";
  $r2 = mysqli_query($conn, $sql2);
  $row = mysqli_fetch_assoc($r2);
  $imageFilename = $row['userImg'];

  // echo $row['userimg'];

  if (!empty($imageFilename)) {
    $imagePath = "uploads/" . $imageFilename; 
    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
          $msg = "User deleted successfuly!";
          echo json_encode(array('message' => $msg, "messageType" => "success"));
        } else {
          echo json_encode(array('message' => "Failed", "messageType" => "failed"));
        }
  }
}

  $sql = "DELETE FROM user WHERE userID = $id";
  if (mysqli_query($conn, $sql)) {
    $response = array(
      'messageType' => 'success',
      'message' => 'User deleted successfully.'
    );
    $jsonResponse = json_encode($response);

  } else {
    echo json_encode(array('message' => "Failed", "messageType" => "failed"));
}
mysqli_close($conn);
?>
