<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Information Form</title>
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
        <h2>Hotel Information Form</h2>
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
            // Get form data (use isset() to check if the keys exist)
            $hotelId = isset($_POST['hotelId']) ? $_POST['hotelId'] : "";
            $hName = isset($_POST['hName']) ? $_POST['hName'] : "";
            $branch = isset($_POST['branch']) ? $_POST['branch'] : "";
            $location = isset($_POST['location']) ? $_POST['location'] : "";
            $phoneNumber = isset($_POST['phoneNumber']) ? $_POST['phoneNumber'] : "";
            $email = isset($_POST['email']) ? $_POST['email'] : "";
            $numEmployees = isset($_POST['numEmployees']) ? $_POST['numEmployees'] : "";
            
            // Insert data into the database, including hotel_id
            $sql = "INSERT INTO hotels (hotel_id, h_name, Branch, loc, phone_number, email_id, num_employees)
                    VALUES ('$hotelId', '$hName', '$branch', '$location', '$phoneNumber', '$email', '$numEmployees')";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close database connection
        $conn->close();
        ?>

        <form action="" method="post">
            <!-- Add a new input for hotel_id -->
            <label for="hotelId">Hotel ID:</label>
            <input type="text" id="hotelId" name="hotelId" required>

            <label for="hName">Hotel Name:</label>
            <input type="text" id="hName" name="hName" required>

            <label for="branch">Branch:</label>
            <input type="text" id="branch" name="branch" required>

            <label for="location">Location:</label>
            <input type="text" id="location" name="location" required>

            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" required>

            <label for="email">Email ID:</label>
            <input type="email" id="email" name="email" required>

            <label for="numEmployees">Number of Employees:</label>
            <input type="number" id="numEmployees" name="numEmployees" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
