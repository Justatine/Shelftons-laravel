<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';
    
    $isbn = $_POST['id'];

$sql1 = "SELECT book.ISBN AS bookISBN,book.bookImg, book.bookTitle, book.bookDesc, book.bookCat, book.publisher, book.yearPublished, book.date_added, book.popularity, book.replacementCost, book.stocks, author.ISBN as authorISBN, author.author_fullname, borrowdetail.borrowStatus  
  FROM book
  INNER JOIN author
  on book.ISBN = author.ISBN 
  LEFT JOIN  borrowdetail
  ON book.ISBN = borrowdetail.ISBN 
  WHERE book.ISBN = '$isbn' "; 

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