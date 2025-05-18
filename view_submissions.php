<?php
include 'db_connection.php';
session_start();

// Check admin login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete_query = "DELETE FROM subscribers WHERE id = $id";
    if (mysqli_query($conn, $delete_query)) {
        $message = "Subscriber deleted successfully.";
    } else {
        $message = "Error deleting subscriber: " . mysqli_error($conn);
    }
}

// Fetch subscribers
$result = mysqli_query($conn, "SELECT * FROM subscribers ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Manage Subscribers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
             .navbar {
            background-color: #343a40;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 1rem;
        }
        .navbar-brand {
            color: white;
            display: flex;
            align-items: center;
        }
        .navbar-toggler {
            border: none;
            font-size: 1.25rem;
            color: white;
            margin-right: 1rem;
        }
        .admin-btn {
            color: white;
            text-decoration: none;
            border: 1px solid #fff;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }
        .admin-btn:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
    <div class="d-flex align-items-center">
        <button class="navbar-toggler" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <span class="navbar-brand mb-0 ms-2 h1">Magic Evenza</span>
    </div>
    <a href="admin_details.php" class="admin-btn"><i class="fas fa-user-shield me-1"></i>Admin Details</a>
</nav>
<div class="container mt-4">
    <h2>Manage Subscribers</h2>

    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-- Back button moved above the table -->
    <a href="admin.php" class="btn btn-primary mb-3"> ← Back to Admin Panel</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Event Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['first_name']) ?></td>
                    <td><?= htmlspecialchars($row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['contact']) ?></td>
                    <td><?= htmlspecialchars($row['event_date']) ?></td>
                    <td>
                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this subscriber?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="7" class="text-center">No subscribers found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php mysqli_close($conn); ?>
