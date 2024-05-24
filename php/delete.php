<?php 
require("connection.php");
$req_id = $_POST['h'];
$user_id = $_POST['h1'];

$kweri1 = "SELECT * FROM completed WHERE req_id = '$req_id' AND user_id = '$user_id'";
$kweried1 = mysqli_query($conn, $kweri1);
$kwerieded1 = $kweried1->fetch_assoc();

$name = $kwerieded1['namee'];
session_start();
$admin_id = $_SESSION['admin_id'];
mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$admin_id', DEFAULT, 'Admin', 'Deleted $name'" . "'s request form')");

$kweri = "DELETE FROM completed WHERE req_id = '$req_id'";
$kweried = mysqli_query($conn, $kweri);
header("Location: ../hyperlinks/completed.php");
?>