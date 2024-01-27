<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musanze";

$conn = new mysqli($servername, $username, $password, $dbname);
// Process finance approval
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_id = $_POST["payment_id"];
    
    // Update payment status to approved
    $sql = "UPDATE payments SET status='approved' WHERE payment_id='$payment_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Payment approved!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
