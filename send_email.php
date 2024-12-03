<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Hardcoding Gmail credentials (Not recommended for production)
$mailUsername = 'samjanalama4262@gmail.com';  // Your Gmail address
$mailPassword = 'mqan ljhk xaos dgph';       // Your Gmail App password

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Basic form validation
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required!";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // PHPMailer setup
    $mail = new PHPMailer(true);

    try {
        // Enable debugging for troubleshooting (optional, remove in production)
        $mail->SMTPDebug = 2; // Debug level: 2 = full debug output
        $mail->Debugoutput = 'html';

        // Server settings
        $mail->isSMTP();                                      // Use SMTP
        $mail->Host       = 'smtp.gmail.com';                 // SMTP server (Gmail example)
        $mail->SMTPAuth   = true;                             // Enable SMTP authentication
        $mail->Username   = $mailUsername;                    // Your Gmail address
        $mail->Password   = $mailPassword;                    // Your Gmail App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption
        $mail->Port       = 587;                              // TCP port for TLS

        // Recipients
        $mail->setFrom($mailUsername, 'Your Name');           // Sender's email (Your Gmail)
        $mail->addAddress('samjanalama4262@gmail.com');       // Receiver's email (where you'll get messages)

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong></p>
            <p>$message</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message"; // Plain-text fallback

        // Send email
        if ($mail->send()) {
            echo 'Message sent successfully!';
        } else {
            echo 'Message could not be sent.';
        }

    } catch (Exception $e) {
        // Handle errors and display them
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
