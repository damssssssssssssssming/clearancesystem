<?php
require("connection.php");
$name = $_POST['name'];
$kweri = "DELETE FROM images WHERE image_name = '$name'";
$kweried = mysqli_query($conn, $kweri);
header("Location: ../hyperlinks/admin_dashboard.php");
?>