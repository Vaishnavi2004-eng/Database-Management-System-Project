<head>
    <!-- Add other meta tags and title -->
    <link rel="stylesheet" type="text/css" href="filter-style.css">

    
</head>
<?php
// Print all GET parameters for debugging
//print_r($_GET);



// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

// Create a connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve filter parameters from the form
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;
$selectedMonth = isset($_GET['month']) ? $_GET['month'] : null;
$selectedHotelId = isset($_GET['hotelID']) ? $_GET['hotelID'] : null;

// Build the SQL query based on the provided parameters
$sql = "SELECT * FROM reservation WHERE 1";

if ($startDate) {
    $sql .= " AND checkin_date >= '$startDate'";
}

if ($endDate) {
    $sql .= " AND checkin_date <= '$endDate'";
}

if ($selectedMonth) {
    $sql .= " AND MONTH(checkin_date) = '$selectedMonth'";
}

if ($selectedHotelId) {
    $sql .= " AND hotel_id = '$selectedHotelId'";
}

// Debugging: Echo the generated SQL query
//echo "Generated Query: $sql";

// Execute the query
$result = mysqli_query($connection, $sql);

if (!$result) {
    die('Query failed: ' . mysqli_error($connection));
}

// Display the results in a table
echo '<table border="1">';
echo '<tr><th>Hotel ID</th><th>Reservation ID</th><th>Checkin Date</th><th>Checkout Date</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['hotel_id'] . '</td>';
    echo '<td>' . $row['rid'] . '</td>';
    echo '<td>' . $row['checkin_date'] . '</td>';
    echo '<td>' . $row['checkout_date'] . '</td>';
    echo '</tr>';
}

echo '</table>';
// ...

// Close the database connection
mysqli_close($connection);
?>
