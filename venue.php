<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// ADD Venue
if (isset($_POST['add_venue'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $imagePath = '';
    if (!empty($_FILES['image']['name'])) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        $targetPath = $targetDir . time() . "_" . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;
        }
    }

    $query = "INSERT INTO venues (name, location, description, image)
              VALUES ('$name', '$location', '$description', '$imagePath')";
    mysqli_query($conn, $query);
    $success_message = "Venue added successfully!";
}

// UPDATE Venue
if (isset($_POST['update_venue'])) {
    $id = intval($_POST['venue_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $imageUpdate = '';
    if (!empty($_FILES['image']['name'])) {
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "uploads/";
        $targetPath = $targetDir . time() . "_" . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imageUpdate = ", image='$targetPath'";
        }
    }

    $query = "UPDATE venues SET name='$name', location='$location', description='$description' $imageUpdate WHERE id=$id";
    mysqli_query($conn, $query);
    $success_message = "Venue updated successfully!";
}

// DELETE Venue
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($conn, "DELETE FROM venues WHERE id=$id");
    $success_message = "Venue deleted successfully!";
}

// Fetch venues
$venues = mysqli_query($conn, "SELECT * FROM venues ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Manage Venues - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            
            padding-bottom: 40px;
        }
        .back-btn-container {
            padding-left: 15px;
            margin-bottom: 1.5rem;
        }
        .table img {
            max-height: 80px;
            border-radius: 6px;
            object-fit: cover;
        }
        textarea.form-control {
            resize: vertical;
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

    <h2 class="mb-4 text-center">Manage Venues</h2>

    <?php if (!empty($success_message)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($success_message) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php
    $edit_mode = false;
    $edit_venue = null;
    if (isset($_GET['edit'])) {
        $edit_id = intval($_GET['edit']);
        $edit_result = mysqli_query($conn, "SELECT * FROM venues WHERE id=$edit_id");
        $edit_venue = mysqli_fetch_assoc($edit_result);
        $edit_mode = true;
    }
    ?>

    <!-- Add/Edit Venue Form -->
    <form method="POST" enctype="multipart/form-data" class="mb-5">
        <input type="hidden" name="venue_id" value="<?= $edit_mode ? (int)$edit_venue['id'] : '' ?>">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="venueName" class="form-label">Venue Name <span class="text-danger">*</span></label>
                <input id="venueName" type="text" name="name" class="form-control" required value="<?= $edit_mode ? htmlspecialchars($edit_venue['name']) : '' ?>">
            </div>
            <div class="col-md-6">
                <label for="venueLocation" class="form-label">Location</label>
                <input id="venueLocation" type="text" name="location" class="form-control" value="<?= $edit_mode ? htmlspecialchars($edit_venue['location']) : '' ?>">
            </div>
        </div>
        <div class="mt-3">
            <label for="venueDescription" class="form-label">Description</label>
            <textarea id="venueDescription" name="description" class="form-control" rows="3"><?= $edit_mode ? htmlspecialchars($edit_venue['description']) : '' ?></textarea>
        </div>
        <div class="mt-3">
            <label for="venueImage" class="form-label">Upload Image</label>
            <input id="venueImage" type="file" name="image" class="form-control" accept="image/*">
            <?php if ($edit_mode && !empty($edit_venue['image'])): ?>
                <div class="mt-2">
                    <p class="mb-1">Current Image:</p>
                    <img src="<?= htmlspecialchars($edit_venue['image']) ?>" alt="Venue Image" class="img-thumbnail" style="max-height: 120px;">
                </div>
            <?php endif; ?>
        </div>
        <div class="mt-4">
            <button type="submit" name="<?= $edit_mode ? 'update_venue' : 'add_venue' ?>" class="btn btn-<?= $edit_mode ? 'warning' : 'primary' ?>">
                <?= $edit_mode ? 'Update Venue' : 'Add Venue' ?>
            </button>
            <?php if ($edit_mode): ?>
                <a href="venue.php" class="btn btn-secondary ms-2">Cancel</a>
            <?php endif; ?>
        </div>
    </form>

    <!-- Venue Table -->
    <h4 class="mb-3">Existing Venues</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th class="text-center" style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php if(mysqli_num_rows($venues) > 0): ?>
                <?php while ($venue = mysqli_fetch_assoc($venues)): ?>
                    <tr>
                        <td><?= htmlspecialchars($venue['name']) ?></td>
                        <td><?= htmlspecialchars($venue['location']) ?></td>
                        <td><?= htmlspecialchars($venue['description']) ?></td>
                        <td>
                            <?php if (!empty($venue['image'])): ?>
                                <img src="<?= htmlspecialchars($venue['image']) ?>" alt="Venue Image" />
                            <?php else: ?>
                                <em>No image</em>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="venue.php?edit=<?= (int)$venue['id'] ?>" class="btn btn-sm btn-warning me-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="venue.php?delete=<?= (int)$venue['id'] ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Are you sure you want to delete this venue?');" 
                               title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" class="text-center">No venues found.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
