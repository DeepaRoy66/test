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

// Get the note ID from the request
$data = json_decode(file_get_contents("php://input"), true);
$noteId = $data['id'];

// Prepare the delete statement
$stmt = $conn->prepare("DELETE FROM notes WHERE id = ?");
if (!$stmt) {
    error_log("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    echo "error";
    exit();
}

$stmt->bind_param("i", $noteId);

// Execute the statement
if ($stmt->execute()) {
    echo "success";
} else {
    error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    echo "error";
}

$stmt->close();
$conn->close();
?>
