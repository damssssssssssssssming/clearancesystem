<?php
require("connection.php");
$full_name = $_POST['full_name'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$civil = $_POST['civil'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$bert = $_POST['bert'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$repass = $_POST['repass'];
$bert1 = date('Y-m-d', strtotime($bert));
$name1 = mysqli_query($conn, "SELECT * FROM residents WHERE namee = '$full_name'");
if($name1->num_rows >= 1) {
    if($pass == $repass) {
        $kweri = "INSERT INTO userr VALUES(NULL, '$email', '$pass')";
        $kweried = mysqli_query($conn, $kweri);
        $kweri1 = "SELECT * FROM userr WHERE email = '$email'";
        $kweried1 = mysqli_query($conn, $kweri1);
        $kwerieded = $kweried1->fetch_assoc();
        $user_id = $kwerieded['id'];
        mysqli_query($conn, "INSERT INTO infos VALUES(NULL, '$user_id', '$full_name', '$bert1', '$age', '$sex', '$civil', '$email', '$contact', '$address', '6620d0348affa.png')");
        mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$name', 'Created an account')");
        header("Location: ../index.php");
        exit();
    }
    else {
        echo "<link rel='stylesheet' href='../css/dashboard.css'><center><h1>Password does not match!</h1></center><center>
        <a class='dropbtn5' style='padding: 10px 30px; text-decoration: none;'' href='javascript:history.go(-1)'>Go Back</a>
    </center>";
    }
}
else {
    echo "<link rel='stylesheet' href='../css/dashboard.css'><center><h1>You are not from this Barangay.</h1><p>If you think this is a mistake, check if the format of your name is correct.</p></center><center>
        <a class='dropbtn5' style='padding: 10px 30px; text-decoration: none;'' href='javascript:history.go(-1)'>Go Back</a>
        </center>";
}
?>