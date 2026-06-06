<?php
session_start();
require 'db.php'; // your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $quiz_id = $_POST['quiz_id'];
    $score = $_POST['score'];
    $total = $_POST['total'];
    $percentage = $_POST['percentage'];
    $quiz_title = $_POST['quiz_title'];

    $status = ($percentage >= 50) ? "Passed" : "Failed";
    $statusClass = ($percentage >= 50) ? "passed" : "failed";

    // Save into database
    $stmt = $conn->prepare("INSERT INTO quiz_results 
        (user_id, quiz_id, score, total_questions, percentage) 
        VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("iiiii", $user_id, $quiz_id, $score, $total, $percentage);
    $stmt->execute();
    $stmt->close();

} else {
    header("Location: Quiz.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Result</title>
    <link rel="stylesheet" href="score.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="result-wrapper">
    <div class="result-card">

        <div class="icon">🏆</div>

        <h1><?php echo $quiz_title; ?></h1>

        <p class="message">
            <?php echo ($status == "Passed") ? "Great Job!" : "Keep Practicing!"; ?>
        </p>

        <div class="score-container">

            <div class="score-box">
                <p>Your Score</p>
                <h2><?php echo $score . "/" . $total; ?></h2>
            </div>

            <div class="score-box">
                <p>Percentage</p>
                <h2><?php echo $percentage; ?>%</h2>
            </div>

            <div class="score-box">
                <p>Status</p>
                <h2 class="<?php echo $statusClass; ?>">
                    <?php echo $status; ?>
                </h2>
            </div>

        </div>

        <div class="buttons">
            <a href="Quiz.php" class="back-btn">🏠 Back to Dashboard</a>
            <a href="quiz-details.php?id=1" class="retake-btn">🔄 Retake Quiz</a>
        </div>

    </div>
</div>

</body>
</html>