<?php
require("connection.php");
$req_id = $_POST['h'];
$user_id = $_POST['h1'];
$schedul = $_POST['schedule'];
$payment = $_POST['payment'];

$schedule = date('Y-m-d', strtotime($schedul));
$transac = rand(00000, 99999);

$kwer = "SELECT * FROM in_proc WHERE user_id = '$user_id' AND req_id = '$req_id'";
$kwerd = mysqli_query($conn, $kwer);
$kwerdd = $kwerd->fetch_assoc();

$name = $kwerdd['namee'];
$type = $kwerdd['typee'];

$kweri = "INSERT INTO completed VALUES(NULL, '$user_id', '$req_id', '$name', '$type', CURDATE(), 'For pick up', '$schedule', '$transac')";
$kweried = mysqli_query($conn, $kweri);

$kweri1 = "DELETE FROM in_proc WHERE req_id = '$req_id'";
$kweri2 = "INSERT INTO notification VALUES(NULL, 
'$user_id', 
'$req_id',
'Your $type can be received at Barangay Hall at $schedule. Your transaction is #$transac";

if(!empty($_POST['payment'])) {
    $kweri2 .= ", kindly screenshot your transaction number. Please bring $payment pesos for payment and the requirements you uploaded when answering the form')";
    session_start();
$admin_id = $_SESSION['admin_id'];
mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$admin_id', DEFAULT, 'Admin', 'Added schedule and payment for $name'" . "'s request form')");
mysqli_query($conn, "INSERT INTO numm VALUES(NULL, '$user_id', '$req_id', 'Unchecked')");
} else {
    session_start();
$admin_id = $_SESSION['admin_id'];
mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$admin_id', DEFAULT, 'Admin', 'Added schedule for $name'" . "'s request form')");
    $kweri2 .= ", kindly screenshot your transaction number. Please bring the requirements you uploaded when answering the form')";
    mysqli_query($conn, "INSERT INTO numm VALUES(NULL, '$user_id', '$req_id', 'Unchecked')");
}
$kweried = mysqli_query($conn, $kweri1);
$kweried = mysqli_query($conn, $kweri2);
mysqli_query($conn, "DELETE FROM schedule_user1 WHERE req_id = '$req_id'");
header("Location: ../hyperlinks/in_proc.php");
?>