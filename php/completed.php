<?php 
require("connection.php");
$req_id = $_POST['h'];
$user_id = $_POST['h1'];

$kweri = "UPDATE completed SET statuss = 'Completed' WHERE req_id = '$req_id'";
$kweried = mysqli_query($conn, $kweri);
$kweri1 = "SELECT * FROM completed WHERE req_id = '$req_id' AND user_id = '$user_id'";
$kweried1 = mysqli_query($conn, $kweri1);
$kwerieded1 = $kweried1->fetch_assoc();

$name = $kwerieded1['namee'];
session_start();
$admin_id = $_SESSION['admin_id'];
mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$admin_id', DEFAULT, 'Admin', 'Marked completed $name'" . "'s request form')"); 
                $currentDate = date("Y-m-d");
                $kweriii = mysqli_query($conn, "SELECT * FROM completedCount WHERE created_at = '$currentDate'");
                
                if(mysqli_num_rows($kweriii) > 0) {
                    $completedCount = $kweriii->fetch_assoc();
                    $addddd = $completedCount['comCount'] + 1;
                    mysqli_query($conn, "UPDATE completedCount SET comCount = '$addddd' WHERE created_at = '$currentDate'");
                } else {
                    mysqli_query($conn, "INSERT INTO completedCount (comCount, created_at) VALUES (1, CURDATE())");
                }
header("Location: ../hyperlinks/completed.php");
?>