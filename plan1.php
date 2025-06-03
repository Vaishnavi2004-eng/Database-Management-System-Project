<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Plan Information</title>
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
            align-items: center; /* Align items vertically in the center */
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
        tr.data-row {
    background-color: white; /* Set the background color for data rows */
}

tr.data-row:hover {
    background-color: #f5f5f5;
}
        .btn-spacing {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-right: 0%;
        }
    </style>
</head>
<body>

<h2>Plan Information</h2>
<table border='1'>
    <tr>
        <th>Plan ID</th>
        <th>Plan Type</th>
        <th>Plan Name</th>
        <th>Plan Price</th>
        <th>Capacity</th>
        <th>Hotel ID</th>
        <th>Availability</th>
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

    $result = $conn->query("SELECT * FROM plans");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='data-row'>";
            echo "<td>{$row['P_id']}</td>";
            echo "<td>{$row['type1']}</td>";
            echo "<td>{$row['P_name']}</td>";
            echo "<td>{$row['P_price']}</td>";
            echo "<td>{$row['capacity']}</td>";
            echo "<td>{$row['hotel_id']}</td>";
            echo "<td>{$row['availab']}</td>";
            echo "<td>
            <button type='button' class='btn btn-info' onclick=\"updatePlan('" . $row['P_id'] . "')\">
                <i class='fas fa-pencil-alt'></i> UPDATE
            </button>
            <button type='button' class='btn btn-info' onclick=\"deletePlan('" . $row['P_id'] . "')\">
                <i class='fas fa-trash'></i> DELETE
            </button>
          </td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No plans found</td></tr>";
    }

    $conn->close();
    ?>

</table>

<div class="btn-container btn-spacing">
    <button type="button" class="btn btn-info" onclick="add()">
        <i class="fas fa-plus"></i> ADD PLAN
    </button>
    <button type="button" class="btn btn-info" onclick="back()">
        <i class="fas fa-plus"></i> BACK
    </button>
</div>

<script>
    function add() {
        window.location.href = "plan.php";
    }
    function back() {
        window.location.href = "homepage.php";
    }

    function updatePlan(planId) {
        // Pass the planId to the update page for further processing
        window.location.href = "plan_update.php?id=" + planId;
    }

    function deletePlan(planId) {
        // Confirm deletion
        if (confirm("Are you sure you want to delete this plan?")) {
            // Redirect to delete_plan.php with the planId as a parameter
            window.location.href = "delete_plan.php?planId=" + planId;
        }
    }
</script>

</body>
</html>
