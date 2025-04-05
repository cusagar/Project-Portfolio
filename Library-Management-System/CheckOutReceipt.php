<!DOCTYPE html>
<html>
<head>
    <title>Checkout Receipt</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h1>Checkout Receipt</h1>

    <?php
    include "db_config.php";

    $transactionIDQuery = "SELECT MAX(transactionID) AS maxTransactionID FROM checkoutTransaction";
    $transactionIDResult = $conn->query($transactionIDQuery);

    // Check if there are transactions
    if ($transactionIDResult->num_rows > 0) {
        $transactionID = $transactionIDResult->fetch_assoc()['maxTransactionID'];

        $receiptSql = "SELECT cti.itemID, i.itemTitle, cti.dueDate, p.patronFirstName, p.patronLastName, i.itemCost
            FROM checkoutTransactionItem cti
            JOIN checkoutTransaction ct ON cti.transactionID = ct.transactionID
            JOIN Patron p ON p.patronID = ct.patronID
            JOIN Item i ON i.itemID = cti.itemID
            WHERE ct.transactionID = '$transactionID'";

        $receiptResult = $conn->query($receiptSql);

        if ($receiptResult->num_rows > 0) {
            $receiptData = $receiptResult->fetch_all(MYSQLI_ASSOC);

            // Display or process the data as needed
            echo '<div>';
            echo '<h2>Customer Information</h2>';
            echo '<p>Name: ' . $receiptData[0]['patronFirstName'] . ' ' . $receiptData[0]['patronLastName'] . '</p>';
            // You can add more customer information fields here
            echo '</div>';

            echo '<div>';
            echo '<h2>Items</h2>';
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Item</th>';
            echo '<th>Quantity</th>';
            echo '<th>Due Date</th>';
            echo '<th>Price</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($receiptData as $index => $data) {
                echo '<tr>';
                echo '<td>' . $data['itemTitle'] . '</td>';
                echo '<td>1</td>'; // Assuming quantity is always 1, you can modify as needed
                echo '<td>' . $data['dueDate'] . '</td>';
                echo '<td>$' . $data['itemCost'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
        } else {
            echo "<p>No data found for transactionID: $transactionID</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>

