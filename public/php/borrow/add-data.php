<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once 'connection.php';

  $userid = $_POST['userid'];
  $id = $_POST['id'];
  $currentTimestamp = time();
  $returnScheduleTimestamp = $currentTimestamp + (3 * 24 * 60 * 60);
  $returnScheduleDate = date('Y-m-d', $returnScheduleTimestamp);

  $query = "INSERT INTO `borrowdetail` (`borrowID`, `userID`, `ISBN`, `borrowDate`, `returnSchedule`, `returnDate`, `borrowStatus`, `returnStatus`, `fine`)
   VALUES (NULL, '$userid', '$id', current_timestamp(), '$returnScheduleDate', NULL, 'Pending', NULL, '0.00')";

      $res = mysqli_query($conn, $query);
      if ($res) {

        $query1 = "UPDATE `book` SET `popularity` = `popularity` + 1 WHERE `ISBN` = '$id'";
        $res1 = mysqli_query($conn, $query1);

        if ($res1) {
          $msg = "Book borrowed successfuly!";
          echo json_encode(array('message' => $msg, "messageType" => "success"));   
        }else{
          echo json_encode(array('message' => "Failed", "messageType" => "failed"));
        }

      } else {
        echo json_encode(array('message' => "Failed", "messageType" => "failed"));
      }

    mysqli_close($conn);
?>
