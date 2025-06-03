<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reservation Information</title>
    <!-- Include FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="bg-style.css">
    <style>
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

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #000;
            color: #fff;
        }

        tr.data-row {
            background-color: white; /* Set the background color for data rows */
        }

        tr.data-row:hover {
            background-color: #f5f5f5;
        }

        .text-right {
            text-align: right;
        }

        .btn-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            justify-content: flex-end;
            width: 100%;
            margin-right: 0%;
        }

        .btn-left {
            margin-right: auto;
        }

        /* Add white border color to both buttons */
        .btn-info.back-btn,
        .btn-info.update-btn {
            border: 1px solid white;
        }

    </style>
</head>

<body>

    <h2>Reservation Information</h2>
    <table border='1'>
        <tr>
            <th>Reservation ID</th>
            <th>Hotel ID</th>
            <th>Transaction ID</th>
            <th>Plan ID</th>
            <th>Guest ID</th>
            <th>Status</th>
            <th>Reservation Date</th>
            <th>Check-In Date</th>
            <th>Check-Out Date</th>
        </tr>
        <?php
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "hotel_reservation";

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT * FROM Reservation");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='data-row'>";
                echo "<td>{$row['rid']}</td>";
                echo "<td>{$row['hotel_id']}</td>";
                echo "<td>{$row['t_id']}</td>";
                echo "<td>{$row['p_id']}</td>";
                echo "<td>{$row['guest_id']}</td>";
                echo "<td>{$row['r_status']}</td>";
                echo "<td>{$row['r_date']}</td>";
                echo "<td>{$row['checkin_date']}</td>";
                echo "<td>{$row['checkout_date']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No reservations found</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <div class="btn-container btn-spacing">
        <button type="button" class="btn btn-info btn-left" onclick="addReservation()">
            <i class="fas fa-plus"></i> ADD RESERVATION
        </button>
        <button type="button" class="btn btn-info update-btn" onclick="updateReservation()">
            <i class="fas fa-edit"></i> UPDATE RESERVATION
        </button>
        <button type="button" class="btn btn-info back-btn" onclick="back()">
            <i class="fas fa-plus"></i> BACK
        </button>
    </div>

    <script>
        function addReservation() {
            window.location.href = "reservation.php";
        }

        function updateReservation() {
            window.location.href = "update_reser.php";
        }

        function back() {
            window.location.href = "homepage.php";
        }
    </script>

</body>

</html>
