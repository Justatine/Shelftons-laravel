<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    
    require_once 'connection.php';

  $isbn = $_POST['eisbn'];
  $bt = $_POST['ebookTitle'];
  $bd = $_POST['ebookDesc'];
  $bc = $_POST['ebookCat'];
  $pub = $_POST['epublisher'];
  $yrpub = $_POST['eyearPublished'];
  $repcos = $_POST['ereplacementCost'];
  $stock = $_POST['estocks'];
  $afn = $_POST['eauthor_fullname'];

  $newbookimg = $_FILES['newbookimg']['name'];
  $imgTmpName = $_FILES['newbookimg']['tmp_name'];

  $empty = 'true';
  if (is_uploaded_file($imgTmpName)) {
    $empty = 'false';
  }
  // echo "<script>alert($id)</script>";
  
  $sql2 = "SELECT * FROM book WHERE ISBN = ?";
  $stmt = mysqli_prepare($conn, $sql2);
  mysqli_stmt_bind_param($stmt, "i", $isbn);
  mysqli_stmt_execute($stmt);
  $r2 = mysqli_stmt_get_result($stmt);
  while($row = mysqli_fetch_assoc($r2)){
    $imageFilename = $row['bookImg'];
  }

  // echo $row['userimg'];
  
  if ($empty == 'false') {
    if (!empty($imageFilename)) {
      $imagePath = "book-imgs/" . $imageFilename; 
      if (file_exists($imagePath)) {
          if (unlink($imagePath)) {
            //   echo "Image file deleted successfully!";
          } else {
            //   echo "Error deleting image file!";
          }
      }
    }
  
    $newbookimg = time() . '-' . $_FILES['newbookimg']['name'];
    $target_dir = "book-imgs/";
    $target_file = $target_dir . basename($newbookimg);

    if(move_uploaded_file($_FILES['newbookimg']['tmp_name'], $target_file)){
      $query = "UPDATE book SET 
      ISBN ='$isbn', 
      bookImg='$newbookimg',
      bookTitle='$bt',
      bookDesc='$bd',
      bookCat='$bc',
      publisher='$pub',
      yearPublished='$yrpub',
      replacementCost='$repcos',
      stocks='$stock'
      WHERE ISBN='$isbn'";      
      $res = mysqli_query($conn, $query);
      if ($res) {
        $query1 = "UPDATE author SET 
        ISBN ='$isbn', 
        author_fullname='$afn'
        WHERE ISBN='$isbn'";      
        $res1 = mysqli_query($conn, $query1);
        if ($res1) {
          $msg = "Book updated successfuly!";
          echo json_encode(array('message' => $msg, "messageType" => "success"));
        }else{
          echo json_encode(array('message' => "Failed", "messageType" => "failed"));
        }
      } else {
        echo json_encode(array('message' => "Failed", "messageType" => "failed"));
      }
    }
  } else {
    $query = "UPDATE book SET 
    ISBN ='$isbn', 
    bookTitle='$bt',
    bookDesc='$bd',
    bookCat='$bc',
    publisher='$pub',
    yearPublished='$yrpub',
    replacementCost='$repcos',
    stocks='$stock'
    WHERE ISBN='$isbn'";      
    $res = mysqli_query($conn, $query);
    if ($res) {
      $query1 = "UPDATE author SET 
      ISBN ='$isbn', 
      author_fullname='$afn'
      WHERE ISBN='$isbn'";      
      $res1 = mysqli_query($conn, $query1);
      if ($res1) {
        $msg = "Book updated successfuly!";
        echo json_encode(array('message' => $msg, "messageType" => "success"));
      }else{
        echo json_encode(array('message' => "Failed", "messageType" => "failed"));
      }
    } else {
      echo json_encode(array('message' => "Failed", "messageType" => "failed"));
    }
  }
  mysqli_close($conn);
  ?>
