<!DOCTYPE html>
<html>
<head>
    <title>Guest Form</title>
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
        input[type="number"] {
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
    <h2>Guest Information</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="guest_id">Guest ID:</label>
            <input type="text" id="guest_id" name="guest_id" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" required>
        </div>
        <div class="form-group">
            <label for="city">address:</label>
            <input type="text" id="city" name="city" required>
        </div>
        <div class="form-group">
            <label for="phone_no">Phone Number:</label>
            <input type="number" id="phone_no" name="phone_no" required>
        </div>
        <div class="form-group">
            <label for="email_id">Email ID:</label>
            <input type="text" id="email_id" name="email_id" required>
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

        $guest_id = $_POST['guest_id'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $city = $_POST['city'];
        $phone_no = $_POST['phone_no'];
        $email_id = $_POST['email_id'];

        $sql = "INSERT INTO Guest (Guest_id, Name1, Gender, adres, Phone_no, Email_id) 
                VALUES ('$guest_id', '$name', '$gender', '$city', '$phone_no', '$email_id' )";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New record created successfully</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>
</div>

</body>
</html>