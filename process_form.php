<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $send_copy = isset($_POST["send_copy"]);

    // Validate email (you should add more validation as needed)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit; // Terminate script
    }

    // Email details
    $to = "sarsah4@gmail.com"; // Your email address
    $subject = "Contact Form Submission";
    $headers = "From: $email\r\n";
    $message_body = "Name: $name\nEmail: $email\nMessage: $message";

    if ($send_copy) {
        // Send a copy of the message to the user
        $user_subject = "Copy of Your Contact Form Submission";
        mail($email, $user_subject, $message_body, $headers);
    }

    // Send the message to your email
    if (mail($to, $subject, $message_body, $headers)) {
        // Email sent successfully, redirect to thank you page
        header("Location: thank_you.html");
        exit;
    } else {
        // Error occurred while sending the email
        echo "Oops! Something went wrong. Please try again later.";
    }
}
?>
