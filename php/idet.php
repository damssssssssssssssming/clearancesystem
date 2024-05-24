<?php
session_start();
require("connection.php");
$user_id = $_SESSION['user_id'];
$full_name = $_POST['full_name']; 
$bert = $_POST['bert'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$civil = $_POST['civil'];
$email = $_POST['email'];
$contact = $_POST['contact']; 
$address = $_POST['address'];
if(isset($_FILES['asd'])) {
    $fileName = $_FILES['asd']['name'];
    $tmpName = $_FILES['asd']['tmp_name'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
    $newImageName = uniqid();
    $newImageName .= '.' . $imageExtension;
    move_uploaded_file($tmpName, '../imagess/' . $newImageName);
    $send = "UPDATE infos SET image = '$newImageName' WHERE user_id = '$user_id'";
    $sended = mysqli_query($conn, $send);
}
$kweri = "UPDATE infos 
        SET full_name = '$full_name', 
        bert = '$bert',
        age = '$age',
        sex = '$sex',
        civil = '$civil',
        email = '$email',
        contact = '$contact', 
        address = '$address'
        WHERE user_id = '$user_id';";
$kweried = mysqli_query($conn, $kweri);
$kweri = "SELECT * FROM infos WHERE user_id = '$user_id'";
        $kweried = mysqli_query($conn, $kweri);
        $kwerieded = $kweried->fetch_assoc();
        $name = $kwerieded['full_name'];
        mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$name', 'Edited their profile information(s)')");
header("Location: ../hyperlinks/profile.php");
?>