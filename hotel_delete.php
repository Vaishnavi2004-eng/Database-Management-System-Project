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

// Check if hotel ID is provided in the URL
if (isset($_GET['hotelId'])) {
    $hotelId = $_GET['hotelId'];

    // Delete hotel record from the database
    $sql = "DELETE FROM hotels WHERE hotel_id = '$hotelId'";

    if ($conn->query($sql) === TRUE) {
        echo "Hotel record deleted successfully";
    } else {
        echo "Error deleting hotel record: " . $conn->error;
    }
} else {
    echo "Hotel ID not provided";
}

// Close database connection
$conn->close();
?>
