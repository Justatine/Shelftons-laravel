<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once('connection.php');

  $id = $_POST['eid'];
// echo $id;

  $fname = $_POST['efname'];
  $mn = $_POST['emname'];
  $ln = $_POST['elname'];
  // $gender = $_POST['egender'];
  // $dob = $_POST['ebirthdate'];
  $em = $_POST['eemail'];
  $phn = $_POST['ephoneNo'];
  $ca = $_POST['ecurrent_address'];
  $city = $_POST['ecity'];
  $prov = $_POST['eprovince'];
  $zip = $_POST['ezipcode'];
  $un = $_POST['eusername'];
  $pwd = $_POST['epassword'];
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
      $query1 = "UPDATE user SET userImg='$newuserimg',
        firstname='$fname', middlename='$mn',lastname='$ln', email='$em',
        phoneNo='$phn', current_address='$ca',city='$city',province='$prov',
        zipcode='$zip',username='$un',password='$pwd' WHERE userID='$id'";
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
  } else {
    $query = "UPDATE user SET 
    firstname='$fname', middlename='$mn',lastname='$ln',email='$em',
    phoneNo='$phn',current_address='$ca', city='$city', province='$prov',
    zipcode='$zip',username='$un',password='$pwd' WHERE userID='$id'";   
    $res = mysqli_query($conn, $query);
    if ($res) {
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
mysqli_close($conn);
?>