<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Information</title>
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
        .btn-spacing{
            display:flex;
            flex-flow:row;
            justify content:start;
        }

    </style>
</head>
<body>

<h2>Employee Information</h2>
<table border='1'>
    <tr>
        <th>Employee ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Doj</th>
        <th>Age</th>
        <th>Salary</th>
        <th>Hotelid</th>
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

    $result = $conn->query("SELECT * FROM Employee");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['emp_id']}</td>";
            echo "<td>{$row['emp_name']}</td>";
            echo "<td>{$row['emp_gender']}</td>";
            echo "<td>{$row['emp_address']}</td>";
            echo "<td>{$row['emp_ph']}</td>";
            echo "<td>{$row['emp_doj']}</td>";
            echo "<td>{$row['emp_age']}</td>";
            echo "<td>{$row['emp_salary']}</td>";
            echo "<td>{$row['hotel_id']}</td>";

            echo "<td>
            <button type='button' class='btn btn-info' onclick=\"updateEmployee('" . $row['emp_id'] . "')\">
                <i class='fas fa-pencil-alt'></i> UPDATE
            </button>
            <button type='button' class='btn btn-info' onclick=\"deleteEmployee('" . $row['emp_id'] . "')\">
                <i class='fas fa-trash'></i> DELETE
            </button>
          </td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No employees found</td></tr>";
    }

    $conn->close();
    ?>

</table>

<div class="btn-container btn-spacing" >
    <button type="button" class="btn btn-info" onclick="addEmployee()">
        <i class="fas fa-plus"></i> ADD EMPLOYEE
    </button>
    <button type="button" class="btn btn-info" onclick="back()">
        <i class="fas fa-plus"></i> BACK
    </button>
</div>

<script>
    function addEmployee() {
        window.location.href = "employee.php";
    }
    function back() {
        window.location.href = "homepage.php";
    }

    function updateEmployee(empId) {
        // Pass the empId to the update page for further processing
        window.location.href = "employee_update.php?id=" + empId;
    }

    function deleteEmployee(empId) {
        // Confirm deletion
        if (confirm("Are you sure you want to delete this employee?")) {
            // Redirect to delete_employee.php with the empId as a parameter
            window.location.href = "employee_delete.php?empId=" + empId;
        }
    }
</script>

</body>
</html>
