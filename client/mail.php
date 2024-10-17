<?php
// Database credentials
$servername = "localhost"; // Replace with your server name or IP address
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "note_app"; // Replace with your MySQL database name

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Email settings
    $to = "deeparoy6622c@gmail.com"; // Replace with your email address
    $subject = "New Contact Form Submission";
    $headers = "From: " . $email . "\r\n" .
               "Reply-To: " . $email . "\r\n" .
               "X-Mailer: PHP/" . phpversion();
    
    // Message content
    $emailBody = "You have received a new message from the contact form on your website.\n\n";
    $emailBody .= "Name: $name\n";
    $emailBody .= "Email: $email\n";
    $emailBody .= "Message:\n$message\n";

    // Send the email
    $mailSent = mail($to, $subject, $emailBody, $headers);

    // Database insertion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Message sent and saved successfully!";
    } else {
        echo "Failed to save the message. Please try again later.";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
