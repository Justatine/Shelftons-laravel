<?php
error_reporting(0);
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once 'connection.php';

  $bid = $_POST['lost_archive_borrowID'];
  $isbn = $_POST['lost_archive_isbn'];
  $uid = $_POST['lost_archive_userid'];
  
  $bd = $_POST['lost_archive__borrowDate'];
  $rd = $_POST['lost_archive__returnDate'];
  $rs = $_POST['lost_archive_returnStatus'];

  $lf = $_POST['lost_archive_fine'];
    
  $query = "INSERT INTO `archive` (`borrowID`, `ISBN`, `userID`, `borrowDate`, `returnDate`, `bookStatus`, `fine`)
   VALUES ('$bid', '$isbn', '$uid', '$bd', '$rd', '$rs', '$lf')";

      $res = mysqli_query($conn, $query);
      if ($res) {
        $query1 = "DELETE FROM borrowdetail WHERE borrowID = '$bid' ";
        $res1 = mysqli_query($conn, $query1);
            if ($res1) {
                $query2 = "DELETE FROM author WHERE ISBN = '$isbn' ";
                $res2 = mysqli_query($conn, $query2);
                if ($res2) {

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
                              echo "Image file deleted successfully!";
                          } else {
                              echo "Error deleting image file!";
                          }
                      }
                    }
                    
                    $query3 = "DELETE FROM book WHERE ISBN = '$isbn' ";
                    $res3 = mysqli_query($conn, $query3);
                    if ($res3) {
                        $msg = "Archived successfuly!";
                        echo json_encode(array('message' => $msg, "messageType" => "success"));  
                    }else{
                        echo json_encode(array('message' => "Failed", "messageType" => "failed"));
                    }
                }else{
                    echo json_encode(array('message' => "Failed", "messageType" => "failed"));
                }
            }else{
            echo json_encode(array('message' => "Failed", "messageType" => "failed"));
            }
        } else {
            echo json_encode(array('message' => "Failed", "messageType" => "failed"));
        }

    mysqli_close($conn);
?>
