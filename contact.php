<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us</title>
<link rel="stylesheet" href="contact.css">
</head>
<body>
<div id="responseMessage" class="response-message"></div>
<section class="contact-section">
    <div class="contact-card">
        <h2>Get in <span>Touch</span></h2>
        <p class="subtitle">
            Have a question or feedback? We'd love to hear from you.
        </p>

<form action="contact_process.php" method="POST">

            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email Address *</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Subject *</label>
                <input type="text" name="subject" required>
            </div>

            <div class="form-group">
                <label>Message *</label>
                <textarea name="message" rows="5" required></textarea>
            </div>

        <div id="responseMessage" class="response-message"></div>

<button type="submit" class="btn-submit">
    Send Message
</button>

        </form>
    </div>
</section>

<script src="contact.js"></script>
</body>
</html>