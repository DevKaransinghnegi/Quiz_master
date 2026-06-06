<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Trim inputs
    $email = strtolower(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Convert special characters (extra safety)
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

    /* =========================
       BASIC VALIDATION
    ========================== */

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: login.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid credentials.";
        header("Location: login.php");
        exit();
    }

    if (strlen($password) < 6) {
        $_SESSION['error'] = "Invalid credentials.";
        header("Location: login.php");
        exit();
    }

    /* =========================
       CHECK USER IN DATABASE
    ========================== */

    $stmt = $pdo->prepare("SELECT id, fullname, email, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['error'] = "Invalid credentials.";
        header("Location: login.php");
        exit();
    }

    /* =========================
       VERIFY PASSWORD
    ========================== */

    if (!password_verify($password, $user['password'])) {
        $_SESSION['error'] = "Invalid credentials.";
        header("Location: login.php");
        exit();
    }

    /* =========================
       LOGIN SUCCESS
    ========================== */

    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['fullname'] = $user['fullname'];
    $_SESSION['email'] = $user['email'];

    header("Location: Quiz.php");
    exit();
}