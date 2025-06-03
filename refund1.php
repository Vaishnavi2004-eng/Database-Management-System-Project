<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Refund Information</title>
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
            background-color: #fff; /* White background for data rows */
        }

        th {
            background-color: #000;
            color: #fff;
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
        .btn-info.update-btn,
        .btn-info.cancel-btn {
            border: 1px solid white;
        }

    </style>
</head>

<body>

    <h2>Refund Information</h2>
    <table border='1'>
        <tr>
            <th>Refund ID</th>
            <th>Guest ID</th>
            <th>Hotel ID</th>
            <th>Reservation ID</th>
            <th>Plan ID</th>
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

        $result = $conn->query("SELECT * FROM Refund");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['ref_id']}</td>";
                echo "<td>{$row['Guest_id']}</td>";
                echo "<td>{$row['hotel_id']}</td>";
                echo "<td>{$row['rid']}</td>";
                echo "<td>{$row['p_id']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No refund records found</td></tr>";
        }

        $conn->close();
        ?>
    </table>

    <div class="btn-container btn-spacing">
        <button type="button" class="btn btn-info btn-left" onclick="addRefund()">
            <i class="fas fa-plus"></i> Cancel Reservation
        </button>
    </div>

    <script>
        function addRefund() {
            window.location.href = "refund.php";
        }

        function back() {
            window.location.href = "homepage.php";
        }
    </script>

</body>

</html>
