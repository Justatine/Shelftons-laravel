<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once('connection.php');

$id = $_POST['id'];
$pwd = $_POST['passid'];

    $query = "UPDATE user SET password='$pwd' WHERE userID='$id'";   
    $res = mysqli_query($conn, $query);
    if ($res) {
        $response = array(
        'messageType' => 'success',
        'message' => 'Password updated successfully.'
        );
        echo json_encode($response);
    } else {
        $response = array(
        'messageType' => 'failed',
        'message' => 'Failed to update user'
        );
        echo json_encode($response);
    }

mysqli_close($conn);
?>