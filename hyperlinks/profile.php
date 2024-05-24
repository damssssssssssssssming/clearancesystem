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
$kweri1 = "SELECT * FROM pdf_table WHERE user_id = '$user_id'";
$kweried1 = mysqli_query($conn, $kweri1);
$kweri2 = "SELECT * FROM in_proc WHERE user_id = '$user_id'";
$kweried2 = mysqli_query($conn, $kweri2);
$kweri3 = "SELECT * FROM completed WHERE user_id = '$user_id'";
$kweried3 = mysqli_query($conn, $kweri3);
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
                    <img src="../imagess/<?php echo $kwerieded['image'] ?>" alt="" style="height: 200px; width: 200px; border-radius: 50%; object-fit: cover;">
                    <br>
                    <br>
                    <p class="inpotss"><?php echo $kwerieded['full_name'] ?></p>
                    <p class="inpotss"><?php echo $kwerieded['bert'] ?></p>
                    <p class="inpotss"><?php echo $kwerieded['age'] ?></p>
                    <p class="inpotss"><?php echo $kwerieded['sex'] ?></p>
                    <p class="inpotss"><?php echo $kwerieded['civil'] ?></p>
                    <p class="inpotss"><?php echo $kwerieded['email'] ?></p>
                    <p class="inpotss"><?php echo $kwerieded['contact'] ?></p>
                    <p class="inpotss" style="height: 120px;"><?php echo $kwerieded['address'] ?></p>
                    <div style="display: flex; justify-content: space-around;">
                        <button class="button" onclick="edit()">Edit Profile</button>
                        <form action="../php/logout.php">
                            <input type="submit" class="button" value="Logout">
                        </form>
                    </div>
                    <br>
                    <br>
                </center>
            </div>
            <div class="wayt">
                <br>
                <br>
                <br>
                <br>
                <h1 style="margin-left: 10px;">Pending Requests</h1>
                <table class="tibol1" border="5">
                <tr>
                    <th>Type of Application</th>
                    <th>Requested on:</th>
                    <th>Status</th>
                </tr>
                <?php while ($kwerieded1 = $kweried1->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $kwerieded1['typee'] ?></td>
                    <td><?php echo $kwerieded1['reqTime'] ?></td>
                    <td style="background-color: #FFCFA4;"><?php echo $kwerieded1['statuss'] ?></td>
                </tr>
                <?php endwhile; ?>
                <?php while ($kwerieded2 = $kweried2->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $kwerieded2['typee'] ?></td>
                    <td><?php echo $kwerieded2['reqTime'] ?></td>
                    <td style="background-color: #FFCFA4;"><?php echo $kwerieded2['statuss'] ?></td>
                </tr>
                <?php endwhile; ?>
                <?php while ($kwerieded3 = $kweried3->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $kwerieded3['typee'] ?></td>
                    <td><?php echo $kwerieded3['reqTime'] ?></td>
                    <td style="background-color: #FFCFA4;"><?php echo $kwerieded3['statuss'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
            </div>
        </div>
        <script src="../javascript/login.js"></script>
    </body>
</html>