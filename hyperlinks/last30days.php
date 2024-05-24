<?php
require("../php/connection.php");
$nom = mysqli_query($conn, "SELECT * FROM admin_numm WHERE opened = 'Unchecked'");
$number1 = mysqli_num_rows($nom);
$currentDate = date("Y-m-d");
$nom1 = mysqli_query($conn, "SELECT * FROM loginCount 
INNER JOIN requestCount ON loginCount.created_at = requestCount.created_at
INNER JOIN completedCount ON requestCount.created_at = completedCount.created_at 
ORDER BY completedCount.created_at DESC, requestCount.created_at DESC, loginCount.created_at DESC");
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
            <br>
            <br>
            <br>
          <br>
          <br>
          <?php while ($number2 = $nom1->fetch_assoc()): ?>
          <div class="stats">
            <h1><?php echo $number2['created_at'] ?></h1>
            <div class="stats1">
              <div class="requests">
                <p class="zeroMargin">Submitted Requests Today</p>
                <h1 class="zeroMargin"><?php echo $number2['reqCount'] ?></h1>
              </div>
              <div class="requests">
                <p class="zeroMargin">User Logins Today</p>
                <h1 class="zeroMargin"><?php echo $number2['logCount'] ?></h1>
              </div>
              <div class="requests">
                <p class="zeroMargin">Completed Requests Today</p>
                <h1 class="zeroMargin"><?php echo $number2['comCount'] ?></h1>
              </div>
            </div>
            <br>
            <?php endwhile; ?>
            <script src="../javascript/login.js">
        </script>
          </center>
          </body>
          </html>