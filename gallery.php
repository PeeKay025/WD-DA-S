<?php
include 'connect.php';

// Add gallery image
if (isset($_POST['addImage'])) {
    $imageUrl = $_POST['imageUrl'];
    $description = $_POST['description'];

    $query = "INSERT INTO gallery (imageUrl, description) VALUES ('$imageUrl', '$description')";
    executeQuery($query);
}

// Delete image
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM gallery WHERE id = $id";
    executeQuery($query);
}

// Fetch gallery images
$gallery = executeQuery("SELECT * FROM gallery");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Gallery</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="sports.php">Sports</a></li>
                <li><a href="countries.php">Countries</a></li>
                <li><a href="events.php">Events</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Manage Gallery</h2>
        <form method="POST">
            <input type="text" name="imageUrl" placeholder="Image URL" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <button type="submit" name="addImage">Add Image</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($gallery)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><img src="<?= $row['imageUrl'] ?>" alt="Gallery Image" width="100"></td>
                        <td><?= $row['caption'] ?></td>
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
