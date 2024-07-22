<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    require_once 'connection.php';
    
    if (isset($_POST['view-all'])) {
      unset($_POST['book-category']);
    }
    
    if (isset($_POST['book-category']) && !empty($_POST['book-category'])) {

      $cats = $_POST['bookcategory'];

      $sql1 = "SELECT * FROM book 
      LEFT JOIN author 
      on book.ISBN = author.ISBN
      WHERE book.bookCat = '$cats'";

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


    } else {
    $sql1 = "SELECT * FROM book 
    LEFT JOIN author 
    on book.ISBN = author.ISBN";
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
    }
  
  mysqli_close($conn);
?>