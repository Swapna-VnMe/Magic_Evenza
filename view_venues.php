<?php 
include 'db_connection.php';

// Fetch all venues
$venues = mysqli_query($conn, "SELECT * FROM venues");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Venues - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include './includes/navbar.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4 text-center" style="color:#6610f2;"> Event Venues</h2>

    <?php if (mysqli_num_rows($venues) === 0): ?>
        <div class="alert alert-info text-center">No venues have been added yet.</div>
    <?php else: ?>
        <div class="row">
            <?php while ($venue = mysqli_fetch_assoc($venues)): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <?php if (!empty($venue['image'])): ?>
                            <img src="<?= htmlspecialchars($venue['image']) ?>" class="card-img-top" alt="Venue Image" style="max-height: 250px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($venue['name']) ?></h5>
                            <p class="card-text"><strong>Location:</strong> <?= htmlspecialchars($venue['location']) ?></p>
                            <p class="card-text"><?= nl2br(htmlspecialchars($venue['description'])) ?></p>
                            
                            <!-- Book Venue Button -->
<!-- Book Venue Button -->
<a href="index.php" class="btn btn-primary mt-auto">Book Venue</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>

<?php include './includes/footer.php'; ?>
</body>
</html>
