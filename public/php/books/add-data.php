<?php
error_reporting(0);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once 'connection.php';

  $isbn = $_POST['ISBN'];
  $bt = $_POST['bookTitle'];
  $bd = $_POST['bookDesc'];
  $bc = $_POST['bookCat'];
  $pub = $_POST['publisher'];
  $yrpub = $_POST['yearPublished'];
  $repcos = $_POST['replacementCost'];
  $stocks = $_POST['stocks'];
  $afn = $_POST['author_fullname'];
  $img = $_POST['bookImg'];
  
  $img = time() . '-' . $_FILES['bookImg']['name'];
  $target_dir = "book-imgs/";
  $target_file = $target_dir . basename($img);
  
  if(move_uploaded_file($_FILES['bookImg']['tmp_name'], $target_file)){
    $query = "INSERT INTO book (ISBN,bookImg,bookTitle,bookDesc,bookCat,publisher,yearPublished,replacementCost,stocks) 
    VALUES ('$isbn','$img','$bt','$bd','$bc','$pub','$yrpub','$repcos','$stocks')";

      $res = mysqli_query($conn, $query);
      if ($res) {
        $query1 = "INSERT INTO author (authorID, ISBN, author_fullname) 
        VALUES (NULL, '$isbn','$afn')";

          $res1 = mysqli_query($conn, $query1);
          if ($res1) {
            $msg = "Book addedd successfuly!";
            echo json_encode(array('message' => $msg, "messageType" => "success"));
          }else{
            echo json_encode(array('message' => "Failed", "messageType" => "failed"));
          }      
      } else {
        echo json_encode(array('message' => "Failed", "messageType" => "failed"));
      }
  }
  $results = mysqli_query($conn, "SELECT * FROM book LEFT JOIN author on book.ISBN = author.ISBN");
  $user = mysqli_fetch_all($results, MYSQLI_ASSOC);
  
  mysqli_close($conn);
?>
