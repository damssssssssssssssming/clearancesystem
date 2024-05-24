<?php
session_start();
require("../php/connection.php");
if(!isset($_SESSION['admin_id'])) {
  header("Location: ../index.php");
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
$nom = mysqli_query($conn, "SELECT * FROM admin_numm WHERE opened = 'Unchecked'");
$number1 = mysqli_num_rows($nom);
$currentDate = date("Y-m-d");
$nom1 = mysqli_query($conn, "SELECT * FROM loginCount WHERE created_at = '$currentDate'");
if($nom1->num_rows > 0) {
$number2 = $nom1->fetch_assoc();
$loginCount = $number2['logCount'];
} else {
  $loginCount = 0;
}
$nom2 = mysqli_query($conn, "SELECT * FROM requestCount WHERE created_at = '$currentDate'");
if($nom2->num_rows > 0) {
$number3 = $nom2->fetch_assoc();
$requestCount = $number3['reqCount'];
} else {
  $requestCount = 0;
}
$nom3 = mysqli_query($conn, "SELECT * FROM completedCount WHERE created_at = '$currentDate'");
if($nom3->num_rows > 0) {
$number4 = $nom3->fetch_assoc();
$completedCount = $number4['comCount'];
} else {
  $completedCount = 0;
}
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
          <div class="stats">
            <h1>Reports</h1>
            <div class="stats1">
              <div class="requests">
                <p class="zeroMargin">Submitted Requests Today</p>
                <h1 class="zeroMargin"><?php echo $requestCount ?></h1>
              </div>
              <div class="requests">
                <p class="zeroMargin">User Logins Today</p>
                <h1 class="zeroMargin"><?php echo $loginCount ?></h1>
              </div>
              <div class="requests">
                <p class="zeroMargin">Completed Requests Today</p>
                <h1 class="zeroMargin"><?php echo $completedCount ?></h1>
              </div>
            </div>
            <br>
            <a href="last30days.php" class="haber1">View Last 30 Days Report</a>
            <br>
            <br>
          </div>
          <br>
          <br>
            <!-- Slideshow container -->
<div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
        <div class="numbertext">Click to add an image</div>
        <img src="../images/add.png" style="width:100%" onclick="clek()" id="image">
    </div>
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
  <span class="dot" onclick="currentSlide(1)"></span>
    <?php foreach ($images as $image): ?>
      <?php $num =+ 1; ?>
    <span class="dot" onclick="currentSlide(<?php echo $num ?>)"></span>
    <?php endforeach; ?>
  </div>
  <div class="tapatin">
    <div>
      <form action="../php/upload.php" method="post" enctype="multipart/form-data">
        <h2>Upload an image</h2>
        <input type="file" name="image" id="fileInput" style="display: none;" onchange="uploadFile(event)">
        <label for="" class="inpotss">Name of image</label>
        <br>
        <br>
        <input placeholder="(needed for deleting)" class="inpotss" style="width: 80%;" name="name">
        <br>
        <br>
        <input type="submit" value="Upload" class="button" name="submit">
        <br>
        <br>
      </form>
    </div>
    <div>
      <form action="../php/remove.php" method="post">
        <h2>Remove an image</h2>
        <label for="" class="inpotss">Name of image</label>
        <br>
        <br>
        <input placeholder="(name of image)" class="inpotss" style="width: 80%;" name="name">
        <br>
        <br>
        <input type="submit" value="Remove" class="button" name="submit">
        <br>
        <br>
      </form>
    </div>
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
              <a class="dropbtn5" style="padding: 10px 30px; text-decoration: none;" href="../php/logout.php">Logout</a>
            </center>
            <br>
            <br>
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