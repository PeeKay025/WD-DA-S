<?php
include 'connect.php';

// Add country
if (isset($_POST['addCountry'])) {
    $countryName = $_POST['countryName'];
    $flagUrl = $_POST['flagUrl'];

    $query = "INSERT INTO countries (countryName, flagUrl) VALUES ('$countryName', '$flagUrl')";
    executeQuery($query);
}

// Delete country
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM countries WHERE id = $id";
    executeQuery($query);
}

// Fetch countries
$countries = executeQuery("SELECT * FROM countries");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Countries</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="sports.php">Sports</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="gallery.php">Gallery</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Manage Countries</h2>
        <form method="POST">
            <input type="text" name="countryName" placeholder="Country Name" required>
            <input type="text" name="flagUrl" placeholder="Flag URL" required>
            <button type="submit" name="addCountry">Add Country</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Country Name</th>
                    <th>Flag</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($countries)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['countryName'] ?></td>
                        <td><img src="<?= $row['flagUrl'] ?>" alt="Flag" width="50"></td>
                        <td><a href="?delete=<?= $row['id'] ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2025 Discover the Olympic Spirit</p>
    </footer>
</body>
</html>
