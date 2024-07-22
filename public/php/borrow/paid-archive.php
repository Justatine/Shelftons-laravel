<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';

  $aid  = $_POST['archive_id_paid'];

  $query = "UPDATE archive SET status_when_lost='Paid' WHERE archiveID ='$aid' ";      
  $res = mysqli_query($conn, $query);
    if ($res) {
      $msg = "Lost book updated successfuly!";
      echo json_encode(array('message' => $msg, "messageType" => "success"));
    }else{
      echo json_encode(array('message' => "Failed", "messageType" => "failed"));
    }
  mysqli_close($conn);
