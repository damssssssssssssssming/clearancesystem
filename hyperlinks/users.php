<?php
require("../php/connection.php");
session_start();
require("../php/connection.php");
if(!isset($_SESSION['admin_id'])) {
  header("Location: ../index.php");
  exit();
}
$kweri = "SELECT * FROM userr RIGHT JOIN infos ON userr.id = infos.user_id ORDER BY infos.user_id DESC";
$kweried = mysqli_query($conn, $kweri);
if(isset($_GET['submit'])) {
    $user_id = $_GET['search'];
    $kweri = "SELECT * FROM userr RIGHT JOIN infos ON userr.id = infos.user_id WHERE userr.id = $user_id";
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
        <h1 style="position: relative; right: -20px;">Users</h1>
        <br>
        <center>
            <form action="users.php" method="get">
                <input placeholder="User ID" name="search" id="search" class="search">
                <input type="submit" style="font-size: 20px;" value="Seach" name="submit">
            </form>
        </center>
        <br>
        <?php while ($kwerieded = $kweried->fetch_assoc()): ?>
            <div class="poool">
                <div class="poool1">
                    <div class="poool2">
                        <img src="../imagess/<?php echo $kwerieded['image'] ?>" style="height: 150px; width: 150px; border-radius: 50%; object-fit: cover;">
                    </div>
                    <div class="poool3">
                        <h1>Name: <?php echo $kwerieded['full_name'] ?></h1>
                        <h2>User ID: <?php echo $kwerieded['user_id'] ?></h2>
                    </div>
                </div>
                <form action="more_infos.php" method="post">
                <div class="poool4">
                        <input name="user_id" value="<?php echo $kwerieded['user_id'] ?>" style="display: none;">
                        <input type="submit" style="width: 100%; height: 100%; font-size: 20px;" value="See More Information">
                    </form>
                </div>
                <div class="poool4">
                    <input name="user_id" value="<?php echo $kwerieded['user_id'] ?>" type="hidden">
                    <input type="button" onclick="popup1(<?php echo $kwerieded['user_id'] ?>)" style="width: 100%; height: 100%; font-size: 20px; background-color: #FD3939; text-align: center;" value="Delete this User's Account">
                </div>
            </div>
            <br>
            <?php endwhile; ?>
            <div class="popup" id="popup">
                    <div class="popup-content">
                    <button onclick="closeee()" type="button" class="close" id="close-popup">&times;</button>
                    <form action="../php/delete_user.php" method="post">
                    <h2>Are you sure you want to delete this User's account?: </h2>
                        <input style="display: none" id="hello" name="id" required>
                        <button type="submit">Confirm</button>
            </div>
        </div>
        </form>
            <br>
            <br>
        <center>
            <a class="dropbtn5" style="padding: 10px 30px; text-decoration: none;" href="user_management.php">Go Back</a>
        </center>
        <br>
        <br>
        <script src="../javascript/login.js"></script>
    </body>
</html>