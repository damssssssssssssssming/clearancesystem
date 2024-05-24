<?php
// Check if form is submitted
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    // Check if file is selected
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        
        // Check file extension
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(in_array($fileExtension, $allowedExtensions)) {
            // Directory where images will be saved
            $uploadDir = '../imagess/';
            $destPath = $uploadDir . $fileName;

            // Move the uploaded file to the destination directory
            if(move_uploaded_file($fileTmpPath, $destPath)) {
                // Insert the image data into the database
                $dbHost = 'localhost';
                $dbName = 'barangay';
                $dbUsername = 'root';
                $dbPassword = '@root123456';

                try {
                    // Create a PDO connection
                    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Prepare SQL statement
                    $stmt = $db->prepare("INSERT INTO images VALUES (null, 1, '$name', :image_data)");

                    // Bind parameters
                    $imageData = file_get_contents($destPath); // Get binary data of the image
                    $stmt->bindParam(':image_data', $imageData, PDO::PARAM_LOB);

                    // Execute statement
                    $stmt->execute();

                    header("Location: ../hyperlinks/admin_dashboard.php");
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

                // Close the database connection
                $db = null;
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG and GIF types are allowed.";
        }
    } else {
        echo "No file selected.";
    }
}
?>
