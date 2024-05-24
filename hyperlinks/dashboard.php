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
// Fetch and display images from the database
$dbHost = 'localhost';
$dbName = 'barangay';
$dbUsername = 'root';
$dbPassword = '@root123456';

$num = 1;

try {
    // Create a PDO connection
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch images from the database
    $stmt = $db->query("SELECT * FROM images");
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the database connection
    $db = null;
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$user_id = $_SESSION['user_id'];
$nom = mysqli_query($conn, "SELECT * FROM numm WHERE user_id = '$user_id' AND opened = 'Unchecked'");
$number1 = mysqli_num_rows($nom);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <link rel="stylesheet" href="../css/dashboard.css">
        <title>Dashboard</title>
    </head>
    <body style="background-color:white; background-size: 101%; margin: 0 0 0 0; padding: 0 0 0 0; background-repeat: no-repeat; overflow-x: hidden;">
        <center>
          <div class="dasher">
          <br>
            <div id="dash">
                <div class="q1">
                    <img src="../images/new_icon.png" alt="" id="icon">
                </div>
                <div class="q3">
                    <button class="dropbtn" onclick="dashboard()">Home</button>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Certificates</button>
                    <div class="dropdown-content" style="position: absolute; width: 162px;">
                        <a href="Scedula.php">Cedula</a>
                        <a href="Sclearance.php">Clearance</a>
                        <a href="Sbusiness.php">Business Permit</a>
                        <a href="Scertfi.php">Other Certificates</a>
                    </div>
                </div>
                <div class="dropdown1">
                    <button class="dropbtn" onclick="indigency()">Indigency</button>
                </div>
                <div class="q2" style="position: relative;">
                    <img src="../images/bell1.png" alt="" class="imahe" style="border-style: none;" onclick="notif()">
                    <span class="notification-badge"><?php echo $number1 ?></span> <!-- Overlay text -->
                    <img src="../images/humanoid.png" alt="" class="imahe" onclick="profile()">
                </div>
            </div>
          </div>
          <br>
          <br>
            <!-- Slideshow container -->
            <div class="slideshow-container">

<!-- Full-width images with number and caption text -->
<?php foreach ($images as $image): ?>
    <div class="mySlides fade">
    <div class="numbertext"><?php echo $image['image_name'] ?></div>
    <img src="data:image/jpeg;base64,<?= base64_encode($image['image_path']) ?>" style="width:100%">
    </div>
<?php endforeach; ?>
<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
<?php foreach ($images as $image): ?>
  <?php $num =+ 1; ?>
<span class="dot" onclick="currentSlide(<?php echo $num ?>)"></span>
<?php endforeach; ?>
</div>
            <script src="../javascript/login.js"></script>
        </center>
        <script>
        let slideIndex = 1;
            showSlides(slideIndex);
            
            // Next/previous controls
            function plusSlides(n) {
              showSlides(slideIndex += n);
            }
            
            // Thumbnail image controls
            function currentSlide(n) {
              showSlides(slideIndex = n);
            }

            function showSlides(n) {
              let i;
              let slides = document.getElementsByClassName("mySlides");
              let dots = document.getElementsByClassName("dot");
              if (n > slides.length) {slideIndex = 1}
              if (n < 1) {slideIndex = slides.length}
              for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
              }
              for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex-1].style.display = "block";
              dots[slideIndex-1].className += " active";
            }</script>
            <br>
            <center>
              <button onclick="popup()" class="dropbtn5" style="padding: 10px 30px; text-decoration: none;">Report a Problem</button>
            </center>
            <br>
            <br>
            <div class="popup" id="popup">
                    <div class="popup-content">
                    <button onclick="closeee()" type="button" class="close" id="close-popup">&times;</button>
                    <form action="../php/prob.php" method="post">
                    <h2>Problem: </h2>
                      <input style="display: none" name="id" value="<?php echo $user_id ?>" required>
                      <input name="prob" required>
                      <input value="Submit" type="submit">
                </form>
            </div>
        </div>
            <div class="fuller_container">
              <br>
              <br>
              <div class="full_container">

                  <div class="half_container">
                      <div class="half">
                          <img src="../images/new_icon.png" style="width: 100px; margin-right: 10px; ">
                      </div>
                      <div class="halfhalf">
                          <p>Barangay 177</p>
                          <p>Maria Luisa</p>
                          <p>Camarin, Caloocan</p>
                      </div>

                  </div>
                  <div class="half_container1">
                      <div class="half1">
                        <br>  
                        <br>
                        <img src="../images/lokasiyon.png" alt="" class="liit">
                        <br>
                        <img src="../images/phone.png" alt="" class="liit">
                        <br>
                        <img src="../images/phone.png" alt="" class="liit">
                        <br>
                        <img src="../images/pesbuk.png" alt="" class="liit">
                      </div>
                      <div class="halfhalf1">
                        <p class="pe">Contact us:</p>
                        <p class="pe">887-1519 Zapote Rd, Barangay 177,</p>
                        <p class="pe">Caloocan, 1400 Metro Manila</p>
                        <p class="pe">0999-403-1692</p>
                        <p class="pe">83647073</p>
                        <p class="pe">Facebook page</p>
                      </div>
                  </div>
              </div>
              <br>
              <br>
            <hr style="height:2px;border-width:0;color:white;background-color:white">
            <br>
            <br>
            </div>
    </body>
</html>