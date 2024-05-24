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
$kweri = "SELECT * FROM infos WHERE user_id = '$user_id'";
$kweried = mysqli_query($conn, $kweri);
$kwerieded = $kweried->fetch_assoc();
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
        <div class="pol_konteyner">
            <div class="greeyy">
                <p></p>
            </div>
            <div class="wayt">
            </div>
        </div>
        <center>
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
        <div class="pol_konteyner">
            <div class="greeyy">
                <br>
                <br>
                <br>
                <br>
                <h1 style="margin-left: 10px;">User Profile</h1>
                <center>
                    <form action="../php/idet.php" method="post" enctype="multipart/form-data">
                        <img id="image" src="../imagess/<?php echo $kwerieded['image'] ?>" alt="" style="height: 200px; width: 200px; border-radius: 50%; object-fit: cover;" onclick="clek()">   
                        <input name="el" style="display: none" value="<?php echo $kwerieded['image'] ?>"> 
                        <input type="file" name="asd" id="fileInput" style="display: none;" onchange="uploadFile(event)">
                        <br>
                        <br>
                        <input name="full_name" placeholder="Full Name:" class="inpotss" value="<?php echo $kwerieded['full_name'] ?>">
                        <br>
                        <br>
                        <input name="bert" placeholder="Date of Birth:" class="inpotss" value="<?php echo $kwerieded['bert'] ?>">
                        <br>
                        <br>
                        <input name="age" placeholder="Age:" class="inpotss" value="<?php echo $kwerieded['age'] ?>">
                        <br>
                        <br>
                        <input name="sex" placeholder="Sex:" class="inpotss" value="<?php echo $kwerieded['sex'] ?>">
                        <br>
                        <br>
                        <input name="civil" placeholder="Civil Status:" class="inpotss" value="<?php echo $kwerieded['civil'] ?>">
                        <br>
                        <br>
                        <input name="email" placeholder="Email Address:" class="inpotss" value="<?php echo $kwerieded['email'] ?>">
                        <br>
                        <br>
                        <input name="contact" placeholder="Contact Number:" class="inpotss" value="<?php echo $kwerieded['contact'] ?>">
                        <br>
                        <br>
                        <input name="address" placeholder="Address:" class="inpotss" value="<?php echo $kwerieded['address'] ?>">
                        <br>
                        <br>
                    <div style="display: flex; justify-content: space-around;">
                                <input type="submit" value="Confirm" name="submit" class="button">
                            </form>
                        <button class="button" onclick="profile()">Cancel</button>
                        <br>
                        <br>
                        <br>
                         <br>
                    </div>
                </center>
            </div>
            <div class="wayt">
                <br>
                <br>
                <br>
                <br>
                <h1 style="margin-left: 10px;">Pending Requests</h1>
            </div>
        </div>
        <script src="../javascript/login.js">
        </script>
    </body>
</html>