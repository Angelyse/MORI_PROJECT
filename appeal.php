<?php
// Start session
session_start();

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, handle accordingly (e.g., redirect to login page)
    header("Location: login.php");
    exit();
}

// User is logged in, continue processing the appeal...
$user_id = $_SESSION['user_id'];

// Connect to the database (replace with your actual database connection code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musanze";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process appeal submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (!isset($_FILES["attachment"])) {
        die("Attachment file not uploaded."); 
    }

    $attachment = $_FILES["attachment"]["name"];

    $upload_dir = "appeal_attachments/";
    $upload_file = $upload_dir . basename($attachment);

    move_uploaded_file($_FILES["attachment"]["tmp_name"], $upload_file);

    // Insert appeal into the database
    $sql = "INSERT INTO appeal_applications (user_id, attachment, status) 
            VALUES ('$user_id', '$attachment', 'pending')";

    if ($conn->query($sql) === TRUE) {
        echo "Appeal submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
