<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    
    require_once 'connection.php';
    $borrowID = $_POST['id'];

  // echo $row['userimg'];
  $sql = "DELETE FROM borrowdetail WHERE borrowID = $borrowID ";
  $res = mysqli_query($conn, $sql);
  if ($res) {
      $msg = "Borrow deleted successfuly!";
      echo json_encode(array('message' => $msg, "messageType" => "success"));
    }else{
      echo json_encode(array('message' => "Failed", "messageType" => "failed"));
    }
    mysqli_close($conn);
?>
