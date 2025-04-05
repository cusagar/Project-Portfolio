<!DOCTYPE html>
<html lang="en">
<head>
<title>Create Item</title>
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
  min-height: 80%;
}

.login-box {
  background-color: black;
  width: 300px;
  text-align: center;
  margin: 0 auto;
}

    .w3-row.w3-padding.w3-black {
        flex-direction: column;
        align-items: stretch;
    }

    .w3-col.s2 {
        width: 100%;
    }

    .w3-top {
        position: static;

    }

    .login-box input {
      width: 100%;
      padding: 1px;
      margin-bottom: 1px;
      border: 1px solid #ccc;
      border-radius: 1px;
    }

    .login-box button {
      width: 100%;
      padding: 1px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 1px;
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

    .input-group {
          display: flex;
          align-items: center;
      }

    .login-box label {
        margin-right: 10px; /* Adjust the margin as needed */
        color: white;
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
    <span class="w3-text-white" style="font-size:37px"><br>Create New Item</span>
  </div>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database configuration
        include "db_config.php";

        // Retrieve user input from the form
        $itemISBN = $_POST["itemISBN"];
        $itemTitle = $_POST["itemTitle"];
        $itemType = $_POST["itemType"];
        $itemYearPublished = $_POST["itemYearPublished"];
        $itemPublisher = $_POST["itemPublisher"];
        $itemLoC = $_POST["itemLoC"];
        $itemCost = $_POST["itemCost"];
        $itemBranch = $_POST["itemBranch"];
        $itemStatus = $_POST["itemStatus"];
        $itemSecurityDeviceFlag = $_POST["itemSecurityDeviceFlag"];
        $itemDamage = $_POST["itemDamage"];
        $Author1FirstName = $_POST["Author1FirstName"];
        $Author1LastName = $_POST["Author1LastName"];
        $Author2FirstName = $_POST["Author2FirstName"];
        $Author2LastName = $_POST["Author2LastName"];

        // SQL query to insert a new record into the "Item" table
        $sql = "INSERT INTO Item (itemISBN, itemTitle, itemType, itemYearPublished, itemPublisher, itemLoC, itemCost, itemBranch, itemStatus, itemSecurityDeviceFlag, itemDamage)
                VALUES ('$itemISBN', '$itemTitle', '$itemType', $itemYearPublished, '$itemPublisher', '$itemLoC', $itemCost, '$itemBranch', '$itemStatus', '$itemSecurityDeviceFlag', '$itemDamage')";

        if ($conn->query($sql) === TRUE) {
            
            //Get the most recent itemID
            $ItemIDQuery = "SELECT MAX(itemID) AS maxitemID FROM Item";
            $ItemIDResult = $conn->query($ItemIDQuery);
            $ItemID = $ItemIDResult->fetch_assoc()["maxitemID"];

            // SQL query to insert Authors into Author Table
            $sqlAuthor1 = "INSERT INTO Author (authorFirstName, authorLastName) VALUES ('$Author1FirstName', '$Author1LastName')";
            
            //SQL query to insert into ItemAuthor
            $sqlItemAuthor1 = "INSERT INTO ItemAuthor (itemID, authorID) VALUES ('$ItemID', (SELECT MAX(authorID) FROM Author))";

            if ($conn->query($sqlAuthor1) === TRUE) {
                if ($conn->query($sqlItemAuthor1) === TRUE) {
                                //Check if author 2 is empty
                  if ($Author2FirstName != "" && $Author2LastName != "") {
                    $sqlAuthor2 = "INSERT INTO Author (authorFirstName, authorLastName) VALUES ('$Author2FirstName', '$Author2LastName')";

                    //SQL query to insert into ItemAuthor
                    $sqlItemAuthor2 = "INSERT INTO ItemAuthor (itemID, authorID) VALUES ('$ItemID', (SELECT MAX(authorID) FROM Author))";

                    if ($conn->query($sqlAuthor2) === TRUE) {
                      if ($conn->query($sqlItemAuthor2) === TRUE) {
                        echo '<p class="error-message">Record with Item ID ' . $ItemID . ' has been created.</p>';
                      } else {
                        echo '<p class="error-message">Error: ' . $sqlItemAuthor2 . '<br>' . $conn->error . '</p>';
                      }
                    } else {
                      echo '<p class="error-message">Error: ' . $sqlAuthor2 . '<br>' . $conn->error . '</p>';
                    }
                  } else {
                    echo '<p class="error-message">Record with Item ID ' . $ItemID . ' has been created.</p>';
                  }

                } else {
                    echo '<p class="error-message">Error: ' . $sqlItemAuthor1 . '<br>' . $conn->error . '</p>';
                }
            } else {
                echo '<p class="error-message">Error: ' . $sqlAuthor1 . '<br>' . $conn->error . '</p>';
            }

            //Check if author 2 is empty
            if ($Author2FirstName != "" && $Author2LastName != "") {
                $sqlAuthor2 = "INSERT INTO Author (authorFirstName, authorLastName) VALUES ('$Author2FirstName', '$Author2LastName')";

                //SQL query to insert into ItemAuthor
                $sqlItemAuthor2 = "INSERT INTO ItemAuthor (itemID, authorID) VALUES ('$ItemID', (SELECT MAX(authorID) FROM Author))";
            }

        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

<form method="post" action="">
    <div class="login-box">
      
        <label for="itemISBN" class="white-text">ISBN:</label>
        <input type="text" name="itemISBN" required maxlength="17">

        <label for="itemTitle" class="white-text">Title:</label>
        <input type="text" name="itemTitle" required maxlength="90">

        <div class="input-group">
            <label for="itemType" class="white-text">Type:</label>
            <select name="itemType" required>
                <option value="books">Books</option>
                <option value="periodicals">Periodicals</option>
                <option value="recordings">Recordings</option>
                <option value="videos">Videos</option>
            </select>
        </div>

        <label for="itemYearPublished" class="white-text">Year Published:</label>
        <input type="number" name="itemYearPublished" required max = "2023">

        <label for="itemPublisher" class="white-text">Publisher:</label>
        <input type="text" name="itemPublisher" required maxlength="45">

        <label for="itemLoC" class="white-text">Library of Congress:</label>
        <input type="text" name="itemLoC" required maxlength="16">

        <label for="itemCost" class="white-text">Cost:</label>
        <input type="number" step="0.01" name="itemCost" required max="99999.99">

        <div class="input-group">
            <label for="itemBranch" class="white-text">Branch:</label>
            <select name="itemBranch" required>
                <option value="Main">Main</option>
                <option value="OakTree">OakTree</option>
                <option value="Peachtree">PeachTree</option>
                <option value="WillowTree">WillowTree</option>
            </select>
        </div>
       
        <div class="input-group">
            <label for="itemStatus" class="white-text">Status:</label>
            <select name="itemStatus" required>
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
            </select>
        </div>

        <div class="input-group">
            <label for="itemSecurityDeviceFlag" class="white-text">Security Device Flag:</label>
            <select name="itemSecurityDeviceFlag" required>
                <option value="Activated">Activated</option>
                <option value="Deactivated">Deactivated</option>
            </select>
        </div>

        <div class="input-group">
            <label for="itemDamage" class="white-text">Damage:</label>
            <select name="itemDamage" required>
                <option value="Like New">Like New</option>
                <option value="Great">Great</option>
                <option value="Repairable">Repairable</option>
                <option value="Unrepairable">Unrepairable</option>
            </select>
        </div>

        <label for= "Author1FirstName" class="white-text">Author 1 First Name:</label>
        <input type="text" name="Author1FirstName" required maxlength="45">

        <label for= "Author1LastName" class="white-text">Author 1 Last Name:</label>  
        <input type="text" name="Author1LastName" required maxlength="45">

        <label for= "Author2FirstName" class="white-text">Author 2 First Name:</label>
        <input type="text" name="Author2FirstName" maxlength="45">

        <label for= "Author2LastName" class="white-text">Author 2 Last Name:</label>
        <input type="text" name="Author2LastName" maxlength="45">

        <button type="submit">Add New Item</button>

      
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
