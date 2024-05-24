<?php
require("../php/connection.php");
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');
require('PHPMailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST['submit'])) {
        $email = $_POST['email'];
        $mail = new PHPMailer(true);
        $verificationCode = rand(00000, 99999);
        try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'marcakes24@gmail.com';
        $mail->Password = 'mxwh qvfz yiin dtdz';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Changed to ENCRYPTION_SMTPS
        $mail->Port = 465; // Changed port for SSL
        $mail->setFrom('marcakes24@gmail.com');
        $mail->addAddress($email, 'Marcakes');
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = '<p>Your verification code is: <br><h1>' . $verificationCode . '</h1></p>';
        $mail->send();
        $kweri1 = "SELECT * FROM userr WHERE email = '$email'";
        $kweried1 = mysqli_query($conn, $kweri1);
        $kwerieded = $kweried1->fetch_assoc();
        $user_id = $kwerieded['id'];
        $kweri = "INSERT INTO verify VALUES(NULL, '$user_id', '$verificationCode', DEFAULT)";
        $kweri2 = "DELETE FROM verify WHERE created_at < NOW() - INTERVAL 5 MINUTE";
        $kweried = mysqli_query($conn, $kweri);
        mysqli_query($conn, $kweri2);
        if(isset($kweried)) {
            session_start();
            $_SESSION['email'] = $email;
            header("Location: ../hyperlinks/forgotPassword.html");
        }
    } catch (Exception $e) {
        echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
}
?>