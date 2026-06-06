<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link rel="stylesheet" href="quiz-details.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="quiz-wrapper">

    <div class="back-link">
        ← <a href="Quiz.php">Back to Dashboard</a>
    </div>

    <div class="quiz-header-box">
        <div>
            <h2>JavaScript Fundamentals</h2>
            <p id="questionCounter">Question 1 of 5</p>
        </div>

        <div class="timer">
            ⏱ <span id="time">10:00</span>
        </div>
    </div>

    <div class="progress-bar">
        <div class="progress-fill" id="progressFill"></div>
    </div>

    <div class="question-box">
        <h3 id="questionText"></h3>
        <div id="optionsContainer"></div>
    </div>

    <div class="bottom-nav">
        <button class="prev-btn" id="prevBtn">Previous</button>

        <div class="question-numbers" id="questionNumbers"></div>

        <button class="next-btn" id="nextBtn" disabled>Next</button>
    </div>

</div>

<script src="quiz.js"></script>
</body>
</html>