<?php  
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $event_type = mysqli_real_escape_string($conn, $_POST['event_type']);

    $query = "INSERT INTO subscribers (first_name, last_name, email, contact, event_date, location, event_type)
              VALUES ('$first_name', '$last_name', '$email', '$contact', '$event_date', '$location', '$event_type')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Form submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Magic Evenza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
        }

        .bg {
            background-image: url('./assets/img/view-futuristic-concert_23-2151072985.avif');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 100px 20px; /* Add space from top */
            min-height: 100vh; /* Full viewport height */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.75);
            padding: 30px;
            border-radius: 10px;
            max-width: 550px;
            width: 100%;
            color: white;
        }

        .form-container input,
        .form-container select {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-container .half-input {
            width: 48%;
            display: inline-block;
        }

        .form-container .half-input:first-child {
            margin-right: 4%;
        }

        .form-container button {
            background-color: rgb(92, 58, 230);
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .title {
            font-size: 30px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .terms {
            font-size: 12px;
            color: #ccc;
            margin-top: 10px;
        }

        .terms a {
            color: #f66;
            text-decoration: none;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<?php include './includes/navbar.php'; ?>

<!-- MAIN CONTENT -->
<div class="bg">
    <div class="form-container">
        <div class="title text-center">Event Planning Starts Here</div>
        <div class="subtitle text-center">Start by filling up the form</div>

        <form method="POST" action="">
            <div class="d-flex justify-content-between">
                <input type="text" name="first_name" placeholder="First Name" class="half-input" required>
                <input type="text" name="last_name" placeholder="Last Name" class="half-input" required>
            </div>
            <input type="email" name="email" placeholder="Email address" required>
            <input type="tel" name="contact" placeholder="Contact Number" required>
            <input type="date" name="event_date" required>
            <input type="text" name="location" placeholder="Event Location" required>
            <select name="event_type" required>
                <option value="" disabled selected>Select Event Type</option>
                <option value="Wedding">Wedding</option>
                <option value="Birthday">Birthday</option>
                <option value="Corporate">Corporate</option>
                <option value="Concert">Concert</option>
                <option value="Festival">Festival</option>
                <option value="Other">Other</option>
            </select>

            <div class="terms">
                By clicking, you agree to Magic Evenza's <a href="#">Terms of Use</a>
                <p>We will reach you within 24 hours</p>
            </div>

            <button type="submit" class="btn">Your Turn</button>
        </form>
    </div>
</div>

<!-- FOOTER -->
<?php include './includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
