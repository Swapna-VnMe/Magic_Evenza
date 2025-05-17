<?php 
include 'db_connection.php';
session_start();

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit();
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login - Magic Evenza</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      background: url('assets/img/ad1.jpeg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      font-family: 'Roboto', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(12px);
      border-radius: 15px;
      padding: 40px 30px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
      color: #fff;
      width: 100%;
      max-width: 400px;
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .glass-card h2 {
      font-family: 'Playfair Display', serif;
      color: #fff;
      margin-bottom: 20px;
      text-align: center;
    }

    .form-control {
      background-color: rgba(255, 255, 255, 0.1);
      border: none;
      color: #fff;
    }

    .form-control::placeholder {
      color: #ddd;
    }

    .form-control:focus {
      background-color: rgba(255, 255, 255, 0.15);
      color: #fff;
      box-shadow: none;
    }

    .btn-custom {
      background-color: #6610f2;
      border: none;
      width: 100%;
    }

    .btn-custom:hover {
      background-color: #520dc2;
    }

    .alert {
      background-color: rgba(255, 0, 0, 0.7);
      border: none;
    }
  </style>
</head>
<body>

<div class="glass-card">
  <h2>Admin Login</h2>

  <?php if (isset($error_message)): ?>
    <div class="alert alert-danger text-center"><?= $error_message ?></div>
  <?php endif; ?>

  <form action="admin_login.php" method="POST">
    <div class="mb-3">
      <input type="text" name="username" class="form-control" placeholder="Username" required>
    </div>

    <div class="mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>

    <button type="submit" name="login" class="btn btn-custom btn-lg">Login</button>
  </form>
</div>

</body>
</html>

<?php mysqli_close($conn); ?>
