<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musanze";

$conn = new mysqli($servername, $username, $password, $dbname);
// Fetch pending appeals from the database
$sql = "SELECT * FROM appeal_applications WHERE status = 'pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Pending Appeals</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>Appeal ID: " . $row["appeal_id"] . " - Student ID: " . $row["student_id"] . "</li>";
        // Include buttons for HOD approval
        echo "<form action='hod_approval.php' method='POST'>";
        echo "<input type='hidden' name='appeal_id' value='" . $row["appeal_id"] . "'>";
        echo "<label for='hod_feedback'>HOD Feedback:</label>";
        echo "<input type='text' name='hod_feedback' required>";
        echo "<button type='submit'>Approve Appeal</button>";
        echo "</form>";
    }
    echo "</ul>";
} else {
    echo "<p>No pending appeals.</p>";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Display pending appeals -->
    </div>
</body>
</html>
