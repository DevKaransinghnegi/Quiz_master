<?php

$host = "localhost";
$dbname = "quiz_system";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
$conn = new mysqli("localhost", "root", "", "quiz_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}