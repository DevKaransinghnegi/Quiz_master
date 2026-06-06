<?php
session_start();

// Security check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Logout logic
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$fullname = $_SESSION['fullname']; // Only name stored
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Dashboard</title>

    <link href="https://api.fontshare.com/v2/css?f[]=chillax@400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Chillax', sans-serif;
        }

        body{
            background:#f5f5f5;
        }

        /* Header */
        .header{
            width:100%;
            height:80px;
            background:white;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 40px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        /* Left Section */
        .left-section{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .logo-box{
            width:50px;
            height:50px;
            background:#5B4BFF;
            border-radius:15px;
            display:flex;
            align-items:center;
            justify-content:center;
            color:white;
            font-size:20px;
        }

        .title-box h2{
            font-weight:600;
            font-size:20px;
        }

        .welcome{
            font-size:14px;
            color:gray;
            margin-top:3px;
        }

        /* Logout Button */
        .logout-btn{
            display:flex;
            align-items:center;
            gap:8px;
            padding:8px 18px;
            border-radius:8px;
            border:1px solid #ddd;
            background:white;
            cursor:pointer;
            font-weight:500;
            text-decoration:none;
            color:black;
            transition:0.3s;
        }

        .logout-btn:hover{
            background:#f2f2f2;
            transform:translateY(-2px);
        }

        /* =========================
   MOBILE RESPONSIVE
========================= */

@media (max-width: 768px) {

    .header {
        padding: 0 15px;
        height: 70px;
    }

    .logo-box {
        width: 40px;
        height: 40px;
        font-size: 16px;
        border-radius: 12px;
    }

    .title-box h2 {
        font-size: 16px;
    }

    .welcome {
        font-size: 12px;
    }

    .logout-btn {
        padding: 6px 12px;
        font-size: 13px;
        gap: 5px;
    }
}
body {
    font-family: Arial, sans-serif;
    background-color: #f3f4f6;
    margin: 0;
    padding: 0;
}

.quiz-section {
    padding: 40px 80px;
}

.section-title {
    font-size: 32px;
    margin-bottom: 30px;
}

.quiz-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.quiz-card {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    transition: 0.3s ease;
}

.quiz-card:hover {
    transform: translateY(-5px);
}

.quiz-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.quiz-header h2 {
    font-size: 20px;
    margin: 0;
}

.badge {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
}

.easy {
    background-color: #d1fae5;
    color: #065f46;
}

.medium {
    background-color: #fef3c7;
    color: #92400e;
}

.hard {
    background-color: #fee2e2;
    color: #991b1b;
}

.quiz-description {
    margin: 15px 0;
    color: #555;
}

.quiz-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    color: #666;
    font-size: 14px;
}

.category {
    display: inline-block;
    background: #e5e7eb;
    padding: 5px 10px;
    border-radius: 10px;
    font-size: 12px;
    margin-bottom: 20px;
}

.start-btn {
    display: block;
    text-align: center;
    background: #0f172a;
    color: white;
    padding: 12px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}

.start-btn:hover {
    background: #1e293b;
}

/* Responsive */

@media (max-width: 1024px) {
    .quiz-container {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .quiz-container {
        grid-template-columns: 1fr;
    }

    .quiz-section {
        padding: 30px;
    }
}

    </style>
</head>

<body>

<div class="header">

    <div class="left-section">
        <div class="logo-box">
            <i class="fa-solid fa-book"></i>
        </div>

        <div class="title-box">
            <h2>Quiz Master</h2>
            <div class="welcome">
                Welcome, <?php echo htmlspecialchars($fullname); ?>
            </div>
        </div>
    </div>

    <a href="?logout=true" class="logout-btn">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        Logout
    </a>

</div>
<section class="quiz-section">
    <h1 class="section-title">Available Quizzes</h1>

    <div class="quiz-container">

        <!-- Quiz Card 1 -->
        <div class="quiz-card">
            <div class="quiz-header">
                <h2>JavaScript Fundamentals</h2>
                <span class="badge easy">Easy</span>
            </div>

            <p class="quiz-description">
                Test your knowledge of basic JavaScript concepts
            </p>

            <div class="quiz-info">
                <span>📘 5 Questions</span>
                <!-- <span>⏱ 10 Minutes</span> -->
            </div>

            <span class="category">Programming</span>

            <a href="quiz-details.php?id=1" class="start-btn">Start Quiz</a>
        </div>

        <!-- Quiz Card 2 -->
        <div class="quiz-card">
            <div class="quiz-header">
                <h2>React Basics</h2>
                <span class="badge medium">Medium</span>
            </div>

            <p class="quiz-description">
                Evaluate your understanding of React Basic
            </p>

            <div class="quiz-info">
                <span>📘 5 Questions</span>
                <!-- <span>⏱ 15 Minutes</span> -->
            </div>

            <span class="category">Programming</span>

            <a href="quiz-details.php?id=2" class="start-btn">Start Quiz</a>
        </div>

        <!-- Quiz Card 3 -->
        <div class="quiz-card">
            <div class="quiz-header">
                <h2>Python Basics</h2>
                <span class="badge hard">Hard</span>
            </div>

            <p class="quiz-description">
                Check your understanding of Python 
            </p>

            <div class="quiz-info">
                <span>📘 5 Questions</span>
                <!-- <span>⏱ 20 Minutes</span> -->
            </div>

            <span class="category">Programming</span>

            <a href="quiz-details.php?id=3" class="start-btn">Start Quiz</a>
        </div>

    </div>
</section>
</body>
</html>