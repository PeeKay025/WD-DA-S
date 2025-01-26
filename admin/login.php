<?php
  session_start();
  include('../connect.php');

  if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials (you can improve this with hashed passwords)
    $result = executeQuery("SELECT * FROM admin WHERE username = '$username' AND password = '$password'");

    if(mysqli_num_rows($result) == 1) {
      $_SESSION['admin_logged_in'] = true;
      header('Location: admin.php');
    } else {
      echo "Invalid login credentials!";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
</head>
<body>
  <h1>Login to Admin Panel</h1>
  <form action="login.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit" name="login">Login</button>
  </form>
</body>
</html>
