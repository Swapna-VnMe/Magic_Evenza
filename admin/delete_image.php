<?php
// Include database connection
include 'db_connection.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php"); // Redirect to admin login page if not logged in
    exit();
}

// Delete image functionality
if (isset($_GET['id'])) {
    $image_id = $_GET['id'];

    // Get image name from database
    $query = "SELECT image_name FROM gallery WHERE id = $image_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $image_name = $row['image_name'];

    // Delete image file from server
    if (unlink("images/$image_name")) {
        // Delete image record from database
        $query_delete = "DELETE FROM gallery WHERE id = $image_id";
        mysqli_query($conn, $query_delete);
    }

    header("Location: admin.php"); // Redirect to admin panel after deletion
    exit();
}
?>

<?php
// Close the database connection
mysqli_close($conn);
?>
