<?php
include '../connect.php';

if (isset($_POST['addCountry'])) {
    $countryName = $_POST['countryName'];
    $totalGold = $_POST['totalGold'];
    $totalSilver = $_POST['totalSilver'];
    $totalBronze = $_POST['totalBronze'];
    
    $image = $_FILES['countryImage']['name'];
    $target = "../images/" . basename($image);
    
    if (move_uploaded_file($_FILES['countryImage']['tmp_name'], $target)) {
        $query = "INSERT INTO countries (countryName, totalGold, totalSilver, totalBronze, countryImage) 
                  VALUES ('$countryName', '$totalGold', '$totalSilver', '$totalBronze', '$image')";

        if (executeQuery($query)) {
            echo "<div class='alert alert-success'>New country added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Failed to upload image.</div>";
    }
}

if (isset($_POST['updateCountry'])) {
    $id = $_POST['id'];
    $countryName = $_POST['countryName'];
    $totalGold = $_POST['totalGold'];
    $totalSilver = $_POST['totalSilver'];
    $totalBronze = $_POST['totalBronze'];

    if ($_FILES['countryImage']['name'] != "") {
        $image = $_FILES['countryImage']['name'];
        $target = "../images/" . basename($image);

        if (move_uploaded_file($_FILES['countryImage']['tmp_name'], $target)) {
            $query = "UPDATE countries SET countryName='$countryName', totalGold='$totalGold', totalSilver='$totalSilver', totalBronze='$totalBronze', countryImage='$image' WHERE id=$id";
        } else {
            echo "<div class='alert alert-danger'>Failed to upload image.</div>";
        }
    } else {
        $query = "UPDATE countries SET countryName='$countryName', totalGold='$totalGold', totalSilver='$totalSilver', totalBronze='$totalBronze' WHERE id=$id";
    }

    if (executeQuery($query)) {
        echo "<div class='alert alert-success'>Country updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}

if (isset($_POST['deleteCountry'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM countries WHERE id=$id";

    if (executeQuery($query)) {
        echo "<div class='alert alert-success'>Country deleted successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}

$query = "SELECT * FROM countries";
$result = executeQuery($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center">Admin Panel</h1>

        <div class="mb-4">
            <h2>Add New Country</h2>
            <form action="admin.php" method="POST" enctype="multipart/form-data">
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
                <div class="mb-3">
                    <input type="file" name="countryImage" class="form-control" required>
                </div>
                <button type="submit" name="addCountry" class="btn btn-primary">Add Country</button>
            </form>
        </div>

        <hr>

        <div class="mb-4">
            <h2>Update Country</h2>
            <form action="admin.php" method="POST" enctype="multipart/form-data">
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
                <div class="mb-3">
                    <input type="file" name="countryImage" class="form-control">
                </div>
                <button type="submit" name="updateCountry" class="btn btn-success">Update Country</button>
            </form>
        </div>

        <hr>

        <div class="mb-4">
            <h2>Delete Country</h2>
            <form action="admin.php" method="POST">
                <div class="mb-3">
                    <select name="id" class="form-select" required>
                        <option value="">Select Country to Delete</option>
                        <?php
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

        <h2>Countries in the Database</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Gold</th>
                    <th>Silver</th>
                    <th>Bronze</th>
                    <th>Flag</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = executeQuery($query);
                while ($row = mysqli_fetch_assoc($result)):
                ?>
                    <tr>
                        <td><?= $row['countryName'] ?></td>
                        <td><?= $row['totalGold'] ?></td>
                        <td><?= $row['totalSilver'] ?></td>
                        <td><?= $row['totalBronze'] ?></td>
                        <td><img src="../images/<?= $row['countryImage'] ?>" alt="Flag" style="width: 50px; height: auto;"></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
