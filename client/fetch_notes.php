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

// Fetch notes from the database
$sql = "SELECT id, title, file_path, price FROM notes";
$result = $conn->query($sql);

$notes = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

echo json_encode($notes);

$conn->close();
?>
