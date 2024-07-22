<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';
    // $sql1 = "SELECT * FROM `borrowdetail`
  // INNER JOIN book
  // ON borrowdetail.ISBN = book.ISBN
  // INNER JOIN user
  // ON borrowdetail.userID = user.userID";
  // $id = $_POST['id'];
  
  // $sql1 = "SELECT borrowdetail.borrowID, borrowdetail.userID, borrowdetail.ISBN 
  // AS borrowISBN, borrowdetail.borrowDate, borrowdetail.returnSchedule, borrowdetail.returnDate, borrowdetail.borrowStatus, borrowdetail.returnStatus, borrowdetail.fine,
  // book.ISBN AS bookISBN, book.bookTitle, book.bookImg, book.replacementCost AS borrowFine
  // FROM book
  // INNER JOIN borrowdetail ON book.ISBN = borrowdetail.ISBN
  // WHERE borrowdetail.userID = '$id' ";

    $sql1 = "SELECT borrowdetail.borrowID, borrowdetail.userID, borrowdetail.ISBN 
    AS borrowISBN, borrowdetail.borrowDate, borrowdetail.returnSchedule, borrowdetail.returnDate, borrowdetail.borrowStatus, borrowdetail.returnStatus, borrowdetail.fine,
    book.ISBN AS bookISBN, book.bookTitle, book.bookImg, book.replacementCost AS borrowFine
    FROM book
    INNER JOIN borrowdetail ON book.ISBN = borrowdetail.ISBN ";
  $result = $conn->query($sql1);
  
  if ($result->num_rows > 0) {
    $response = array();
    while($row = $result->fetch_assoc()) {
      $response[] = $row;
    }
  } else {
    $response['data'] = 'no_data';
  }
  echo json_encode($response);
  
  mysqli_close($conn);
?>