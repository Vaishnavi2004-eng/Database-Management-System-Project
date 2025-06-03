<?php
// Simulated database connection (replace with your actual database credentials)
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel_reservation";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if employee ID is provided in the URL
if (isset($_GET['empId'])) {
    $empId = $_GET['empId'];

    // Delete employee record from the database
    $sql = "DELETE FROM Employee WHERE emp_id = '$empId'";

    if ($conn->query($sql) === TRUE) {
        echo "Employee record deleted successfully";
    } else {
        echo "Error deleting employee record: " . $conn->error;
    }
} else {
    echo "Employee ID not provided";
}

// Close database connection
$conn->close();
?>
