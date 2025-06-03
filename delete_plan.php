<?php
// delete_plan.php

// Simulated database connection and data retrieval (replace with your actual database logic)
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel_reservation";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the plan ID is provided in the request
if (isset($_GET['planId'])) {
    $planId = $_GET['planId'];

    // Perform the delete operation
    
    $sql = "DELETE FROM plans WHERE P_id ='$planId'";
    echo $sql;
    if ($conn->query($sql) === TRUE) {
        echo "Plan deleted successfully";
    } else {
        echo "Error deleting plan: " . $conn->error;
    }
} else {
    echo "Plan ID not provided";
}

$conn->close();
?>
