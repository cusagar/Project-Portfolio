<!DOCTYPE html>
<html>
<head>
    <title>Check Out Items</title>
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
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h2>Check Out Item</h2>

<?php

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database configuration
    include "db_config.php";

    $itemID = $_POST["itemID"];
    $patronID = isset($_SESSION["patronID"]) ? $_SESSION["patronID"] : null;

    // Query to get the count of books in the patron's name
    $bookCountQuery = "SELECT COUNT(*) AS bookCount
                       FROM checkoutTransaction ct 
                       JOIN checkoutTransactionItem cti ON ct.transactionID = cti.transactionID
                       WHERE ct.patronID = '$patronID' AND cti.transactionItemStatus = 'Checked Out'";
    $bookCountResult = $conn->query($bookCountQuery);

    if ($bookCountResult->num_rows > 0) {
        $bookCountRow = $bookCountResult->fetch_assoc();
        $bookCount = $bookCountRow["bookCount"];

        // Check the book count against the maximum allowed
        $maxBooksAllowed = 20;

        if ($bookCount < $maxBooksAllowed) {
            // Get the first and last name of the patron
            $patronNameQuery = "SELECT patronFirstName, patronLastName FROM Patron WHERE patronID = '$patronID'";
            $patronNameResult = $conn->query($patronNameQuery);

            if ($patronNameResult->num_rows > 0) {
                $patronNameRow = $patronNameResult->fetch_assoc();
                $firstName = $patronNameRow["patronFirstName"];
                $lastName = $patronNameRow["patronLastName"];

                // Get the most recent transactionID
                $transactionIDQuery = "SELECT MAX(transactionID) AS maxTransactionID FROM checkoutTransaction";
                $transactionIDResult = $conn->query($transactionIDQuery);

                // Check if there are transactions
                if ($transactionIDResult->num_rows > 0) {
                    $transactionID = $transactionIDResult->fetch_assoc()['maxTransactionID'];

                    // Check if the item is not already checked out in the current transaction
                    $checkCheckoutQuery = "SELECT * FROM checkoutTransactionItem WHERE transactionID = '$transactionID' AND itemID = '$itemID'";
                    $checkoutResult = $conn->query($checkCheckoutQuery);

                    // Check if ItemID exists and is available
                    $checkItemQuery = "SELECT * FROM Item WHERE itemID = '$itemID' AND itemStatus = 'Available'";
                    $itemResult = $conn->query($checkItemQuery);

                    if ($itemResult->num_rows > 0 && $checkoutResult->num_rows === 0) {
                        // Insert into checkoutTransactionItem
                        $sql = "INSERT INTO checkoutTransactionItem (transactionID, itemID, transactionItemStatus) VALUES ('$transactionID', '$itemID', 'Checked Out')";

                        if ($conn->query($sql) === TRUE) {
                            // Update item status in the Item table
                            $updateItemStatusQuery = "UPDATE Item SET itemStatus = 'Checked Out' WHERE itemID = '$itemID'";
                            if ($conn->query($updateItemStatusQuery) === TRUE) {

                                $bookCount++;
                                
                                echo "<p>Item $itemID checked out to $firstName $lastName. Patron $patronID now has $bookCount items checked out.</p>";
                            } else {
                                echo "<p>Error updating item status: " . $updateItemStatusQuery . "<br>" . $conn->error . "</p>";
                            }
                        } else {
                            echo "<p>Error inserting into checkoutTransactionItem: " . $sql . "<br>" . $conn->error . "</p>";
                        }
                    } else {
                        echo "<p>Error: Item ID is not available or is already checked out.</p>";
                    }
                } else {
                    echo "<p>Error: No transactions found.</p>";
                }
            } else {
                echo "<p>Error fetching patron name: " . $patronNameQuery . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "<p>Error: Maximum number of books allowed reached for this patron.</p>";
        }
    } else {
        echo "<p>Error fetching book count: " . $bookCountQuery . "<br>" . $conn->error . "</p>";
    }

    // Close the database connection
    $conn->close();
}
?>



<form method="post" action="">
    <label for="itemID">Item ID:</label>
    <input type="text" name="itemID" required maxlength="4">
    <input type="submit" value="Check Out Item">
</form>
<form method="post" action="CheckOutReceipt.php">
    <input type="submit" name="checkoutReceipt" value="CheckOutReceipt">
</form>

<a href="index.html">Back to Welcome</a>
</body>
</html>

