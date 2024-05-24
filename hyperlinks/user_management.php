<?php
require("../php/connection.php");
session_start();
require("../php/connection.php");
if(!isset($_SESSION['admin_id'])) {
  header("Location: ../index.php");
  exit();
}
$kweri = "SELECT * FROM audit ORDER BY created_at DESC";
$kweried = mysqli_query($conn, $kweri);
$nom = mysqli_query($conn, "SELECT * FROM admin_numm WHERE opened = 'Unchecked'");
$number1 = mysqli_num_rows($nom);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link rel="stylesheet" href="../css/dashboard.css">
        <title>Admin Dashboard</title>
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
        <br>
        <br>
        <br>
        <h1 style="position: relative; right: -20px;">User Management</h1>
        <center>
            <br>
            <br>
            <button class="dropbtn5" onclick="userm()">Users</button>
            <br>
            <br>
            <center>
                <a class="dropbtn5" style="padding: 10px 30px; text-decoration: none;" href="deleted_users.php">Deleted User Accounts</a>
            </center>
            <br>
            <table class="tibol3" border="5">
                <tr>
                    <th>User ID</th>
                    <th>Date and time the action was made</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php while ($kwerieded = $kweried->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $kwerieded['user_id'] ?></td>
                    <td><?php echo $kwerieded['created_at'] ?></td>
                    <td><?php echo $kwerieded['namee'] ?></td>
                    <td><?php echo $kwerieded['actionn'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </center>
        <script src="../javascript/login.js"></script>
    </body>
</html>