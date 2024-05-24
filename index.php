<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: hyperlinks/dashboard.php");
    exit();
}
if(isset($_SESSION['admin_id'])) {
    header("Location: hyperlinks/admin_dashboard.php");
    exit();
}
$msg = '';
$login_attempts_max = 5; // Maximum number of login attempts
$login_attempts_interval = 300; // 5 minutes in seconds

// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if session variables are set
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 1;
        $_SESSION['last_attempt_time'] = time();
    } else {
        // Check if last attempt was more than 5 minutes ago
        if (time() - $_SESSION['last_attempt_time'] > $login_attempts_interval) {
            $_SESSION['login_attempts'] = 1;
            $_SESSION['last_attempt_time'] = time();
        }
        // Increment login attempts
        $_SESSION['login_attempts']++;
    }

    // Check if login attempts exceed the maximum
    if ($_SESSION['login_attempts'] > $login_attempts_max) {
        // Display message or handle action when login attempts reach limit
        $msg = "You have reached the maximum number of login attempts. Try again after 5 minutes";
        // Additional action can include locking the account or using CAPTCHA
    } else {
        if(isset($_POST['submit'])) {
            require('php/connection.php');
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $acc = "SELECT * FROM userr WHERE email = '$email'";
            $sqlAcc = mysqli_query($conn, $acc);
            $user = $sqlAcc->fetch_assoc();
            $acc1 = "SELECT * FROM adminn WHERE id_num = '$email'";
            $sqlAcc1 = mysqli_query($conn, $acc1);
            $user1 = $sqlAcc1->fetch_assoc();
            if($sqlAcc->num_rows == 1) {
                if($password == $user['passwordd']) {
                    $user_id = $user['id'];
                    $admin_id = $user['id'];
                    $_SESSION['user_id'] = $user['id'];
                    $kweri = "SELECT * FROM infos WHERE user_id = '$user_id'";
                    $kweried = mysqli_query($conn, $kweri);
                    $kwerieded = $kweried->fetch_assoc();
                    $name = $kwerieded['full_name'];
                    mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$user_id', DEFAULT, '$name', 'Logged In')");
                    mysqli_query($conn, "DELETE FROM audit WHERE created_at < NOW() - INTERVAL 3 DAY");
                    $currentDate = date("Y-m-d");
$kweriii = mysqli_query($conn, "SELECT * FROM loginCount WHERE created_at = '$currentDate'");

if(mysqli_num_rows($kweriii) > 0) {
    $loginCount = $kweriii->fetch_assoc();
    $addddd = $loginCount['logCount'] + 1;
    mysqli_query($conn, "UPDATE loginCount SET logCount = '$addddd' WHERE created_at = '$currentDate'");
} else {
    mysqli_query($conn, "INSERT INTO loginCount (logCount, created_at) VALUES (1, CURDATE())");
}

                    
                    header("Location: hyperlinks/dashboard.php");
                } else {
                    $msg = 'Wrong username or password';
                }
            }
            elseif ($sqlAcc1->num_rows == 1) {
                if($password == $user1['passwordd']) {
                    $_SESSION['admin_id'] = $user1['id'];
                    mysqli_query($conn, "INSERT INTO audit VALUES(NULL, '$admin_id', DEFAULT, 'Admin', 'Logged In')");
                    header("Location: hyperlinks/admin_dashboard.php");
                } else {
                    $msg = 'Wrong username or password';
                }
            }
            else {
                $msg = 'Wrong username or password';
            }
        }
    }

}
?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/login.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body style="overflow: hidden;">
    <center>
        <div id="full">
            <div id="full2">
                <div id="first">
                    <img src="images/new_icon.png" id="image1">
                    <h1>Barangay 177</h1>
                    <h1>Maria Luisa</h1>
                </div>
                <div id="second">
                    <div id="third">
                        <h1 id="head">Log in</h1>
                        <form name="form" action="index.php" method="post">
                            <input type="text" placeholder="Email" name="email" class="input1" id="input1" required>
                            <br>
                            <br>
                            <input type="password" placeholder="Password" name="pass" class="input1" id="input2" required>
                            <p style="color: red; margin-top: 0px; "><?php echo $msg ?></p>
                            <a href="hyperlinks/forgotPassword.html" id="firstLink">Forgot password?</a>
                            <br>
                            <input type="submit" value="Login" name="submit" id="button">
                        </form>
                    </div>
                    <p id="last">Don't have an account? <a href="hyperlinks/createAccount.html">Sign up</a></p>
                </div>
            </div>
        </div>
    </center>
    <script src="javascript/login.js">

    </script>
    </body>
</html>