<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';
  
    $id = $_POST['id'];
    
  $sql1 = "SELECT borrowdetail.borrowID, borrowdetail.userID, borrowdetail.ISBN 
  AS borrowISBN, borrowdetail.borrowDate, borrowdetail.returnSchedule, borrowdetail.returnDate, borrowdetail.borrowStatus, borrowdetail.returnStatus, borrowdetail.fine,
  book.ISBN AS bookISBN, book.bookTitle, book.bookImg, book.replacementCost AS borrowFine
  FROM book
  INNER JOIN borrowdetail ON book.ISBN = borrowdetail.ISBN
  WHERE borrowdetail.userID = '$id' ";
  $result = $conn->query($sql1);
  
  if ($result->num_rows > 0) {
    $student = array();
    while($row = $result->fetch_assoc()) {
      $student[] = $row;
    }
  } else {
    $student['data'] = 'no_data';
  }
  echo json_encode($student);
  
  mysqli_close($conn);
?>