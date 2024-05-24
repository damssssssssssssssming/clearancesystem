<?php

require_once('fpdf/fpdf.php');
require_once('src/autoload.php');
require_once('src/fpdi.php');
require("../php/connection.php");
session_start();

$name = $_POST['name'];
$date = $_POST['date'];
$address = $_POST['address'];
$age = $_POST['age'];
$birthdate = $_POST['birthdate'];
$birthplace = $_POST['birthplace'];
$contact = $_POST['contact'];
$pdf = new \setasign\Fpdi\Fpdi();

$pageCount = $pdf->setSourceFile('../pdfs/cedu.pdf');
$pageId = $pdf->importPage(1, \setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId);
$pdf->SetTextColor(0, 0, 0); // Black color

// Set text position and size
$pdf->SetXY(50, 50); // Adjust position as needed
$pdf->setFont('Arial');
$pdf->SetFontSize(20); // Adjust font size as needed

// Overlay the modified text

$pdf->Text(156, 67, $date); 
$pdf->Text(39, 77, $name); 
$pdf->SetFontSize(13);
$pdf->Text(44, 87, $address);  
$pdf->SetFontSize(20);
$pdf->Text(100, 97, $age); 
$pdf->Text(50, 108, $birthdate); 
$pdf->Text(51, 118, $birthplace); 
$pdf->Text(55, 151, $contact);  

$pdf->SetLineWidth(0.5);
if(isset($_POST['female'])) {
$pdf->Line(49, 127, 51, 132); // Draw line 1
$pdf->Line(51, 132, 55, 122); // Draw line 2
}
if(isset($_POST['male'])) {
$pdf->Line(87, 127, 89, 132); // Draw line 1
$pdf->Line(89, 132, 93, 122); // Draw line 2
}
if(isset($_POST['single'])) {
$pdf->Line(49, 138, 51, 143); // Draw line 1
$pdf->Line(51, 143, 55, 133); // Draw line 2
}
if(isset($_POST['married'])) {
$pdf->Line(87, 138, 89, 143); // Draw line 1
$pdf->Line(89, 143, 93, 133); // Draw line 2
}
if(isset($_POST['widowed'])) {
$pdf->Line(124, 138, 126, 143); // Draw line 1
$pdf->Line(126, 143, 130, 133); // Draw line 2
}
$pdfContent = $pdf->Output('', 'S');
$user_id = $_SESSION['user_id'];
$kweri = "SELECT * FROM infos WHERE user_id = '$user_id'";
$kweried = mysqli_query($conn, $kweri);
$kwerieded = $kweried->fetch_assoc();
$nameee = $kwerieded['full_name'];
$schedUser1 = '';
$duplicatee = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Cedula'");
    if($duplicatee->num_rows == 0) {
if(isset($_FILES['vi']) && $_FILES['vi']['error'] === UPLOAD_ERR_OK) {
   $fileTmpPath = $_FILES['vi']['tmp_name'];
   $fileName = $_FILES['vi']['name'];
   $fileSize = $_FILES['vi']['size'];
   $fileType = $_FILES['vi']['type'];
   $fileNameCmps = explode(".", $fileName);
   $fileExtension = strtolower(end($fileNameCmps));
   
   // Check file extension
   $allowedExtensions = array("jpg", "jpeg", "png", "gif");
   if(in_array($fileExtension, $allowedExtensions)) {
       // Directory where images will be saved
       $uploadDir = '../imagess/';
       $destPath1 = $uploadDir . $fileName;

       // Move the uploaded file to the destination directory
       if(move_uploaded_file($fileTmpPath, $destPath1));
           // Insert the image data into the database

           // Close the database connection
   } else {
       echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
   }
} else {
   echo "No file selected.";
}

$db = new PDO('mysql:host=localhost;dbname=barangay', 'root', '@root123456');

// Prepare and execute a query to insert the PDF content into the database
$stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Cedula', CURDATE(), 'Pending', :pdf_content)");
$stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
$stmt->execute();
$kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Cedula'";
$kweried = mysqli_query($conn, $kweri);
$kwerieded = $kweried->fetch_assoc();
$req_id = $kwerieded['id'];
    $schedUser = $_POST['sched'];
    $schedUser1 = date('Y-m-d', strtotime($schedUser));
    if($schedUser1 != '1970-01-01') {
        mysqli_query($conn, "INSERT INTO schedule_user VALUES(NULL, '$user_id', '$req_id', '$schedUser1')");
    } else {
        mysqli_query($conn, "INSERT INTO schedule_user VALUES(NULL, '$user_id', '$req_id', 'No input')");
    }

           $dbHost = 'localhost';
           $dbName = 'barangay';
           $dbUsername = 'root';
           $dbPassword = '@root123456';

           try {
               // Create a PDO connection
               $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
               $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
               // Prepare SQL statements
               $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Valid ID', :image_data1)");
           
               $imageData1 = file_get_contents($destPath1);
               $stmt1->bindParam(':user_id', $user_id);
               $stmt1->bindParam(':req_id', $req_id);
               $stmt1->bindParam(':image_data1', $imageData1, PDO::PARAM_LOB);
           
               // Execute statements
               $stmt1->execute();

               mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
               mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Cedula request', DEFAULT)");
               mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Cedula request')");
               $currentDate = date("Y-m-d");
                $kweriii = mysqli_query($conn, "SELECT * FROM requestCount WHERE created_at = '$currentDate'");
                
                if(mysqli_num_rows($kweriii) > 0) {
                    $requestCount = $kweriii->fetch_assoc();
                    $addddd = $requestCount['reqCount'] + 1;
                    mysqli_query($conn, "UPDATE requestCount SET reqCount = '$addddd' WHERE created_at = '$currentDate'");
                } else {
                    mysqli_query($conn, "INSERT INTO requestCount (reqCount, created_at) VALUES (1, CURDATE())");
                }
           } catch(PDOException $e) {
               echo "Error: " . $e->getMessage();
           }
        } else {
            echo "<link rel='stylesheet' href='../css/dashboard.css'><center><h1>You can only request a form one at a time!</h1></center><center>
        <a class='dropbtn5' style='padding: 10px 30px; text-decoration: none;'' href='javascript:history.go(-1)'>Go Back</a>
    </center>";
    exit();
        }
        header("Location: ../hyperlinks/success.html");
?>