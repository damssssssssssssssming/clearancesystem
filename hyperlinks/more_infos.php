<?php
require("../php/connection.php");
session_start();
require("../php/connection.php");
if(!isset($_SESSION['admin_id'])) {
  header("Location: ../index.php");
  exit();
}
$user_id = $_POST['user_id'];
$kweri = "SELECT * FROM infos WHERE user_id = '$user_id'";
$kweried = mysqli_query($conn, $kweri);
$kwerieded = $kweried->fetch_assoc();
$kweri1 = "SELECT * FROM pdf_table WHERE user_id = '$user_id'";
$kweried1 = mysqli_query($conn, $kweri1);
$kweri2 = "SELECT * FROM in_proc WHERE user_id = '$user_id'";
$kweried2 = mysqli_query($conn, $kweri2);
$kweri3 = "SELECT * FROM completed WHERE user_id = '$user_id'";
$kweried3 = mysqli_query($conn, $kweri3);
$nom = mysqli_query($conn, "SELECT * FROM admin_numm WHERE opened = 'Unchecked'");
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
                <div class="hati">
                <div class="q11">
                  <img src="../images/new_icon.png" alt="" id="icon">
                </div>
                <div class="q31">
                    <button class="dropbtn" onclick="admin_dashboard()">Home</button>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Request</button>
                    <div class="dropdown-content" style="position: absolute; width: 162px;">
                        <a href="pending.php">Pending Requests</a>
                        <a href="in_proc.php">In Processing</a>
                        <a href="completed.php">Completed</a>
                    </div>
                  </div>
                </div>
                <div class="dropdown1" style="width: 20%;">
                  <button class="dropbtn" onclick="usermanage()" style="width: 100%;">User Management</button>
                </div>
                <div class="q21">
                  <img src="../images/bell1.png" alt="" class="imahe" style="border-style: none;" onclick="anotif()">
                  <span class="notification-badge1" style="position: absolute;
  top: -5px; 
  left: 1160px; 
  background-color: red; 
  color: white; 
  font-size: 12px; 
  padding: 5px; 
  border-radius: 50%; 
  z-index: 1; "><?php echo $number1 ?></span> <!-- Overlay text -->
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
        <br>
        <center>
            <a class="dropbtn5" style="padding: 10px 30px; text-decoration: none;" href="users.php">Go Back</a>
        </center>
        <br>
        <br>
        <script src="../javascript/login.js"></script>
    </body>
</html>