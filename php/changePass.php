<?php
session_start();
$email = $_SESSION['email'];
require("connection.php");
$verify = $_POST['verify'];
$pass = $_POST['pass'];
$repass = $_POST['repass'];
$kweried = mysqli_query($conn, "DELETE FROM verify WHERE created_at < NOW() - INTERVAL 5 MINUTE");
if($pass == $repass) {
    $kweri = "SELECT * FROM verify WHERE verif = '$verify'";
    $kweried = mysqli_query($conn, $kweri);
    if ($kweried !== false && $kweried->num_rows > 0) {
        $kwerieded = $kweried->fetch_assoc();
        $user_id = $kwerieded['user_id'];
        $verify1 = $kwerieded['verif'];
        $kweried2 = mysqli_query($conn, "SELECT full_name FROM infos WHERE user_id = '$user_id'");
        $kwerieded1 = $kweried2->fetch_assoc();
        $name = $kwerieded1['full_name'];
        if($verify == $verify1) {
            $update_query = "UPDATE userr SET passwordd = '$pass' WHERE id = '$user_id'";
            if (mysqli_query($conn, $update_query)) {
                mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$name', 'Changed their password in forgot password page')");
                session_unset();
                session_destroy();
                header("Location: ../index.php");
                exit();
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }
        } else {
            echo "<link rel='stylesheet' href='../css/dashboard.css'><center><h1>Wrong verification code!</h1></center><center>
    <a class='dropbtn5' style='padding: 10px 30px; text-decoration: none;'' href='javascript:history.go(-1)'>Go Back</a>
</center>";
        }
    } else {
        echo "<link rel='stylesheet' href='../css/dashboard.css'><center><h1>No matching verification code found!</h1></center><center>
    <a class='dropbtn5' style='padding: 10px 30px; text-decoration: none;'' href='javascript:history.go(-1)'>Go Back</a>
</center>";
    }
} else {
    echo "<link rel='stylesheet' href='../css/dashboard.css'><center><h1>Password do not match!</h1></center><center>
    <a class='dropbtn5' style='padding: 10px 30px; text-decoration: none;'' href='javascript:history.go(-1)'>Go Back</a>
</center>";
}
?>
