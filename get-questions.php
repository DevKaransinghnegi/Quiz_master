<?php
$conn = new mysqli("localhost", "root", "", "quiz_system");

$quiz_id = 1;

$sql = "SELECT * FROM questions WHERE quiz_id = $quiz_id";
$result = $conn->query($sql);

$questions = [];

while ($row = $result->fetch_assoc()) {
    $questions[] = [
        "question" => $row['question_text'],
        "options" => [
            $row['option1'],
            $row['option2'],
            $row['option3'],
            $row['option4']
        ],
        "correct" => $row['correct_option'] - 1
    ];
}

echo json_encode($questions);
?>