<?php
require("../php/connection.php");
session_start();
require("../php/connection.php");
if(!isset($_SESSION['admin_id'])) {
  header("Location: ../index.php");
  exit();
}
$kweri = "SELECT * FROM completed";
$kweried = mysqli_query($conn, $kweri);
if(isset($_GET['submit'])) {
    $user_id = $_GET['search'];
    $kweri = "SELECT * FROM completed WHERE transactionNum = '$user_id'";
    $kweried = mysqli_query($conn, $kweri);
}
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
        <center>
        <br>
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
  left: 1175px; 
  background-color: red; 
  color: white; 
  font-size: 12px; 
  padding: 5px; 
  border-radius: 50%; 
  z-index: 1; "><?php echo $number1 ?></span> <!-- Overlay text -->
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <center>
            <form action="completed.php" method="get">
                <input placeholder="Transaction Number" name="search" id="search" class="search">
                <input type="submit" style="font-size: 20px;" value="Seach" name="submit">
            </form>
            </center>
            <br>
            <table class="tibol2" border="5">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Date Accepted</th>
                    <th>Schedule for Pick Up</th>
                    <th>Status</th>
                    <th>Transaction Number</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php while ($kwerieded = $kweried->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $kwerieded['user_id'] ?></td>
                    <td><?php echo $kwerieded['namee'] ?></td>
                    <td><?php echo $kwerieded['typee'] ?></td>
                    <td><?php echo $kwerieded['reqTime'] ?></td>
                    <td><?php echo $kwerieded['schedulee'] ?></td>
                    <td><?php echo $kwerieded['statuss'] ?></td>
                    <td><?php echo $kwerieded['transactionNum'] ?></td>
                    <td><button class="pen" style="background-color: lightblue; width: 100%; height: 40px; font-size: 14px;" onclick="completee(<?php echo $kwerieded['req_id'] ?> ); complete1(<?php echo $kwerieded['user_id'] ?> );">Mark as Completed</button></td>
                    <td><button class="pen" style="background-color: red; width: 100%; height: 40px; font-size: 14px;" onclick="deletee(<?php echo $kwerieded['req_id'] ?> ); deletee1(<?php echo $kwerieded['user_id'] ?> );">Delete</button></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </center>
        <form action="../php/completed.php" method="post">
            <input id="pdfInput5" name="h" style="display: none">
            <input id="pdfInput51" name="h1" style="display: none">
            <input id="complete" type="submit" style="display: none">
        </form>
        <form action="../php/delete.php" method="post">
            <input id="pdfInput6" name="h" style="display: none">
            <input id="pdfInput61" name="h1" style="display: none">
            <input id="delete" type="submit" style="display: none">
        </form>
        <script src="../javascript/login.js"></script>
    </body>
</html>