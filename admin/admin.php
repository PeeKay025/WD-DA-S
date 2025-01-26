<?php
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
        echo "<div class='alert alert-success'>New country added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
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
        echo "<div class='alert alert-success'>Country updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}

// Handle form submission for deleting a country
if (isset($_POST['deleteCountry'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM countries WHERE id=$id";

    if (executeQuery($query)) {
        echo "<div class='alert alert-success'>Country deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
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
    <title>Admin - Manage Countries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Admin Panel - Manage Olympic Countries</h1>

        <!-- Add new country form -->
        <div class="mb-4">
            <h2>Add New Country</h2>
            <form action="admin.php" method="POST">
                <div class="mb-3">
                    <input type="text" name="countryName" class="form-control" placeholder="Country Name" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="totalGold" class="form-control" placeholder="Gold Medals" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="totalSilver" class="form-control" placeholder="Silver Medals" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="totalBronze" class="form-control" placeholder="Bronze Medals" required>
                </div>
                <button type="submit" name="addCountry" class="btn btn-primary">Add Country</button>
            </form>
        </div>

        <hr>

        <!-- Update existing country form -->
        <div class="mb-4">
            <h2>Update Country</h2>
            <form action="admin.php" method="POST">
                <div class="mb-3">
                    <select name="id" class="form-select" required>
                        <option value="">Select Country</option>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <option value="<?= $row['id'] ?>"><?= $row['countryName'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" name="countryName" class="form-control" placeholder="New Country Name" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="totalGold" class="form-control" placeholder="New Gold Medals" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="totalSilver" class="form-control" placeholder="New Silver Medals" required>
                </div>
                <div class="mb-3">
                    <input type="number" name="totalBronze" class="form-control" placeholder="New Bronze Medals" required>
                </div>
                <button type="submit" name="updateCountry" class="btn btn-success">Update Country</button>
            </form>
        </div>

        <hr>

        <!-- Delete country form -->
        <div class="mb-4">
            <h2>Delete Country</h2>
            <form action="admin.php" method="POST">
                <div class="mb-3">
                    <select name="id" class="form-select" required>
                        <option value="">Select Country to Delete</option>
                        <?php
                        // Fetch countries again for the delete dropdown
                        $result = executeQuery($query);
                        while ($row = mysqli_fetch_assoc($result)):
                        ?>
                            <option value="<?= $row['id'] ?>"><?= $row['countryName'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" name="deleteCountry" class="btn btn-danger">Delete Country</button>
            </form>
        </div>

        <hr>

        <!-- Display list of countries -->
        <h2>Countries in the Database</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Gold</th>
                    <th>Silver</th>
                    <th>Bronze</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
