<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Email setup
    $to = 'samjanalama4262@gmail.com'; // Replace with your email address
    $subject = 'New Contact Form Submission';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $body = "Name: $name\nEmail: $email\nMessage: $message";

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        echo "Your message has been sent successfully.";
    } else {
        echo "There was an error sending your message.";
    }
} else {
    echo "Invalid request.";
}
?>
