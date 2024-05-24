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
                    <h1 class="blo">Applicaion for Indigency</h1>
                    <form action="../library/indi.php" method="post" enctype="multipart/form-data">
                        <div style="display: flex; ">
                            <label for="name" class="pann" >Name: </label>
                            <input id="name" class="pann" name="name" style="width: 100%;" value="<?php echo $kwerieded['full_name'] ?>" required>
                        </div>
                        <br>
                        <div style="display: flex;">
                            <div style="display: flex;">
                                <span class="pann">Age: </span>
                                <input name="age" class="pann" style="width: 100%;" value="<?php echo $kwerieded['age'] ?>" required>
                            </div>
                            <div style="display: flex;">
                                <span class="pann" style="margin-left: 1px;">Civil status: </span>
                                <input class="pann" name="status" style="width: 68%;" value="<?php echo $kwerieded['civil'] ?>" required>
                            </div>
                        </div>
                        <br>
                        <div style="display: flex;">
                            <span class="pann">Address:</span>
                            <input name="address" class="pann" style="width: 100%;" value="<?php echo $kwerieded['address'] ?>" required>
                        </div>
                        <br>
                        <div style="display: flex;">
                            <span class="pann">Number of Child/Siblings:</span>
                            <input name="count" class="pann" style="width: 63%;" required>
                        </div>
                        <br>
                        <div style="display: flex;">
                            <span class="pann">For whom the indigency is taken:</span>
                            <input name="para_kanino" class="pann" style="width: 54%" required>
                        </div>
                        <br>
                        <div style="display: flex;">
                            <span class="pann" >Relation:</span>
                            <input name="relation" class="pann" style="width: 100%;" required>
                        </div>
                        <br>
                        <div style="display: flex;">
                            <span class="pann" >Schedule:</span>
                            <input name="sched" onfocus="(this. type='date')" placeholder="Choose a convenient time for pickup (optional)" class="pann" style="width: 100%;">
                        </div>
                        <br>
                        <span class="pann" style="height: 10px;">Indigency For:</span>
                        <br>
                        <br>
                        <input id="medical" onchange="change(this)" name="medical" type="checkbox" id="checkbox1" style="height: 17px; width: 17px; margin-left: -30px;" ><b>Medical/Philhealth
                        <input name="pao" onchange="change3(this)" type="checkbox" id="checkbox2" style="height: 17px; width: 17px; margin-left: 80px;" > PAO
                        <br>
                        <br>
                        <input name="financial" onchange="change1(this)" type="checkbox" id="checkbox3" style="height: 17px; width: 17px; margin-left: -20px;" > Financial
                        <input name="burial" onchange="change2(this)" type="checkbox" id="checkbox4" style="height: 17px; width: 17px; margin-left: 130px;" > Burial 
                        <br>
                        <br>
                        <input name="educational" onchange="change4(this)" type="checkbox" id="checkbox5" style="height: 17px; width: 17px; margin-left: -212px;" >Educational</b> 
                                <h3>Requirements:</h3>


                            <h4 class="medical" style="display: none;">Medical Abstract
                                <br class="medical" style="display: none;">
                                Medical Certificate
                                <br class="medical" style="display: none;">
                                Laboratory Request
                                <br class="medical" style="display: none;">
                                Reseta(Latest Date)
                            </h4>
                         <label class="medical" style="display: none;">Medical Abstract</label>
                                    <input style="display: none;" class="medical" type="file" name="ma" id="fileToUpload">
                                    <br style="display: none;" class="medical">
                                    <label style="display: none;" class="medical">Medical Certificate: </label>
                                    <input style="display: none;" class="medical" type="file" name="mc" id="fileToUpload">
                                    <br style="display: none;" class="medical">
                                    <label style="display: none;" class="medical">Laboratory Request: </label>
                                    <input style="display: none;" class="medical" type="file" name="lr" id="fileToUpload">
                                    <br style="display: none;" class="medical">
                                    <label style="display: none;" class="medical">Reseta: </label>
                                    <input style="display: none;" class="medical" type="file" name="r" id="fileToUpload">
                        <br style="display: none;" class="medical">
                        <br style="display: none;" class="medical">

                        
                        <h4 class="financial" style="display: none;">ID of the Financial Recipient

                            </h4>
                         <label class="financial" style="display: none;">ID of the Financial Recipient</label>
                                    <input style="display: none;" class="financial" type="file" name="if" id="fileToUpload">
                        <br style="display: none;" class="financial">
                        <br style="display: none;" class="financial">


                        <h4 class="burial" style="display: none;">Registered Death Certificate
                                <br class="burial" style="display: none;">
                                ID of the Deceased
                                <br class="burial" style="display: none;">
                                ID of the Walker
                                <br class="burial" style="display: none;">
                                Contract of Funeral
                            </h4>
                         <label class="burial" style="display: none;">Registered Death Certificate: </label>
                                    <input style="display: none;" class="burial" type="file" name="rdc" id="fileToUpload">
                                    <br style="display: none;" class="burial">
                                    <label style="display: none;" class="burial">ID of the Deceased: </label>
                                    <input style="display: none;" class="burial" type="file" name="iod" id="fileToUpload">
                                    <br style="display: none;" class="burial">
                                    <label style="display: none;" class="burial">ID of the Walker: </label>
                                    <input style="display: none;" class="burial" type="file" name="iw" id="fileToUpload">
                                    <br style="display: none;" class="burial">
                                    <label style="display: none;" class="burial">Contract of Funeral: </label>
                                    <input style="display: none;" class="burial" type="file" name="cf" id="fileToUpload">
                        <br style="display: none;" class="burial">
                        <br style="display: none;" class="burial">


                        <h4 class="pao" style="display: none;">ID of the Recipient
                                <br class="pao" style="display: none;">
                                Blotter Record
                                <br class="pao" style="display: none;">
                                Court Order
                            </h4>
                         <label class="pao" style="display: none;">ID of the Recipient: </label>
                                    <input style="display: none;" class="pao" type="file" name="idr" id="fileToUpload">
                                    <br style="display: none;" class="pao">
                                    <label style="display: none;" class="pao">Blotter Record: </label>
                                    <input style="display: none;" class="pao" type="file" name="br" id="fileToUpload">
                                    <br style="display: none;" class="pao">
                                    <label style="display: none;" class="pao">Court Order: </label>
                                    <input style="display: none;" class="pao" type="file" name="co" id="fileToUpload">
                        <br style="display: none;" class="pao">
                        <br style="display: none;" class="pao">


                        <h4 class="educ" style="display: none;">ID of the Student
                                <br class="educ" style="display: none;">
                                Registration of Enrollment
                            </h4>
                         <label class="educ" style="display: none;">ID of the Student: </label>
                                    <input style="display: none;" class="educ" type="file" name="ios" id="fileToUpload">
                                    <br style="display: none;" class="educ">
                                    <label style="display: none;" class="educ">Registration of Enrollment: </label>
                                    <input style="display: none;" class="educ" type="file" name="re" id="fileToUpload">
                        <br style="display: none;" class="educ">
                        <br style="display: none;" class="educ">
                        <input type="checkbox" required>
                        <span style=>I have agreed to the <a href="terms.html" id="open-popup">Terms of Use</a> and <a href="data.html" id="open-popup1">Data Privacy Policy</a></span>
                            <br>
                            <span><a href="valid_ids.html">What are the valid IDs?</a></span>
                            <br>
                            <br>
                        <div style="display: flex; justify-content: space-around;">
                                <input type="submit" value="Submit" name="submit" class="button">
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