<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once 'connection.php';

$user_id = $_GET['user_id'];

$sql = "SELECT COUNT(*) AS count FROM borrowdetail WHERE userID  = '$user_id'";
$result = $conn->query($sql);

$response = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row['count'] === '3') {
            $response['limit'] = 'limit';
            break;
        }
    }
    if (!isset($response['limit'])) {
        $response['notlimit'] = 'notlimit';
    }
} else {
// $sql = "SELECT * FROM archive WHERE userID = '$user_id'";
    // $result = $conn->query($sql);

    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         if ($row['status_when_lost'] === 'Unpaid') {
    //             $response['lost'] = 'lost';
    //             break;
    //         }
    //     }
    // }
    // $response['no_borrow'] = 'no borrowed books';
}

echo json_encode($response);
  
mysqli_close($conn);
?>