<?php
// Include database connection
include 'db_connection.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php"); // Redirect to admin login page if not logged in
    exit();
}

// Handle image upload
if (isset($_POST['upload'])) {
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];

    // Define allowed image types and max size
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 2 * 1024 * 1024; // 2MB

    if (in_array($_FILES['image']['type'], $allowed_types) && $image_size <= $max_size) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($image_name);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image_tmp, $target_file)) {
            // Insert image info into the database
            $query = "INSERT INTO gallery (image_name) VALUES ('$image_name')";
            mysqli_query($conn, $query);
            header("Location: admin.php"); // Redirect to admin panel after upload
            exit();
        } else {
            $error_message = "There was an error uploading the image.";
        }
    } else {
        $error_message = "Invalid file type or file too large.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image - Magic Evenza</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Upload New Image</h2>

    <?php if (isset($error_message)) echo "<div class='alert alert-danger'>$error_message</div>"; ?>

    <form action="upload_image.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Choose Image</label>
            <input type="file" name="image" id="image" class="form-control" required>
        </div>
        <button type="submit" name="upload" class="btn btn-primary">Upload Image</button>
    </form>
</div>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
