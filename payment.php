<?php
// Start session
session_start();

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, handle accordingly (e.g., redirect to login page)
    header("Location: login.php");
    exit();
}

// User is logged in, continue processing the payment...
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

// Process payment submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST["amount"];

    // Assuming receipt is uploaded via a form, replace 'receipt' with your actual file input name
    if (!empty($_FILES["receipt"]["name"])) {
        var_dump($_FILES["receipt"]);  // Debugging line

        $receipt_attachment_name = $_FILES["receipt"]["name"];
        $receipt_attachment_tmp = $_FILES["receipt"]["tmp_name"];

        // Move uploaded file to a designated folder (you need to create this folder)
        $upload_dir = "receipts/";
        $upload_file = $upload_dir . basename($receipt_attachment_name);

        if (move_uploaded_file($receipt_attachment_tmp, $upload_file)) {
            // File successfully uploaded, now insert payment into the database
            $sql = "INSERT INTO payments (user_id, amount, receipt_attachment, status) 
                    VALUES ('$user_id', '$amount', LOAD_FILE('$upload_file'), 'pending')";

            if ($conn->query($sql) === TRUE) {
                echo "Payment submitted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: Failed to upload file.";
        }
    } else {
        // No receipt uploaded
        echo "Error: Please upload a receipt.";
    }
}

// Close the connection
$conn->close();
?>
