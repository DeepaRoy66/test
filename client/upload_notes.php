<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "note_app";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO notes (title, file_path, price) VALUES (?, ?, ?)");
$stmt->bind_param("ssd", $title, $file_path, $price);

// Set parameters and execute
$title = $_POST['note_title'];
$file_path = __DIR__ . '/uploads/' . basename($_FILES['note_file']['name']);
$price = $_POST['note_price'];

// Make sure the uploads directory exists
if (!is_dir(__DIR__ . '/uploads')) {
    mkdir(__DIR__ . '/uploads', 0755, true);
}

// Move the uploaded file
if (move_uploaded_file($_FILES['note_file']['tmp_name'], $file_path)) {
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Failed to move uploaded file.";
}

$stmt->close();
$conn->close();


?>