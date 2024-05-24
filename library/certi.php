<?php

require_once('fpdf/fpdf.php');
require_once('src/autoload.php');
require_once('src/fpdi.php');
require("../php/connection.php");
session_start();

$name = $_POST['name'];
$age = $_POST['age'];
$address = $_POST['address'];
$year = $_POST['year'];

$pdf = new \setasign\Fpdi\Fpdi();

$pageCount = $pdf->setSourceFile('../pdfs/certi.pdf');
$pageId = $pdf->importPage(1, \setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId);
$pdf->SetTextColor(0, 0, 0); // Black color

// Set text position and size
$pdf->SetXY(50, 50); // Adjust position as needed
$pdf->setFont('Arial');
$pdf->SetFontSize(20); // Adjust font size as needed

// Overlay the modified text

$pdf->Text(50, 67, $name); 
$pdf->SetFontSize(13);
$pdf->Text(55, 77, $address); 
$pdf->SetFontSize(20);
$pdf->Text(100, 87, $age);  
$pdf->Text(100, 97, $year); 

$pdf->SetLineWidth(0.5);
if(isset($_POST['good'])) {
$pdf->Line(23, 117, 25, 122); // Draw line 1
$pdf->Line(25, 122, 29, 112); // Draw line 2
}
if(isset($_POST['guardian'])) {
$pdf->Line(23, 129, 25, 134); // Draw line 1
$pdf->Line(25, 134, 29, 124); // Draw line 2
}
if(isset($_POST['residence'])) {
$pdf->Line(23, 142, 25, 147); // Draw line 1
$pdf->Line(25, 147, 29, 137); // Draw line 2
}
if(isset($_POST['building'])) {
$pdf->Line(23, 154, 25, 159); // Draw line 1
$pdf->Line(25, 159, 29, 149); // Draw line 2
}
if(isset($_POST['solo'])) {
$pdf->Line(131, 117, 133, 122); // Draw line 1
$pdf->Line(133, 122, 137, 112); // Draw line 2
}
if(isset($_POST['person'])) {
$pdf->Line(131, 129, 133, 134); // Draw line 1
$pdf->Line(133, 134, 137, 124); // Draw line 2
}
if(isset($_POST['garage'])) {
$pdf->Line(131, 142, 133, 147); // Draw line 1
$pdf->Line(133, 147, 137, 137); // Draw line 2
}
$pdfContent = $pdf->Output('', 'S');
$user_id = $_SESSION['user_id'];
$kweri = "SELECT * FROM infos WHERE user_id = '$user_id'";
$kweried = mysqli_query($conn, $kweri);
$kwerieded = $kweried->fetch_assoc();
$nameee = $kwerieded['full_name'];
if(isset($_POST['good'])) {
    $duplicatee = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Good Moral'");
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
       $destPath = $uploadDir . $fileName;

       // Move the uploaded file to the destination directory
       if(move_uploaded_file($fileTmpPath, $destPath));
           // Insert the image data into the database

           // Close the database connection
   } else {
       echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
   }
} else {
   echo "No file selected.";
}
if(isset($_FILES['bm']) && $_FILES['bm']['error'] === UPLOAD_ERR_OK) {
   $fileTmpPath = $_FILES['bm']['tmp_name'];
   $fileName = $_FILES['bm']['name'];
   $fileSize = $_FILES['bm']['size'];
   $fileType = $_FILES['bm']['type'];
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
$stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Good Moral', CURDATE(), 'Pending', :pdf_content)");
$stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
$stmt->execute();
$kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Good Moral'";
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
               $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Valid ID', :image_data)");
               $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Billing Meralco/Maynilad', :image_data1)");
               
               // Bind parameters
               $imageData = file_get_contents($destPath);
               $stmt->bindParam(':user_id', $user_id);
               $stmt->bindParam(':req_id', $req_id);
               $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
           
               $imageData1 = file_get_contents($destPath1);
               $stmt1->bindParam(':user_id', $user_id);
               $stmt1->bindParam(':req_id', $req_id);
               $stmt1->bindParam(':image_data1', $imageData1, PDO::PARAM_LOB);
           
               // Execute statements
               $stmt->execute();
               $stmt1->execute();
           
               mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
               mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Good Moral request', DEFAULT)");
               mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Good Moral request')");
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
       }
