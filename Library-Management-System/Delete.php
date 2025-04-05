<!DOCTYPE html>
<html lang="en">
<head>
<title>Delete Item</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<style>
body, html {
  height: 100%;
  font-family: "Inconsolata", sans-serif;
  margin: 0;
  padding: 0;
}

.bgimg {
  background-position: center;
  background-size: cover;
  background-image: url("https://images.unsplash.com/photo-1572061486195-d811e12d0a10?q=80&w=2942&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
  min-height: 75%;
}

.menu {
  display: none;
}
.white-text {
    color: white;
}

.white-text {
   color: white;
}

.login-box {
  background-color: black;
  width: 300px;
  padding: 20px;
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.login-box input {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.login-box button {
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.login-box button:hover {
  background-color: #45a049;
}

.w3-display-top {
  margin-top: 50px; /* Adjust the margin to move the text lower */
}

.error-message {
  color: white;
  text-align: center;
  font-size: 20px;
  margin-top: 90px;
}
</style>
</head>
<body>

    <!-- Links (sit on top) -->
<div class="w3-top">
    <div class="w3-row w3-padding w3-black">
        <div class="w3-col s2" style="width: 10%"><a href="index.html" class="w3-button w3-block w3-black" title="Go to Home">HOME</a></div>
        <div class="w3-col s2" style="width: 20%"><a href="ManagePatrons.php" class="w3-button w3-block w3-black" title="Create new Patron&#10;Edit Patron&#10;Delete Patron">MANAGE PATRONS</a></div>
        <div class="w3-col s2" style="width: 18%"><a href="ManageItems.php" class="w3-button w3-block w3-black" title="View all items&#10;Create new items&#10;Delete items&#10;Edit items">MANAGE ITEMS</a></div>
        <div class="w3-col s2" style="width: 15%"><a href="NewCheckOut.php" class="w3-button w3-block w3-black" title="Check out items">CHECK OUT</a></div>
        <div class="w3-col s2" style="width: 15%"><a href="CheckInScan.php" class="w3-button w3-block w3-black" title="Check in items">CHECK IN</a></div>
        <div class="w3-col s2" style="width: 20%"><a href="Shelve.php" class="w3-button w3-block w3-black" title="Manage reshelving of items">RESHELVE ITEMS</a></div>
    </div>
</div>

<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">Open from 8am to 10pm</span>
  </div>
  <div class="w3-display-top w3-center">
    <span class="w3-text-white" style="font-size:37px"><br>Delete item</span>
  </div>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database configuration
        include "db_config.php";

        // Retrieve the item ID to be deleted
        $itemID = $_POST["itemID"];

        // SQL query to check if the item has related records in ItemAuthor
        $sqlCheckItemTransaction = "SELECT * FROM checkoutTransactionItem WHERE itemID = '$itemID'";

        // Execute the query to check for ItemAuthor records
        $resultItemTransaction = $conn->query($sqlCheckItemTransaction);

        if ($resultItemTransaction->num_rows > 0) {
            echo '<p class="error-message">Cannot delete Item ID ' . $itemID . '. Has related records in CheckOut Transactions.</p>';
        } else {
            // SQL query to delete records from the "ItemAuthor" table
            $sqlDeleteItemAuthor = "DELETE FROM ItemAuthor WHERE itemID = '$itemID'";

            // SQL query to delete the record from the "Item" table
            $sqlDeleteItem = "DELETE FROM Item WHERE itemID = '$itemID'";

            // Execute the query to delete from ItemAuthor
            if ($conn->query($sqlDeleteItemAuthor) === TRUE) {
                // Execute the query to delete from Item if ItemAuthor deletion was successful
                if ($conn->query($sqlDeleteItem) === TRUE) {
                    if ($conn->affected_rows > 0) {
                        echo '<p class="error-message">Record with Item ID ' . $itemID . ' has been deleted.</p>';
                    } else {
                        echo '<p class="error-message">No record found with Item ID ' . $itemID . '.</p>';
                    }
                } else {
                    echo '<p class="error-message">Error deleting from Item: ' . $sqlDeleteItem . '<br>' . $conn->error . '</p>';
                }
            } else {
                echo '<p class="error-message">Error deleting from ItemAuthor: ' . $sqlDeleteItemAuthor . '<br>' . $conn->error . '</p>';
            }
        }

        // Close the database connection
        $conn->close();
    }
?>


<form method="post" action="">
    <div class="login-box">
    
        <label for="itemID" class="white-text">Item ID:</label>
        <input type="number" placeholder="Patron ID:" name="itemID" required>
        
        <button type="submit">Delete Record</button>

    </div>
  </form>

  <div class="w3-display-bottomright w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">456 Literary Lane, 28403</span>
  </div>
</header>

<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-48 w3-large">
  <p>Powered by <a title="Wisdom" target="_blank" class="w3-hover-text-green">Wisdom</a></p>
</footer>




</body>
</html>
