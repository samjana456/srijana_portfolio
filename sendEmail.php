<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form inputs
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    // Ensure all fields are filled
    if (!$name || !$email || !$message) {
        echo "<p>All fields are required. Please fill in the form correctly.</p>";
        exit;
    }

    // Email recipient
    $to = "samjanalama4262@gmail.com";  // Replace with your email address
    $subject = "New Message from " . $name;

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Enable SMTP debugging (for testing on your .np domain)
        $mail->SMTPDebug = 2;  // Set to 0 for production use

        // Server settings
        $mail->isSMTP();                                  // Use SMTP
        $mail->Host = 'smtp.gmail.com';                   // Set Gmail SMTP server
        $mail->SMTPAuth = true;                           // Enable SMTP authentication
        $mail->Username = 'samjanalama4262@gmail.com';    // Gmail address
        $mail->Password = 'jsjr vwwh tbzv ftcd';          // Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);  // Sender's email and name
        $mail->addAddress($to);         // Recipient's email

        // Email content
        $mail->isHTML(true);  // Use HTML format
        $mail->Subject = $subject;
        $mail->Body    = "<h2>New Message from: " . $name . "</h2>
                          <p><strong>Email:</strong> " . $email . "</p>
                          <p><strong>Message:</strong><br>" . nl2br($message) . "</p>";

        //
        $mail->send();
        echo "<p>Your message has been sent successfully!</p>";
    } catch (Exception $e) {
        echo "<p>Sorry, something went wrong. Please try again later. Error: " . $mail->ErrorInfo . "</p>";
    }
}
?>