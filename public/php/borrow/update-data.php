<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once 'connection.php';

$currentDate = date('Y-m-d');
$timestamp = strtotime($currentDate);
$threeDaysInSeconds = 3 * 24 * 60 * 60;
$newTimestamp = $timestamp + $threeDaysInSeconds;
$newDate = date('Y-m-d', $newTimestamp);

$bid  = $_POST['borrowID'];
$bookid  = $_POST['bookid'];
$resched = $_POST['returnSchedule'];
$retdate = $_POST['returnDate'];
$borrstat = $_POST['borrowStatus'];
$retstat = $_POST['returnStatus'];
$fine = $_POST['fine'];

$query0 = "SELECT * FROM `borrowdetail`
          INNER JOIN book
          ON borrowdetail.ISBN = book.ISBN
          where borrowdetail.borrowID = '$bid' ";
$res0 = mysqli_query($conn, $query0);
while ($row = mysqli_fetch_array($res0)) {
  $stock  = $row['stocks'];
  $newfine  = $row['replacementCost'];
  $hourlyfine = 10;
}

$query = "UPDATE borrowdetail SET 
      returnSchedule ='$newDate', returnDate='$retdate', borrowStatus='$borrstat', returnStatus='$retstat',
      fine='$fine' WHERE borrowID ='$bid' ";
$res = mysqli_query($conn, $query);

if($borrstat === 'Overdue'){
  $updateFineQuery = "UPDATE borrowdetail SET fine = '$hourlyfine'  WHERE borrowdetail.borrowID ='$bid' ";
  $updateFineResult = mysqli_query($conn, $updateFineQuery);
}

if ($borrstat === 'Approved' && $retstat === 'Not returned') {
  $updateStocksQuery = "UPDATE book SET stocks = '$stock' - 1 WHERE ISBN = '$bookid'";
  $updateStocksResult = mysqli_query($conn, $updateStocksQuery);
}else if ($borrstat === 'Cancelled') {
  $updateStocksQuery = "UPDATE book SET stocks = '$stock' + 1 WHERE ISBN = '$bookid'";
  $updateStocksResult = mysqli_query($conn, $updateStocksQuery);
}else if ($borrstat === 'Approved' && $retstat === 'Returned' && $retdate !== NULL) {
  $updateStocksQuery = "UPDATE book SET stocks = '$stock' + 1 WHERE ISBN = '$bookid'";
  $updateStocksResult = mysqli_query($conn, $updateStocksQuery);
}else if ($borrstat === 'Approved' && $retstat === 'Lost' && $retdate === NULL) {
  $updateStocksQuery = "UPDATE book SET stocks = '$stock' - 1 WHERE ISBN = '$bookid'";
  $updateStocksResult = mysqli_query($conn, $updateStocksQuery);
}


if ($res) {
  $msg = "Borrow updated successfuly!";
  echo json_encode(array('message' => $msg, "messageType" => "success"));
} else {
  echo json_encode(array('message' => "Failed", "messageType" => "failed"));
}
mysqli_close($conn);
?>
