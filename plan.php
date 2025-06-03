<?php
// Establish database connection (Replace with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $pid = isset($_POST['pid']) ? $_POST['pid'] : "";
    $type = isset($_POST['type']) ? $_POST['type'] : "";
    $pName = isset($_POST['pName']) ? $_POST['pName'] : "";
    $pPrice = isset($_POST['pPrice']) ? $_POST['pPrice'] : "";
    $capacity = isset($_POST['capacity']) ? $_POST['capacity'] : "";
    $hotelId = isset($_POST['hotelId']) ? $_POST['hotelId'] : "";
    $availab = isset($_POST['availab']) ? $_POST['availab'] :"";

    $sql = "INSERT INTO plans (P_id, type1, P_name, P_price, capacity, hotel_id, availab)
    VALUES ('$pid', '$type', '$pName', '$pPrice', '$capacity', '$hotelId', '$availab')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Information Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            color: #333;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Plan Information Form</h2>
        <form action="" method="post">
            <label for="pid">Plan ID:</label>
            <input type="text" id="pid" name="pid" required>

            <label for="type">Plan Type:</label>
            <input type="text" id="type" name="type" required>

            <label for="pName">Plan Name:</label>
            <input type="text" id="pName" name="pName" required>

            <label for="pPrice">Plan Price:</label>
            <input type="text" id="pPrice" name="pPrice" required>

            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" required>

            <label for="hotelId">Hotel ID:</label>
            <input type="text" id="hotelId" name="hotelId" required>

            <label for="availab">Availability:</label>
            <input type="number" id="availab" name="availab" required>


            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
