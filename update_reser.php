<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Reservation</title>
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

        label {
            display: block;
            margin-bottom: 8px;
        }

        form {
            max-width: 400px;
            margin: 0;
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
    </style>
</head>

<body>
    
    <form id="updateForm" action="update_reservation.php" method="post">
        <label for="reservationID">Reservation ID:</label>
        <input type="text" name="reservationID" id="reservationID" placeholder="Reservation ID">
        <br>
        <label for="newCheckoutDate">New Checkout Date:</label>
        <input type="date" name="newCheckoutDate" placeholder="New Checkout Date">
        <br>
        <input type="submit" value="Update">
    </form>

</body>

</html>
