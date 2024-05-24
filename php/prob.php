<?php
require("connection.php");
$id = $_POST['id'];
$prob = $_POST['prob'];
$kweri = "INSERT INTO admin_notif VALUES(NULL, '$id', '0', 'A user reported a problem. Problem: $prob', DEFAULT)";
mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
mysqli_query($conn, $kweri);
header("Location: ../hyperlinks/dashboard.php");
?>