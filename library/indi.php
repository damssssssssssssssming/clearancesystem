<?php
require_once('fpdf/fpdf.php');
require_once('src/autoload.php');
require_once('src/fpdi.php');
require("../php/connection.php");
session_start();
if(isset($_POST['submit'])) {
if(isset($_POST['name'])) {
$name = $_POST['name'];
}
if(isset($_POST['age'])) {
$age = $_POST['age'];
}
if(isset($_POST['status'])) {
$status = $_POST['status'];
}
if(isset($_POST['address'])) {
$address = $_POST['address'];
}
if(isset($_POST['count'])) {
$count = $_POST['count'];
}
if(isset($_POST['para_kanino'])) {
$para_kanino = $_POST['para_kanino'];
}
if(isset($_POST['relation'])) {
$relation = $_POST['relation'];
}

$pdf = new \setasign\Fpdi\Fpdi();

$pageCount = $pdf->setSourceFile('../pdfs/indigency.pdf');
$pageId = $pdf->importPage(1, \setasign\Fpdi\PdfReader\PageBoundaries::MEDIA_BOX);

$pdf->addPage();
$pdf->useImportedPage($pageId);
$pdf->SetTextColor(0, 0, 0); // Black color

// Set text position and size
$pdf->SetXY(50, 50); // Adjust position as needed
$pdf->setFont('Arial');
$pdf->SetFontSize(20); // Adjust font size as needed

// Overlay the modified text
$pdf->Text(65, 66, $name); 
$pdf->Text(65, 77, $age); 
$pdf->Text(141, 77, $status); 
$pdf->SetFontSize(13);
$pdf->Text(42, 87, $address);
$pdf->SetFontSize(20);
$pdf->Text(120, 97, $count);
$pdf->Text(90, 115, $para_kanino);
$pdf->Text(90, 125, $relation);
$pdf->SetDrawColor(0, 0, 0); // Black color

// Set line width
$pdf->SetLineWidth(0.5);

// Draw check mark
 // Adjust position as needed
 if(isset($_POST['medical'])) {
    $pdf->Line(23, 145, 25, 150); // Draw line 1
    $pdf->Line(25, 150, 29, 140); // Draw line 2
 } if(isset($_POST['burial'])) {
    $pdf->Line(23, 157, 25, 162); // Draw line 1
    $pdf->Line(25, 162, 29, 152);
 } if(isset($_POST['educational'])) {
    $pdf->Line(23, 169, 25, 174); // Draw line 1
    $pdf->Line(25, 174, 29, 164);
 } if(isset($_POST['pao'])) {
    $pdf->Line(133, 145, 135, 150); // Draw line 1
    $pdf->Line(135, 150, 139, 140);
 } if(isset($_POST['financial'])) {
    $pdf->Line(133, 157, 135, 162); // Draw line 1
    $pdf->Line(135, 162, 139, 152);
 } 
 $pdfContent = $pdf->Output('', 'S');
 $user_id = $_SESSION['user_id'];
 $kweri = "SELECT * FROM infos WHERE user_id = '$user_id'";
 $kweried = mysqli_query($conn, $kweri);
 $kwerieded = $kweried->fetch_assoc();
 $nameee = $kwerieded['full_name'];
 if(isset($_POST['medical'])) {
    $duplicatee = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Medical Indigency'");
    if($duplicatee->num_rows == 0) {
 if(isset($_FILES['ma']) && $_FILES['ma']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['ma']['tmp_name'];
    $fileName = $_FILES['ma']['name'];
    $fileSize = $_FILES['ma']['size'];
    $fileType = $_FILES['ma']['type'];
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
if(isset($_FILES['lr']) && $_FILES['lr']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['lr']['tmp_name'];
    $fileName = $_FILES['lr']['name'];
    $fileSize = $_FILES['lr']['size'];
    $fileType = $_FILES['lr']['type'];
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
if(isset($_FILES['r']) && $_FILES['r']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['r']['tmp_name'];
    $fileName = $_FILES['r']['name'];
    $fileSize = $_FILES['r']['size'];
    $fileType = $_FILES['r']['type'];
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
$stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Medical Indigency', CURDATE(), 'Pending', :pdf_content)");
$stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
$stmt->execute();
$kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Medical Indigency'";
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
                $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Medical Abstract', :image_data)");
                $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Medical Certificate', :image_data1)");
                $stmt2 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Laboratory Request', :image_data2)");
                $stmt3 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Reseta', :image_data3)");
            
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
                mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Medical Indigency request', DEFAULT)");
                mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Medical Indigency request')");
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
}
    if(isset($_POST['financial'])) {
        $duplicatee1 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Financial Indigency'");
    if($duplicatee1->num_rows == 0) {
        if(isset($_FILES['if']) && $_FILES['if']['error'] === UPLOAD_ERR_OK) {
           $fileTmpPath = $_FILES['if']['tmp_name'];
           $fileName = $_FILES['if']['name'];
           $fileSize = $_FILES['if']['size'];
           $fileType = $_FILES['if']['type'];
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
       
       $db = new PDO('mysql:host=localhost;dbname=barangay', 'root', '@root123456');
       
       // Prepare and execute a query to insert the PDF content into the database
       $stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Financial Indigency', CURDATE(), 'Pending', :pdf_content)");
       $stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
       $stmt->execute();
       $kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Financial Indigency'";
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
                       $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'ID of the Financial Recipient', :image_data)");
                   
                       // Bind parameters
                       $imageData = file_get_contents($destPath);
                       $stmt->bindParam(':user_id', $user_id);
                       $stmt->bindParam(':req_id', $req_id);
                       $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);
                   
                       // Execute statements
                       $stmt->execute();
                   
                       mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
                       mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Financial Indigency request', DEFAULT)");
                       mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Financial Indigency request')");
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
               if(isset($_POST['burial'])) {
                $duplicatee2 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Burial Indigency'");
    if($duplicatee2->num_rows == 0) {
                if(isset($_FILES['rdc']) && $_FILES['rdc']['error'] === UPLOAD_ERR_OK) {
                   $fileTmpPath = $_FILES['rdc']['tmp_name'];
                   $fileName = $_FILES['rdc']['name'];
                   $fileSize = $_FILES['rdc']['size'];
                   $fileType = $_FILES['rdc']['type'];
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
               if(isset($_FILES['iod']) && $_FILES['iod']['error'] === UPLOAD_ERR_OK) {
                   $fileTmpPath = $_FILES['iod']['tmp_name'];
                   $fileName = $_FILES['iod']['name'];
                   $fileSize = $_FILES['iod']['size'];
                   $fileType = $_FILES['iod']['type'];
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
               if(isset($_FILES['iw']) && $_FILES['iw']['error'] === UPLOAD_ERR_OK) {
                   $fileTmpPath = $_FILES['iw']['tmp_name'];
                   $fileName = $_FILES['iw']['name'];
                   $fileSize = $_FILES['iw']['size'];
                   $fileType = $_FILES['iw']['type'];
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
               if(isset($_FILES['cf']) && $_FILES['cf']['error'] === UPLOAD_ERR_OK) {
                   $fileTmpPath = $_FILES['cf']['tmp_name'];
                   $fileName = $_FILES['cf']['name'];
                   $fileSize = $_FILES['cf']['size'];
                   $fileType = $_FILES['cf']['type'];
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
               $stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Burial Indigency', CURDATE(), 'Pending', :pdf_content)");
               $stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
               $stmt->execute();
               $kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Burial Indigency'";
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
                               $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Registered Death Certificate', :image_data)");
                               $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'ID of the Deceased', :image_data1)");
                               $stmt2 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'ID of the Walker', :image_data2)");
                               $stmt3 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Contract of Funeral', :image_data3)");
                           
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
                               mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Burial Indigency request', DEFAULT)");
                               mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Burial Indigency request')");
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
                       if(isset($_POST['pao'])) {
                        $duplicatee3 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'PAO Indigency'");
    if($duplicatee3->num_rows == 0) {
                        if(isset($_FILES['idr']) && $_FILES['idr']['error'] === UPLOAD_ERR_OK) {
                           $fileTmpPath = $_FILES['idr']['tmp_name'];
                           $fileName = $_FILES['idr']['name'];
                           $fileSize = $_FILES['idr']['size'];
                           $fileType = $_FILES['idr']['type'];
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
                       if(isset($_FILES['br']) && $_FILES['br']['error'] === UPLOAD_ERR_OK) {
                           $fileTmpPath = $_FILES['br']['tmp_name'];
                           $fileName = $_FILES['br']['name'];
                           $fileSize = $_FILES['br']['size'];
                           $fileType = $_FILES['br']['type'];
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
                       if(isset($_FILES['co']) && $_FILES['co']['error'] === UPLOAD_ERR_OK) {
                           $fileTmpPath = $_FILES['co']['tmp_name'];
                           $fileName = $_FILES['co']['name'];
                           $fileSize = $_FILES['co']['size'];
                           $fileType = $_FILES['co']['type'];
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
                       
                       $db = new PDO('mysql:host=localhost;dbname=barangay', 'root', '@root123456');
                       
                       // Prepare and execute a query to insert the PDF content into the database
                       $stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'PAO Indigency', CURDATE(), 'Pending', :pdf_content)");
                       $stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
                       $stmt->execute();
                       $kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'PAO Indigency'";
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
                                       $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'ID of the Recipient', :image_data)");
                                       $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Blotter Record', :image_data1)");
                                       $stmt2 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Court Order', :image_data2)");
                                   
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
                                   
                                       // Execute statements
                                       $stmt->execute();
                                       $stmt1->execute();
                                       $stmt2->execute();
                                   
                                       mysqli_query($conn, "INSERT INTO admin_numm VALUES(NULL, 'Unchecked')");
                                       mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a PAO Indigency request', DEFAULT)");
                                       mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a PAO Indigency request')");
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
                               if(isset($_POST['educational'])) {
                                $duplicatee4 = mysqli_query($conn, "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Scholarship Indigency'");
    if($duplicatee4->num_rows == 0) {
                                if(isset($_FILES['ios']) && $_FILES['ios']['error'] === UPLOAD_ERR_OK) {
                                   $fileTmpPath = $_FILES['ios']['tmp_name'];
                                   $fileName = $_FILES['ios']['name'];
                                   $fileSize = $_FILES['ios']['size'];
                                   $fileType = $_FILES['ios']['type'];
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
                               if(isset($_FILES['re']) && $_FILES['re']['error'] === UPLOAD_ERR_OK) {
                                   $fileTmpPath = $_FILES['re']['tmp_name'];
                                   $fileName = $_FILES['re']['name'];
                                   $fileSize = $_FILES['re']['size'];
                                   $fileType = $_FILES['re']['type'];
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
                               $stmt = $db->prepare("INSERT INTO pdf_table VALUES(null, '$user_id', '$nameee', 'Scholarship Indigency', CURDATE(), 'Pending', :pdf_content)");
                               $stmt->bindParam(':pdf_content', $pdfContent, PDO::PARAM_LOB);
                               $stmt->execute();
                               $kweri = "SELECT * FROM pdf_table WHERE user_id = '$user_id' AND typee = 'Scholarship Indigency'";
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
                                               $stmt = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'ID of the Student', :image_data)");
                                               $stmt1 = $db->prepare("INSERT INTO rquirements VALUES (null, :user_id, :req_id, 'Registration of Enrollment', :image_data1)");
                                           
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
                                               mysqli_query($conn, "INSERT INTO admin_notif VALUES(NULL, '$user_id', '$req_id', '$nameee submitted a Scholarship Indigency request', DEFAULT)");
                                               mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$nameee', 'Submitted a Scholarship Indigency request')");
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