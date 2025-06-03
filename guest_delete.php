<?php
// delete_guest.php

// Simulated database connection and data retrieval (replace with your actual database logic)
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel_reservation";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the guest ID is provided in the request
if (isset($_GET['guestId'])) {
    $guestId = $_GET['guestId'];

    // Perform the delete operation
    $sql = "DELETE FROM Guest WHERE Guest_id ='$guestId'";

    if ($conn->query($sql) === TRUE) {
        echo "Guest deleted successfully";
    } else {
        echo "Error deleting guest: " . $conn->error;
    }
} else {
    echo "Guest ID not provided";
}

$conn->close();
?>
