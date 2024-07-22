<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once 'connection.php';

$user_id = $_POST['userid'];
// $bid = $_POST['isbn'];

$sql = "SELECT * FROM borrowdetail WHERE userID = '$user_id' ";
$result = $conn->query($sql);

$response = array();
if ($result->num_rows > 0) {
    // while ($row = $result->fetch_assoc()) {
    $row = $result->fetch_assoc();
        if ($row['borrowStatus'] === 'Overdue') {
            $response['overdue'] = 'overdue';
            // break;
        }else{
            $response['not_due'] = 'no overdue';
        }
    // }
    // if (!isset($response['overdue'])) {
    //     $response['not_due'] = 'not_due';
    // }
} else {
    $response['not_due'] = 'no dues';
}

echo json_encode($response);
  
mysqli_close($conn);
?>