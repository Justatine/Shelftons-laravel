<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';

    $userid = $_POST['userid'];
    $isbn = $_POST['isbn'];
    
    $sql1 = "SELECT book.ISBN AS bookISBN,book.bookImg, book.bookTitle, book.bookDesc, book.bookCat, book.publisher, book.yearPublished, book.date_added, book.popularity, book.replacementCost, book.stocks, author.ISBN as authorISBN, author.author_fullname, borrowdetail.borrowStatus, borrowdetail.returnStatus
    FROM book
    INNER JOIN author
    on book.ISBN = author.ISBN 
    LEFT JOIN  borrowdetail
    ON book.ISBN = borrowdetail.ISBN 
    WHERE borrowdetail.userID = '$userid' AND borrowdetail.ISBN = '$isbn' "; 

  $result = $conn->query($sql1);
  $response = array();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();   
    if ($row['borrowStatus'] === 'Pending' || $row['borrowStatus'] === 'Approved') {
        $response['borrowed'] = 'borrowed';
    }else{
        $response['not_borrowed'] = 'not_borrowed';
    }    
  } else {
    $response['no_borrow'] = 'no borrowed books';
  }
  echo json_encode($response);
  
  mysqli_close($conn);
?>