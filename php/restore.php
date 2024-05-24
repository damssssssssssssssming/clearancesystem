<?php
require("connection.php");
$user_id = $_POST['id'];
$user = mysqli_query($conn, "SELECT * FROM deleted_user WHERE id = '$user_id'");
$user1 = mysqli_query($conn, "SELECT * FROM deleted_infos WHERE user_id = '$user_id'");
$user2 = $user->fetch_assoc();
$user3 = $user1->fetch_assoc();
$email = $user2['email'];
$password = $user2['passwordd'];
$one = mysqli_query($conn, "INSERT INTO userr VALUES('$user_id', '$email', '$password')");
$name = $user3['full_name'];
$bert = $user3['bert'];
$age = $user3['age'];
$sex = $user3['sex'];
$civil = $user3['civil'];
$contact = $user3['contact'];
$address = $user3['address'];
$image = $user3['image'];
$two = mysqli_query($conn, "INSERT INTO infos VALUES(NULL, '$user_id', '$name', '$bert', '$age', '$sex', '$civil', '$email', '$contact', '$address', '$image')");
if($one && $two) {
    session_start();
    $admin_id = $_SESSION['admin_id'];
    mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$admin_id', DEFAULT, 'Admin', 'Restored $name'" . "'s account')");
    mysqli_query($conn, "DELETE FROM deleted_user WHERE id = '$user_id'");
    mysqli_query($conn, "DELETE FROM deleted_infos WHERE user_id = '$user_id'");
}
header("Location: ../hyperlinks/users.php");
?>