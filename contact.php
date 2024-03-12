<?php
// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $name = $_POST['name']; // The name of the sender
    $email = $_POST['email']; // The email of the sender
    $subject = $_POST['subject']; // The subject of the message
    $message = $_POST['message']; // The message body

    // Validate the form data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        // Display an error message if any field is empty
        echo "Please fill in all the fields.";
    } else {
        // Sanitize the form data
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $subject = filter_var($subject, FILTER_SANITIZE_STRING);
        $message = filter_var($message, FILTER_SANITIZE_STRING);

        // Set the recipient email address
        $to = "example@example.com"; // Change this to your own email address

        // Set the email headers
        $headers = "From: " . $name . " <" . $email . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";

        // Send the email using the mail() function
        if (mail($to, $subject, $message, $headers)) {
            // Display a success message if the email is sent
            echo "Your message has been sent. Thank you!";
        } else {
            // Display an error message if the email is not sent
            echo "There was an error sending your message. Please try again later.";
        }
    }
}
?>

<!-- Display the HTML form -->
<form action="contact.php" method="post">
    <p>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </p>
    <p>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </p>
    <p>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
    </p>
    <p>
        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="10" cols="50" required></textarea>
    </p>
    <p>
        <input type="submit" name="submit" value="Send">
    </p>
</form>
