<?php
require_once "./db_connection.php";
session_start();

if (!empty($_SESSION['id'])) {
    header("Location:index.php");
    exit();
}

$alertMessage = "";

if (isset($_POST["submit"])) {
    // Correct variable names to match the form field names
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repassword = $_POST["repassword"];  // Correct variable name

    // Check if username or email already exists
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' OR email='$email'");

    if (mysqli_num_rows($result) > 0) {
        $alertMessage = "Username or Email already exists";
    } elseif ($password !== $repassword) {  // Corrected condition
        $alertMessage = "Passwords do not match";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

        if (mysqli_query($conn, $query)) {
            $alertMessage = "Registration Successful";
        } else {
            $alertMessage = "Something went wrong";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="/Magic_Evenza/includes/register.css">
  <style>
    body {
      overflow: hidden;
    }
  </style>
</head>
<body>

<?php if (!empty($alertMessage)) : ?>
  <script>alert("<?php echo $alertMessage; ?>");</script>
<?php endif; ?>

<div class="wrapper-1">
  <form action="" method="POST">
    <h1>Register</h1>

    <div class="input-box">
      <input type="text" name="username" placeholder="Enter your name" required>
    </div>

    <div class="input-box">
      <input type="email" name="email" placeholder="Email address" required>
    </div>

    <div class="input-box">
      <input type="password" name="password" placeholder="Password" required>
    </div>

    <div class="input-box">
      <input type="password" name="repassword" placeholder="Re-Password" required> <!-- Corrected name attribute -->
    </div>

    <button type="submit" name="submit" class="btn-1">Register</button>

    <div class="register-link">
      <p>Already have an account? <a href="./login.php">Login</a></p>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
