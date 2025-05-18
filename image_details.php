<?php
include 'db_connection.php';

if (!isset($_GET['id'])) {
    die("No image selected.");
}

$image_id = intval($_GET['id']);

// Fetch image details
$query = "SELECT * FROM gallery WHERE id = $image_id";
$result = mysqli_query($conn, $query);
$image = mysqli_fetch_assoc($result);
if (!$image) {
    die("Image not found.");
}

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $insert = "INSERT INTO comments (image_id, name, comment) VALUES ($image_id, '$name', '$comment')";
    mysqli_query($conn, $insert);
}

// Fetch comments
$comments = mysqli_query($conn, "SELECT * FROM comments WHERE image_id = $image_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include './includes/navbar.php'; ?>

<div class="container mt-4">
    <a href="gallery.php" class="btn btn-secondary mb-3">← Back to Gallery</a>

    <div class="card mb-4">
        <img src="uploads/<?= htmlspecialchars($image['image_name']) ?>" class="card-img-top" alt="Image">
        <div class="card-body">
            <h5>Event Place: <?= htmlspecialchars($image['place'] ?? 'N/A') ?></h5>
            <p>Date: <?= htmlspecialchars($image['event_date'] ?? 'N/A') ?></p>
            <p>Description: <?= htmlspecialchars($image['description'] ?? 'No description available') ?></p>
        </div>
    </div>

    <!-- Comment Form -->
    <div class="card mb-4">
        <div class="card-header">Leave a Comment</div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Your Name (optional)">
                </div>
                <div class="mb-3">
                    <textarea name="comment" class="form-control" placeholder="Your Comment" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>
    </div>

    <!-- Display Comments -->
    <h5>Comments:</h5>
    <?php if (mysqli_num_rows($comments) > 0): ?>
        <?php while ($c = mysqli_fetch_assoc($comments)): ?>
            <div class="border rounded p-2 mb-2">
                <strong><?= htmlspecialchars($c['name'] ?: 'Anonymous') ?></strong>
                <small class="text-muted">(<?= $c['created_at'] ?>)</small>
                <p><?= nl2br(htmlspecialchars($c['comment'])) ?></p>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No comments yet.</p>
    <?php endif; ?>
</div>
<?php include './includes/footer.php'; ?>

</body>
</html>

<?php mysqli_close($conn); ?>
