<?php
include 'db_connection.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query the database to get user info
    $result = $mysqli->query("SELECT * FROM users WHERE id = '$user_id'");
    $user = $result->fetch_assoc();

    // Check if the user is an admin
    if (!$user['is_admin']) {
        header("Location: gallery.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

// Handle the image upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image["name"]);
    
    // Check if the file is an image
    if (getimagesize($image["tmp_name"])) {
        move_uploaded_file($image["tmp_name"], $target_file);

        // Insert the image into the database
        $query = "INSERT INTO gallery_images (image_path) VALUES ('$target_file')";
        if ($mysqli->query($query)) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "File is not an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Image</title>
</head>
<body>

<h2>Add New Image</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <button type="submit">Upload Image</button>
</form>

</body>
</html>
