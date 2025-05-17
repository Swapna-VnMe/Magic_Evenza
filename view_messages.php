<?php
include "db_connection.php";

// Handle delete request securely
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $delete_query = "DELETE FROM contact_messages WHERE id = $delete_id";
    mysqli_query($conn, $delete_query);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$query = "SELECT * FROM contact_messages ORDER BY submitted_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin - View Contact Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 40px 15px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgb(0 0 0 / 0.1);
            padding: 30px 40px;
        }

        h3 {
            color: #5e35b1;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .back-btn {
            margin-bottom: 25px;
            font-weight: 600;
            background-color: #5e35b1;
            border: none;
            color: white;
            border-radius: 8px;
            padding: 8px 18px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #4527a0;
            color: white;
            text-decoration: none;
        }

        table {
            border-collapse: separate !important;
            border-spacing: 0 12px !important;
            font-size: 0.95rem;
        }

        thead tr th {
            background-color: #5e35b1;
            color: white;
            font-weight: 600;
            border: none !important;
            padding: 15px 12px;
            border-radius: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        tbody tr {
            background-color: #fafafa;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.05);
            transition: background-color 0.3s ease;
            border-radius: 10px;
        }
        tbody tr:hover {
            background-color: #ede7f6;
        }

        tbody tr td {
            vertical-align: middle;
            padding: 15px 12px;
            border: none !important;
            color: #333;
        }

        tbody tr td:nth-child(5) {
            white-space: pre-wrap; /* preserve line breaks in message */
            max-width: 350px;
            text-align: left;
            font-style: italic;
            color: #555;
        }

        .btn-danger {
            font-size: 0.9rem;
            padding: 5px 12px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgb(255 0 0 / 0.2);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #b71c1c;
            box-shadow: 0 4px 12px rgb(183 28 28 / 0.4);
        }

        .text-center {
            text-align: center !important;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }
            tbody tr td:nth-child(5) {
                max-width: 200px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a href="admin.php" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Admin
    </a>

    <h3>Submitted Contact Messages</h3>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td class="text-center"><?= $row['id']; ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['phone']); ?></td>
                            <td><?= htmlspecialchars($row['message']); ?></td>
                            <td class="text-center"><?= $row['submitted_at']; ?></td>
                            <td class="text-center">
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');" style="margin:0;">
                                    <input type="hidden" name="delete_id" value="<?= $row['id']; ?>" />
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted fst-italic py-4">No messages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
