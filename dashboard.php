<?php
// Start session
session_start();

if (!isset($_SESSION['user_id'])) {

    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $user_id = getUserIDFromDatabase($username, $password);

    if ($user_id !== false) {
        // Store user_id in the session
        $_SESSION['user_id'] = $user_id;


        header("Location: dashboard.php");
        exit();
    } else {

        echo "Invalid username or password";
    }
}


function getUserIDFromDatabase($username, $password) {

    return 1;
}
?>

</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musanze";

$conn = new mysqli($servername, $username, $password, $dbname);

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"]; 
} else {
    $username = "Unknown";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $username; ?>!</h2>
        <h3>Payment Form</h3>
        <form action="payment.php" method="POST">
            <label for="amount">Amount:</label>
            <input type="number" name="amount" required>
            <label for="receipt">Receipt Attachment:</label>
            <input type="file" name="receipt" accept=".pdf, .jpg, .png" required>
            <button type="submit">Submit Payment</button>
        </form>

        <h3>Appeal Application</h3>
        <form action="appeal.php" method="POST">
            <label for="application_text">Appeal Text:</label>
            <textarea name="application_text" rows="4" required></textarea>
            <label for="attachment">Attachment:</label>
            <input type="file" name="attachment" accept=".pdf, .jpg, .png" required>
            <button type="submit">Submit Appeal</button>
        </form>

    </div>
</body>
</html>
