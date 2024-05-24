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
        <title>ced</title>
    </head>
    <body style="background: linear-gradient(#56C596, #CFF4D2); background-repeat: no-repeat; background-attachment: fixed;">
        <center>
            <div id="deva">
                <div class="deva1">
                        <br>
                        <br>
                        <h1 class="blo">Request for Cedula</h1>
                        <form method="post" action="../library/ced.php" enctype="multipart/form-data">
                            <br>
                            <br>
                                <div style="display: flex;">
                                    <span class="pann" style="margin-left: 400px;">Date:</span>
                                    <input required class="pann"  name="date" style="width: 25%;" value="<?php echo $currentDate ?>" required>
                                </div>
                            <br>
                                <div style="display: flex;">
                                    <label for="name" class="pann">Name:</label>
                                    <input required id="name" class="pann" style="width: 100%;" name="name" value="<?php echo $kwerieded['full_name'] ?>" required>
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
                                    <span class="pann">Birthdate:</span>
                                    <input required name="birthdate" class="pann" style="width: 100%;" value="<?php echo $kwerieded['bert'] ?>" required>
                                </div>   
                            <br>
                                <div style="display: flex;">
                                    <span class="pann" >Birthplace:</span>
                                    <input required name="birthplace" class="pann" style="width: 100%;" required>
                                </div>
                                <br>
                        <div style="display: flex;">
                            <span class="pann" >Schedule:</span>
                            <input name="sched" onfocus="(this. type='date')" placeholder="Choose a convenient time for pickup (optional)" class="pann" style="width: 100%;">
                        </div>
                            <br>
                            <span class="pann" style="margin-right: -170px;">Relationship status:</span>
                            <input type="checkbox" id="checkbox1" name="single"> Single
                            <input type="checkbox" id="checkbox2" name="married"> Married
                            <input type="checkbox" id="checkbox3" name="widowed"> Widowed
                            <br>
                            <br>
                            <span class="pann" style="margin-right: -250px;">Gender:</span>
                            <input type="checkbox" id="checkbox4" name="male">Male
                            <input type="checkbox" id="checkbox5" name="female">Female
                            <br>
                            <br>
                                <div style="display: flex;">
                                    <span class="pann" style="margin: 1px;">Contact number:</span>
                                    <input required name="contact" value="<?php echo $kwerieded['contact'] ?>" class="pann" style="width: 76%;" required>
                                </div>
                            <br>
                            <h3>Requirements:</h3>
                            <h4>Valid ID
                            </h4>
                                 Select image to upload:
                                 <br>
                                    <label>Valid ID: </label>
                                    <br>
                                    <input required type="file" name="vi" id="fileToUpload">
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