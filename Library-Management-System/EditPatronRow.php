<!DOCTYPE html>
<html>
<head>
    <title>Edit Patron Row</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            background-color: #000000;
            color: #fff;
            padding: 15px;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            text-align: left;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #000000;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #5A5A5A;
        }

        a {
            text-decoration: none;
            background-color: #000000;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }

        a:hover {
            background-color: #5A5A5A;
        }
    </style>
</head>
<body>
    <h2>Edit Patron Row</h2>

    <?php
    // Include the database configuration
    include "db_config.php";

    // Check if an item ID is provided in the query string
    if (isset($_GET["patron_id"])) {
        $patron_id = $_GET["patron_id"];

        // Fetch the item record with the provided item ID
        $sql = "SELECT * FROM Patron WHERE patronID = $patron_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display the form for editing the item record
            echo '<form method="post" action="">';
            echo '<input type="hidden" name="patron_id" value="' . $row["patronID"] . '">';
            echo '<label for="patronLastName">Last Name:</label>';
            echo '<input type="text" name="patronLastName" value="' . $row["patronLastName"] . '" required maxlength="90"><br><br>';
            echo '<label for="patronFirstName">First Name:</label>';
            echo '<input type="text" name="patronFirstName" value="' . $row["patronFirstName"] . '" required maxlength="90"><br><br>';
            echo '<label for="patronAddress">Address:</label>';
            echo '<input type="text" name="patronAddress" value="' . $row["patronAddress"] . '" required maxlength="90"><br><br>';
            echo '<label for="patronDateOfBirth">Date Of Birth (YYYY-MM-DD):</label>';
            echo '<input type="text" name="patronDateOfBirth" value="' . $row["patronDateOfBirth"] . '" required maxlength="10"><br><br>';
            echo '<label for="patronLastRenewed">Last Renewed:</label>';
            echo '<input type="text" name="patronLastRenewed" value="' . $row["patronLastRenewed"] . '" required maxlength="10"><br><br>';
            echo '<label for="patronContactPhone">Contact Phone:</label>';
            echo '<input type="text" name="patronContactPhone" value="' . $row["patronContactPhone"] . '" required maxlength="10"><br><br>';
            echo '<label for="paymentBalance">Payment Balence:</label>';
            echo '<input type="number" step="0.01" name="paymentBalance" value="' . $row["paymentBalance"] . '" required max="99999.99"><br><br>';
            echo '<input type="submit" value="Save Changes">';
            echo '</form>';
        } else {
            echo "Item record not found.";
        }
    } else {
        echo "Item ID not provided.";
    }

    // Handle the form submission to update the record
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patron_id = $_POST["patron_id"];
        $patronLastName = $_POST["patronLastName"];
        $patronFirstName = $_POST["patronFirstName"];
        $patronAddress = $_POST["patronAddress"];
        $patronDateOfBirth = $_POST["patronDateOfBirth"];
        $patronLastRenewed = $_POST["patronLastRenewed"];
        $patronContactPhone = $_POST["patronContactPhone"];
        $paymentBalance = $_POST["paymentBalance"];

        // Input validation
        if (strtotime($patronDateOfBirth) === false) {
            echo "<p>Error: Date Of Birth should be in YYYY-MM-DD format.</p>";
        } elseif (!is_numeric($patronContactPhone)) {
            echo "<p>Error: Contact Phone should contain only numbers.</p>";
        } else {

            // SQL query to update the item record
            $sql = "UPDATE Patron SET patronLastName='$patronLastName', patronFirstName='$patronFirstName', patronAddress='$patronAddress', patronDateOfBirth='$patronDateOfBirth', patronLastRenewed='$patronLastRenewed', patronContactPhone='$patronContactPhone', paymentBalance=$paymentBalance WHERE patronID=$patron_id";

            if ($conn->query($sql) === TRUE) {
                echo "Record with Patron ID $patron_id has been updated.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close the database connection
        $conn->close();

    }
    ?>

    <a href="index.html">Back to Welcome</a>
</body>
</html>
