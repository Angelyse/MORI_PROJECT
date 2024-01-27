<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musanze";

$conn = new mysqli($servername, $username, $password, $dbname);
// Process HOD approval
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appeal_id = $_POST["appeal_id"];
    $hod_feedback = $_POST["hod_feedback"];
    
    // Update appeal status and add HOD feedback
    $sql = "UPDATE appeal_applications SET status='approved', hod_feedback='$hod_feedback' WHERE appeal_id='$appeal_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Appeal approved!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
