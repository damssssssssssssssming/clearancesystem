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
                        <h1 class="blo">Request for Certificates</h1>
                        <form action="../library/certi.php" method="post" enctype="multipart/form-data">
                        <br>
                    <div style="display: flex;">
                        <label for="name" class="pann" style="margin-right:1px ;">Name:</label>
                        <input required name="name" id="name" class="pann" style="width: 100%;" value="<?php echo $kwerieded['full_name'] ?>">
                    </div>
                        <br>
                    <div style="display: flex;">
                        <span class="pann" style="margin-right: 1px;">Address:</span>
                        <input required name="address" class="pann" style="width: 100%;" value="<?php echo $kwerieded['address'] ?>">
                    </div>
                        <br>
                    <div style="display: flex;">
                        <span class="pann" style="margin-right:1px;">Age:</span>
                        <input required  name="age" class="pann" style="width: 100%;" value="<?php echo $kwerieded['age'] ?>">
                    </div>
                        <br>
                    <div style="display: flex;">
                        <span class="pann">Year of Residency:</span>
                        <input required name="year" class="pann" style="width: 73%;">
                    </div>
                    <br>
                        <div style="display: flex;">
                            <span class="pann" >Schedule:</span>
                            <input name="sched" onfocus="(this. type='date')" placeholder="Choose a convenient time for pickup (optional)" class="pann" style="width: 100%;">
                        </div>
                        <br>
                        <span class="pann" style="margin-right: -170px;">Type Certificate:</span>
                        <br>
                        <br>
                        <input onchange="change5(this)" type="checkbox" id="checkbox1" style="height: 17px; width: 17px; margin-right: 1px; margin-left: -5px;" name="good"><b>Good Moral
                        <input onchange="change8(this)" type="checkbox" id="checkbox2" style="height: 17px; width: 17px; margin-right: -3px; margin-left: 117px;" name="solo" > Solo Parent
                        <br>
                        <br>
                        <input onchange="change7(this)" type="checkbox" id="checkbox3" style="height: 17px; width: 17px; margin-right: -3px; margin-left: 115px;" name="guardian" > Guardianship
                        <input onchange="change9(this)" type="checkbox" id="checkbox4" style="height: 17px; width: 17px;  margin-right: -3px; margin-left: 105px;" name="person" > Person with Disability(PWD)                        <br>
                        <br>
                        <input onchange="change6(this)" type="checkbox" id="checkbox1" style="height: 17px; width: 17px; margin-right: 2px; margin-left: -32px;" name="residence" >Residence
                        <input onchange="change10(this)" type="checkbox" id="checkbox2" style="height: 17px; width: 17px; margin-right:-3px; margin-left: 133px;" name="garage"> Garage
                        <br>
                        <br>
                        <input onchange="change11(this)" type="checkbox" id="checkbox3" style="height: 17px; width: 17px; margin-right: -1px; margin-left: -247px;" name="building"> Building 
                        </b>
                        <h3>Requirements:</h3>


                        <h4 class="good" style="display: none;">Valid ID
                            <br class="good" style="display: none;">
                            Billing Meralco/Maynilad
                        </h4>
                     <label class="good" style="display: none;">Valid ID: </label>
                                <input style="display: none;" class="good" type="file" name="vi" id="fileToUpload">
                                <br style="display: none;" class="good">
                                <label style="display: none;" class="good">Billing Meralco/Maynilad: </label>
                                <input style="display: none;" class="good" type="file" name="bm" id="fileToUpload">
                    <br style="display: none;" class="good">
                    <br style="display: none;" class="good">


                    <h4 class="residency" style="display: none;">Valid ID
                        <br class="residency" style="display: none;">
                        Certification Home Owners/Bantay Purok
                    </h4>
                 <label class="residency" style="display: none;">Valid ID: </label>
                            <input style="display: none;" class="residency" type="file" name="vi2" id="fileToUpload">
                            <br style="display: none;" class="residency">
                            <label style="display: none;" class="residency">Certification Home Owners/Bantay Purok: </label>
                            <input style="display: none;" class="residency" type="file" name="cert" id="fileToUpload">
                <br style="display: none;" class="residency">
                <br style="display: none;" class="residency">


                <h4 class="guard" style="display: none;">Valid ID
                    <br class="guard" style="display: none;">
                    Residency
                </h4>
             <label class="guard" style="display: none;">Valid ID: </label>
                        <input style="display: none;" class="guard" type="file" name="vi1" id="fileToUpload">
                        <br style="display: none;" class="guard">
                        <label style="display: none;" class="guard">Residency: </label>
                        <input style="display: none;" class="guard" type="file" name="res" id="fileToUpload">
            <br style="display: none;" class="guard">
            <br style="display: none;" class="guard">



            <h4 class="solo" style="display: none;">Proof of Billing
                <br class="solo" style="display: none;">
                Proof of Income
                <br class="solo" style="display: none;">
                Proof of Custody
                <br class="solo" style="display: none;">
                Valid ID
            </h4>
         <label class="solo" style="display: none;">Proof of Billing: </label>
                    <input style="display: none;" class="solo" type="file" name="pb1" id="fileToUpload">
                    <br style="display: none;" class="solo">
                    <label style="display: none;" class="solo">Proof of Income: </label>
                    <input style="display: none;" class="solo" type="file" name="pi1" id="fileToUpload">
                    <br style="display: none;" class="solo">
                    <label style="display: none;" class="solo">Proof of Custody: </label>
                    <input style="display: none;" class="solo" type="file" name="pc1" id="fileToUpload">
                    <br style="display: none;" class="solo">
                    <label style="display: none;" class="solo">Valid ID: </label>
                    <input style="display: none;" class="solo" type="file" name="vi3" id="fileToUpload">
        <br style="display: none;" class="solo">
        <br style="display: none;" class="solo">


        <h4 class="pwd" style="display: none;">Medical Certificate
            <br class="pwd" style="display: none;">
            Valid ID
            <br class="pwd" style="display: none;">
            Proof of Billing
        </h4>
     <label class="pwd" style="display: none;">Medical Certificate: </label>
                <input style="display: none;" class="pwd" type="file" name="mc" id="fileToUpload">
                <br style="display: none;" class="pwd">
                <label style="display: none;" class="pwd">Valid ID: </label>
                <input style="display: none;" class="pwd" type="file" name="vi5" id="fileToUpload">
                <br style="display: none;" class="pwd">
                <label style="display: none;" class="pwd">Proof of Billing: </label>
                <input style="display: none;" class="pwd" type="file" name="pb3" id="fileToUpload">
    <br style="display: none;" class="pwd">
    <br style="display: none;" class="pwd">

        
    <h4 class="garage" style="display: none;">Valid ID
        <br class="garage" style="display: none;">
        Proof of Billing
        <br class="garage" style="display: none;">
        Residency
        <br class="garage" style="display: none;">
        Clearance
    </h4>
 <label class="garage" style="display: none;">Valid Id: </label>
            <input style="display: none;" class="garage" type="file" name="vi4" id="fileToUpload">
            <br style="display: none;" class="garage">
            <label style="display: none;" class="garage">Proof of Billing: </label>
            <input style="display: none;" class="garage" type="file" name="pb2" id="fileToUpload">
            <br style="display: none;" class="garage">
            <label style="display: none;" class="garage">Residency: </label>
            <input style="display: none;" class="garage" type="file" name="res1" id="fileToUpload">
            <br style="display: none;" class="garage">
            <label style="display: none;" class="garage">Clearance: </label>
            <input style="display: none;" class="garage" type="file" name="clear" id="fileToUpload">
<br style="display: none;" class="garage">
<br style="display: none;" class="garage">


<h4 class="build" style="display: none;">Barangay Clearance
    <br class="build" style="display: none;">
    Zoning Clearance
    <br class="build" style="display: none;">
    Temporary Sanitation Permit
    <br class="build" style="display: none;">
    Fire Safety Inspection Permit
</h4>
<label class="build" style="display: none;">Barangay Clearance: </label>
        <input style="display: none;" class="build" type="file" name="bc" id="fileToUpload">
        <br style="display: none;" class="build">
        <label style="display: none;" class="build">Zoning Clearance: </label>
        <input style="display: none;" class="build" type="file" name="zc" id="fileToUpload">
        <br style="display: none;" class="build">
        <label style="display: none;" class="build">Temporary Sanitation Permit: </label>
        <input style="display: none;" class="build" type="file" name="tsp" id="fileToUpload">
        <br style="display: none;" class="build">
        <label style="display: none;" class="build">Fire Safety Inspection Permit: </label>
        <input style="display: none;" class="build" type="file" name="fsip" id="fileToUpload">
<br style="display: none;" class="build">
<br style="display: none;" class="build">


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