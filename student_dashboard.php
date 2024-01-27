<?php
// Start session
session_start();

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, handle accordingly (e.g., redirect to login page)
    header("Location: login.php");
    exit();
}

// User is logged in, set $student_id
$student_id = $_SESSION['user_id'];

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

// Query to retrieve appeal applications for the student
$result = $conn->query("SELECT * FROM appeal_applications WHERE user_id = $student_id");

// Process the result...

// Close the connection
$conn->close();
?>
