<?php  
include 'db_connection.php';
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: admin_login.php");
    exit();
}

$admin_username = $_SESSION['username'] ?? null;
if (!$admin_username) {
    die("No admin logged in.");
}

// Fetch admin ID by username
$stmt = $conn->prepare("SELECT id FROM admin WHERE username = ?");
$stmt->bind_param("s", $admin_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Admin not found.");
}

$row = $result->fetch_assoc();
$admin_id = $row['id'];
$stmt->close();

$error = '';
$success = '';

// Fetch current admin info (excluding profile_image since no longer used)
$stmt = $conn->prepare("SELECT username, role, password FROM admin WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Admin not found.");
}

$admin = $result->fetch_assoc();
$stmt->close();

$username = $admin['username'];
$role = $admin['role'];
$current_password_hash = $admin['password'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($username)) {
        $error = "Username is required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Prepare password hash
        $password_hash_to_save = $current_password_hash;
        if (!empty($password)) {
            $password_hash_to_save = password_hash($password, PASSWORD_DEFAULT);
        }

        if (!$error) {
            $update_stmt = $conn->prepare("UPDATE admin SET username = ?, password = ? WHERE id = ?");
            $update_stmt->bind_param("ssi", $username, $password_hash_to_save, $admin_id);

            if ($update_stmt->execute()) {
                $success = "Profile updated successfully.";
                $_SESSION['admin_username'] = $username; // update session username
            } else {
                $error = "Failed to update profile. Please try again.";
            }
            $update_stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome CDN for user icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .edit-card {
            max-width: 600px;
            margin: 80px auto;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 20px 30px;
            background: #fff;
        }
        .profile-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background-color: #ddd;
            color: #555;
            margin: 0 auto 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 80px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="edit-card">
        <h3 class="mb-4 text-center">Edit Admin Profile</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="post" novalidate>
            <div class="text-center">
                <div class="profile-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username *</label>
                <input type="text" id="username" name="username" class="form-control" required value="<?= htmlspecialchars($username) ?>" />
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="text" class="form-control" readonly value="<?= htmlspecialchars($role) ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password" class="form-control" autocomplete="new-password" />
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" autocomplete="new-password" />
            </div>

            <div class="d-flex justify-content-between">
                <a href="admin_details.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
