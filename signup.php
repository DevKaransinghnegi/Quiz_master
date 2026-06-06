<?php
session_start();

if (isset($_SESSION['error'])) {
    echo "<div style='color:red; text-align:center; margin-bottom:15px;'>"
        . $_SESSION['error'] .
        "</div>";
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link href="https://api.fontshare.com/v2/css?f[]=chillax@600,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Chillax',sans-serif; }

        body {
            background:white;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .card {
            width:400px;
            background:white;
            padding:35px;
            border-radius:5px;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
            text-align:center;
        }

        .icon-circle {
            width:60px;
            height:60px;
            background:#002455;
            border-radius:50%;
            display:flex;
            justify-content:center;
            align-items:center;
            margin:0 auto 20px;
            color:white;
            font-size:22px;
        }

        h2 { font-weight:600; margin-bottom:8px; }

        .subtitle {
            color:gray;
            margin-bottom:25px;
            font-size:14px;
        }

        form { text-align:left; }

        label {
            font-size:14px;
            margin-bottom:5px;
            display:block;
        }

        input {
            width:100%;
            padding:10px;
            margin-bottom:15px;
            border-radius:5px;
            border:1px solid #ddd;
            background:#f9f9f9;
            font-size:14px;
            transition:0.3s;
        }

        input:focus {
            border-color:#002455;
            outline:none;
            background:white;
        }

        button {
            width:100%;
            padding:10px;
            background:black;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
            font-size:15px;
            transition:0.3s;
        }

        button:hover { transform:translateY(-2px); }

        .login-link {
            text-align:center;
            margin-top:15px;
            font-size:14px;
        }

        .login-link a {
            color:blue;
            text-decoration:none;
        }

        .login-link a:hover {
            text-decoration:underline;
        }

        @media(max-width:500px){
            .card{ width:90%; }
        }
    </style>
</head>

<body>

<div class="card">

    <div class="icon-circle">
        <i class="fa-solid fa-book"></i>
    </div>

    <h2>Create Account</h2>
    <p class="subtitle">Register for your quiz account</p>

    <form method="POST" action="signup_proces.php">

        <label>Full Name</label>
        <input type="text" name="fullname" placeholder="Enter your name" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Minimum 6 characters" minlength="6" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="Re-enter your password" minlength="6" required>

        <button type="submit">Register</button>

    </form>

    <div class="login-link">
        Already have an account? <a href="login.php">Login here</a>
    </div>

</div>

</body>
</html>