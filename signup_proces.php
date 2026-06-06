<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Trim inputs
    $fullname = trim($_POST['fullname']);
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Convert special characters (extra safety)
    $fullname = htmlspecialchars($fullname, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

    /* =========================
       FULL NAME VALIDATION
    ========================== */

    if (strlen($fullname) < 20 || strlen($fullname) > 100) {
        $_SESSION['error'] = "Full name must be between 20 and 100 characters.";
        header("Location: signup.php");
        exit();
    }

    if (!preg_match("/^[a-zA-Z0-9 ]+$/", $fullname)) {
        $_SESSION['error'] = "Full name can contain only letters, numbers and spaces.";
        header("Location: signup.php");
        exit();
    }

    /* =========================
       EMAIL VALIDATION
    ========================== */

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: signup.php");
        exit();
    }

    /* =========================
       PASSWORD VALIDATION
    ========================== */

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters.";
        header("Location: signup.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: signup.php");
        exit();
    }

    /* =========================
       CHECK DUPLICATE EMAIL
    ========================== */

    $check = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $_SESSION['error'] = "Email already registered.";
        header("Location: signup.php");
        exit();
    }

    /* =========================
       INSERT USER
    ========================== */

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$fullname, $email, $hashed_password]);

    $_SESSION['success'] = "Account created successfully. Please login.";
    header("Location: login.php");
    exit();
}