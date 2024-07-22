<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once 'connection.php';

$sql = "SELECT COUNT(borrowID) as count FROM borrowdetail";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['count'];

    $response = array('count' => $count);
    echo json_encode($response);
} else {
    echo json_encode(array('error' => 'No results'));
}

mysqli_close($conn);
?>