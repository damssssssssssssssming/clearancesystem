<?php
session_start();
require('connection.php');
$email = $_POST['email'];
$password = $_POST['pass'];
$acc = "SELECT * FROM userr WHERE email = '$email'";
$sqlAcc = mysqli_query($conn, $acc);
$user = $sqlAcc->fetch_assoc();
$acc1 = "SELECT * FROM adminn WHERE id_num = '$email'";
$sqlAcc1 = mysqli_query($conn, $acc1);
$user1 = $sqlAcc1->fetch_assoc();
$user_id = $user['id'];
$admin_id = $user['id'];
if($sqlAcc->num_rows == 1) {
    if($password == $user['passwordd']) {
        $_SESSION['user_id'] = $user['id'];
        $kweri = "SELECT * FROM infos WHERE user_id = '$user_id'";
        $kweried = mysqli_query($conn, $kweri);
        $kwerieded = $kweried->fetch_assoc();
        $name = $kwerieded['full_name'];
        mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$name', 'Logged In')");
        mysqli_query($conn, "DELETE FROM audit WHERE created_at < NOW() - INTERVAL 3 DAY");
        header("Location: ../hyperlinks/dashboard.php");
    }
}
elseif ($sqlAcc1->num_rows == 1) {
    if($password == $user1['passwordd']) {
        $_SESSION['admin_id'] = $user1['id'];
        mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$admin_id', DEFAULT, 'Admin', 'Logged In')");
        header("Location: ../hyperlinks/admin_dashboard.php");
    }
}
else {
    header("Location: ../index.php");
    exit();
}
?>