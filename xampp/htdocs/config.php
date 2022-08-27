<?php
$servername = "localhost";
$username = "Shubham";
$password = "Shubham";
$dbname = "fmoji";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>