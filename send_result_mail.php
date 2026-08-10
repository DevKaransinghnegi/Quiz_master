<?php
session_start();
header('Content-Type: application/json');

require 'db.php';

// PHPMailer फाइलों को शामिल करें (आपके PHPMailer-master फोल्डर के अनुसार)
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// 1. यूज़र लॉगिन चेक करें
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id    = $_SESSION['user_id'];
    $quiz_title = $_POST['quiz_title'] ?? 'Quiz';
    $score      = $_POST['score'] ?? '0';
    $total      = $_POST['total'] ?? '0';
    $percentage = $_POST['percentage'] ?? '0';
    $status     = $_POST['status'] ?? 'N/A';

    // 2. Database से User का Full Name और Email फ़ेच करना
    $stmt = $conn->prepare("SELECT fullname, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $userName  = $row['fullname']; // आपके DB कॉलम का नाम 'fullname' है
        $userEmail = $row['email'];
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User details not found in database.']);
        exit();
    }
    $stmt->close();

    // 3. PHPMailer सेटअप और ईमेल सेंडिंग
    $mail = new PHPMailer(true);

    try {
        // SMTP सेटिंग्स
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        
        // ⚠️ यहाँ अपनी ओनर की डिटेल्स डालें
        $mail->Username   = 'manshow917@gmail.com';      // ओनर का Gmail
        $mail->Password   = 'bckroqcvbozfrtfp'; // Gmail App Password
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender Header (ओनर की ईमेल और साइट का नाम)
        $mail->setFrom('manshow917@gmail.com', 'Online Quiz System');
        
        // Recipient (डेटाबेस से मिला यूजर का नाम और ईमेल)
        $mail->addAddress($userEmail, $userName); 

        // HTML Content
        $mail->isHTML(true);
        $mail->Subject = "Quiz Result: " . $quiz_title;
        
        $statusColor = ($status === 'Passed') ? '#22c55e' : '#ff4d4d';

        $mail->Body = "
            <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-radius: 10px; padding: 20px;'>
                <h2 style='color: #0f172a; text-align: center;'>🏆 {$quiz_title} Result</h2>
                <p>Hello <strong>{$userName}</strong>,</p>
                <p>Here is your result breakdown for the quiz you performed:</p>
                
                <table style='width: 100%; border-collapse: collapse; margin-top: 15px;'>
                    <tr style='background-color: #f8fafc;'>
                        <td style='padding: 10px; border: 1px solid #ddd;'><strong>Score</strong></td>
                        <td style='padding: 10px; border: 1px solid #ddd;'>{$score} / {$total}</td>
                    </tr>
                    <tr>
                        <td style='padding: 10px; border: 1px solid #ddd;'><strong>Percentage</strong></td>
                        <td style='padding: 10px; border: 1px solid #ddd;'>{$percentage}%</td>
                    </tr>
                    <tr style='background-color: #f8fafc;'>
                        <td style='padding: 10px; border: 1px solid #ddd;'><strong>Status</strong></td>
                        <td style='padding: 10px; border: 1px solid #ddd; color: {$statusColor}; font-weight: bold;'>{$status}</td>
                    </tr>
                </table>
                
                <br>
                <p style='color: #666; font-size: 13px; text-align: center;'>Keep learning and testing your knowledge!</p>
            </div>
        ";

        $mail->send();
        echo json_encode(['status' => 'success', 'message' => 'Result successfully sent to your email!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid Request Method.']);
}
?>