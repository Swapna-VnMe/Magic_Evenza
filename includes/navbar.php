<?php
// You can include this in any page to display the navbar.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous" />
    <title>Navbar</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .navbar-logo img {
            width: 150px;
            height: auto;
        }

        .navbar-menu {
            list-style: none;
            display: flex;
        }

        .navbar-menu li {
            margin: 0 15px;
        }

        .navbar-menu li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 12px;
            transition: background-color 0.3s ease;
        }

        .navbar-menu li a:hover {
            background-color: #575757;
            border-radius: 5px;
        }

        .navbar-toggle {
            display: none;
            cursor: pointer;
        }

        .navbar-toggle .bar {
            width: 25px;
            height: 3px;
            background-color: white;
            margin: 5px 0;
        }

        .navbar-search {
            display: flex;
            align-items: center;
        }

        .navbar-search input[type="text"] {
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            margin-right: 10px;
            font-size: 16px;
        }

        .navbar-search button {
            padding: 6px 12px;
            background-color: #575757;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .navbar-search button:hover {
            background-color: #444;
        }

        .logout-btn {
            background-color: rgb(92, 58, 230);
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 20px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: red;
            color: white;
        }

        @media screen and (max-width: 768px) {
            .navbar-menu {
                display: none;
                width: 100%;
                text-align: center;
                position: absolute;
                top: 60px;
                left: 0;
                background-color: #333;
            }

            .navbar-menu.active {
                display: block;
            }

            .navbar-menu li {
                margin: 10px 0;
            }

            .navbar-menu li a:hover {
                color: rgb(92, 58, 230);
                border-bottom: 2px solid rgb(92, 58, 230);
            }

            .navbar-toggle {
                display: block;
            }

            .navbar-search {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Section -->
    <nav style="background-color: white; padding: 10px 40px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);">
        <div style="display: flex; align-items: center; justify-content: center;">
            <img src="./assets/img/MagicEvenza.png" alt="ME Logo" style="height: 60px;" />
            <span style="font-size: 24px; font-weight: bold; color: black;">Magic</span><span style="font-size: 24px; font-weight: bold; color:rgb(92, 58, 230);" class="ms-1"> Evenza</span>
        </div>
        <ul style="list-style: none; display: flex; gap: 25px; margin: 0; padding: 0;">
            <li><a href="index.php" style="text-decoration: none; color: black; font-weight: bold;">HOME</a></li>
            <li><a href="packages.php" style="text-decoration: none; color: black; font-weight: bold;">EVENTS</a></li>
            <li><a href="inspiration.php" style="text-decoration: none; color: black; font-weight: bold;">INSPIRATION</a></li>
            <li><a href="gallery.php" style="text-decoration: none; color: black; font-weight: bold;">GALLERY</a></li>
            <li><a href="contact.php" style="text-decoration: none; color: black; font-weight: bold;">CONTACT US</a></li>
            <li><a href="about.php" style="text-decoration: none; color: black; font-weight: bold;">ABOUT US</a></li>
            <li><a href="view_venues.php" style="text-decoration: none; color: black; font-weight: bold;">VENUES</a></li>
        </ul>
        <a href="logout.php" class="logout-btn">Logout</a>
    </nav>

    <script>
        document.getElementById('navbar-toggle')?.addEventListener('click', function () {
            document.querySelector('.navbar-menu')?.classList.toggle('active');
        });
    </script>
</body>
</html>