if(isset($_POST['guardian'])) {
    $duplicatee1 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Guardianship'");
    if($duplicatee1->num_rows == 0) {
if(isset($_FILES['vi1']) && $_FILES['vi1']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['vi1']['tmp_name'];
    $fileName = $_FILES['vi1']['name'];
    $fileSize = $_FILES['vi1']['size'];
    $fileType = $_FILES['vi1']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    // Check file extension
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if(in_array($fileExtension, $allowedExtensions)) {
        // Directory where images will be saved
        $uploadDir = '../imagess/';
        $destPath = $uploadDir . $fileName;

        // Move the uploaded file to the destination directory
        if(move_uploaded_file($fileTmpPath, $destPath));
            // Insert the image data into the database

            // Close the database connection
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
    }
} else {
    echo "No file selected.";
}
if(isset($_FILES['res']) && $_FILES['res']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['res']['tmp_name'];
    $fileName = $_FILES['res']['name'];
    $fileSize = $_FILES['res']['size'];
    $fileType = $_FILES['res']['type'];
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
$stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Guardianship', CURDATE(), 'Pending', :pdf_content)");
$stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
$stmt->execute();
$kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Guardianship'";
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
                $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Valid ID', :image_data)");
                $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Residency', :image_data1)");
            
                // Bind parameters
                $imageData = file_get_contents($destPath);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':req_id', $req_id);
                $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
            
                $imageData1 = file_get_contents($destPath1);
                $stmt1->bindParam(':user_id', $user_id);
                $stmt1->bindParam(':req_id', $req_id);
                $stmt1->bindParam(':image_data1', $imageData1, PDO::PARAM_LOB);
            
                // Execute statements
                $stmt->execute();
                $stmt1->execute();
            
                mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
                mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Guardianship request', DEFAULT)");
                mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Guardianship request')");
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
        }
if(isset($_POST['residence'])) {
    $duplicatee2 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Residency'");
    if($duplicatee2->num_rows == 0) {
    if(isset($_FILES['vi2']) && $_FILES['vi2']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['vi2']['tmp_name'];
    $fileName = $_FILES['vi2']['name'];
    $fileSize = $_FILES['vi2']['size'];
    $fileType = $_FILES['vi2']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    // Check file extension
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if(in_array($fileExtension, $allowedExtensions)) {
        // Directory where images will be saved
        $uploadDir = '../imagess/';
        $destPath = $uploadDir . $fileName;

        // Move the uploaded file to the destination directory
        if(move_uploaded_file($fileTmpPath, $destPath));
            // Insert the image data into the database

            // Close the database connection
    } else {
        echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
    }
} else {
    echo "No file selected.";
}
if(isset($_FILES['cert']) && $_FILES['cert']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['cert']['tmp_name'];
    $fileName = $_FILES['cert']['name'];
    $fileSize = $_FILES['cert']['size'];
    $fileType = $_FILES['cert']['type'];
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
$stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Residency', CURDATE(), 'Pending', :pdf_content)");
$stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
$stmt->execute();
$kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Residency'";
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
                $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Valid ID', :image_data)");
                $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Certification Home Owners/Bantay Purok', :image_data1)");
            
                // Bind parameters
                $imageData = file_get_contents($destPath);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':req_id', $req_id);
                $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
            
                $imageData1 = file_get_contents($destPath1);
                $stmt1->bindParam(':user_id', $user_id);
                $stmt1->bindParam(':req_id', $req_id);
                $stmt1->bindParam(':image_data1', $imageData1, PDO::PARAM_LOB);
            
                // Execute statements
                $stmt->execute();
                $stmt1->execute();
            
                mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
                mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Residency request', DEFAULT)");
                mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Residency request')");
                $currentDate = date("Y-m-d");
                $kweriii = mysqli_query($conn, "SELECT * FROM requestCount WHERE created_at = '$currentDate'");
                
                if(mysqli_num_rows($kweriii) > 0) {
                    $requestCount = $kweriii->fetch_assoc();
                    $addddd = $requestCount['reqCount'] + 1;
                    mysqli_query($conn, "UPDATE requestCount SET reqCount = '$addddd' WHERE created_at = '$currentDate'");
                } else {
                    mysqli_query($conn, "INSERT INTO requestCount (reqCount, created_at) VALUES (1, CURDATE())");
                }ysqli_query($conn, "INSERT INTO requestCount VALUES(NULL, 1, CURDATE())");
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
        }
if(isset($_POST['solo'])) {
    $duplicatee3 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Solo Parent'");
    if($duplicatee3->num_rows == 0) {
    if(isset($_FILES['pb1']) && $_FILES['pb1']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pb1']['tmp_name'];
        $fileName = $_FILES['pb1']['name'];
        $fileSize = $_FILES['pb1']['size'];
        $fileType = $_FILES['pb1']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath));
                // Insert the image data into the database
    
                // Close the database connection
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
        }
    } else {
        echo "No file selected.";
    }
    if(isset($_FILES['pi1']) && $_FILES['pi1']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pi1']['tmp_name'];
        $fileName = $_FILES['pi1']['name'];
        $fileSize = $_FILES['pi1']['size'];
        $fileType = $_FILES['pi1']['type'];
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
    if(isset($_FILES['pc1']) && $_FILES['pc1']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pc1']['tmp_name'];
        $fileName = $_FILES['pc1']['name'];
        $fileSize = $_FILES['pc1']['size'];
        $fileType = $_FILES['pc1']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath2 = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath2));
                // Insert the image data into the database
    
                // Close the database connection
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
        }
    } else {
        echo "No file selected.";
    }
    if(isset($_FILES['vi3']) && $_FILES['vi3']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['vi3']['tmp_name'];
        $fileName = $_FILES['vi3']['name'];
        $fileSize = $_FILES['vi3']['size'];
        $fileType = $_FILES['vi3']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath3 = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath3));
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
    $stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Solo Parent', CURDATE(), 'Pending', :pdf_content)");
    $stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
    $stmt->execute();
    $kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Solo Parent'";
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
                    $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Proof of Billing', :image_data)");
                    $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Proof of Income', :image_data1)");
                    $stmt2 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Proof of Custody', :image_data2)");
                    $stmt3 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Valid ID', :image_data3)");
                
                    // Bind parameters
                    $imageData = file_get_contents($destPath);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':req_id', $req_id);
                    $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
                
                    $imageData1 = file_get_contents($destPath1);
                    $stmt1->bindParam(':user_id', $user_id);
                    $stmt1->bindParam(':req_id', $req_id);
                    $stmt1->bindParam(':image_data1', $imageData1, PDO::PARAM_LOB);
                
                    $imageData2 = file_get_contents($destPath2);
                    $stmt2->bindParam(':user_id', $user_id);
                    $stmt2->bindParam(':req_id', $req_id);
                    $stmt2->bindParam(':image_data2', $imageData2, PDO::PARAM_LOB);
    
                    $imageData3 = file_get_contents($destPath3);
                    $stmt3->bindParam(':user_id', $user_id);
                    $stmt3->bindParam(':req_id', $req_id);
                    $stmt3->bindParam(':image_data3', $imageData3, PDO::PARAM_LOB);
                
                    // Execute statements
                    $stmt->execute();
                    $stmt1->execute();
                    $stmt2->execute();
                    $stmt3->execute();
                
                    mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
                    mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Solo Parent request', DEFAULT)");
                    mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Solo Parent request')");
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
            }
