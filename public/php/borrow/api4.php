<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';

//   $sql1 = "SELECT book.bookCat AS bookcatheader FROM book GROUP BY bookCat";
  $sql1 = "SELECT bookCat FROM book GROUP BY bookCat";

  $result = $conn->query($sql1);
    
  if ($result->num_rows > 0) {
    $student = array();

    while($row = $result->fetch_assoc()) {
        $category = $row['bookCat'];
        $student[] = $row;

        $book = "SELECT * FROM book 
        WHERE bookCat= '$category'";
         $result1 = mysqli_query($conn, $book);
         while($row1 = mysqli_fetch_assoc($result1)) {
            $student[] = $row1;

         }
    }
  } else {
    $student['data'] = 'no_data';
  }
  echo json_encode($student);

  mysqli_close($conn);
?>