<?php
// localhost
$servername = "localhost";
$username = "root";
$password = "";
$database = "shop-online";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8");

date_default_timezone_set('Asia/Bangkok');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>