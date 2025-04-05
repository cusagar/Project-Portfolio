<!DOCTYPE html>
<html>
<head>
    <title>Edit Items</title>
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
    <h2>Edit Items</h2>

    <?php
    // Include the database configuration
    include "db_config.php";

    // SQL query to retrieve data from the "book" table
    $sql = "SELECT * FROM Item";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data in an HTML table
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>ISBN</th>
                <th>Title</th>
                <th>Type</th>
                <th>Year Published</th>
                <th>Publisher</th>
                <th>Library of Congress</th>
                <th>Cost</th>
                <th>Aquisition Date</th>
                <th>Copy</th>
                <th>Branch</th>
                <th>Status</th>
                <th>Security Device Flag</th>
                <th>Damage</th>
            </tr>";
    
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><a href='ChangeRow.php?item_id=" . $row["itemID"] . "'>" . $row["itemID"] . "</a></td>";
            echo "<td>" . $row["itemISBN"] . "</td>";
            echo "<td>" . $row["itemTitle"] . "</td>";
            echo "<td>" . $row["itemType"] . "</td>";
            echo "<td>" . $row["itemYearPublished"] . "</td>";
            echo "<td>" . $row["itemPublisher"] . "</td>";
            echo "<td>" . $row["itemLoC"] . "</td>";
            echo "<td>" . $row["itemCost"] . "</td>";
            echo "<td>" . $row["itemAquisitionDate"] . "</td>";
            echo "<td>" . $row["itemCopy"] . "</td>";
            echo "<td>" . $row["itemBranch"] . "</td>";
            echo "<td>" . $row["itemStatus"] . "</td>";
            echo "<td>" . $row["itemSecurityDeviceFlag"] . "</td>";
            echo "<td>" . $row["itemDamage"] . "</td>";
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


