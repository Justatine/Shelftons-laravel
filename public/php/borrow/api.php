<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';

  $sql1 = "SELECT book.ISBN AS bookISBN, book.bookTitle, book.replacementCost, author.ISBN AS authorISBN, borrowdetail.ISBN AS borrowISBN, borrowdetail.borrowStatus AS borrowStatus
  FROM book
  LEFT JOIN author ON book.ISBN = author.ISBN
  LEFT JOIN borrowdetail ON book.ISBN = borrowdetail.ISBN";
  $result = $conn->query($sql1);
    
  if ($result->num_rows > 0) {
    $student = array();
    while($row = $result->fetch_assoc()) {
      $student[] = $row;
    }
  } else {
    echo "0 results";
  }
  echo json_encode($student);
  
  mysqli_close($conn);
?>