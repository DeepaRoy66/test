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
$sql = "SELECT title, file_path, price FROM notes";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <!-- Include navigation -->
    </header>
    <div class="notes-list">
        <h2>Available Notes</h2>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='note-item'>";
                echo "<h3>" . $row["title"] . "</h3>";
                echo "<p>Price: Rs. " . $row["price"] . "</p>";
                echo "<a href='" . $row["file_path"] . "' download>Download Note</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No notes available.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
