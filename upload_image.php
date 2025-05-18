<?php
// Include database connection
include 'db_connection.php';

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$error_message = '';
$success_message = '';

// Handle image upload
if (isset($_POST['upload'])) {
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_error = $_FILES['image']['error'];

    if ($image_error !== UPLOAD_ERR_OK) {
        $error_message = "Upload failed with error code $image_error.";
    } else {
        $mime_type = mime_content_type($image_tmp);
        $allowed_types = [
            'image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp',
            'image/svg+xml', 'image/tiff', 'image/x-icon', 'image/avif'
        ];

        if (in_array($mime_type, $allowed_types)) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $new_filename = uniqid('img_', true) . "_" . basename($image_name);
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($image_tmp, $target_file)) {
                $query = "INSERT INTO gallery (image_name) VALUES ('$new_filename')";
                mysqli_query($conn, $query);
                $success_message = "Image uploaded successfully.";
            } else {
                $error_message = "Error saving the uploaded file.";
            }
        } else {
            $error_message = "Invalid file type: $mime_type.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }
        .wrapper {
            display: flex;
            height: 100%;
        }
        .sidebar {
            width: 250px;
            background-color: #212529;
            color: white;
            padding: 20px;
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            width: 0;
            padding: 0;
            overflow: hidden;
        }
        .sidebar h4 {
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
        }
        .sidebar a {
            color: white;
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.2s ease-in-out;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }
        .navbar {
            background-color: #343a40;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
        }
        .navbar-brand {
            color: white;
            display: flex;
            align-items: center;
        }
        .navbar-toggler {
            border: none;
            font-size: 1.25rem;
            color: white;
            margin-right: 1rem;
        }
        .admin-btn {
            color: white;
            text-decoration: none;
            border: 1px solid #fff;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }
        .admin-btn:hover {
            background-color: #495057;
        }
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 40px;
            background: url('https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1500&q=80') no-repeat center center;
            background-size: cover;
        }
        .upload-form {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 40px;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            color: #fff;
        }
        .upload-form h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
            color: #fff;
        }
        .form-label {
            color: #f0f0f0;
        }
        .btn-primary {
            background-color: #1a73e8;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0f5cc0;
        }
        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark">
    <div class="d-flex align-items-center">
        <button class="navbar-toggler" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <span class="navbar-brand mb-0 ms-2 h1">Dashboard</span>
    </div>
    <a href="admin_details.php" class="admin-btn"><i class="fas fa-user-shield me-1"></i>Admin Details</a>
</nav>

<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4>Magic Evenza</h4>
        <a href="upload_image.php" class="active"><i class="fas fa-upload"></i> Upload Image</a>
        <a href="edit_image.php"><i class="fas fa-images"></i> Manage Gallery</a>
        <a href="venue.php"><i class="fas fa-map-marker-alt"></i> Manage Venues</a>
        <a href="view_submissions.php"><i class="fas fa-users"></i> Manage Subscriptions</a>
        <a href="view_messages.php"><i class="fas fa-envelope"></i> Manage Messages</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <!-- Content Area -->
    <div class="content">
        <div class="upload-form">
            <h2>Upload New Image</h2>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
            <?php elseif (!empty($success_message)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>

            <form action="upload_image.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="image" class="form-label">Choose Image</label>
                    <input type="file" name="image" id="image" class="form-control" required />
                </div>
                <button type="submit" name="upload" class="btn btn-primary w-100">Upload Image</button>
            </form>
        </div>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });
</script>
</body>
</html>
