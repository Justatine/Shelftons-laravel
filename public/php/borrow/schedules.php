<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';

    if($_SERVER['REQUEST_METHOD'] === "GET"){
        $sql1 = "SELECT book.ISBN AS bookISBN,book.bookImg, book.bookTitle, book.bookDesc, book.bookCat, book.publisher, book.yearPublished, 
            book.date_added, book.popularity, book.replacementCost, book.stocks, author.ISBN as authorISBN, author.author_fullname, borrowdetail.borrowStatus, borrowdetail.returnStatus, borrowdetail.returnSchedule, user.firstname, user.middlename, user.lastname
            FROM borrowdetail
            INNER JOIN book
            ON borrowdetail.ISBN = book.ISBN
            INNER JOIN author
            ON book.ISBN = author.ISBN
            LEFT JOIN user
            ON borrowdetail.userID = user.userID 
            WHERE borrowdetail.borrowStatus = 'Approved' ";
        $result = $conn->query($sql1);
            
        if ($result->num_rows > 0) {
            $response = array();
            while($row = $result->fetch_assoc()) {
            $response[] = $row;
            }
        } else {
            $response['no_borrows'] = 'no_borrows';
        }
    }else{
        echo json_encode(array('message' => "Internal server error", "messageType" => "404"));
    }

  echo json_encode($response);
  
  mysqli_close($conn);
?>