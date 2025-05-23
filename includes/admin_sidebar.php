

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            font-family: 'Segoe UI', sans-serif;
        }
        .wrapper {
            display: flex;
            height: 100%;
        }
        .sidebar {
            width: 250px;
            background-color: #212529;
            color: white;
            padding: 20px;
            transition: all 0.3s;
        }
        .sidebar.collapsed {
            width: 0;
            padding: 0;
            overflow: hidden;
        }
        .sidebar h4 {
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
            font-size: 24px;
        }
        .sidebar a {
            color: white;
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: all 0.2s ease-in-out;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }
        .content {
            flex: 1;
            overflow-y: auto;
            padding: 40px;
            background-color: #f1f3f5;
            transition: margin-left 0.3s;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .card .card-title {
            font-weight: 600;
        }
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

<!-- Navbar -->
<nav class="navbar navbar-dark">
    <div class="d-flex align-items-center">
        <button class="navbar-toggler" id="toggleSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <span class="navbar-brand mb-0 ms-2 h1">Dashboard</span>
    </div>
    <a href="admin_details.php" class="admin-btn"><i class="fas fa-user-shield me-1"></i>Admin Details</a>
</nav>

<!-- Wrapper -->
<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4>Magic Evenza</h4>
        <a href="upload_image.php"><i class="fas fa-upload"></i> Upload Image</a>
        <a href="edit_image.php"><i class="fas fa-images"></i> Manage Gallery</a>
        <a href="venue.php"><i class="fas fa-map-marker-alt"></i> Manage Venues</a>
        <a href="view_submissions.php"><i class="fas fa-users"></i> Manage Subscriptions</a>
        <a href="view_messages.php"><i class="fas fa-envelope"></i> Manage Messages</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>


</div>

<!-- Sidebar Toggle Script -->
<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
    });
</script>

</body>
</html>
