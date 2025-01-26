<?php
include 'connect.php';

// Add event
if (isset($_POST['addEvent'])) {
    $eventName = $_POST['eventName'];
    $date = $_POST['date'];

    $query = "INSERT INTO events (eventName, date) VALUES ('$eventName', '$date')";
    executeQuery($query);
}

// Delete event
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM events WHERE id = $id";
    executeQuery($query);
}

// Fetch events
$events = executeQuery("SELECT * FROM events");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Events</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="sports.php">Sports</a></li>
                <li><a href="countries.php">Countries</a></li>
                <li><a href="gallery.php">Gallery</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Manage Events</h2>
        <form method="POST">
            <input type="text" name="eventName" placeholder="Event Name" required>
            <input type="date" name="date" required>
            <button type="submit" name="addEvent">Add Event</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($events)) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['eventName'] ?></td>
                        <td><?= $row['eventDate'] ?></td>
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
