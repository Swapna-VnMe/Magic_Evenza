<?php
include 'db_connection.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if image ID is provided
if (!isset($_GET['id'])) {
    die("No image specified.");
}

$image_id = intval($_GET['id']);

// Fetch current image data
$query = "SELECT * FROM gallery WHERE id = $image_id";
$result = mysqli_query($conn, $query);
$image = mysqli_fetch_assoc($result);

if (!$image) {
    die("Image not found.");
}

$error_message = '';
$success_message = '';

// Handle form submission for update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    $venue = mysqli_real_escape_string($conn, $_POST['venue'] ?? '');
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date'] ?? '');

    // Handle image upload if a new file is selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        $image_error = $_FILES['image']['error'];

        if ($image_error === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp', 'image/svg+xml', 'image/tiff', 'image/x-icon', 'image/avif'];
            $mime_type = mime_content_type($image_tmp);

            if (in_array($mime_type, $allowed_types)) {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                // Generate new unique filename
                $new_filename = uniqid('img_', true) . "_" . basename($image_name);
                $target_file = $target_dir . $new_filename;

                // Move new file
                if (move_uploaded_file($image_tmp, $target_file)) {
                    // Delete old image file if exists
                    $old_file = $target_dir . $image['image_name'];
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }

                    // Update image name, description, venue and date in DB
                    $update_query = "UPDATE gallery SET image_name='$new_filename', description='$description', place='$venue', event_date='$event_date' WHERE id=$image_id";
                    if (mysqli_query($conn, $update_query)) {
                        $success_message = "Image, description, venue, and date updated successfully.";
                        // Refresh image data after update
                        $image['image_name'] = $new_filename;
                        $image['description'] = $description;
                        $image['place'] = $venue;
                        $image['event_date'] = $event_date;
                    } else {
                        $error_message = "Database update failed: " . mysqli_error($conn);
                    }
                } else {
                    $error_message = "Failed to move uploaded file.";
                }
            } else {
                $error_message = "Invalid file type uploaded.";
            }
        } else {
            $error_message = "Error uploading file.";
        }
    } else {
        // Only update description, venue and date if no new image is uploaded
        $update_query = "UPDATE gallery SET description='$description', place='$venue', event_date='$event_date' WHERE id=$image_id";
        if (mysqli_query($conn, $update_query)) {
            $success_message = "Description, venue, and date updated successfully.";
            $image['description'] = $description;
            $image['place'] = $venue;
            $image['event_date'] = $event_date;
        } else {
            $error_message = "Database update failed: " . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Image - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Update Image</h2>

    <?php if ($error_message): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
    <?php elseif ($success_message): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <form action="update_image.php?id=<?= $image_id ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Current Image:</label><br>
            <img src="uploads/<?= htmlspecialchars($image['image_name']) ?>" alt="Image" style="max-width: 300px; max-height: 300px; object-fit: contain;">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Replace Image (optional):</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" class="form-control" rows="4"><?= htmlspecialchars($image['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="venue" class="form-label">Venue:</label>
            <input type="text" name="venue" id="venue" class="form-control" value="<?= htmlspecialchars($image['place']) ?>">
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">Date:</label>
            <input type="date" name="event_date" id="event_date" class="form-control" value="<?= htmlspecialchars($image['event_date']) ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update Image</button>
        <a href="edit_image.php" class="btn btn-secondary">Back to Gallery Management</a>
    </form>
</div>
