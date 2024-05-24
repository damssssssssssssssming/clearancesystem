<?php
require("connection.php");
session_start();
$admin_id = $_SESSION['admin_id'];
$req_id = $_POST['h'];
$user_id = $_POST['h1'];
$reason = $_POST['reason1'];

$kweri1 = "SELECT * FROM pdf_table WHERE id = '$req_id'";
$kweried1 = mysqli_query($conn, $kweri1);
$kwerieded1 = $kweried1->fetch_assoc();

$name = $kwerieded1['namee'];
$type = $kwerieded1['typee'];

$kweri = "INSERT INTO notification VALUES(NULL, 
'$user_id', 
'$req_id', 
'Your $type has been declined by the Admin.');";
$kweried = mysqli_query($conn, $kweri);

$kweri2 = "DELETE FROM pdf_table WHERE id = '$req_id'";
$kweri22 = "DELETE FROM rquirements WHERE request_id = '$req_id'";
$kweri23 = "DELETE FROM schedule_user WHERE req_id = '$req_id'";
mysqli_query($conn, "INSERT INTO numm VALUES(NULL, '$user_id', '$req_id', 'Unchecked')");
$kweried2 = mysqli_query($conn, $kweri2);
$kweried2 = mysqli_query($conn, $kweri22);
$kweried2 = mysqli_query($conn, $kweri23);
mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$admin_id', DEFAULT, 'Admin', 'Declined $name'" . "'s request form')");
header("Location: ../hyperlinks/pending.php");
?>