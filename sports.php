<?php
include 'connect.php';

// Add sport
if (isset($_POST['addSport'])) {
    $sportName = $_POST['sportName'];
    $description = $_POST['description'];
    $iconUrl = $_POST['iconUrl'];

    $query = "INSERT INTO sports (sportName, description, iconUrl) VALUES ('$sportName', '$description', '$iconUrl')";
    executeQuery($query);
}

// Delete sport
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM sports WHERE id = $id";
    executeQuery($query);
}

// Fetch sports
$sports = executeQuery("SELECT * FROM sports");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Sports</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="countries.php">Countries</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="gallery.php">Gallery</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Manage Sports</h2>
        <form method="POST">
            <input type="text" name="sportName" placeholder="Sport Name" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="text" name="iconUrl" placeholder="Icon URL" required>
            <button type="submit" name="addSport">Add Sport</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sport Name</th>
                    <th>Description</th>
                    <th>Icon</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($sports)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['sportName'] ?></td>
                        <td><?= $row['description'] ?></td>
                        <td><img src="<?= $row['iconUrl'] ?>" alt="Icon" width="50"></td>
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
