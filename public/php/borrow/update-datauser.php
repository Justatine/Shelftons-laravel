<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';

  $bid  = $_POST['borrowID'];
  $borrstat = 'Cancelled';

  $query = "UPDATE borrowdetail SET 
       borrowStatus='Cancelled' WHERE borrowdetail.borrowID ='$bid' ";      
  $res = mysqli_query($conn, $query);
    if ($res) {
      $query1 = "UPDATE `book` SET `popularity` = `popularity` - 1 WHERE `ISBN` = '$bid'";
      $res1 = mysqli_query($conn, $query1);
      if ($res1) {
        $msg = "Borrow updated successfuly!";
        echo json_encode(array('message' => $msg, "messageType" => "success"));
      }else{
        echo json_encode(array('message' => "Failed", "messageType" => "failed"));
      }

    }else{
      echo json_encode(array('message' => "Failed", "messageType" => "failed"));
    }
  mysqli_close($conn);
