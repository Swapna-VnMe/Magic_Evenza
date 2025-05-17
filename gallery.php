<?php
include 'db_connection.php';

// Fetch images from the gallery table
$query = "SELECT id, image_name FROM gallery ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery - Magic Evenza</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            padding: 30px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .gallery-item:hover {
            transform: scale(1.05);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        a.gallery-item {
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php include './includes/navbar.php'; ?>

<div class="container">
    <h2 class="text-center mt-4 mb-4 " style="color:#6610f2 ;">Magic Evenza Gallery</h2>

    <div class="gallery-container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <?php 
                    $imagePath = 'uploads/' . $row['image_name'];
                ?>
                <a href="image_details.php?id=<?= $row['id'] ?>" class="gallery-item">
                    <?php if (file_exists($imagePath)): ?>
                        <img src="<?= $imagePath ?>" alt="Gallery Image">
                    <?php else: ?>
                        <div class="p-3 text-danger">Image not found</div>
                    <?php endif; ?>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">No images uploaded yet.</p>
        <?php endif; ?>
    </div>
</div>
<?php include './includes/footer.php'; ?>

</body>
</html>

<?php mysqli_close($conn); ?>
