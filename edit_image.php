<?php
include 'db_connection.php';

session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle delete image
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $result = mysqli_query($conn, "SELECT image_name FROM gallery WHERE id=$id");
    $image = mysqli_fetch_assoc($result);

    if ($image && file_exists("uploads/" . $image['image_name'])) {
        unlink("uploads/" . $image['image_name']);
        mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");
        $message = "Image deleted successfully.";
    } else {
        $message = "Image not found.";
    }
}

// Fetch all images
$images = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Images - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            /* padding-top: 20px; */
            padding-bottom: 40px;
        }
        .back-btn-container {
            margin-bottom: 1rem;
            padding-left: 15px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
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
    </style>
</head>
<body>
<nav class="navbar navbar-dark">
    <div class="d-flex align-items-center">
        <button class="navbar-toggler" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <span class="navbar-brand mb-0 ms-2 h1">Magic Evenza</span>
    </div>
    <a href="admin_details.php" class="admin-btn"><i class="fas fa-user-shield me-1"></i>Admin Details</a>
</nav>
<div class="container">

    <!-- Back to Admin Button -->
    <div class="back-btn-container mt-4">
        <a href="admin.php" class="btn btn-primary d-inline-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i> Back to Admin
        </a>
    </div>

    <h2 class="mb-4 text-center">Manage Gallery Images</h2>

    <?php if (isset($message)): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($images)): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="uploads/<?= htmlspecialchars($row['image_name']) ?>" class="card-img-top" alt="Image">
                    <div class="card-body">
                        <h5 class="card-title text-truncate" title="<?= htmlspecialchars($row['image_name']) ?>"><?= htmlspecialchars($row['image_name']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                        <a href="update_image.php?id=<?= urlencode($row['id']) ?>" class="btn btn-warning btn-sm me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="edit_image.php?delete=<?= urlencode($row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this image?');">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php mysqli_close($conn); ?>
