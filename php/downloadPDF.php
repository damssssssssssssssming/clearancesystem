<?php
$id = $_POST['h'];
// Connect to the database (replace with your database credentials)
$db = new PDO('mysql:host=localhost;dbname=barangay', 'root', '@root123456');

// Retrieve the PDF content from the database
$stmt = $db->query("SELECT pdf_content FROM pdf_table WHERE id = '$id'");
$pdfContent = $stmt->fetchColumn();

// Close the database connection
$db = null;

// Set appropriate headers for PDF download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="downloaded.pdf"');

// Output the PDF content
echo $pdfContent;

?>