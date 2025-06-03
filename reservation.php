<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            position: relative;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: left;
            display: inline-block;
            vertical-align: top;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .availability-message {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            position: relative;
            bottom: 0;
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            display: none;
        }

        .make-payment-button {
            background-color: #9370db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: relative;
            top: 5px;
            left: 50%;
            transform: translateX(-50%);
            display: block;
            margin-top: 20px;
        }

        .make-payment-button:hover {
            background-color: #6c3483;
        }
    </style>
</head>

<body>
    <?php
    // Replace these database connection details with your actual values
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel_reservation";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $rid = isset($_POST['rid']) ? $_POST['rid'] : '';
        $hotel_id = isset($_POST['hotel_id']) ? $_POST['hotel_id'] : '';
        $p_id = isset($_POST['p_id']) ? $_POST['p_id'] : '';
        $guest_id = isset($_POST['guest_id']) ? $_POST['guest_id'] : '';
        $r_status = 'Pending'; // Set default status to Pending
        $r_date = isset($_POST['r_date']) ? $_POST['r_date'] : '';
        $checkin_date = isset($_POST['checkin_date']) ? $_POST['checkin_date'] : '';
        $checkout_date = isset($_POST['checkout_date']) ? $_POST['checkout_date'] : '';

        // Check if any required field is empty
        if (empty($rid) || empty($hotel_id) || empty($p_id) || empty($guest_id) || empty($r_date) || empty($checkin_date) || empty($checkout_date)) {
            echo "Please fill out all the fields.\n";
        } else {
            // Check if guest ID exists
            $checkGuestQuery = "SELECT * FROM Guest WHERE Guest_id = '$guest_id'";
            $checkGuestResult = $connection->query($checkGuestQuery);

            // Check if plan ID exists
            $checkPlanQuery = "SELECT * FROM Plans WHERE P_id = '$p_id'";
            $checkPlanResult = $connection->query($checkPlanQuery);

            if ($checkGuestResult->num_rows === 0) {
                echo "Guest with ID $guest_id not found. Please add guest information first.\n";
            } elseif ($checkPlanResult->num_rows === 0) {
                echo "Plan with ID $p_id not found. Please add plan details first.\n";
            } else {
                // Check availability before inserting reservation
                $availabilityQuery = "SELECT availab FROM Plans WHERE P_id = '$p_id'";
                $availabilityResult = $connection->query($availabilityQuery);

                if ($availabilityResult && $availabilityResult->num_rows > 0) {
                    $row = $availabilityResult->fetch_assoc();
                    $currentAvailability = $row['availab'];

                    // Check if there is enough availability for the reservation
                    if ($currentAvailability >= 1) {
                        // Generate a unique transaction ID
                        $t_id = uniqid('trans_');

                        // Insert data into the Reservation table with 'Pending' status
                        $query = "INSERT INTO Reservation (rid, hotel_id, t_id, p_id, guest_id, r_status, r_date, checkin_date, checkout_date) 
                                  VALUES ('$rid', '$hotel_id', '$t_id', '$p_id', '$guest_id', 'Not Confirmed', '$r_date', '$checkin_date', '$checkout_date')";
                        
                        if ($connection->query($query) === TRUE) {
                            // Update availability in the Plan table (decrease by 1)
                            updateAvailability($p_id, $checkin_date, $checkout_date, -1);

                            // Redirect to the transaction form with relevant data
                            header("Location: transaction_information.php?rid=$rid&hotel_id=$hotel_id&t_id=$t_id&p_id=$p_id&guest_id=$guest_id&r_date=$r_date&checkin_date=$checkin_date&checkout_date=$checkout_date");
                            exit;
                        } else {
                            echo "Error: " . $query . "<br>" . $connection->error;
                        }
                    } else {
                        echo "Not enough availability for Plan ID $p_id. Reservation cannot be completed.\n";
                    }
                } else {
                    echo "Error retrieving availability for Plan ID $p_id.\n";
                }
            }
        }
    }

    // Close the database connection
    $connection->close();

    function updateAvailability($planId, $checkinDate, $checkoutDate, $increment)
    {
        global $connection;

        // Fetch current availability
        $availabilityQuery = "SELECT availab FROM Plans WHERE P_id = '$planId'";
        $availabilityResult = $connection->query($availabilityQuery);

        if ($availabilityResult && $availabilityResult->num_rows > 0) {
            $row = $availabilityResult->fetch_assoc();
            $currentAvailability = $row['availab'];

            // Check if availability becomes negative
            if ($currentAvailability >= $increment) {
                // Calculate new availability based on increment
                $newAvailability = $currentAvailability + $increment;

                // Update availability in the Plan table
                $updateQuery = "UPDATE Plans SET availab = '$newAvailability' WHERE P_id = '$planId'";
                if ($connection->query($updateQuery) === TRUE) {
                    echo "Availability updated successfully for Plan ID $planId.\n";
                } else {
                    echo "Error updating availability: " . $connection->error . "\n";
                }
            } else {
                echo "Not enough availability for Plan ID $planId.\n";
            }
        } else {
            echo "Plan with ID $planId not found.\n";
        }
    }
    ?>

    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="rid">Reservation ID:</label>
            <input type="text" name="rid" required>

            <label for="hotel_id">Hotel ID:</label>
            <input type="text" name="hotel_id" required>

            <!-- Transaction ID is automatically generated -->
            <input type="hidden" name="t_id" value="">

            <label for="p_id">Plan ID:</label>
            <input type="text" name="p_id" required>

            <label for="guest_id">Guest ID:</label>
            <input type="text" name="guest_id" required>

            <label for="r_date">Reservation Date:</label>
            <input type="date" name="r_date" required>

            <label for="checkin_date">Check-in Date:</label>
            <input type="date" name="checkin_date" required>

            <label for="checkout_date">Check-out Date:</label>
            <input type="date" name="checkout_date" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>
