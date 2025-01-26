<?php
// Include the database connection file
include '../connect.php';

// Handle form submission for adding a new country
if (isset($_POST['addCountry'])) {
    $countryName = $_POST['countryName'];
    $totalGold = $_POST['totalGold'];
    $totalSilver = $_POST['totalSilver'];
    $totalBronze = $_POST['totalBronze'];

    $query = "INSERT INTO countries (countryName, totalGold, totalSilver, totalBronze) 
              VALUES ('$countryName', '$totalGold', '$totalSilver', '$totalBronze')";

    if (executeQuery($query)) {
        echo "New country added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle form submission for updating an existing country
if (isset($_POST['updateCountry'])) {
    $id = $_POST['id'];
    $countryName = $_POST['countryName'];
    $totalGold = $_POST['totalGold'];
    $totalSilver = $_POST['totalSilver'];
    $totalBronze = $_POST['totalBronze'];

    $query = "UPDATE countries SET countryName='$countryName', totalGold='$totalGold', totalSilver='$totalSilver', totalBronze='$totalBronze' WHERE id=$id";

    if (executeQuery($query)) {
        echo "Country updated successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Handle form submission for deleting a country
if (isset($_POST['deleteCountry'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM countries WHERE id=$id";

    if (executeQuery($query)) {
        echo "Country deleted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch countries to display
$query = "SELECT * FROM countries";
$result = executeQuery($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Olympic Spirit</title>
</head>
<body>

    <h1>Admin Panel - Manage Olympic Countries</h1>

    <!-- Add new country form -->
    <h2>Add New Country</h2>
    <form action="admin.php" method="POST">
        <input type="text" name="countryName" placeholder="Country Name" required>
        <input type="number" name="totalGold" placeholder="Gold Medals" required>
        <input type="number" name="totalSilver" placeholder="Silver Medals" required>
        <input type="number" name="totalBronze" placeholder="Bronze Medals" required>
        <button type="submit" name="addCountry">Add Country</button>
    </form>

    <hr>

    <!-- Update existing country form -->
    <h2>Update Country</h2>
    <form action="admin.php" method="POST">
        <select name="id" required>
            <option value="">Select Country</option>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?= $row['id'] ?>"><?= $row['countryName'] ?></option>
            <?php endwhile; ?>
        </select>
        <input type="text" name="countryName" placeholder="New Country Name" required>
        <input type="number" name="totalGold" placeholder="New Gold Medals" required>
        <input type="number" name="totalSilver" placeholder="New Silver Medals" required>
        <input type="number" name="totalBronze" placeholder="New Bronze Medals" required>
        <button type="submit" name="updateCountry">Update Country</button>
    </form>

    <hr>

    <!-- Delete country form -->
    <h2>Delete Country</h2>
    <form action="admin.php" method="POST">
        <select name="id" required>
            <option value="">Select Country to Delete</option>
            <?php
            // Fetch countries again for the delete dropdown
            $result = executeQuery($query);
            while ($row = mysqli_fetch_assoc($result)):
            ?>
                <option value="<?= $row['id'] ?>"><?= $row['countryName'] ?></option>
            <?php endwhile; ?>
        </select>
        <button type="submit" name="deleteCountry">Delete Country</button>
    </form>

    <hr>

    <!-- Display list of countries -->
    <h2>Countries in the Database</h2>
    <table border="1">
        <tr>
            <th>Country</th>
            <th>Gold</th>
            <th>Silver</th>
            <th>Bronze</th>
        </tr>
        <?php
        // Fetch and display the countries
        $result = executeQuery($query);
        while ($row = mysqli_fetch_assoc($result)):
        ?>
            <tr>
                <td><?= $row['countryName'] ?></td>
                <td><?= $row['totalGold'] ?></td>
                <td><?= $row['totalSilver'] ?></td>
                <td><?= $row['totalBronze'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
