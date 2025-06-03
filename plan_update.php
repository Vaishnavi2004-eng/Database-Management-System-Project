<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pid = "";
$type = "";
$pName = "";
$pPrice = "";
$capacity = "";
$hotelId = "";
$availab = "";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $pid = $_GET['id'];

    $result = $conn->query("SELECT * FROM plans WHERE P_id = '$pid'");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $type = $row['type1'];
        $pName = $row['P_name'];
        $pPrice = $row['P_price'];
        $capacity = $row['capacity'];
        $hotelId = $row['hotel_id'];
        $availab = $row['availab'];
    } else {
        echo "<p>No plan found with ID: $pid</p>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $_POST['pid'];
    $type = $_POST['type'];
    $pName = $_POST['pName'];
    $pPrice = $_POST['pPrice'];
    $capacity = $_POST['capacity'];
    $hotelId = $_POST['hotelId'];
    $availab = $_POST['availab'];

    $stmt = $conn->prepare("UPDATE plans SET type1=?, P_name=?, P_price=?, capacity=?, hotel_id=?, availab=? WHERE P_id=?");
    $stmt->bind_param("ssdissi", $type, $pName, $pPrice, $capacity, $hotelId, $availab, $pid);

    if ($stmt->execute()) {
        echo "<p>Record updated successfully</p>";

        // Retrieve updated plan information
        $result = $conn->query("SELECT * FROM plans WHERE P_id = '$pid'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $type = $row['type1'];
            $pName = $row['P_name'];
            $pPrice = $row['P_price'];
            $capacity = $row['capacity'];
            $hotelId = $row['hotel_id'];
            $availab = $row['availab'];
        } else {
            echo "<p>Error retrieving updated plan details</p>";
        }
    } else {
        echo "<p>Error updating record: " . $conn->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Plan Information</title>
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
        <h2>Update Plan Information</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">

            <label for="type">Plan Type:</label>
            <input type="text" id="type" name="type" value="<?php echo htmlspecialchars($type); ?>" required>

            <label for="pName">Plan Name:</label>
            <input type="text" id="pName" name="pName" value="<?php echo htmlspecialchars($pName); ?>" required>

            <label for="pPrice">Plan Price:</label>
            <input type="text" id="pPrice" name="pPrice" value="<?php echo htmlspecialchars($pPrice); ?>" required>

            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" value="<?php echo htmlspecialchars($capacity); ?>" required>

            <label for="hotelId">Hotel ID:</label>
            <input type="text" id="hotelId" name="hotelId" value="<?php echo htmlspecialchars($hotelId); ?>" required>

            <label for="availab">Availability:</label>
            <input type="number" id="availab" name="availab" value="<?php echo htmlspecialchars($availab); ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>

</html>
