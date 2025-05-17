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
    <meta charset="UTF-8" />
    <title>Upload Image - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-image: url('https://images.unsplash.com/photo-1503264116251-35a269479413?auto=format&fit=crop&w=1500&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding-top: 60px; /* space for back button */
            color: #fff;
        }

        .back-btn-container {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1050;
        }

        .upload-form {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        }

        .upload-form h2 {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .form-label {
            color: #f0f0f0;
        }

        .btn-primary {
            background-color: #ff4b2b;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ff3a1a;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="back-btn-container">
        <a href="admin.php" class="btn btn-primary d-inline-flex align-items-center">
            <i class="fas fa-arrow-left me-2"></i> Back to Admin
        </a>
    </div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
