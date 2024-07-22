<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';

  $bid  = $_POST['borrowID'];
  $fine = $_POST['borrowFine'];

  $query = "UPDATE borrowdetail SET 
            returnStatus='Lost', fine = '$fine'
            WHERE borrowID ='$bid' ";      
  $res = mysqli_query($conn, $query);
    if ($res) {
      $msg = "Borrow updated successfuly!";
      echo json_encode(array('message' => $msg, "messageType" => "success"));
    }else{
      echo json_encode(array('message' => "Failed", "messageType" => "failed"));
    }
  mysqli_close($conn);
