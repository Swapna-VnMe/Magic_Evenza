<?php
include 'db_connection.php';
session_start();

// Redirect if not admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Get current venue data
$query = "SELECT * FROM venue LIMIT 1";
$result = mysqli_query($conn, $query);
$venue = mysqli_fetch_assoc($result);

// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    if ($venue) {
        // Update
        $update = "UPDATE venue SET title='$title', description='$description', location='$location', date='$date' WHERE id={$venue['id']}";
    } else {
        // Insert if empty
        $update = "INSERT INTO venue (title, description, location, date) VALUES ('$title', '$description', '$location', '$date')";
    }

    mysqli_query($conn, $update);
    header("Location: venue.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Venue - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Venue Details</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($venue['title'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required><?= htmlspecialchars($venue['description'] ?? '') ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="<?= htmlspecialchars($venue['location'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($venue['date'] ?? '') ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="venue.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>

<?php mysqli_close($conn); ?>
