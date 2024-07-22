<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once 'connection.php';

  $bid = $_POST['borrowID'];
  $isbn = $_POST['isbn'];
  $uid = $_POST['userid'];
  $bd = $_POST['archive__borrowDate'];
  $rd = $_POST['archive_returnDate'];
  $rs = $_POST['archive_returnStatus'];
  $fine = $_POST['archive_fine'];

  $query = "INSERT INTO `archive` (`borrowID`, `ISBN`, `userID`, `borrowDate`, `returnDate`, `bookStatus`, `fine`)
   VALUES ('$bid', '$isbn', '$uid', '$bd', '$rd', '$rs', '$fine')";
      $res = mysqli_query($conn, $query);
      if ($res) {
        $query1 = "DELETE FROM borrowdetail WHERE borrowID = '$bid '";
        $res1 = mysqli_query($conn, $query1);
        if ($res1) {
          $msg = "Archived successfuly!";
          echo json_encode(array('message' => $msg, "messageType" => "success"));  
        }else{
          echo json_encode(array('message' => "Failed", "messageType" => "failed"));
        }
      } else {
        echo json_encode(array('message' => "Failed", "messageType" => "failed"));
      }

    mysqli_close($conn);
?>
