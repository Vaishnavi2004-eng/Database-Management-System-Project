<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Information</title>
    <!-- Include FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bg-style.css">
    <style>
        /* Your CSS styles go here */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #000;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        /* Add this class for rows containing data */
        .data-row {
            background-color: #fff; /* White background for data rows */
        }

        .text-right {
            text-align: right;
        }

        .btn-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-info {
            background-color: #000;
            color: #fff;
            border: none;
        }

        .btn:hover {
            opacity: 0.8;
        }
        .btn-spacing {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

    </style>
</head>
<body>

<h2>Hotel Information</h2>
<table border='1'>
    <tr>
        <th>Hotel ID</th>
        <th>Name</th>
        <th>Branch</th>
        <th>Location</th>
        <th>Phone Number</th>
        <th>Email ID</th>
        <th>Number of Employees</th>
        <th>Action</th>
    </tr>

    <?php
    // Simulated database connection and data retrieval (replace with your actual database logic)
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "hotel_reservation";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT * FROM hotels");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add the 'data-row' class to the table rows containing data
            echo "<tr class='data-row'>";
            echo "<td>{$row['hotel_id']}</td>";
            echo "<td>{$row['h_name']}</td>";
            echo "<td>{$row['Branch']}</td>";
            echo "<td>{$row['loc']}</td>";
            echo "<td>{$row['phone_number']}</td>";
            echo "<td>{$row['email_id']}</td>";
            echo "<td>{$row['num_employees']}</td>";

            echo "<td>
            <button type='button' class='btn btn-info' onclick=\"updateHotel('" . $row['hotel_id'] . "')\">
                <i class='fas fa-pencil-alt'></i> UPDATE
            </button>
            <button type='button' class='btn btn-info' onclick=\"deleteHotel('" . $row['hotel_id'] . "')\">
                <i class='fas fa-trash'></i> DELETE
            </button>
          </td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No hotels found</td></tr>";
    }

    $conn->close();
    ?>

</table>

<div class="btn-container btn-spacing" >
    <button type="button" class="btn btn-info" onclick="addHotel()">
        <i class="fas fa-plus"></i> ADD HOTEL
    </button>
    <button type="button" class="btn btn-info" onclick="back()">
        <i class="fas fa-plus"></i> BACK
    </button>
</div>

<script>
    function addHotel() {
        window.location.href = "hotel2.php";
    }
    function back() {
        window.location.href = "homepage.php";
    }

    function updateHotel(hotelId) {
        // Pass the hotelId to the update page for further processing
        window.location.href = "hotel_update.php?id=" + hotelId;
    }

    function deleteHotel(hotelId) {
        // Confirm deletion
        if (confirm("Are you sure you want to delete this hotel?")) {
            // Redirect to delete_hotel.php with the hotelId as a parameter
            window.location.href = "hotel_delete.php?hotelId=" + hotelId;
        }
    }
</script>

</body>
</html>
