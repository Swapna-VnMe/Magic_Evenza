<?php
include 'db_connection.php';
session_start();

// Ensure only admin can delete images
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query the database to get user info
    $result = $mysqli->query("SELECT * FROM users WHERE id = '$user_id'");
    $user = $result->fetch_assoc();

    if (!$user['is_admin']) {
        header("Location: gallery.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $image_id = intval($_GET['id']);

    // First, get the image file path from the DB
    $result = $mysqli->query("SELECT image_name FROM gallery_images WHERE id = $image_id");
    if ($result && $row = $result->fetch_assoc()) {
        $imagePath = 'uploads/' . $row['image_name'];  // Adjust folder as per your setup

        // Delete the image file if exists
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Now delete the DB record
        if ($mysqli->query("DELETE FROM gallery_images WHERE id = $image_id")) {
            header("Location: gallery.php?msg=Image deleted successfully");
            exit();
        } else {
            echo "Error deleting image record from database.";
        }
    } else {
        echo "Image not found in database.";
    }
}
?>
