<?php
require("../php/connection.php");
session_start();
require("../php/connection.php");
if(!isset($_SESSION['admin_id'])) {
  header("Location: ../index.php");
  exit();
}
$kweri = "SELECT * FROM pdf_table RIGHT JOIN schedule_user 
ON pdf_table.id = schedule_user.req_id AND pdf_table.user_id = schedule_user.user_id";
$kweried = mysqli_query($conn, $kweri);
$kweri1 = "SELECT * FROM rquirements";
$kweried1 = mysqli_query($conn, $kweri1);
$kwerieded1 = $kweried1->fetch_assoc();
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
            <table class="tibol" border="5">
                <tr>
                    <th>ID</th>
                    <th>Requested By</th>
                    <th>Type of Application</th>
                    <th>Requested on:</th>
                    <th>Schedule by User</th>
                    <th>Status</th>
                    <th colspan="4">Action</th>
                </tr>
                <form action="../php/downloadPDF.php" method="post">
                    <input id="pdfInput" name="h" style="display: none">
                    <input id="pdfInput111" name="h1" style="display: none">
                    <input id="pdfSubmit" type="submit" style="display: none">
                </form>
                <form action="../php/downloadImages.php" method="post">
                    <input id="pdfInput1" name="h" style="display: none">
                    <input id="pdfInput11" name="h1" style="display: none">
                    <input id="pdfSubmit1" type="submit" style="display: none">
                </form>
                <form action="../php/accept.php" method="post">
                    <input id="pdfInput3" name="h" style="display: none">
                    <input id="pdfInput31" name="h1" style="display: none">
                    <input id="accept" type="submit" style="display: none">
                </form>
                <form action="../php/decline.php" method="post" name="decline1" id="decline">
                    <input id="pdfInput4" name="h" style="display: none">
                    <input id="pdfInput41" name="h1" style="display: none">
                    <input id="decline" type="submit" style="display: none">
                </form>
                <?php while ($kwerieded = $kweried->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $kwerieded['user_id'] ?></td>
                    <td><?php echo $kwerieded['namee'] ?></td>
                    <td><?php echo $kwerieded['typee'] ?></td>
                    <td><?php echo $kwerieded['reqTime'] ?></td>
                    <td><?php echo $kwerieded['sched'] ?></td>
                    <td style="background-color: #FFCFA4;"><?php echo $kwerieded['statuss'] ?></td>
                    <td><button class="pen" style="background-color: lightblue; width: 100%; height: 40px; font-size: 14px;" onclick="downloadPDF(<?php echo $kwerieded['id'] ?>) ">Download PDF</button></td>
                    <td><button class="pen" style="background-color: lightblue; width: 100%; height: 40px; font-size: 14px;" onclick="downloadImg(<?php echo $kwerieded['id'] ?>) ">Download images</button></td>
                    <td><button class="pen" style="background-color: #71F236; width: 100%; height: 40px; font-size: 14px;" onclick="accept(<?php echo $kwerieded['id'] ?> ); accept1(<?php echo $kwerieded['user_id'] ?> );">Accept</button></td>
                    <td><button class="pen" style="background-color: #FD3939; width: 100%; height: 40px; font-size: 14px;" onclick="popup()">Decline</button></td>
                </tr>
                <div class="popup" id="popup">
                    <div class="popup-content">
                    <button onclick="closeee()" class="close" id="close-popup">&times;</button>
                    <h2>Are you sure? </h2>
                        <button onclick="handleConfirmation()">Confirm</button>
                        <script>
    function handleConfirmation() {
        var id = <?php echo $kwerieded['id'] ?>;
        var userId = <?php echo $kwerieded['user_id'] ?>;
        decline(id);
        decline1(userId);
    }

    function decline(id) {
        document.getElementById("pdfInput4").value = id;
    }

    function decline1(id) {
        document.getElementById("pdfInput41").value = id;
        document.getElementById("declineForm").submit();
    }
</script>
                    </div>
                </div>
                <?php endwhile; ?>
            </table>
        </center>
        <script src="../javascript/login.js">
        </script>
    </body>
</html>