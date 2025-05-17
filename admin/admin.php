<?php
session_start();
include 'db_connection.php';

// Redirect to login if not admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Welcome, Admin</h2>

    <div class="row g-4">
        <!-- Manage Gallery Images -->
        <div class="col-md-4">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Gallery Management</h5>
                    <p class="card-text">Edit or delete uploaded images.</p>
                    <a href="edit_images.php" class="btn btn-primary">Manage Gallery</a>
                </div>
            </div>
        </div>

        <!-- Manage Subscribers -->
        <div class="col-md-4">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Manage Subscribers</h5>
                    <p class="card-text">View users who submitted the form.</p>
                    <a href="view_subscribers.php" class="btn btn-success">View Subscribers</a>
                </div>
            </div>
        </div>

        <!-- Logout -->
        <div class="col-md-4">
            <div class="card h-100 shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Logout</h5>
                    <p class="card-text">End your session securely.</p>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
