<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Guest Information</title>
    <style>
        /* Your CSS styles here */
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
    <h2>Update Guest Information</h2>

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
        $guestId = $_GET['id'];

        // Retrieve guest information based on the provided ID
        $result = $conn->query("SELECT * FROM Guest WHERE Guest_id = '$guestId'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="guest_id" value="<?php echo $row['Guest_id']; ?>">

                <div class="form-group">
                    <label for="name1">Guest Name:</label>
                    <input type="text" id="name1" name="name1" value="<?php echo isset($_POST['name1']) ? $_POST['name1'] : $row['name1']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <input type="text" id="gender" name="gender" value="<?php echo isset($_POST['gender']) ? $_POST['gender'] : $row['Gender']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : $row['adres']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone_no">Phone Number:</label>
                    <input type="number" id="phone_no" name="phone_no" value="<?php echo isset($_POST['phone_no']) ? $_POST['phone_no'] : $row['Phone_no']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email_id">Email ID:</label>
                    <input type="text" id="email_id" name="email_id" value="<?php echo isset($_POST['email_id']) ? $_POST['email_id'] : $row['Email_id']; ?>" required>
                </div>

                <div class="form-group">
                    <input type="submit" value="Update">
                </div>
            </form>
            <?php
        } else {
            echo "<p>No guest found with ID: $guestId</p>";
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Update guest information based on the submitted form data
        $guest_id = $_POST['guest_id'];
        $name = $_POST['name1'];
        $gender = $_POST['gender'];
        $city = $_POST['city'];
        $phone_no = $_POST['phone_no'];
        $email_id = $_POST['email_id'];

        $sql = "UPDATE Guest SET Name1='$name', Gender='$gender', adres='$city', Phone_no='$phone_no', Email_id='$email_id' WHERE Guest_id='$guest_id'";

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
