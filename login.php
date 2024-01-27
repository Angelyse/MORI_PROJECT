<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musanze";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username and password (replace with your authentication logic)
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Assuming a successful authentication, retrieve user_id from the database
    $user_id = getUserIDFromDatabase($username, $password);

    if ($user_id !== false) {
        // Store user_id in the session
        $_SESSION['user_id'] = $user_id;

        // Redirect to the dashboard or home page
        header("Location: dashboard.php");
        exit();
    } else {
        // Authentication failed, display an error message or redirect to the login page
        echo "Invalid username or password";
    }
}

// Function to retrieve user_id from the database (replace with your actual database logic)
function getUserIDFromDatabase($username, $password) {

    return 1;
}

// Process login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate user
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Valid user, redirect to dashboard
        header("Location: dashboard.php");
    } else {
        // Invalid user, display error
        echo "Invalid username or password";
    }
}
// Start session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Redirect to the dashboard or home page
    header("Location: dashboard.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username and password (replace with your authentication logic)
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Authenticate the user (you should perform proper password hashing and validation)
    if ($username == "your_username" && $password == "your_password") {
        // Dummy user ID for illustration purposes, replace with your actual user ID
        $user_id = 1;

        // Store user ID in the session
        $_SESSION['user_id'] = $user_id;

        // Redirect to the dashboard or home page
        header("Location: dashboard.php");
        exit();
    } else {
        // Authentication failed, display an error message or redirect to the login page
        echo "Invalid username or password";
    }
}
?>

