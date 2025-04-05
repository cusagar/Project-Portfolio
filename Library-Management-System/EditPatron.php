<!DOCTYPE html>
<html>
<head>
    <title>Edit Patron</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h2 {
            background-color: #000000;
            color: #fff;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #000000;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            display: block;
            text-align: center;
            background-color: #000000;
            color: #fff;
            padding: 10px;
            text-decoration: none;
        }

        a:hover {
            background-color: #5A5A5A;
        }
    </style>
</head>
<body>
    <h2>Edit Patron</h2>

    <?php
    // Include the database configuration
    include "db_config.php";

    // SQL query to retrieve data from the "book" table
    $sql = "SELECT * FROM Patron";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data in an HTML table
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Address</th>
                <th>Date Of Birth</th>
                <th>Last Renewed</th>
                <th>Contact Phone</th>
                <th>Payment Balence</th>
            </tr>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><a href='EditPatronRow.php?patron_id=" . $row["patronID"] . "'>" . $row["patronID"] . "</a></td>";
            echo "<td>" . $row["patronLastName"] . "</td>";
            echo "<td>" . $row["patronFirstName"] . "</td>";
            echo "<td>" . $row["patronAddress"] . "</td>";
            echo "<td>" . $row["patronDateOfBirth"] . "</td>";
            echo "<td>" . $row["patronLastRenewed"] . "</td>";
            echo "<td>" . $row["patronContactPhone"] . "</td>";
            echo "<td>" . $row["paymentBalance"] . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";
    } else {
        echo "No records found.";
    }
    
    // Close the database connection
    $conn->close();
    ?>
    
    <a href="index.html">Back to Welcome</a>
</body>
</html>
</html>
