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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Automatically generate f_id
    $f_id = uniqid('F'); // Generates a unique ID with 'F' as a prefix

    // Retrieve form data
    $merits = isset($_POST['merits']) ? $_POST['merits'] : '';
    $demerits = isset($_POST['demerits']) ? $_POST['demerits'] : '';
    $guest_id = isset($_POST['guest_id']) ? $_POST['guest_id'] : '';
    $p_id = isset($_POST['p_id']) ? $_POST['p_id'] : '';
    $hotel_id = isset($_POST['hotel_id']) ? $_POST['hotel_id'] : '';
    $emp_id = isset($_POST['emp_id']) ? $_POST['emp_id'] : '';
    $suggestion = isset($_POST['suggestion']) ? $_POST['suggestion'] : '';

    // Insert data into the Feedback table
    $query = "INSERT INTO Feedback (f_id, merits, demerits, guest_id, p_id, hotel_id, emp_id, suggestion) 
              VALUES ('$f_id', '$merits', '$demerits', '$guest_id', '$p_id', '$hotel_id', '$emp_id', '$suggestion')";

    if ($connection->query($query) === TRUE) {
        $success_message = '<div class="success-message center">Feedback submitted successfully</div>';
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
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

        .success-message {
            background-color: #27ae60;
            color: #fff;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            display: inline-block;
        }

        /* Center success message */
        .center {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Remove input for f_id, it will be generated automatically -->

            <label for="merits">Merits:</label>
            <input type="text" name="merits" required>

            <label for="demerits">Demerits:</label>
            <input type="text" name="demerits" required>

            <label for="guest_id">Guest ID:</label>
            <input type="text" name="guest_id" required>

            <label for="p_id">Plan ID:</label>
            <input type="text" name="p_id" required>

            <label for="hotel_id">Hotel ID:</label>
            <input type="text" name="hotel_id" required>

            <label for="emp_id">Employee ID:</label>
            <input type="text" name="emp_id" required>

            <label for="suggestion">Suggestion:</label>
            <input type="text" name="suggestion" required>

            <button type="submit">Submit Feedback</button>
        </form>

        <!-- Error or success message placed after the form -->
        <?php if (isset($success_message)) echo $success_message; ?>
    </div>
</body>

</html>
