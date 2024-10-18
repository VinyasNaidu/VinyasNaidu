<?php
  $receiving_email_address = 'vemula.gi@northeastern.edu';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    if (empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($message)) {
        // Handle error - input validation failed
        echo "Please fill in all fields correctly.";
        exit;
    }

    // Your email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Headers
    $headers = "From: $name <$email>";

    // Send the email
    if (mail($receiving_email_address, "$subject - Received from Portfolio", $email_content, $headers)) {
        // Success
        echo "Thank You! Your message has been sent.";
    } else {
        // Fail
        echo "Oops! Something went wrong, we couldn't send your message.";
    }
  } else {
    // Not a POST request
    echo "Oops! Something went wrong.";
  }
?>
