<?php
include "includes/navbar.php";
include "db_connection.php"; // Ensure this file defines $conn properly

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $email = mysqli_real_escape_string($conn, $_POST['contact_email']);
    $phone = mysqli_real_escape_string($conn, $_POST['contact_phone']);
    $message = mysqli_real_escape_string($conn, $_POST['contact_message']);

    $query = "INSERT INTO contact_messages (name, email, phone, message)
              VALUES ('$name', '$email', '$phone', '$message')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Your message has been sent successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact Us - Magic Evenza</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Open Sans', 'Roboto', sans-serif;
           
            background: #f1f1f1;
            overflow-x: hidden;
        }
        .contact-header img {
            width: 200px;
            border-bottom: 2px solid #ddd;
            padding: 3px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="contact-header mt-3 text-center">
        <img src="images/MagicEvenza.png" alt="Magic Evenza" class="img-fluid">
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center mb-3 mt-3" style="color:#6610f2;">CONTACT US</h3>
            <div class="bg-white p-4">
                <div class="contact-information">
                    <h5>LANDMARKET</h5>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-sm" style="font-size: 12px; color: #1a1a1a;">
                                <tr>
                                    <td>Big Day Planners</td>
                                    <td><i class="mdi mdi-deskphone mr-3"></i> 999 (999) 999</td>
                                </tr>
                                <tr>
                                    <td>Martha's Hospital Road, Uttarahalli</td>
                                    <td><i class="mdi mdi-phone mr-3"></i> +91 7353514374</td>
                                </tr>
                                <tr>
                                    <td>Bangalore 560061</td>
                                    <td><i class="mdi mdi-email mr-3"></i> Magic_Evenza@gmail.com</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4 d-flex justify-content-center align-items-start">
                            <i class="mdi mdi-map-marker" style="font-size: 112px; color:rgb(85, 90, 156);"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white mt-3 pt-1 pl-4 pb-3">
                <div class="row mt-3 ms-3">
                    <div class="col-md-12">
                        <form action="" method="post" style="font-size: 12px; color:black; ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <div class="form-group col-md-12 mb-1">
                                            <label for="contact_person">Name</label>
                                            <input type="text" name="contact_person" class="form-control" id="contact_person" required placeholder="Enter your name">
                                        </div>
                                        <div class="form-group col-md-12 mb-1">
                                            <label for="contact_email">Email</label>
                                            <input type="email" name="contact_email" class="form-control" id="contact_email" required placeholder="Enter email">
                                        </div>
                                        <div class="form-group col-md-12 mb-1">
                                            <label for="contact_phone">Phone</label>
                                            <input type="text" name="contact_phone" class="form-control" id="contact_phone" required placeholder="Enter mobile phone">
                                        </div>
                                        <div class="form-group col-md-12 mb-1">
                                            <label for="contact_message">Message</label>
                                            <textarea name="contact_message" class="form-control" rows="8" style="resize: none;" id="contact_message" required placeholder="Enter message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-2">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3890.993946764074!2d77.5945621!3d12.9715987!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae1670c6b7d4df%3A0xf6b2b1fc5bdb52d6!2sBangalore%2C%20Karnataka%2C%20India!5e0!3m2!1sen!2sin!4v1715516418000!5m2!1sen!2sin"
                                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
                                    </iframe>
                                </div>
                            </div>
                            <p>We will reach you within 24 hours</p>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0" style="font-size: 12px; margin-top: 10px; background-color:#6610f2; border: 0;">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>

<!-- JS Scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
