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

    $query = "UPDATE user SET 
    firstname='$fname', middlename='$mn',lastname='$ln',email='$em',
    phoneNo='$phn',current_address='$ca', city='$city', province='$prov',
    zipcode='$zip',username='$un' WHERE userID='$id'";   
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
mysqli_close($conn);
?>