if(isset($_POST['garage'])) {
    $duplicatee4 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Garage'");
    if($duplicatee4->num_rows == 0) {
    if(isset($_FILES['vi4']) && $_FILES['vi4']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['vi4']['tmp_name'];
        $fileName = $_FILES['vi4']['name'];
        $fileSize = $_FILES['vi4']['size'];
        $fileType = $_FILES['vi4']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath));
                // Insert the image data into the database
    
                // Close the database connection
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
        }
    } else {
        echo "No file selected.";
    }
    if(isset($_FILES['pb2']) && $_FILES['pb2']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pb2']['tmp_name'];
        $fileName = $_FILES['pb2']['name'];
        $fileSize = $_FILES['pb2']['size'];
        $fileType = $_FILES['pb2']['type'];
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
    if(isset($_FILES['res1']) && $_FILES['res1']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['res1']['tmp_name'];
        $fileName = $_FILES['res1']['name'];
        $fileSize = $_FILES['res1']['size'];
        $fileType = $_FILES['res1']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath2 = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath2));
                // Insert the image data into the database
    
                // Close the database connection
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
        }
    } else {
        echo "No file selected.";
    }
    if(isset($_FILES['clear1']) && $_FILES['clear1']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['clear1']['tmp_name'];
        $fileName = $_FILES['clear1']['name'];
        $fileSize = $_FILES['clear1']['size'];
        $fileType = $_FILES['clear1']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath3 = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath3));
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
    $stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Garage', CURDATE(), 'Pending', :pdf_content)");
    $stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
    $stmt->execute();
    $kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Garage'";
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
                    $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Valid ID', :image_data)");
                    $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Proof of Billing', :image_data1)");
                    $stmt2 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Residency', :image_data2)");
                    $stmt3 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Clearance', :image_data3)");
                
                    // Bind parameters
                    $imageData = file_get_contents($destPath);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':req_id', $req_id);
                    $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
                
                    $imageData1 = file_get_contents($destPath1);
                    $stmt1->bindParam(':user_id', $user_id);
                    $stmt1->bindParam(':req_id', $req_id);
                    $stmt1->bindParam(':image_data1', $imageData1, PDO::PARAM_LOB);
                
                    $imageData2 = file_get_contents($destPath2);
                    $stmt2->bindParam(':user_id', $user_id);
                    $stmt2->bindParam(':req_id', $req_id);
                    $stmt2->bindParam(':image_data2', $imageData2, PDO::PARAM_LOB);
    
                    $imageData3 = file_get_contents($destPath3);
                    $stmt3->bindParam(':user_id', $user_id);
                    $stmt3->bindParam(':req_id', $req_id);
                    $stmt3->bindParam(':image_data3', $imageData3, PDO::PARAM_LOB);
                
                    // Execute statements
                    $stmt->execute();
                    $stmt1->execute();
                    $stmt2->execute();
                    $stmt3->execute();
                
                    mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
                    mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Garage request', DEFAULT)");
                    mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Garage request')");
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
            }
