<?php
$id = $_POST['h'];
$id = $_POST['h'];
require("connection.php");
$kweri = "SELECT * FROM rquirements WHERE request_id = '$id'";
$kweried = mysqli_query($conn, $kweri);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/dashboard.css">
        <title>Document</title>
    </head>
    <body>
        <center>
            <h1>Download Requirements</h1>
            <table class="tibol" border="5">
                <tr>
                    <th>Name of Requirement</th>
                    <th>Action</th>
                </tr>
                <form action="../php/download.php" method="post">
                    <input id="pdfInput2" name="h" style="display: none">
                    <input id="pdfSubmit2" type="submit" style="display: none">
                </form>
                <?php while ($kwerieded = $kweried->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $kwerieded['name_of_req'] ?></td>
                    <td><button style="background-color: lightblue; width: 100%; height: 40px; font-size: 25px;" onclick="downloadImgg(<?php echo $kwerieded['id'] ?>) ">Download</button></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </center>
        <script src="../javascript/login.js"></script>
    </body>
</html>