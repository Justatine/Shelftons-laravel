<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
require_once 'connection.php';

$user_id = $_GET['user_id'];
$isbn = $_GET['isbn'];
$borrowid = $_GET['bid'];

$sql = "SELECT * FROM `borrowdetail`
        INNER JOIN book
        ON borrowdetail.ISBN = book.ISBN
        WHERE borrowdetail.borrowID = ?";
$statement = $conn->prepare($sql);
$statement->bind_param('s', $borrowid);
$statement->execute();

$response = array();
$result = $statement->get_result();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stock = $row['stocks'];
        $new_stock = ($stock - 1);
        if ($row['borrowStatus'] === 'Approved') {
            $sql1 = "UPDATE book SET stocks = ? WHERE ISBN = ?";
            $statement1 = $conn->prepare($sql1);
            $statement1->bind_param('is', $new_stock, $isbn);
            if ($statement1->execute()) {
                $response['stockups'] = 'updated';
            } else {
                $response['stockups'] = 'not updated';
            }
            break;
        }
    }
} else {

}

echo json_encode($response);

$statement->close();
$statement1->close();
mysqli_close($conn);
?>