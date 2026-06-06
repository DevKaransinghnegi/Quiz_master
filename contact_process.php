<?php
require 'db.php';

require 'PHPMailer-master/src/Exception.php';
require 'phpMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$messageStatus = "";
$messageType = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $messageStatus = "All fields are required!";
        $messageType = "error";
    } else {

        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'karansn479@gmail.com';
            $mail->Password = 'cqksycxmqoybgpps';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('karansn479@gmail.com', 'Contact System');
            $mail->addAddress('karansinghnegi955@gmail.com');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = "
                <h3>New Contact Message</h3>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Message:</strong><br>$message</p>
            ";

            $mail->send();

            $messageStatus = "Message sent successfully!";
            $messageType = "success";

        } catch (Exception $e) {
            $messageStatus = "Message saved but email failed!";
            $messageType = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Contact Status</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.message-box {
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    width: 400px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.success {
    background: #e6f9f0;
    border: 1px solid #28a745;
    color: #155724;
}

.error {
    background: #fdecea;
    border: 1px solid #dc3545;
    color: #721c24;
}

a {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    background: #111;
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
}
a:hover {
    box-shadow: 0 0 15px rgba(106, 13, 173, 0.6);
}
</style>
</head>
<body>

<div class="message-box <?php echo $messageType; ?>">
    <h2><?php echo $messageStatus; ?></h2>
    <a href="contact.php">Go Back</a>
</div>

</body>
</html>