<?php
session_start();
$admin_id = $_SESSION['admin_id'];
require("connection.php");
$req_id = $_POST['h'];
$user_id = $_POST['h1'];

$kweri1 = "SELECT * FROM pdf_table WHERE id = '$req_id'";
$kweried1 = mysqli_query($conn, $kweri1);
$kwerieded1 = $kweried1->fetch_assoc();

$name = $kwerieded1['namee'];
$type = $kwerieded1['typee'];

$kweri = "INSERT INTO notification VALUES(NULL, 
'$user_id', 
'$req_id', 
'Your $type has been accepted by the Admin. Please wait for further updates regarding the status of your request.');";
$kweri11 = "INSERT INTO in_proc VALUES(NULL, 
'$user_id', 
'$req_id', 
'$name',
'$type',
CURDATE(),
'In Processing');";
$kweried = mysqli_query($conn, $kweri);
$kweried = mysqli_query($conn, $kweri11);
$kwerieddd = mysqli_query($conn, "SELECT * FROM schedule_user WHERE req_id = '$req_id'");
$kweriededdd = $kwerieddd->fetch_assoc();
$sched = $kweriededdd['sched'];

mysqli_query($conn, "INSERT INTO numm VALUES(NULL, '$user_id', '$req_id', 'Unchecked')");

$kweri2 = "DELETE FROM pdf_table WHERE id = '$req_id'";
$kweri22 = "DELETE FROM rquirements WHERE request_id = '$req_id'";
$kweried2 = mysqli_query($conn, $kweri2);
$kweried2 = mysqli_query($conn, $kweri22);
mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$admin_id', DEFAULT, 'Admin', 'Accepted $name'" . "'s request form')");
mysqli_query($conn, "INSERT INTO schedule_user1 VALUES(NULL, '$user_id', '$req_id', '$sched')");
mysqli_query($conn, "DELETE FROM schedule_user WHERE req_id = '$req_id'");
header("Location: ../hyperlinks/pending.php");
?>
