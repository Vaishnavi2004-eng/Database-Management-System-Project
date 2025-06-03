<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cancel Reservation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #fff;
            color: #000;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #000;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #000;
        }

        input[type="submit"] {
            background-color: #000;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }

        .success-message {
            color: green;
            margin-top: 20px;
        }

    </style>
</head>

<body>

    <?php
    // Database connection
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "hotel_reservation";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get reservation ID from the user
        $reservationID = $_POST["reservationID"];

        // Check if the reservation ID exists and status is confirmed
        $checkReservationQuery = "SELECT * FROM Reservation WHERE rid = '$reservationID' AND r_status = 'confirmed'";
        $result = $conn->query($checkReservationQuery);

        if ($result->num_rows > 0) {
            // Generate a random refund ID (VARCHAR)
            $refundID = 'REF' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));

            // Get values for guest_id, hotel_id, and p_id from Reservation table
            $reservationDetailsQuery = "SELECT Guest_id, hotel_id, p_id FROM Reservation WHERE rid = '$reservationID'";
            $reservationDetailsResult = $conn->query($reservationDetailsQuery);

            if ($reservationDetailsResult->num_rows > 0) {
                $reservationDetails = $reservationDetailsResult->fetch_assoc();
                $p_id = $reservationDetails["p_id"];

                // Insert record into Refund table with rid and p_id
                $insertRefundQuery = "INSERT INTO Refund (ref_id, Guest_id, hotel_id, rid, p_id) VALUES ('$refundID', '"
                    . $reservationDetails["Guest_id"] . "', '" . $reservationDetails["hotel_id"] . "', '$reservationID', '"
                    . $p_id . "')";

                if ($conn->query($insertRefundQuery) === TRUE) {
                    // Update Reservation status to canceled
                    $updateReservationStatusQuery = "UPDATE Reservation SET r_status = 'canceled' WHERE rid = '$reservationID'";

                    if ($conn->query($updateReservationStatusQuery) === TRUE) {
                        // Increase availab in plans table for the specific p_id
                        $increaseAvailabQuery = "UPDATE plans SET availab = availab + 1 WHERE P_id = '$p_id'";
                        if ($conn->query($increaseAvailabQuery) === TRUE) {
                            echo "<div class='success-message'>";
                            echo "Reservation canceled successfully. Refund ID: $refundID";
                            echo "</div>";
                        } else {
                            echo "Error updating availab in plans table: " . $conn->error;
                        }
                    } else {
                        echo "Error updating Reservation status: " . $conn->error;
                    }
                } else {
                    echo "Error inserting record into Refund table: " . $conn->error;
                }
            } else {
                echo "Error retrieving Reservation details: " . $conn->error;
            }
        } else {
            echo "Invalid Reservation ID or the reservation is not confirmed.";
        }
    }

    $conn->close();
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="background-color: #fff; padding: 20px; border: 1px solid #000; border-radius: 5px; margin: 0;">
        <label for="reservationID">Enter Reservation ID:</label>
        <input type="text" name="reservationID" required>
        <br>
        <input type="submit" value="Cancel Reservation">
    </form>

</body>

</html>
