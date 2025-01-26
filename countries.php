<?php
include 'connect.php';

// Fetch countries
$query = "SELECT * FROM countries";
$countries = executeQuery($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countries - Olympic Spirit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-dark text-white text-center p-4">
        <h1>Countries - Olympic Spirit</h1>
        <nav>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a class="nav-link text-white" href="index.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <div class="container my-5">
        <h2>Countries and Their Medals</h2>
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
                <?php while ($row = mysqli_fetch_assoc($countries)): ?>
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

    <footer class="bg-dark text-white text-center p-3">
        <p>&copy; 2025 Olympic Spirit</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
