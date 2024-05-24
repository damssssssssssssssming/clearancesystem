<?php
$id = $_POST['h'];

$db = new PDO('mysql:host=localhost;dbname=barangay', 'root', '@root123456');

$stmt = $db->query("SELECT requirements FROM rquirements WHERE id = '$id'");
$imageData = $stmt->fetchColumn();

$db = null;

header('Content-Type: image/jpeg');
header('Content-Disposition: attachment; filename="downloaded.jpg"');

echo $imageData;
?>