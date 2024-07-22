<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once('connection.php');

  $id = $_POST['eid'];
  $newuserimg = $_FILES['newuserimg']['name'];
  $imgTmpName = $_FILES['newuserimg']['tmp_name'];

  $empty = 'true';
  if (is_uploaded_file($imgTmpName)) {
    $empty = 'false';
  }
  $sql2 = "SELECT * FROM user WHERE userID = ?";
  $stmt = mysqli_prepare($conn, $sql2);
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $r2 = mysqli_stmt_get_result($stmt);
  while($row = mysqli_fetch_assoc($r2)){
    $imageFilename = $row['userImg'];
  }

  if ($empty == 'false') {
    if (!empty($imageFilename)) {
      $imagePath = "uploads/" . $imageFilename; 
      if (file_exists($imagePath)) {
          if (unlink($imagePath)) {
            $response = array(
              'messageType' => 'success',
              'message' => 'Image updated successfully.'
            );
            echo json_encode($response);
          } else {
            $response = array(
              'messageType' => 'failed',
              'message' => 'Failed to update image'
            );
            echo json_encode($response);
          }
      }
    }
  
    $newuserimg = time() . '-' . $_FILES['newuserimg']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($newuserimg);

    if(move_uploaded_file($_FILES['newuserimg']['tmp_name'], $target_file)){
      $query1 = "UPDATE user SET userImg='$newuserimg' WHERE userID='$id'";
      $res1 = mysqli_query($conn, $query1);
      if ($res1) {
        $response = array(
          'messageType' => 'success',
          'message' => 'User updated successfully.'
        );
        echo json_encode($response);
      } else {
        $response = array(
          'messageType' => 'failed',
          'message' => 'Failed to delete user'
        );
        echo json_encode($response);
      }
    }
  }
mysqli_close($conn);
?>