if(isset($_POST['building'])) {
    $duplicatee5 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Building Permit'");
    if($duplicatee5->num_rows == 0) {
    if(isset($_FILES['bc']) && $_FILES['bc']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['bc']['tmp_name'];
        $fileName = $_FILES['bc']['name'];
        $fileSize = $_FILES['bc']['size'];
        $fileType = $_FILES['bc']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath));
                // Insert the image data into the database
    
                // Close the database connection
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
        }
    } else {
        echo "No file selected.";
    }
    if(isset($_FILES['zc']) && $_FILES['zc']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['zc']['tmp_name'];
        $fileName = $_FILES['zc']['name'];
        $fileSize = $_FILES['zc']['size'];
        $fileType = $_FILES['zc']['type'];
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
    if(isset($_FILES['tsp']) && $_FILES['tsp']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['tsp']['tmp_name'];
        $fileName = $_FILES['tsp']['name'];
        $fileSize = $_FILES['tsp']['size'];
        $fileType = $_FILES['tsp']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath2 = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath2));
                // Insert the image data into the database
    
                // Close the database connection
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
        }
    } else {
        echo "No file selected.";
    }
    if(isset($_FILES['fsip']) && $_FILES['fsip']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fsip']['tmp_name'];
        $fileName = $_FILES['fsip']['name'];
        $fileSize = $_FILES['fsip']['size'];
        $fileType = $_FILES['fsip']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath3 = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath3));
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
    $stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Building Permit', CURDATE(), 'Pending', :pdf_content)");
    $stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
    $stmt->execute();
    $kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Building Permit'";
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
                    $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Barangay Clearance', :image_data)");
                    $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Zoning Clearance', :image_data1)");
                    $stmt2 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Temporary Sanitation Permit', :image_data2)");
                    $stmt3 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Fire Safety Inspection Permit', :image_data3)");
                
                    // Bind parameters
                    $imageData = file_get_contents($destPath);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':req_id', $req_id);
                    $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
                
                    $imageData1 = file_get_contents($destPath1);
                    $stmt1->bindParam(':user_id', $user_id);
                    $stmt1->bindParam(':req_id', $req_id);
                    $stmt1->bindParam(':image_data1', $imageData1, PDO::PARAM_LOB);
                
                    $imageData2 = file_get_contents($destPath2);
                    $stmt2->bindParam(':user_id', $user_id);
                    $stmt2->bindParam(':req_id', $req_id);
                    $stmt2->bindParam(':image_data2', $imageData2, PDO::PARAM_LOB);
    
                    $imageData3 = file_get_contents($destPath3);
                    $stmt3->bindParam(':user_id', $user_id);
                    $stmt3->bindParam(':req_id', $req_id);
                    $stmt3->bindParam(':image_data3', $imageData3, PDO::PARAM_LOB);
                
                    // Execute statements
                    $stmt->execute();
                    $stmt1->execute();
                    $stmt2->execute();
                    $stmt3->execute();
                
                    mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
                    mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Building Permit request', DEFAULT)");
                    mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Building Permit request')");
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
            }
