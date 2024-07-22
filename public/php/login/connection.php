<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_lms";

// Create connection
$conn = new mysqli('localhost','u677328146_justinet','Justatine_2227','u677328146_shelftons');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>