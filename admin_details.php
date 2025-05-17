<?php  
include 'db_connection.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Initialize variables with defaults or session values
$admin_username = $_SESSION['admin_username'] ?? 'Admin';
$admin_email = $_SESSION['admin_email'] ?? 'admin@example.com';
$role = "Super Administrator";
$last_login = date("Y-m-d H:i:s");

// Fetch additional admin info from database if admin_id is set
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $stmt = $conn->prepare("SELECT email, role, last_login FROM admin WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $admin_email = $row['email'] ?? $admin_email;
        $role = $row['role'] ?? $role;
        $last_login = $row['last_login'] ?? $last_login;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome CDN for user icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .admin-card {
            max-width: 500px;
            margin: 100px auto;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .back-link {
            max-width: 500px;
            margin: 20px auto;
        }
        .profile-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #ddd;
            color: #555;
            margin: 0 auto 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 60px;
        }
    </style>
</head>
<body>

<div class="back-link text-center">
    <a href="admin.php" class="btn btn-secondary">&larr; Back to Dashboard</a>
</div>

<div class="card admin-card">
    <div class="card-header bg-dark text-white text-center">
        <h4 class="mb-0">Admin Profile</h4>
    </div>
    <div class="card-body text-center">
        <!-- Profile Icon -->
        <div class="profile-icon">
            <i class="fa-solid fa-user"></i>
        </div>

        <!-- Admin Info -->
        <h5 class="card-title mt-2"><?= htmlspecialchars($admin_username) ?></h5>
        <p class="text-muted"><?= htmlspecialchars($role) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($admin_email) ?></p>
        <p><strong>Login Status:</strong> Logged In</p>
        <p><strong>Last Login:</strong> <?= htmlspecialchars($last_login) ?></p>

        <!-- Edit Profile Button -->
        <a href="edit_admin_profile.php" class="btn btn-primary mt-3">Edit Profile</a>
    </div>
</div>

</body>
</html>
