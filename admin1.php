<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Board</title>
    <link rel="stylesheet" href="bg-style.css">
    <!-- Inline styles for simplicity in this example -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Align elements to the left */
        }

        h2 {
            color: #333;
            margin-top: 10px; /* Adjust margin as needed */
            font-size: 28px; /* Adjust font size as needed */
        }

        label {
            font-weight: bold;
            margin-right: 10px;
        }

        select,
        input[type="date"],
        input[type="text"] {
            width: 250px; /* Adjust width as needed */
            padding: 12px; /* Adjust padding as needed */
            margin: 8px 0;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #000;
            color: white;
            cursor: pointer;
            padding: 12px 24px; /* Adjust padding as needed */
            font-size: 16px; /* Adjust font size as needed */
            margin-top: 10px; /* Adjust margin as needed */
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #333;
        }
    </style>
</head>

<body>


    <!-- Filter Section -->
    <form id="filterForm" action="filter1.php" method="get">
        <label for="hotelFilter">Hotel:</label>
        <select name="hotelID" id="hotelFilter">
            <option value="">All Hotels</option>
            <!-- Add options dynamically based on your database -->
            <option value="taj041">taj041</option>
            <option value="taj042">taj042</option>
            <option value="taj043">taj043</option>
            <!-- Add more options as needed -->
        </select>
        <br>

        <label for="startDate">Start Date:</label>
        <input type="date" name="startDate" id="startDate" placeholder="Start Date">

        <br>

        <label for="endDate">End Date:</label>
        <input type="date" name="endDate" id="endDate" placeholder="End Date">

        <br>

        <label for="monthFilter">Month:</label>
        <select name="month" id="monthFilter">
            <option value="">All Months</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
            <!-- Add more months as needed -->
        </select>
        <br>

        <input type="button" value="Apply Filters" onclick="submitFilterForm()">
    </form>
    <br>
    <!-- Additional Action -->
    <!-- Add any additional actions here -->

    <script>
        // Function to submit the filter form when the hotel filter changes
        function submitFilterForm() {
            var form = document.getElementById("filterForm");
            console.log("Form Data:", new FormData(form));
            form.submit();
        }
    </script>
</body>

</html>
