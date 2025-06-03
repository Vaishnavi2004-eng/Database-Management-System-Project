<!DOCTYPE html>
<html>
<head>
    <title>Employee Information</title>
    <style>
        /* Advanced CSS styles can be added here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="time"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-top: 4px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Employee Information</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="emp_id">Employee ID:</label>
            <input type="text" id="emp_id" name="emp_id" required>
        </div>
        <div class="form-group">
            <label for="emp_name">Employee Name:</label>
            <input type="text" id="emp_name" name="emp_name" required>
        </div>
        <div class="form-group">
            <label for="emp_ph">Employee Phone:</label>
            <input type="text" id="emp_ph" name="emp_ph" required>
        </div>
        <div class="form-group">
            <label for="emp_doj">Date of Joining:</label>
            <input type="date" id="emp_doj" name="emp_doj" required>
        </div>
        <div class="form-group">
            <label for="emp_gender">Employee Gender:</label>
            <input type="text" id="emp_gender" name="emp_gender" required>
        </div>
        <div class="form-group">
            <label for="emp_age">Employee Age:</label>
            <input type="number" id="emp_age" name="emp_age" required>
        </div>
        <div class="form-group">
            <label for="emp_salary">Employee Salary:</label>
            <input type="number" id="emp_salary" name="emp_salary" required>
        </div>
        <div class="form-group">
            <label for="hotel_id">Hotel ID:</label>
            <input type="text" id="hotel_id" name="hotel_id" required>
        </div>
        <div class="form-group">
            <label for="emp_address">Employee Address:</label>
            <input type="text" id="emp_address" name="emp_address" required>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit">
        </div>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hotel_reservation";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $emp_id = $_POST['emp_id'];
        $emp_name = $_POST['emp_name'];
        $emp_ph = $_POST['emp_ph'];
        $emp_doj = $_POST['emp_doj'];
        $emp_gender = $_POST['emp_gender'];
        $emp_age = $_POST['emp_age'];
        $emp_salary = $_POST['emp_salary'];
        $hotel_id = $_POST['hotel_id'];
        $emp_address = $_POST['emp_address'];

        $sql = "INSERT INTO Employee (emp_id, emp_name, emp_ph, emp_doj, emp_gender, emp_age, emp_salary, hotel_id, emp_address) 
                VALUES ('$emp_id', '$emp_name', '$emp_ph', '$emp_doj', '$emp_gender', '$emp_age', '$emp_salary', '$hotel_id', '$emp_address')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New employee record created successfully</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>
</div>

</body>
</html>