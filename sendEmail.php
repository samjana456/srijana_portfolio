<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Include the Composer autoloader if using Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Email recipient (your email address)
    $to = "samjanalama4262@gmail.com";  // Replace with your email address
    $subject = "New Message from " . $name;

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP(); // Use SMTP
        $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to Gmail
        $mail->SMTPAuth = true;   // Enable SMTP authentication
        $mail->Username = 'samjanalama4262@gmail.com';  // Gmail email address
        $mail->Password = 'jsjr vwwh tbzv ftcd';  // Gmail app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom($email, $name);  // From email and name
        $mail->addAddress($to);  // To email

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "<h2>New Message from: " . $name . "</h2>
                          <p><strong>Email:</strong> " . $email . "</p>
                          <p><strong>Message:</strong><br>" . nl2br($message) . "</p>";

        // Send the email
        $mail->send();
        echo "<p>Your message has been sent successfully!</p>";
    } catch (Exception $e) {
        echo "<p>Sorry, something went wrong. Please try again later. Error: " . $mail->ErrorInfo . "</p>";
    }
}
?>