if(isset($_POST['person'])) {
    $duplicatee6 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Person with Disability Certificate'");
    if($duplicatee6->num_rows == 0) {
    if(isset($_FILES['mc']) && $_FILES['mc']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['mc']['tmp_name'];
        $fileName = $_FILES['mc']['name'];
        $fileSize = $_FILES['mc']['size'];
        $fileType = $_FILES['mc']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath));
                // Insert the image data into the database
    
                // Close the database connection
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
        }
    } else {
        echo "No file selected.";
    }
    if(isset($_FILES['vi5']) && $_FILES['vi5']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['vi5']['tmp_name'];
        $fileName = $_FILES['vi5']['name'];
        $fileSize = $_FILES['vi5']['size'];
        $fileType = $_FILES['vi5']['type'];
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
    if(isset($_FILES['pb3']) && $_FILES['pb3']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pb3']['tmp_name'];
        $fileName = $_FILES['pb3']['name'];
        $fileSize = $_FILES['pb3']['size'];
        $fileType = $_FILES['pb3']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath3 = $uploadDir . $fileName;
    
            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath3));
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
    $stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Person with Disability Certificate', CURDATE(), 'Pending', :pdf_content)");
    $stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
    $stmt->execute();
    $kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Person with Disability Certificate'";
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
                    $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Medical Certificate', :image_data)");
                    $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Valid ID', :image_data1)");
                    $stmt3 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Proof of Billing', :image_data3)");
                
                    // Bind parameters
                    $imageData = file_get_contents($destPath);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->bindParam(':req_id', $req_id);
                    $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
                
                    $imageData1 = file_get_contents($destPath1);
                    $stmt1->bindParam(':user_id', $user_id);
                    $stmt1->bindParam(':req_id', $req_id);
                    $stmt1->bindParam(':image_data1', $imageData1, PDO::PARAM_LOB);
    
                    $imageData3 = file_get_contents($destPath3);
                    $stmt3->bindParam(':user_id', $user_id);
                    $stmt3->bindParam(':req_id', $req_id);
                    $stmt3->bindParam(':image_data3', $imageData3, PDO::PARAM_LOB);
                
                    // Execute statements
                    $stmt->execute();
                    $stmt1->execute();
                    $stmt3->execute();
                
                    mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
                    mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Person with Disability Certificate request', DEFAULT)");
                    mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Person with Disability Certificate request')");
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
            }
            header("Location: ../hyperlinks/success.html");
?>