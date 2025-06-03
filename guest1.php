<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guest Information</title>
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

        tr.data-row {
            background-color: #fff; /* White background for data rows */
        }

        tr:hover {
            background-color: #f5f5f5;
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

<h2>Guest Information</h2>
<table border='1'>
    <tr>
        <th>Guest ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Email ID</th>
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

    $result = $conn->query("SELECT * FROM Guest");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add the 'data-row' class to the table rows containing data
            echo "<tr class='data-row'>";
            echo "<td>{$row['Guest_id']}</td>";
            echo "<td>{$row['name1']}</td>";
            echo "<td>{$row['Gender']}</td>";
            echo "<td>{$row['adres']}</td>";
            echo "<td>{$row['Phone_no']}</td>";
            echo "<td>{$row['Email_id']}</td>";
            echo "<td>
            <button type='button' class='btn btn-info' onclick=\"updateGuest('" . $row['Guest_id'] . "')\">
                <i class='fas fa-pencil-alt'></i> UPDATE
            </button>
            <button type='button' class='btn btn-info' onclick=\"deleteGuest('" . $row['Guest_id'] . "')\">
                <i class='fas fa-trash'></i> DELETE
            </button>
          </td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No guests found</td></tr>";
    }

    $conn->close();
    ?>

</table>

<div class="btn-container btn-spacing">
    <button type="button" class="btn btn-info" onclick="addGuest()">
        <i class="fas fa-plus"></i> ADD GUEST
    </button>
    <button type="button" class="btn btn-info" onclick="back()">
        <i class="fas fa-plus"></i> BACK
    </button>
</div>

<script>
    function addGuest() {
        window.location.href = "guest.php";
    }

    function back() {
        window.location.href = "homepage.php";
    }

    function updateGuest(guestId) {
        // Pass the guestId to the update page for further processing
        window.location.href = "guest_update.php?id=" + guestId;
    }

    function deleteGuest(guestId) {
        // Confirm deletion
        if (confirm("Are you sure you want to delete this guest?")) {
            // Redirect to delete_guest.php with the guestId as a parameter
            window.location.href = "guest_delete.php?guestId=" + guestId;
        }
    }
</script>

</body>
</html>
