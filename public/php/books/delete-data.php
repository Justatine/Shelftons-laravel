<?php
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    
    require_once 'connection.php';
    $isbn = $_POST['id'];

  // echo $row['userimg'];
    $response = array();

    $sql2 = "SELECT * FROM book WHERE ISBN = ?";
    $stmt = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt, "i", $isbn);
    mysqli_stmt_execute($stmt);
    $r2 = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($r2)){
      $imageFilename = $row['bookImg'];
    }
    
    if (!empty($imageFilename)) {
      $imagePath = "book-imgs/" . $imageFilename; 
      if (file_exists($imagePath)) {
          if (unlink($imagePath)) {       
            } else {
              echo json_encode(array('message' => "Error deleting image file!", "messageType" => "failed"));
          }
      }
    }
    $sql = "DELETE FROM author WHERE ISBN = '$isbn' ";
    $res = mysqli_query($conn, $sql);
    if ($res) {

    $sql1 = "DELETE FROM book WHERE ISBN = '$isbn' ";
    $res1 = mysqli_query($conn, $sql1);
    if ($res1) {
      $response = array(
        'messageType' => 'success',
        'message' => 'Book deleted successfully!'
      );
      echo json_encode($response);   
    }else{
      $response = array(
        'messageType' => 'success',
        'message' => 'Failed to delete book.'
      );
      echo json_encode($response);       
    }
  } else {
    $response = array(
      'messageType' => 'success',
      'message' => 'Failed to delete book.'
    );
    echo json_encode($response);    
  }
  mysqli_close($conn);
?>
