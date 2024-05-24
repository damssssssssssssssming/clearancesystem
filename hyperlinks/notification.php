<?php
session_start();
require("../php/connection.php");
$session_timeout = 900;
if(isset($_SESSION['user_id'])) {
    if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $session_timeout) {
        session_unset();
        session_destroy();
        header("Location: session.html");
        exit();
    } else {
        $_SESSION['last_activity'] = time();
    }
} else {
    header("Location: session.html");
    exit();
}
$user_id = $_SESSION['user_id'];
$kweri = "SELECT * FROM notification WHERE user_id = '$user_id' ORDER BY id DESC";
$kweried = mysqli_query($conn, $kweri);
mysqli_query($conn, "UPDATE numm SET opened = 'Checked' WHERE user_id = '$user_id'");
$nom = mysqli_query($conn, "SELECT * FROM numm WHERE user_id = '$user_id' AND opened = 'Unchecked'");
$number1 = mysqli_num_rows($nom);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/dashboard.css">
        <title>Document</title>
    </head>
    <body style="background-color:white; background-size: 101%; margin: 0 0 0 0; padding: 0 0 0 0; background-repeat: no-repeat; overflow-x: hidden;">
    <center>
    <br>
            <div id="dash">
            <div class="q1">
                    <img src="../images/new_icon.png" alt="" id="icon">
                </div>
                <div class="q3">
                    <button class="dropbtn" onclick="dashboard()">Home</button>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Certificates</button>
                    <div class="dropdown-content" style="position: absolute; width: 162px;">
                        <a href="Scedula.php">Cedula</a>
                        <a href="Sclearance.php">Clearance</a>
                        <a href="Sbusiness.php">Business Permit</a>
                        <a href="Scertfi.php">Other Certificates</a>
                    </div>
                </div>
                <div class="dropdown1">
                    <button class="dropbtn" onclick="indigency()">Indigency</button>
                </div>
                <div class="q2" style="position: relative;">
                    <img src="../images/bell1.png" alt="" class="imahe" style="border-style: none;" onclick="notif()">
                    <span class="notification-badge"><?php echo $number1 ?></span> <!-- Overlay text -->
                    <img src="../images/humanoid.png" alt="" class="imahe" onclick="profile()">
                </div>
            </div>
</center>
        <br>
        <br>
        <br>
        <h1 style="position: relative; right: -20px;">Notifications</h1>
        <center>
        <?php while ($kwerieded = $kweried->fetch_assoc()): ?>
            <p style="font-size: 25px; width: 80%; background-color: #F4F4F4; padding-left: 10px; padding-right: 10px;"><?php echo $kwerieded['notif'] ?></p>
            <hr style="height:2px;border-width:0; width: 80%; color:white;background-color: #F4F4F4">
        <?php endwhile; ?>
        </center>
        <script src="../javascript/login.js"></script>
    </body>
</html>
