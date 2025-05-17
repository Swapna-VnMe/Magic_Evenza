<?php
// Include database connection
include 'db_connection.php';
session_start();

// Handle login form submission
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if username and password match the admin's credentials in the database
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    // If a matching record is found, log the admin in
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: admin.php"); // Redirect to admin page
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Magic Evenza</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Admin Login</h2>

    <?php
    // Display error message if login failed
    if (isset($error_message)) {
        echo "<div class='alert alert-danger'>$error_message</div>";
    }
    ?>

    <form action="admin_login.php" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <button type="submit" name="login" class="btn btn-primary">Login</button>
    </form>
</div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
