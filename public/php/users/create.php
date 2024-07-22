<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once('connection.php');

  date_default_timezone_set('Asia/Manila');
  $id = date('ymdhis');
  $fn = $_POST['fname'];
  $mn = $_POST['mname'];
  $ln = $_POST['lname'];
  $gender = $_POST['gender'];
  $dob = $_POST['birthdate'];
  $em = $_POST['email'];
  $phn = $_POST['phoneNo'];
  $ca = $_POST['current_address'];
  $city = $_POST['city'];
  $prov = $_POST['province'];
  $zip = $_POST['zipcode'];
  $un = $_POST['username'];
  $pwd = $_POST['password'];
  $ut = "Guest";
  $userimg = $_FILES['userimg']['tmp_name'];
  
  $userimg = time() . '-' . $_FILES['userimg']['name'];
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($userimg);
  
  if(move_uploaded_file($_FILES['userimg']['tmp_name'], $target_file)){
    $query = "INSERT INTO user (userID,userImg,firstname,middlename,lastname,gender, birthdate, email,phoneNo,current_address,city,province,zipcode,username,password,userType) 
    VALUES ('$id','$userimg','$fn','$mn','$ln','$gender','$dob','$em','$phn','$ca','$city','$prov','$zip','$un','$pwd','$ut')";

      $res = mysqli_query($conn, $query);
      if ($res) {
        $msg = "Added Successfuly!";
        echo json_encode(array('message' => $msg, "messageType" => "success"));
      } else {
        echo json_encode(array('message' => "Failed", "messageType" => "failed"));
      }
  }
  // $results = mysqli_query($conn, "SELECT * FROM user");
  // $user = mysqli_fetch_all($results, MYSQLI_ASSOC);
  
  mysqli_close($conn);
?>
