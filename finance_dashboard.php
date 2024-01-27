<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musanze";

$conn = new mysqli($servername, $username, $password, $dbname);

// Fetch pending payments from the database
$sql = "SELECT * FROM payments WHERE status = 'pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Pending Payments</h2>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>Payment ID: " . $row["payment_id"] . " - Amount: $" . $row["amount"] . "</li>";
        // Include buttons for finance approval
        echo "<form action='finance_approval.php' method='POST'>";
        echo "<input type='hidden' name='payment_id' value='" . $row["payment_id"] . "'>";
        echo "<button type='submit'>Approve Payment</button>";
        echo "</form>";
    }
    echo "</ul>";
} else {
    echo "<p>No pending payments.</p>";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Display pending payments -->
    </div>
</body>
</html>
