<?php
require("connection.php");
session_start();
$user_id = $_SESSION['user_id'];
session_unset();
session_destroy();
$kweri = "SELECT * FROM infos WHERE user_id = '$user_id'";
        $kweried = mysqli_query($conn, $kweri);
        $kwerieded = $kweried->fetch_assoc();
        $name = $kwerieded['full_name'];
        mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$name', 'Logged out')");
header("Location: ../index.php");
exit();
?>