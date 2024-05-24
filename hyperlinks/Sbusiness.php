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
$currentDate = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/dashboard.css">
        <title>s</title>
    </head>
    <body style="background: linear-gradient(#56C596, #CFF4D2); background-repeat: no-repeat; background-attachment: fixed;">
        <center>
            <div id="deva">
                <div class="deva1">
                        <br>
                        <br>
                        <h1 class="blo">Request for Securing/Business Permit</h1>
                    <form action="../library/bus.php" method="post" enctype="multipart/form-data">
                        <br>
                        <br>
                        <span class="pann" style="position:absolute; left:350px;">
                        <input type="checkbox" id="checkbox1" name="business"><b>Business Permit</b>
                           </span>
                    <div style="display: flex;">
                        <span class="pann" style="margin-left: 400px;">Date:</span>
                        <input required  name="date" class="pann" style="width: 32%;" value="<?php echo $currentDate ?>" required>
                    </div>
                        <br>
                        <span class="pann" style=" position: absolute;left:350px;">  
                        <input type="checkbox" id="checkbox2" name="securing"><b>Securing Business Permit</b></span>
                        <br>
                        <h3>Owner Details</h3>
                    <div style="display: flex;">
                        <label for="name" class="pann" style="margin-right:1px ;">Name:</label>
                        <input required name="name" id="name" class="pann" style="width: 100%;" value="<?php echo $kwerieded['full_name'] ?>" required>
                    </div>
                        <br>
                    <div style="display: flex;">
                        <span class="pann" style="margin-right: 1px;">Address:</span>
                        <input required name="address" class="pann" style="width: 100%;" value="<?php echo $kwerieded['address'] ?>" required>
                    </div>
                        <br>
                    <div style="display: flex;">    
                        <span class="pann" style="margin-right: 1px;">Age:</span>
                        <input required name="age" class="pann" style="width: 100%;" value="<?php echo $kwerieded['age'] ?>" required>
                    </div>
                        <br>
                    <div style="display: flex;">
                        <span class="pann" style="margin-right: 1px;">Contact number:</span>
                        <input required name="contact" class="pann" style="width: 77%;" value="<?php echo $kwerieded['contact'] ?>" required>
                    </div>
                    
                        <h3>Business Details</h3>
                    <div style="display: flex;">
                        <span class="pann" style="margin-right: 1px;">Store Name:</span>
                        <input required  name="store" class="pann" style="width: 82%;" required>
                    </div>
                        <br>
                    <div style="display: flex;">
                        <span class="pann" style="margin-right:1px;">Address:</span>
                        <input required name="add" class="pann" style="width: 100%;" required>
                    </div>
                    <br>
                    <div style="display: flex;">
                        <span class="pann" style="margin-right: 1px;"> Types of Business:</span>
                        <input required  name="type" class="pann" style="width: 74%;" required>
                    </div>
                    <br>
                        <div style="display: flex;">
                            <span class="pann" >Schedule:</span>
                            <input name="sched" onfocus="(this. type='date')" placeholder="Choose a convenient time for pickup (optional)" class="pann" style="width: 100%;">
                        </div>
                    <h3>Requirements:</h3>
                    <h4>Cedula
                        <br>
                        Valid ID
                        <br>
                        Clearance
                    </h4>
                    Select image to upload:
                    <br>
                       <label>Cedula: </label>
                       <br>
                       <input required type="file" name="ced1" id="fileToUpload">
                       <br>
                       <label>Valid ID: </label>
                       <br>
                       <input required type="file" name="vi1" id="fileToUpload">
                       <br>
                       <label>Clearance: </label>
                       <br>
                       <input required type="file" name="clear" id="fileToUpload">
                       <br>
                        <br>
                        <input required type="checkbox" required>
                        <span style=>I have agreed to the <a href="terms.html" id="open-popup">Terms of Use</a> and <a href="data.html" id="open-popup1">Data Privacy Policy</a></span>
                            <br>
                            <span><a href="valid_ids.html">What are the valid IDs?</a></span>
                            <br>
                            <br>
                        <div style="display: flex; justify-content: space-around;">
                            <input required type="submit" value="Submit" name="submit" class="button">
                        </form>
                    <button class="button" type="button" onclick="dashboard()">Cancel</button>
                    </div>
                <br>
            </div>
        </div>
    </center>
    <script src="../javascript/login.js"></script>
    </body>
</html>