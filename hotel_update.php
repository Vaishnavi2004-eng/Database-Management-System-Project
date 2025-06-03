<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Hotel Information</title>
    <style>
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
        input[type="tel"],
        input[type="email"],
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
    <h2>Update Hotel Information</h2>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel_reservation";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $hotelId = $_GET['id'];

        // Retrieve hotel information based on the provided ID
        $result = $conn->query("SELECT * FROM hotels WHERE hotel_id = '$hotelId'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="hotel_id" value="<?php echo $row['hotel_id']; ?>">

                <div class="form-group">
                    <label for="hName">Hotel Name:</label>
                    <input type="text" id="hName" name="hName" value="<?php echo isset($_POST['hName']) ? $_POST['hName'] : $row['h_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="branch">Branch:</label>
                    <input type="text" id="branch" name="branch" value="<?php echo isset($_POST['branch']) ? $_POST['branch'] : $row['Branch']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="<?php echo isset($_POST['location']) ? $_POST['location'] : $row['loc']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : $row['phone_number']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email ID:</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $row['email_id']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="numEmployees">Number of Employees:</label>
                    <input type="number" id="numEmployees" name="numEmployees" value="<?php echo isset($_POST['numEmployees']) ? $_POST['numEmployees'] : $row['num_employees']; ?>" required>
                </div>

                <div class="form-group">
                    <input type="submit" value="Update">
                </div>
            </form>
            <?php
        } else {
            echo "<p>No hotel found with ID: $hotelId</p>";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update hotel information based on the submitted form data
        $hotel_id = $_POST['hotel_id'];
        $hName = $_POST['hName'];
        $branch = $_POST['branch'];
        $location = $_POST['location'];
        $phoneNumber = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $numEmployees = $_POST['numEmployees'];

        $sql = "UPDATE hotels SET h_name='$hName', Branch='$branch', loc='$location', phone_number='$phoneNumber', email_id='$email', num_employees='$numEmployees' WHERE hotel_id='$hotel_id'";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Record updated successfully</p>";
        } else {
            echo "<p>Error updating record: " . $conn->error . "</p>";
        }
    }

    $conn->close();
    ?>
</div>

</body>
</html>
