<?php
session_start();

if (isset($_SESSION['success'])) {
    echo "<div style='color:green; text-align:center; margin-bottom:15px;'>"
        . $_SESSION['success'] .
        "</div>";
    unset($_SESSION['success']);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Quiz Master</title>

<!-- Chillax Font -->
<link href="https://api.fontshare.com/v2/css?f[]=chillax@400,500,600,700&display=swap" rel="stylesheet">

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="login.css">
</head>
<body>

<div class="login-wrapper">
    <div class="login-card">

        <div class="icon-circle">
            <i class="fa-solid fa-book-open"></i>
        </div>

        <h2 class="login-title">Welcome Back</h2>
        <p class="login-subtitle">Login to your quiz account</p>

        <form method="POST" action="login_process.php">

            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <button type="submit" class="login-btn">Login</button>

        </form>

        <p class="register-text">
            Don't have an account?
            <a href="signup.php">Register here</a>
        </p>

    </div>
</div>

</body>
</html>